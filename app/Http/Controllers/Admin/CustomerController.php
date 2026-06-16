<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class CustomerController extends Controller {
    public function index(Request $request){
        $q=Customer::withCount('orders');
        if($request->search)$q->where('nama','like',"%{$request->search}%");
        $customers=$q->latest()->paginate(15)->withQueryString();
        return view('admin.customers.index',compact('customers'));
    }
    public function store(Request $request){
        $request->validate(['nama'=>'required','email'=>'required|email|unique:customers,email','password'=>'required|min:6','no_telp'=>'nullable','alamat'=>'nullable']);
        Customer::create([...$request->only('nama','email','no_telp','alamat'),'password'=>Hash::make($request->password)]);
        return back()->with('success','Customer berhasil ditambahkan.');
    }
    public function show(Customer $customer){$customer->load('orders');return view('admin.customers.show',compact('customer'));}
    public function update(Request $request,Customer $customer){
        $request->validate(['nama'=>'required','email'=>'required|email|unique:customers,email,'.$customer->id]);
        $d=$request->only('nama','email','no_telp','alamat');
        if($request->filled('password'))$d['password']=Hash::make($request->password);
        $customer->update($d);return back()->with('success','Customer diperbarui.');
    }
    public function destroy(Customer $customer){$customer->delete();return redirect()->route('admin.customers.index')->with('success','Customer dihapus.');}
}
