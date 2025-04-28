<div class="row">
    <div class="card">
        <div class="card-body container-fluid ">
            <form method="POST" wire:submit.prevent="store">
                @csrf
                @method('POST')

                @if (session('dejautiliser'))
                    <script>
                        Swal.fire({
                            title: 'Enregistrement impossible!',
                            text: 'Une activité avec cet nom existe déjà dans la base !',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    </script>
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

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <script>
                        Swal.fire({
                            title: 'Erreur!',
                            text: 'Erreur d\'enregistrement de l\'activité ',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    </script>
                @endif

                <!-- Champs choix de projet -->
                <div class="mb-3">
                    <label for="id_projet" class="form-label">Choix du projet :</label>
                    <select class="form-select @error('id_projet') is-invalid @enderror" id="id_projet"
                        wire:model="id_projet" name="id_projet">
                        <option value=""></option>
                        @foreach ($listeProjet as $item)
                            <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                        @endforeach
                    </select>

                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('id_projet')
                        <div class="text text-red-500 mt-1 animate-pulse">Le niveau est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de l'Activité :</label>
                    <input type="text" class="form-control  @error('nom')is-invalid
           @enderror"
                        id="nom" name="nom" wire:model="nom" required>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('nom')
                        <div class="invalid-feedback">Le champ nom est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description de l'activité :</label>
                    <textarea class="form-control  @error('description')is-invalid
           @enderror" id="description" name="description"
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

                <div class="mb-3">
                    <label for="date_debut" class="form-label">Date Debut :</label>
                    <input type="date" class="form-control @error('date_debut') is-invalid @enderror" id="date_debut"
                        wire:model="date_debut" name="date_debut" required>
                    <div class="error-message invalid-feedback" style="display: none;">Le champ date_debut est requis.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="date_fin" class="form-label">Date Fin :</label>
                    <input type="date" class="form-control @error('date_fin') is-invalid @enderror" id="date_fin"
                        wire:model="date_fin" name="date_fin" required>
                    <div id="date_fin_error" class="error-message invalid-feedback" style="display: none;">La date de
                        fin ne peut
                        pas être
                        antérieure à la date de début.</div>
                    @error('date_fin')
                        <div class="error-message invalid-feedback">Le champ date_fin est requis.</div>
                    @enderror
                </div>


                <!-- Taux de réalisation avec barre de progression -->
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
                <!-- Barre de progression -->
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: {{ $taux_de_realisation }}%;"></div>
                </div>


        </div>

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('activites') }}" class="btn btn-sm btn-danger text-white fs-6">Retour à la
                liste</a></button>

            <button type="submit" class="btn main-color text text-bold">Enregistrer</button>
        </div>

        </form>
    </div>
</div>
</div>

@livewireScripts()

<script src="{{ asset('js\js_activite\condition-statut_dates.js') }}"></script>

<script src="{{ asset('js\js_activite\date-condition_activite.js') }}"></script>

<script src="{{ asset('js\js_activite\barre-progression.js') }}"></script>

<script src="{{ asset('js\js_activite\checkbox-statut.js') }}"></script>
