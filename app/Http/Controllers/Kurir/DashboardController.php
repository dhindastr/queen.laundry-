<?php
namespace App\Http\Controllers\Kurir;
use App\Http\Controllers\Controller;
use App\Models\{Order,OrderStatusLog};

class DashboardController extends Controller {
    public function index(){
        $k = auth()->user();
        $pickupQueue = Order::where('kurir_pickup_id', $k->id)
            ->whereIn('status', ['menunggu_pickup','pickup'])
            ->with('customer')->latest()->get();
        $deliveryQueue = Order::where('kurir_delivery_id', $k->id)
            ->whereIn('status', ['siap_delivery','delivery'])
            ->with('customer')->latest()->get();
        $todayDone = Order::where(function($q) use ($k) {
            $q->where('kurir_pickup_id', $k->id)
              ->orWhere('kurir_delivery_id', $k->id);
        })->where('status','selesai')->whereDate('updated_at', today())->count();
        $recentLogs = OrderStatusLog::where('actor_id', $k->id)
            ->where('actor_type','kurir')
            ->with('order.customer')->latest()->take(5)->get();
        return view('kurir.dashboard', compact('pickupQueue','deliveryQueue','todayDone','recentLogs'));
    }
}
