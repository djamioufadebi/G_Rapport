<div class="row">
  <div class="col-md-12">

    @if(session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
    @endif

    <!-- le bouton ajouter -->
    @if(session('success'))
    <script>
    Swal.fire({
      title: 'Nouveau client !',
      text: ' client ajouté avec succès !',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('miseajour'))
    <script>
    Swal.fire({
      title: 'Mise à jour!',
      text: 'Cet client a été mise à jour avec succès',
      icon: 'info',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('delete'))
    <script>
    Swal.fire({
      title: 'Suppression',
      text: 'Le client a supprimé !',
      icon: 'info',
      confirmButtonText: 'OK'
    })
    </script>
    @endif


    <div class=" row d-flex justify-content-between mb-3">
      <div class="col-md-3">

        <button type="button" class="btn btn-secondary">
          <a href="{{route('clients.pdf')}}" class="text-white fs-6" style="text-decoration:none;"><i
              class="far fa-file-pdf"></i>
            Imprimer la liste</a></button>
        @if (Auth::user()->id_profil == 1)
        <button type="button" class="btn btn-primary">
          <a href="{{route('clients.create')}}" class="text-white fs-6" style="text-decoration:none;"><i
              class="fas fa-plus"></i>Ajouter</a></button>
        @endif
      </div>
      <div class="col-md-5">
        <input wire:change="s" wire:model="search" type="text" class="form-control"
          placeholder="Rechercher un client par son nom...">
      </div>
    </div>

    <div class="card">
      <!-- <div class="card-header">Liste des articles</div> -->
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Nom </th>
              <th scope="col">Adresse</th>
              <th scope="col">Email</th>
              <th scope="col">Contact</th>
              <th scope="col">Date</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($clients as $client)
            <tr>
              <td>{{$client->nom}}</td>
              <td>{{$client->adresse}}</td>
              <td>{{$client->email}}</td>
              <td>{{$client->contact}}</td>
              <td>{{$client->created_at}}</td>
              <td>
                <!-- Par exemple, un lien pour afficher le clients détaillé -->
                <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-info"><i
                    class="fas fa-eye"></i> </a>
                <!-- Un bouton pour modifier le client -->
                @if (Auth::user()->id_profil == 1)
                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-warning"><i
                    class="fas fa-pen"></i></a>
                @endif
                <!-- Un bouton pour supprimer le client -->
                @if (Auth::user()->id_profil == 1)
                <button type="submit" data-bs-toggle="modal" @if (Auth::user()->id_profil == 1)
                  data-bs-target="#confirmationModal"
                  @endif class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>
                </button>
                @endif
              </td>
          </tbody>

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
                  Êtes-vous sûr de vouloir supprimer cet client ?
                </div>
                <div class="modal-footer">
                  <a href="{{route('clients')}}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
                  </a>
                  <!-- Code du bouton supprimer du modal -->
                  <button wire:click="confirmDelete('{{$client->id}}')" class="btn btn-danger">OUI</button>
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

        <!-- Lien de pagination -->
        <div class="container my-4">
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
              {{-- Lien vers la page précédente --}}
              @if($clients->previousPageUrl())
              <li class="page-item">
                <a class="page-link" href="{{ $clients->previousPageUrl() }}" aria-label="Précédente">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              @else
              <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo;</span>
              </li>
              @endif

              {{-- Affichage des numéros de page --}}
              @for($i = 1; $i <= $clients->lastPage(); $i++)
                <li class="page-item {{ $i == $clients->currentPage() ? 'active' : '' }}">
                  <a class="page-link" href="{{ $clients->url($i) }}">{{ $i }}</a>
                </li>
                @endfor

                {{-- Lien vers la page suivante --}}
                @if($clients->nextPageUrl())
                <li class="page-item">
                  <a class="page-link" href="{{ $clients->nextPageUrl() }}" aria-label="Suivante">
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