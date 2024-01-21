<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bilan du jour</title>
  <!-- Intégration de Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Styles personnalisés -->
  <style>
  /* Ajoutez vos styles CSS personnalisés ici */
  body {
    font-family: arial, sans-serif;
    letter-spacing: 0.5px;
    margin: 5px;
    padding: 5px;
  }

  table {
    width: 98%;
    border: 1px solid #ccc;
    border-collapse: collapse;
  }

  td th {
    text-align: right;
  }

  .taux_nombre {
    text-align: center;
  }

  table tbody tr td {
    padding: 5px;
    border: 1px solid #77B5FE;
  }

  table thead th {
    background: #ccc;
    font-size: 15px;
    padding: 5px;
    border: 1px solid #77B5FE;
  }

  .container-fluid {
    padding: 10px;
  }

  .module {
    margin-bottom: 10px;
  }

  .module-title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 15px;
    text-align: left;
  }

  h2 {
    text-align: center;
    text-decoration: underline;
  }

  h3 {
    font-size: 5px;
    font-weight: italic;
    margin-bottom: 5px;
    /* text-decoration: underline; */
  }

  .company-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
  }

  .company-logo {
    max-height: 70px;
    margin-right: 50px;
  }

  .company-name {
    font-size: 24px;
    font-weight: bold;
    text-color: #000;

    margin-top: 10px;
  }

  .document-title {
    font-size: 24px;
    font-weight: bold;
    text-align: right;
    text-decoration: underline;
    text-color: #000;
  }

  .report-detail {
    margin-bottom: 10px;
    border-bottom: 5px solid #ccc;
    padding-bottom: 10px;
  }

  .report-detail strong {
    display: block;
    margin-bottom: 5px;
  }

  footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #f8f9fa;
    /* couleur de fond, ajustez selon vos préférences */
    text-align: right;
    padding: 5px;
  }
  </style>
</head>

