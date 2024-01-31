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

  <!-- Tableau d'informations des activites -->
  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <th colspan="2">
              @if ($activites->statut == 'en attente')
              <div class="border-info text-info p-2">
                INFORMATIONS SUR L'ACTIVICTE : {{ $activites->nom }}
              </div>
              @elseif ($activites->statut == 'en cours')
              <div class="bg-success text-white p-2">
                INFORMATIONS SUR L'ACTIVICTE : {{ $activites->nom }}
              </div>
              @elseif ($activites->statut == 'terminé')
              <div class="bg-warning text-white p-2">
                INFORMATIONS SUR L'ACTIVICTE : {{ $activites->nom }}
              </div>
              @elseif ($activites->statut == 'arrêté')
              <div class="bg-danger text-white p-2">
                INFORMATIONS SUR L'ACTIVICTE : {{ $activites->nom }}
              </div>
              @endif
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="col-md-3">NOM DU PROJET</th>
            <td class="col-md-9">
              {{ $projets->libelle }}
            </td>
          </tr>
          <tr>
            <th scope="row" class="col-md-3">DESCRIPTION</th>
            <td class="col-md-9">{{ $activites->description }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-md-3">DATE DEBUT ACTIVITE</th>
            <td class="col-md-9">
              <p>Date : {{ $activites->date_debut}}</p>

            </td>
          </tr>
          <tr>
            <th scope="row" class="col-md-3">DATE DE FIN ACTIVITE</th>
            <td>
              <p>Date : {{ $activites->date_fin }}</p>

            </td>
          </tr>
          <tr>
            <th scope="row" class="col-md-3">STATUT</th>

            <td>{{ $activites->statut }}</td>
          </tr>
          <tr>
            <th scope="row" class="col-md-3">TAUX DE REALISATION</th>

            <td>{{ $activites->taux_de_realisation}}</td>
          </tr>
          <tr>
            <th scope="row" class="col-md-3">NOM DU PROJET</th>

            <td>{{ $activites->projet->libelle}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class=" row d-flex justify-content-between mb-3">
    <!-- <div class="col-md-2">
      <button type="submit" class="btn btn-secondary text text-bold">
        <a href="#" class="text-white fs-6" style="text-decoration:none;">
          PDF</a></button>
    </div> -->
    <div class="col-md-3">
      <button type="button" class="btn btn-primary" onclick="imprimerDetailsClient()">Imprimer</button>
    </div>
  </div>

</div>
