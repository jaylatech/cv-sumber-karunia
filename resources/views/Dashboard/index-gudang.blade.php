@extends('layouts.app')


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>Gudang Dashboard</title>
@endpush

@section('content')
    <div class="gudang-dashboard">
        <div>
            @include('partials.header')
            @include('partials.menu')
            @include('partials.menu2')
        </div>
        <div class="gudang__dashboard">
            <div class="paling_sedikit">
                <h5>Stok paling sedikit</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stokSedikit as $key => $min)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $min['produk']->kode_produk }}</td>
                                <td>{{ $min['produk']->nama }}</td>
                                <td>{{ $min->stok }}</td>
                                <td>{{ $min['produk']->harga }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="paling_banyak">
                <h5>Stok paling banyak</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stokBanyak as $key => $max)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $max['produk']->kode_produk }}</td>
                                <td>{{ $max['produk']->nama }}</td>
                                <td>{{ $max->stok }}</td>
                                <td>{{ $max['produk']->harga }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="paling_sedikit_terjual">
                <h5>Stok paling sedikit terjual</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Terjual</th>
                            <th scope="col">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sedikitTerjual as $key => $min)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{$min['produk']->kode_produk}}</td>
                                <td>{{$min['produk']->nama}}</td>
                                <td>{{$min['produk']->stok->stok}}</td>
                                <td>{{$min->jumlah}}</td>
                                <td>{{$min['produk']->harga}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="paling_banyak_terjual">
                <h5>Stok paling banyak terjual</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Terjual</th>
                            <th scope="col">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banyakTerjual as $key => $max)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{$max['produk']->kode_produk}}</td>
                                <td>{{$max['produk']->nama}}</td>
                                <td>{{$max['produk']->stok->stok}}</td>
                                <td>{{$max->jumlah}}</td>
                                <td>{{$max['produk']->harga}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
