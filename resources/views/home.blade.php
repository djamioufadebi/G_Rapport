@extends('layouts.app')

@section('content')
    {{--  @include('menu') --}}

    <div class="container pt-3">

        <div class="row justify-content-between">

            {{-- Utilisateurs --}}
            <div class="col-lg-3 col-3">
                <a href="{{ route('users') }}" class="text-decoration-none">
                    <div class="small-box position-relative rounded" style="background: #42C2FF;">
                        <div class="p-2" style="background: #F1F1F1">
                            <span class="badge bg-warning rounded-pill 
                    float-end p-2 m-2 text-dark">
                                {{ $newsUser }} nouveau(x)</span>
                            <h3 class="m-2 text-dark">{{ $userCount }}</h3>
                        </div>
                        <div class="p-4 rounded">
                            <p class="text-center mb-0 fw-bold text-dark">EMPLOYES</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Projets --}}
            <div class="col-lg-3 col-3">
                <a href="{{ route('projets') }}" class="text-decoration-none">
                    <div class="small-box position-relative rounded" style="background: #42C2FF;">
                        <div class="p-2" style="background: #F1F1F1">
                            <span class="badge bg-warning rounded-pill 
                    float-end p-2 m-2 text-dark">
                                {{ $encoursProjectCount }} en cours</span>
                            <h3 class="m-2 text-dark">{{ $projectCount }}</h3>
                        </div>
                        <div class="p-4 rounded">
                            <p class="text-center mb-0 fw-bold text-dark">PROJETS</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Activités --}}
            <div class="col-lg-3 col-3">
                <a href="{{ route('activites') }}" class="text-decoration-none">
                    <div class="small-box position-relative rounded" style="background: #42C2FF;">
                        <div class="p-2" style="background: #F1F1F1">
                            <span class="badge bg-warning rounded-pill 
                    float-end p-2 m-2 text-dark">
                                {{ $encoursActivityCount }} en cours</span>
                            <h3 class="m-2 text-dark">{{ $activityCount }}</h3>
                        </div>
                        <div class="p-4 rounded">
                            <p class="text-center mb-0 fw-bold text-dark">ACTIVITES</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <br>

        <div class="row pt-3 justify-content-around">

            {{-- Rapports --}}
            <div class="col-lg-3 col-6">
                <a href="{{ route('rapports') }}" class="text-decoration-none">
                    <div class="small-box position-relative rounded" style="background: #42C2FF;">
                        <div class="p-2" style="background: #F1F1F1">
                            <span class="badge bg-warning rounded-pill 
                    float-end p-2 m-2 text-dark">
                                {{ $dayReportCount }} ce jour</span>
                            <h3 class="m-2 text-dark">{{ $reportCount }}</h3>
                        </div>
                        <div class="p-4 rounded">
                            <p class="text-center mb-0 fw-bold text-dark">RAPPORTS</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Besoins --}}
            <div class="col-lg-3 col-6">
                <a href="{{ route('besoins') }}" class="text-decoration-none">
                    <div class="small-box position-relative rounded" style="background: #42C2FF;">
                        <div class="p-2" style="background: #F1F1F1">
                            <span class="badge bg-warning rounded-pill 
                    float-end p-2 m-2 text-dark">
                                {{ $dayBesoinCount }} ce jour</span>
                            <h3 class="m-2 text-dark">{{ $besoinCount }}</h3>
                        </div>
                        <div class="p-4 rounded">
                            <p class="text-center mb-0 fw-bold text-dark">BESOINS</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection
