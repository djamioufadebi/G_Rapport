@extends('layouts.app')
<!-- Assurez-vous d'adapter le nom du layout si nécessaire -->

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header bg-primary text-white text-center">
          @csrf
          <h5>Attente de validation du compte</h5>
        </div>
        <div class="card-body">
          <p>Votre inscription a été effectuée avec succès.</p>
          <p>Merci de patienter pendant que votre compte est en attente de validation par l'administrateur de :</p>
          <ul>
            <li>Nom de la société : INNOVATION BULDING BUSINESS</li>
            <li>Téléphone : (+229) 97000044</li>
            <li>Email de contact : <a href="mailto:infos@inov2b.com">infos@inov2b.com</a></li>
          </ul>
          <p>Veuillez contacter l'administrateur :</p>
          <ul>
            <li>Email : <a href="mailto:mail.admin@inov2b.com">mail.admin@inov2b.com</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  @endsection