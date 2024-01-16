@foreach($projets as $projet)
<div wire:ignore.self class="modal fade fullscreen-modal" id="confirmProfilModal{{$projet->id }}" tabindex="-1"
  role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Statut du projet </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <br>
        <div class="text-left">
          <label class="font-weight-bold d-block" for="statut">Sélectionnez un statut :</label>
        </div>
        <br>
        <form>
          <div class="form-group">
            <div class="mb-3">
              <label for="statut" class="form-label">Statut :</label>
              <select wire:model="statut" class="form-control">
                <option value="en attente" @if($projet->statut === 'en attente') selected @endif>En attente</option>
                <option value="en cours" @if($projet->statut === 'en cours') selected @endif>En cours</option>
                <option value="terminé" @if($projet->statut === 'terminé') selected @endif>Terminé</option>
                <option value="arrêté" @if($projet->statut === 'arrêté') selected @endif>Arrêté</option>
              </select>
              @error('statut')
              <div class="invalid-feedback">Le champ statut est requis.</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="date_debut" class="form-label">Date Debut :</label>
              <input type="date" class="form-control @error('date_debut') is-invalid @enderror" id="date_debut"
                wire:model="date_debut" name="date_debut" wire:change="handleDateDebutChange" required>
              <div class="error-message invalid-feedback" style="display: none;">Le champ date_debut est requis.</div>
            </div>
            <div class="mb-3">
              <label for="date_fin_prevue" class="form-label">Date Fin :</label>
              <input type="date" class="form-control @error('date_fin_prevue') is-invalid @enderror"
                id="date_fin_prevue" wire:model="date_fin_prevue" name="date_fin_prevue"
                wire:change="handleDateFinPrevueChange" required>
              <div id="date_fin_prevue_error" class="error-message invalid-feedback" style="display: none;">La date de
                fin ne peut pas être antérieure à la date de début.</div>
              @error('date_fin_prevue')
              <div class="error-message invalid-feedback">Le champ date fin est requis.</div>
              @enderror
            </div>
            <div>
              <a href="{{route('projets')}}">
                <button type="button" class="btn btn-danger">Annuler</button>
              </a>
              <button type="submit" wire:click="ValidationStatutProjet('{{$projet->id}}')"
                class="btn btn-primary">Enregistrer</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach

@livewireScripts()
<script src="{{asset('js\js_projet\condition-statut_dates.js')}}"></script>

<script src="{{asset('js\js_projet\date-condition_projet.js')}}"></script>


<script src="{{asset('js\js_projet\checkbox-statut.js')}}"></script>