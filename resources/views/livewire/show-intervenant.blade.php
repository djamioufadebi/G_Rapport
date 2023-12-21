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

  <!-- Tableau d'informations des intervenants -->
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <th colspan="2">
              <div class="bg-success text-white p-2">
                Informations de l'intervenant : {{ $intervenants->nom }} {{ $intervenants->prenom }}
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Nom </th>
            <td>
              {{ $intervenants->nom }} {{ $intervenants->prenom }}
              <!-- nom du demandeur -->
            </td>
          </tr>
          <tr>
            <th scope="row">Prénom(s) </th>
            <td>
              {{ $intervenants->prenom }}
              <!-- nom du demandeur -->
            </td>
          </tr>

          <tr>
            <th scope="row">Contact</th>
            <td>
              <p> {{ $intervenants->contact }}</p>
            </td>
          </tr>
          <tr>
            <th scope="row">E-mail</th>
            <td>
              <p>{{ $intervenants->email}}</p>
            </td>
          </tr>
          <tr>
            <th scope="row">Date d'enregistrement</th>
            <td>

              <p class="card-text">Date : {{ $intervenants->created_at->format('Y-m-d') }}</p>
              <p class="card-text">Heure : {{ $intervenants->created_at->format('H:i') }}</p>
            </td>
          </tr>
          <tr>
            <th scope="row">Nom du projet</th>
            <td>
              <!-- nom du projet auquel il a participé -->
            </td>
          </tr>
          <tr>
            <th scope="row">Date de participation au projet</th>
            <td>
              <!-- date de début du projet -->
            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>
