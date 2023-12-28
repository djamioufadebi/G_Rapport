<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des projets</title>
</head>

<body>
  <div class="container">
    <table class="table table-striped table-bordered ">
      <caption>
        <h2> Liste des projets</h2>
      </caption>
      <br>
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Libelle</th>
          <th scope="col">Statut</th>
          <th scope="col">Date de debut</th>
          <th scope="col">Date de fin </th>
          <th scope="col">Client</th>
        </tr>
      </thead>
      <tbody>
        @if(count($projets))
        @foreach ($projets as $projet)
        <tr>
          <th scope="row">{{ $projet->id }}</th>
          <td>{{ $projet->libelle }}</td>
          <td>{{ $projet->statut }}</td>
          <td>{{ $projet->date_debut }}</td>
          <td>{{ $projet->date_fin_prevue }}</td>
          <td>{{ $projet->client->nom }}</td>
        </tr>
        @endforeach
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
