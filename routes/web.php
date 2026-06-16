<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Customer as CustomerCtrl;
use App\Http\Controllers\Kurir;
use App\Http\Controllers\Owner;

// ── Public ────────────────────────────────────────────────
Route::get('/',          [AuthController::class, 'landing'])->name('landing');
Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',    [AuthController::class, 'login'])->name('login.post');
Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');

// ── Admin ─────────────────────────────────────────────────
Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard',  [Admin\DashboardController::class,'index'])->name('dashboard');
    Route::get('orders',     [Admin\OrderController::class,'index'])->name('orders.index');
    Route::post('orders',    [Admin\OrderController::class,'store'])->name('orders.store');
    Route::get('orders/{order}',        [Admin\OrderController::class,'show'])->name('orders.show');
    Route::put('orders/{order}',        [Admin\OrderController::class,'update'])->name('orders.update');
    Route::post('orders/{order}/status',[Admin\OrderController::class,'updateStatus'])->name('orders.status');
    Route::delete('orders/{order}',     [Admin\OrderController::class,'destroy'])->name('orders.destroy');
    Route::get('customers',             [Admin\CustomerController::class,'index'])->name('customers.index');
    Route::post('customers',            [Admin\CustomerController::class,'store'])->name('customers.store');
    Route::get('customers/{customer}',  [Admin\CustomerController::class,'show'])->name('customers.show');
    Route::put('customers/{customer}',  [Admin\CustomerController::class,'update'])->name('customers.update');
    Route::delete('customers/{customer}',[Admin\CustomerController::class,'destroy'])->name('customers.destroy');
    Route::get('kurir',                 [Admin\KurirController::class,'index'])->name('kurir.index');
    Route::post('kurir',                [Admin\KurirController::class,'store'])->name('kurir.store');
    Route::put('kurir/{kurir}',         [Admin\KurirController::class,'update'])->name('kurir.update');
    Route::delete('kurir/{kurir}',      [Admin\KurirController::class,'destroy'])->name('kurir.destroy');
    Route::get('stok',                  [Admin\StokController::class,'index'])->name('stok.index');
    Route::post('stok',                 [Admin\StokController::class,'store'])->name('stok.store');
    Route::put('stok/{stok}',           [Admin\StokController::class,'update'])->name('stok.update');
    Route::delete('stok/{stok}',        [Admin\StokController::class,'destroy'])->name('stok.destroy');
    Route::get('invoice',               [Admin\InvoiceController::class,'index'])->name('invoice.index');
    Route::post('invoice/generate',     [Admin\InvoiceController::class,'generate'])->name('invoice.generate');
    Route::get('invoice/{invoice}',     [Admin\InvoiceController::class,'show'])->name('invoice.show');
    Route::get('invoice/{invoice}/pdf', [Admin\InvoiceController::class,'pdf'])->name('invoice.pdf');
    Route::get('laporan',               [Admin\LaporanController::class,'index'])->name('laporan.index');
});

// ── Customer ──────────────────────────────────────────────
Route::middleware('role:customer')->prefix('customer')->name('customer.')->group(function () {
    Route::get('dashboard',             [CustomerCtrl\DashboardController::class,'index'])->name('dashboard');
    Route::get('pickup',                [CustomerCtrl\PickupController::class,'create'])->name('pickup.create');
    Route::post('pickup',               [CustomerCtrl\PickupController::class,'store'])->name('pickup.store');
    Route::get('orders',                [CustomerCtrl\OrderController::class,'index'])->name('orders.index');
    Route::get('orders/{order}',        [CustomerCtrl\OrderController::class,'show'])->name('orders.show');
    Route::get('invoice',               [CustomerCtrl\InvoiceController::class,'index'])->name('invoice.index');
    Route::get('invoice/{invoice}',     [CustomerCtrl\InvoiceController::class,'show'])->name('invoice.show');
    Route::get('invoice/{invoice}/pdf', [CustomerCtrl\InvoiceController::class,'pdf'])->name('invoice.pdf');
    Route::get('riwayat',               [CustomerCtrl\RiwayatController::class,'index'])->name('riwayat.index');
});

// ── Kurir ─────────────────────────────────────────────────
Route::middleware('role:kurir')->prefix('kurir')->name('kurir.')->group(function () {
    Route::get('dashboard',             [Kurir\DashboardController::class,'index'])->name('dashboard');
    Route::get('pickup',                [Kurir\PickupController::class,'index'])->name('pickup.index');
    Route::post('pickup/{order}/konfirmasi',[Kurir\PickupController::class,'konfirmasi'])->name('pickup.konfirmasi');
    Route::get('delivery',              [Kurir\DeliveryController::class,'index'])->name('delivery.index');
    Route::post('delivery/{order}/konfirmasi',[Kurir\DeliveryController::class,'konfirmasi'])->name('delivery.konfirmasi');
    Route::get('riwayat',               [Kurir\RiwayatController::class,'index'])->name('riwayat.index');
});

// ── Owner ─────────────────────────────────────────────────
Route::middleware('role:owner')->prefix('owner')->name('owner.')->group(function () {
    Route::get('dashboard',             [Owner\DashboardController::class,'index'])->name('dashboard');
    Route::get('pemasukan',             [Owner\PemasukanController::class,'index'])->name('pemasukan.index');
    Route::get('pengeluaran',           [Owner\PengeluaranController::class,'index'])->name('pengeluaran.index');
    Route::post('pengeluaran',          [Owner\PengeluaranController::class,'store'])->name('pengeluaran.store');
    Route::get('monitoring',            [Owner\MonitoringController::class,'index'])->name('monitoring.index');
    Route::get('stok',                  [Owner\StokController::class,'index'])->name('stok.index');
    Route::get('laporan',               [Owner\LaporanController::class,'index'])->name('laporan.index');
});
