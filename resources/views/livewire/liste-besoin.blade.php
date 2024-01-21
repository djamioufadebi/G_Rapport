<div class="row">
  <div class="col-md-12">
    <!-- le bouton ajouter -->

    @if(session('success'))
    <script>
    Swal.fire({
      title: 'Nouveau besoin!',
      text: 'Votre besoin a été soumis avec succès',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('miseajour'))
    <script>
    Swal.fire({
      title: 'Mise à jour!',
      text: 'Votre besoin a été mise à jour avec succès',
      icon: 'info',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('delete'))
    <script>
    Swal.fire({
      title: 'Suppression ',
      text: 'Le besoin a été supprimé!',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('valider'))
    <script>
    Swal.fire({
      title: 'Validation',
      text: 'Besoin validé',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('rejeter'))
    <script>
    Swal.fire({
      title: 'Rejet !!!',
      text: 'Besoin réjeté',
      icon: 'info',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    <div class=" row d-flex justify-content-between mb-3">
      <div class="col-md-3">
        <button type="button" class="btn btn-secondary">
          <a href="{{route('besoins.pdf')}}" class="text-white fs-6" style="text-decoration:none;"><i
              class="far fa-file-pdf"></i>
            Imprimer la liste</a></button>
        @if (Auth::user()->id_profil == 2)
        <button type="button" class="btn btn-primary">
          <a href="{{route('besoins.create')}}" class="text-white fs-6" style="text-decoration:none;"><i
              class="fas fa-plus"></i>Ajouter</a></button>
        @endif

      </div>
      <div class="col-md-5">
        <input wire:change="s" wire:model="search" type="text" class="form-control"
          placeholder="Rechercher un besoin par son libellé...">
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Libellé </th>
              <th scope="col">Nom de l'activité </th>
              <th scope="col">Date de création</th>
              <th scope="col">Statut</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($listeBesoins as $besoin)
            <tr>
              <td>{{$besoin->libelle}}</td>
              <td>{{$besoin->activite->nom}}</td>
              <td>{{$besoin->created_at}}</td>
              <td>
                @if ($besoin->statut == 'Validé')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1 )
                  data-bs-target="#confirmProfilModal{{ $besoin->id }}" @endif
                  class="btn btn-sm badge bg-success">{{$besoin->statut}}</a>

                @elseif ($besoin->statut == 'en attente')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1 )
                  data-bs-target="#confirmProfilModal{{ $besoin->id }}" @endif
                  class="btn btn-sm badge bg-warning">{{$besoin->statut}}</a>
                @elseif ($besoin->statut == 'rejeté')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1 )
                  data-bs-target="#confirmProfilModal{{ $besoin->id }}" @endif
                  class="btn btn-sm badge bg-danger">{{$besoin->statut}}</a>
                @endif
              </td>
              <td>
                <!-- Par exemple, un lien pour afficher le besoins détaillé -->
                <a href="{{ route('besoins.show', $besoin->id) }}" class="btn btn-sm btn-info"><i
                    class="fas fa-eye"></i> </a>
                <!-- Un bouton pour modifier le besoin -->
                <!-- Seul celui a fait le besoin peut le modifier -->
                @if (Auth::user()->id === $besoin->user_id)
                <a href="{{ route('besoins.edit', $besoin->id) }}" class="btn btn-sm btn-warning"><i
                    class="fas fa-pen"></i>
                </a>
                @endif

                @if (Auth::user()->id_profil == 1 || Auth::user()->id === $besoin->user_id)
                <!-- Un bouton pour supprimer le rapport -->
                <button type="submit" data-bs-toggle="modal" data-bs-target="#confirmationModal{{ $besoin->id }}"
                  class="btn btn-sm btn-danger" style="display: block;"><i class="fas fa-trash-alt"></i>
                </button>
                @else
                <button type="submit" data-bs-toggle="modal" data-bs-target="#confirmationModal{{ $besoin->id }}"
                  class="btn btn-sm btn-danger" style="display: none;"><i class="fas fa-trash-alt"></i>
                </button>
                @endif

              </td>


              @include('modals.modals-status.modal-besoin-statut')

              <!-- Modal pour la confirmation de la suppression -->
              <!-- La Modal -->
              <div wire:ignore.self class="modal fade" id="confirmationModal{{ $besoin->id }}" tabindex="-1"
                role="dialog">
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
                      Êtes-vous sûr de vouloir supprimer cet Besoin ?
                    </div>
                    <div class="modal-footer">
                      <a href="{{route('besoins')}}">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                      </a>
                      <!-- Code du bouton supprimer du modal -->
                      <button wire:click="confirmDelete('{{$besoin->id}}')" class="btn btn-danger">OUI</button>
                    </div>
                  </div>
                </div>
              </div>

              @livewireScripts

              @endforeach
          </tbody>
        </table>
        <!-- Lien de pagination -->
        <div class="container my-4">
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
              {{-- Lien vers la page précédente --}}
              @if($listeBesoins->previousPageUrl())
              <li class="page-item">
                <a class="page-link" href="{{ $listeBesoins->previousPageUrl() }}" aria-label="Précédente">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              @else
              <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo;</span>
              </li>
              @endif

              {{-- Affichage des numéros de page --}}
              @for($i = 1; $i <= $listeBesoins->lastPage(); $i++)
                <li class="page-item {{ $i == $listeBesoins->currentPage() ? 'active' : '' }}">
                  <a class="page-link" href="{{ $listeBesoins->url($i) }}">{{ $i }}</a>
                </li>
                @endfor

                {{-- Lien vers la page suivante --}}
                @if($listeBesoins->nextPageUrl())
                <li class="page-item">
                  <a class="page-link" href="{{ $listeBesoins->nextPageUrl() }}" aria-label="Suivante">
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
