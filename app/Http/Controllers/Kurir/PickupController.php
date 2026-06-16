<?php
namespace App\Http\Controllers\Kurir;
use App\Http\Controllers\Controller;
use App\Models\{Order,OrderStatusLog};
use Illuminate\Http\Request;
class PickupController extends Controller {
    public function index(){
        $k=auth()->user();
        $tasks=Order::where('kurir_pickup_id',$k->id)->whereIn('status',['menunggu_pickup','pickup'])->with('customer')->latest()->get();
        return view('kurir.pickup',compact('tasks'));
    }
    public function konfirmasi(Request $request,Order $order){
        abort_unless($order->kurir_pickup_id==auth()->id(),403);
        $foto=null;
        if($request->hasFile('foto'))$foto=$request->file('foto')->store('pickup','public');
        $order->update(['status'=>'proses','foto_pickup'=>$foto]);
        OrderStatusLog::create(['order_id'=>$order->id,'status'=>'proses','catatan'=>'Pickup selesai','actor_id'=>auth()->id(),'actor_type'=>'kurir']);
        return back()->with('success','Pickup berhasil dikonfirmasi!');
    }
}
