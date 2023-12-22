<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">



  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Importation de jQuery pour faire -->
  <!--
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">



  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>

  <!-- Importation de sweetalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  <!-- importation tab.js pour les onglets -->
  <script src="{{ asset('js/tab.js') }}"></script>

  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
          <img src="images/innov2b.jpg" class="img-fluid" width="100" height="auto" alt="" srcset="">
        </a>
        <a class="navbar-brand" href="{{ url('/home') }}">
          {{ config('app.name', 'Laravel') }}
        </a>

        @if (auth::user())
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav me-auto">

            <li class="nav-item dropdown" onmouseover="showDropdown(this)">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                Administration
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <!-- Sous-menu Administration -->
                <li><a class="dropdown-item" href="{{ route('profils') }}">Profils</a></li>
                <li><a class="dropdown-item" href="{{ route('roles') }}">Rôles</a></li>
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
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
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
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
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
          </ul>

          <!-- center side navbar: notification-->
          <div class="dropdown">

            <div class="col">
              <i class="fa fa-bell"></i>
              <img src="images/notification.png" class="img-fluid" width="30" height="auto" alt="icone notifs" sizes=""
                srcset="">
              <a class="dropdown-toggle" href="#" role="button" id="notificationDropdown" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Notifications
              </a>

            </div>
            <div class="dropdown-menu" aria-labelledby="notificationDropdown">
              <!-- Afficher les notifications ici -->

            </div>
          </div>

          <!-- fin : notification -->

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
              </a>

              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('mon_profile') }}">Mon Profil </a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </li>
            @endguest
          </ul>
        </div>
        @endif
      </div>
    </nav>

    <main class="py-4">
      @yield('content')
    </main>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>


</html>
