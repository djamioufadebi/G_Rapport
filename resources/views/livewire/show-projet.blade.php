<link href="{{ asset('css/style-table.css') }}" rel="stylesheet">
<div class="container mt-5">
  <!-- Informations de la société et son logo -->
  <div id="contenuAImprimer">


    <div class="row mb-4">
      <div class="col-md-6">
        <!-- Insérez le logo de la société ici -->
        <img src="{{ asset('images/innov2b.jpg')}}" alt="Logo de la société" class="img-fluid" width="100" height="auto"
          srcset="">
      </div>
      <div class="col-md-6 text-center">
        <!-- libelle de la société -->
        <h3>INNOVATION BULDING BUSINESS </h3>
      </div>
    </div>

    <!-- Tableau d'informations des projets -->
    <div class="row">
      <div class="col-md-12">
        <table class="table" id="detailsProjet">
          <thead>
            <tr>
              <th colspan="2">
                @if ($projets->statut == 'en cours')
                <div class="bg-success text-white p-2">
                  Informations sur le projet : {{ $projets->libelle }}
                </div>
                @elseif ($projets->statut == 'terminé')
                <div class="bg-warning text-white p-2">
                  Informations sur le projet : {{ $projets->libelle }}
                </div>
                @elseif ($projets->statut == 'arrêté')
                <div class="bg-danger text-white p-2">
                  Informations sur le projet : {{ $projets->libelle }}
                </div>
                @endif
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">DESCRIPTION</th>
              <td>{{ $projets->description }}</td>
            </tr>
            <tr>
              <th scope="row">Date de début</th>
              <td>
                <p>Date : {{ $projets->date_debut}}</p>

              </td>
            </tr>
            <tr>
              <th scope="row">Date de fin</th>
              <td>
                <p>Date : {{ $projets->date_fin_prevue }}</p>
              </td>
            </tr>
            <tr>
              <th scope="row">Créateur du projet</th>
              <td>
                {{ $userProjet->nom }} {{ $userProjet->prenom }}
              </td>
            </tr>
            <tr>
              <th scope="row">Nom du Gestionnaire</th>
              <td>
                {{ $nomGestionnaire->nom }} {{ $nomGestionnaire->prenom }}
              </td>
            </tr>
            <tr>
              <th scope="row"> Client :</th>
              <td>
                <p>Nom : {{ $projets->client->nom }}</p>
                <p>Contact : {{ $projets->client->contact }}</p>
              </td>
            </tr>
            <tr>
              <th scope="row">STATUT</th>
              <td>{{ $projets->statut }}</td>
            </tr>
            <tr>
              <th scope="row"> Toutes les activités du Projet :</th>
              <td>
                <p>
                  @foreach ($listeActivite as $activite)
                  <li>{{ $activite->nom}}</li>
                  @endforeach
                </p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class=" row d-flex justify-content-between mb-3">
    <div class="col-md-2">
      <button type="submit" class="btn btn-secondary text text-bold">
        <a href="{{route('projet.pdf')}}" class="text-white fs-6" style="text-decoration:none;">
          PDF</a></button>
    </div>
    <div class="col-md-3">
      <button type="button" class="btn btn-primary" onclick="imprimerDetailsProjet()">Imprimer</button>
    </div>
  </div>
</div>

@livewireScripts
<script>
function imprimerDetailsProjet() {
  // Récupérer le contenu à imprimer
  var contenuImprimer = document.getElementById('contenuAImprimer').cloneNode(true);

  // Ouvrir un nouvel onglet
  var nouvelOnglet = window.open('', '_blank');

  // Injecter le contenu à imprimer dans le nouvel onglet
  nouvelOnglet.document.body.appendChild(contenuImprimer);

  // Lancer la commande d'impression
  nouvelOnglet.onload = function() {
    nouve
    lOnglet.focus(); // Focus sur le nouvel onglet
    nouvelOnglet.print(); // Lancer l'impression
  };
}
</script>
