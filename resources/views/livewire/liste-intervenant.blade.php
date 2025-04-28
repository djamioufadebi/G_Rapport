<div class="row">
    <div class="col-md-12">

        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Nouveau intervenant',
                    text: 'Intervenant ajouté avec succès!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('miseajour'))
            <script>
                Swal.fire({
                    title: 'Mise à jour!',
                    text: 'Cet intervenant a été mise à jour avec succès',
                    icon: 'info',
                    confirmButtonText: 'OK'
                })
            </script>
        @endif

        @if (session('delete'))
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
                    <a href="{{ route('intervenants.pdf') }}" class="text-white fs-6" style="text-decoration:none;"><i
                            class="far fa-file-pdf"></i>
                        Imprimer la liste</a></button>
                <button type="button" class="btn main-color">
                    <a href="{{ route('intervenants.create') }}" class="text-white fs-6"
                        style="text-decoration:none;"><i class="fas fa-plus"></i>Ajouter</a></button>
            </div>
            <div class="col-md-5">
                <input wire:change="s" wire:model.live="search" type="text" class="form-control"
                    placeholder="Rechercher un intervenant par son nom...">
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
                            <th scope="col">Contact</th>
                            <th scope="col">Ajouté</th>
                            <th scope="col">Email</th>
                            <th scope="col">Activité participée</th>
                            <th scope="col">Date de participation</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($intervenants as $intervenant)
                            <tr>
                                <td>{{ $intervenant->nom }}</td>
                                <td>{{ $intervenant->prenom }}</td>
                                <td>{{ $intervenant->email }}</td>
                                <td>{{ $intervenant->contact }}</td>
                                <td>{{ $intervenant->created_at->diffForHumans() }}</td>
                                <td>{{ $intervenant->activite->nom }}</td>
                                <td>{{ $intervenant->date_participation }}</td>

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
                                                    href="{{ route('intervenants.show', $intervenant->id) }}">
                                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                                    Voir détails
                                                </a>
                                            </li>
                                            <li>
                                                @if (Auth::user()->id_profil == 1)
                                                    <a class="dropdown-item"
                                                        href="{{ route('intervenants.edit', $intervenant->id) }}">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                        Editer
                                                    </a>
                                                @endif
                                            </li>

                                            <li>
                                                {{-- @if (Auth::user()->id_profil == 1)
                                                    <a class="dropdown-item btn btn-sm btn-danger" type="submit"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmationModal{{ $intervenant->id }}">
                                                        <i class="fas fa-trash-alt"></i>Supprimer
                                                    </a>
                                                @endif --}}
                                                <a class="dropdown-item btn btn-sm btn-danger" type="submit"
                                                    data-bs-toggle="modal"
                                                    @if (in_array(Auth::user()->id_profil, [1, 3])) data-bs-target="#confirmationModal" @endif><i
                                                        class="fas fa-trash-alt"></i> Supprimer
                                                </a>

                                            </li>
                                        </ul>
                                    </div>
                                </td>

                    </tbody>
                    <!-- Le pop up du modal -->
                    @include('modals.confirmation-modal')
                    <!-- Fin pop up du modal -->
                    @endforeach

                </table>



                <!-- Lien de pagination -->
                <div class="container my-4">
                    {{ $intervenants->links() }}
                </div>
                <!-- Fin du lien  -->

            </div>
        </div>
    </div>
</div>
