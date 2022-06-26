@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>CV. Sumber Karunia</title>
@endpush

@section('content')
    @include('partials.header')
    @include('partials.menu')
    @include('partials.menu2')
    <div class="dashboard">
        <div class="left-ds">
            <img src="{{ asset('cv.png') }}" alt="">
            <img src="{{ asset('cv.png') }}" alt="">
        </div>
        <div class="right-ds">
            <div class="member-announc">
                <h1>Selamat datang di Website CV. Smber Karunia</h1>


                <div class="promo-desc">
                    <p>Anda memproduksi kue?</p>
                    <p>Bingung naritempat membeli bahan-bahan kue dengan jumlah banyak dan harga murah?</p>
                    <p>Disini Tempatnya !!!</p>
                    <p>CV. Sumber Karunia distributor penyedia berbagi macan plastik dan bahan-bahan kue</p>
                </div>
                <div class="product-content" style="display: flex; flex-direction: column;">
                    <div>
                        <h3>Paling banyak terjual</h3>
                    </div>
                    <div style="display: flex">
                        @foreach ($produks as $produk['produk'])
                        <div class="product-item">
                            <div class="product-desc">
                                <img src={{ isset($produk->photos) && count($produk->photos) > 0 ? asset('images/' . $produk->photos[0]->path) : '' }}
                                    alt="" srcset="">
                                <div>
                                    <h5>{{ $produk['produk']['produk']->nama }}</h5>
                                    <h6>Stok : {{ $produk['produk']['produk']->stok->stok }}</h6>
                                    <a href="{{ route('admin.produk.detail', $produk['produk']['produk']->id) }}"
                                        style="font-style: italic; font-weight: bold">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="promo">

            </div>
        </div>
    </div>
@endsection
