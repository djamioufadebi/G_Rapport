<div class="row">
  <div class="col-md-12">

    @if(session('success'))
    <script>
    Swal.fire({
      title: 'Ajout de projet ',
      text: ' Nouveau projet ajouté !',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
    @endif

    @if(session(' miseajour'))
    <script>
    Swal.fire({
      title: 'Mise à jour !',
      text: 'Le Projet a été mise à jour !',
      icon: 'info',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('delete'))
    <script>
    Swal.fire({
      title: 'Suppression du projet',
      text: 'Le Projet a été supprimé !',
      icon: 'error',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('valider'))
    <script>
    Swal.fire({
      title: 'Finition  !',
      text: 'Le Projet est finalisé',
      icon: 'info',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('rejeter'))
    <script>
    Swal.fire({
      title: 'Arrêt!',
      text: 'Le Projet a été arrêté',
      icon: 'info',
      confirmButtonText: 'OK'
    })
    </script>
    @endif
    <!-- le bouton ajouter -->
    <div class=" row d-flex justify-content-between mb-3">
      <div class="col-md-3">
        <button type="button" class="btn btn-secondary">
          <a href="{{route('projets.pdf')}}" class="text-white fs-6" style="text-decoration:none;"><i
              class="far fa-file-pdf"></i>
            Imprimer la liste</a></button>
        @if (Auth::user()->id_profil == 1)
        <button type="button" class="btn btn-primary">
          <a href="{{route('projets.create')}}" class="text-white fs-6" style="text-decoration:none;"><i
              class="fas fa-plus"></i>Ajouter</a></button>
        @endif
      </div>
      <div class="col-md-3">
        <input wire:change="s" wire:model="search" type="text" class="form-control"
          placeholder="Rechercher un projet par son Libellé...">
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Libellé </th>
              <th scope="col">Date début</th>
              <th scope="col">Date Fin</th>
              <th scope="col">Créateur</th>
              <th scope="col">Nom du client</th>
              <th scope="col">Statut</th>
              <th scope="col">Opération</th>
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
                @if ($projet->statut == 'en attente')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1 || Auth::user()->id ===
                  $projet->id_gestionnaire)
                  data-bs-target="#confirmProfilModal{{ $projet->id }}" @endif
                  class=" btn btn-sm badge bg-success">{{$projet->statut}}</a>
                @elseif ($projet->statut == 'en cours')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1 || Auth::user()->id ===
                  $projet->id_gestionnaire)
                  data-bs-target="#confirmProfilModal{{ $projet->id }}" @endif
                  class=" btn btn-sm badge bg-success">{{$projet->statut}}</a>
                @elseif ($projet->statut == 'arrêté')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1 || Auth::user()->id ===
                  $projet->id_gestionnaire)
                  data-bs-target="#confirmProfilModal{{ $projet->id }}" @endif
                  class=" btn btn-sm badge bg-warning">{{$projet->statut}}</a>

                @elseif ($projet->statut == 'terminé')
                <a href="#" data-bs-toggle="modal" @if (Auth::projet()->id_profil == 1 || Auth::user()->id ===
                  $projet->id_gestionnaire)
                  data-bs-target="#confirmProfilModal{{ $projet->id }}" @endif
                  class=" btn btn-sm badge bg-danger">{{$projet->statut}}</a>
                @endif
              </td>
              <td>
                <button type="submit" data-bs-toggle="modal" data-bs-target="#NommerGestionnaireModal{{ $projet->id }}"
                  class="btn btn-sm btn-success">Nommmer Gestionnaire
                </button>
              </td>

              <td>
                <!-- Par exemple, un lien pour afficher le projets détaillé -->
                <a href="{{ route('projets.show', $projet->id) }}" class="btn btn-sm btn-info"><i
                    class="fas fa-eye"></i> </a>
                <!-- Un bouton pour modifier le projet -->
                @if (Auth::user()->id_profil == 1)
                <a href="{{ route('projets.edit', $projet->id) }}" class="btn btn-sm btn-warning"><i
                    class="fas fa-pen"></i></a>
                @endif

                <!-- Un bouton pour supprimer le projet -->

                @if (Auth::user()->id_profil == 1)
                <button type="submit" data-bs-toggle="modal" data-bs-target="#confirmationModal{{$projet->id}}"
                  class="btn btn-sm btn-danger" style="display: block;"><i class="fas fa-trash-alt"></i>
                </button>
                @else
                <button type="submit" data-bs-toggle="modal" data-bs-target="#confirmationModal{{$projet->id}}"
                  class="btn btn-sm btn-danger" style="display: none;"><i class=" fas fa-trash-alt"></i>
                </button>
                @endif

              </td>
          </tbody>

          @include('modals.modals-status.modal-projet-statut')

          <!-- Modal pour la confirmation de la suppression -->
          <!-- La Modal -->
          <div wire:ignore.self class="modal fade" id="confirmationModal{{$projet->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <!-- Contenu du modal -->
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title">Confirmation de suppression</h3>
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

        <!-- Lien de pagination -->
        <div class="container my-4">
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
              {{-- Lien vers la page précédente --}}
              @if($projets->previousPageUrl())
              <li class="page-item">
                <a class="page-link" href="{{ $projets->previousPageUrl() }}" aria-label="Précédente">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              @else
              <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo;</span>
              </li>
              @endif

              {{-- Affichage des numéros de page --}}
              @for($i = 1; $i <= $projets->lastPage(); $i++)
                <li class="page-item {{ $i == $projets->currentPage() ? 'active' : '' }}">
                  <a class="page-link" href="{{ $projets->url($i) }}">{{ $i }}</a>
                </li>
                @endfor

                {{-- Lien vers la page suivante --}}
                @if($projets->nextPageUrl())
                <li class="page-item">
                  <a class="page-link" href="{{ $projets->nextPageUrl() }}" aria-label="Suivante">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
                @else
                <li class="page-item disabled">
                  <span class="page-link" aria-hidden="true">&raquo;</span>
                </li>
                @endif
            </ul>
          </nav>
        </div>
        <!-- Fin du lien  -->

      </div>
    </div>
  </div>
</div>