<nav class="navbar navbar-expand-md sticky-top border-0 border-bottom bg-body">
    <div class="container">
        <a class="navbar-brand" href="/">AtBram</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ active_if_path('account') }}" href="/account">Rekening</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_if_path('category') }}" href="/category">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_if_path('activity') }}" href="/activity">Aktifitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_if_path('transfer') }}" href="/transfer">Transfer</a>
                    </li>
                    @can('viewAny', App\Models\User::class)
                        <li class="nav-item">
                            <a class="nav-link {{ active_if_path('user') }}" href="/user">Pengguna</a>
                        </li>
                    @endcan
                    <li class="nav-item dropdown">
                        <a href="/report" class="nav-link dropdown-toggle" role="button"
                            data-bs-toggle="dropdown">Laporan&nbsp;</a>
                        <ul class="dropdown-menu">
                            <li><a href="/report/statement" class="dropdown-item">Laporan keuangan</a></li>
                            <li><a href="/report/summary" class="dropdown-item">Laporan ringkasan keuangan</a></li>
                        </ul>
                    </li>
                </ul>
            @endauth

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a href="/me" class="nav-link dropdown-toggle" role="button"
                            data-bs-toggle="dropdown">{{ auth()->user()->name }}&nbsp;</a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="/profile">
                                    <i class="bi bi-person-circle"></i>
                                    &nbsp;Profile
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="/logout">
                                    <i class="bi bi-box-arrow-right"></i>
                                    &nbsp;Logout</a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="/login" class="nav-link">Login</a>
                    </li>
                @endauth

                <li id="theme-toggler" class="nav-item dropdown ms-2">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-auto"></i> </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="py-1">
                            <a class="dropdown-item" href="#" data-bs-theme-value="light"><i
                                    class="bi bi-sun"></i>&nbsp;&nbsp;Light</a>
                        </li>
                        <li class="py-1">
                            <a class="dropdown-item" href="#" data-bs-theme-value="dark"><i
                                    class="bi bi-moon"></i>&nbsp;&nbsp;Dark</a>
                        </li>
                        <li class="py-1">
                            <a class="dropdown-item" href="#" data-bs-theme-value="auto"><i
                                    class="bi bi-circle-half"></i>&nbsp;&nbsp;Auto</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
