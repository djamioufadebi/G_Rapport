<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Génération de Bilan</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
  }

  .container {
    background-color: #fff;
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  h2 {
    text-align: center;
    margin-bottom: 30px;
  }

  label {
    font-weight: bold;
  }

  input[type="date"],
  select,
  input[type="text"] {
    width: 100%;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 15px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  table th,
  table td {
    border: 1px solid #ccc;
    padding: 8px;
  }

  .table-responsive {
    overflow-x: auto;
  }

  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    color: #fff;
    padding: 8px 20px;
    border-radius: 5px;
  }

  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
  }
  </style>

</head>

<body>

  <div class="container mt-5">
    <h2>Génération de Bilan</h2>
    <form action="#" method="POST">
      @csrf
      <div class="row">
        <div class="col-md-6">
          <label for="date_debut">Date de début :</label>
          <input type="date" id="date_debut" name="date_debut" class="form-control form-control-sm" required>
        </div>
        <div class="col-md-6">
          <label for="date_fin">Date de fin :</label>
          <input type="date" id="date_fin" name="date_fin" class="form-control form-control-sm" required>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-md-6">
          <label for="projet">Projet :</label>
          <select id="projet" name="projet" class="form-control form-control-sm" required>
            <option value="">Sélectionner un projet</option>
            <!-- Boucle pour les options -->
            @foreach ($projets as $projet)
            <option value="{{ $projet->id }}">{{ $projet->libelle }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-6">
          <label for="activite">Activité :</label>
          <select id="activite" name="activite" class="form-control form-control-sm" required>
            <option value="">Sélectionner une activité</option>
            <!-- Boucle pour les options -->
            @foreach ($activites as $activite)
            <option value="{{ $activite->id }}">{{ $activite->nom }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <hr>

      <div class="table-responsive mt-3">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Description</th>
              <th>Temps passé</th>
              <th>Difficultés rencontrées</th>
              <th>Solutions apportées</th>
              <th>Matériels utilisés</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="text" name="description[]" class="form-control"></td>
              <td><input type="text" name="temps_passe[]" class="form-control"></td>
              <td><input type="text" name="difficultes[]" class="form-control"></td>
              <td><input type="text" name="solutions[]" class="form-control"></td>
              <td><input type="text" name="materiels[]" class="form-control"></td>
            </tr>
            <!-- Ajouter d'autres lignes si nécessaire -->
          </tbody>
        </table>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Générer Rapport</button>
      </div>
    </form>
  </div>

  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
