<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
class InvoiceController extends Controller {
    public function index(){
        $c=auth('customer')->user();
        $invoices=Invoice::whereHas('order',fn($q)=>$q->where('customer_id',$c->id))->with('order')->latest()->paginate(15);
        return view('customer.invoice',compact('invoices'));
    }
    public function show(Invoice $invoice){
        abort_unless($invoice->order->customer_id==auth('customer')->id(),403);
        $invoice->load('order.customer');
        return view('customer.invoice-show',compact('invoice'));
    }
    public function pdf(Invoice $invoice){
        abort_unless($invoice->order->customer_id==auth('customer')->id(),403);
        $invoice->load('order.customer');
        return view('admin.invoice.pdf',compact('invoice'));
    }
}
