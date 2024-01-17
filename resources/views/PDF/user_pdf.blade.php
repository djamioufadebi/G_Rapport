<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Liste des utilisateurs</title>
  <!-- Styles Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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

  .table-user tr td {
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
    <table class="table table-striped table-bordered" class=" table table-user" id="dataTable" cellspacing="0">
      <caption>
        <h2> Liste des utilisateurs</h2>
      </caption>
      <br>
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nom</th>
          <th scope="col">Prénom</th>
          <th scope="col">Contact</th>
          <th scope="col">Email</th>
          <th scope="col">Profil</th>
        </tr>
      </thead>
      <tbody id="tablbody">
        @if(count($users))
        @foreach ($users as $user)
        <tr class="tr-off">
          <th>{{ $user->id }}</th>
          <td>{{ $user->nom }}</td>
          <td>{{ $user->prenom }}</td>
          <td>{{ $user->contact }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->profil->nom }}</td>
        </tr>
        @endforeach
        @else
        <tr class="tr-off">
          <td colspan="6" class="div-tot">Aucun utilisateur trouvé</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
  <!-- Intégration du script Bootstrap (facultatif si non déjà présent) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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