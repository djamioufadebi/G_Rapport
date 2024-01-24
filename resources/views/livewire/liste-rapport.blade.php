<div class="row">
  <div class="col-md-12">
    @if(session('success'))
    <script>
    Swal.fire({
      title: 'Nouveau rapport!',
      text: 'Votre rapport a été soumis avec succès',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('miseajour'))
    <script>
    Swal.fire({
      title: 'Mise à jour!',
      text: 'Cet rapport a été mise à jour avec succès',
      icon: 'info',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('delete'))
    <script>
    Swal.fire({
      title: 'Suppression ',
      text: 'Le rapport a été supprimé!',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('valider'))
    <script>
    Swal.fire({
      title: 'Validation',
      text: 'Rapport validé',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('rejeter'))
    <script>
    Swal.fire({
      title: 'Rejet !!!',
      text: 'Rapport réjeté',
      icon: 'info',
      confirmButtonText: 'OK'
    })
    </script>
    @endif
    <!-- le bouton ajouter -->
    <div class=" row d-flex justify-content-between mb-3">
      <div class="col-md-3">
        <button type="button" class="btn btn-secondary">
          <a href="{{route('rapports.pdf')}}" class="text-white fs-6" style="text-decoration:none;">
            <i class="far fa-file-pdf"></i>Imprimer la liste</a></button>
        @if (Auth::user()->id_profil == 2)
        <button type="button" class="btn btn-primary">
          <a href="{{route('rapports.create')}}" class="text-white fs-6" style="text-decoration:none;"><i
              class="fas fa-plus"></i>Ajouter</a></button>
        @endif
      </div>
      <div class="col-md-5">
        <input wire:change="s" wire:model="search" type="text" class="form-control"
          placeholder="Rechercher un rapport par son Libellé...">
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Libellé </th>
              <th scope="col">Activité</th>
              <th scope="col">Statut</th>
              <th scope="col">Taux de réalisation </th>
              <th scope="col">Actions</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($listeRapport as $rapport)
            <tr>
              <td>{{$rapport->libelle}}</td>
              <td>{{$rapport->activite->nom}}</td>
              <!-- Le profil qui peut accéder à ces pages des bouttons -->

              <td>
                <!-- href : le lien vers la page de modification du statut/ à mettre en place -->
                @if ($rapport->statut == 'Validé')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1 )
                  data-bs-target="#confirmProfilModal{{ $rapport->id }}" @endif
                  class="btn btn-sm badge bg-success">{{$rapport->statut}}</a>

                @elseif ($rapport->statut == 'en attente')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1 )
                  data-bs-target="#confirmProfilModal{{ $rapport->id }}" @endif
                  class="btn btn-sm badge bg-warning">{{$rapport->statut}}</a>

                @elseif ($rapport->statut == 'rejeté')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1 )
                  data-bs-target="#confirmProfilModal{{ $rapport->id }}" @endif
                  class="btn btn-sm badge bg-danger">{{$rapport->statut}}</a>
                @endif

              </td>

              <td>{{$rapport->activite->taux_de_realisation}}</td>

              <td>
                <!-- Par exemple, un lien pour afficher le rapports détaillé -->
                <a href="{{ route('rapports.show', $rapport->id) }}" class="btn btn-sm btn-info"><i
                    class="fas fa-eye"></i> </a>
                <!-- Un bouton pour modifier le rapport -->
                <!-- Seule celui qui a fait le rapport peut le modifier -->
                <a href="{{ route('rapports.edit', $rapport->id) }}" class="btn btn-sm btn-warning"><i
                    class="fas fa-pen"></i></a>
                <!-- Seul  -->
                @if (Auth::user()->id_profil == 1 || Auth::user()->id === $rapport->user_id)
                <button type="submit" data-bs-toggle="modal" data-bs-target="#confirmationModal{{ $rapport->id }}"
                  class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>
                </button>
                @endif

              </td>
          </tbody>

          @include('modals.modals-status.modal-rapport-statut')

          <!-- Modal pour la confirmation de la suppression -->
          <!-- La Modal -->
          <div wire:ignore.self class="modal fade" id="confirmationModal{{ $rapport->id }}" tabindex="-1" role="dialog">
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
                  Êtes-vous sûr de vouloir supprimer cet rapport ?
                </div>
                <div class="modal-footer">
                  <a href="{{route('rapports')}}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                  </a>
                  <!-- Code du bouton supprimer du modal -->
                  <button wire:click="confirmDelete('{{$rapport->id}}')" class="btn btn-danger">OUI</button>
                </div>
              </div>
            </div>
          </div>

          @livewireScripts

          <!-- Fin pop up du modal -->

          @endforeach
          </tbody>
        </table>
        <!-- Lien de pagination -->
        <div class="container my-4">
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
              {{-- Lien vers la page précédente --}}
              @if($listeRapport->previousPageUrl())
              <li class="page-item">
                <a class="page-link" href="{{ $listeRapport->previousPageUrl() }}" aria-label="Précédente">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              @else
              <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo;</span>
              </li>
              @endif

              {{-- Affichage des numéros de page --}}
              @for($i = 1; $i <= $listeRapport->lastPage(); $i++)
                <li class="page-item {{ $i == $listeRapport->currentPage() ? 'active' : '' }}">
                  <a class="page-link" href="{{ $listeRapport->url($i) }}">{{ $i }}</a>
                </li>
                @endfor

                {{-- Lien vers la page suivante --}}
                @if($listeRapport->nextPageUrl())
                <li class="page-item">
                  <a class="page-link" href="{{ $listeRapport->nextPageUrl() }}" aria-label="Suivante">
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