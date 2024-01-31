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

  <!-- Tableau d'informations des clients -->
  <div class="row" id="detailsClient">
    <div class="col-md-12">
      <table class="table" id="tableDetails">
        <thead>
          <tr>
            <th colspan="2">
              <div class="bg-success text-white p-2">
                Informations sur le client : {{ $clients->nom }}
              </div>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">Nom </th>
            <td>
              {{ $clients->nom }}
              <!-- nom du demandeur -->
            </td>
          </tr>
          <tr>
            <th scope="row">Contact</th>
            <td>
              <p> {{ $clients->contact }}</p>
            </td>
          </tr>
          <tr>
            <th scope="row">E-mail</th>
            <td>
              <p>{{ $clients->email}}</p>
            </td>
          </tr>
          <tr>
            <th scope="row">Date d'enregistrement</th>
            <td>
              <p class="card-text">Date : {{ $clients->created_at->format('Y-m-d') }}</p>
              <p class="card-text">Heure : {{ $clients->created_at->format('H:i') }}</p>
            </td>
          </tr>
          <tr>
            <th scope="row">La liste de tous les projets </th>
            <td>
              <!-- affiche la liste des projets en cours pour cet client seul -->
            </td>
          </tr>
          <tr>
            <th scope="row">Les projets en cours </th>
            <td>
              <!-- affiche la liste des projets en cours pour cet client seul -->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class=" row d-flex justify-content-between mb-3">
    <!-- <div class="col-md-2">
      <button type="submit" class="btn btn-secondary text text-bold">
        <a href="{{route('client.pdf')}}" class="text-white fs-6" style="text-decoration:none;">
          PDF</a></button>
    </div> -->
    <div class="col-md-3">
      <button type="button" class="btn btn-primary" onclick="imprimerDetailsClient()">Imprimer</button>
    </div>
  </div>

</div>

@livewireScripts
<script>
function imprimerDetailsClient() {
  // Cloner la section des détails du besoin à imprimer
  var contenuImprimer = document.getElementById('detailsClient').cloneNode(true);

  // Créer une nouvelle fenêtre pour l'impression
  var fenetreImprimer = window.open('', '_blank');

  // Ajouter le contenu cloné dans la nouvelle fenêtre
  fenetreImprimer.document.body.appendChild(contenuImprimer);

  // Lancer la commande d'impression après le chargement de la page
  fenetreImprimer.onload = function() {
    fenetreImprimer.focus(); // Focus sur la fenêtre d'impression
    fenetreImprimer.print(); // Lancer l'impression
  };
}
imprimerDetailsClient();
</script>
