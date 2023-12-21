<div class="row">
  <div class="col-md-12">

    @if(session('success'))
    <script>
    Swal.fire({
      title: 'Nouvelle acticvité ajoutée !',
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
          <a href="{{route('activites.create')}}" class="text-white fs-6" style="text-decoration:none;">Ajouter
            nouvelle activité</a></button>
      </div>
      <div class="col-md-3">
        <input type="text" class="form-control" placeholder="Rechercher">
      </div>
    </div>

    <div class="card">
      <!-- <div class="card-header">Liste des articles</div> -->
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Nom de l'activité</th>
              <th scope="col">Projet</th>
              <th scope="col">Date debut</th>
              <th scope="col">Date de fin</th>
              <th scope="col">Date création</th>
              <th scope="col">Statut</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>

          <tbody>

            @foreach ($listeActivites as $activite)
            <tr>
              <td>{{$activite->nom}}</td>
              <td>{{$activite->projet->libelle}} </td>
              <td>{{$activite->date_debut}}</td>
              <td>{{$activite->date_fin}}</td>
              <td>{{$activite->create_at}}</td>

              <td>
                <!-- href : le lien vers la page de modification du statut/ à mettre en place -->
                @if ($activite->statut == 'en cours')
                <a href="#" data-bs-toggle="modal" data-bs-target="#confirmProfilModal{{ $activite->id }}"
                  class=" btn btn-sm badge bg-success">{{$activite->statut}}</a>

                @elseif ($activite->statut == 'arrêté')
                <a href="#" data-bs-toggle="modal" data-bs-target="#confirmProfilModal{{ $activite->id }}"
                  class="btn btn-sm badge bg-warning">{{$activite->statut}}</a>

                @elseif ($activite->statut == 'terminé')
                <a href="#" data-bs-toggle="modal" data-bs-target="#confirmProfilModal{{ $activite->id }}"
                  class="btn btn-sm badge bg-danger">{{$activite->statut}}</a>
                @endif
              </td>

              <td>
                <!-- Par exemple, un lien pour afficher le activites détaillé -->
                <a href="{{ route('activites.show', $activite->id) }}" class="btn btn-sm btn-info">Détails</a>
                <!-- Un bouton pour modifier le activite -->
                <a href="{{ route('activites.edit', $activite->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                <!-- Un bouton pour supprimer le activite -->
                <button type="submit" data-bs-toggle="modal" data-bs-target="#confirmationModal{{ $activite->id }}"
                  class="btn btn-sm btn-danger">Supprimer
                </button>
              </td>

              @include('modals.modals-status.modal-activite-statut')

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
                      Êtes-vous sûr de vouloir supprimer cette activité ?
                    </div>
                    <div class="modal-footer">
                      <a href="{{route('activites')}}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                      </a>
                      <!-- Code du bouton supprimer du modal -->
                      <button wire:click="confirmDelete('{{$activite->id}}')" class="btn btn-danger">OUI</button>
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

        <div class=" my-4">
          {{ $listeActivites->links('Pagination.bootstrap-pagination') }}
        </div>


      </div>
    </div>
  </div>
</div>
