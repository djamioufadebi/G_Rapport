<div class="row">
    <div class="card">
        <div class="card-body container-fluid ">
            <form method="POST" wire:submit.prevent="store">
                @csrf
                @method('POST')

                @if (session('dejautiliser'))
                    <script>
                        Swal.fire({
                            title: 'Erreur d\'enregistrement!',
                            text: 'Ce rapport existe déjà dans la base !',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        Swal.fire({
                            title: 'Erreur!',
                            text: 'Erreur d\'enregistrement du rapport',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    </script>
                @endif

                <!-- Champs choix de l'activité -->
                <div class="mb-3">
                    <label>Choisissez une activité </label>
                    <select class="form-select @error('id_activite') is-invalid @enderror" id="id_activite"
                        wire:model="id_activite" name="id_activite">
                        <option value=""></option>
                        @foreach ($listeActivite as $item)
                            <option value="{{ $item->id }}">{{ $item->nom }}</option>
                        @endforeach
                    </select>
                    @error('id_activite')
                        <div class="text text-red-500 mt-1 animate-pulse">Le nom de l'activité est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="libelle" class="form-label">libelle du rapport (*) :</label>
                    <input type="text" class="form-control  @error('libelle')is-invalid
           @enderror"
                        id="libelle" name="libelle" wire:model="libelle" required>

                    @error('libelle')
                        <div class="invalid-feedback">Le champ libelle est requis.</div>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="travaux_prevus_journee" class="form-label">Travaux de prevues de la journé (*) :</label>
                    <textarea class="form-control  @error('travaux_prevus_journee') is-invalid
           @enderror"
                        wire:model="travaux_prevus_journee" name="travaux_prevus_journee" id="travaux_prevus_journee" rows="4"
                        required></textarea>
                    @error('travaux_prevus_journee')
                        <div class="invalid-feedback">Le champ travaux prevus est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="travaux_realises" class="form-label">Travaux réalisés de la journée (*) :</label>
                    <textarea class="form-control  @error('travaux_realises') is-invalid
           @enderror" wire:model="travaux_realises"
                        name="travaux_realises" id="travaux_realises" rows="4" required></textarea>
                    @error('travaux_realises')
                        <div class="invalid-feedback">Le champ travaux realisées est requis.</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="heure_demarrage" class="form-label">Heure de démarrage :</label>
                        <input type="time" class="form-control @error('heure_demarrage') is-invalid @enderror"
                            wire:model="heure_demarrage" name="heure_demarrage" id="heure_demarrage" required>
                        <div class="invalid-feedback" id="erreur_heure_demarrage"></div>
                        @error('heure_demarrage')
                            <div class="invalid-feedback">Le champ heure de démarrage est requis.</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="heure_fin" class="form-label">Heure de fin :</label>
                        <input type="time" class="form-control @error('heure_fin') is-invalid @enderror"
                            wire:model="heure_fin" name="heure_fin" id="heure_fin" required>
                        <div class="invalid-feedback" id="erreur_heure_fin"></div>
                        @error('heure_fin')
                            <div class="invalid-feedback">Le champ heure de fin est requis.</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="travaux_restants" class="form-label">Travaux restants à faire (*) :</label>
                    <textarea class="form-control  @error('travaux_restants') is-invalid
           @enderror" wire:model="travaux_restants"
                        name="travaux_restants" id="travaux_restants" rows="4"></textarea>
                    @error('travaux_restants')
                        <div class="invalid-feedback">Le champ travaux restants est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="materiels_utilises" class="form-label">Materiels Utilisés (*) :</label>
                    <textarea class="form-control  @error('materiels_utilises') is-invalid
           @enderror"
                        wire:model="materiels_utilises" name="materiels_utilises" id="materiels_utilises" rows="4" required></textarea>
                    @error('materiels_utilises')
                        <div class="invalid-feedback">Le champ materiels_utilises est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="difficultes_rencontrees" class="form-label">Problèmes/Retards :</label>
                    <textarea class="form-control  @error('difficultes_rencontrees') is-invalid
           @enderror"
                        wire:model="difficultes_rencontrees" name="difficultes_rencontrees" id="difficultes_rencontrees" rows="4"
                        required></textarea>
                    @error('difficultes_rencontrees')
                        <div class="invalid-feedback">Le champ difficultés est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="solutions_apportees" class="form-label">Mesures correctives ou à mettre en oeuvre
                        :</label>
                    <textarea class="form-control @error('solutions_apportees') is-invalid
           @enderror "
                        wire:model="solutions_apportees" name="solutions_apportees" id="solutions_apportees" rows="4" required></textarea>
                    @error('solutions_apportees')
                        <div class="invalid-feedback">Le champ Solutions est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="travaux_prevus_demain" class="form-label">Travaux prevus pour demain (*) :</label>
                    <textarea class="form-control  @error('travaux_prevus_demain') is-invalid
           @enderror"
                        wire:model="travaux_prevus_demain" name="travaux_prevus_demain" id="travaux_prevus_demain" rows="4"></textarea>
                    @error('travaux_prevus_demain')
                        <div class="invalid-feedback">Le champ travaux restants est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="besoins_materiaux" class="form-label">Besoin en matériaux:</label>
                    <textarea class="form-control  @error('besoins_materiaux') is-invalid
           @enderror"
                        wire:model="besoins_materiaux" name="besoins_materiaux" id="besoins_materiaux" rows="4"></textarea>
                    @error('besoins_materiaux')
                        <div class="invalid-feedback">Le champ besoins matériaux est requis.</div>
                    @enderror
                </div>
        </div>

        <div class=" row d-flex justify-content-between mb-3">

            <a href="{{ route('rapports') }}" class=" btn btn-sm btn-danger text-white fs-6">Retourner à la
                liste</a>

            <button type="submit" class="btn main-color text text-bold">Enregistrer</button>

        </div>
        </form>
    </div>
</div>
</div>
</body>

@livewireScripts

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var heureDemarrageInput = document.getElementById('heure_demarrage');
        var heureFinInput = document.getElementById('heure_fin');
        var erreurHeureDemarrage = document.getElementById('erreur_heure_demarrage');
        var erreurHeureFin = document.getElementById('erreur_heure_fin');

        heureDemarrageInput.addEventListener('input', function() {
            validateHeureFin();
        });

        heureFinInput.addEventListener('input', function() {
            validateHeureFin();
        });

        function validateHeureFin() {
            // Vérifier si les champs ont la classe is-invalid
            var isHeureDemarrageInvalid = heureDemarrageInput.classList.contains('is-invalid');
            var isHeureFinInvalid = heureFinInput.classList.contains('is-invalid');

            // Si l'un des champs est invalide, ne pas effectuer la validation
            if (isHeureDemarrageInvalid || isHeureFinInvalid) {
                return;
            }
            var heureDemarrage = heureDemarrageInput.value;
            var heureFin = heureFinInput.value;

            // Convertir les valeurs en objets Date pour comparer
            var dateHeureDemarrage = new Date('1970-01-01T' + heureDemarrage);
            var dateHeureFin = new Date('1970-01-01T' + heureFin);

            // Vérifier si l'heure de fin est supérieure à l'heure de démarrage
            if (dateHeureDemarrage >= dateHeureFin) {
                // Afficher un message d'erreur
                erreurHeureFin.textContent = "L'heure de fin doit être supérieure à l'heure de démarrage.";
            } else {
                // Effacer le message d'erreur si la condition est remplie
                erreurHeureFin.textContent = "";
            }
        }
    });
</script>
