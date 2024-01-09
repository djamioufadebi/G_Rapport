<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Rapport Journalier et Bilan</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
  /* Ajouter des styles personnalisés ici si nécessaire */
  </style>
</head>

<body>
  <div class="container mt-5">
    <hr>
    <a href="{{ route('bilans.pdf')}}">
      <button class="btn btn-primary">
        Rapport Journalier
      </button>
    </a>
    <form action="{{ route('bilans.pdf') }}" method="POST">
      @csrf
      <hr>
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-3">
            <label for="date_debut"><strong>Période</strong></label>
          </div>
          <div class="col-md-2">
            <span>De :</span>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <input type="date" id="date_debut" name="date_debut" class="form-control form-control-sm" required>
            </div>
          </div>
          <div class="col-md-1 text-center">
            <span>à</span>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <input type="date" id="date_fin" name="date_fin" class="form-control form-control-sm" required>
            </div>
          </div>
          <div class="col-md-2">
            <a href="{{ route('bilans.pdf') }}" class="btn btn-primary">
              Bilan
            </a>
          </div>
        </div>
      </div>
    </form>
    <hr>
    <hr>
    <div class="container mt-5">
      <form action="{{ route('bilans.pdf') }}" method="POST">
        @csrf
        <div class="row">
          <!-- Champs de sélection pour le projet -->
          <div class="col-md-3">
            <div class="form-group">
              <label for="projet">Projet :</label>
              <div class="input-group">
                <select id="projet" name="projet" class="form-control form-control-sm" required>
                  <option value=""></option>
                  <!-- Boucle pour les options -->
                  @foreach ($projets as $projet)
                  <option value="{{ $projet->id }}">{{ $projet->nom }}</option>
                  @endforeach
                </select>
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fa fa-chevron-down"></i></span>
                </div>
              </div>
            </div>
          </div>

          <!-- Champs de sélection pour l'activité -->
          <div class="col-md-3">
            <div class="form-group">
              <label for="activite">Activité :</label>
              <div class="input-group">
                <select id="activite" name="activite" class="form-control form-control-sm" required>
                  <option value=""></option>
                  <!-- Boucle pour les options -->
                  @foreach ($activites as $activite)
                  <option value="{{ $activite->id }}">{{ $activite->nom }}</option>
                  @endforeach
                </select>
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fa fa-chevron-down"></i></span>
                </div>
              </div>
            </div>
          </div>

          <!-- Bouton de soumission -->
          <div class="col-md-6 align-self-end">
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Générer Rapport</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>