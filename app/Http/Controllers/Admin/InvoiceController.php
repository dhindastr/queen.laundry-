<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Invoice,Order};
use Illuminate\Http\Request;
class InvoiceController extends Controller {
    public function index(){
        $invoices=Invoice::with('order.customer')->latest()->paginate(15);
        $pendingOrders=Order::where('status','selesai')->doesntHave('invoice')->with('customer')->get();
        return view('admin.invoice.index',compact('invoices','pendingOrders'));
    }
    public function generate(Request $request){
        $request->validate(['order_id'=>'required|exists:orders,id']);
        $order=Order::findOrFail($request->order_id);
        if($order->invoice)return back()->withErrors(['Invoice sudah ada untuk order ini.']);
        $no='INV-'.str_pad(Invoice::count()+1,4,'0',STR_PAD_LEFT).'-'.date('mY');
        Invoice::create(['no_invoice'=>$no,'order_id'=>$order->id,'subtotal'=>$order->total_harga,'total'=>$order->total_harga,'status'=>'paid','tanggal_bayar'=>now()]);
        return back()->with('success',"Invoice {$no} berhasil dibuat.");
    }
    public function show(Invoice $invoice){$invoice->load('order.customer');return view('admin.invoice.show',compact('invoice'));}
    public function pdf(Invoice $invoice){$invoice->load('order.customer');return view('admin.invoice.pdf',compact('invoice'));}
}
