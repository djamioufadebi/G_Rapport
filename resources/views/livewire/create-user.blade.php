<div class="row">
    <div class="card">
        <div class="card-body container ">
            <form method="POST" wire:submit.prevent="store">
                @csrf
                @method('POST')

                @if (session('dejautiliser'))
                    <script>
                        Swal.fire({
                            title: 'Enregistrement impossible!',
                            text: 'Un utilisateur avec cet email existe déjà dans la base !',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        Swal.fire({
                            title: 'Erreur!',
                            text: 'Erreur d\'enregistrement de l\'utilisateur',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    </script>
                @endif


                <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" class="form-control  @error('nom')is-invalid
           @enderror"
                        name="nom" wire:model="nom" required>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('nom')
                        <div class="invalid-feedback">Le champ nom est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Prenom :</label>
                    <input type="text" class="form-control  @error('prenom')is-invalid
           @enderror"
                        name="prenom" wire:model="prenom" required>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('prenom')
                        <div class="invalid-feedback">Le champ prenom est requis.</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="contact" class="form-label">Contact :</label>
                    <input type="number" class="form-control @error('contact')is-invalid
           @enderror"
                        name="contact" wire:model="contact" required>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('contact')
                        <div class="invalid-feedback">Le champ contact est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control  @error('email')is-invalid
           @enderror"
                        name="email" wire:model="email" required>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('email')
                        <div class="invalid-feedback">Le champ email est requis.</div>
                    @enderror
                </div>

                <!-- Le client -->
                <div class="mb-3">
                    <label>Le profil</label>
                    <select class="form-select @error('id_profil') is-invalid @enderror" id="id_profil"
                        wire:model="id_profil" name="id_profil">
                        <option value=""></option>
                        <!--  La boucle pour afficher la liste des clients -->
                        @foreach ($listeProfil as $item)
                            <option value="{{ $item->id }}">{{ $item->nom }}</option>
                        @endforeach

                    </select>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('id_profil')
                        <div class="invalid-feedback">Le client est requis.</div>
                    @enderror
                </div>

                <div class=" d-flex justify-content-between mb-3">
                    <a href="{{ route('users') }}" class=" btn btn-sm btn-danger text-white fs-6">Retourner à la
                        liste</a>
                    <button type="submit" class="btn main-color text text-bold">Enregistrer</button>
                </div>

            </form>
        </div>
    </div>
</div>
