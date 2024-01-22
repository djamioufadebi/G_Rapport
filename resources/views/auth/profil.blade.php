@extends('layouts.app')

@section('content')
<div class="container-md">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card bg-light">
        <div class="card-header bg-primary text-white">{{ __('Mon Profil') }}</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
           @if (session('error'))
          <div class="alert alert-danger" role="alert">
            {{ session('error') }}
          </div>
          @endif

          @include('composants.sweetalert-message')

          <div class="text-center mb-4">
            <img src="{{ asset('images/profil.jpg')}}" alt="" width="100px" height="100px"
              class="rounded-circle border border-primary">
          </div>
          <form action="{{ route('mon_profile.update') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="photo" class="form-label">Changer une photo de profil</label>
              <input type="file" class="form-control" name="photo">
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" value="{{ Auth::user()->nom }}" required>
              </div>
              <div class="col-md-6">
                <label for="prenom" class="form-label">Prenom</label>
                <input type="text" class="form-control" name="prenom" value="{{ Auth::user()->prenom }}" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-success">Mettre à jour</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
