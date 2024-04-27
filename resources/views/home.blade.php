 @extends('layouts.app')

 @section('content')
     <div class="container pt-3">

         <div class="row justify-content-between">

             <a href="{{ route('rapports') }}" style="text-decoration: none;">
                 <div class="card shadow-sm" style="width: 20rem; height: 18rem; border-radius: 10px; overflow: hidden;">
                     <div class="row g-0">

                         <img src="{{ asset('images/rapport-dactivite.jpg') }}" class="card-img" alt="Rapport d'activité">


                         <div class="card-body">
                             <h5 class="card-title text-dark fw-bold mb-3">RAPPORT D'ACTIVITÉ</h5>
                             <p class="card-text text-secondary">
                                 Un aperçu rapide de vos activités, des insights essentiels et des données clés.
                             </p>
                             <a href="{{ route('rapports') }}" class="btn main-color pt-2">Voir plus</a>
                         </div>

                     </div>
                 </div>
             </a>

             <div class="card" style="width: 18rem;">
                 <img src="{{ asset('images/innov2b.jpg') }}" class="card-img-top" alt="...">
                 <div class="card-body">
                     <h5 class="card-title">LES ACTIVITES</h5>
                     <p class="card-text">
                         Some quick example text to build on
                         the card title and make up the bulk of the card's content.
                     </p>
                     <a href="{{ route('activites') }}" class="btn main-color">Voir</a>
                 </div>
             </div>



             <div class="card" style="width: 18rem;">
                 <img src="{{ asset('images/innov2b.jpg') }}" class="card-img-top" alt="...">
                 <div class="card-body">
                     <h5 class="card-title">LES RAPPORTS</h5>
                     <p class="card-text">
                         Some quick example text to build on
                         the card title and make up the bulk of the card's content.
                     </p>
                     <a href="{{ route('rapports') }}" class="btn main-color">Voir</a>
                 </div>
             </div>
         </div>
         <br>

         <div class="row pt-3 justify-content-around">


         </div>
     </div>
 @endsection
