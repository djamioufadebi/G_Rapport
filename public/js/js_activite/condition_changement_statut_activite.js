 const statutInput = document.querySelector('input[name="statut"]');
    const dateDebutInput = document.getElementById('date_debut');
    const dateFinInput = document.getElementById('date_fin');
    const dateFinError = document.getElementById('date_fin_error');

    statutInput.addEventListener('change', function () {
        updateDates();
    });

    dateDebutInput.addEventListener('change', function () {
        validateDateFin();
    });

    function updateDates() {
        const statut = statutInput.value;

        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 1);

        if (statut === 'en attente') {
            dateDebutInput.min = tomorrow.toISOString().split('T')[0];
        } else if (statut === 'en cours') {
            dateDebutInput.max = today.toISOString().split('T')[0];
        } else if (statut === 'terminé') {
            dateFinInput.value = today.toISOString().split('T')[0];
            dateFinInput.disabled = true;
        } else if (statut === 'arrêté') {
            dateDebutInput.max = today.toISOString().split('T')[0];
            dateFinInput.min = today.toISOString().split('T')[0];
            dateFinInput.disabled = false;
        }

        validateDateFin();
    }

    function validateDateFin() {
        const dateDebut = new Date(dateDebutInput.value);
        const dateFin = new Date(dateFinInput.value);

        if (dateFin < dateDebut) {
            dateFinError.style.display = 'block';
        } else {
            dateFinError.style.display = 'none';
        }
    }

    // Initialiser les dates au chargement de la page
    document.addEventListener('DOMContentLoaded', function () {
        updateDates();
    });
