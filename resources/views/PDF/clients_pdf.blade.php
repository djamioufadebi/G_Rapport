<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des clients</title>

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

  .table-client tr td {
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

    <table class="table table-striped table-bordered" class=" table table-client" id="dataTable" cellspacing="0">
      <caption>
        <h2 class=" text-center "> Liste des clients</h2>
      </caption>
      <br>
      <thead class=" thead-dark">
        <tr class=" text-capitalize text-center ">
          <th scope="col" align="left">Identifiant </th>
          <th scope="col" align="left">Nom</th>
          <th scope="col" align="left">Adresse </th>
          <th scope="col" align="left">Contact </th>
          <th scope="col" align="left">Email </th>
        </tr>
      </thead>
      <tbody id="tablbody">
        @if(count($clients))
        @foreach ($clients as $client)
        <tr class="tr-off">
          <th scope="row">{{ $client->id }}</th>
          <td>{{ $client->nom }}</td>
          <td>{{ $client->adresse }}</td>
          <td>{{ $client->contact }}</td>
          <td>{{ $client->email }}</td>
        </tr>
        @endforeach
        @else
        <tr class="tr-off">
          <td colspan="5" class="div-tot">Aucun client</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
  <!-- Intégration du script Bootstrap (facultatif si non déjà présent) -->
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
  <!-- Pour Bootstrap 5, utilisez le script suivant -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



  <footer>
    <h6>
      Généré par {{ Auth::user()->nom }} {{ Auth::user()->prenom }}, ce
      {{ $dateToday->format('d-m-Y') }}
    </h6>
  </footer>
</body>



</html>