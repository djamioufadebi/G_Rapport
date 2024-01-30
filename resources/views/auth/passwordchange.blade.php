@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Changer le mot de passe') }}</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          @if (session('success'))
          <div class="alert alert-success" role="alert">
            {{ session('success') }}
          </div>
          @endif

          @if (session('error'))
          <div class="alert alert-danger" role="alert">
            {{ session('error') }}
          </div>
          @endif

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form method="POST" action="{{route('password.changement')}}">
            @csrf
            @method('POST')

            <div class="form-group row">
              <label for="current_password"
                class="col-md-4 col-form-label text-md-right">{{ __('Ancien mot de passe') }}</label>
              <div class="col-md-6">
                <input id="current_password" type="password"
                  class="form-control @error('current_password') is-invalid @enderror" name="current_password" required
                  autocomplete="current-password">

                <!-- @error('current_password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror -->
              </div>
            </div>

            <div class="form-group row">
              <label for="new_password"
                class="col-md-4 col-form-label text-md-right">{{ __('Nouveau mot de passe') }}</label>
              <div class="col-md-6">
                <input id="new_password" type="password"
                  class="form-control @error('new_password') is-invalid @enderror" name="new_password" required
                  autocomplete="new-password">

                <!-- @error('new_password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror  minlength="8" -->
              </div>
            </div>

            <div class="form-group row">
              <label for="password_confirmation"
                class="col-md-4 col-form-label text-md-right">{{ __('Confirmation du nouveau mot de passe') }}</label>
              <div class="col-md-6">
                <input id="password_confirmation" type="password"
                  class="form-control  @error('password_confirmation') is-invalid @enderror"
                  name="password_confirmation" required autocomplete="new-password">

                <!-- @error('password_confirmation')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror -->
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Changer le mot de passe') }}
                </button>
                <a class="btn btn-link" href="{{ route('home') }}">
                  {{ __('Retour au tableau de bord') }}
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
<link href="{{ asset('css\password_css.css') }}" rel="stylesheet">
