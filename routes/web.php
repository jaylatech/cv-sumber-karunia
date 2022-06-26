<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.admin');
});



Route::get('/login', [AuthController::class, 'loginView'])->middleware('guest')->name('user.login.view');
Route::post('/login', [AuthController::class, 'login'])->name('user.login.auth');
Route::get('/register', [AuthController::class, 'registerView'])->middleware('guest')->name('user.register.view');
Route::post('/register', [AuthController::class, 'register'])->name('user.register.create');
Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');


Route::prefix('produk')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [ProdukController::class, 'adminIndex'])->name('admin.produk.dashboard');
    Route::get('/{id}', [ProdukController::class, 'detailPesanan'])->name('admin.produk.pesanan.detail');
    Route::get('/detail/{id}', [CustomerController::class, 'detailProduk'])->name('admin.produk.detail');
});
Route::prefix('pemesanan')->middleware(['auth', 'admin'])->group(function () {
    Route::post('/{konfirmasi_id}', [PemesananController::class, 'konfirmasiPesanan'])->name('admin.pemesanan.konfirmasi');
    Route::get('/', [PemesananController::class, 'index'])->name('admin.pemesanan');
    Route::get('/{id}', [PemesananController::class, 'detailPesanan'])->name('admin.pemesanan.detail');
});
Route::prefix('pembayaran')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [PembayaranController::class, 'index'])->name('admin.pembayaran');
    Route::get('/{id}', [PembayaranController::class, 'pembayaranDetail'])->name('admin.pembayaran.detail');
    Route::post('/konfirmasi/{id}', [PembayaranController::class, 'konfirmasiPembayaran'])->name('admin.pembayaran.konfirmasi');
});

Route::get('pembayaran/bukti/{bukti_pembayaran}', [PembayaranController::class, 'lihatBuktiPembayaran'])->name('admin.pembayaran.bukti');

Route::prefix('riwayat')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [RiwayatController::class, 'index'])->name('admin.riwayat');
    Route::get('/{id}', [RiwayatController::class, 'detailRiwayat'])->name('admin.riwayat.detail');
});
Route::prefix('pengiriman')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [PengirimanController::class, 'index'])->name('admin.pengiriman');
    Route::get('/{id}', [PengirimanController::class, 'detailPengiriman'])->name('admin.pengiriman.detail');
    Route::post('/update/{id}', [PengirimanController::class, 'updatePengirman'])->name('admin.pengiriman.update');
});

// user
Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/profil', [UserController::class, 'index'])->name('user.profil');
    Route::post('/updatePhoto', [UserController::class, 'uploadPhoto'])->name('user.photo.save');
    Route::post('/updateProfil', [UserController::class, 'updateProfil'])->name('user.profil.update');
});

// Customer
Route::prefix('customer')->middleware(['auth', 'customer'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboardView'])->name('customer.dashboard');
    Route::prefix('produk')->group(function () {
        Route::get('/', [CustomerController::class, 'produkView'])->name('customer.produk');
        Route::get('/{id}', [CustomerController::class, 'detailProduk'])->name('customer.produk.detail');
    });

    Route::prefix('keranjang')->group(function () {
        Route::get('/{id}', [CustomerController::class, 'keranjangView'])->name('customer.keranjang');
        Route::post('/', [CustomerController::class, 'tambahKeranjang'])->name('customer.keranjang.tambah');
        Route::post('/qty/{keranjang_id}', [CustomerController::class, 'updateJumlahKeranjang'])->name('customer.keranjang.update.stok');
        Route::delete('/hapus/{keranjang_id}', [CustomerController::class, 'hapusKeranjang'])->name('customer.keranjang.delete');
    });

    Route::prefix('pemesanan')->group(function () {
        Route::get('/', [CustomerController::class, 'pemesananView'])->name('customer.pemesanan');
        Route::get('/{id}', [CustomerController::class, 'pemesananDetailView'])->name('customer.pemesanan.detail');
        Route::post('/pesan', [CustomerController::class, 'buatPesanan'])->name('customer.pemesanan.create');
        Route::post('/ongkir', [CustomerController::class, 'cekOngkir'])->name('customer.pemesanan.ongkir');
        Route::post('/batal', [CustomerController::class, 'batalkanPesanan'])->name('customer.pemesanan.rollback');
    });


    Route::prefix('pembayaran')->group(function () {
        Route::post('/create', [CustomerController::class, 'bayarPesanan'])->name('customer.pembayaran.create');
        Route::post('/{pembayaran_id}', [CustomerController::class, 'bayarOrder'])->name('customer.pembayaran.bayar');
        Route::get('/', [CustomerController::class, 'pembayaranView'])->name('customer.pembayaran');
        Route::get('/{id}', [CustomerController::class, 'detailPembayaranView'])->name('customer.pembayaran.detail');
    });

    Route::prefix('riwayat')->group(function () {
        Route::get('/', [CustomerController::class, 'riwayatView'])->name('customer.riwayat');
        Route::get('/{id}', [CustomerController::class, 'detailRiwayat'])->name('customer.riwayat.detail');
    });
});

Route::prefix('invoice')->middleware(['auth', 'customer'])->group(function(){
    Route::get('/{id}', [PembayaranController::class, 'viewInvoice'])->name('invoice.index');
});

// Super Admin
Route::prefix('sp')->middleware(['auth', 'sp'])->group(function () {
    Route::get('/', [SuperAdminController::class, 'index'])->name('sp.users');
    Route::get('/create', [SuperAdminController::class, 'tambahUserView'])->name('sp.users.create.view');
    Route::post('/create', [SuperAdminController::class, 'tambahUser'])->name('sp.users.create');
    Route::get('/{id}', [SuperAdminController::class, 'userDetail'])->name('sp.users.detail');
    Route::get('/edit/{id}', [SuperAdminController::class, 'userDetailEdit'])->name('sp.users.edit');
    Route::patch('/edit/save', [SuperAdminController::class, 'editUser'])->name('sp.users.edit');
    Route::delete('/delete/{id}', [SuperAdminController::class, 'deleteUser'])->name('sp.users.delete');
});

// gudang
Route::prefix('gudang')->middleware(['auth', 'gudang'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [ProdukController::class, 'gudangDashboard'])->name('gudang.dashboard');
    });
    Route::prefix('produk')->group(function () {
        Route::get('/create', [ProdukController::class, 'tambahProdukView'])->name('gudang.produk.create');
        Route::post('/', [ProdukController::class, 'tambahProduk'])->name('gudang.produk.save');
        Route::get('/edit/{id}', [ProdukController::class, 'editProdukView'])->name('gudang.edit.view');
        Route::post('/edit/{id}', [ProdukController::class, 'editProdukSave'])->name('gudang.edit.save');
        Route::delete('/{id}', [ProdukController::class, 'deleteProdukById'])->name('gudang.produk.delete');
        Route::get('/', [ProdukController::class, 'gudangProduk'])->name('gudang.produk');
        Route::get('/{id}', [ProdukController::class, 'viewProdukById'])->name('gudang.produk.view');
    });
});

// Pemilik
Route::prefix('pemilik')->middleware(['auth', 'pemilik'])->group(function(){
    Route::get('/', [DashboardController::class, 'indexPemilik'])->name('dashboard.pemilik');
    Route::get('/laporan', [DashboardController::class, 'viewLaporan'])->name('laporan.view');
    Route::post('/', [DashboardController::class, 'downloadLaporan'])->name('dashboard.pemilik.download');
});
