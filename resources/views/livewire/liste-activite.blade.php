<div class="row">
  <div class="col-md-22">

    @if(session('success'))
    <script>
    Swal.fire({
      title: 'Ajout d\'activité ',
      text: ' Nouvelle activité ajoutée !',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif
    @if(session('delete'))
    <script>
    Swal.fire({
      title: 'Suppression du activité',
      text: 'Le activité a été supprimée !',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('valider'))
    <script>
    Swal.fire({
      title: 'Finition  !',
      text: 'L\'activité est finalisée',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('rejeter'))
    <script>
    Swal.fire({
      title: 'Arrêt!',
      text: 'L\'activité a été arrêtée',
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

    <!-- le bouton ajouter -->
    <div class=" row d-flex justify-content-between mb-2">
      <div class="col-md-6">
        <button type="button" class="btn btn-secondary">
          <a href="{{route('activites.pdf')}}" class="text-white fs-6" style="text-decoration:none;"><i
              class="far fa-file-pdf"></i>PDF</a></button>
        <button type="button" class="btn btn-primary">
          <a href="{{route('activites.create')}}" class="text-white fs-6" style="text-decoration:none;"><i
              class="fas fa-plus"></i>Ajouter
          </a></button>
      </div>
      <div class="col-md-2">
        <input wire:change="s" wire:model="search" type="text" class="form-control"
          placeholder="Rechercher une activité par son nom...">
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
              <th scope="col">Taux de réalisation</th>
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
              <td>{{$activite->taux_de_realisation}} %</td>
              <td>
                @if ($activite->statut == 'en attente')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1 || Auth::user()->id_profil == 2)
                  data-bs-target="#confirmProfilModal{{ $activite->id }}" @endif
                  class=" btn btn-sm badge bg-success">{{$activite->statut}}</a>
                @elseif ($activite->statut == 'en cours')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1 || Auth::user()->id_profil == 2)
                  data-bs-target="#confirmProfilModal{{ $activite->id }}" @endif
                  class=" btn btn-sm badge bg-success">{{$activite->statut}}</a>

                @elseif ($activite->statut == 'arrêté')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1 || Auth::user()->id_profil == 2)
                  data-bs-target="#confirmProfilModal{{ $activite->id }}" @endif
                  class="btn btn-sm badge bg-warning">{{$activite->statut}}</a>

                @elseif ($activite->statut == 'terminé')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1 || Auth::user()->id_profil == 2)
                  data-bs-target="#confirmProfilModal{{ $activite->id }}" @endif
                  class="btn btn-sm badge bg-danger">{{$activite->statut}}</a>
                @endif
              </td>

              <td>
                <!-- Par exemple, un lien pour afficher le activites détaillé -->
                <a href="{{ route('activites.show', $activite->id) }}" class="btn btn-sm btn-info"><i
                    class="fas fa-eye"></i> </a>
                <!-- Un bouton pour modifier le activite -->
                <a href="{{ route('activites.edit', $activite->id) }}" class="btn btn-sm btn-warning"><i
                    class="fas fa-pen"></i></a>

                <!-- Un bouton pour supprimer le activite -->
                <button type="submit" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1)
                  data-bs-target="#confirmationModal{{ $activite->id }}" @endif
                  class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>
                </button>

              </td>

              @include('modals.modals-status.modal-activite-statut')

              <!-- Modal pour la confirmation de la suppression -->
              <!-- La Modal -->
              <div wire:ignore.self class="modal fade" id="confirmationModal{{ $activite->id }}" tabindex="-2"
                role="dialog">
                <div class="modal-dialog" role="document">
                  <!-- Contenu du modal -->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h2 class="modal-title">Confirmation de suppression</h2>
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
              <!-- Fin pop up du modal -->
              @endforeach
          </tbody>
        </table>

        <div class=" my-4">
          {{ $listeActivites->links('Pagination.bootstrap-pagination')}}
        </div>
        <!-- 'Pagination.bootstrap-pagination' -->


      </div>
    </div>
    </di v>
  </div>