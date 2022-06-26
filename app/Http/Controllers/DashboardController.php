<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produks = OrderDetail::with('produk')->orderBy('jumlah', 'DESC')->limit(2)->get();

        return view('dashboard.index', compact('produks'));
    }

    public function indexPemilik()
    {

        $laporans = OrderDetail::with('produk')->get();
        $totalBarang = 0;
        $totalHarga = 0;
        $tanggalAwal = '';
        $tanggalSekarang = '';

        if (count($laporans) > 0) {
            $tanggalAwal = $laporans[0]->created_at->format('M d Y');
            $tanggalSekarang = Carbon::now()->format('M d Y');


            foreach ($laporans as $key => $laporan) {
                $totalBarang = $totalBarang + $laporan->jumlah;
                $totalHarga = $totalHarga + $laporan->sub_total;
            }
        }


        return view('pemilik.index', compact(
            'laporans',
            'totalBarang',
            'totalHarga',
            'tanggalAwal',
            'tanggalSekarang'
        ));
    }

    public function viewLaporan()
    {
        $laporans = OrderDetail::with('produk')->get();
        $totalBarang = 0;
        $totalHarga = 0;
        $tanggalAwal = $laporans[0]->created_at->format('M d Y');
        $tanggalSekarang = Carbon::now()->format('M d Y');


        foreach ($laporans as $key => $laporan) {
            $totalBarang = $totalBarang + $laporan->jumlah;
            $totalHarga = $totalHarga + $laporan->sub_total;
        }

        return view('pemilik.laporan', compact(
            'laporans',
            'totalBarang',
            'totalHarga',
            'tanggalAwal',
            'tanggalSekarang'
        ));
    }

    public function downloadLaporan()
    {
        $laporans = OrderDetail::with('produk')->get();
        $totalBarang = 0;
        $totalHarga = 0;
        $tanggalAwal = $laporans[0]->created_at->format('M d Y');
        $tanggalSekarang = Carbon::now()->format('M d Y');

        foreach ($laporans as $key => $laporan) {
            $totalBarang = $totalBarang + $laporan->jumlah;
            $totalHarga = $totalHarga + $laporan->sub_total;
        }

        $pdf = PDF::loadView('pemilik.laporan', compact(
            'laporans',
            'totalBarang',
            'totalHarga',
            'tanggalAwal',
            'tanggalSekarang'
        ));

        return $pdf->download("laporan $tanggalAwal,$tanggalSekarang" . '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
