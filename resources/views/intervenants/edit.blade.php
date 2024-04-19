@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card ">
                    <div class="card-header main-color">{{ __('Edition des intervants.') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- $intervenant : variable passée au niveau du controller  -->
                        <div>

                            @livewire('edit-intervenant', ['intervenants' => $intervenant])

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
