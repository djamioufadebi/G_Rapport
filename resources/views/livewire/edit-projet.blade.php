<div>
    <div class="row">
        <div class="card">
            <div class="card-body container-fluid ">
                <form method="POST" wire:submit.prevent="update">
                    @csrf
                    @method('POST')

                    @if (Session::get('error'))
                        <div class="p-5">
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('date_error2'))
                        <div class="alert alert-danger">
                            {{ session('date_error2') }}
                        </div>
                    @endif
                    @if (session('date_error2'))
                        <script>
                            Swal.fire({
                                title: 'Erreur de date !',
                                text: 'la date de fin ne pas être postérieure à la date de debut !',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        </script>
                    @endif

                    <div class="mb-3">
                        <label for="libelle" class="form-label">libelle :</label>
                        <input type="text" class="form-control  @error('libelle')is-invalid
           @enderror"
                            id="libelle" name="libelle" wire:model="libelle" required>
                        <!-- afiche le message d'erreur si le champs est vide  -->
                        @error('libelle')
                            <div class="invalid-feedback">Le champ libelle est requis.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lieu" class="form-label">localisation :</label>
                        <input type="text" class="form-control  @error('lieu')is-invalid
           @enderror"
                            name="lieu" wire:model="lieu" required>
                        <!-- afiche le message d'erreur si le champs est vide  -->
                        @error('lieu')
                            <div class="invalid-feedback">Le champ lieu est requis.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description :</label>
                        <textarea class="form-control  @error('description')is-invalid
           @enderror" id="description"
                            wire:model="description" name="description" required></textarea>
                        <!-- afiche le message d'erreur si le champs est vide  -->
                        @error('description')
                            <div class="invalid-feedback">Le champ description est requis.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <!-- Checkbox pour afficher ou cache le champ -->
                        <label for="toggleCheckbox">Afficher </label>
                        <input type="checkbox" id="toggleCheckbox">
                    </div>
                    <br>
                    <!-- mise de checkbox pour afficher ou cacher le champs de statut de l'activité -->
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <select id="statut" class="form-select @error('statut') is-invalid @enderror"
                                wire:model="statut" name="statut" style="display: none;">
                                <!-- <option value="" selected disabled>Choisir le statut</option> -->
                                <option value="en attente">En attente</option>
                                <option value="en cours">En cours</option>
                                <option value="terminé">Terminé</option>
                                <option value="arrêté">Arrêté</option>
                            </select>
                        </div>
                        @error('statut')
                            <div class="invalid-feedback">Le champ statut est requis.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_debut" class="form-label">Date Debut :</label>
                        <input type="date" class="form-control @error('date_debut') is-invalid @enderror"
                            id="date_debut" wire:model="date_debut" name="date_debut" required>
                        <div class="error-message invalid-feedback" style="display: none;">Le champ date_debut est
                            requis.</div>
                    </div>

                    <div class="mb-3">
                        <label for="date_fin_prevue" class="form-label">Date Fin :</label>
                        <input type="date" class="form-control @error('date_fin_prevue') is-invalid @enderror"
                            id="date_fin_prevue" wire:model="date_fin_prevue" name="date_fin_prevue" required>
                        <div id="date_fin_prevue_error" class="error-message invalid-feedback" style="display: none;">La
                            date de fin
                            ne peut
                            pas être
                            antérieure à la date de début.</div>
                        <!-- Affiche le message d'erreur si le champ est vide -->
                        @error('date_fin_prevue')
                            <div class="error-message invalid-feedback">Le champ date fin est requis.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Sélectionner un gestionnaire</label>
                        <select class="form-select @error('id_gestionnaire') is-invalid @enderror" id="id_gestionnaire"
                            wire:model="id_gestionnaire" name="id_gestionnaire">
                            <option value=""></option>
                            <!--  La boucle pour afficher la liste des clients -->
                            @foreach ($managers as $item)
                                <option value="{{ $item->id }}">{{ $item->nom }} {{ $item->prenom }}</option>
                            @endforeach

                        </select>
                        <!-- afiche le message d'erreur si le champs est vide  -->
                        @error('id_gestionnaire')
                            <div class="invalid-feedback">Le champs gestionnaire est requis est requis.</div>
                        @enderror
                    </div>

                    <!-- Le client -->
                    <div class="mb-3">
                        <label>Le nom du client</label>
                        <select class="form-select @error('id_client') is-invalid @enderror" id="id_client"
                            wire:model="id_client" name="id_client">
                            <option value=""></option>
                            <!--  La boucle pour afficher la liste des clients -->
                            @foreach ($listeClient as $client)
                                <option value="{{ $client->id }}">{{ $client->nom }}</option>
                            @endforeach

                        </select>
                        <!-- afiche le message d'erreur si le champs est vide  -->
                        @error('id_client')
                            <div class="invalid-feedback">Le client est requis.</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between mb-4">

                        <a href="{{ route('projets') }}" class="btn btn-sm btn-danger text-white fs-6">Retourner à la
                            liste</a>
                        <button type="submit" class="btn main-color text text-bold">Mettre à jour</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@livewireScripts()
<script src="{{ asset('js\js_projet\condition-statut_dates.js') }}"></script>

<script src="{{ asset('js\js_projet\date-condition_projet.js') }}"></script>


<script src="{{ asset('js\js_projet\checkbox-statut.js') }}"></script>
