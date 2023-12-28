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
          <a href="{{route('besoins.pdf')}}" class="text-white fs-6" style="text-decoration:none;">Génerer
            PDF</a></button>
        <button type="button" class="btn btn-primary">
          <a href="{{route('besoins.create')}}" class="text-white fs-6" style="text-decoration:none;">
            Nouveau Besoin</a></button>
      </div>
      <div class="col-md-5">
        <input wire:change="s" wire:model="search" type="text" class="form-control"
          placeholder="Rechercher un besoin par son libellé...">
      </div>
    </div>

    <div class="card">
      <!-- <div class="card-header">Liste des articles</div> -->

      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Libellé </th>
              <th scope="col">Projet </th>
              <th scope="col">Date</th>
              <th scope="col">Statut</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($listeBesoins as $besoin)
            <tr>
              <td>{{$besoin->libelle}}</td>
              <td>{{$besoin->projet->libelle}}</td>
              <td>{{$besoin->created_at}}</td>
              <td>
                @if ($besoin->statut == 'Validé')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 2 )
                  data-bs-target="#confirmProfilModal{{ $besoin->id }}" @endif
                  class="btn btn-sm badge bg-success">{{$besoin->statut}}</a>

                @elseif ($besoin->statut == 'en attente')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 2 )
                  data-bs-target="#confirmProfilModal{{ $besoin->id }}" @endif
                  class="btn btn-sm badge bg-warning">{{$besoin->statut}}</a>
                @elseif ($besoin->statut == 'rejeté')
                <a href="#" data-bs-toggle="modal" @if (Auth::user()->id_profil == 2 )
                  data-bs-target="#confirmProfilModal{{ $besoin->id }}" @endif
                  class="btn btn-sm badge bg-danger">{{$besoin->statut}}</a>
                @endif
              </td>
              <td>
                <!-- Par exemple, un lien pour afficher le besoins détaillé -->
                <a href="{{ route('besoins.show', $besoin->id) }}" class="btn btn-sm btn-info">Détails</a>
                <!-- Un bouton pour modifier le besoin -->
                <a href="{{ route('besoins.edit', $besoin->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                <!-- Un bouton pour supprimer le besoin -->
                <button type="submit" data-bs-toggle="modal" @if (Auth::user()->id_profil == 2)
                  data-bs-target="#confirmationModal{{ $besoin->id }}" @endif
                  class="btn btn-sm btn-danger">Supprimer
                </button>
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
        <div class=" my-4">
          {{$listeBesoins->links('Pagination.bootstrap-pagination') }}
        </div>

      </div>
    </div>
    </di v>
  </div>