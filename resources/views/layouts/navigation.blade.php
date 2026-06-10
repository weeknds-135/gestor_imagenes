<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-bold text-white" href="{{ route('dashboard') }}">
            <svg viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2" style="height: 32px; width: auto; fill: #FF2D20;">
                <path d="M7.12 0C2.92 0 0 2.92 0 7.12v43.43c0 4.2 2.92 7.12 7.12 7.12h43.43c4.2 0 7.12-2.92 7.12-7.12V7.12C57.67 2.92 54.75 0 50.55 0H7.12z" fill="#FF2D20"/>
                <path d="M17.37 14.64h22.92M17.37 26.68h22.92M17.37 38.72h13.8" stroke="#fff" stroke-width="4" stroke-linecap="round"/>
            </svg>
            <span>GestorImágenes</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold text-white' : '' }}" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('albums.*') ? 'active fw-bold text-white' : '' }}" href="{{ route('albums.index') }}">
                        Mis Álbumes
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" aria-labelledby="navbarDropdownUser">
                        <div class="px-3 py-2 small text-muted border-bottom mb-1">
                            <div class="fw-bold text-dark text-truncate" style="max-width: 180px;">{{ Auth::user()->name }}</div>
                            <div class="text-truncate" style="max-width: 180px;">{{ Auth::user()->email }}</div>
                        </div>
                        <li>
                            <a class="dropdown-menu-item dropdown-item py-2 small" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person me-2"></i>Mi Perfil
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger py-2 small">
                                    <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>