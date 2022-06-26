@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>{{ $produk->nama }} - Edit</title>
@endpush

@section('content')
    @php
    use Illuminate\Http\UploadedFile;
    use Illuminate\Support\Facades\Storage;
    @endphp
    <div class="gudang-produk">
        <div class="gudang-produk-header">
            @include('partials.header')
            @include('partials.menu')
            @include('partials.menu2')
        </div>
        <div class="gudang-create-menu">
            <div class="form__create">
                <a class="btn-1" href="{{ route('gudang.produk') }}"><span>Kembali</span></a>
                <form class="form-create" style="margin-top: 20px" method="POST"
                    action="{{ route('gudang.edit.save', $produk->id) }}" enctype="multipart/form-data"
                    accept-charset="UTF-8">
                    @csrf
                    @method('POST')
                    <div class="form-container">
                        <div class="left">
                            <div class="mb-3 input__item">
                                <label for="name" class="form-label">Nama Produk</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    oninvalid="this.setCustomValidity('Nama Produk tidak boleh kosong')"
                                    value={{ $produk->nama }} required oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3 input__item">
                                <label for="product_id" class="form-label">Id Produk</label>
                                <input type="text" name="product_id" class="form-control" id="product_id"
                                    oninvalid="this.setCustomValidity('Produk ID tidak boleh kosong')" required
                                    value={{ $produk->kode_produk }} oninput="this.setCustomValidity('')">
                            </div>
                            <div class="gudang-produk-foto">
                                <label for="">Foto Produk</label>
                                <div>
                                    <img src={{ isset($produk->photos) && count($produk->photos) > 0 ? asset('images/' . $produk->photos[0]->path) : '' }}
                                        alt="" srcset="">
                                    <img src={{ isset($produk->photos) && count($produk->photos) > 0 ? asset('images/' . $produk->photos[1]->path) : '' }}
                                        alt="" srcset="">
                                    <img src={{ isset($produk->photos) && count($produk->photos) > 0 ? asset('images/' . $produk->photos[1]->path) : '' }}
                                        alt="" srcset="">
                                </div>
                            </div>
                            <div class="row justify-content-center mt-5">
                                <label for="image1" class="form-label">Gambar 1</label>
                                <div class="col-md-8">
                                    <input type="file" name="image1" class="form-control"
                                        oninvalid="this.setCustomValidity('Gambar tidak boleh kosong')"
                                        oninput="this.setCustomValidity('')" required>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <label for="image2" class="form-label">Gambar 2</label>
                                <div class="col-md-8">
                                    <input type="file" name="image2" class="form-control"
                                        oninvalid="this.setCustomValidity('Gambar tidak boleh kosong')"
                                        oninput="this.setCustomValidity('')" required>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <label for="image3" class="form-label">Gambar 3</label>
                                <div class="col-md-8">
                                    <input type="file" name="image3" class="form-control"
                                        oninvalid="this.setCustomValidity('Gambar tidak boleh kosong')"
                                        oninput="this.setCustomValidity('')" required>
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="mb-3 input__item">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" name="kategori" id="kategori"
                                    aria-label="Default select example">
                                    @foreach ($kategoris as $kategori)
                                        @if ($kategori->id === $produk->kategoris[0]->id)
                                            <option value={{ $kategori->id }} selected>{{ $kategori->nama }}</option>
                                        @else
                                            <option value={{ $kategori->id }}>{{ $kategori->nama }}</option>
                                        @endif
                                    @endforeach
                                    <option value="0">Pilih Kategori</option>
                                </select>
                            </div>
                            <div class="mb-3 input__item">
                                <label for="harga" class="form-label">Harga Produk (Rp)</label>
                                <input type="text" name="harga" class="form-control" id="harga"
                                    oninvalid="this.setCustomValidity('Harga Produk tidak boleh kosong')"
                                    value={{ $produk->harga }} oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3 input__item">
                                <label for="kadaluarsa" class="form-label">Masa Penyimpanan (Hari)</label>
                                <input type="text" name="kadaluarsa" class="form-control" id="kadaluarsa"
                                    oninvalid="this.setCustomValidity('Kadaluarsa Produk tidak boleh kosong')" required
                                    value={{ $produk->masa_penyimpanan }} oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3 input__item">
                                <label for="berat" class="form-label">Berat (gram)</label>
                                <input type="text" name="berat" class="form-control" id="berat"
                                    oninvalid="this.setCustomValidity('Berat Produk tidak boleh kosong')" required
                                    value={{ $produk->berat }} oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3 input__item">
                                <label for="stok" class="form-label">Stok Produk</label>
                                <input type="text" name="stok" class="form-control" id="stok"
                                    oninvalid="this.setCustomValidity('Stok Produk tidak boleh kosong')" required
                                    value={{ $produk->stok->stok }} oninput="this.setCustomValidity('')">
                            </div>
                            <div class="mb-3 input__item area">
                                <label for="deskripsi" class="form-label">Deskripsi Produk</label>

                                <textarea name="deskripsi" id="">{{ $produk->deskripsi }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="action">
                        <a class="btn-2" href="{{ route('gudang.produk') }}"><span>Batal</span></a>
                        <button type="submit" class="btn-1">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
