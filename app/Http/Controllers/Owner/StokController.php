<?php
namespace App\Http\Controllers\Owner;
use App\Http\Controllers\Controller;
use App\Models\Item;
class StokController extends Controller {
    public function index(){
        $items=Item::orderByRaw('(stok<=stok_minimum) DESC,nama')->get();
        $kritis=$items->filter(fn($i)=>$i->stok<=$i->stok_minimum)->count();
        return view('owner.stok',compact('items','kritis'));
    }
}
