<div class="row">
  <di class="md-8 justify-content-between">

    @include('composants.sweetalert-message')

    <!-- le bouton ajouter -->
    <div class=" row d-flex justify-content-between mb-3">
      <div class="col-md-3">
        <button type="button" class="btn btn-secondary">
          <a href="{{route('profils.pdf')}}" class="text-white fs-6" style="text-decoration:none;">Génerer
            PDF</a></button>
        <button type="button" class="btn btn-primary">
          <a href="{{route('profils.create')}}" class="text-white fs-6" style="text-decoration:none;">Ajouter
            Nouveau
          </a>
        </button>
      </div>
      <div class="col-md-5">
        <input wire:change="s" wire:model="search" type="text" class="form-control"
          placeholder="Rechercher un profil par son nom...">
      </div>
    </div>

    <div class="card">
      <!-- <div class="card-header">Liste des articles</div> -->

      <div class="card-body">
        <div class=" row d-flex justify-content-between mb-3">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Nom </th>
                <th scope="col">Date </th>
                <th scope="col">Actions</th>
              </tr>
            </thead>

            <tbody>

              @foreach($profils as $profil)
              <tr>
                <td>{{ $profil->nom }}</td>
                <td>{{ $profil->created_at }}</td>
                <td>
                  <!-- Par exemple, un lien pour afficher le profils détaillé -->
                  <a href="{{ route('profils.show', $profil->id) }}" class="btn btn-sm btn-info">Détails</a>
                  <!-- Un bouton pour modifier le profil -->
                  <a href="{{ route('profils.edit', $profil->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                  <!-- Un bouton pour supprimer le profil -->
                  <button type="submit" data-bs-toggle="modal" data-bs-target="#confirmationModal"
                    class="btn btn-sm btn-danger">Supprimer
                  </button>
                </td>
              </tr>

            </tbody>

            <!-- La Modal -->
            <div wire:ignore.self class="modal fade" id="confirmationModal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <!-- Contenu du modal -->
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Confirmation de suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer ce profil ?
                  </div>
                  <div class="modal-footer">
                    <a href="{{route('profils')}}">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                    </a>
                    <button wire:click="confirmDelete('{{$profil->id}}')" class="btn btn-danger">OUI</button>
                  </div>
                </div>
              </div>
            </div>

            @livewireScripts

            <!-- le script javascript  -->
            <script>
            document.addEventListener('livewire:load', function() {
              Livewire.on('showConfirmationModal', () => {
                $('#confirmationModal').modal('show');
              });
              Livewire.on('hideConfirmationModal', () => {
                $('#confirmationModal').modal('hide');
              });
            });
            </script>
            <!-- Fin pop up du modal -->

            @endforeach
          </table>
          <!-- pagination : links -->
          <div class=" my-1">
            {{ $profils->links('Pagination.bootstrap-pagination') }}
          </div>



        </div>

      </div>
    </div>
  </di v>
</div>