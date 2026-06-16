<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Order,Customer,User,Item,Invoice};
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller {
    public function index(){
        $today=now()->toDateString();$m=now()->format('Y-m');
        $stats=['order_hari_ini'=>Order::whereDate('tanggal_order',$today)->count(),'menunggu_pickup'=>Order::where('status','menunggu_pickup')->count(),'sedang_proses'=>Order::whereIn('status',['pickup','proses','selesai_cuci'])->count(),'selesai_bulan'=>Order::where('status','selesai')->whereRaw("strftime('%Y-%m',tanggal_order)=?",[$m])->count(),'pemasukan_bulan'=>Invoice::where('status','paid')->whereRaw("strftime('%Y-%m',tanggal_bayar)=?",[$m])->sum('total')];
        $recentOrders=Order::with('customer')->latest()->take(8)->get();
        $kurirList=User::where('role','kurir')->get();
        $customerList=Customer::orderBy('nama')->get();
        $stokKritis=Item::whereRaw('stok<=stok_minimum')->get();
        $statusSummary=Order::select('status',DB::raw('count(*) as total'))->groupBy('status')->get()->keyBy('status');
        return view('admin.dashboard',compact('stats','recentOrders','kurirList','customerList','stokKritis','statusSummary'));
    }
}
