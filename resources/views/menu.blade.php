<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INOV2'B - Accueil</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- Ajoutez d'autres liens CSS nécessaires -->
</head>

<body>

  <!-- Barre de navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="#">INNOVATION BULDING BUSNESS</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{route('projets')}}">Les projets</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{route('clients')}}">Nos clients</a>
          </li>
          <!-- Ajoutez d'autres liens de navigation -->
        </ul>
      </div>
    </div>
  </nav>

  <!-- Contenu de la page d'accueil -->
  <div class="container mt-4">
    <div class="jumbotron">
      <h2 class="display-4">Bienvenue </h2>
      <p class="lead">Votre plateforme de gestion de projets, rapports et besoins.</p>
      <hr class="my-4">
      <p>Explorez les fonctionnalités et gérez vos activités plus efficacement.</p>
    </div>

    <div class="row">

      <div class="col">
        <div class="col-md-10">
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">Projets</h5>
              <p class="card-text">Gérez vos projets, affectez des ressources et suivez les étapes clés.</p>
              <a href="{{route('projets')}}" class="btn btn-primary">Accéder aux projets</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="col-md-10">
          <div class="card mb-8">
            <div class="card-body">
              <h5 class="card-title">Activités</h5>
              <p class="card-text">Gérez vos activités quotidiennes avec facilité et précision.</p>
              <a href="{{route('activites')}}" class="btn btn-primary">Accéder aux projets</a>
            </div>
          </div>
        </div>
        <!-- Ajoutez d'autres cartes pour les fonctionnalités -->
      </div>


      <div class="col">
        <div class="col-md-10">
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">Besoins</h5>
              <p class="card-text">Ne perdez plus de temps. Du suivi des tâches aux rapports détaillés. Tout est à
                portée d'un clic !.</p>
              <a href="{{route('besoins')}}" class="btn btn-primary">Accéder aux Besoins</a>
            </div>
          </div>
        </div>
      </div>


      <div class="col">
        <div class="col-md-10">
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title">Rapports</h5>
              <p class="card-text">Des rapports détaillés, des décisions éclairées et des actions précises.</p>
              <a href="{{route('rapports')}}" class="btn btn-primary">Accéder aux rapport</a>
            </div>
          </div>
        </div>
      </div>


    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Ajoutez d'autres scripts JS si nécessaire -->
</body>

</html>
