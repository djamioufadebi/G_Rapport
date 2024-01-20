<style>
@media print {
  table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 20px;
    /* Marge après le tableau lors de l'impression */
  }

  th,
  td {
    border: 1px solid #ddd;
    /* Bordures des cellules */
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
    /* Couleur de fond pour les en-têtes */
  }

  /* Autres styles spécifiques pour l'impression si nécessaire */
}
</style>

<link href="{{ asset('css/style-table.css') }}" rel="stylesheet">

<div class="container mt-5">
  <!-- Informations de la société et son logo -->
  <div id="detailsRapport">
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
    <div class="row">
      <div class="col-md-12">
        <table class="table" id="tableDetails">
          <thead>
            <tr>
              <th colspan="2">
                @if ($rapport->statut == 'Validé')
                <div class="bg-success text-white p-2">
                  INFORMATIONS DU RAPPORT : {{ $rapport->libelle }}
                </div>
                @elseif ($rapport->statut == 'en attente')
                <div class="bg-warning text-white p-2">
                  INFORMATIONS DU RAPPORT : {{ $rapport->libelle }}
                </div>
                @elseif ($rapport->statut == 'rejeté')
                <div class="bg-danger text-white p-2">
                  INFORMATIONS DU RAPPORT : {{ $rapport->libelle }}
                </div>
                @endif
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Date et Heure de la demande</th>
              <td>
                <p class="card-text">Date : {{ $rapport->created_at->format('Y-m-d') }}</p>
                <p class="card-text">Heure : {{ $rapport->created_at->format('H:i:s') }}</p>
              </td>
            </tr>
            <tr>
              <th scope="row">Nom du réalisateur</th>
              <td>
                {{ $userRapport->nom }} {{ $userRapport->prenom }}
              </td>
            </tr>
            <tr>
              <th scope="row">NOM DU PROJET</th>
              <td>
                {{ $projet->libelle }}
              </td>
            </tr>
            <tr>
              <th scope="row">NOM DE L'ACTIVITE</th>
              <td>
                {{ $activites->nom }}
              </td>
            </tr>
            <tr>
              <th scope="row">CONTENU</th>
              <td>{{ $rapport->contenu }}</td>
            </tr>
            <tr>
              <th scope="row">DIFFICULTES RENCONTREES</th>
              <td>{{ $rapport->difficultes_rencontrees }}</td>
            </tr>
            <tr>
              <th scope="row">SOLUTIONS APPORTEES</th>
              <td>{{ $rapport->solutions_apportees }}</td>
            </tr>

            <tr>
              <th scope="row">STATUT</th>

              <td>{{ $rapport->statut }}</td>
            </tr>
            <tr>
              <th scope="row">TAUX DE L'ACTIVITE</th>

              <td>{{ $rapport->activite->taux_de_realisation }}</td>
            </tr>
          </tbody>
        </table>
      </div>
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
    fenet
reImprimer.print(); // Lancer l'impression
  };
}
imprimerDetailsRapport();
</script>