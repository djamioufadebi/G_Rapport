<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <style>
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
    min-width: 50px;
    max-width: 200px;
    padding: 5px;
    border: 2px solid #77B5FE;
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
    margin-bottom: 2px;
  }

  .company-logo {
    max-height: 70px;
    margin-right: 50px;
  }

  .company-name {
    font-size: 24px;
    font-weight: bold;
    margin-top: 10px;
  }

  .separator {
    font-size: 18px;
    font-weight: bold;
    margin-top: 10px;
    color: #333;
    /* Couleur grise, vous pouvez ajuster selon vos préférences */
  }

  .document-title {
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    text-decoration: underline;
    color: #333;
    text-align: right;
    /* Couleur grise, vous pouvez ajuster selon vos préférences */
  }

  hr {
    border: 1px solid black;
    /* Couleur bleue pour le hr, ajustez selon vos préférences */
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
        <span class="module-title text-center">INNOVATION BULDING BUSINESS SAS</span>
      </div>
      <hr>
      <h1 class="document-title text-center">Bilan du {{ $dateDebut }} au {{ $dateFin }}</h1>
    </div>

    <div class="module">
      <h2 class="module-title">Rapports du projet trouvés</h2>
      @if (count($rapportsCreesAujourdhui) > 0)
      @foreach($rapportsCreesAujourdhui as $rapport)
      <table class="table table-bordered">
        <thead>
          <tr class="text-center">
            <th> <strong> RAPPORT N° : </strong> <b>{{ $rapport->id}}</b></th>
            <th> <strong> Libellé : </strong> <i>{{ $rapport->libelle }} </i></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="report-detail">
              <strong>Chef travaux :</strong> <br>
              <p>{{ $rapport->user->nom }} {{ $rapport->user->prenom }} </p>
            </td>
            <td class="report-detail">
              <strong>DATE & HEURES :</strong><br>
              <p>{{ $rapport->created_at->format('d-m-Y')}}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>PROJET N° : {{ $rapport->activite->projet->id}}</strong> <br>
              <strong>NOM DU PROJET :</strong>
              <p>{{ $rapport->activite->projet->libelle }}</p>
            </td>
            <td class="report-detail">
              <strong>LOCALISATION DES TRAVAUX EN COURS :</strong><br>
              <p>{{ $rapport->activite->lieu }}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>ACTIVITE :</strong> <br>
              <p>{{ $rapport->activite->nom }}</p>
            </td>
            <td class="report-detail">
              <strong>STATUT :</strong> <br>
              <p>{{ $rapport->statut }}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail" colspan="2">
              <strong class="text-center">TRAVAUX PREVUS DE LA JOURNEE :</strong><br>
              <p>{{ $rapport->travaux_prevus_journee }}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>TRAVAUX REALISES DE LA JOURNEE :</strong><br>
              <p>{{ $rapport->travaux_realises }}</p>
            </td>
            <td class="report-detail">
              <strong>HEURES DE TRAVAIL:</strong><br>
              <p><strong>Heure de démarrage :</strong> {{ $rapport->heure_demarrage }}<br>
                <strong>Heure de fin :</strong> {{ $rapport->heure_fin }}
              </p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>TAUX DE REALISATION :</strong>
            </td>
            <td>
              <p>{{ $rapport->activite->taux_de_realisation }} %</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>MATERIELS :</strong>
            </td>
            <td>
              <p>{{ $rapport->materiels_utilises }}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail">
              <strong>PROBLEMES/RETARDS :</strong><br>
              <p>{{ $rapport->difficultes_rencontrees }}</p>
            </td>
            <td class="report-detail">
              <strong>MESURES CORRECTIVES OU A METTRE EN OEUVRE :</strong><br>
              <p>{{ $rapport->solutions_apportees }}</p>
            </td>
          </tr>

          <tr>
            <td class="report-detail">
              <strong>TRAVAUX RESTANTS A FAIRE :</strong><br>
              <p>{{ $rapport->travaux_restants }}</p>
            </td>
            <td class="report-detail">
              <strong>BESOINS EN MATERIAUX :</strong><br>
              <p>{{ $rapport->besoins_materiaux }}</p>
            </td>
          </tr>
          <tr>
            <td class="report-detail" colspan="2">
              <strong class="text-center">TRAVAUX PREVUS POUR DEMAIN :</strong> <br>
              <p>{{ $rapport->travaux_prevus_demain }}</p>
            </td>
          </tr>
        </tbody>
      </table>
      @endforeach
      @else
      <p>Aucun rapport de ce projet n'est trouvé pour cette période.</p>
      @endif
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