<div class="row">
  <div class="card">
    <div class="card-body container-fluid ">
      <form method="POST" wire:submit.prevent="store">
        @csrf
        @method('POST')

        @if(session('dejautiliser'))
        <script>
        Swal.fire({
          title: ' Erreur d\'enregistrement!',
          text: 'Ce projet existe déjà dans la base!',
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
          <label for="libelle" class="form-label">libelle :</label>
          <input type="text" class="form-control  @error('libelle')is-invalid
           @enderror" id="libelle" name="libelle" wire:model="libelle" required>
          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('libelle')
          <div class="invalid-feedback">Le champ libelle est requis.</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description :</label>
          <textarea class="form-control  @error('description')is-invalid
           @enderror" id="description" wire:model="description" name="description" required></textarea>
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
          <input type="date" class="form-control  @error('date_fin_prevue')
            is-invalid @enderror" id="date_fin_prevue" wire:model="date_fin_prevue" name="date_fin_prevue" required>

          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('date_fin_prevue')
          <div class=" invalid-feedback">Le champ date_fin est requis.</div>
          @enderror
        </div>

        <!-- Le client -->
        <div class="mb-3">
          <label>Le nom du client</label>
          <select class="form-select @error('id_client') is-invalid @enderror" id="id_client" wire:model="id_client"
            name="id_client">
            <option value=""></option>
            <!--  La boucle pour afficher la liste des clients -->
            @foreach ($currentClient as $item )
            <option value="{{$item->id}}">{{$item->nom}}</option>
            @endforeach

          </select>
          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('id_client')
          <div class="invalid-feedback">Le client est requis.</div>
          @enderror
        </div>

        <div class=" row d-flex justify-content-between mb-3">
          <div class="col-md-3">
            <button type="button" class="btn btn-danger">
              <a href="{{route('projets')}}" class=" text-white fs-6" style="text-decoration:none;">Annuler</a></button>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary text text-bold">Enregistrer</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>