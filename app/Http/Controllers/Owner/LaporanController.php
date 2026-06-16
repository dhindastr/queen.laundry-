<?php
namespace App\Http\Controllers\Owner;
use App\Http\Controllers\Controller;
use App\Models\{Order,Invoice,Expense,User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class LaporanController extends Controller {
    public function index(Request $request){
        $month=$request->bulan??now()->format('Y-m');[$y,$m]=explode('-',$month);
        $pemasukan=Invoice::where('status','paid')->whereYear('tanggal_bayar',$y)->whereMonth('tanggal_bayar',$m)->sum('total');
        $pengeluaran=Expense::whereYear('tanggal',$y)->whereMonth('tanggal',$m)->sum('jumlah');
        $totalOrder=Order::whereYear('tanggal_order',$y)->whereMonth('tanggal_order',$m)->count();
        $byKat=Expense::whereYear('tanggal',$y)->whereMonth('tanggal',$m)->select('kategori',DB::raw('sum(jumlah) as total'))->groupBy('kategori')->get();
        $kurirStats=User::where('role','kurir')->withCount(['ordersAsPickup as pickup','ordersAsDelivery as delivery'])->get();
        $monthly=[];for($i=5;$i>=0;$i--){$d=now()->subMonths($i);$monthly[$d->format('M Y')]=Invoice::where('status','paid')->whereYear('tanggal_bayar',$d->year)->whereMonth('tanggal_bayar',$d->month)->sum('total');}
        $bulanList=collect(range(0,5))->map(fn($i)=>now()->subMonths($i)->format('Y-m'))->toArray();
        return view('owner.laporan',compact('pemasukan','pengeluaran','totalOrder','byKat','kurirStats','monthly','month','bulanList'));
    }
}
