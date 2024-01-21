<div class="row">
  <div class="col-md-12">

    @if(session('success'))
    <script>
    Swal.fire({
      title: 'Nouveau intervenant',
      text: 'Intervenant ajouté avec succès!',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('miseajour'))
    <script>
    Swal.fire({
      title: 'Mise à jour!',
      text: 'Cet intervenant a été mise à jour avec succès',
      icon: 'info',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    @if(session('delete'))
    <script>
    Swal.fire({
      title: 'Suppression !',
      text: 'Le client est supprimé !',
      icon: 'success',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    <!-- le bouton ajouter -->
    <div class=" row d-flex justify-content-between mb-3">
      <div class="col-md-3">
        <button type="button" class="btn btn-secondary">
          <a href="{{route('intervenants.pdf')}}" class="text-white fs-6" style="text-decoration:none;"><i
              class="far fa-file-pdf"></i>
            Imprimer la liste</a></button>
        <button type="button" class="btn btn-primary">
          <a href="{{route('intervenants.create')}}" class="text-white fs-6" style="text-decoration:none;"><i
              class="fas fa-plus"></i>Ajouter</a></button>
      </div>
      <div class="col-md-5">
        <input wire:change="s" wire:model="search" type="text" class="form-control"
          placeholder="Rechercher un intervenant par son nom...">
      </div>
    </div>

    <div class="card">
      <!-- <div class="card-header">Liste des articles</div> -->
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Nom </th>
              <th scope="col">Prenom</th>
              <th scope="col">Contact</th>
              <th scope="col">Email</th>
              <th scope="col">Adresse</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>

          <tbody>

            @foreach ($intervenants as $intervenant)
            <tr>
              <td>{{$intervenant->nom}}</td>
              <td>{{$intervenant->prenom}}</td>
              <td>{{$intervenant->email}}</td>
              <td>{{$intervenant->contact}}</td>
              <td>{{$intervenant->adresse}}</td>
              <td>
                <!-- Par exemple, un lien pour afficher le intervenants détaillé -->
                <a href="{{ route('intervenants.show', $intervenant->id) }}" class="btn btn-sm btn-info"><i
                    class="fas fa-eye"></i> </a>
                <!-- Un bouton pour modifier le intervenant -->
                <a href="{{ route('intervenants.edit', $intervenant->id) }}" class="btn btn-sm btn-warning"><i
                    class="fas fa-pen"></i></a>

                <!-- Un bouton pour supprimer le intervenant -->
                <button type="submit" data-bs-toggle="modal" @if (in_array(Auth::user()->id_profil, [1, 3]))
                  data-bs-target="#confirmationModal" @endif
                  class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>
                </button>
              </td>

          </tbody>
          <!-- Le pop up du modal -->
          @include('modals.confirmation-modal')
          <!-- Fin pop up du modal -->
          @endforeach

        </table>



        <!-- Lien de pagination -->
        <div class="container my-4">
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
              {{-- Lien vers la page précédente --}}
              @if($intervenants->previousPageUrl())
              <li class="page-item">
                <a class="page-link" href="{{ $intervenants->previousPageUrl() }}" aria-label="Précédente">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              @else
              <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">&laquo;</span>
              </li>
              @endif

              {{-- Affichage des numéros de page --}}
              @for($i = 1; $i <= $intervenants->lastPage(); $i++)
                <li class="page-item {{ $i == $intervenants->currentPage() ? 'active' : '' }}">
                  <a class="page-link" href="{{ $intervenants->url($i) }}">{{ $i }}</a>
                </li>
                @endfor

                {{-- Lien vers la page suivante --}}
                @if($intervenants->nextPageUrl())
                <li class="page-item">
                  <a class="page-link" href="{{ $intervenants->nextPageUrl() }}" aria-label="Suivante">
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
