<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\{Order,Invoice};
class DashboardController extends Controller {
    public function index(){
        $c=auth('customer')->user();
        $activeOrders=Order::where('customer_id',$c->id)->whereNotIn('status',['selesai'])->with('kurirPickup')->latest()->take(3)->get();
        $stats=['order_aktif'=>Order::where('customer_id',$c->id)->whereNotIn('status',['selesai'])->count(),'selesai_bulan'=>Order::where('customer_id',$c->id)->where('status','selesai')->whereRaw("strftime('%Y-%m',tanggal_order)=?",[now()->format('Y-m')])->count(),'total_tagihan'=>Invoice::whereHas('order',fn($q)=>$q->where('customer_id',$c->id))->where('status','unpaid')->sum('total')];
        $recentInvoices=Invoice::whereHas('order',fn($q)=>$q->where('customer_id',$c->id))->with('order')->latest()->take(3)->get();
        return view('customer.dashboard',compact('activeOrders','stats','recentInvoices'));
    }
}
