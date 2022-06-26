@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>Gudang Produk</title>
@endpush

@section('content')
    <div class="gudang-produk">
        <div>
            @include('partials.header')
            @include('partials.menu')
            @include('partials.menu2')
        </div>
        <div class="gudang-produk-list">
            <a class="btn-1" href="{{ route('gudang.produk.create') }}"><span>Tambah Produk</span></a>
            <div style="margin-top: 20px">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produks as $produk)
                            @php
                                static $i = 0;
                            @endphp
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td>{{ $produk->kode_produk }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->stok->stok }}</td>
                                <div>
                                    <form method="POST" action="{{ route('gudang.produk.delete', $produk->id) }}">
                                        <td class="td-action">
                                            <a href="{{ route('gudang.produk.view', $produk->id) }}">
                                                <img src="{{ asset('/icons/ic_view.png') }}" style="width: 24px"
                                                    alt="Icon View">
                                            </a>
                                            <a href="{{ route('gudang.edit.view', $produk->id) }}">
                                                <img src="{{ asset('/icons/ic_edit.png') }}" style="width: 24px"
                                                    alt="Icon View">
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="delete"
                                                style="border: none; background-color:transparent;">
                                                <img src="{{ asset('/icons/ic_delete.png') }}" style="width: 24px"
                                                    alt="Icon View">

                                            </button>
                                        </td>
                                    </form>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <div class="paginate-link">
                    {!! $produks->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
