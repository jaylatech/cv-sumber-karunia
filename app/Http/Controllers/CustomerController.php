<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Pembayaran;
use App\Models\Pengiriman;
use App\Models\Riwayat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function dashboardView()
    {
        $produks = OrderDetail::with('produk')->orderBy('jumlah', 'DESC')->limit(2)->get();
        return view('dashboard.customer-dashboard', compact('produks'));
    }

    public function produkView()
    {
        $produks = Produk::paginate(6);

        return view('produk.customer-produk', compact('produks'));
    }

    public function detailProduk($id)
    {
        $produk = Produk::with(['stok', 'photos', 'kategoris'])->where('id', $id)->get()[0];

        return view('produk.customer-produk-detail', compact('produk'));
    }

    public function cekOngkir(Request $request)
    {
        $response = Http::withHeaders([
            'key' => env('RAJA_ONGKIR_API_KEY'),
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])->asForm()->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => 42,
            'destination' => $request->alamat_tujuan,
            'weight' => $request->berat_pengiriman,
            'courier' => 'jne'
        ]);


        $order = Order::find($request->order_id);
        $pengiriman = $order->pengiriman()->get()[0];

        $order->update([
            'tanggal_pengiriman' => $request->waktu_pengiriman,
            'catatan_pengiriman' => $request->catatan
        ]);

        $pengiriman->update([
            'biaya' => $response['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'],
            'alamat_pengiriman' => 'Banyuwangi',
            'tujuan_pengiriman' => $response['rajaongkir']['destination_details']['city_name']
        ]);

        return back();
    }

    public function bayarPesanan(Request $request)
    {
        $order = Order::find($request->id_pemesanan);
        $pembayaran = $order->pembayaran()->get()[0];
        $pembayaran->update([
            'total' => $request->total_biaya
        ]);

        Alert::success('Info', "Lanjutkan proses pembayaran");
        return redirect()->route('customer.pembayaran');
    }

    public function buatPesanan(Request $request)
    {
        $orders = $request->user()->keranjangs()->get();
        if (count($orders) === 0) {
            Alert::error('Info', "Keranjang masih kosong");
            return back();
        } else if (count($orders) > 0) {

            DB::transaction(function () use ($orders, $request) {
                $pesanan = [];
                $total = 0;
                $berat = 0;
                foreach ($orders as $key => $order) {
                    $detailOrder = OrderDetail::create([
                        'produk_id' => $order->produk_id,
                        'jumlah' => $order->jumlah,
                        'harga' => $order->harga,
                        'berat' => $order->berat,
                        'sub_total' => $order->sub_total
                    ]);

                    $total = $total + $order->sub_total;
                    $berat = $berat + $order->berat;

                    array_push($pesanan, $detailOrder);
                }

                // Create Order
                $barangPesanan = Order::create([
                    'total' => $total,
                    'berat' => $berat
                ]);

                // Relasi dengan detail order
                $barangPesanan->orderDetails()->saveMany($pesanan);

                // buat pembayaran
                $pembayaran = Pembayaran::create([
                    'total' => $total,
                    'status' => 'Belum dibayar',
                ]);

                // buat pengiriman
                $pengiriman = Pengiriman::create([]);

                // relasi dengan user
                $request->user()->orders()->save($barangPesanan);

                $barangPesanan->pembayaran()->save($pembayaran);
                $barangPesanan->pengiriman()->save($pengiriman);

                // hapus Keranjang
                $request->user()->keranjangs()->delete();
            });

            Alert::success('Info', "Pemesanan berhasil dibuat");

            $orders = Order::with(['orderDetails'])->where('user_id', $request->user()->id)->get();

            return redirect()->route('customer.pemesanan', compact('orders'));
        }
    }

    public function batalkanPesanan(Request $request)
    {
        $orders = $request->user()->orders()->get();
        dd($orders);
        // $keranjang = Keranjang::find($id);
        // $produk = Produk::find($keranjang->produk_id);

        // $produk->stok()->update(
        //     [
        //         'stok' => $produk->stok->stok + $keranjang->jumlah
        //     ]
        // );

        Alert::success('Info', "Pemesanan berhasil dibatalkan");
        return redirect()->route('customer.produk');
    }

    public function pemesananDetailView(Request $request, $id)
    {
        $orders = Order::find($id);
        $biayaKirim = $orders->pengiriman()->get('biaya');

        $response = Http::withHeaders([
            'key' => env('RAJA_ONGKIR_API_KEY'),
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])->get('https://api.rajaongkir.com/starter/city');


        $data_kota = $response['rajaongkir']['results'];

        return view('pemesanan.customer-detail-pemesanan', compact('orders', 'biayaKirim', 'data_kota'));
    }

    public function pemesananView(Request $request)
    {
        $orders = $request->user()->orders()->get();

        return view('pemesanan.customer-pemesanan', compact('orders'));
    }

    public function pembayaranView(Request $request)
    {
        $orders = Order::with(['orderDetails'])->where('user_id', $request->user()->id)
            ->where('status', 'Terkonfirmasi')->get();

        return view('pembayaran.customer-pembayaran', compact('orders'));
    }

    public function detailPembayaranView(Request $request, $id)
    {
        $orders = Order::find($id);

        return view('pembayaran.customer-detail-pembayaran', compact('orders'));
    }

    public function bayarOrder(Request $request, $pembayaran_id)
    {
        $pembayaran = Pembayaran::find($pembayaran_id);

        $filePath = Storage::disk('local')->put('images', $request->bukti_pembayaran);

        $fileName = explode('/', $filePath)[1];

        $pembayaran->update([
            'path' => $fileName,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => 'Menunggu Konfirmasi'
        ]);

        Alert::success('Info', "Pesanan berhasil dibayar, silahkan tunggu konfirmasi pembayaran");
        return redirect()->route('customer.pembayaran');
    }

    public function keranjangView(Request $request, $id)
    {
        $keranjang = $request->user()->keranjangs()->get();

        return view('keranjang.customer-keranjang', compact('keranjang'));
    }

    public function updateJumlahKeranjang(Request $request, $id)
    {
        $keranjang = Keranjang::find($id);
        $produk = Produk::find($keranjang->produk_id);

        if ($request->jumlah > $keranjang->jumlah) {
            $produk->stok()->update([
                'stok' => $produk->stok->stok - (abs($keranjang->jumlah - $request->jumlah))
            ]);
            $keranjang->update([
                'jumlah' => $request->jumlah,
                'sub_total' => $keranjang->harga * $request->jumlah
            ]);
        } else if ($request->jumlah < $keranjang->jumlah) {
            $produk->stok()->update(
                [
                    'stok' => $produk->stok->stok + abs($keranjang->jumlah - $request->jumlah)
                ]
            );
            $keranjang->update([
                'jumlah' => $request->jumlah,
                'sub_total' => $keranjang->harga * $request->jumlah
            ]);
        }


        Alert::success('Info', "Jumlah pesanan berhasil di update");
        return back();
    }

    public function hapusKeranjang(Request $request, $id)
    {
        $keranjang = Keranjang::find($id);
        $produk = Produk::find($keranjang->produk_id);

        $produk->stok()->update(
            [
                'stok' => $produk->stok->stok + $keranjang->jumlah
            ]
        );

        $keranjang->delete();

        Alert::success('Info', "Pesanan berhasil di hapus");
        return back();
    }

    public function tambahKeranjang(Request $request)
    {
        $user = $request->user();
        $produk = Produk::find($request->produk_id);

        Keranjang::create([
            'user_id' => $user->id,
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'harga' => $produk->harga,
            'berat' => $produk->berat,
            'sub_total' => $produk->harga * $request->jumlah
        ]);

        $produk->stok()->update(['stok' => $produk->stok->stok - $request->jumlah]);

        Alert::success('Info', "Produk $produk->nama ditambahkan ke keranjang");
        return back();
    }

    public function riwayatView(Request $request)
    {

        $histories = Riwayat::where('user_id', $request->user()->id)->get();

        return view('riwayat.customer-riwayat', compact('histories'));
    }

    public function detailRiwayat(Request $request, $id)
    {
        $riwayat = Riwayat::find($id)->order;

        return view('riwayat.customer-detail-riwayat', compact('riwayat'));
    }
}
