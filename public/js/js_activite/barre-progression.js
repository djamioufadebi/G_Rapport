document.addEventListener("DOMContentLoaded", function() {
  const tauxDeRealisation = document.getElementById('taux_de_realisation');
  const tauxValue = document.getElementById('taux_value');
  // Définir la valeur par défaut à 0
  tauxDeRealisation.value = 0;
  tauxValue.innerText = '0%';
  tauxDeRealisation.addEventListener('input', function() {
    // Met à jour la valeur affichée
    tauxValue.innerText = tauxDeRealisation.value + '%';

  });
});





