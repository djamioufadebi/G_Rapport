<head>
  @livewireStyles
  <style>
  .form-range {
    width: 100%;
    margin: 10px 0;
  }
  </style>
</head>

<body>
  <div class="row">
    <div class="card">
      <div class="card-body container-fluid ">
        <form method="POST" wire:submit.prevent="store">
          @csrf
          @method('POST')

          @if(session('dejautiliser'))
          <script>
          Swal.fire({
            title: 'Erreur d\'enregistrement!',
            text: 'Ce rapport existe déjà dans la base !',
            icon: 'error',
            confirmButtonText: 'OK'
          })
          </script>
          @endif

          @if(session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
          @endif

          <div class="mb-3">
            <label for="libelle" class="form-label">libelle (*) :</label>
            <input type="text" class="form-control  @error('libelle')is-invalid
           @enderror" name="libelle" wire:model="libelle" required>
            <!-- afiche le message d'erreur si le champs est vide  -->
            @error('libelle')
            <div class="invalid-feedback">Le champ libelle est requis.</div>
            @enderror

          </div>

          <div class="mb-3">
            <label for="contenu" class="form-label">Contenu (*) :</label>
            <textarea class="form-control  @error('contenu') is-invalid
           @enderror" wire:model="contenu" name="contenu" id="contenu" rows="4" required></textarea>

            <!-- afiche le message d'erreur si le champs est vide  -->
            @error('contenu')
            <div class="invalid-feedback">Le champ contenu est requis.</div>
            @enderror
          </div>

          <!-- Taux de réalisation avec barre de progression -->
          <div class="mb-3">
            <label for="taux_de_realisation" class="form-label">Taux de réalisation :</label>
            <input type="range" class="form-range @error('taux_de_realisation') is-invalid @enderror"
              id="taux_de_realisation" wire:model="taux_de_realisation" name="taux_de_realisation" min="0" max="100"
              step="0.1" required>
            <output id="taux_value" class="mt-2">{{$taux_de_realisation}}%</output>
            @error('taux_de_realisation')
            <div class="invalid-feedback">Le champ taux_de_realisation est requis.</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="materiels_utilises" class="form-label">Materiels Utilisés (*) :</label>
            <textarea class="form-control  @error('materiels_utilises') is-invalid
           @enderror" wire:model="materiels_utilises" name="materiels_utilises" id="materiels_utilises" rows="4"
              required></textarea>

            <!-- afiche le message d'erreur si le champs est vide  -->
            @error('materiels_utilises')
            <div class="invalid-feedback">Le champ materiels_utilises est requis.</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="difficultes_rencontrees" class="form-label">Difficultés rencontrées :</label>
            <textarea class="form-control  @error('difficultes_rencontrees') is-invalid
           @enderror" wire:model="difficultes_rencontrees" name="difficultes_rencontrees" id="difficultes_rencontrees"
              rows="4" required></textarea>
            <!-- Affiche le message d'erreur si le champ est vide -->
            @error('difficultes_rencontrees')
            <div class="invalid-feedback">Le champ difficultés est requis.</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="solutions_apportees" class="form-label">Solutions apportées :</label>
            <textarea class="form-control @error('solutions_apportees') is-invalid
           @enderror " wire:model="solutions_apportees" name="solutions_apportees" id="solutions_apportees" rows="4"
              required></textarea>
            <!-- Affiche le message d'erreur si le champ est vide -->
            @error('solutions_apportees')
            <div class="invalid-feedback">Le champ Solutions est requis.</div>
            @enderror
          </div>

          <!-- Champs choix de projet -->
          <div class="mb-3">
            <label>Activité (*)</label>
            <select class="form-select @error('id_activite') is-invalid @enderror" id="id_activite"
              wire:model="id_activite" name="id_activite">
              <option value=""></option>
              <!--  La boucle pour afficher la liste des projets -->
              @foreach ($listeActivite as $item )
              <option value="{{$item->id}}">{{$item->nom}}</option>
              @endforeach
            </select>

            <!-- afiche le message d'erreur si le champs est vide  -->
            @error('id_activite')
            <div class="text text-red-500 mt-1 animate-pulse">Le nom du projet est requis.</div>
            @enderror
          </div>
      </div>


      <div class=" row d-flex justify-content-between mb-3">
        <div class="col-md-3">
          <button type="button" class="btn btn-danger">
            <a href="{{route('rapports')}}" class=" text-white fs-6" style="text-decoration:none;">Annuler</a></button>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary text text-bold">Enregistrer</button>
        </div>
      </div>

      </form>
    </div>
  </div>
  </div>
</body>

@livewireScripts
<!-- Assurez-vous d'ajouter cette ligne pour les scripts de Livewire -->
<script src="{{ asset('js/condition-champ.js') }}"></script>
<script src="{{ asset('js/barre-progression.js') }}"></script>