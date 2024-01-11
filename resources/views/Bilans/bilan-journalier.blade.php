<!DOCTYPE html>
<html>

<head>
  <title>Bilan des rapports</title>
  <!-- Intégration de Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Styles personnalisés -->
  <style>
  /* Ajoutez vos styles CSS personnalisés ici */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    /* Supprime les marges par défaut du body */
  }

  .container {
    padding: 5px;
    margin: 0 auto;
    /* Centre le contenu horizontalement */
  }

  .module {
    margin-bottom: 30px;
  }

  .module-title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 15px;
  }

  table {
    width: 100%;
    margin-bottom: 20px;
  }

  /* ... autres styles ... */
  </style>
</head>

<body>
  <div class="container">
    <div class="module">
      <h2 class="module-title">Projets en cours</h2>
      <!-- Tableau pour afficher les détails des projets -->
      <table class="table table-bordered">
        <!-- En-têtes du tableau -->
        <thead class="thead-dark">
          <tr>
            <th scope="col">Libellé</th>
            <th scope="col">Lieu</th>
            <th scope="col">Date début</th>
            <th scope="col">Date fin</th>
          </tr>
        </thead>
        <tbody>
          <!-- Boucle pour afficher les détails des projets -->
          @foreach($projetsEnAttente as $projet)
          <tr>
            <td>{{ $projet->libelle }}</td>
            <td>{{ $projet->lieu }}</td>
            <td>{{ $projet->date_debut }}</td>
            <td>{{ $projet->date_fin_prevue }}</td>
            < </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="module">
      <h2 class="module-title">Prévision</h2>
      <!-- Tableau pour afficher les détails des projets -->
      <table class="table table-bordered">
        <!-- En-têtes du tableau -->
        <thead class="thead-dark">
          <tr>
            <th scope="col">Libellé</th>
            <th scope="col">Lieu</th>
            <th scope="col">Date début</th>
            <th scope="col">Date fin</th>

          </tr>
        </thead>
        <tbody>
          <!-- Boucle pour afficher les détails des projets -->
          @foreach($projetsEnAttente as $projet)
          <tr>
            <td>{{ $projet->libelle }}</td>
            <td>{{ $projet->lieu }}</td>
            <td>{{ $projet->date_debut }}</td>
            <td>{{ $projet->date_fin_prevue }}</td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="module">
      <h2 class="module-title">Activités liées au Projet "{{ $projet->libelle }}"</h2>
      <!-- Tableau pour afficher les détails des activités -->
      <table class="table table-bordered">
        <!-- En-têtes du tableau -->
        <thead class="thead-dark">
          <tr>
            <th scope="col">Nom</th>
            <th scope="col">Description</th>
            <th scope="col">Taux de réalisation</th>
            <th scope="col">Date début</th>
            <th scope="col">Date fin</th>
          </tr>
        </thead>
        <tbody>
          <!-- Boucle pour afficher les détails des activités -->
          @foreach($activitesEnCours as $activite)
          <tr>
            <td>{{ $activite->nom }}</td>
            <td>{{ $activite->Descrption }}</td>
            <td>{{ $activite->taux_de_realisation }}</td>
            <td>{{ $activite->date_debut }}</td>
            <td>{{ $activite->date_fin }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="module">
      <h2 class="module-title">Rapport</h2>
      <!-- Boucle pour afficher les détails des rapports -->
      @foreach($rapportsEnCoursAujourdhui as $rapport)
      <div class="card mb-3">
        <div class="card-header">
          <p></p><strong>{{ $rapport->libelle }}</strong>
        </div>
        <div class="card-body">
          <p>{{ $rapport->contenu }}</p>
          <p><strong>Matériels utilisés:</strong> {{ $rapport->materiels_utilises }}</p>
          <p><strong>Difficultés:</strong> {{ $rapport->difficultes_rencontrees }}</p>
          <p><strong>Solutions:</strong> {{ $rapport->solutions_apportees }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</body>

</html>