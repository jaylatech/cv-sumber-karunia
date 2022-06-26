<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Riwayat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    // Gudang
    public function gudangDashboard()
    {
        $stokSedikit = Stok::with('produk')->orderBy('stok', 'ASC')->limit(3)->get();
        $stokBanyak = Stok::with('produk')->orderBy('stok', 'DESC')->limit(3)->get();
        $banyakTerjual = OrderDetail::with('produk')->orderBy('jumlah', 'DESC')->limit(3)->get();
        $sedikitTerjual = OrderDetail::with('produk')->orderBy('jumlah', 'ASC')->limit(3)->get();
        
        return view('dashboard.index-gudang', compact('stokSedikit', 'stokBanyak', 'banyakTerjual', 'sedikitTerjual'));
    }

    public function gudangProduk()
    {
        $produks = Produk::paginate(10);

        return view('produk.index-gudang', compact('produks'));
    }

    public function tambahProdukView()
    {
        $kategoris = Kategori::all();

        return view('produk.index-gudang-create', compact('kategoris'));
    }

    public function viewProdukById(Request $request, $id)
    {
        $produk = Produk::with(['stok', 'photos', 'kategoris'])->where('id', $id)->get()[0];

        return view('produk.index-gudang-view', compact('produk'));
    }

    public function tambahProduk(Request $request)
    {
        $produkBaru = Produk::create([
            'kode_produk' => $request->product_id,
            'nama' => $request->name,
            'harga' => $request->harga,
            'berat' => $request->berat,
            'masa_penyimpanan' => $request->kadaluarsa,
            'deskripsi' => $request->deskripsi
        ]);

        $produkBaru_stok = Stok::create(['stok' => $request->stok]);
        $produkBaru->kategoris()->attach($request->kategori);
        $produkBaru->stok()->save($produkBaru_stok);
        $fotos = $this->simpanFoto(
            $request->image1,
            $request->image2,
            $request->image3
        );
        $produkBaru->photos()->saveMany($fotos);

        Alert::success('Info', 'Tambah Produk Berhasil');
        return redirect()->route('gudang.produk');
    }

    public function simpanFoto($gambar1 = null, $gambar2 = null, $gambar3 = null)
    {
        $filePath1 = Storage::disk('local')->put('images', $gambar1);
        $filePath2 = Storage::disk('local')->put('images', $gambar2);
        $filePath3 = Storage::disk('local')->put('images', $gambar3);

        $fileName1 = explode('/', $filePath1)[1];
        $fileName2 = explode('/', $filePath2)[1];
        $fileName3 = explode('/', $filePath3)[1];

        $foto1 = Foto::create(['path' => $fileName1]);
        $foto2 = Foto::create(['path' => $fileName2]);
        $foto3 = Foto::create(['path' => $fileName3]);

        return [$foto1, $foto2, $foto3];
    }

    public function editProdukView($id)
    {
        $produk = Produk::with(['stok', 'photos', 'kategoris'])->where('id', $id)->get()[0];
        $kategoris = Kategori::all();
        $fotos = $produk->photos()->get('path');
        
        
        return view('produk.edit-gudang', compact('produk', 'kategoris', 'fotos'));
    }

    public function editProdukSave(Request $request, $id)
    {
        $produk = Produk::find($id);

        $produk->kategoris()->detach();

        $produk->kategoris()->attach($request->kategori);
        $produk->stok()->update(['stok' => $request->stok]);

        if (isset($request->image1) || isset($request->image2) || isset($request->image3)) {
            $produk->photos()->delete();

            $fotos = $this->simpanFoto(
                $request->image1,
                $request->image2,
                $request->image3
            );
            $produk->photos()->saveMany($fotos);
        }

        Alert::success('Info', "Produk $produk->nama berhasil di update");
        return redirect()->route('gudang.produk');
    }

    public function deleteProdukById(Request $request, $id)
    {
        $produk = Produk::find($id);

        $produk->kategoris()->detach();
        $produk->stok()->delete();
        $produk->photos()->delete();

        $produk->delete();

        Alert::success('Info', "Produk $produk->nama telah dihapus");
        return back();
    }


    // Admin
    public function adminIndex(){
        return view('produk.index');
    }
}
