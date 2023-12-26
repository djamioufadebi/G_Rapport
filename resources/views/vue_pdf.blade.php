  <style>
/* Styles CSS personnalisés */
body {
  font-family: Arial, sans-serif;
  line-height: 1.6;
}

.container {
  width: 80%;
  margin: 0 auto;
  padding: 20px;
}

h1 {
  text-align: center;
  margin-bottom: 20px;
}

/* Styles pour le tableau */
.table-bordered td,
.table-bordered th {
  border: 1px solid #dee2e6;
}
  </style>

  <div class="container">
    <!-- Photo et nom de la société -->
    <div class="row mb-4">
      <div class="col-2">
        <img src="{{ asset('images/innov2b.jpg')}}" alt="Logo de la société" width="100px">
      </div>
      <div class="col-10 align-self-center">
        <h3>INNOVATION BULDING BUSINESS</h3>
      </div>
    </div>
    <!-- Fin Photo et nom de la société -->

    <h1>Détails du Projet</h1>

    <!-- Tableau stylisé avec Bootstrap -->
    <table class="table table-bordered">
      <tbody>
        <tr>
          <th scope="row">Nom du Projet</th>
          <td>Projet de réelectrification</td>
        </tr>
        <tr>
          <th scope="row">Date de Début</th>
          <td>12-10-2023</td>
        </tr>
        <tr>
          <th scope="row">Date de Fin Prévue</th>
          <td>29-12-2023</td>
        </tr>
        <tr>
          <th scope="row">Nom du Gestionnaire</th>
          <td>GANNOUN ALexis</td>
        </tr>
        <tr>
          <th scope="row">Nom du Client</th>
          <td>LAM'S ENERGETIQUE</td>
        </tr>
        <!-- Ajoutez d'autres détails du projet si nécessaire -->
      </tbody>
    </table>
    <!-- Fin du tableau stylisé avec Bootstrap -->
  </div>