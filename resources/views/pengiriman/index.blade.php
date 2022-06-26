@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>Pengiriman</title>
@endpush

@php
use App\Models\Produk;
@endphp

@section('content')
    @include('partials.header')
    @include('partials.menu')
    @include('partials.menu2')
    <div class="pemesanan-container">
        @if (isset($pengirimans) && count($pengirimans) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID Pengiriman</th>
                        <th scope="col">Biaya</th>
                        <th scope="col">Nama Customer</th>
                        <th scope="col">Alamat Pengiriman</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal Pengiriman</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($pengirimans as $pengiriman)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $pengiriman->id }}</td>
                            <td>{{ $pengiriman->biaya }}</td>
                            <td>{{ $pengiriman->order->user->name }}</td>
                            <td>{{ $pengiriman->tujuan_pengiriman }}</td>
                            <td>{{ $pengiriman->keterangan }}</td>
                            <td>{{ $pengiriman->updated_at }}</td>
                            <form action="" method="POST">
                                <td class="td-action">
                                    <a href="{{ route('admin.pengiriman.detail', $pengiriman->id) }}"
                                        style="font-style: italic; color: blue;">
                                        Edit
                                    </a>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif(count($pengirimans) === 0)
            <h2 style="text-align: center">Tidak ada pengiriman</h2>
        @endif
    </div>
@endsection
