<?php
namespace App\Http\Controllers\Owner;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PemasukanController extends Controller {
    public function index(Request $request){
        $month=$request->bulan??now()->format('Y-m');[$y,$m]=explode('-',$month);
        $invoices=Invoice::with('order.customer')->where('status','paid')->whereYear('tanggal_bayar',$y)->whereMonth('tanggal_bayar',$m)->latest()->paginate(20);
        $total=Invoice::where('status','paid')->whereYear('tanggal_bayar',$y)->whereMonth('tanggal_bayar',$m)->sum('total');
        $weekly=[];for($w=1;$w<=4;$w++){$s=Carbon::create($y,$m,1)->addWeeks($w-1);$weekly["Mgg {$w}"]=Invoice::where('status','paid')->whereBetween('tanggal_bayar',[$s,$s->copy()->addDays(6)->endOfDay()])->sum('total');}
        $bulanList=collect(range(0,5))->map(fn($i)=>now()->subMonths($i)->format('Y-m'))->toArray();
        return view('owner.pemasukan',compact('invoices','total','weekly','month','bulanList'));
    }
}
