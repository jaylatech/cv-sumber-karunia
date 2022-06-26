@php
use App\Models\Order;
@endphp

<div class="header">
    <h2>CV. SUMBER KARUNIA</h2>
    @if (Auth::user()->roles[0]->name === 'Customer')
        <a href="{{ route('customer.keranjang', Auth::user()->id) }}" class="btn btn-chart">
            Keranjang <span class="badge bg-secondary">{{ count(Auth::user()->keranjangs()->get()) }}</span>
        </a>
    @elseif(Auth::user()->roles[0]->name === 'Admin')
        <a type="button" href="{{ route('admin.pemesanan') }}" class="btn btn-chart">
            Pesanan Masuk <span
                class="badge bg-secondary">{{ count(Order::where('status', 'Menunggu Konfirmasi')->get()) }}</span>
        </a>
    @endif
</div>
