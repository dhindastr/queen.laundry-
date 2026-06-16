<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Order,Customer,User,OrderStatusLog};
use Illuminate\Http\Request;
class OrderController extends Controller {
    public function index(Request $request){
        $q=Order::with(['customer','kurirPickup','kurirDelivery'])->latest();
        if($request->status)$q->where('status',$request->status);
        if($request->search)$q->whereHas('customer',fn($s)=>$s->where('nama','like',"%{$request->search}%"));
        $orders=$q->paginate(15)->withQueryString();
        $customers=Customer::orderBy('nama')->get();
        $kurirList=User::where('role','kurir')->get();
        return view('admin.orders.index',compact('orders','customers','kurirList'));
    }
    public function store(Request $request){
        $request->validate(['customer_id'=>'required|exists:customers,id','jenis_laundry'=>'required','harga_per_kg'=>'required|numeric|min:0']);
        $o=Order::create(['customer_id'=>$request->customer_id,'jenis_laundry'=>$request->jenis_laundry,'harga_per_kg'=>$request->harga_per_kg,'catatan'=>$request->catatan,'tanggal_order'=>now(),'status'=>'menunggu_pickup']);
        OrderStatusLog::create(['order_id'=>$o->id,'status'=>'menunggu_pickup','catatan'=>'Order dibuat Admin','actor_id'=>auth()->id(),'actor_type'=>'admin']);
        return back()->with('success',"Order #{$o->id} berhasil dibuat.");
    }
    public function show(Order $order){
        $order->load(['customer','kurirPickup','kurirDelivery','statusLogs','invoice']);
        $kurirList=User::where('role','kurir')->get();
        return view('admin.orders.show',compact('order','kurirList'));
    }
    public function update(Request $request,Order $order){
        $data=[];
        if($request->filled('kurir_pickup_id'))$data['kurir_pickup_id']=$request->kurir_pickup_id;
        if($request->filled('kurir_delivery_id'))$data['kurir_delivery_id']=$request->kurir_delivery_id;
        if($request->filled('jadwal_pickup'))$data['jadwal_pickup']=$request->jadwal_pickup;
        if($request->filled('jadwal_delivery'))$data['jadwal_delivery']=$request->jadwal_delivery;
        if($request->filled('total_berat')){$data['total_berat']=$request->total_berat;$data['total_harga']=$request->total_berat*$order->harga_per_kg;}
        $order->update($data);
        return back()->with('success','Order berhasil diperbarui.');
    }
    public function updateStatus(Request $request,Order $order){
        $request->validate(['status'=>'required']);
        $old=$order->status;
        $upd=['status'=>$request->status];
        if($request->filled('total_berat'))$upd+=['total_berat'=>$request->total_berat,'total_harga'=>$request->total_berat*$order->harga_per_kg];
        $order->update($upd);
        OrderStatusLog::create(['order_id'=>$order->id,'status'=>$request->status,'catatan'=>$request->catatan??"Update dari {$old}",'actor_id'=>auth()->id(),'actor_type'=>'admin']);
        return back()->with('success','Status order diperbarui.');
    }
    public function destroy(Order $order){$order->delete();return redirect()->route('admin.orders.index')->with('success','Order dihapus.');}
}
