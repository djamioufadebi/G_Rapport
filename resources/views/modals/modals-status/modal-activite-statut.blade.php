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
              <label class="font-weight-bold d-block " for="statut">Sélectionnez un statut :</label>
            </div>
            <br>
            <div class="form-group">
              <div>
                <input type="radio" id="statutEnAttente{{$activite->id}}" wire:model="statut" value="en attente"
                  name="statut" @if($activite->statut === 'en attente') checked @endif>
                <label for="statutEnAttente{{$activite->id}}">En attente</label>
              </div>

              <div>
                <input type="radio" id="statutEnCours{{$activite->id}}" wire:model="statut" value="en cours"
                  name="statut" @if($activite->statut === 'en cours') checked @endif>
                <label for="statutEnCours{{$activite->id}}">En cours</label>
              </div>
              <div>
                <input type="radio" id="statutTerminer{{$activite->id}}" wire:model="statut" value="terminé"
                  name="statut" @if($activite->statut === 'terminé') checked @endif >
                <label for="statutTerminer{{$activite->id}}">Terminé</label>
              </div>
              <div>
                <input type="radio" id="statutArrêter{{$activite->id}}" wire:model="statut" value="arrêté" name="statut"
                  @if($activite->statut === 'arrêté') checked @endif>
                <label for="statutArrêter{{$activite->id}}">Arrêté</label>
              </div>
              <br>
              <div class="mb-3">
                <label for="date_debut" class="form-label">Date Debut :</label>
                <input type="date" class="form-control @error('date_debut') is-invalid @enderror" id="date_debut"
                  wire:model="date_debut" name="date_debut" required wire:change="dateDebutChange">
                <div class="error-message invalid-feedback">Le champ date_debut est requis.</div>
              </div>

              <div class="mb-3">
                <label for="date_fin" class="form-label">Date Fin :</label>
                <input type="date" class="form-control @error('date_fin') is-invalid @enderror" id="date_fin"
                  wire:model="date_fin" name="date_fin" required wire:change="dateFinChange">
                <div id="date_fin_error" class="error-message invalid-feedback">La date de
                  fin
                  ne peut pas être antérieure à la date de début.</div>
                <!-- Affiche le message d'erreur si le champ est vide -->
                @error('date_fin')
                <div class="error-message invalid-feedback">Le champ date fin est requis.</div>
                @enderror
              </div>

              <a href="{{route('activites')}}">
                <button type="button" class="btn btn-danger">Annuler</button>
              </a>
              <button type="submit" wire:click="ValidationStatutActivite('{{$activite->id}}')"
                class="btn btn-primary">Enregistrer</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>

@livewireScripts

@endforeach