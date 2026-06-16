<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    public function landing() {
        if (auth()->check())          return $this->redirectByRole(auth()->user()->role);
        if (auth('customer')->check()) return redirect()->route('customer.dashboard');
        return view('landing');
    }

    public function showLogin() {
        if (auth()->check())          return $this->redirectByRole(auth()->user()->role);
        if (auth('customer')->check()) return redirect()->route('customer.dashboard');
        // Redirect to landing which has the login form embedded
        return redirect()->route('landing');
    }

    public function login(Request $request) {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        $creds = $request->only('email','password');
        if (Auth::guard('customer')->attempt($creds, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('customer.dashboard');
        }
        if (Auth::attempt($creds, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return $this->redirectByRole(auth()->user()->role);
        }
        return redirect()->route('landing')
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput($request->except('password'));
    }

    public function showRegister() {
        if (auth('customer')->check()) return redirect()->route('customer.dashboard');
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|unique:customers,email',
            'no_telp'  => 'required|string|max:20',
            'alamat'   => 'required|string|max:255',
            'password' => 'required|min:8|confirmed',
        ], [
            'nama.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.unique'       => 'Email sudah digunakan, silakan login.',
            'no_telp.required'   => 'No. telepon wajib diisi.',
            'alamat.required'    => 'Alamat wajib diisi.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $customer = Customer::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'no_telp'  => $request->no_telp,
            'alamat'   => $request->alamat,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('customer')->login($customer);
        $request->session()->regenerate();
        return redirect()->route('customer.dashboard')
            ->with('success', 'Selamat datang, '.$customer->nama.'! Akun Anda berhasil dibuat.');
    }

    public function logout(Request $request) {
        Auth::guard('customer')->logout();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }

    private function redirectByRole(string $role) {
        return match($role) {
            'admin'  => redirect()->route('admin.dashboard'),
            'kurir'  => redirect()->route('kurir.dashboard'),
            'owner'  => redirect()->route('owner.dashboard'),
            default  => redirect()->route('landing'),
        };
    }
}
