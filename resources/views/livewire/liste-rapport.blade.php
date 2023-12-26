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
          <a href="" class="text-white fs-6" style="text-decoration:none;">Génerer PDF</a></button>
        <button type="button" class="btn btn-primary">
          <a href="{{route('projets.create')}}" class="text-white fs-6" style="text-decoration:none;">Ajouter
            Nouveau</a></button>
      </div>
      <div class="col-md-5">
        <input wire:change="s" wire:model="search" type="text" class="form-control"
          placeholder="Rechercher un projet par son Libellé...">
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Libellé du rapport </th>
              <th scope="col">date </th>
              <th scope="col">Projet</th>
              <th scope="col">Statut</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($listeRapport as $rapport)
            <tr>
              <td>{{$rapport->libelle}}</td>
              <td>{{$rapport->created_at}}</td>
              <td>{{$rapport->projet->libelle}}</td>
              <!-- Le profil qui peut accéder à ces pages des bouttons -->
              <td>
                <!-- href : le lien vers la page de modification du statut/ à mettre en place -->
                @if ($rapport->statut == 'Validé')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 2 )
                  data-bs-target="#confirmProfilModal{{ $rapport->id }}" @endif
                  class="btn btn-sm badge bg-success">{{$rapport->statut}}</a>

                @elseif ($rapport->statut == 'en attente')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 2 )
                  data-bs-target="#confirmProfilModal{{ $rapport->id }}" @endif
                  class="btn btn-sm badge bg-warning">{{$rapport->statut}}</a>

                @elseif ($rapport->statut == 'rejeté')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 2 )
                  data-bs-target="#confirmProfilModal{{ $rapport->id }}" @endif
                  class="btn btn-sm badge bg-danger">{{$rapport->statut}}</a>
                @endif
              </td>

              <td>
                <!-- Par exemple, un lien pour afficher le rapports détaillé -->
                <a href="{{ route('rapports.show', $rapport->id) }}" class="btn btn-sm btn-info">Détails</a>
                <!-- Un bouton pour modifier le rapport -->
                <a href="{{ route('rapports.edit', $rapport->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                <!-- Un bouton pour supprimer le rapport -->
                <button type="submit" data-bs-toggle="modal" @if (Auth::user()->id_profil == 2 )
                  data-bs-target="#confirmationModal{{ $rapport->id }}"@endif
                  class="btn btn-sm btn-danger">Supprimer
                </button>

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
        <div class="mx-2">
          {{-- $listeRapport->links('Pagination.bootstrap-pagination') --}}
        </div>

      </div>
    </div>
  </div>
</div>
