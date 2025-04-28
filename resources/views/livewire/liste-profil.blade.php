<div class="row">
    <div class="md-8 justify-content-between">

        @include('composants.sweetalert-message')

        <!-- le bouton ajouter -->
        <div class=" row d-flex justify-content-between mb-3">
            <div class="col-md-3">
                <button type="button" class="btn btn-secondary">
                    <a href="{{ route('profils.pdf') }}" class="text-white fs-6" style="text-decoration:none;">
                        <i class="far fa-file-pdf"></i>Imprimer la liste</a></button>
                <button type="button" class="btn main-color">
                    <a href="{{ route('profils.create') }}" class="text-white fs-6" style="text-decoration:none;"><i
                            class="fas fa-plus"></i>Ajouter
                    </a>
                </button>
            </div>
            <div class="col-md-5">
                <input wire:change="s" wire:model.live="search" type="text" class="form-control"
                    placeholder="Rechercher un profil par son nom...">
            </div>
        </div>

        <div class="card">
            <!-- <div class="card-header">Liste des articles</div> -->

            <div class="card-body">
                <div class=" row d-flex justify-content-between mb-3">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Nom </th>
                                <th scope="col">Ajouté </th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($profils as $profil)
                                <tr>
                                    <td>{{ $profil->nom }}</td>
                                    <td>{{ $profil->created_at->diffForHumans() }}</td>
                                    <td>
                                        <!-- Par exemple, un lien pour afficher le profils détaillé -->
                                        <a href="{{ route('profils.show', $profil->id) }}"
                                            class="btn btn-sm btn-info"><i class="fas fa-eye"></i> </a>
                                        <!-- Un bouton pour modifier le profil -->
                                        {{-- <a href="{{ route('profils.edit', $profil->id) }}"
                                            class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a> --}}

                                        <!-- Un bouton pour supprimer le profil -->
                                        {{-- <button type="submit" data-bs-toggle="modal"
                                            data-bs-target="#confirmationModal" class="btn btn-sm btn-danger"><i
                                                class="fas fa-trash-alt"></i>
                                        </button> --}}
                                    </td>
                                </tr>

                        </tbody>

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
                                        Êtes-vous sûr de vouloir supprimer ce profil ?
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('profils') }}">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">NON</button>
                                        </a>
                                        <button wire:click="confirmDelete('{{ $profil->id }}')"
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
                    <!-- pagination : links -->
                    <div class=" my-1">
                        {{ $profils->links() }}
                    </div>



                </div>

            </div>
        </div>
    </div>
</div>
