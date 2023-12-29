<style>
.notification-badge {
  display: inline-block;
  padding: 6px 12px;
  font-size: 14px;
  font-weight: bold;
  border-radius: 20px;
}

.badge-warning {
  background-color: #ffc107;
  color: #333;
}

.badge-danger {
  background-color: #dc3545;
  color: #fff;
}
</style>

<div>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav me-auto">

      <li class="nav-item dropdown" onmouseover="showDropdown(this)">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          Administration
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <!-- Sous-menu Administration -->
          <li><a class="dropdown-item" href="{{ route('profils') }}">Profils</a></li>
          <!-- <li><a class="dropdown-item" href="{{ route('roles') }}">Rôles</a></li> -->
          <li><a class="dropdown-item" href="{{ route('users') }}">Utilisateurs</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('projets')}}">{{ __('Projets') }}</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('activites')}}">{{ __('Activités') }}</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          Partenaires
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <!-- Sous-menu Administration -->
          <li class="nav-item">
            <a class="nav-link" href="{{ route('clients')}}">{{ __('Nos Clients') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('intervenants')}}">{{ __('Intervenants') }}</a>
          </li>
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          Demandes
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <!-- Sous-menu Administration -->
          <li class="nav-item">
            <a class="nav-link" href="{{ route('rapports')}}">{{ __('Rapports') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('besoins')}}">{{ __('Besoins') }}</a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('notifications')}}">
          {{ __('Notifications') }}
          <!-- Conditions pour afficher le nombre du notification -->
          <span class="notification-badge
            @if ($CountNotReadNotifications > 0)
                @if ($CountNotReadNotifications <= 5)
                    badge-warning
                @else
                    badge-danger
                @endif
            @endif
        "> {{ $CountNotReadNotifications }}</span>
        </a>
      </li>
    </ul>
  </div>
  @livewireScripts
</div>
