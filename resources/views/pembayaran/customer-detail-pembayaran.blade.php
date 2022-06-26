@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>Pembayaran</title>
@endpush

@php
use App\Models\Produk;
@endphp

@section('content')
    @include('partials.header')
    @include('partials.menu')
    @include('partials.menu2')

    @php

    @endphp

    <div class="pembayaran">
        <div class="pembayaran-left">
            <form action="">
                <div class="mb-3 input__item">
                    <label for="id_pemesanan">ID Pemesanan</label>
                    <input type="text" id="id_pemesanan" name="id_pemesanan" value={{ $orders->id }} disabled>
                </div>

                <div class="mb-3 input__item">
                    <label for="nama">Nama Pembeli</label>
                    <input type="text" id="nama" name="nama" value="{{ Auth::user()->name }}" disabled>
                </div>

                <div class="mb-3 input__item">
                    <label for="phone">No. Telepon</label>
                    <input type="text" id="phone" name="phone" value={{ Auth::user()->telepon }} disabled>
                </div>

                <div class="mb-3 input__item">
                    <label for="ongkir">Biaya Ongkir</label>
                    <input type="text" id="ongkir" name="ongkir" value={{ $orders->pengiriman->biaya }} disabled>
                </div>

                <div class="mb-3 input__item">
                    <label for="alamat_tujuan">Alamat Tujuan</label>
                    <input type="text" id="alamat_tujuan" name="alamat_tujuan" value="Denpasar" disabled>
                </div>

                <div class="mb-3 input__item">
                    <label for="" class="total_pesanan">Produk dipesan</label>

                    <div class="total_pesanan_list">
                        <ul>
                            @foreach ($orders->orderDetails()->get() as $item)
                                <li>- {{ $item->produk->nama }} - Rp. {{ $item->produk->harga }} x {{$item->jumlah}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </form>
        </div>
        <div class="pembayaran-right">
            <form action="{{ route('customer.pembayaran.bayar', ['pembayaran_id' => $orders->pembayaran->id]) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-3 input__item">
                    <label for="total_bayar">Jumlah Pembayaran</label>
                    <input type="text" id="total_bayar" value="{{ $orders->pembayaran->total }}" name="total_bayar"
                        disabled>
                </div>

                <div class="mb-3 input__item">
                    <label for="id_pembayaran">ID Pembayaran</label>
                    <input type="text" id="id_pembayaran" value={{ $orders->pembayaran->id }} name="id_pembayaran"
                        disabled>
                </div>

                @if ($orders->pembayaran->status === 'Menunggu Konfirmasi' || $orders->pembayaran->status === 'Terkonfirmasi')
                    <div class="mb-3 input__item">
                        <label for="id_pembayaran">Metode Pembayaran</label>
                        <input type="text" id="id_pembayaran" value={{ $orders->pembayaran->metode_pembayaran }}
                            name="id_pembayaran" disabled>
                    </div>
                    <div class="mb-3 input__item">
                        <label for="id_pembayaran">Status Pembayaran</label>
                        <input type="text" id="id_pembayaran" value="{{ $orders->pembayaran->status }}"
                            name="id_pembayaran" disabled>
                    </div>
                    <div class="mb-3 input__item">
                        <label for="id_pemesanan">Bukti Pembayaran</label>
                        <a target="_blank"
                            href="{{ route('admin.pembayaran.bukti', ['bukti_pembayaran' => $orders->pembayaran->id]) }}"
                            style="font-style: italic; color: blue;">lihat bukti pembayaran</a>
                    </div>
                @else
                    <div class="mb-3 input__item">
                        <label for="metode_pembayaran">Bayar Melalui</label>
                        <select class="" id="metode_pembayaran" name="metode_pembayaran"
                            aria-label="Default select example">
                            <option selected>Pilih metode pembayaran</option>
                            <option value="BNI">BNI: 1123123123123</option>
                            <option value="BCA">BCA: 1123123123123</option>
                            <option value="BRI">BRI: 1123123123123</option>
                        </select>
                    </div>

                    <div class="mb-3 input__item">
                        <label for="bukti_pembayaran">Unggah bukti pembayaran</label>
                        <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" required>
                    </div>

                    <button type="submit" style="width: 200px; margin-left:auto; margin-top: 20px;"
                        class="btn-1 btn-lanjut">Bayar</button>
                @endif
            </form>
        </div>
    </div>
@endsection
