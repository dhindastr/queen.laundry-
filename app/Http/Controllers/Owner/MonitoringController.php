<?php
namespace App\Http\Controllers\Owner;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MonitoringController extends Controller {
    public function index(Request $request){
        $q=Order::with(['customer','kurirPickup','kurirDelivery'])->latest();
        if($request->status)$q->where('status',$request->status);
        $orders=$q->paginate(20)->withQueryString();
        $summary=Order::select('status',DB::raw('count(*) as total'))->groupBy('status')->get()->keyBy('status');
        return view('owner.monitoring',compact('orders','summary'));
    }
}
