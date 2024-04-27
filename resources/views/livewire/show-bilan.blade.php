<div class="container mt-5">
    <div class="container mt-8">

        <a href="{{ route('bilans.pdf') }}">
            <button class="btn btn-sm " style="background: #42C2FF;">
                <strong>Bilan Journalier</strong>
            </button>
        </a>
        <hr class="pt-1 bg-secondary">

        <div>
            <form action="{{ route('bilans.activite') }}" method="POST">
                @csrf
                @method('GET')
                <div class="row">
                    <!-- Champs de sélection pour le activite -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="activite"><strong>Activité :</strong></label>
                            <div class="input-group">
                                <select name="id_activite" wire:model="selectedActiviteId2"
                                    class="form-select form-select-md" id="id_activite" required>
                                    <option value=""> </option>
                                    @foreach ($activites as $item)
                                        <option value="{{ $item->id }}">{{ $item->nom }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <!-- Boutons de soumission -->
                    <div class="col-md-3 align-self-end">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm" style="background: #42C2FF;">Bilan Journalier
                                de
                                l'activité</button>
                        </div>
                    </div>
                    <div class="col-md-3 align-self-end">
                        <!-- Un autre bouton ici -->
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>

    <div class="container mt-8">
        <!-- Bilan pour un projet donnée -->
        <div>
            <form action="{{ route('bilans.projets') }}" method="POST">
                @csrf
                @method('GET')
                <div class="row">
                    <!-- Champs de sélection de projet -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="projet"> <strong> Projet :</strong></label>
                            <div class="input-group">
                                <select name="id_projet" wire:model="selectedProjetId"
                                    class="form-select form-select-md" id="id_projet" required>
                                    <option value=""> </option>
                                    @foreach ($projets as $item)
                                        <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <!-- Boutons de soumission -->
                    <div class="col-md-3 align-self-end">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm" style="background: #42C2FF;"> Bilan Journalier
                                du
                                projet</button>
                        </div>
                    </div>
                    <div class="col-md-3 align-self-end">
                        <!-- Un autre bouton ici -->
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>

    <!-- Pour période -->
    <div>
        <form action="{{ route('bilans.periode') }}" method="POST">
            @csrf
            @method('GET')
            <div class="container mt-8">
                <div class="row">

                    <div class="col-md-3">
                        <label for="projet"> <strong>Projet : </strong> </label>
                        <div class="input-group">
                            <select name="id_projet" wire:model="selectedProjetId" class="form-select form-select-md"
                                id="id_projet2" required>
                                <option value=""> </option>
                                @foreach ($projets as $item)
                                    <option value="{{ $item->id }}">{{ $item->libelle }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <!-- <div class="col-md-1">
            <label for="periode"><strong>Période</strong></label>
          </div> -->


                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="projet"> <strong> Période De :</strong></label>
                            <input type="date" id="date_debut" wire:model="selectedDatedebut" name="date_debut"
                                class="form-control form-control-md" required>
                            <div class="error-message invalid-feedback" style="display: none;">Le champ date debut
                                est requis.</div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="projet"><strong>A :</strong></label>
                            <input type="date" id="date_fin" wire:model="selectedDatefin" name="date_fin"
                                class="form-control form-control-md" required>
                            <div id="date_fin_error" class="error-message invalid-feedback" style="display: none;">
                                La date de fin ne
                                peut pas être antérieure à la date de début.</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="projet"><strong>Action</strong></label>
                            <button class="btn btn-sm" style="background: #42C2FF;">
                                Génerer Bilan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <hr>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#id_projet').select2();
        });

        /*  multiple: true, */
    </script>
@endsection
