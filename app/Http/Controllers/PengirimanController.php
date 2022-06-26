<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    public function index()
    {
        $pengirimans = Pengiriman::whereNotNull('keterangan')->get();
        
        return view('pengiriman.index', compact('pengirimans'));
    }

    public function detailPengiriman(Request $request, $id){
        $pengiriman = Pengiriman::find($id);
        $pembayaran = $pengiriman->order->pembayaran;
        

        return view('pengiriman.detail-pengiriman', compact('pembayaran', 'pengiriman'));
    }

    public function updatePengirman(Request $request, $id){
        $pengiriman = Pengiriman::find($id);

        $pengiriman->update([
            'keterangan' => $request->status_pengiriman
        ]);

        Alert::success('Info', 'Pengiriman berhasil di update');
        return redirect()->route('admin.pengiriman');
    }
}
