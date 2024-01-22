<div wire:ignore class="modal fade" id="NommerGestionnaireModal{{ $projet->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Contenu du modal -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nommez un gestionnaire pour le projet : {{ $projet->libelle }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <br>
          <div class="text-center">
            <label class="font-weight-bold d-block">Sélectionnez un gestionnaire :</label>
          </div>
          <br>
          <select class="form-control" name="id_gestionnaire" wire:model="selectedGestionnaireId">
            @foreach ($managers as $item)
            <option value="{{$item->id}}">{{$item->nom}} {{$item->prenom}}</option>
            @endforeach
          </select>
          <br>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <a href="{{route('projets')}}">
          <button type="button" class="btn btn-danger">Annuler</button>
        </a>

        <!-- le wire:click est à mettre -->
        <button wire:click="NommerGestionnaire({{$projet->id}})" class="btn btn-primary">Enregistrer</button>
      </div>
    </div>
  </div>
</div>

@livewireScripts()
<script>
document.addEventListener('livewire:load', function() {
  Livewire.on('showConfirmationModal', () => {
    $('#NommerGestionnaireModal').modal('show');
  });
  Livewire.on('hideConfirmationModal', () => {
    $('#NommerGestionnaireModal').modal('hide');
  });
});
</script>
