<nav class="navbar navbar-light db-header">
    <div class="container-fluid">
        <a href="/" style="color: white"
            class="mb-0 h3 nav-user-title">{{ isset(Auth::user()->name) ? Auth::user()->name : '' }} |
            {{ isset(Auth::user()->name)? Auth::user()->roles()->first()->name: '' }}</a>

        <div class="d-flex">
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('user.logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <a class="dropdown-item" href="{{ route('user.profil') }}">
                        Profil
                    </a>

                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </div>
</nav>
