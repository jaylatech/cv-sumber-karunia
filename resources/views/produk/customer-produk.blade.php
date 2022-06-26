@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>Produk</title>
@endpush

@section('content')
    @include('partials.header')
    @include('partials.menu')
    @include('partials.menu2')
    <div class="produk-container">
        <div class="product-content">
            @foreach ($produks as $produk)
                <div class="product-item">
                    <div class="product-desc">
                        <img src={{ isset($produk->photos) && count($produk->photos) > 0 ? asset('images/' . $produk->photos[0]->path) : '' }}
                            alt="" srcset="">
                        <div>
                            <h5>{{ $produk->nama }}</h5>
                            <h6>Stok : {{ $produk->stok->stok }}</h6>
                            <a href="{{ route('customer.produk.detail', $produk->id) }}"
                                style="font-style: italic; font-weight: bold">Detail</a>
                        </div>
                    </div>
                    <div class="product-cart">
                        <form action="{{ route('customer.keranjang.tambah', ['produk_id' => $produk->id]) }}"
                            class="form-product-item" method="POST">
                            @csrf
                            @method('POST')
                            <label for="jumlah">Rp. {{ $produk->harga }}</label>
                            <input type="number" id="jumlah" name="jumlah" value="1">
                            <button type="submit" class="btn-1">Tambah Keranjang</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="paginate-link">
        {!! $produks->links() !!}
    </div>
@endsection
