<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $histories = Riwayat::all();
        return view('riwayat.index', compact('histories'));
    }

    public function detailRiwayat(Request $request, $id)
    {
        $riwayat = Riwayat::find($id)->order;

        return view('riwayat.detail-riwayat', compact('riwayat'));
    }
}
