<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\Order;
class RiwayatController extends Controller {
    public function index(){
        $c=auth('customer')->user();
        $orders=Order::where('customer_id',$c->id)->latest()->paginate(20);
        $stats=['total_order'=>Order::where('customer_id',$c->id)->count(),'total_berat'=>Order::where('customer_id',$c->id)->sum('total_berat'),'total_belanja'=>Order::where('customer_id',$c->id)->where('status','selesai')->sum('total_harga')];
        return view('customer.riwayat',compact('orders','stats'));
    }
}
