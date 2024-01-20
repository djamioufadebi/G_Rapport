<div class="row">
  <div class="card">
    <div class="card-body container-fluid ">
      <form method="POST" wire:submit.prevent="update">
        @csrf
        @method('POST')


        @if(session('error'))
        <script>
        Swal.fire({
          title: 'Erreur!',
          text: 'Erreur d\'enregistrement du besoin',
          icon: 'error',
          confirmButtonText: 'OK'
        })
        </script>
        @endif

        @if(session('dejautiliser'))
        <script>
        Swal.fire({
          title: 'Erreur d\'enregistrement!',
          text: 'Ce besoin existe déjà dans la base !',
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
          <label for="libelle" class="form-label">libellé :</label>
          <input type="text" class="form-control  @error('libelle')is-invalid
           @enderror" name="libelle" wire:model="libelle" id="libelle" required>
          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('libelle')
          <div class="invalid-feedback">Le champ libelle est requis.</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="contenu" class="form-label">Contenu :</label>
          <textarea class="form-control  @error('contenu') is-invalid
           @enderror" wire:model="contenu" name="contenu" id="contenu" rows="4" required></textarea>
          @error('contenu')
          <div class="invalid-feedback">Le champ contenu est requis.</div>
          @enderror
        </div>

        <!-- Champs choix de projet -->
        <!-- L'actvité -->
        <div class="mb-3">
          <label>Activité</label>
          <select class="form-select @error('id_activite') is-invalid @enderror" id="id_activite"
            wire:model="id_activite" name="id_activite" required>
            @foreach ($listeActivite as $item )
            <option value="{{$item->id}}">{{$item->nom}}</option>
            @endforeach
          </select>
          @error('id_activite')
          <div class="invalid-feedback">L'actvité est requis.</div>
          @enderror
        </div>
    </div>


    <div class=" row d-flex justify-content-between mb-3">
      <div class="col-md-3">
        <button type="button" class="btn btn-danger">
          <a href="{{route('besoins')}}" class=" text-white fs-6" style="text-decoration:none;">Annuler</a></button>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary text text-bold">Mettre à jour</button>
      </div>
    </div>

    </form>
  </div>
</div>

</div>
