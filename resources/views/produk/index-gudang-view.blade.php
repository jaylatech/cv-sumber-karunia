@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>{{ $produk->nama }}</title>
@endpush

@php
use App\Models\Kategori;
@endphp

@section('content')
    <div class="gudang-produk">
        <div class="gudang-produk-header">
            @include('partials.menu')
        </div>
        <div class="gudang-create-menu">
            <a class="btn-1" href="{{ route('gudang.produk') }}"><span>Kembali</span></a>
            <div class="form__create">
                <form class="form-create" method="POST" action="{{ route('gudang.produk.save') }}"
                    enctype="multipart/form-data" accept-charset="UTF-8">
                    @csrf
                    @method('POST')
                    <div class="form-container">
                        <div class="left">
                            <div class="mb-3 input__item">
                                <label for="name" class="form-label">Nama Produk</label>
                                <p>{{ $produk->nama }}</p>
                            </div>
                            <div class="mb-3 input__item">
                                <label for="product_id" class="form-label">Id Produk</label>
                                <p>{{ $produk->kode_produk }}</p>
                            </div>
                            <div class="gudang-produk-foto">
                                <label for="">Foto Produk</label>
                                <div>
                                    <img src={{ isset($produk->photos) && count($produk->photos) > 0 ?  asset('images/' . $produk->photos[0]->path) : '' }} alt="" srcset="">
                                    <img src={{ isset($produk->photos) && count($produk->photos) > 0 ?  asset('images/' . $produk->photos[1]->path) : '' }} alt="" srcset="">
                                    <img src={{ isset($produk->photos) && count($produk->photos) > 0 ?  asset('images/' . $produk->photos[1]->path) : '' }} alt="" srcset="">
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="mb-3 input__item">
                                <label for="kategori" class="form-label">Kategori</label>
                                <p>{{Kategori::find($produk->kategoris[0]->id)->nama}}</p>
                            </div>
                            <div class="mb-3 input__item">
                                <label for="harga" class="form-label">Harga Produk (Rp)</label>
                                <p>{{ $produk->harga }}</p>
                            </div>
                            <div class="mb-3 input__item">
                                <label for="kadaluarsa" class="form-label">Masa Penyimpanan (Hari)</label>
                                <p>{{ $produk->masa_penyimpanan }}</p>
                            </div>
                            <div class="mb-3 input__item">
                                <label for="berat" class="form-label">Berat (gram)</label>
                                <p>{{ $produk->berat }}</p>
                            </div>
                            <div class="mb-3 input__item">
                                <label for="stok" class="form-label">Stok Produk</label>
                                <p>{{ $produk->stok->stok }}</p>
                            </div>
                            <div class="mb-3 input__item">
                                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                                <p>{{ $produk->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
