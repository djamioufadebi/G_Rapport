document.addEventListener("DOMContentLoaded", function() {
  let dateDebut = document.getElementById('date_debut');
  let dateFin = document.getElementById('date_fin');
  let dateFinError = document.getElementById('date_fin_error');

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
