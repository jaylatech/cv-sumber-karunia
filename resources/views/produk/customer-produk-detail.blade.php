@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>Produk</title>
@endpush



@section('content')
    @php
    use App\Models\Kategori;
    @endphp
    @include('partials.header')
    @include('partials.menu')
    @include('partials.menu2')
    <div class="produk-detail-container">
        <a class="btn-1" href="{{ route('customer.produk') }}"><span>Kembali</span></a>
        <div class="produk-detail-content">
            <div class="produk-detail-left">
                <div>
                    <img src={{ isset($produk->photos) && count($produk->photos) > 0 ? asset('images/' . $produk->photos[0]->path) : '' }}
                        alt="" srcset="">
                    <img src={{ isset($produk->photos) && count($produk->photos) > 0 ? asset('images/' . $produk->photos[1]->path) : '' }}
                        alt="" srcset="">
                    <img src={{ isset($produk->photos) && count($produk->photos) > 0 ? asset('images/' . $produk->photos[1]->path) : '' }}
                        alt="" srcset="">
                </div>
            </div>
            <div class="produk-detail-right">
                <div class="mb-3 input__item">
                    <label for="nama" class="form-label">Nama</label>
                    <p>{{ $produk->nama }}</p>
                </div>
                <div class="mb-3 input__item">
                    <label for="nama" class="form-label">Kode Produk</label>
                    <p>{{ $produk->kode_produk }}</p>
                </div>
                <div class="mb-3 input__item">
                    <label for="kategori" class="form-label">Kategori</label>
                    <p>{{ Kategori::find($produk->kategoris[0]->id)->nama }}</p>
                </div>
                <div class="mb-3 input__item">
                    <label for="nama" class="form-label">Harga</label>
                    <p>Rp. {{ $produk->harga }}</p>
                </div>
                <div class="mb-3 input__item">
                    <label for="nama" class="form-label">Berat</label>
                    <p>{{ $produk->berat }} gram</p>
                </div>
                <div class="mb-3 input__item">
                    <label for="nama" class="form-label">Deskripsi</label>
                    <p>{{ $produk->deskripsi }}</p>
                </div>
                <div class="mb-3 input__item">
                    <label for="nama" class="form-label">Stok</label>
                    <p>{{ $produk->stok->stok }}</p>
                </div>
                <div class="mb-3 input__item">
                    <label for="nama" class="form-label">Masa Penyimpanan</label>
                    <p>{{ $produk->masa_penyimpanan }} hari</p>
                </div>
            </div>
        </div>
    </div>
@endsection
