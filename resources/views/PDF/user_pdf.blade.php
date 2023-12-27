<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des utilisateurs</title>
</head>

<body>
  <div class="container">
    <h1 class="mt-4 mb-3 text-center">Liste des utilisateurs</h1>
    <table class="table table-striped table-bordered ">
      <caption>Liste des utilisateurs</caption>
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
      <tbody>
        @if(count($users))
        @foreach ($users as $user)
        <tr>
          <th scope="row">{{ $user->id }}</th>
          <td>{{ $user->nom }}</td>
          <td>{{ $user->prenom }}</td>
          <td>{{ $user->contact }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->profil->nom }}</td>
        </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
  <!-- Intégration du script Bootstrap (facultatif si non déjà présent) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Pour Bootstrap 5, utilisez le script suivant -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>