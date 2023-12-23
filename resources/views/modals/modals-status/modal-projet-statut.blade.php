@foreach($projets as $projet)
<div wire:ignore.self class="modal fade fullscreen-modal" id="confirmProfilModal{{ $projet->id }}" tabindex="-1"
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
        <div class="form-group">
          <div>
            <input type="radio" id="statutEnCours{{$projet->id}}" wire:model="statut" value="en cours" name="statut"
              @if($projet->statut === 'en cours') checked @endif>
            <label for="statutEnCours{{$projet->id}}">En cours</label>
          </div>
          <div>
            <input type="radio" id="statutTerminer{{$projet->id}}" wire:model="statut" value="terminé" name="statut"
              @if($projet->statut === 'terminé') checked @endif>
            <label for="statutTerminer{{$projet->id}}">Terminé</label>
          </div>
          <div>
            <input type="radio" id="statutArreter{{$projet->id}}" wire:model="statut" value="arrêté" name="statut"
              @if($projet->statut === 'arrêté') checked @endif>
            <label for="statutArreter{{$projet->id}}">Arrêté</label>
          </div>
          <br>
        </div>
        <br>
      </div>
      <div>
        <a href="{{route('projets')}}">
          <button type="button" class="btn btn-danger">Annuler</button>
        </a>
        <button type="submit" wire:click="ValidationStatutProjet('{{$projet->id}}')"
          class="btn btn-primary">Enregistrer</button>
      </div>

    </div>
  </div>
</div>
</div>

@endforeach
