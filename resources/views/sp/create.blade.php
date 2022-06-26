@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
@endpush

@push('title')
    <title>Tambah User</title>
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
                            <form class="form__container" method="POST" action="{{ route('sp.users.create') }}"
                                accept-charset="UTF-8">
                                @csrf
                                @method('POST')
                                <div class="mb-3 input__item">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" id="name" required
                                        oninvalid="this.setCustomValidity('Nama tidak boleh kosong')"
                                        oninput="this.setCustomValidity('')">
                                </div>
                                <div class="mb-3 input__item">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" required
                                        oninvalid="this.setCustomValidity('Username tidak boleh kosong')"
                                        oninput="this.setCustomValidity('')">
                                </div>
                                <div class="mb-3 input__item">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" required
                                        oninvalid="this.setCustomValidity('password tidak boleh kosong')"
                                        oninput="this.setCustomValidity('')">
                                </div>
                                <div class="mb-3 input__item">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control" id="email"
                                        oninvalid="this.setCustomValidity('Email tidak boleh kosong')" required
                                        oninput="this.setCustomValidity('')">
                                </div>
                                <div class="mb-3 input__item">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" id="alamat"
                                        oninvalid="this.setCustomValidity('alamat tidak boleh kosong')" required
                                        oninput="this.setCustomValidity('')">
                                </div>
                                <div class="mb-3 input__item">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                        oninvalid="this.setCustomValidity('Tanggal Lahir tidak boleh kosong')" required
                                        oninput="this.setCustomValidity('')">
                                </div>
                                <div class="mb-3 input__item">
                                    <label for="telepon" class="form-label">No. Telepon</label>
                                    <input type="text" name="telepon" class="form-control" id="telepon"
                                        oninvalid="this.setCustomValidity('No. Telepon tidak boleh kosong')" required
                                        oninput="this.setCustomValidity('')"> 
                                </div>

                                <div class="mb-3 input__item">
                                    <label for="gender" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="gender" id="gender" required
                                        aria-label="Default select example">
                                        <option selected value="">Pilih Jenis Kelamin</option>
                                        <option value="L">L</option>
                                        <option value="P">P</option>
                                    </select>
                                </div>
                                <div class="mb-3 input__item">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" name="role" id="role" required
                                        aria-label="Default select example">
                                        <option selected value="">Pilih Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="action">
                                    <a class="btn-2" href="/sp"><span>Batal</span></a>
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
