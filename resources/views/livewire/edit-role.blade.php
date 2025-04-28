<div class="row">
    <div class="card">
        <div class="card-body container-fluid ">
            <form method="POST" wire:submit.prevent="update">
                @csrf
                @method('POST')

                @if (Session::get('error'))
                    <div class="p-5">
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du role :</label>
                    <input type="text" class="form-control  @error('nom')is-invalid
           @enderror"
                        name="nom" wire:model="nom" required>
                    @error('nom')
                        <div class="invalid-feedback">Le champ nom est requis.</div>
                    @enderror

                </div>

                <div class="d-flex justify-content-between mb-4">
                    <a href="{{ route('roles') }}" class="btn btn-sm btn-danger text-white fs-6">Retourner à la
                        liste</a>
                    <button type="submit" class="btn main-color text text-bold">Mettre à jour</button>
                </div>

            </form>
        </div>
    </div>
</div>
