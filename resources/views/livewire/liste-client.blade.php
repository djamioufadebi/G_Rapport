<div class="row">
    <div class="col-md-12">

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- le bouton ajouter -->
        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Nouveau client !',
                    text: ' client ajouté avec succès !',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('miseajour'))
            <script>
                Swal.fire({
                    title: 'Mise à jour!',
                    text: 'Cet client a été mise à jour avec succès',
                    icon: 'info',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('delete'))
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
                    <a href="{{ route('clients.pdf') }}" class="text-white fs-6" style="text-decoration:none;"><i
                            class="far fa-file-pdf"></i>
                        Imprimer la liste</a></button>
                @if (Auth::user()->id_profil == 1)
                    <button type="button" class="btn main-color">
                        <a href="{{ route('clients.create') }}" class="text-white fs-6" style="text-decoration:none;"><i
                                class="fas fa-plus"></i>Ajouter</a></button>
                @endif
            </div>
            <div class="col-md-5">
                <input wire:change="s" wire:model.live="search" type="text" class="form-control"
                    placeholder="Rechercher un client par son nom...">
            </div>
        </div>

        <div class="card">
            <!-- <div class="card-header">Liste des articles</div> -->
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nom </th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Ajouté</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    <tbody id="myTable">
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->nom }}</td>
                                <td>{{ $client->adresse }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->contact }}</td>
                                <td>{{ $client->created_at->diffForHumans() }}</td>

                                <td class="text-center">
                                    <div class="btn-group dropdown " style="text-align: center; ">
                                        <button type="button" class="btn btn-sm main-color">Action</button>
                                        <button type="button"
                                            class="btn btn-sm main-color dropdown-toggle dropdown-toggle-split"
                                            data-bs-toggle="dropdown" aria-expanded="true">
                                            <span class="visually-hidden">Actions</span>
                                        </button>
                                        <ul class="dropdown-menu main-color">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('clients.show', $client->id) }}">
                                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                                    Voir détails
                                                </a>
                                            </li>
                                            <li>
                                                @if (Auth::user()->id_profil == 1)
                                                    <a class="dropdown-item"
                                                        href="{{ route('clients.edit', $client->id) }}">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                        Editer
                                                    </a>
                                                @endif
                                            </li>

                                            <li>
                                                @if (Auth::user()->id_profil == 1)
                                                    <a class="dropdown-item btn btn-sm btn-danger" type="submit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmationModal{{ $client->id }}">
                                                        <i class="fas fa-trash-alt"></i>Supprimer
                                                    </a>
                                                @endif

                                            </li>
                                        </ul>
                                    </div>
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
                                    <a href="{{ route('clients') }}">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">NON</button>
                                    </a>
                                    <!-- Code du bouton supprimer du modal -->
                                    <button wire:click="confirmDelete('{{ $client->id }}')"
                                        class="btn btn-danger">OUI</button>
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
                    {{ $clients->links() }}
                </div>
                <!-- Fin du lien  -->
            </div>
        </div>

    </div>
</div>
