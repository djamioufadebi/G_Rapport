@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="card">
            <div class="card-header text-white" style="background: #42C2FF;"> <strong>{{ __('Bilans') }}</strong></div>

            <div class="card-body">
                <div>
                    @livewire('show-bilan')
                </div>
            </div>

        </div>
    </div>
@endsection
