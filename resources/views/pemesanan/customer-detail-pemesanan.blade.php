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
    @include('partials.menu2')
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

            <input type="text" name="berat_pengiriman" value="{{ $orders->berat }}" style="display: none">

            <div class="mb-3 input__item">
                <label for="waktu_pengiriman">Waktu Pengiriman</label>
                <input type="date" style="width: 200px" id="waktu_pengiriman" name="waktu_pengiriman">
            </div>

            <div class="mb-3 input__item">
                <label for="status">Status</label>
                <input type="text" id="status" name="status" disabled value="{{ $orders->status }}">
            </div>

            <div class="mb-3 input__item">
                <label for="alamat_tujuan">Kota Tujuan</label>
                <select class="" id="alamat_tujuan" name="alamat_tujuan" aria-label="Default select example">
                    <option selected>Pilih kota tujuan</option>
                    @foreach ($data_kota as $kota)
                        <option value={{ $kota['city_id'] }}>{{ $kota['city_name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 input__item">
                <label for="biaya_pengiriman">Detail Alamat</label>
                <textarea name="alamat_tujuan" disabled>{{ $orders->user->alamat }}</textarea>
            </div>
            <div class="mb-3 input__item">
                <label for="biaya_pengiriman">Biaya Pengiriman (Rp)</label>
                <input type="text" id="biaya_pengiriman" name="biaya_pengiriman" value="{{ $biayaKirim[0]['biaya'] }}"
                    disabled>
            </div>

            <div class="mb-3 input__item">
                <label for="catatan">Catatan Pemesanan</label>
                <textarea name="catatan" id="catatan" required>{{ $orders->catatan_pengiriman }}</textarea>
            </div>

            <div class="mb-3 input__item">
                <button type="submit" style="" class="btn-1 btn-lanjut">
                    Cek Ongkir</button>
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
                        <td style="font-weight: bold; font-size: 20px; text-align: end;" colspan="4">Biaya Kirim</td>
                        <td></td>
                        <td style="font-weight: bold; font-size: 20px" colspan="4">{{ $biayaKirim[0]['biaya'] }}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; font-size: 20px; text-align: end;" colspan="4">Total</td>
                        <td style="font-weight: bold; font-size: 20px">{{ $orders->berat }}</td>
                        <td style="font-weight: bold; font-size: 20px">{{ $orders->total + $biayaKirim[0]['biaya'] }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-pemesanan-submit">
            <form action="{{ route('customer.pemesanan.rollback') }}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" style="width: 200px; margin-left:auto;" class="btn-2 btn-lanjut">Batalkan
                    Pemesanan</button>
            </form>
            <form action="{{ route('customer.pembayaran.create', ['order_id', $orders->id]) }}" method="POST">
                @csrf
                @method('POST')

                <input type="text" name="total_biaya" value="{{ $orders->total + $biayaKirim[0]['biaya'] }}"
                    style="display: none">
                <input type="text" name="id_pemesanan" value={{ $orders->id }} style="display: none">
                <input type="text" name="tanggal_pengiriman" value="{{ $orders->tanggal_pengiriman }}"
                    style="display: none">
                <input type="text" name="catatan_pengiriman" value="{{ $orders->catatan_pengiriman }}"
                    style="display: none">

                @if ($orders->status === 'Menunggu Konfirmasi')
                    <button type="submit" disabled style="width: 200px; margin-left:auto;"
                        class="btn-disabled btn-lanjut">Lanjut
                        Pembayaran</button>
                @else
                    <button type="submit" style="width: 200px; margin-left:auto;" class="btn-1 btn-lanjut">Lanjut
                        Pembayaran</button>
                @endif
            </form>
        </div>
    </div>
@endsection
