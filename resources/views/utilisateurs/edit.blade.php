@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header ">{{ __('Edition des utilisateurs') }}</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <div>
            <h1>Edition des utilisateurs</h1>
            @livewire('edit-user', ['users' => $user])
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
