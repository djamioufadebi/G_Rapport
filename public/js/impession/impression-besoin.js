
function imprimerDetailsBesoin() {
  // Cloner la section des détails du besoin à imprimer
  var contenuImprimer = document.getElementById('detailsBesoin').cloneNode(true);

  // Créer une nouvelle fenêtre pour l'impression
  var fenetreImprimer = window.open('', '_blank');

  // Ajouter le contenu cloné dans la nouvelle fenêtre
  fenetreImprimer.document.body.appendChild(contenuImprimer);

  // Lancer la commande d'impression après le chargement de la page
  fenetreImprimer.onload = function() {
    fenetreImprimer.focus(); // Focus sur la fenêtre d'impression
    fenetreImprimer.print(); // Lancer l'impression
  };
}
//imprimerDetailsBesoin();
