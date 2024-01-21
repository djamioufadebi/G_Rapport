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
          <p>Date : {{ $item->created_at->format('Y-m-d') }}</p>
          <p>Heure : {{ $item->created_at->format('H:i:s') }}</p>
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

    <!-- Lien de pagination -->
    <div class="container my-4">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end">
          {{-- Lien vers la page précédente --}}
          @if($NotReadNotifications->previousPageUrl())
          <li class="page-item">
            <a class="page-link" href="{{ $NotReadNotifications->previousPageUrl() }}" aria-label="Précédente">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          @else
          <li class="page-item disabled">
            <span class="page-link" aria-hidden="true">&laquo;</span>
          </li>
          @endif

          {{-- Affichage des numéros de page --}}
          @for($i = 1; $i <= $NotReadNotifications->lastPage(); $i++)
            <li class="page-item {{ $i == $NotReadNotifications->currentPage() ? 'active' : '' }}">
              <a class="page-link" href="{{ $NotReadNotifications->url($i) }}">{{ $i }}</a>
            </li>
            @endfor

            {{-- Lien vers la page suivante --}}
            @if($NotReadNotifications->nextPageUrl())
            <li class="page-item">
              <a class="page-link" href="{{ $NotReadNotifications->nextPageUrl() }}" aria-label="Suivante">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
            @else
            <li class="page-item disabled">
              <span class="page-link" aria-hidden="true">&raquo;</span>
            </li>
            @endif
        </ul>
      </nav>
    </div>
    <!-- Fin du lien  -->


  </div>
</div>