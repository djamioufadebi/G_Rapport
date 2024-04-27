<div>
    <div class="card-header main-color">
        {{ __('Notifications') }}
        @if ($NotReadNotifications->count() > 0)
            <button type="button" class="btn btn-success" wire:click="readAll()">
                Tout marquer comme lue
            </button>
        @endif
    </div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div>
            @forelse ($NotReadNotifications as $item)
                <div class="row col-md-12">
                    <div class="col-md-10">
                        <h5>{{ $item->titre }}</h5>
                        <p>{{ $item->message }}</p>
                        <p>Date : {{ $item->created_at->format('Y-m-d') }}</p>
                        <p>Heure : {{ $item->created_at->format('H:i:s') }}</p>
                    </div>

                    <div class="col-md-2">
                        <button type="button" class="btn main-color" wire:click="read('{{ $item->id }}')">
                            Marquer comme lue
                        </button>
                    </div>
                </div>
                <hr>
            @empty
                <p>Aucune notification non lue</p>
            @endforelse
        </div>

        <!-- Lien de pagination -->
        <div class="container my-4">
            {{ $NotReadNotifications->links() }}
        </div>
        <!-- Fin du lien  -->


    </div>
</div>
