<div class="row">
  <div class="card">
    <div class="card-body container-fluid ">
      <form method="POST" wire:submit.prevent="store">
        @csrf
        @method('POST')

        @if(session('dejatiliser'))
        <script>
        Swal.fire({
          title: 'Enregistrement impossible!',
          text: 'Une activité avec cet nom existe déjà dans la base !',
          icon: 'error',
          confirmButtonText: 'OK'
        })
        </script>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif

        <div class="mb-3">
          <label for="nom" class="form-label">Nom de l'Activité :</label>
          <input type="text" class="form-control  @error('nom')is-invalid
           @enderror" id="nom" name="nom" wire:model="nom" required>
          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('nom')
          <div class="invalid-feedback">Le champ nom est requis.</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description de l'activité :</label>
          <textarea class="form-control  @error('description')is-invalid
           @enderror" id="description" name="description" wire:model="description" rows="4" required></textarea>
          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('description')
          <div class="invalid-feedback">Le champ description est requis.</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="date_debut" class="form-label">Date Debut :</label>
          <input type="date" class="form-control  @error('date_debut')
            is-invalid @enderror " id="date_debut" wire:model="date_debut" name="date_debut" required>
          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('date_debut')
          <div class="invalid-feedback">Le champ date_debut est requis.</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="date_fin" class="form-label">Date Fin :</label>
          <input type="date" class="form-control  @error('date_fin')
            is-invalid @enderror" id="date_fin" wire:model="date_fin" name="date_fin" required>
          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('date_fin')
          <div class=" invalid-feedback">Le champ date_fin est requis.</div>
          @enderror
        </div>

        <!-- Champs choix de projet -->
        <div class="mb-3">
          <label>Le nom du projet</label>
          <select class="form-select @error('id_projet') is-invalid @enderror" id="id_projet" wire:model="id_projet"
            name="id_projet">
            <option value=""></option>
            <!--  La boucle pour afficher la liste des projets -->
            @foreach ($listeProjet as $item )
            <option value="{{$item->id}}">{{$item->libelle}}</option>
            @endforeach
          </select>

          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('id_projet')
          <div class="text text-red-500 mt-1 animate-pulse">Le niveau est requis.</div>
          @enderror
        </div>

        <div class=" row d-flex justify-content-between mb-3">
          <div class="col-md-3">
            <button type="button" class="btn btn-danger">
              <a href="{{route('activites')}}" class=" text-white fs-6"
                style="text-decoration:none;">Annuler</a></button>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary text text-bold">Enregistrer</button>
          </div>
        </div>

      </form>
    </div>
    </di v>
  </div>