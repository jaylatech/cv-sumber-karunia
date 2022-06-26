@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>Gudang Produk - Tambah</title>
@endpush

@section('content')
    <div class="gudang-produk">
        <div class="gudang-produk-header">
            @include('partials.menu')
        </div>
        <div class="gudang-create-menu">
            <a class="btn-1" href="{{ route('gudang.produk') }}"><span>Kembali</span></a>
            <div class="form__create">
                <form class="form-create" method="POST" action="{{ route('gudang.produk.save') }}" enctype="multipart/form-data" accept-charset="UTF-8">
                    @csrf
                    @method('POST')
                    <div class="form-container">
                        <div class="left">
                            <div class="mb-3 input__item">
                                <label for="name" class="form-label">Nama Produk</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    oninvalid="this.setCustomValidity('Nama Produk tidak boleh kosong')"
                                    required
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3 input__item">
                                <label for="product_id" class="form-label">Id Produk</label>
                                <input type="text" name="product_id" class="form-control" id="product_id"
                                    oninvalid="this.setCustomValidity('Produk ID tidak boleh kosong')"
                                    required
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="row justify-content-center">
                                <label for="image1" class="form-label">Gambar 1</label>
                                <div class="col-md-8">
                                    <input type="file" name="image1" class="form-control" required>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <label for="image2" class="form-label">Gambar 2</label required>
                                <div class="col-md-8">
                                    <input type="file" name="image2" class="form-control">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <label for="image3" class="form-label">Gambar 3</label required>
                                <div class="col-md-8">
                                    <input type="file" name="image3" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="mb-3 input__item">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" name="kategori" id="kategori"
                                    aria-label="Default select example">
                                    @foreach ($kategoris as $kategori)
                                        <option value={{$kategori->id}}>{{$kategori->nama}}</option>    
                                    @endforeach
                                    <option selected value="0">Pilih Kategori</option>
                                </select>
                            </div>
                            <div class="mb-3 input__item">
                                <label for="harga" class="form-label">Harga Produk (Rp)</label>
                                <input type="text" name="harga" class="form-control" id="harga"
                                    oninvalid="this.setCustomValidity('Harga Produk tidak boleh kosong')"
                                    required
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3 input__item">
                                <label for="kadaluarsa" class="form-label">Masa Penyimpanan (Hari)</label>
                                <input type="text" name="kadaluarsa" class="form-control" id="kadaluarsa"
                                    oninvalid="this.setCustomValidity('Kadaluarsa Produk tidak boleh kosong')"
                                    required
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3 input__item">
                                <label for="berat" class="form-label">Berat (gram)</label>
                                <input type="text" name="berat" class="form-control" id="berat"
                                    oninvalid="this.setCustomValidity('Berat Produk tidak boleh kosong')"
                                    required
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3 input__item">
                                <label for="stok" class="form-label">Stok Produk</label>
                                <input type="text" name="stok" class="form-control" id="stok"
                                    oninvalid="this.setCustomValidity('Stok Produk tidak boleh kosong')"
                                    required
                                    oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3 input__item">
                                <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                                <input type="text" name="deskripsi" class="form-control" id="deskripsi"
                                    oninvalid="this.setCustomValidity('Deskripsi Produk tidak boleh kosong')"
                                    required
                                    oninput="this.setCustomValidity('')">
                            </div>
                        </div>
                    </div>

                    <div class="action">
                        <a class="btn-2" href="/dashboard"><span>Batal</span></a>
                        <button type="submit" class="btn-1">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
