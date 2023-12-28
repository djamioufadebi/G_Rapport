<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des besoins</title>

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

  .table-besoin tr td {
    padding: 3px;
    font-size: 15px;

  }
  </style>

</head>

<body>
  <div class="container">
    <table class="table table-striped table-bordered" class=" table table-client" id="dataTable" cellspacing="0">
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
  <!-- Intégration du script Bootstrap (facultatif si non déjà présent) -->
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
  <!-- Pour Bootstrap 5, utilisez le script suivant -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
