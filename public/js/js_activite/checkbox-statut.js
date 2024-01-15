var toggleCheckbox = document.getElementById('toggleCheckbox');
var statutSelect = document.getElementById('statut');
// Ajouter un écouteur d'événements à la case à cocher
toggleCheckbox.addEventListener('change', function() {
  // Si la case à cocher est cochée, rendre les champs d'entrée visibles, sinon les cacher
  statutSelect.style.display = toggleCheckbox.checked ? 'block' : 'none';
});
