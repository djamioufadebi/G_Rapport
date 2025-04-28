<div class="row">
    <div class="card">
        <div class="card-body container-fluid">
            <form method="POST" wire:submit.prevent="store">
                @csrf
                @method('POST')

                @if (session('dejautiliser'))
                    <script>
                        Swal.fire({
                            title: 'Erreur d\'enregistrement!',
                            text: 'Ce besoin existe déjà dans la base !',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        Swal.fire({
                            title: 'Erreur!',
                            text: 'Erreur d\'enregistrement du besoin',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    </script>
                @endif

                <div class="mb-3">
                    <label for="libelle" class="form-label">Libellé (*) :</label>
                    <input type="text" class="form-control @error('libelle') is-invalid @enderror" name="libelle"
                        wire:model="libelle" id="libelle" required>
                    <!-- Affiche le message d'erreur si le champ est vide -->
                    @error('libelle')
                        <div class="invalid-feedback">Le champ libellé est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contenu" class="form-label">Contenu (*) :</label>
                    <textarea class="form-control @error('contenu') is-invalid @enderror" wire:model="contenu" name="contenu" id="contenu"
                        rows="4" required></textarea>
                    <!-- Affiche le message d'erreur si le champ est vide -->
                    @error('contenu')
                        <div class="invalid-feedback">Le champ contenu est requis.</div>
                    @enderror
                </div>

                <!-- Champs choix de l'Activité -->
                <!-- Le client -->
                <div class="mb-3">
                    <label>Activité (*)</label>
                    <select class="form-select @error('id_activite') is-invalid @enderror" id="id_activite"
                        wire:model="id_activite" name="id_activite">
                        @foreach ($listeActivite as $item)
                            <option value="{{ $item->id }}">{{ $item->nom }}</option>
                        @endforeach
                    </select>

                    <!-- Affiche le message d'erreur si le champ est vide -->
                    @error('id_activite')
                        <div class="invalid-feedback">L'activité est requise.</div>
                    @enderror
                </div>
        </div>

        <div class=" d-flex justify-content-between mb-3">

            <a href="{{ route('besoins') }}" class=" btn btn-sm btn-danger  text-white fs-6">Retourner à la liste</a>

            <button type="submit" class="btn main-color font-weight-bold">Enregistrer</button>

        </div>

        </form>
    </div>
</div>
</div>
