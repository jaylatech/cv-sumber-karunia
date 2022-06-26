@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>Pemesanan</title>
@endpush

@php
use App\Models\Produk;
@endphp

@section('content')
    @include('partials.header')
    @include('partials.menu')
    {{-- @include('partials.menu2') --}}
    <div class="pemesanan-container">
        <form action="{{ route('customer.pemesanan.ongkir', ['order_id' => $orders->id]) }}" method="post"
            class="mb-3 input__item" style="display: flex">
            @csrf
            @method('POST')
            <div class="mb-3 input__item">
                <label for="id_pemesanan">ID Pemesanan</label>
                <input type="text" id="id_pemesanan" name="id_pemesanan" value={{ $orders->id }} disabled>
            </div>

            <div class="mb-3 input__item">
                <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                <input type="text" id="tanggal_pemesanan" name="tanggal_pemesanan" value={{ $orders->created_at }}
                    disabled>
            </div>

            <div class="mb-3 input__item">
                <label for="tanggal_pemesanan">Nama Pembeli</label>
                <textarea type="text" id="tanggal_pemesanan" style="resize: none; height: 38px" name="tanggal_pemesanan" disabled>{{ $orders->user->name }}</textarea>
            </div>

            <div class="mb-3 input__item">
                <label for="tanggal_pemesanan">Status Pesanan</label>
                <textarea type="text" id="tanggal_pemesanan" style="resize: none; height: 38px" name="tanggal_pemesanan" disabled>{{ $orders->status }}</textarea>
            </div>

            <div class="mb-3 input__item">
                <label for="tanggal_pemesanan">Alamat Pembeli</label>
                <textarea type="text" id="tanggal_pemesanan" style="resize: none; height: 38px" name="tanggal_pemesanan" disabled>{{ $orders->user->alamat }}</textarea>
            </div>

            <input type="text" name="berat_pengiriman" value="{{ $orders->berat }}" style="display: none">

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
                        $list = $orders->orderDetails()->get();
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
                        <td style="font-weight: bold; font-size: 20px; text-align: end;" colspan="4">Total</td>
                        <td style="font-weight: bold; font-size: 20px">{{ $orders->berat }}</td>
                        <td style="font-weight: bold; font-size: 20px">{{ $orders->total }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-pemesanan-submit">
            <form action="{{ route('admin.pemesanan.konfirmasi', $orders->id) }}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" style="width: 200px; margin-left:200px;" class="btn-1 btn-lanjut">Konfirmasi</button>
            </form>
        </div>
    </div>
@endsection
