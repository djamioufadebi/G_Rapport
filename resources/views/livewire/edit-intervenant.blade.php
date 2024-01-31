<div class="row">
  <div class="card">
    <div class="card-body container-fluid ">
      <form method="POST" wire:submit.prevent="update">
        @csrf
        @method('POST')

        @if (Session::get('error'))
        <div class="p-5">
          <div class="alert alert-danger" role="alert">
            {{ Session::get('error')}}
          </div>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif

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

          <div class="mb-3">
            <label for="nom" class="form-label">Nom de l'Intervenant :</label>
            <input type="text" class="form-control  @error('nom')is-invalid
           @enderror" name="nom" wire:model="nom" required>
            @error('nom')
            <div class="invalid-feedback">Le champ nom est requis.</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="prenom" class="form-label">Prenom de l'Intervenant :</label>
            <input type="text" class="form-control  @error('prenom')is-invalid
           @enderror" name="prenom" wire:model="prenom" required>
            @error('prenom')
            <div class="invalid-feedback">Le champ prenom est requis.</div>
            @enderror
          </div>


          <div class="mb-3">
            <label for="contact" class="form-label">Contact de l'Intervenant :</label>
            <input type="number" class="form-control @error('contact')is-invalid
           @enderror" name="contact" wire:model="contact" required>

            @error('contact')
            <div class="invalid-feedback">Le champ contact est requis.</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email de l'Intervenant :</label>
            <input type="email" class="form-control  @error('email')is-invalid
           @enderror" name="email" wire:model="email" required>
            @error('email')
            <div class="invalid-feedback">Le champ email est requis.</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="adresse" class="form-label">Adresse de l'Intervenant :</label>
            <input type="text" class="form-control  @error('adresse')is-invalid
           @enderror" name="adresse" wire:model="adresse" required>
            <!-- afiche le message d'erreur si le champs est vide  -->
            @error('adresse')
            <div class="invalid-feedback">Le champ adresse est requis.</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="date_participation" class="form-label">Date de participation :</label>
            <input type="date" class="form-control  @error('date_participation')is-invalid
           @enderror" name="date_participation" wire:model="date_participation" required>
            @error('date_participation')
            <div class="invalid-feedback">Le champ date de participation est requis.</div>
            @enderror
          </div>


        </div>

        <div class=" row d-flex justify-content-between mb-3">
          <div class="col-md-3">
            <button type="button" class="btn btn-danger">
              <a href="{{route('intervenants')}}" class=" text-white fs-6"
                style="text-decoration:none;">Annuler</a></button>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary text text-bold">Mettre à jour</button>
          </div>
        </div>

      </form>
    </div>
  </div v>
</div>
