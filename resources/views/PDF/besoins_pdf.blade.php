<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des besoins</title>

  <!-- Styles -->
  <style type="text/css">
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

  footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #f8f9fa;
    /* couleur de fond, ajustez selon vos préférences */
    text-align: right;
    padding: 5px;
  }

  body {
    font-family: arial;
    letter-spacing: 0.5px;
  }

  .mobile-report-categ-panel {
    padding: 10px;
    background: #77B5FE;
  }

  table {
    width: 98%;
    border: 1px solid #ccc;
    border-collapse: collapse;
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


  .div-tot {
    padding: 20px;
    text-align: center;
  }

  .table-besoin tr td {
    padding: 3px;
    font-size: 15px;
  }
  </style>

</head>

<body>
  <div class="container">
    <!-- En-tête de la société et du document -->
    <div class="company-header">
      <div>
        <img src="{{ public_path('images/innov2b.jpg') }}" alt="Logo de la société" class="company-logo">
        <span class="company-name">INNOVATION BULDING BUSINESS</span>
      </div>
      <hr>
    </div>
    <!-- Fin de l'en-tête -->
    <table class="table table-striped table-bordered" class=" table table-besoin" id="dataTable" cellspacing="0">
      <caption>
        <h2> Liste des besoins</h2>
      </caption>
      <br>
      <thead class="thead-dark">
        <tr>
          <th scope="col" text-align="left">ID</th>
          <th scope="col" text-align="left">Libelle</th>
          <th scope="col" text-align="left">Date du besoin</th>
          <th scope="col" text-align="left">Contenu</th>
          <th scope="col" text-align="right">Statut</th>
        </tr>
      </thead>
      <tbody id="tablbody">
        @if(count($besoins))
        @foreach ($besoins as $besoin)
        <tr class="tr-off">
          <th scope="row">{{ $besoin->id }}</th>
          <td>{{ $besoin->libelle }}</td>
          <td>{{ $besoin->created_at }}</td>
          <td>{{ $besoin->contenu }}</td>
          <td>{{ $besoin->statut }}</td>
        </tr>
        @endforeach
        @else
        <tr class="tr-off">
          <td colspan="4" class="div-tot">Aucun besoin enregisté</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <footer>
    <h6>
      Généré par {{ Auth::user()->nom }} {{ Auth::user()->prenom }}, ce
      {{ $dateToday->format('d-m-Y') }}
    </h6>
  </footer>
</body>

</html>
