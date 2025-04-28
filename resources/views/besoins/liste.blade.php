@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card ">
                    <div class="card-header main-color">{{ __('Listes des Besoins') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div>
                            @livewire('liste-besoin')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
