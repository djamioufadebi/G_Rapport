
   document.addEventListener('DOMContentLoaded', function () {
      var heureDemarrageInput = document.getElementById('heure_demarrage');
      var heureFinInput = document.getElementById('heure_fin');

      heureDemarrageInput.addEventListener('input', function () {
         validateHeureFin();
      });

      heureFinInput.addEventListener('input', function () {
         validateHeureFin();
      });

      function validateHeureFin() {
         var heureDemarrage = heureDemarrageInput.value;
         var heureFin = heureFinInput.value;

         // Convertir les valeurs en objets Date pour comparer
         var dateHeureDemarrage = new Date('1970-01-01T' + heureDemarrage);
         var dateHeureFin = new Date('1970-01-01T' + heureFin);

         // Vérifier si l'heure de fin est supérieure à l'heure de démarrage
         if (dateHeureDemarrage >= dateHeureFin) {
            // Afficher un message d'erreur
            alert("L'heure de fin doit être supérieure à l'heure de démarrage.");
            // Réinitialiser la valeur de l'heure de fin
            heureFinInput.value = '';
         }
      }
   });

