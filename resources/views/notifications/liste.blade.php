@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card ">
                    @livewire('liste-notification')
                </div>
            </div>
        </div>
    </div>
@endsection
