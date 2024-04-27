<style>
    .notification-badge {
        display: inline-block;
        padding: 6px 12px;
        font-size: 14px;
        font-weight: bold;
        border-radius: 20px;
        animation: blink-animation 3s infinite;
        /* Animation du clignotement */
    }

    .badge-warning {
        background-color: #ffc107;
        color: #333;
    }

    .badge-danger {
        background-color: #dc3545;
        color: #fff;
    }

    @keyframes blink-animation {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }
</style>

<div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto">

            @if (Auth::user()->id_profil == 1)
                <li class="nav-item dropdown" onmouseover="showDropdown(this)">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Administration
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <!-- Sous-menu Administration -->
                        <li><a class="dropdown-item" href="{{ route('profils') }}">Profils</a></li>

                        <li><a class="dropdown-item" href="{{ route('users') }}">Utilisateurs</a></li>
                    </ul>
                </li>
            @endif

            <li class="nav-item dropdown" onmouseover="showDropdown(this)">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-bs-toggle="dropdown" aria-expanded="true">
                    Gestion des projets
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <!-- Sous-menu Administration -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('projets') }}">{{ __('Projets') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('activites') }}">{{ __('Activités') }}</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item dropdown" onmouseover="showDropdown(this)">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Partenaires
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <!-- Sous-menu Administration -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clients') }}">{{ __('Clients') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('intervenants') }}">{{ __('Intervenants') }}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown" onmouseover="showDropdown(this)">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Gestion et Suivi
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <!-- Sous-menu Administration -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rapports') }}">{{ __('Rapports') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('besoins') }}">{{ __('Besoins') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bilans') }}">{{ __('Bilans') }}</a>
                    </li>
                </ul>
            </li>
            <!-- Pour notifications -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('notifications') }}"><i class="fas fa-envelope"></i>
                    <!-- Conditions pour afficher le nombre du notification -->
                    <span
                        class="notification-badge
            @if ($CountNotReadNotifications > 0) @if ($CountNotReadNotifications <= 5)
                    badge-warning
                @else
                    badge-danger @endif
                 badge-blink
            @endif ">
                        {{ $CountNotReadNotifications }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
