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

  <!-- Tableau d'informations des rapport -->
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <th colspan="2">
              @if ($rapport->statut == 'Validé')
              <div class="bg-success text-white p-2">
                Informations du Besoin : {{ $rapport->libelle }}
              </div>
              @elseif ($rapport->statut == 'en attente')
              <div class="bg-warning text-white p-2">
                Informations du Besoin : {{ $rapport->libelle }}
              </div>
              @elseif ($rapport->statut == 'rejeté')
              <div class="bg-danger text-white p-2">
                Informations du Besoin : {{ $rapport->libelle }}
              </div>
              @endif
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Nom du demandeur</th>
            <td>
              <!-- nom du demandeur -->
            </td>
          </tr>
          <tr>
            <th scope="row">Nom du projet</th>
            <td>
              <!-- nom du demandeur -->
            </td>
          </tr>
          <tr>
            <th scope="row">CONTENU</th>
            <td>{{ $rapport->contenu }}</td>
          </tr>
          <tr>
            <th scope="row">Date et Heure de la demande</th>
            <td>
              <p class="card-text">Date : {{ $rapport->created_at->format('Y-m-d') }}</p>
              <p class="card-text">Heure : {{ $rapport->created_at->format('H:i:s') }}</p>
            </td>
          </tr>
          <tr>
            <th scope="row">STATUT</th>

            <td>{{ $rapport->statut }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
