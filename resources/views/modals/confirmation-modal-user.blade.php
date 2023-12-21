<!-- La Modal -->
<div wire:ignore.self class="modal fade" id="confirmationModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <!-- Contenu du modal -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation de suppression</h5>
        <a href="{{route('users')}}">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </a>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer cet utilisateur ?
      </div>
      <div class="modal-footer">
        <a href="{{route('users')}}">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
        </a>
        <!-- Code du bouton supprimer du modal -->
        <button wire:click="confirmDelete('{{$user->id}}')" class="btn btn-danger">OUI</button>
      </div>
    </div>
  </div>
</div>

@livewireScripts
<!-- le script javascript  -->
<script>
document.addEventListener('livewire:load', function() {
  Livewire.on('showConfirmationModal', () => {
    $('#confirmationModal').modal('show');
  });
  Livewire.on('hideConfirmationModal', () => {
    $('#confirmationModal').modal('hide');
  });
});
</script>
