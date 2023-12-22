<div class="row">
  <div class="col-md-12">

    @if(session('success'))
    <script>
    Swal.fire({
      title: 'Nouveau projet !',
      text: '{{ session('
      success ') }}',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif
    @if(session('delete'))
    <script>
    Swal.fire({
      title: 'Le Projet a été supprimé !',
      text: '{{ session('
      success ') }}',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('valider'))
    <script>
    Swal.fire({
      title: 'Le Projet est finalisé!',
      text: '{{ session('
      success ') }}',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('rejeter'))
    <script>
    Swal.fire({
      title: 'Le Projet a été arrêté!',
      text: '{{ session('
      success ') }}',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif
    <!-- le bouton ajouter -->
    <div class=" row d-flex justify-content-between mb-3">
      <div class="col-md-3">
        <button type="button" class="btn btn-primary">
          <a href="{{route('projets.create')}}" class="text-white fs-6" style="text-decoration:none;">Ajouter
            Nouveau</a></button>
      </div>
      <div class="col-md-3">
        <input type="text" class="form-control" placeholder="Rechercher" wire:model="search">
      </div>
    </div>

    <div class="card">
      <!-- <div class="card-header">Liste des articles</div> -->

      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Libellé </th>
              <th scope="col">Date début</th>
              <th scope="col">Date Fin</th>
              <th scope="col">Nom du Gestionnaire</th>
              <th scope="col">Nom du client</th>
              <th scope="col">Statut</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($projets as $projet)
            <tr>
              <td>{{$projet->libelle}}</td>
              <td>{{$projet->date_debut}}</td>
              <td>{{$projet->date_fin_prevue}}</td>
              <td>{{$projet->user->nom}} {{$projet->user->prenom}} </td>
              <td>{{$projet->client->nom}}</td>
              <td>
                <!-- href : le lien vers la page de modification du statut/ à mettre en place -->
                @if ($projet->statut == 'en cours')
                <a href="#" data-bs-toggle="modal" data-bs-target="#confirmProfilModal{{$projet->id}}"
                  class=" btn btn-sm badge bg-success">{{$projet->statut}}</a>
                @elseif ($projet->statut == 'arrêté')
                <a href="#" data-bs-toggle="modal" data-bs-target="#confirmProfilModal{{$projet->id}}"
                  class=" btn btn-sm badge bg-warning">{{$projet->statut}}</a>

                @elseif ($projet->statut == 'terminé')
                <a href="{{ route('projets.edit', $projet->id) }}" data-bs-toggle="modal"
                  data-bs-target="#confirmProfilModal{{$projet->id}}"
                  class=" btn btn-sm badge bg-danger">{{$projet->statut}}</a>
                @endif

              </td>

              <td>
                <!-- Par exemple, un lien pour afficher le projets détaillé -->
                <a href="{{ route('projets.show', $projet->id) }}" class="btn btn-sm btn-info">Détails</a>
                <!-- Un bouton pour modifier le projet -->
                <a href="{{ route('projets.edit', $projet->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                <!-- Un bouton pour supprimer le projet -->
                <button type="submit" data-bs-toggle="modal" data-bs-target="#confirmationModal{{$projet->id}}"
                  class="btn btn-sm btn-danger">Supprimer
                </button>
              </td>
          </tbody>

          @include('modals.modals-status.modal-projet-statut')

          <!-- Modal pour la confirmation de la suppression -->
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
                  Êtes-vous sûr de vouloir supprimer cet Projet ?
                </div>
                <div class="modal-footer">
                  <a href="{{route('projets')}}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                  </a>
                  <!-- Code du bouton supprimer du modal -->
                  <button wire:click="confirmDelete('{{$projet->id}}')" class="btn btn-danger">OUI</button>
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

          </tbody>
        </table>
        <div class="my-1">
          {{$projets->links('Pagination.bootstrap-pagination') }}
        </div>

      </div>
    </div>
    </di v>
  </div>
