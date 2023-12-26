<div wire:ignore.self class="modal fade" id="userProfileAssignmentModal" tabindex="-1" role="dialog"
  aria-labelledby="userProfileAssignmentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userProfileAssignmentModalLabel">Attribuer un profil à l'utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form wire:submit.prevent="saveProfile">

          <!-- sous forme de selection -->
          <div class="form-group">
            <label for="selectedProfile">Sélectionnez le profil :</label>
            <select wire:model="selectedProfile" class="form-control" id="selectedProfile">
              <option value="">Sélectionnez un profil</option>
              <option value="profile1">Profile 1</option>
              <option value="profile2">Profile 2</option>
              <!-- Ajoutez d'autres options pour les profils -->
            </select>
          </div>

          <!-- sous forme de checkbox -->
          <h3>Assigner des profils aux utilisateurs :</h3>
          <label for="user1">Utilisateur 1</label>
          <input type="checkbox" name="user_profiles[]" value="profile1" id="user1"> Administrateur
          <br>
          <br>
          <input type="checkbox" name="user_profiles[]" value="profile2" id="user2"> manager
          <br>
          <br>
          <input type="checkbox" name="user_profiles[]" value="profile2" id="user2"> Gestionnaire de projet
          <br>
          <br>
          <input type="checkbox" name="user_profiles[]" value="profile2" id="user2"> Chef Chantier
          <br>
          <br>
          <input type="checkbox" name="user_profiles[]" value="profile2" id="user2"> Employé

          <!-- Ajoutez d'autres cases à cocher pour vos utilisateurs -->

          <a href="{{route('profils')}}">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
          </a>
          <button wire:click="confirmProfil('{{$profil->id}}')" class="btn btn-danger">OUI</button>
        </form>
        <div class="modal-footer">
          <a href="{{route('profils')}}">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
          </a>
          <!-- Code du bouton supprimer du modal -->
          <button wire:click="confirmProfil('{{$profil->id}}')" class="btn btn-danger">OUI</button>
        </div>
      </div>
    </div>
  </div>
</div>