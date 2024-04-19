<div class="row">
    <div class="card">
        <div class="card-body container-fluid ">
            <form method="POST" wire:submit.prevent="store">
                @csrf
                @method('POST')

                @if (session('dejautiliser'))
                    <script>
                        Swal.fire({
                            title: 'Erreur d\'enregistrement!',
                            text: 'Ce role existe déjà !',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    </script>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3">
                    <label foRolesRrolesr="nom" class="form-label">Nom du Role :</label>
                    <input type="text" class="form-control  @error('nom')is-invalid
           @enderror"
                        name="nom" wire:model="nom" required>
                    <!-- afiche le message d'erreur si le champs est vide  -->
                    @error('nom')
                        <div class="invalid-feedback">Le champ nom est requis.</div>
                    @enderror

                </div>

                <div class="d-flex justify-content-between mb-3">
                    <a href="{{ route('roles') }}" class=" btn btn-sm btn-danger text-white fs-6">Retourner à la
                        liste</a>

                    <button type="submit" class="btn main-color text text-bold">Enregistrer</button>
                </div>

            </form>
        </div>
    </div>
</div>
