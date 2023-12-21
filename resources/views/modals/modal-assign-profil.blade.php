<div wire:ignore.self class="modal fade fullscreen-modal" id="confirmProfilModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="saveProfile">



        </form>
      </div>
    </div>
  </div>
</div>

@livewireScripts
<!-- le script javascript  -->
<script>
document.addEventListener('livewire:load', function() {
  Livewire.on('showConfirmationModal', () => {
    $('#confirmProfilModal').modal('show');
  });
  Livewire.on('hideConfirmationModal', () => {
    $('#confirmProfilModal').modal('hide');
  });
});
</script>
