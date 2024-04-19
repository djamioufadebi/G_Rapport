<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body container-fluid">
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

                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom de l'Activité :</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom"
                            name="nom" wire:model="nom" required>
                        <!-- afiche le message d'erreur si le champs est vide  -->
                        @error('nom')
                            <div class="invalid-feedback">Le champ nom est requis.</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description de l'activité :</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            wire:model="description" rows="4" required></textarea>
                        <!-- afiche le message d'erreur si le champs est vide  -->
                        @error('description')
                            <div class="invalid-feedback">Le champ description est requis.</div>
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

                    <!-- Checkbox pour afficher ou cache le champ -->

                    <!-- mise de checkbox pour afficher ou cacher le champs de statut de l'activité -->
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <select id="statut" class="form-select @error('statut') is-invalid @enderror"
                                wire:model="statut" name="statut" required>
                                <!-- <option value="" selected disabled>Choisir le statut</option> -->
                                <option value="en attente">En attente</option>
                                <option value="en cours">En cours</option>
                                <option value="terminé">Terminé</option>
                                <option value="arrête">Arrêté</option>
                            </select>
                        </div>
                        @error('statut')
                            <div class="invalid-feedback">Le champ statut est requis.</div>
                        @enderror
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body container-fluid">
                <form method="POST" wire:submit.prevent="update">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="date_debut" class="form-label">Date Debut :</label>
                        <input type="date" class="form-control @error('date_debut') is-invalid @enderror"
                            id="date_debut" wire:model="date_debut" name="date_debut" required>
                        <!-- afiche le message d'erreur si le champs est vide  -->
                        @error('date_debut')
                            <div class="invalid-feedback">Le champ date debut est requis.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date_fin" class="form-label">Date Fin :</label>
                        <input type="date" class="form-control @error('date_fin') is-invalid @enderror"
                            id="date_fin" wire:model="date_fin" name="date_fin" required>
                        <div id="date_fin_error" class="invalid-feedback" style="display: none;">La date de fin ne peut
                            pas
                            être antérieure à la date de début.</div>
                        <!-- afiche le message d'erreur si le champs est vide  -->
                        @error('date_fin')
                            <div class="invalid-feedback">Le champ date_fin est requis.</div>
                        @enderror
                    </div>

                    <!-- Taux de réalisation -->
                    <div class="mb-3">
                        <label for="taux_de_realisation" class="form-label">Taux de réalisation :</label>
                        <input type="range" class="form-range @error('taux_de_realisation') is-invalid @enderror"
                            id="taux_de_realisation" wire:model="taux_de_realisation" name="taux_de_realisation"
                            min="0" max="100" step="0.1" required>
                        <output id="taux_value" class="mt-2">{{ $taux_de_realisation }}%</output>
                        @error('taux_de_realisation')
                            <div class="invalid-feedback">Le champ taux_de_realisation est requis.</div>
                        @enderror
                    </div>

                    <!-- Champs choix de projet -->
                    <div class="mb-3">
                        <label>Le nom du projet</label>
                        <select class="form-select @error('id_projet') is-invalid @enderror" id="id_projet"
                            wire:model="id_projet" name="id_projet">
                            <option value=""></option>
                            <!--  La boucle pour afficher la liste des projets -->
                            @foreach ($listeProjet as $item)
                                <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                            @endforeach
                        </select>
                        <!-- afiche le message d'erreur si le champs est vide  -->
                        @error('id_projet')
                            <div class="text text-red-500 mt-1 animate-pulse">Le niveau est requis.</div>
                        @enderror
                    </div>

            </div>
        </div>
        <br>
        <br>
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('activites') }}" class="btn btn-sm btn-danger text-white fs-6">Retourner à la liste</a>
            <button type="submit" class="btn main-color text text-bold">Mettre à jour</button>
        </div>
        </form>
    </div>
</div>
@livewireScripts()

<script src="{{ asset('js\js_activite\condition-statut_dates.js') }}"></script>

<script src="{{ asset('js\js_activite\date-condition_activite.js') }}"></script>

<script src="{{ asset('js\js_activite\barre-progression.js') }}"></script>
