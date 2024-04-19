<div class="row">
    <div class="card">
        <div class="card-body container-fluid ">
            <form method="POST" wire:submit="store">
                @csrf
                @method('POST')

                @if (session('dejautiliser'))
                    <script>
                        Swal.fire({
                            title: 'Erreur d\'enregistrement!',
                            text: 'Ce client existe déjà dans la base !',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        Swal.fire({
                            title: 'Erreur!',
                            text: 'Erreur d\'enregistrement du client',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    </script>
                @endif

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du client :</label>
                    <input type="text" class="form-control  @error('nom')is-invalid
           @enderror"
                        name="nom" wire:model="nom" required>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('nom')
                        <div class="invalid-feedback">Le champ nom est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse du Client :</label>
                    <input type="text" class="form-control  @error('adresse')is-invalid
           @enderror"
                        name="adresse" wire:model="adresse" required>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('adresse')
                        <div class="invalid-feedback">Le champ adresse est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email du client :</label>
                    <input type="text" class="form-control  @error('email')is-invalid
           @enderror"
                        name="email" wire:model="email" required>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('email')
                        <div class="invalid-feedback">Le champ email est requis.</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label">Contact du client :</label>
                    <input type="number" class="form-control @error('contact')is-invalid
           @enderror"
                        name="contact" wire:model="contact" required>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('contact')
                        <div class="invalid-feedback">Le champ contact est requis.</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mb-3 ">

                    <a href="{{ route('clients') }}" class="btn btn-sm btn-danger  text-white fs-6">Retourner à la
                        liste</a>

                    <button type="submit" class="btn main-color text text-bold">Enregistrer</button>

                </div>
            </form>
        </div>
    </div>
</div>
