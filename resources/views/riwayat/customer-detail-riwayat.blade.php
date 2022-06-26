@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>Riwayat</title>
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
                    <input type="text" id="id_pemesanan" name="id_pemesanan" value="{{ $riwayat->id }}" disabled>
                </div>

                <div class="mb-3 input__item">
                    <label for="customer">Nama Pembeli</label>
                    <input type="text" id="customer" name="customer" value="{{ $riwayat->user->name }}" disabled>
                </div>

                <div class="mb-3 input__item">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ $riwayat->user->alamat }}" disabled>
                </div>

                <div class="mb-3 input__item">
                    <label for="status_pesanan">Status Pesanan</label>
                    <input type="text" id="status_pesanan" name="status_pesanan"
                        value="{{ $riwayat->pengiriman->keterangan }}" disabled>
                </div>

            </form>
        </div>
        <div class="pembayaran-right">
            <form action="">

                <div class="mb-3 input__item">
                    <label for="ongkir">Biaya Ongkir</label>
                    <input type="text" id="ongkir" value="{{ $riwayat->pengiriman->biaya }}" name="total_bayar" disabled>
                </div>

                <div class="mb-3 input__item">
                    <label for="total_bayar">Jumlah Pembayaran</label>
                    <input type="text" id="total_bayar" value="{{ $riwayat->pembayaran->total }}" name="total_bayar"
                        disabled>
                </div>

                <div class="mb-3 input__item">
                    <label for="metode_pembayaran">Metode Pembayaran</label>
                    <input type="text" id="metode_pembayaran" name="metode_pembayaran"
                        value={{ $riwayat->pembayaran->metode_pembayaran }} disabled>
                </div>

                <div class="mb-3 input__item">
                    <label for="id_pemesanan">Bukti Pembayaran</label>
                    <a target="_blank"
                        href="{{ route('admin.pembayaran.bukti', ['bukti_pembayaran' => $riwayat->pembayaran->id]) }}"
                        style="font-style: italic; color: blue;">lihat bukti pembayaran</a>
                </div>

                <div class="mb-3 input__item">
                    <label for="id_pemesanan">Invoice</label>
                    <a target="_blank" href="{{ route('invoice.index', $riwayat->id) }}"
                        style="font-style: italic; color: blue;">lihat invoice</a>
                </div>

            </form>
        </div>
    </div>
    <div class="riwayat_orders">
        <div class="mb-3 input__item">
            <label for="catatan">Daftar Pesanan</label>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Berat (gram)</th>
                        <th scope="col">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                        $list = $riwayat->orderDetails()->get();
                    @endphp
                    @foreach ($list as $order)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ Produk::find($order->order_id)->nama }}</td>
                            <td>{{ $order->jumlah }}</td>
                            <td>{{ $order->harga }}</td>
                            <td>{{ $order->berat }}</td>
                            <td>{{ $order->sub_total }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="font-weight: bold; font-size: 20px; text-align: end;" colspan="4">Biaya Kirim</td>
                        <td></td>
                        <td style="font-weight: bold; font-size: 20px" colspan="4">{{ $riwayat->pengiriman->biaya }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; font-size: 20px; text-align: end;" colspan="4">Total</td>
                        <td style="font-weight: bold; font-size: 20px">{{ $riwayat->berat }}</td>
                        <td style="font-weight: bold; font-size: 20px">
                            {{ $riwayat->total + $riwayat->pengiriman->biaya }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
