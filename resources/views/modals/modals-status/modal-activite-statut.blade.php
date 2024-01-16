@foreach($listeActivites as $activite)
<div wire:ignore.self class="modal fade fullscreen-modal" id="confirmProfilModal{{ $activite->id }}" tabindex="-1"
  role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Statut de l'activité </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <br>
            <div class="text-left">
              <label class="font-weight-bold d-block" for="statut">Sélectionnez un statut :</label>
            </div>
            <br>
            <div class="form-group">
              <div class="mb-3">
                <label for="statut" class="form-label">Statut :</label>
                <select wire:model="statut" class="form-control">
                  <option value="en attente" @if($activite->statut === 'en attente') selected @endif>En attente</option>
                  <option value="en cours" @if($activite->statut === 'en cours') selected @endif>En cours</option>
                  <option value="terminé" @if($activite->statut === 'terminé') selected @endif>Terminé</option>
                  <option value="arrêté" @if($activite->statut === 'arrêté') selected @endif>Arrêté</option>
                </select>
                @error('statut')
                <div class="invalid-feedback">Le champ statut est requis.</div>
                @enderror
              </div>
              <br>
              <div class="mb-3">
                <label for="date_debut" class="form-label">Date Debut :</label>
                <input type="date" class="form-control @error('date_debut') is-invalid @enderror" id="date_debut"
                  wire:model="date_debut" name="date_debut" required>
                <div class="error-message invalid-feedback">Le champ de date début est requis.</div>
              </div>

              <div class="mb-3">
                <label for="date_fin" class="form-label">Date Fin :</label>
                <input type="date" class="form-control @error('date_fin') is-invalid @enderror" id="date_fin"
                  wire:model="date_fin" name="date_fin" required>
                <div id="date_fin_error" class="error-message invalid-feedback" style="display: none;">La date de fin ne
                  peut pas être antérieure à la date de début.</div>
                @error('date_fin')
                <div class="error-message invalid-feedback">Le champ de date de fin est requis.</div>
                @enderror
              </div>

              <a href="{{route('activites')}}">
                <button type="button" class="btn btn-danger">Annuler</button>
              </a>
              <button type="submit" wire:click="ValidationStatutActivite('{{$activite->id}}')"
                class="btn btn-primary">Enregistrer</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@livewireScripts
<script src="{{asset('js\js_activite\condition_changement_statut_activite.js')}}"></script>
<script src="{{asset('js\js_activite\condition-statut_dates.js')}}"></script>
<script src="{{asset('js\js_activite\date-condition_activite.js')}}"></script>
<script src="{{asset('js\js_activite\statut_change_activite.js')}}">
< />

public\