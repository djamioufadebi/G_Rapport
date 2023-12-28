<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Tableau de liste des profils</title>
  <!-- Styles Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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

  .table-profil tr td {
    padding: 3px;
    font-size: 15px;

  }
  </style>

</head>

<body>
  <div class="container">
    <table class="table table-striped table-bordered" class=" table table-profil" id="dataTable" cellspacing="0">
      <caption>
        <h2 class=" text-center "> Liste des profils</h2>
      </caption>
      <br>
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
        </tr>
      </thead>
      <tbody id="tablbody">
        @if(count($profils))
        @foreach ($profils as $profil)
        <tr class="tr-off">
          <th scope="row">{{ $profil->id }}</th>
          <td>{{ $profil->nom }}</td>
        </tr>
        @endforeach
        @else
        <tr class="tr-off">
          <td colspan="2" class="div-tot">Aucun profil</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>

  <!-- Scripts Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
