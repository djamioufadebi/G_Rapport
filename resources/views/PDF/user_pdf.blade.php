<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des utilisateurs</title>
</head>

<body>
  <h1> La Liste des utilisateurs</h1>
  <table class="table">
    <caption>Liste des utilisateurs</caption>
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">NOM</th>
        <th scope="col">Prenom</th>
        <th scope="col">Contact</th>
        <th scope="col">Email</th>
        <th scope="col">Profil</th>
      </tr>
    </thead>
    <tbody>
      @if(count($users))
      @foreach ($users as user)
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
</body>

</html>
