<?php
namespace App\Http\Controllers\Kurir;
use App\Http\Controllers\Controller;
use App\Models\Order;

class RiwayatController extends Controller {
    public function index(){
        $k = auth()->user();
        $orders = Order::where(function($q) use ($k) {
            $q->where('kurir_pickup_id', $k->id)
              ->orWhere('kurir_delivery_id', $k->id);
        })->with('customer')->latest()->paginate(20);

        $stats = [
            'total_pickup'   => Order::where('kurir_pickup_id', $k->id)->count(),
            'total_delivery' => Order::where('kurir_delivery_id', $k->id)->count(),
            'total_selesai'  => Order::where(function($q) use ($k) {
                $q->where('kurir_pickup_id', $k->id)
                  ->orWhere('kurir_delivery_id', $k->id);
            })->where('status', 'selesai')->count(),
        ];
        return view('kurir.riwayat', compact('orders', 'stats'));
    }
}
