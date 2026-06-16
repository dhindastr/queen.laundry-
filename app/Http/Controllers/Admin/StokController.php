<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
class StokController extends Controller {
    public function index(){$items=Item::orderByRaw('(stok<=stok_minimum) DESC,nama')->get();$kritis=$items->filter(fn($i)=>$i->stok<=$i->stok_minimum)->count();return view('admin.stok.index',compact('items','kritis'));}
    public function store(Request $request){$request->validate(['nama'=>'required','satuan'=>'required','stok'=>'required|numeric|min:0','stok_minimum'=>'required|numeric|min:0','harga_satuan'=>'required|numeric|min:0']);Item::create($request->only('nama','satuan','stok','stok_minimum','harga_satuan'));return back()->with('success','Barang ditambahkan.');}
    public function update(Request $request,Item $stok){$request->validate(['tambah_stok'=>'required|numeric|min:0']);$stok->update(['stok'=>$stok->stok+$request->tambah_stok]);return back()->with('success','Stok diperbarui.');}
    public function destroy(Item $stok){$stok->delete();return back()->with('success','Barang dihapus.');}
}
