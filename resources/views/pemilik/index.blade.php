@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>Pemilik</title>
@endpush

@section('content')
    @include('partials.header')
    @include('partials.menu')
    @include('partials.menu2')
    <div class="pemesanan-container">

        @if (isset($laporans) && count($laporans) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Dari</th>
                        <th scope="col">Sampai</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp

                    <tr>
                        <th scope="row">{{ ++$i }}</th>
                        <td>{{ $tanggalAwal }}</td>
                        <td>{{ $tanggalSekarang }}</td>
                        <form method="POST" action="{{ route('dashboard.pemilik.download') }}">
                            <td class="td-action">
                                @csrf
                                @method('POST')
                                <button type="submit" title="delete"
                                    style="border: none; background-color:transparent;">
                                    Download

                                </button>
                            </td>
                        </form>
                    </tr>

                </tbody>
            </table>
    </div>
@elseif(count($laporans) === 0)
    <h2 style="text-align: center">Tidak ada laporan</h2>
    @endif

    </div>
@endsection
