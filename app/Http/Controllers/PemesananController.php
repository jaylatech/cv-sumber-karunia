<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('status', 'Menunggu Konfirmasi')->get();
        return view('pemesanan.index', compact('orders'));
    }

    public function konfirmasiPesanan(Request $request, $konfirmasi_id)
    {

        $order = Order::find($konfirmasi_id);
        $order->update([
            'status' => 'Terkonfirmasi'
        ]);

        Alert::success('Info', "Pemesanan berhasil dikonfirmasi");
        return redirect()->route('admin.pemesanan');
    }

    public function detailPesanan(Request $request, $id)
    {
        $orders = Order::find($id);
        $biayaKirim = $orders->pengiriman()->get('biaya');

        return view('pemesanan.admin-detail-pemesanan', compact('orders', 'biayaKirim'));
    }

    
}
