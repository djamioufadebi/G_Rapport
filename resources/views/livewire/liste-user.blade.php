<div class="row">
    <div class="col-md-12">

        <!-- le bouton ajouter -->
        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Ajout d\'un utilisateur!',
                    text: 'Nouveau utilisateur enregistré',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('miseajour'))
            <script>
                Swal.fire({
                    title: 'Mise à jour!',
                    text: 'Cet utilisateur a été mise à jour avec succès',
                    icon: 'info',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('edition'))
            <script>
                Swal.fire({
                    title: 'Mise à jour de l\'utilisateur!',
                    text: '{{ session('
                                                                                                                                                                                                                                                                          edition ') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('attributionerror'))
            <script>
                Swal.fire({
                    title: 'Selectionnez un profil avant d\'enregistrer !',
                    text: '{{ session('
                                                                                                                                                                                                                                                                          attributionerror ') }}',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('attribution'))
            <script>
                Swal.fire({
                    title: 'Profil assigné !',
                    text: 'Vous avez assigné le profil à l\'utilisateur',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif


        <div class=" row d-flex justify-content-between mb-3">
            <div class="col-md-3">
                <button type="button" class="btn btn-secondary">
                    <a href="{{ route('users.pdf') }}" class="text-white fs-6" style="text-decoration:none;"><i
                            class="far fa-file-pdf"></i>
                        Imprimer la liste</a></button>
                <button type="button" class="btn main-color">
                    <a href="{{ route('users.create') }}" class="text-white fs-6" style="text-decoration:none;"><i
                            class="fas fa-plus"></i>Ajouter</a></button>
            </div>
            <div class="col-md-5">
                <input wire:change="s" wire:model.live="search" type="text" class="form-control"
                    placeholder="Rechercher un utilisateur par son nom...">
            </div>
        </div>

        <div class="card">
            <!-- <div class="card-header">Liste des articles</div> -->
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nom </th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Profil</th>
                            <th scope="col">Opération</th>

                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($listeUsers as $user)
                            <tr>
                                <td>{{ $user->nom }}</td>
                                <td>{{ $user->prenom }}</td>

                                <td>{{ $user->email }}</td>
                                <td>{{ $user->profil->nom }}</td>
                                <td>
                                    <button type="submit" data-bs-toggle="modal"
                                        data-bs-target="#confirmProfilModal{{ $user->id }}"
                                        class="btn btn-sm btn-success">Attribuer un profil
                                    </button>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group dropdown " style="text-align: center; ">
                                        <button type="button" class="btn btn-sm "
                                            style="background: #42C2FF;">Action</button>
                                        <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                                            style="background: #42C2FF;" data-bs-toggle="dropdown" aria-expanded="true">
                                            <span class="visually-hidden">Actions</span>
                                        </button>
                                        <ul class="dropdown-menu" style="background: #42C2FF;">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('users.show', $user->id) }}">
                                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                                    Voir détails
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                    Editer
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item btn btn-sm btn-danger" type="submit"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmationModal{{ $user->id }}">
                                                    <i class="fas fa-trash-alt"></i>Supprimer
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                                <div wire:ignore class="modal fade" id="confirmationModal{{ $user->id }}"
                                    tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <!-- Contenu du modal -->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmation de suppression de l'utilisateur
                                                    {{ $user->nom }}
                                                    {{ $user->prenom }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer cet utilisateur ?
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('users') }}">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">NON</button>
                                                </a>
                                                <!-- Code du bouton supprimer du modal -->
                                                <button wire:click="confirmDelete('{{ $user->id }}')"
                                                    class="btn btn-danger">OUI</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div wire:ignore class="modal fade" id="confirmProfilModal{{ $user->id }}"
                                    tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <!-- Contenu du modal -->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Attribuer un profil à l'utilisateur
                                                    {{ $user->nom }} {{ $user->prenom }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <br>
                                                    <div class="text-center">
                                                        <label class="font-weight-bold d-block">Sélectionnez un profil
                                                            :</label>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <select class="form-control" name="id_profil"
                                                        wire:model="selectedProfilId">
                                                        @foreach ($listeProfil as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nom }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <br>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('users') }}">
                                                    <button type="button" class="btn btn-danger">Annuler</button>
                                                </a>

                                                <!-- le wire:click est à mettre -->
                                                <button wire:click="confirmSaveIdProfil({{ $user->id }})"
                                                    class="btn main-color">Enregistrer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @livewireScripts
                            </tr>
                        @endforeach
                    </tbody>

                </table>

                <!-- Lien de pagination -->
                <div class="container my-4">
                    {{ $listeUsers->links() }}
                </div>
                <!-- Fin du lien  -->

            </div>
        </div>
    </div>
</div>
