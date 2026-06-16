<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
class OrderController extends Controller {
    public function index(Request $request){
        $c=auth('customer')->user();
        $q=Order::where('customer_id',$c->id)->latest();
        if($request->status)$q->where('status',$request->status);
        $orders=$q->paginate(15)->withQueryString();
        return view('customer.orders',compact('orders'));
    }
    public function show(Order $order){
        abort_unless($order->customer_id==auth('customer')->id(),403);
        $order->load(['statusLogs','kurirPickup','kurirDelivery','invoice']);
        return view('customer.order-show',compact('order'));
    }
}
