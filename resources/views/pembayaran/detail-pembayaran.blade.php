@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>Detail Pembayaran</title>
@endpush

@php
use App\Models\Produk;
@endphp

@section('content')
    @include('partials.header')
    @include('partials.menu')
    @include('partials.menu2')
    <div class="pemesanan-container">
        <form action="" method="post" class="mb-3 input__item" style="display: flex">

            <div class="mb-3 input__item">
                <label for="id_pemesanan">ID Pembayaran</label>
                <input type="text" id="id_pemesanan" name="id_pemesanan" value={{ $pembayaran->id }} disabled>
            </div>

            <div class="mb-3 input__item">
                <label for="id_pemesanan">Nama Pembeli</label>
                <input type="text" id="id_pemesanan" name="id_pemesanan" value={{ $pembayaran->order->user->name }}
                    disabled>
            </div>

            <div class="mb-3 input__item">
                <label for="id_pemesanan">Total Bayar</label>
                <input type="text" id="id_pemesanan" name="id_pemesanan" value={{ $pembayaran->total }} disabled>
            </div>

            <div class="mb-3 input__item">
                <label for="id_pemesanan">Metode Pembayaran</label>
                <input type="text" id="id_pemesanan" name="id_pemesanan" value={{ $pembayaran->metode_pembayaran }}
                    disabled>
            </div>

            <div class="mb-3 input__item">
                <label for="id_pemesanan">Tanggal Pembayaran</label>
                <input type="text" id="id_pemesanan" name="id_pemesanan" value={{ $pembayaran->updated_at }} disabled>
            </div>

            <div class="mb-3 input__item">
                <label for="id_pemesanan">Bukti Pembayaran</label>
                <a target="_blank" href="{{ route('admin.pembayaran.bukti', ['bukti_pembayaran' => $pembayaran->id]) }}"
                    style="font-style: italic; color: blue;">lihat bukti pembayaran</a>
            </div>

        </form>

        {{-- list --}}
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
                        $list = $pembayaran->order->orderDetails()->get();
                        $orders = $pembayaran->order()->get();
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
                        <td style="font-weight: bold; font-size: 20px; text-align: end;" colspan="4">Ongkir</td>
                        <td></td>
                        <td style="font-weight: bold; font-size: 20px">{{ $orders[0]->pengiriman->biaya }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; font-size: 20px; text-align: end;" colspan="4">Total</td>
                        <td style="font-weight: bold; font-size: 20px">{{ $orders[0]->berat }}</td>
                        <td style="font-weight: bold; font-size: 20px">{{ $pembayaran->total }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-pemesanan-submit">
            <form action="{{ route('admin.pembayaran.konfirmasi', ['id' => $pembayaran->id]) }}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" style="width: 200px; margin-left:200px;" class="btn-1 btn-lanjut">Konfirmasi</button>
            </form>
        </div>
    </div>
@endsection
