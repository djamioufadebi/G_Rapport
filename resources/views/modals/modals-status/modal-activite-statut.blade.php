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