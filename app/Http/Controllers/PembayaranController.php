<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesanan = Pembayaran::where('status', 'Menunggu Konfirmasi')->get();
        
        return view('pembayaran.index', compact('pesanan'));
    }

    public function pembayaranDetail(Request $request, $id){
        $pembayaran = Pembayaran::find($id);

        return view('pembayaran.detail-pembayaran', compact('pembayaran'));
    }

    public function lihatBuktiPembayaran(Request $request, $bukti_pembayaran){
        $pembayaran = Pembayaran::find($bukti_pembayaran);

        return Storage::download("images/$pembayaran->path");
    }

    public function viewInvoice(Request $request, $id){
        $riwayat = Riwayat::find($id);
        $order = $riwayat->order()->get();
        $orderDetails = $riwayat->order->orderDetails()->get();
        $user = $riwayat->order->user()->get();
        $pembayaran = $riwayat->order->pembayaran()->get();
        $pengiriman = $riwayat->order->pengiriman()->get();
        
        
        $pdf = PDF::loadView('pembayaran.invoice', compact(
            'order', 'orderDetails', 'user', 'pembayaran', 'pengiriman'
        ));

        return $pdf->download("invoice " . $pembayaran[0]->updated_at . '.pdf');

        // return view('pembayaran.invoice', compact(
        //     'order', 'orderDetails', 'user', 'pembayaran', 'pengiriman'
        // ));
    }

    public function konfirmasiPembayaran(Request $request, $id)
    {
        $pembayaran = Pembayaran::find($id);
        $order = $pembayaran->order;
        
        $pembayaran->update([
            'status' => 'Terkonfirmasi'
        ]);

        $pembayaran->order->pengiriman->update([
            'keterangan' => 'Diproses'
        ]);

        $riwayat = Riwayat::create([
            'user_id' => $order->user->id,
            'order_id' => $order->id
        ]);

        $order->riwayat()->save($riwayat);
        

        Alert::success('Info', "Pembayaran berhasil dikonfirmasi");
        return redirect()->route('admin.pembayaran');
    }
}
