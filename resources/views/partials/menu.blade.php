<ul class="menu">
    @if (Auth::user()->roles[0]->name === 'Customer')
        <li class="{{ Request::is('customer/dashboard') || Request::is('customer/dashboard/*') ? 'active' : '' }}">
            <a href="{{ route('customer.dashboard') }}">Dashboard (Customer)</a>
        </li>
        <li class="{{ Request::is('customer/produk') || Request::is('customer/produk/*') ? 'active' : '' }}">
            <a href="{{ route('customer.produk') }}">Produk (Customer)</a>
        </li>
        <li class="{{ Request::is('customer/pemesanan') || Request::is('customer/pemesanan/*') ? 'active' : '' }}">
            <a href="{{ route('customer.pemesanan') }}">Pemesanan (Customer)</a>
        </li>
        <li class="{{ Request::is('customer/pembayaran') || Request::is('customer/pembayaran/*') ? 'active' : '' }}">
            <a href="{{ route('customer.pembayaran') }}">Pembayaran (Customer)</a>
        </li>
        <li class="{{ Request::is('customer/riwayat') || Request::is('customer/riwayat/*') ? 'active' : '' }}">
            <a href="{{ route('customer.riwayat') }}">Riwayat (Customer)</a>
        </li>
    @elseif(Auth::user()->roles[0]->name === 'Admin')
        <li class="{{ Request::is('dashboard') || Request::is('dashboard/*') ? 'active' : '' }}">
            <a href="/dashboard">Dashboard (Admin)</a>
        </li>
        <li class="{{ Request::is('pembayaran') || Request::is('pembayaran/*') ? 'active' : '' }}">
            <a href="{{ route('admin.pembayaran') }}">Pembayaran (Admin)</a>
        </li>
        <li class="{{ Request::is('pengiriman') || Request::is('pengiriman/*') ? 'active' : '' }}">
            <a href="{{ route('admin.pengiriman') }}">Pengiriman (Admin)</a>
        </li>
        <li class="{{ Request::is('riwayat') || Request::is('riwayat/*') ? 'active' : '' }}">
            <a href="{{ route('admin.riwayat') }}">Riwayat (Admin)</a>
        </li>
    @elseif(Auth::user()->roles[0]->name === 'Super Admin')
        <li class="{{ Request::is('sp/users') || Request::is('sp/users/*') ? 'active' : '' }}">
            <a href="">Data User (Sp)</a>
        </li>
    @elseif(Auth::user()->roles[0]->name === 'Gudang')
        <li class="{{ Request::is('gudang/dashboard') || Request::is('gudang/dashboard/*') ? 'active' : '' }}">
            <a href="{{ route('gudang.dashboard') }}">Dashboard (Gudang)</a>
        </li>
        <li class="{{ Request::is('gudang/produk') || Request::is('gudang/produk/*') ? 'active' : '' }}">
            <a href="{{ route('gudang.produk') }}">Produk (Gudang)</a>
        </li>
    @elseif(Auth::user()->roles[0]->name === 'Pemilik')
        <li class="{{ Request::is('pemilik/') || Request::is('pemilik/*') ? 'active' : '' }}">
            <a href="{{ route('dashboard.pemilik') }}">Dashboard (Laporan)</a>
        </li>
    @endif
</ul>
