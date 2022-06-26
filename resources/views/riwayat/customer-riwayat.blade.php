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
    <div class="pemesanan-container">
        @if (isset($histories) && count($histories) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Biaya</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal Order</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($histories as $history)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $history->order->user->name }}</td>
                            <td>{{ $history->order->pembayaran->total }}</td>
                            <td>{{ $history->order->user->alamat }}</td>
                            <td>Pesanan {{ $history->order->pengiriman->keterangan }}</td>
                            <td>{{ $history->order->created_at }}</td>
                            <td class="td-action">
                                <a href="{{ route('customer.riwayat.detail', $history->id) }}"
                                    style="font-style: italic; color: blue;">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif(count($histories) === 0)
            <h2 style="text-align: center">Tidak ada riwayat</h2>
        @endif
    </div>
@endsection
