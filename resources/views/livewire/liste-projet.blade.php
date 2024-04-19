<div class="row">
    <div class="col-md-12">

        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Ajout de projet ',
                    text: ' Nouveau projet ajouté !',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session(' miseajour'))
            <script>
                Swal.fire({
                    title: 'Mise à jour !',
                    text: 'Le Projet a été mise à jour !',
                    icon: 'info',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('delete'))
            <script>
                Swal.fire({
                    title: 'Suppression du projet',
                    text: 'Le Projet a été supprimé !',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('valider'))
            <script>
                Swal.fire({
                    title: 'Finition  !',
                    text: 'Le Projet est finalisé',
                    icon: 'info',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif


        @if (session('attributionmanager'))
            <script>
                Swal.fire({
                    title: 'Gestionnaire nommé !',
                    text: 'Un gestionnaire est nommé pour ce Projet',
                    icon: 'info',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif


        @if (session('rejeter'))
            <script>
                Swal.fire({
                    title: 'Arrêt!',
                    text: 'Le Projet a été arrêté',
                    icon: 'info',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif
        <!-- le bouton ajouter -->
        <div class=" row d-flex justify-content-between mb-3">
            <div class="col-md-3">
                <button type="button" class="btn btn-secondary">
                    <a href="{{ route('projets.pdf') }}" class="text-white fs-6" style="text-decoration:none;"><i
                            class="far fa-file-pdf"></i>
                        Imprimer la liste</a></button>
                @if (Auth::user()->id_profil == 1)
                    <button type="button" class="btn main-color">
                        <a href="{{ route('projets.create') }}" class="text-white fs-6" style="text-decoration:none;"><i
                                class="fas fa-plus"></i>Ajouter</a></button>
                @endif
            </div>
            <div class="col-md-3">
                {{-- wire:model.live="search" --}}
                <input type="text" class="form-control" id="searchInput"
                    placeholder="Rechercher un projet par son Libellé...">
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Libellé </th>
                            <th scope="col">Date début</th>
                            <th scope="col">Date Fin</th>
                            <th scope="col">Créateur</th>
                            <th scope="col">Nom du client</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Ajouté</th>
                            @if (Auth::user()->id_profil == 1)
                                <th scope="col">Opération</th>
                            @endif
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach ($projets as $projet)
                            <tr>
                                <td class="text-truncate" style="max-width: 150px;">{{ $projet->libelle }}</td>
                                <td>{{ $projet->date_debut }}</td>
                                <td>{{ $projet->date_fin_prevue }}</td>
                                <td>{{ $projet->user->nom }} {{ $projet->user->prenom }} </td>

                                <td>{{ $projet->client->nom }}</td>

                                <td>
                                    <!-- href : le lien vers la page de modification du statut/ à mettre en place -->
                                    @if ($projet->statut == 'en attente')
                                        <a href="#" data-bs-toggle="modal"
                                            @if (Auth::user()->id_profil == 1 || Auth::user()->id === $projet->id_gestionnaire) data-bs-target="#confirmProfilModal{{ $projet->id }}" @endif
                                            class=" btn btn-sm badge bg-success">{{ $projet->statut }}</a>
                                    @elseif ($projet->statut == 'en cours')
                                        <a href="#" data-bs-toggle="modal"
                                            @if (Auth::user()->id_profil == 1 || Auth::user()->id === $projet->id_gestionnaire) data-bs-target="#confirmProfilModal{{ $projet->id }}" @endif
                                            class=" btn btn-sm badge bg-success">{{ $projet->statut }}</a>
                                    @elseif ($projet->statut == 'arrêté')
                                        <a href="#" data-bs-toggle="modal"
                                            @if (Auth::user()->id_profil == 1 || Auth::user()->id === $projet->id_gestionnaire) data-bs-target="#confirmProfilModal{{ $projet->id }}" @endif
                                            class=" btn btn-sm badge bg-warning">{{ $projet->statut }}</a>
                                    @elseif ($projet->statut == 'terminé')
                                        <a href="#" data-bs-toggle="modal"
                                            @if (Auth::user()->id_profil == 1 || Auth::user()->id === $projet->id_gestionnaire) data-bs-target="#confirmProfilModal{{ $projet->id }}" @endif
                                            class=" btn btn-sm badge bg-danger">{{ $projet->statut }}</a>
                                    @endif
                                </td>
                                <td>{{ $projet->created_at->diffForHumans() }}</td>
                                <td>
                                    @if (Auth::user()->id_profil == 1)
                                        <button type="submit" data-bs-toggle="modal"
                                            data-bs-target="#NommerGestionnaireModal{{ $projet->id }}"
                                            class="btn btn-md badge-primary ">
                                            <span class="badge bg-light text-dark text-bold">Nommmer Gestionnaire</span>
                                        </button>
                                    @endif
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
                                                <a class="dropdown-item"
                                                    href="{{ route('projets.show', $projet->id) }}">
                                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                                    Voir détails
                                                </a>
                                            </li>
                                            <li>
                                                @if (Auth::user()->id_profil == 1)
                                                    <a class="dropdown-item"
                                                        href="{{ route('projets.edit', $projet->id) }}">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                        Editer
                                                    </a>
                                                @endif
                                            </li>

                                            <li>
                                                @if (Auth::user()->id_profil == 1)
                                                    <a class="dropdown-item btn btn-sm btn-danger" type="submit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmationModal{{ $projet->id }}">
                                                        <i class="fas fa-trash-alt"></i>Supprimer
                                                    </a>
                                                @endif

                                            </li>
                                        </ul>
                                    </div>
                                </td>
                    </tbody>

                    @include('modals.modals-status.modal-projet-statut')

                    @include('modals.modals-status.modal-nommer-gest')

                    <!-- Modal pour la confirmation de la suppression -->
                    <!-- La Modal -->
                    <div wire:ignore.self class="modal fade" id="confirmationModal{{ $projet->id }}" tabindex="-1"
                        role="dialog">
                        <div class="modal-dialog" role="document">
                            <!-- Contenu du modal -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Confirmation de suppression</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer cet Projet ?
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('projets') }}">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">NON</button>
                                    </a>
                                    <!-- Code du bouton supprimer du modal -->
                                    <button wire:click="confirmDelete('{{ $projet->id }}')"
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

                    </tbody>
                </table>

                <!-- Lien de pagination -->
                <div class="container my-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end">
                            {{-- Lien vers la page précédente --}}
                            @if ($projets->previousPageUrl())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $projets->previousPageUrl() }}"
                                        aria-label="Précédente">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link" aria-hidden="true">&laquo;</span>
                                </li>
                            @endif

                            {{-- Affichage des numéros de page --}}
                            @for ($i = 1; $i <= $projets->lastPage(); $i++)
                                <li class="page-item {{ $i == $projets->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $projets->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Lien vers la page suivante --}}
                            @if ($projets->nextPageUrl())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $projets->nextPageUrl() }}" aria-label="Suivante">
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
