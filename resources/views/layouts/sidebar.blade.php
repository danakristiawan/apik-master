@auth
    <a href="{{ route('home') }}"
        class="list-group-item list-group-item-action {{ Request::is('home') ? 'active' : '' }}">Home
        Page</a>
    @can('operator')
        <a href="{{ route('data-rekening.index') }}"
            class="list-group-item list-group-item-action {{ Request::is('data-rekening') ? 'active' : '' }}">Data Rekening</a>
        <a href="{{ route('rekening-koran.index') }}"
            class="list-group-item list-group-item-action {{ Request::is('rekening-koran') ? 'active' : '' }}">Rekening Koran</a>
        <a href="{{ route('buku-kas-umum.index') }}"
            class="list-group-item list-group-item-action {{ Request::is('buku-kas-umum') ? 'active' : '' }}">Buku Kas Umum</a>
        <a href="{{ route('bni.index') }}"
            class="list-group-item list-group-item-action {{ Request::is('bni') ? 'active' : '' }}">Data BNI</a>
        <a href="{{ route('ref-nomor-nota.index') }}"
            class="list-group-item list-group-item-action {{ Request::is('ref-nomor-nota') ? 'active' : '' }}">Ref Nomor
            Nota</a>
    @endcan
    @can('supervisor')
        <a href="{{ route('referensi-bank.index') }}"
            class="list-group-item list-group-item-action {{ Request::is('referensi-bank') ? 'active' : '' }}">Referensi
            Bank</a>
        <a href="{{ route('user.index') }}"
            class="list-group-item list-group-item-action {{ Request::is('user') ? 'active' : '' }}">Referensi User</a>
    @endcan
@else
    <a href="{{ route('login') }}"
        class="list-group-item list-group-item-action {{ Request::is('login') ? 'active' : '' }}">Login
        Page</a>
    <a href="{{ route('auth.register') }}"
        class="list-group-item list-group-item-action {{ Request::is('auth/register') ? 'active' : '' }}">Register
        Page</a>
@endauth
