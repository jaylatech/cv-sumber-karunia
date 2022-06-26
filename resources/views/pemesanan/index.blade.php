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
        @if (isset($orders) && count($orders) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Order Id</th>
                        <th scope="col">Nama Pembeli</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Berat (gram)</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal Order</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->berat }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at }}</td>
                            <form action="" method="POST">
                                <td class="td-action">
                                    <a href="{{ route('admin.pemesanan.detail', $order->id) }}"
                                        style="font-style: italic; color: blue;">
                                        Detail
                                    </a>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif(count($orders) === 0)
            <h2 style="text-align: center">Tidak ada pesanan</h2>
        @endif
    </div>
@endsection
