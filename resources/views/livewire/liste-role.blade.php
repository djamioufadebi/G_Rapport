<div class="row">
  <div class="md-8 justify-content-between">

    <!-- le bouton ajouter -->
    <div class=" row d-flex justify-content-between mb-3">
      <div class="col-md-3">
        <button type="button" class="btn btn-primary">
          <a href="{{route('roles.create')}}" class="text-white fs-6" style="text-decoration:none;">Ajouter
            Nouveau
          </a>
        </button>
      </div>
      <div class="col-md-3">
        <input type="text" class="form-control" placeholder="Rechercher">
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

              @foreach($roles as $role)
              <tr>
                <td>{{ $role->nom }}</td>
                <td>{{ $role->created_at }}</td>
                <td>
                  <!-- Par exemple, un lien pour afficher le roles détaillé -->
                  <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-info">Détails</a>
                  <!-- Un bouton pour modifier le role -->
                  <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                  <!-- Un bouton pour supprimer le role -->
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
                    Êtes-vous sûr de vouloir supprimer cet rôle ?
                  </div>
                  <div class="modal-footer">
                    <a href="{{route('roles')}}">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                    </a>
                    <button wire:click="confirmDelete('{{$role->id}}')" class="btn btn-danger">OUI</button>
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
          <div class=" my-4">
            {{ $roles->links('Pagination.bootstrap-pagination') }}
          </div>

        </div>

      </div>
    </div>
  </div>
</div>