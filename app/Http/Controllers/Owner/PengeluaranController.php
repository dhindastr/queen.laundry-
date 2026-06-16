<?php
namespace App\Http\Controllers\Owner;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PengeluaranController extends Controller {
    public function index(Request $request){
        $month=$request->bulan??now()->format('Y-m');[$y,$m]=explode('-',$month);
        $expenses=Expense::whereYear('tanggal',$y)->whereMonth('tanggal',$m)->latest()->paginate(20);
        $byKat=Expense::whereYear('tanggal',$y)->whereMonth('tanggal',$m)->select('kategori',DB::raw('sum(jumlah) as total'))->groupBy('kategori')->get();
        $total=$byKat->sum('total');
        $bulanList=collect(range(0,5))->map(fn($i)=>now()->subMonths($i)->format('Y-m'))->toArray();
        return view('owner.pengeluaran',compact('expenses','byKat','total','month','bulanList'));
    }
    public function store(Request $request){
        $request->validate(['kategori'=>'required','keterangan'=>'required','jumlah'=>'required|numeric|min:0','tanggal'=>'required|date']);
        Expense::create($request->only('kategori','keterangan','jumlah','tanggal'));
        return back()->with('success','Pengeluaran berhasil dicatat.');
    }
}
