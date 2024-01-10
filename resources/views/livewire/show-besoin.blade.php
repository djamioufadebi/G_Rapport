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
  <!-- Ajout de l'id pour l'impression -->
  <div class="row" id="detailsBesoin">
    <div class="col-md-12">
      <table class="table" id="tableDetails">
        <thead>
          <tr>
            <th colspan="2">
              @if ($besoins->statut == 'Validé')
              <div class="bg-success text-white p-2">
                INFORMATIONS DU BESOIN : {{ $besoins->libelle }}
              </div>
              @elseif ($besoins->statut == 'en attente')
              <div class="bg-warning text-white p-2">
                INFORMATIONS DU BESOIN : {{ $besoins->libelle }}
              </div>
              @elseif ($besoins->statut == 'rejeté')
              <div class="bg-danger text-white p-2">
                INFORMATIONS DU BESOIN : {{ $besoins->libelle }}
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
              {{ $userBesoin->nom }} {{ $userBesoin->prenom }}
            </td>
          </tr>
          <tr>
            <th scope="row">NOM DU PROJET</th>
            <td>
              {{ $besoins->activite->nom }}
            </td>
          </tr>
          <tr>
            <th scope="row">NOM DE L'ACTIVITE</th>
            <td>
              {{ $besoins->activite->nom }}
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
            <th scope="row">STATUT</th>

            <td>{{ $besoins->statut }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class=" row d-flex justify-content-between mb-3">
    <div class="col-md-2">
      <button type="submit" class="btn btn-secondary text text-bold">
        <a href="{{route('besoin.pdf')}}" class="text-white fs-6" style="text-decoration:none;">
          PDF</a></button>
    </div>
    <div class="col-md-3">
      <button type="button" class="btn btn-primary" onclick="imprimerDetailsBesoin()">Imprimer</button>
    </div>
  </div>
  <!-- Bouton pour imprimer les détails du besoin -->
</div>

@livewireScripts
<script>
function imprimerDetailsBesoin() {
  // Cloner la section des détails du besoin à imprimer
  var contenuImprimer = document.getElementById('detailsBesoin').cloneNode(true);

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
imprimerDetailsBesoin();
</script>