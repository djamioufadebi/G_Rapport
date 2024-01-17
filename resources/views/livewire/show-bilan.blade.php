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
    <div class="container mt-8">

      <a href="{{ route('bilans.pdf')}}">
        <button class="btn btn-primary btn-sm">
          Rapport Journalier
        </button>
      </a>
      <hr>
      <form action="{{route('bilans.activite')}}" method="POST">
        @csrf
        @method('POST')
        <div class="row">
          <!-- Champs de sélection pour le activite -->
          <div class="col-md-3">
            <div class="form-group">
              <label for="activite">Activité :</label>
              <div class="input-group">
                <select name="id_activite" wire:model="selectedActiviteId" class="form-control form-control-md"
                  required>
                  @foreach ($activites as $item)
                  <option value="{{ $item->id }}">{{ $item->nom }}</option>
                  @endforeach
                </select>
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fa fa-chevron-down"></i></span>
                </div>
              </div>
            </div>
          </div>

          <!-- Boutons de soumission -->
          <div class="col-md-3 align-self-end">
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-sm">Faire Bilan</button>
            </div>
          </div>
          <div class="col-md-3 align-self-end">
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-file-pdf"></i> PDF</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <hr>
    <form action="{{route('bilans.pdf') }}" method="POST">
      @csrf
      @method('POST')
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
              <input type="date" id="date_debut" name="date_debut" class="form-control form-control-md" required>
            </div>
          </div>
          <div class="col-md-1 text-center">
            <span>à</span>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <input type="date" id="date_fin" name="date_fin" class="form-control form-control-md" required>
            </div>
          </div>
          <div class="col-md-2">
            <a href="{{ route('bilans.pdf') }}" class="btn btn-primary btn-sm">
              Bilan
            </a>
          </div>
        </div>
      </div>
    </form>
    <hr>
  </div>

  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>