<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Order,Invoice,Expense,Customer,User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class LaporanController extends Controller {
    public function index(Request $request){
        $month=$request->bulan??now()->format('Y-m');
        [$y,$m]=explode('-',$month);
        $pemasukan=Invoice::where('status','paid')->whereYear('tanggal_bayar',$y)->whereMonth('tanggal_bayar',$m)->sum('total');
        $pengeluaran=Expense::whereYear('tanggal',$y)->whereMonth('tanggal',$m)->sum('jumlah');
        $totalOrder=Order::whereYear('tanggal_order',$y)->whereMonth('tanggal_order',$m)->count();
        $selesai=Order::where('status','selesai')->whereYear('tanggal_order',$y)->whereMonth('tanggal_order',$m)->count();
        $weekly=[];
        for($w=1;$w<=4;$w++){$s=Carbon::create($y,$m,1)->addWeeks($w-1);$weekly["Mgg {$w}"]=Invoice::where('status','paid')->whereBetween('tanggal_bayar',[$s,$s->copy()->endOfDay()->addDays(6)])->sum('total');}
        $byKat=Expense::whereYear('tanggal',$y)->whereMonth('tanggal',$m)->select('kategori',DB::raw('sum(jumlah) as total'))->groupBy('kategori')->get();
        $topCustomers=Customer::withSum(['orders as total_val'=>fn($q)=>$q->where('status','selesai')],'total_harga')->orderByDesc('total_val')->take(5)->get();
        $kurirStats=User::where('role','kurir')->withCount(['ordersAsPickup as pickup_count','ordersAsDelivery as delivery_count'])->get();
        $bulanList=collect(range(0,5))->map(fn($i)=>now()->subMonths($i)->format('Y-m'))->toArray();
        return view('admin.laporan.index',compact('pemasukan','pengeluaran','totalOrder','selesai','weekly','byKat','topCustomers','kurirStats','month','bulanList'));
    }
}
