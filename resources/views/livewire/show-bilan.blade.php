<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Rapport Journalier et Bilan</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
    <div class="container mt-8">

      <a href="{{ route('bilans.pdf')}}">
        <button class="btn btn-primary btn-sm">
          <strong>Bilan Journalier</strong>
        </button>
      </a>
      <hr>

      <div>
        <form action="{{route('bilans.activite')}}" method="POST">
          @csrf
          @method('POST')
          <div class="row">
            <!-- Champs de sélection pour le activite -->
            <div class="col-md-3">
              <div class="form-group">
                <label for="activite"><strong>Activité :</strong></label>
                <div class="input-group">
                  <select name="id_activite" wire:model="selectedActiviteId2" class="form-control form-control-md"
                    id="id_activite" required>
                    <option value=""> </option>
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
                <button type="submit" class="btn btn-primary btn-sm">Bilan Journalier de l'activité</button>
              </div>
            </div>
            <div class="col-md-3 align-self-end">
              <!-- Un autre bouton ici -->
            </div>
          </div>
        </form>
      </div>
    </div>
    <hr>

    <div class="container mt-8">
      <!-- Bilan pour un projet donnée -->
      <div>
        <form action="{{route('bilans.projets')}}" method="POST">
          @csrf
          @method('POST')
          <div class="row">
            <!-- Champs de sélection de projet -->
            <div class="col-md-3">
              <div class="form-group">
                <label for="projet"> <strong> Projet :</strong></label>
                <div class="input-group">
                  <select name="id_projet" wire:model="selectedProjetId" class="form-control form-control-md"
                    id="id_projet" required>
                    <option value=""> </option>
                    @foreach ($projets as $item)
                    <option value="{{ $item->id }}">{{ $item->libelle }}</option>
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
                <button type="submit" class="btn btn-primary btn-sm"> Bilan Journalier du projet</button>
              </div>
            </div>
            <div class="col-md-3 align-self-end">
              <!-- Un autre bouton ici -->
            </div>
          </div>
        </form>
      </div>
    </div>
    <hr>

    <!-- Pour période -->
    <div>
      <form action="{{route('bilans.periode')}}" method="POST">
        @csrf
        @method('POST')
        <div class="container mt-8">
          <div class="row">

            <div class="col-md-3">
              <label for="projet"> <strong>Projet : </strong> </label>
              <div class="input-group">
                <select name="id_projet" wire:model="selectedProjetId" class="form-control form-control-md"
                  id="id_projet" required>
                  <option value=""> </option>
                  @foreach ($projets as $item)
                  <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                  @endforeach
                </select>
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fa fa-chevron-down"></i></span>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-1">
            <label for="periode"><strong>Période</strong></label>
          </div> -->


            <div class="col-md-2">
              <div class="form-group">
                <label for="projet"> <strong> Période De :</strong></label>
                <input type="date" id="date_debut" wire:model="selectedDatedebut" name="date_debut"
                  class="form-control form-control-md" required>
                <div class="error-message invalid-feedback" style="display: none;">Le champ date debut est requis.</div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label for="projet"><strong>A :</strong></label>
                <input type="date" id="date_fin" wire:model="selectedDatefin" name="date_fin"
                  class="form-control form-control-md" required>
                <div id="date_fin_error" class="error-message invalid-feedback" style="display: none;">La date de fin ne
                  peut pas être antérieure à la date de début.</div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="projet"><strong>Action</strong></label>
                <button class="btn btn-primary btn-sm">
                  Génerer Bilan
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <hr>
  </div>

  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

@livewireScripts()

<script src="{{asset('js\js_activite\date-condition_activite.js')}}"></script>
