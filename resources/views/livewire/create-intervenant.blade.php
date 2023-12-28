<div class="row">
  <div class="card">
    <div class="card-body container ">
      <form method="POST" wire:submit="store">
        @csrf
        @method('POST')

        @if(session('dejautiliser'))
        <script>
        Swal.fire({
          title: 'Erreur d\'enregistrement!',
          text: 'Ce intervenant existe déjà dans la base !',
          icon: 'error',
          confirmButtonText: 'OK'
        })
        </script>
        @endif


        <div class="mb-3">
          <label for="nom" class="form-label">Nom de l'Intervenant :</label>
          <input type="text" class="form-control  @error('nom')is-invalid
           @enderror" name="nom" wire:model="nom" required>
          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('nom')
          <div class="invalid-feedback">Le champ nom est requis.</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="prenom" class="form-label">Prenom de l'Intervenant :</label>
          <input type="text" class="form-control  @error('prenom')is-invalid
           @enderror" name="prenom" wire:model="prenom" required>
          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('prenom')
          <div class="invalid-feedback">Le champ prenom est requis.</div>
          @enderror
        </div>


        <div class="mb-3">
          <label for="contact" class="form-label">Contact de l'Intervenant :</label>
          <input type="number" class="form-control @error('contact')is-invalid
           @enderror" name="contact" wire:model="contact" required>
          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('contact')
          <div class="invalid-feedback">Le champ contact est requis.</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email de l'Intervenant :</label>
          <input type="email" class="form-control  @error('email')is-invalid
           @enderror" name="email" wire:model="email" required>
          <!-- afiche le message d'erreur si le champs est vide  -->
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

        <div class=" row d-flex justify-content-between mb-3">
          <div class="col-md-3">
            <button type="button" class="btn btn-secondary">
              <a href="{{route('intervenants')}}" class="  text-white fs-6"
                style="text-decoration:none;">Retour</a></button>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary text text-bold">Enregistrer</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
