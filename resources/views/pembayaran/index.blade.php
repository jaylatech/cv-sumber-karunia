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
    <div class="pemesanan-container">
        @if (isset($pesanan) && count($pesanan) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Pembayaran ID</th>
                        <th scope="col">Nama Pembeli</th>
                        <th scope="col">Total Bayar</th>
                        <th scope="col">Metode Pembayaran</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal Bayar</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($pesanan as $order)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->order->user->name }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->metode_pembayaran }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at }}</td>
                            <form action="" method="POST">
                                <td class="td-action">
                                    <a href="{{ route('admin.pembayaran.detail', $order->id) }}"
                                        style="font-style: italic; color: blue;">
                                        Detail
                                    </a>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif(count($pesanan) === 0)
            <h2 style="text-align: center">Tidak ada pembayaran</h2>
        @endif
    </div>
@endsection
