<style>
@media print {

  /* Styles spécifiques pour l'impression */
  body * {
    visibility: hidden;
  }

  #detailsRapport,
  #detailsRapport * {
    visibility: visible;
  }

  #detailsRapport {
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>

<link href="{{ asset('css/style-table.css') }}" rel="stylesheet">

<div class="container mt-5">
  <!-- Informations de la société et son logo -->
  <div class="row mb-4">
    <div class="col-md-6">
      <!-- Insérez le logo de la société ici -->
      <img src="{{ asset('images/innov2b.jpg')}}" alt="Logo de la société" class="img-fluid" width="100" height="auto"
        srcset="">

    </div>
    <div class="col-md-6 text-center">
      <!-- Nom de la société -->
      <h3>INNOVATION BULDING BUSINESS </h3>
    </div>
  </div>

  <!-- Tableau d'informations des rapport -->
  <div class="row" id="detailsRapport">
    <div class="col-md-12">
      <table class="table" id="tableDetails">
        <thead>
          <tr>
            <th colspan="2">
              @if ($rapport->statut == 'Validé')
              <div class="bg-success text-white p-2">
                Informations du rapport : {{ $rapport->libelle }}
              </div>
              @elseif ($rapport->statut == 'en attente')
              <div class="bg-warning text-white p-2">
                Informations du rapport : {{ $rapport->libelle }}
              </div>
              @elseif ($rapport->statut == 'rejeté')
              <div class="bg-danger text-white p-2">
                Informations du rapport : {{ $rapport->libelle }}
              </div>
              @endif
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Nom du demandeur</th>
            <td>
              {{ $userRapport->nom }} {{ $userRapport->prenom }}
            </td>
          </tr>
          <tr>
            <th scope="row">Nom du projet</th>
            <td>
              {{ $rapport->projet->libelle }}
            </td>
          </tr>
          <tr>
            <th scope="row">CONTENU</th>
            <td>{{ $rapport->contenu }}</td>
          </tr>
          <tr>
            <th scope="row">Date et Heure de la demande</th>
            <td>
              <p class="card-text">Date : {{ $rapport->created_at->format('Y-m-d') }}</p>
              <p class="card-text">Heure : {{ $rapport->created_at->format('H:i:s') }}</p>
            </td>
          </tr>
          <tr>
            <th scope="row">STATUT</th>

            <td>{{ $rapport->statut }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class=" row d-flex justify-content-between mb-3">
    <div class="col-md-2">
      <button type="submit" class="btn btn-secondary text text-bold">
        <a href="{{route('rapport.pdf')}}" class="text-white fs-6" style="text-decoration:none;">
          PDF</a></button>
    </div>
    <div class="col-md-3">
      <button type="button" class="btn btn-primary" onclick="imprimerDetailsRapport()">Imprimer</button>
    </div>
  </div>
</div>


@livewireScripts
<script>
function imprimerDetailsRapport() {
  // Cloner la section des détails du rapport à imprimer
  var contenuImprimer = document.getElementById('detailsRapport').cloneNode(true);

  // Créer une nouvelle fenêtre pour l'impression
  var fenetreImprimer = window.open('', '_blank');

  // Ajouter le contenu cloné dans la nouvelle fenêtre
  fenetreImprimer.document.body.appendChild(contenuImprimer);

  // Lancer la commande d'impression après le chargement de la page
  fenetreImprimer.onload = function() {
    fenetreImprimer
  .focus(); // Focus sur la fenêtre d'impression (pour éviter que l'on ne voie pas la page d'accueil)
    fenetreImprimer.print(); // Lancer l'impression
  };
}
imprimerDetailsRapport();
</script>