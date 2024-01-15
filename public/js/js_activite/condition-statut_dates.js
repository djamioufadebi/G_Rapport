document.addEventListener('DOMContentLoaded', function () {
    var statutSelect = document.getElementById('statut');
    var dateDebutInput = document.getElementById('date_debut');
    var dateFinInput = document.getElementById('date_fin');
    var tauxRealisation = document.getElementById('taux_de_realisation');
    var tauxValue = document.getElementById('taux_value');

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
    dateFinInput.removeAttribute('min');
    dateFinInput.removeAttribute('max');
    tauxRealisation.removeAttribute('min');
    tauxRealisation.removeAttribute('max');

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
            tauxRealisation.setAttribute('min', 0);
            tauxRealisation.setAttribute('max', 0);
            tauxRealisation.value = 0;  // Définir automatiquement le taux à 100%
            tauxValue.innerText = '0%';
            break;
        case 'en cours':
            disablePastDates();
            dateDebutInput.setAttribute('max', new Date().toISOString().split('T')[0]);
            dateDebutInput.setAttribute('min', new Date().toISOString().split('T')[0]);
            dateFinInput.setAttribute('min', new Date().toISOString().split('T')[0]); // Date de début ou égale à la date du jour
            tauxRealisation.setAttribute('min', 0.1);
            tauxRealisation.setAttribute('max', 95);
            break;
        case 'terminé':
            dateDebutInput.setAttribute('max', new Date().toISOString().split('T')[0]);
            dateDebutInput.removeAttribute('min');  // Permettre une date de début antérieure à la date du jour
            dateFinInput.setAttribute('min', dateDebutInput.value);
            dateFinInput.setAttribute('max', new Date().toISOString().split('T')[0]); // Fixer la date de fin à la date du jour
            tauxRealisation.setAttribute('min', 99);
            tauxRealisation.setAttribute('max', 100);
            tauxRealisation.value = 100;  // Définir automatiquement le taux à 100%
            tauxValue.innerText = '100%';
            break;

        case 'arrêté':
            dateDebutInput.setAttribute('max', new Date().toISOString().split('T')[0]);
            dateDebutInput.removeAttribute('min');
            dateFinInput.setAttribute('min', addOneDayToCurrentDate());
            dateFinInput.removeAttribute('max');
            tauxRealisation.setAttribute('min', 20);
            tauxRealisation.setAttribute('max', 90);
            break;
        default:
            // Si le statut n'est pas géré, réinitialiser toutes les contraintes
            disablePastDates();
    }
}

    // Ajouter un gestionnaire d'événements pour le changement de statut
    statutSelect.addEventListener('change', handleStatutChange);

    // Ajouter un gestionnaire d'événements pour le changement de taux de réalisation
    tauxRealisation.addEventListener('input', function () {
        // Met à jour la valeur affichée
        tauxValue.innerText = tauxRealisation.value + '%';
    });

    // Appeler la fonction une fois au chargement de la page pour gérer le statut initial
    handleStatutChange();
});
