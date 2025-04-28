<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INOV2'B - Accueil</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Ajoutez d'autres liens CSS nécessaires -->
</head>

<body>


    <div class="container pt-3">

        <div class="row text-center">

            {{-- Projets --}}
            <div class="col-lg-3 col-6">
                <a href="{{ route('projets') }}" class="text-decoration-none">
                    <div class="small-box position-relative rounded" style="background: #42C2FF;">
                        <div class="p-2" style="background: #F1F1F1">
                            <span
                                class="badge bg-warning rounded-pill 
                    float-end p-2 m-2 text-dark">
                                11</span>
                            <h3 class="m-2 text-dark">100</h3>
                        </div>
                        <div class="p-4 rounded">
                            <p class="text-center mb-0 fw-bold text-dark">PROJETS</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Activités --}}
            <div class="col-lg-3 col-6">
                <a href="{{ route('activites') }}" class="text-decoration-none">
                    <div class="small-box position-relative rounded" style="background: #42C2FF;">
                        <div class="p-2" style="background: #F1F1F1">
                            <span
                                class="badge bg-warning rounded-pill 
                    float-end p-2 m-2 text-dark">
                                11</span>
                            <h3 class="m-2 text-dark">100</h3>
                        </div>
                        <div class="p-4 rounded">
                            <p class="text-center mb-0 fw-bold text-dark">ACTIVITES</p>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Rapports --}}
            <div class="col-lg-3 col-6">
                <a href="{{ route('rapports') }}" class="text-decoration-none">
                    <div class="small-box position-relative rounded" style="background: #42C2FF;">
                        <div class="p-2" style="background: #F1F1F1">
                            <span
                                class="badge bg-warning rounded-pill 
                    float-end p-2 m-2 text-dark">
                                11</span>
                            <h3 class="m-2 text-dark">100</h3>
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
                            <span
                                class="badge bg-warning rounded-pill 
                    float-end p-2 m-2 text-dark">
                                11</span>
                            <h3 class="m-2 text-dark">100</h3>
                        </div>
                        <div class="p-4 rounded">
                            <p class="text-center mb-0 fw-bold text-dark">BESOINS</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <br>

        <div class="row pt-3">
            <div class="col-lg-3 col-6">
                <a href="{{ route('users') }}" class="text-decoration-none">
                    <div class="small-box position-relative rounded" style="background: #42C2FF;">
                        <div class="p-2" style="background: #F1F1F1">
                            <span
                                class="badge bg-warning rounded-pill 
                    float-end p-2 m-2 text-dark">
                                11</span>
                            <h3 class="m-2 text-dark">100</h3>
                        </div>
                        <div class="p-4 rounded">
                            <p class="text-center mb-0 fw-bold text-dark">EMPLOYES</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
