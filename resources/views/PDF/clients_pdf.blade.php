<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des clients</title>

  <!-- Styles -->
  <style type="text/css">
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
</body>



</html>