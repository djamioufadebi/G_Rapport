<div class="row">
  <div class="card">
    <div class="card-body container-fluid ">
      <form method="POST" wire:submit.prevent="store">
        @csrf
        @method('POST')


        @if(session('dejautiliser'))
        <script>
        Swal.fire({
          title: 'Erreur d\'enregistrement !',
          text: 'Ce nom est déjà utilisé !',
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
          <label for="nom" class="form-label">Nom du profil :</label>
          <input type="text" class="form-control  @error('nom')is-invalid
           @enderror" name="nom" wire:model="nom" required>
          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('nom')
          <div class="invalid-feedback">Le champ nom est requis.</div>
          @enderror

        </div>

        <div class=" row d-flex justify-content-between mb-3">
          <div class="col-md-3">
            <button type="button" class="btn btn-danger">
              <a href="{{route('profils')}}" class=" text-white fs-6" style="text-decoration:none;">Annuler</a></button>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary text text-bold">Enregistrer</button>
            <!-- le modal pour afficher message de succès -->

            <!-- Modal de succès -->
            <div class="modal" wire:ignore.self>
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Succès!</h5>
                    <button type="button" class="btn-close" wire:click="$set('showModal', false)"></button>
                  </div>
                  <div class="modal-body">
                    <p>{{ $successMessage }}</p>
                  </div>
                </div>
              </div>
              @section('scripts')
              <script src="{{ asset('js\modal-success.js') }}"></script>
              @endsection

            </div>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
