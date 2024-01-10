document.addEventListener("DOMContentLoaded", function() {
  const tauxDeRealisation = document.getElementById('taux_de_realisation');
  const tauxValue = document.getElementById('taux_value');

  tauxDeRealisation.addEventListener('input', function() {
    // Met à jour la valeur affichée
    tauxValue.innerText = tauxDeRealisation.value + '%';
  });
});
