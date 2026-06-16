<?php
namespace App\Http\Controllers\Owner;
use App\Http\Controllers\Controller;
use App\Models\{Order,Invoice,Expense,Item};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DashboardController extends Controller {
    public function index(){
        $m=now()->format('Y-m');[$y,$mo]=explode('-',$m);
        $pemasukan=Invoice::where('status','paid')->whereYear('tanggal_bayar',$y)->whereMonth('tanggal_bayar',$mo)->sum('total');
        $pengeluaran=Expense::whereYear('tanggal',$y)->whereMonth('tanggal',$mo)->sum('jumlah');
        $totalOrder=Order::whereYear('tanggal_order',$y)->whereMonth('tanggal_order',$mo)->count();
        $statusSummary=Order::select('status',DB::raw('count(*) as total'))->groupBy('status')->get()->keyBy('status');
        $stokKritis=Item::whereRaw('stok<=stok_minimum')->get();
        $weekly=[];
        for($w=1;$w<=4;$w++){$s=Carbon::create($y,$mo,1)->addWeeks($w-1);$weekly["Mgg {$w}"]=Invoice::where('status','paid')->whereBetween('tanggal_bayar',[$s,$s->copy()->addDays(6)->endOfDay()])->sum('total');}
        return view('owner.dashboard',compact('pemasukan','pengeluaran','totalOrder','statusSummary','stokKritis','weekly'));
    }
}
