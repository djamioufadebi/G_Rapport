<link href="{{ asset('css/style-table.css') }}" rel="stylesheet">

<div class="container mt-5">
  <!-- Informations de la société et son logo -->
  <div class="row mb-4">
    <div class="col-md-6">
      <!-- Insérez le logo de la société ici -->
      <img src="images/innov2b.jpg" alt="Logo de la société" class="img-fluid" width="100" height="auto" srcset="">

    </div>
    <div class="col-md-6 text-center">
      <!-- Nom de la société -->
      <h3>INNOVATION BULDING BUSINESS </h3>
    </div>
  </div>

  <!-- Tableau d'informations des roles -->
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <th colspan="2">
              <div class="bg-success text-white p-2">
                Informations du Profil : {{ $roles->nom }}
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Nom </th>
            <td>
              {{ $roles->nom }}
              <!-- nom du demandeur -->
            </td>
          </tr>


          <tr>
            <th scope="row">Date de création</th>
            <td>
              <p class="card-text">Date : {{ $roles->created_at->format('Y-m-d') }}</p>
              <p class="card-text">Heure : {{ $roles->created_at->format('H:i') }}</p>
            </td>
          </tr>
          <tr>
            <th scope="row">Liste des profils ayant cet role</th>
            <td>

              <li></li>
              <li></li>
              <li></li>
              <li></li>

            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
