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

    @if(session('delete'))
    <script>
    Swal.fire({
      title: 'Le client supprimé !',
      text: '{{ session('
      success ') }}',
      icon: 'error',
      confirmButtonText: 'OK'
    })
    </script>
    @endif

    <!-- le bouton ajouter -->
    <div class=" row d-flex justify-content-between mb-3">
      <div class="col-md-3">
        <button type="button" class="btn btn-secondary">
          <a href="{{route('intervenants.pdf')}}" class="text-white fs-6" style="text-decoration:none;">Génerer
            PDF</a></button>
        <button type="button" class="btn btn-primary">
          <a href="{{route('intervenants.create')}}" class="text-white fs-6" style="text-decoration:none;">Ajouter
            Nouveau</a></button>
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
                <a href="{{ route('intervenants.show', $intervenant->id) }}" class="btn btn-sm btn-info">Détails</a>
                <!-- Un bouton pour modifier le intervenant -->
                <a href="{{ route('intervenants.edit', $intervenant->id) }}" class="btn btn-sm btn-warning">Modifier</a>

                <!-- Un bouton pour supprimer le intervenant -->
                <button type="submit" data-bs-toggle="modal" @if (in_array(Auth::user()->id_profil, [1, 3]))
                  data-bs-target="#confirmationModal" @endif
                  class="btn btn-sm btn-danger">Supprimer
                </button>
              </td>

          </tbody>
          <!-- Le pop up du modal -->
          @include('modals.confirmation-modal')
          <!-- Fin pop up du modal -->
          @endforeach

        </table>

        <div class=" p-4">
          {{ $intervenants->links('Pagination.bootstrap-pagination') }}
        </div>

      </div>
    </div>
    </di v>
  </div>
