@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>Keranjang</title>
@endpush

@section('content')
    @include('partials.header')
    @include('partials.menu')
    @include('partials.menu2')
    @php
    use App\Models\Produk;
    @endphp
    <div class="keranjang">
        @if (isset($keranjang) && count($keranjang) > 0)
            <div class="keranjang-tabel-header">
                <h5 style="font-weight: bold">Total Barang : {{ count(Auth::user()->keranjangs()->get()) }}</h5>
            </div>
            <div class="keranjang-tabel">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col">No</th>
                            <th scope="col-7">Produk</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($keranjang as $produk)
                            <tr>
                                <form method="POST"
                                    action="{{ route('customer.keranjang.delete', ['keranjang_id' => $produk->id]) }}">
                                    <td class="td-action">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="delete"
                                            style="border: none; background-color:transparent;">
                                            <img src="{{ asset('/icons/ic_delete.png') }}" style="width: 24px"
                                                alt="Icon View">

                                        </button>
                                    </td>
                                </form>
                                <th scope="row">{{ ++$i }}</th>
                                <td style="width: 350px">{{ Produk::find($produk->produk_id)->nama }}</td>
                                <td style="width: 200px">
                                    <form
                                        action="{{ route('customer.keranjang.update.stok', ['keranjang_id' => $produk->id]) }}"
                                        class="form-keranjang-jumlah" method="POST">
                                        @csrf
                                        @method('POST')
                                        <label for="jumlah"></label>
                                        <input type="number" name="jumlah" id="jumlah" value={{ $produk->jumlah }}>
                                        <div>
                                            <button type="submit" class="btn-1">update</button>
                                        </div>
                                    </form>
                                </td>
                                <td>{{ $produk->harga }}</td>
                                <td>{{ $produk->sub_total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <form action="{{ route('customer.pemesanan.create') }}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="btn-1 btn-lanjut">Lanjut Pemesanan</button>
            </form>
        @elseif(count($keranjang) === 0)
            <h2 style="text-align: center">Keranjang Kosong</h2>
        @endif
        @php
            static $i = 0;
        @endphp

    </div>
@endsection
