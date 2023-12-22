@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Mon Profil') }}</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          @include('composants.sweetalert-message')

          @if (session('error'))
          <div class="alert alert-success" role="alert">
            {{ session('error') }}
          </div>
          @endif
          <div>
            <img src="{{ asset('asset/storage/profil.jpg')}}" alt="" width="100px" height="100px">
          </div>
          <form action="{{ route('mon_profile.update') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="photo">Changer la photo de profil</label>
              <input type="file" class="form-control" name="photo">
            </div>
            <div class="mb-3">
              <label for="nom">Nom</label>
              <input type="text" class="form-control" name="nom" value="{{ Auth::user()->nom }}" required>
            </div>
            <div class="mb-3">
              <label for="prenom">Prenom</label>
              <input type="text" class="form-control" name="prenom" value="{{ Auth::user()->prenom }}" required>
            </div>
            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
            </div>
            <div class="mb-3">
              <label for="password">Ancien mot de passe</label>
              <input type="password" class="form-control" name="old_password" value="{{ Auth::user()->password }}"
                required>
            </div>
            <div class="mb-3">
              <label for="password">Nouveau mot de passe</label>
              <input type="password" class="form-control" name="new_password" value="" required>
            </div>
            <div class="mb-3">
              <label for="password_confirmation">Confirmer le mot de passe</label>
              <input type="password" class="form-control" name="confirmation_new_password"
                value="{{ Auth::user()->password_confirmation }}" required>
            </div>
            <br>
            <div>
              <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success">Mettre à jour</a>
            </div>
          </form>
          <br>
        </div>

      </div>

    </div>
  </div>
</div>
</div>

@endsection