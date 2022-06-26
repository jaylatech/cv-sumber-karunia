@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endpush

@push('title')
    <title>Profil - {{ Auth::user()->name }}</title>
@endpush

@section('content')
    @if (session('message'))
    @endif
    <div class="profil">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="">
                        <div class="form__group">
                            <form class="photo-form"
                                action="{{ route('user.photo.save', ['id' => Auth::user()->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <img src="{{ isset(Auth::user()->photo) ? asset('images/' . Auth::user()->photo) : asset('images/user.png') }}" alt="img-profil">
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" class="btn-1">Upload</button>
                                    </div>
                                </div>
                            </form>
                            <form class="form__container" method="POST"
                                action="{{ route('user.profil.update', ['id' => Auth::user()->id]) }}"
                                accept-charset="UTF-8">
                                @csrf
                                @method('POST')
                                <div class="mb-3 input__item">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ Auth::user()->name }}"
                                        oninvalid="this.setCustomValidity('Nama tidak boleh kosong')"
                                        oninput="this.setCustomValidity('')">
                                </div>
                                <div class="mb-3 input__item">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="username"
                                        value="{{ Auth::user()->username }}"
                                        oninvalid="this.setCustomValidity('Username tidak boleh kosong')"
                                        oninput="this.setCustomValidity('')">
                                </div>
                                <div class="mb-3 input__item">
                                    <label for="password_lama" class="form-label">Password Lama</label>
                                    <input type="password" name="password_lama" class="form-control" id="password_lama"
                                        oninvalid="this.setCustomValidity('password tidak boleh kosong')"
                                        oninput="this.setCustomValidity('')">
                                </div>
                                <div class="mb-3 input__item">
                                    <label for="password_baru" class="form-label">Password Baru</label>
                                    <input type="password" name="password_baru" class="form-control" id="password_baru"
                                        oninvalid="this.setCustomValidity('password tidak boleh kosong')"
                                        oninput="this.setCustomValidity('')">
                                </div>
                                <div class="mb-3 input__item">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control" id="email"
                                        value="{{ Auth::user()->email }}"
                                        oninvalid="this.setCustomValidity('Email tidak boleh kosong')"
                                        oninput="this.setCustomValidity('')">
                                </div>
                                <div class="mb-3 input__item">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" id="alamat"
                                        value="{{ Auth::user()->alamat }}"
                                        oninvalid="this.setCustomValidity('alamat tidak boleh kosong')"
                                        oninput="this.setCustomValidity('')">
                                </div>
                                <div class="mb-3 input__item">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="text" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                        value="{{ Auth::user()->tanggal_lahir }}"
                                        oninvalid="this.setCustomValidity('Tanggal Lahir tidak boleh kosong')"
                                        oninput="this.setCustomValidity('')">
                                </div>
                                <div class="mb-3 input__item">
                                    <label for="telepon" class="form-label">No. Telepon</label>
                                    <input type="text" name="telepon" class="form-control" id="telepon"
                                        value="{{ Auth::user()->telepon }}"
                                        oninvalid="this.setCustomValidity('No. Telepon tidak boleh kosong')"
                                        oninput="this.setCustomValidity('')">
                                </div>

                                <div class="mb-3 input__item">
                                    <label for="gender" class="form-label">Jenis Kelamin</label>
                                    @if (Auth::user()->jenis_kelamin === 'L')
                                        <select class="form-select" name="gender" id="gender"
                                            aria-label="Default select example">
                                            <option value="P">Pilih Jenis Kelamin</option>
                                            <option selected value="L">L</option>
                                            <option value="P">P</option>
                                        </select>
                                    @elseif (Auth::user()->jenis_kelamin === 'P')
                                        <select class="form-select" name="gender" id="gender"
                                            aria-label="Default select example">
                                            <option value="P">Pilih Jenis Kelamin</option>
                                            <option value="L">L</option>
                                            <option selected value="P">P</option>
                                        </select>
                                    @else
                                        <select class="form-select" name="gender" id="gender"
                                            aria-label="Default select example">
                                            <option value="L">L</option>
                                            <option value="P">P</option>
                                            <option selected value="P">Pilih Jenis Kelamin</option>
                                        </select>
                                    @endif
                                </div>
                                <div class="action">
                                    <a class="btn-2" href="/dashboard"><span>Batal</span></a>
                                    <button type="submit" class="btn-1">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
