<div wire:ignore.self class="modal fade fullscreen-modal" id="confirmProfilModal{{ $besoin->id }}" tabindex="-1"
  role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Statut du besoin : {{ $besoin->libelle }} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <br>
            <div class="text-center">
              <label class="font-weight-bold d-block " for="statut">Selectionnez le statut :</label>
            </div>
            <br>
            <br>
            <br>
            <select wire:model="statut" class="form-control" name="statut" id="statut">
              <!-- boucle pour afficher les statut -->
              <option value="en attente">En attente</option>
              <option value="Validé">Validé</option>
              <option value="rejeté">Rejeté</option>
            </select>
            <br>
            <br>
          </div>
          <a href="{{route('besoins')}}">
            <button type="button" class="btn btn-danger">Annuler</button>
          </a>
          <button type="submit" wire:click="confirmSaveBesoin('{{$besoin->id}}')"
            class="btn btn-primary">Enregistrer</button>

        </form>
      </div>
    </div>
  </div>
</div>

@livewireScripts