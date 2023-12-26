<link href="{{ asset('css/style-table.css') }}" rel="stylesheet">

<div class="container mt-5">
  <!-- Informations de la société et son logo -->
  <div class="row mb-4">
    <div class="col-md-6">
      <!-- Insérez le logo de la société ici -->
      <img src="{{ asset('images/innov2b.jpg')}}" alt="Logo de la société" class="img-fluid" width="100" height="auto"
        srcset="">
    </div>
    <div class="col-md-6 text-center">
      <!-- Nom de la société -->
      <h3>INNOVATION BULDING BUSINESS </h3>
    </div>
  </div>

  <!-- Tableau d'informations des besoins -->
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <th colspan="2">
              @if ($besoins->statut == 'Validé')
              <div class="bg-success text-white p-2">
                Informations du Besoin : {{ $besoins->libelle }}
              </div>
              @elseif ($besoins->statut == 'en attente')
              <div class="bg-warning text-white p-2">
                Informations du Besoin : {{ $besoins->libelle }}
              </div>
              @elseif ($besoins->statut == 'rejeté')
              <div class="bg-danger text-white p-2">
                Informations du Besoin : {{ $besoins->libelle }}
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
            <td>{{ $besoins->contenu }}</td>
          </tr>
          <tr>
            <th scope="row">Date et Heure de la demande</th>
            <td>
              <p>Date : {{ $besoins->created_at->format('Y-m-d') }}</p>
              <p>Heure : {{ $besoins->created_at->format('H:i:s') }}</p>
            </td>
          </tr>
          <tr>
            <th scope="row">Statut du besoin</th>

            <td>{{ $besoins->statut }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>