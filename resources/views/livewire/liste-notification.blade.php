<div>
    <div class="card-header">
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
                    </div>

                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary" wire:click="read('{{$item->id}}')">
                            Marquer comme lue
                        </button>
                    </div>
                </div>
                <hr>
            @empty
                <p>Aucune notification en attente</p>
            @endforelse
        </div>
      </div>
</div>
