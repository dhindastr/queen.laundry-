<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class KurirController extends Controller {
    public function index(){
        $kurirList=User::where('role','kurir')->withCount(['ordersAsPickup','ordersAsDelivery'])->get();
        return view('admin.kurir.index',compact('kurirList'));
    }
    public function store(Request $request){
        $request->validate(['name'=>'required','email'=>'required|email|unique:users,email','password'=>'required|min:6']);
        User::create([...$request->only('name','email','no_telp','kendaraan'),'role'=>'kurir','password'=>Hash::make($request->password)]);
        return back()->with('success','Kurir berhasil ditambahkan.');
    }
    public function update(Request $request,User $kurir){
        $request->validate(['name'=>'required','email'=>'required|email|unique:users,email,'.$kurir->id]);
        $d=$request->only('name','email','no_telp','kendaraan');
        if($request->filled('password'))$d['password']=Hash::make($request->password);
        $kurir->update($d);return back()->with('success','Data kurir diperbarui.');
    }
    public function destroy(User $kurir){$kurir->delete();return redirect()->route('admin.kurir.index')->with('success','Kurir dihapus.');}
}
