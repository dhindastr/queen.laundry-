<?php
namespace App\Http\Controllers\Kurir;
use App\Http\Controllers\Controller;
use App\Models\{Order,OrderStatusLog};
use Illuminate\Http\Request;
class DeliveryController extends Controller {
    public function index(){
        $k=auth()->user();
        $tasks=Order::where('kurir_delivery_id',$k->id)->whereIn('status',['siap_delivery','delivery'])->with('customer')->latest()->get();
        return view('kurir.delivery',compact('tasks'));
    }
    public function konfirmasi(Request $request,Order $order){
        abort_unless($order->kurir_delivery_id==auth()->id(),403);
        $foto=null;
        if($request->hasFile('foto'))$foto=$request->file('foto')->store('delivery','public');
        $order->update(['status'=>'selesai','foto_delivery'=>$foto]);
        OrderStatusLog::create(['order_id'=>$order->id,'status'=>'selesai','catatan'=>'Delivery selesai','actor_id'=>auth()->id(),'actor_type'=>'kurir']);
        return back()->with('success','Delivery berhasil dikonfirmasi!');
    }
}
