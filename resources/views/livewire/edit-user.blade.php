<div class="row">
    <div class="card">
        <div class="card-body container ">
            <form method="POST" wire:submit.prevent="update">
                @csrf
                @method('POST')


                @if (session('success'))
                    <script>
                        Swal.fire({
                            title: 'Mise à jour de l\'utilisateur!',
                            text: '{{ session('
                                                                                                                          edition ') }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                    </script>
                @endif

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de l'Utilisateur :</label>
                    <input type="text" class="form-control  @error('nom')is-invalid
           @enderror"
                        name="nom" wire:model="nom" required>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('nom')
                        <div class="invalid-feedback">Le champ nom est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Prenom de l'Utilisateur :</label>
                    <input type="text" class="form-control  @error('prenom')is-invalid
           @enderror"
                        name="prenom" wire:model="prenom" required>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('prenom')
                        <div class="invalid-feedback">Le champ prenom est requis.</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="contact" class="form-label">Contact de l'Utilisateur :</label>
                    <input type="number" class="form-control @error('contact')is-invalid
           @enderror"
                        name="contact" wire:model="contact" required>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('contact')
                        <div class="invalid-feedback">Le champ contact est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email de l'Utilisateur :</label>
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
                    <select class="form-select @error('id_client') is-invalid @enderror" id="id_client"
                        wire:model="id_client" name="id_client">
                        <option value=""></option>
                        <!--  La boucle pour afficher la liste des clients -->
                        @foreach ($listeProfil as $item)
                            <option value="{{ $item->id }}">{{ $item->nom }}</option>
                        @endforeach

                    </select>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('id_client')
                        <div class="invalid-feedback">Le client est requis.</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mb-4">
                    <a href="{{ route('users') }}" class="btn btn-sm btn-danger text-white fs-6">Retourner à la
                        liste</a>
                    <button type="submit" class="btn main-color text text-bold">Mettre à jour</button>
                </div>

            </form>
        </div>
    </div>
</div>
