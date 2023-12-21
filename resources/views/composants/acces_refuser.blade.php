@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card">
        <div class="card-header bg-danger text-white">
          <h1 class="card-title">Accès Refusé</h1>
        </div>
        <div class="card-body">
          <p class="card-text">Désolé, vous n'avez pas l'autorisation nécessaire pour accéder à cette page.</p>
          <p class="card-text">Contactez léquipe de l'application ou l'administrateur</p>
          <p class="card-text">Téléphone : 06 66 66 66 66</p>
          <p class="card-text">Email : contact@exemple.com</p>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection