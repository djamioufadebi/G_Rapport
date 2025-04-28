<div class="row">
    <div class="col-md-22">

        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Ajout d\'activité ',
                    text: ' Nouvelle activité ajoutée !',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif
        @if (session('delete'))
            <script>
                Swal.fire({
                    title: 'Suppression du activité',
                    text: 'Le activité a été supprimée !',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('valider'))
            <script>
                Swal.fire({
                    title: 'Finition  !',
                    text: 'L\'activité est finalisée',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('rejeter'))
            <script>
                Swal.fire({
                    title: 'Arrêt!',
                    text: 'L\'activité a été arrêtée',
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

        <!-- le bouton ajouter -->
        <div class=" row d-flex justify-content-between mb-2">
            <div class="col-md-6">
                <button type="button" class="btn btn-secondary">
                    <a href="{{ route('activites.pdf') }}" class="text-white fs-6" style="text-decoration:none;"><i
                            class="far fa-file-pdf"></i>Imprimer la liste</a></button>
                <button type="button" class="btn main-color">
                    <a href="{{ route('activites.create') }}" class="text-white fs-6" style="text-decoration:none;"><i
                            class="fas fa-plus"></i>Ajouter
                    </a></button>
            </div>
            <div class="col-md-2">
                <input wire:change="s" wire:model.live="search" type="text" class="form-control"
                    placeholder="Rechercher une activité par son nom...">
            </div>
        </div>

        <div class="card">
            <!-- <div class="card-header">Liste des articles</div> -->
            <div class="card-body">
                <table class="table table-striped table-bordered ">
                    <thead>
                        <tr>
                            <th scope="col">Nom de l'activité</th>
                            <th scope="col">Projet</th>
                            <th scope="col">Date debut</th>
                            <th scope="col">Date de fin</th>
                            <th scope="col">Taux de réalisation</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Ajouté</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($listeActivites as $activite)
                            <tr>
                                <td>{{ $activite->nom }}</td>
                                <td>{{ $activite->projet->libelle }} </td>
                                <td>{{ $activite->date_debut }}</td>
                                <td>{{ $activite->date_fin }}</td>
                                <td>{{ $activite->taux_de_realisation }} %</td>
                                <td>
                                    @if ($activite->statut == 'en attente')
                                        <a href="#" data-bs-toggle="modal"
                                            @if (Auth::user()->id_profil == 2) data-bs-target="#confirmProfilModal{{ $activite->id }}" @endif
                                            class=" btn btn-sm badge bg-success">{{ $activite->statut }}</a>
                                    @elseif ($activite->statut == 'en cours')
                                        <a href="#" data-bs-toggle="modal"
                                            @if (Auth::user()->id_profil == 2) data-bs-target="#confirmProfilModal{{ $activite->id }}" @endif
                                            class=" btn btn-sm badge bg-success">{{ $activite->statut }}</a>
                                    @elseif ($activite->statut == 'arrêté')
                                        <a href="#" data-bs-toggle="modal"
                                            @if (Auth::user()->id_profil == 2) data-bs-target="#confirmProfilModal{{ $activite->id }}" @endif
                                            class="btn btn-sm badge bg-warning">{{ $activite->statut }}</a>
                                    @elseif ($activite->statut == 'terminé')
                                        <a href="#" data-bs-toggle="modal"
                                            @if (Auth::user()->id_profil == 2) data-bs-target="#confirmProfilModal{{ $activite->id }}" @endif
                                            class="btn btn-sm badge bg-danger">{{ $activite->statut }}</a>
                                    @endif
                                </td>
                                <td>{{ $activite->created_at->diffForHumans() }}</td>

                                <td class="text-center">
                                    <div class="btn-group dropdown " style="text-align: center; ">
                                        <button type="button" class="btn btn-sm main-color ">Action</button>
                                        <button type="button"
                                            class="btn btn-sm main-color dropdown-toggle dropdown-toggle-split"
                                            data-bs-toggle="dropdown" aria-expanded="true">
                                            <span class="visually-hidden">Actions</span>
                                        </button>
                                        <ul class="dropdown-menu main-color">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('activites.show', $activite->id) }}">
                                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                                    Voir détails
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('activites.edit', $activite->id) }}">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                    Editer
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item btn btn-sm btn-danger" type="submit"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmationModal{{ $activite->id }}">
                                                    <i class="fas fa-trash-alt"></i>Supprimer
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                                @include('modals.modals-status.modal-activite-statut')

                                <!-- Modal pour la confirmation de la suppression -->
                                <!-- La Modal -->
                                <div wire:ignore.self class="modal fade" id="confirmationModal{{ $activite->id }}"
                                    tabindex="-2" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <!-- Contenu du modal -->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="modal-title">Confirmation de suppression</h2>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer cette activité ?
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('activites') }}">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">NON</button>
                                                </a>
                                                <!-- Code du bouton supprimer du modal -->
                                                <button wire:click="confirmDelete('{{ $activite->id }}')"
                                                    class="btn btn-danger">OUI</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @livewireScripts
                                <!-- Fin pop up du modal -->
                        @endforeach
                    </tbody>
                </table>

                <!-- Lien de pagination -->
                <div class="container my-4">
                    {{ $listeActivites->links() }}
                </div>
                <!-- Fin du lien  -->

            </div>
        </div>
    </div>
</div>
