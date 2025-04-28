<div class="row">
    <div class="col-md-12">
        <!-- le bouton ajouter -->

        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Nouveau besoin!',
                    text: 'Votre besoin a été soumis avec succès',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('miseajour'))
            <script>
                Swal.fire({
                    title: 'Mise à jour!',
                    text: 'Votre besoin a été mise à jour avec succès',
                    icon: 'info',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('delete'))
            <script>
                Swal.fire({
                    title: 'Suppression ',
                    text: 'Le besoin a été supprimé!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('valider'))
            <script>
                Swal.fire({
                    title: 'Validation',
                    text: 'Besoin validé',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('rejeter'))
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
                    <a href="{{ route('besoins.pdf') }}" class="text-white fs-6" style="text-decoration:none;"><i
                            class="far fa-file-pdf"></i>
                        Imprimer la liste</a></button>
                @if (Auth::user()->id_profil == 2)
                    <button type="button" class="btn btn-primary">
                        <a href="{{ route('besoins.create') }}" class="text-white fs-6" style="text-decoration:none;"><i
                                class="fas fa-plus"></i>Ajouter</a></button>
                @endif

            </div>
            <div class="col-md-5">
                <input wire:change="s" wire:model.live="search" type="text" class="form-control"
                    placeholder="Rechercher un besoin par son libellé...">
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Libellé </th>
                            <th scope="col">Nom de l'activité </th>
                            <th scope="col">Date de création</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($listeBesoins as $besoin)
                            <tr>
                                <td>{{ $besoin->libelle }}</td>
                                <td>{{ $besoin->activite->nom }}</td>
                                <td>{{ $besoin->created_at }}</td>
                                <td>
                                    @if ($besoin->statut == 'Validé')
                                        <a href="#" data-bs-toggle="modal"
                                            @if (Auth::user()->id_profil == 1) data-bs-target="#confirmProfilModal{{ $besoin->id }}" @endif
                                            class="btn btn-sm badge bg-success">{{ $besoin->statut }}</a>
                                    @elseif ($besoin->statut == 'en attente')
                                        <a href="#" data-bs-toggle="modal"
                                            @if (Auth::user()->id_profil == 1) data-bs-target="#confirmProfilModal{{ $besoin->id }}" @endif
                                            class="btn btn-sm badge bg-warning">{{ $besoin->statut }}</a>
                                    @elseif ($besoin->statut == 'rejeté')
                                        <a href="#" data-bs-toggle="modal"
                                            @if (Auth::user()->id_profil == 1) data-bs-target="#confirmProfilModal{{ $besoin->id }}" @endif
                                            class="btn btn-sm badge bg-danger">{{ $besoin->statut }}</a>
                                    @endif
                                </td>

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
                                                <a href="{{ route('besoins.show', $besoin->id) }}"
                                                    class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Voir
                                                    détails</a>
                                            </li>
                                            @if (Auth::user()->id === $besoin->user_id)
                                                <li>
                                                    <a href="{{ route('besoins.edit', $besoin->id) }}"
                                                        class="btn btn-sm btn-warning"><i class="fas fa-pen"></i>
                                                        Modifier
                                                    </a>
                                                </li>
                                            @endif

                                            <li>
                                                @if (Auth::user()->id_profil == 1 || Auth::user()->id === $besoin->user_id)
                                                    <!-- Un bouton pour supprimer le rapport -->
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#confirmationModal{{ $besoin->id }}"
                                                        class="btn btn-sm btn-danger"><i class="fas fa-trash-alt">
                                                        </i>Supprimer
                                                    </a>
                                                @endif

                                            </li>
                                        </ul>
                                    </div>
                                </td>

                                @include('modals.modals-status.modal-besoin-statut')

                                <!-- Modal pour la confirmation de la suppression -->
                                <!-- La Modal -->
                                <div wire:ignore.self class="modal fade" id="confirmationModal{{ $besoin->id }}"
                                    tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <!-- Contenu du modal -->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmation de suppression</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer cet Besoin ?
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('besoins') }}">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">NON</button>
                                                </a>
                                                <!-- Code du bouton supprimer du modal -->
                                                <button wire:click="confirmDelete('{{ $besoin->id }}')"
                                                    class="btn btn-danger">OUI</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @livewireScripts
                        @endforeach
                    </tbody>
                </table>
                <!-- Lien de pagination -->
                <div class="container my-4">
                    {{ $listeBesoins->links() }}
                </div>


            </div>
        </div>
    </div>
</div>
