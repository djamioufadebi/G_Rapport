<div class="row">
  <div class="col-md-12">

    @if(session('success'))
    <script>
    Swal.fire({
      title: 'Nouveau intervenant ajouté avec succès!',
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
          <a href="{{route('intervenants.create')}}" class="text-white fs-6" style="text-decoration:none;">Ajouter
            Nouveau</a></button>
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
                <button type="submit" data-bs-toggle="modal" data-bs-target="#confirmationModal"
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
  </div>
</div>
