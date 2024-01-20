document.addEventListener('DOMContentLoaded', function () {
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
    errorMessages.forEach(function (element) {
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
            dateDebutInput.removeAttribute('min');  // Permettre une date de début antérieure à la date du jour

            dateFinInput.removeAttribute('min');
             dateFinInput.setAttribute('min', addOneDayToCurrentDate());
            break;
        case 'terminé':
            dateDebutInput.setAttribute('max', new Date().toISOString().split('T')[0]);
            dateDebutInput.removeAttribute('min');  // Permettre une date de début antérieure à la date du jour
            dateFinInput.setAttribute('min', dateDebutInput.value);
            dateFinInput.setAttribute('max', new Date().toISOString().split('T')[0]); // Fixer la date de fin à la date du jour
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
