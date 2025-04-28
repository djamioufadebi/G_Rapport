<div class="row">
    <div class="col-md-12">
        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Nouveau rapport!',
                    text: 'Votre rapport a été soumis avec succès',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('miseajour'))
            <script>
                Swal.fire({
                    title: 'Mise à jour!',
                    text: 'Cet rapport a été mise à jour avec succès',
                    icon: 'info',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('delete'))
            <script>
                Swal.fire({
                    title: 'Suppression ',
                    text: 'Le rapport a été supprimé!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('valider'))
            <script>
                Swal.fire({
                    title: 'Validation',
                    text: 'Rapport validé',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('rejeter'))
            <script>
                Swal.fire({
                    title: 'Rejet !!!',
                    text: 'Rapport réjeté',
                    icon: 'info',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif
        <!-- le bouton ajouter -->
        <div class=" row d-flex justify-content-between mb-3">
            <div class="col-md-3">
                <button type="button" class="btn btn-secondary">
                    <a href="{{ route('rapports.pdf') }}" class="text-white fs-6" style="text-decoration:none;">
                        <i class="far fa-file-pdf"></i>Imprimer la liste</a></button>
                @if (Auth::user()->id_profil == 2)
                    <button type="button" class="btn main-color">
                        <a href="{{ route('rapports.create') }}" class="text-white fs-6"
                            style="text-decoration:none;"><i class="fas fa-plus"></i>Ajouter</a></button>
                @endif
            </div>
            <div class="col-md-5">
                <input wire:model.live="search" type="text" class="form-control"
                    placeholder="Rechercher un rapport par son Libellé...">
                {{-- wire:change="s" --}}
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Libellé </th>
                            <th scope="col">Activité</th>
                            <th scope="col">Projet</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Taux de réalisation </th>
                            <th scope="col">Ajouté</th>
                            <th scope="col">Actions</th>
                        </tr>

                    </thead>

                    <tbody>
                        @foreach ($listeRapport as $rapport)
                            <tr>
                                <td class="text-truncate" style="max-width: 150px;">{{ $rapport->libelle }}</td>
                                <td>{{ $rapport->activite->nom }}</td>
                                <td class="text-truncate" style="max-width: 150px;">
                                    {{ $rapport->activite->projet->libelle }}</td>
                                <!-- Le profil qui peut accéder à ces pages des bouttons -->

                                <td>
                                    <!-- href : le lien vers la page de modification du statut/ à mettre en place -->
                                    @if ($rapport->statut == 'Validé')
                                        <a href="#" data-bs-toggle="modal"
                                            @if (Auth::user()->id_profil == 1) data-bs-target="#confirmProfilModal{{ $rapport->id }}" @endif
                                            class="btn btn-sm badge bg-success">{{ $rapport->statut }}</a>
                                    @elseif ($rapport->statut == 'en attente')
                                        <a href="#" data-bs-toggle="modal"
                                            @if (Auth::user()->id_profil == 1) data-bs-target="#confirmProfilModal{{ $rapport->id }}" @endif
                                            class="btn btn-sm badge bg-warning">{{ $rapport->statut }}</a>
                                    @elseif ($rapport->statut == 'rejeté')
                                        <a href="#" data-bs-toggle="modal"
                                            @if (Auth::user()->id_profil == 1) data-bs-target="#confirmProfilModal{{ $rapport->id }}" @endif
                                            class="btn btn-sm badge bg-danger">{{ $rapport->statut }}</a>
                                    @endif

                                </td>

                                <td>{{ $rapport->activite->taux_de_realisation }}</td>
                                <td>{{ $rapport->created_at->diffForHumans() }}</td>


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
                                                    href="{{ route('rapports.show', $rapport->id) }}">
                                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                                    Voir détails
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('rapports.edit', $rapport->id) }}">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                    Editer
                                                </a>
                                            </li>

                                            <li>
                                                @if (Auth::user()->id_profil == 1 || Auth::user()->id === $rapport->user_id)
                                                    <a class="dropdown-item btn btn-sm btn-danger" type="submit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmationModal{{ $rapport->id }}">
                                                        <i class="fas fa-trash-alt"></i>Supprimer
                                                    </a>
                                                @endif

                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <!-- Par exemple, un lien pour afficher le rapports détaillé -->





                    </tbody>

                    @include('modals.modals-status.modal-rapport-statut')

                    <!-- Modal pour la confirmation de la suppression -->
                    <!-- La Modal -->
                    <div wire:ignore.self class="modal fade" id="confirmationModal{{ $rapport->id }}" tabindex="-1"
                        role="dialog">
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
                                    Êtes-vous sûr de vouloir supprimer cet rapport ?
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('rapports') }}">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">NON</button>
                                    </a>
                                    <!-- Code du bouton supprimer du modal -->
                                    <button wire:click="confirmDelete('{{ $rapport->id }}')"
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
                    {{ $listeRapport->links() }}
                </div>
                <!-- Fin du lien  -->

            </div>
        </div>
    </div>
</div>
