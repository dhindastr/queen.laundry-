<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\{Order,OrderStatusLog};
use Illuminate\Http\Request;
class PickupController extends Controller {
    public function create(){return view('customer.pickup');}
    public function store(Request $request){
        $request->validate(['jenis_laundry'=>'required','jadwal_pickup'=>'required|date','catatan'=>'nullable']);
        $c=auth('customer')->user();
        $o=Order::create(['customer_id'=>$c->id,'jenis_laundry'=>$request->jenis_laundry,'catatan'=>$request->catatan,'tanggal_order'=>now(),'jadwal_pickup'=>$request->jadwal_pickup,'status'=>'menunggu_pickup','harga_per_kg'=>25000]);
        OrderStatusLog::create(['order_id'=>$o->id,'status'=>'menunggu_pickup','catatan'=>'Request pickup dikirim','actor_id'=>$c->id,'actor_type'=>'customer']);
        return redirect()->route('customer.orders.show',$o)->with('success','Request pickup berhasil dikirim!');
    }
}
