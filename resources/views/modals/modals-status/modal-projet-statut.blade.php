@foreach($projets as $projet)
<div wire:ignore.self class="modal fade fullscreen-modal" id="confirmProfilModal{{$projet->id }}" tabindex="-1"
  role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Statut du projet </h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <a href="{{route('projets')}}">
            <span aria-hidden="true">&times;</span>
          </a>
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
              <select id="statut" wire:model="statut" class="form-control">
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
                wire:model="date_debut" name="date_debut" required>
              <div class="error-message invalid-feedback" style="display: none;">Le champ date_debut est requis.</div>
              <!-- Affiche le message d'erreur si le champ est vide -->
              @error('date_debut')
              <div class="error-message invalid-feedback">Le champ date debut est requis.</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="date_fin_prevue" class="form-label">Date Fin :</label>
              <input type="date" class="form-control @error('date_fin_prevue') is-invalid @enderror"
                id="date_fin_prevue" wire:model="date_fin_prevue" name="date_fin_prevue" required>
              <div id="date_fin_prevue_error" class="error-message invalid-feedback" style="display: none;">La date de
                fin
                ne peut pas être antérieure à la date de début.</div>
              <!-- Affiche le message d'erreur si le champ est vide -->
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
<script>
document.addEventListener("DOMContentLoaded", function() {
  let dateDebut = document.getElementById('date_debut');
  let dateFin = document.getElementById('date_fin_prevue');
  let dateFinError = document.getElementById('date_fin_prevue_error');

  dateDebut.addEventListener('change', function() {
    dateFin.min = dateDebut.value; // Définit la date minimum pour le champ de date de fin
    if (dateFin.value !== '' && dateFin.value < dateDebut.value) {
      dateFin.value = ''; // Réinitialise la date de fin si elle est antérieure à la date de début
      dateFinError.style.display = 'block'; // Affiche le message d'erreur
    } else {
      dateFinError.style.display = 'none'; // Masque le message d'erreur si les dates sont valides
    }
  });

  dateFin.addEventListener('change', function() {
    if (dateFin.value !== '' && dateFin.value < dateDebut.value) {
      dateFin.value = ''; // Réinitialise la date de fin si elle est antérieure à la date de début
      dateFinError.style.display = 'block'; // Affiche le message d'erreur
    } else {
      dateFinError.style.display = 'none'; // Masque le message d'erreur si les dates sont valides
    }
  });
});

document.addEventListener('DOMContentLoaded', function() {
  var statutSelect = document.getElementById('statut');
  var dateDebutInput = document.getElementById('date_debut');
  var dateFinInput = document.getElementById('date_fin_prevue');


  // Fonction pour désactiver les dates dans le passé
  function disablePastDates() {
    var today = new Date().toISOString().split('T')[0];
    dateDebutInput.setAttribute('min', today);
  }

  // Fonction pour ajouter +1 jour à la date actuelle
  function addOneDayToCurrentDate() {
    var today = new Date();
    today.setDate(today.getDate() + 1);
    return today.toISOString().split('T')[0];
  }

  // Fonction pour gérer les conditions en fonction du statut sélectionné
  function handleStatutChange() {
    var selectedStatut = statutSelect.value;

    // Réinitialiser les contraintes des champs de date et de taux de réalisation
    dateDebutInput.removeAttribute('max');
    dateDebutInput.removeAttribute('min');
    dateFinInput.removeAttribute('min');
    dateFinInput.removeAttribute('max');

    // Réinitialiser les messages d'erreur
    var errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(function(element) {
      element.style.display = 'none';
    });

    // Appliquer les contraintes en fonction du statut sélectionné
    switch (selectedStatut) {
      case 'en attente':
        disablePastDates();
        dateDebutInput.setAttribute('min', addOneDayToCurrentDate());
        break;
      case 'en cours':
        disablePastDates();
        dateDebutInput.setAttribute('max', new Date().toISOString().split('T')[0]);
        dateDebutInput.removeAttribute('min'); // Permettre une date de début antérieure à la date du jour

        dateFinInput.removeAttribute('min');
        dateFinInput.setAttribute('min', addOneDayToCurrentDate());
        break;
      case 'terminé':
        dateDebutInput.setAttribute('max', new Date().toISOString().split('T')[0]);
        dateDebutInput.removeAttribute('min'); // Permettre une date de début antérieure à la date du jour
        dateFinInput.setAttribute('min', dateDebutInput.value);
        dateFinInput.setAttribute('max', new Date().toISOString().split('T')[
          0]); // Fixer la date de fin à la date du jour
        break;

      case 'arrêté':
        dateDebutInput.setAttribute('max', new Date().toISOString().split('T')[0]);
        dateDebutInput.removeAttribute('min');
        dateFinInput.setAttribute('min', addOneDayToCurrentDate());
        dateFinInput.removeAttribute('max');
        break;
      default:
        // Si le statut n'est pas géré, réinitialiser toutes les contraintes
        disablePastDates();
    }
  }

  // Ajouter un gestionnaire d'événements pour le changement de statut
  statutSelect.addEventListener('change', handleStatutChange);

  // Appeler la fonction une fois au chargement de la page pour gérer le statut initial
  handleStatutChange();
});
</script>
<script>
// Fonction pour vérifier si le statut est valide
function ValidationStatutProjet(id) {
  var statut = document.getElementById('statut').value;
  var dateDebut = document.getElementById('date_debut').value;
  var dateFin = document.getElementById('date_fin_prevue').value;
  var dateFinError = document.getElementById('date_fin_prevue_error');
  var dateDebutError = document.getElementById('date_debut_error');

  // Vérifier si les champs de date sont remplis
  if (dateDebut === '' || dateFin === '') {
    dateDebutError.style.display = 'block';
    dateFinError.style.display = 'block';
    return false;
  } else {
    dateDebutError.style.display = 'none';
    dateFinError.style.display = 'none';
  }
  // Vérifier si la date de fin est antérieure à la date de début
  if (dateFin < dateDebut) {
    dateFinError.style.display = 'block';
    return false;
  } else {
    dateFinError.style.display = 'none';
  }
</script>