<body>
  <div class="container-fluid">

    <!-- En-tête de la société et du document -->
    <div class="company-header">
      <div>
        <img src="{{ public_path('images/innov2b.jpg') }}" alt="Logo de la société" class="company-logo">
        <span class="company-name">INNOVATION BULDING BUSINESS</span>
      </div>
      <hr>
      <h1 class="document-title text-center">Bilan du {{ $dateToday->format('d-m-Y')}}</h1>
    </div>
    <!-- Fin de l'en-tête -->

    <!-- module Projets en cours -->
    <div class="module">
      <div class="row">
        <div class="col-md-6">
          <h2 class="module-title">Projets en cours</h2>
          <br>
          <!-- Tableau pour afficher les détails des projets en cours -->
          @if (count($projetsEnCoursAujourdhui) > 0)
          <div class="table-responsive">
            <table class="table table-bordered">
              <!-- En-têtes du tableau -->
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Libellé</th>
                  <th scope="col">Lieu</th>
                  <th scope="col">Description</th>
                  <th scope="col">Nom Gestionnaire</th>
                  <th scope="col">Date début</th>
                  <th scope="col">Date fin</th>
                  <th scope="col">Statut</th>
                </tr>
              </thead>
              <tbody>
                @foreach($projetsEnCoursAujourdhui as $projet)
                <tr>
                  <td>{{ $projet->libelle }}</td>
                  <td>{{ $projet->lieu }}</td>
                  <td>{{ $projet->description }}</td>
                  <td>{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</td>
                  <td>{{ $projet->date_debut }}</td>
                  <td>{{ $projet->date_fin_prevue }}</td>
                  <td>{{ $projet->statut }}</td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
          @else
          <p>Aucune projet en cours pour le moment.</p>
          @endif
        </div>
      </div>
    </div>
    <!-- Fin module Projets en cours -->

    <!-- Module pour activités en cours du jour -->
    <div class="module">
      <h2 class="module-title">Activités en cours</h2>
      <!-- Tableau pour afficher les détails des activités -->
      @if (count($activitesEnCours) > 0)
      <div class="table-responsive">
        <table class="table table-bordered">
          <!-- En-têtes du tableau -->
          <thead class="thead-dark">
            <tr>
              <th scope="col">Nom</th>
              <th scope="col">Description</th>
              <th scope="col">Projet</th>
              <th scope="col">Date début</th>
              <th scope="col">Date fin</th>
              <th scope="col">Taux de réalisation</th>
            </tr>
          </thead>
          <tbody>
            @foreach($activitesEnCours as $activite)
            <tr>
              <td>{{ $activite->nom }}</td>
              <td>{{ $activite->description }}</td>
              <td>{{ $activite->projet->libelle }}</td>
              <td>{{ $activite->date_debut }}</td>
              <td>{{ $activite->date_fin }}</td>
              <td class="taux_nombre ">{{ $activite->taux_de_realisation }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @else
      <p>Aucune activité en cours pour le moment.</p>
      @endif
    </div>
    <!-- Fin module -->

    <!-- module -->
    <div class="module">
      <h2 class="module-title"> </h2>
      <div class="row">
        <div class="col-md-6">
          <h3 class="module-title">Besoins du jour</h3>
          <!-- Tableau pour afficher les détails des projets en cours -->
          @if (count($besoinsEnCoursAujourdhui) > 0)
          <div class="table-responsive">
            <table class="table table-bordered">
              <!-- En-têtes du tableau -->
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Libellé besoin</th>
                  <th scope="col">Nom du demandeur</th>
                  <th scope="col">Activité</th>
                  <th scope="col">Nom du Projet</th>
                  <th scope="col">Contenu</th>
                  <th scope="col">Date création</th>
                  <th scope="col">Statut</th>
                </tr>
              </thead>
              <tbody>
                @foreach($besoinsEnCoursAujourdhui as $besoin)
                <tr>
                  <td>{{ $besoin->libelle }}</td>
                  <td>{{ $besoin->user->nom }} {{ $besoin->user->prenom }}</td>
                  <td>{{ $besoin->activite->nom }}</td>
                  <td>{{ $besoin->activite->projet->libelle }}</td>
                  <td>{{ $besoin->contenu }}</td>
                  <td>{{ $besoin->created_at }}</td>
                  <td>{{ $besoin->statut }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @else
          <p>Aucun besoin n'a été fait pour le moment.</p>
          @endif
        </div>
      </div>
    </div>
    <!-- fin module -->


    <!-- autre module -->
    <!-- module Les Rapports du jour -->
    <div class="module">
      <h3 class="module-title">Rapports du jour</h3>

      @if (count($rapportsCreesAujourdhui) > 0)
      @foreach($rapportsCreesAujourdhui as $rapport)
      <table class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th colspan="2">Libellé : <i>{{ $rapport->libelle }}</i></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="report-detail">
              <strong>Date de réalisation :</strong>
            </td>
            <td>
              <p>{{ $rapport->created_at }}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>Nom du réalisateur :</strong>
            </td>
            <td>
              <p>{{ $rapport->user->nom }}</p>
              <p>{{ $rapport->user->prenom }}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>Nom du Projet :</strong>
            </td>
            <td>
              <p>{{ $rapport->activite->projet->libelle }}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>Nom de l'activité :</strong>
            </td>
            <td>
              <p>{{ $rapport->activite->nom }}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>Taux de réalisation de l'activité :</strong>
            </td>
            <td>
              <p>{{ $rapport->activite->taux_de_realisation }}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>Statut du rapport :</strong>
            </td>
            <td>
              <p>{{ $rapport->statut }}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>Contenu :</strong>
            </td>
            <td>
              <p>{{ $rapport->contenu }}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>Matériels utilisés :</strong>
            </td>
            <td>
              <p>{{ $rapport->materiels_utilises }}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>Difficultés rencontrées :</strong>
            </td>
            <td>
              <p>{{ $rapport->difficultes_rencontrees }}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>Solutions apportées :</strong>
            </td>
            <td>
              <p>{{ $rapport->solutions_apportees }}</p>
            </td>
          </tr>
        </tbody>
      </table>
      @endforeach
      @else
      <p>Aucun rapport n'a été fait aujourd'hui.</p>
      @endif
    </div>
    <!-- fin module Les Rapports du jour -->
    <!-- fin module -->
    <hr>

    <h2 text-align="center">Prévision </h2>
    <!-- module Projets en cours -->

    <!-- Autre module -->
    <div class="module">
      <h4 class="module-title">Activités</h4>
      <div class="row">
        <div class="col-md-6">
          <h3 class="module-title">Activité en attentes</h3>
          <!-- Tableau pour afficher les détails des projets en cours -->
          @if (count($activitesEnAttentes) > 0)
          <div class="table-responsive">
            <table class="table table-bordered">
              <!-- En-têtes du tableau -->
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Nom de l'activité</th>
                  <th scope="col">Nom du projet </th>
                  <th scope="col">Date de début</th>
                  <th scope="col">Date de fin</th>
                  <th scope="col">Statut</th>
                  <th scope="col">Taux de réalisation</th>
                </tr>
              </thead>
              <tbody>
                @foreach($activitesEnAttentes as $activite)
                <tr>
                  <td>{{ $activite->nom }}</td>
                  <td>{{ $activite->projet->libelle }}</td>
                  <td>{{ $activite->date_debut }}</td>
                  <td>{{ $activite->date_fin }}</td>
                  <td>{{ $activite->statut }}</td>
                  <td class="taux_nombre ">{{ $activite->taux_de_realisation }}</td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
          @else
          <p>Aucune actvité en attente pour le moment.</p>
          @endif
        </div>
      </div>
    </div>

    <footer>
      <h6>
        Généré par {{ Auth::user()->nom }} {{ Auth::user()->prenom }}, ce
        {{ $dateToday->format('d-m-Y') }}
      </h6>
    </footer>
  </div>
</body>


</html>