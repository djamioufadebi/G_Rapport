<div class="row">
  <div class="card">
    <div class="card-body container-fluid ">
      <form method="POST" wire:submit.prevent="store">
        @csrf
        @method('POST')

        @if(session('dejautiliser'))
        <script>
        Swal.fire({
          title: 'Enregistrement impossible!',
          text: 'Une activité avec cet nom existe déjà dans la base !',
          icon: 'error',
          confirmButtonText: 'OK'
        })
        </script>
        @endif

        @if(session('date_error2'))
        <script>
        Swal.fire({
          title: 'Erreur de date !',
          text: 'la date de fin ne pas être postérieure à la date de debut !',
          icon: 'error',
          confirmButtonText: 'OK'
        })
        </script>
        @endif

        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-success">
          {{ session('error') }}
        </div>
        @endif

        <div class="mb-3">
          <label for="nom" class="form-label">Nom de l'Activité :</label>
          <input type="text" class="form-control  @error('nom')is-invalid
           @enderror" id="nom" name="nom" wire:model="nom" required>
          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('nom')
          <div class="invalid-feedback">Le champ nom est requis.</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description de l'activité :</label>
          <textarea class="form-control  @error('description')is-invalid
           @enderror" id="description" name="description" wire:model="description" rows="4" required></textarea>
          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('description')
          <div class="invalid-feedback">Le champ description est requis.</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="date_debut" class="form-label">Date Debut :</label>
          <input type="date" class="form-control @error('date_debut') is-invalid @enderror" id="date_debut"
            wire:model="date_debut" name="date_debut" required>
          <!-- Affiche le message d'erreur si le champ est vide -->
          @error('date_debut')
          <div class="invalid-feedback">Le champ date_debut est requis.</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="date_fin" class="form-label">Date Fin :</label>
          <input type="date" class="form-control @error('date_fin') is-invalid @enderror" id="date_fin"
            wire:model="date_fin" name="date_fin" required>
          <div id="date_fin_error" class="invalid-feedback" style="display: none;">La date de fin ne peut pas être
            antérieure à la date de début.</div>
          <!-- Affiche le message d'erreur si le champ est vide -->
          @error('date_fin')
          <div class="invalid-feedback">Le champ date_fin est requis.</div>
          @enderror
        </div>

        <!-- Taux de réalisation avec barre de progression -->
        <div class="mb-3">
          <label for="taux_de_realisation" class="form-label">Taux de réalisation :</label>
          <input type="range" class="form-range @error('taux_de_realisation') is-invalid @enderror"
            id="taux_de_realisation" wire:model="taux_de_realisation" name="taux_de_realisation" min="0" max="100"
            step="0.1" required>
          <output id="taux_value" class="mt-2">{{$taux_de_realisation}}%</output>
          @error('taux_de_realisation')
          <div class="invalid-feedback">Le champ taux_de_realisation est requis.</div>
          @enderror
        </div>


        <!-- Champs choix de projet -->
        <div class="mb-3">
          <label>Le nom du projet</label>
          <select class="form-select @error('id_projet') is-invalid @enderror" id="id_projet" wire:model="id_projet"
            name="id_projet">
            <option value=""></option>
            <!--  La boucle pour afficher la liste des projets -->
            @foreach ($listeProjet as $item )
            <option value="{{$item->id}}">{{$item->libelle}}</option>
            @endforeach
          </select>

          <!-- afiche le message d'erreur si le champs est vide  -->
          @error('id_projet')
          <div class="text text-red-500 mt-1 animate-pulse">Le niveau est requis.</div>
          @enderror
        </div>

        <div class=" row d-flex justify-content-between mb-3">
          <div class="col-md-3">
            <button type="button" class="btn btn-danger">
              <a href="{{route('activites')}}" class=" text-white fs-6"
                style="text-decoration:none;">Annuler</a></button>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary text text-bold">Enregistrer</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

@livewireScripts()
<script>
document.addEventListener("DOMContentLoaded", function() {
  let dateDebut = document.getElementById('date_debut');
  let dateFin = document.getElementById('date_fin');
  let dateFinError = document.getElementById('date_fin_error');

  dateDebut.addEventListener('change', function() {
    dateFin.min = dateDebut.value; // Définit la date minimum pour le champ de date de fin
    if (dateFin.value !== '' && dateFin.value < dateDebut.value) {
      dateFin.value = ''; // Réinitialise la date de fin si elle est antérieure à la date de début
      dateFinError.style.display = 'block'; // Affiche le message d'erreur
    } else {
      dateFinError.style.display = 'none'; // Masque le message d'erreur si les dates sont valides
    }
  });

  dateFin.addEventListener('change', function() {
    if (dateFin.value !== '' && dateFin.value < dateDebut.value) {
      dateFin.value = ''; // Réinitialise la date de fin si elle est antérieure à la date de début
      dateFinError.style.display = 'block'; // Affiche le message d'erreur
    } else {
      dateFinError.style.display = 'none'; // Masque le message d'erreur si les dates sont valides
    }
  });
});

// pour la barre de progession : affichage de sa valeur
document.addEventListener("DOMContentLoaded", function() {
  const tauxDeRealisation = document.getElementById('taux_de_realisation');
  const tauxValue = document.getElementById('taux_value');

  tauxDeRealisation.addEventListener('input', function() {
    // Met à jour la valeur affichée
    tauxValue.innerText = tauxDeRealisation.value + '%';
  });
});
</script>
