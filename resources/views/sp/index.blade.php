@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@push('title')
    <title>User</title>
@endpush

@section('content')
    <div class="gudang-produk">
        <div>
            @include('partials.header')
            @include('partials.menu')
            @include('partials.menu2')
        </div>
        <div class="gudang-produk-list">
            <a class="btn-1" href="{{ route('sp.users.create.view') }}"><span>Tambah User</span></a>
            <div style="margin-top: 20px">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Role</th>
                            <th scope="col">Alamat</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @php
                                static $i = 0;
                            @endphp
                            @if (isset($user['roles'][0]) && $user['roles'][0]->name !== 'Customer')
                                <tr>
                                    <th scope="row">{{ ++$i }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user['roles'][0]->name }}</td>
                                    <td>{{ $user->alamat }}</td>
                                    <div>
                                        <form method="POST" action="{{ route('sp.users.delete', $user->id) }}">
                                            <td class="td-action">
                                                <a href="{{ route('sp.users.detail', $user->id) }}">
                                                    <img src="{{ asset('/icons/ic_view.png') }}" style="width: 24px"
                                                        alt="Icon View">
                                                </a>
                                                <a href="{{ route('sp.users.edit', $user->id) }}">
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
                            @endif
                        @endforeach
                    </tbody>

                </table>
                {{-- <div class="paginate-link">
                    {!! $produks->links() !!}
                </div> --}}
            </div>
        </div>
    </div>
@endsection
