<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilan de l'activité</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Ajoutez vos styles CSS personnalisés ici */
        body {
            font-family: arial, sans-serif;
            letter-spacing: 0.5px;
            margin: 5px;
            padding: 5px;
        }

        .taux_nombre {
            text-align: center;
        }

        table {
            width: 98%;
            border-collapse: collapse;
        }

        table tbody tr td {
            padding: 5px;
            border: 1px solid black;
        }

        table thead th {
            background: #ccc;
            font-size: 15px;
            padding: 5px;
            border: 1px solid black;
        }

        thead {
            display: table-header-group;
        }

        .container-fluid {
            padding: 10px;
        }

        .module {
            margin-bottom: 10px;
        }

        .module-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: left;
        }

        h2 {
            text-align: center;
            text-decoration: underline;
        }

        h3 {
            font-size: 5px;
            font-weight: italic;
            margin-bottom: 5px;
            /* text-decoration: underline; */
        }

        .company-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .company-logo {
            max-height: 70px;
            margin-right: 50px;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
        }

        .document-title {
            font-size: 24px;
            font-weight: bold;
            text-align: right;
            text-decoration: underline;
            color: #000;
            /* Correction ici */
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            /* couleur de fond, ajustez selon vos préférences */
            text-align: right;
            padding: 8px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="company-header">
            <div>
                <img src="{{ public_path('images/innov2b.jpg') }}" alt="Logo de la société" class="company-logo">
                <span class="company-name">INNOVATION BULDING BUSINESS</span>
            </div>
            <hr>
            <h1 class="document-title text-center">Bilan du {{ $dateToday->format('d-m-Y') }}</h1>
        </div>
        <!-- Fin de l'en-tête -->

        <div class="module">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="module-title">Les détails du projet</h2>
                    <br>
                    <!-- Tableau pour afficher les détails des projets en cours -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <!-- En-têtes du tableau -->
                            <thead>
                                <tr>
                                    <th scope="col">Libellé</th>
                                    <th scope="col">Lieu</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Date début</th>
                                    <th scope="col">Date fin</th>
                                    <th scope="col">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projets as $projet)
                                    <tr>
                                        <td>{{ $projet->libelle }}</td>
                                        <td>{{ $projet->lieu }}</td>
                                        <td>{{ $projet->description }}</td>
                                        <td>{{ $projet->date_debut }}</td>
                                        <td>{{ $projet->date_fin_prevue }}</td>
                                        <td>{{ $projet->statut }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin module Projets en cours -->
        @if (count($rapportsCreesAujourdhui) > 0)
            <div class="module">
                <h2 class="module-title">Rapports du jour</h2>
                @foreach ($rapportsCreesAujourdhui as $rapport)
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th> <strong> RAPPORT N° : </strong>{{ $rapport->id }}<b></th>
                                <th> <strong> Libellé : </strong> <i>{{ $rapport->libelle }} </i></th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td class="report-detail">
                                    <strong>Chef travaux :</strong> <br>
                                    <p>{{ $rapport->user->nom }} {{ $rapport->user->prenom }} </p>
                                </td>
                                <td class="report-detail">
                                    <strong>DATE & HEURES :</strong><br>
                                    <p>{{ $rapport->created_at->format('d-m-Y') }} à
                                        {{ $rapport->created_at->format('H:m:s') }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="report-detail">
                                    <strong>PROJET N° :{{ $rapport->activite->projet->id }}</strong> <br>
                                    <strong>NOM DU PROJET :</strong>
                                    <p>{{ $rapport->activite->projet->libelle }}</p>
                                </td>
                                <td class="report-detail">
                                    <strong>LOCALISATION DES TRAVAUX EN COURS :</strong><br>
                                    <p>{{ $rapport->activite->lieu }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="report-detail">
                                    <strong>ACTIVITE :</strong> <br>
                                    <p>{{ $rapport->activite->nom }}</p>
                                </td>
                                <td class="report-detail">
                                    <strong>STATUT :</strong> <br>
                                    <p>{{ $rapport->statut }}</p><br>

                                    <strong>TAUX DE REALISATION :</strong><br>
                                    <p>{{ $rapport->activite->taux_de_realisation }} %</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="report-detail" colspan="2">
                                    <strong class=" text-bold text-center">TRAVAUX PREVUS DE LA JOURNEE :</strong>
                                    <br>
                                    <p>{{ $rapport->travaux_prevus_journee }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="report-detail">
                                    <strong>TRAVAUX EFFECTUES DE LA JOURNEE :</strong><br>
                                    <br>
                                    <p>{{ $rapport->travaux_realises }}</p>
                                </td>
                                <td class="report-detail">
                                    <strong>HEURES DE TRAVAIL:</strong><br>
                                    <br>
                                    <p><strong>Heure de démarrage :</strong>
                                    <p>{{ $rapport->heure_demarrage }}</p><br>
                                    <strong>Heure de fin :</strong>
                                    <p>{{ $rapport->heure_fin }}</p>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td class="report-detail">
                                    <strong>MATERIELS :</strong>
                                </td>
                                <td>
                                    <p>{{ $rapport->materiels_utilises }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="report-detail">
                                    <strong>PROBLEMES/RETARDS :</strong><br>
                                    <p>{{ $rapport->difficultes_rencontrees }}</p>
                                </td>
                                <td class="report-detail">
                                    <strong>MESURES CORRECTIVES OU A METTRE EN OEUVRE :</strong><br>
                                    <p>{{ $rapport->solutions_apportees }}</p>
                                </td>
                            </tr>

                            <tr>
                                <td class="report-detail">
                                    <strong>TRAVAUX RESTANTS A FAIRE :</strong><br>
                                    <p>{{ $rapport->travaux_restants }}</p>
                                </td>
                                <td class="report-detail">
                                    <strong>BESOINS EN MATERIAUX :</strong><br>
                                    <p>{{ $rapport->besoins_materiaux }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="report-detail" colspan="2">
                                    <strong class="text-center">TRAVAUX PREVUS POUR DEMAIN :</strong> <br>
                                    <p>{{ $rapport->travaux_prevus_demain }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                @endforeach
                <br>
            </div>
        @else
            <p>Aucun rapport n'a été fait aujourd'hui pour ce projet.</p>
        @endif


        @if (count($besoinsEnCoursAujourdhui) > 0)
            <!-- module -->
            <div class="module">
                <h2 class="module-title"> </h2>
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="module-title">Besoins du jour du projet</h2>
                        <!-- Tableau pour afficher les détails des projets en cours -->

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th scope="col">Libellé besoin</th>
                                        <th scope="col">Activité</th>
                                        <th scope="col">Nom Projet</th>
                                        <th scope="col">Nom du demandeur</th>
                                        <th scope="col">Contenu</th>
                                        <th scope="col">Date création</th>
                                        <th scope="col">Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($besoinsEnCoursAujourdhui as $besoin)
                                        <tr>
                                            <td>{{ $besoin->libelle }}</td>
                                            <td>{{ $besoin->activite->nom }}</td>
                                            <td>{{ $besoin->activite->projet->libelle }}</td>
                                            <td>{{ $besoin->user->nom }} {{ $besoin->user->nom }}</td>
                                            <td>{{ $besoin->contenu }}</td>
                                            <td>{{ $besoin->created_at }}</td>
                                            <td>{{ $besoin->statut }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        @else
            <p>Aucun besoin n'a été fait aujourd'hui pour ce projet.</p>
        @endif
        <!-- fin module -->


        <h1 class="module-title">Activités en cours </h1>
        @if (count($activitesEnCours) > 0)
            <!-- Autre module projetEnAttenteAjourdhui -->
            <div class="module">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="module-title">Activités en cours</h2>
                        <!-- Tableau pour afficher les détails des projets en cours -->

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <!-- En-têtes du tableau -->
                                <thead>
                                    <tr>
                                        <th scope="col">Nom de l'activité</th>
                                        <th scope="col">Nom du projet </th>
                                        <th scope="col">Date de début</th>
                                        <th scope="col">Date de fin</th>
                                        <th scope="col">Statut</th>
                                        <th scope="col">Taux de réalisation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activitesEnCours as $activite)
                                        <tr>
                                            <td>{{ $activite->nom }}</td>
                                            <td>{{ $activite->projet->libelle }}</td>
                                            <td>{{ $activite->date_debut }}</td>
                                            <td>{{ $activite->date_fin }}</td>
                                            <td>{{ $activite->statut }}</td>
                                            <td class="taux_nombre ">{{ $activite->taux_de_realisation }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        @else
            <p>Aucune actvité en cours pour le moment.</p>
        @endif


        <div class="module">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="module-title">Activités en attente</h2>
                    <!-- Tableau pour afficher les détails des projets en cours -->
                    @if (count($activitesEnAttentes) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <!-- En-têtes du tableau -->
                                <thead>
                                    <tr>
                                        <th scope="col">Nom de l'activité</th>
                                        <th scope="col">Nom du projet </th>
                                        <th scope="col">Date de début</th>
                                        <th scope="col">Date de fin</th>
                                        <th scope="col">Statut</th>
                                        <th scope="col">Taux de réalisation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activitesEnAttentes as $activite)
                                        <tr>
                                            <td>{{ $activite->nom }}</td>
                                            <td>{{ $activite->projet->libelle }}</td>
                                            <td>{{ $activite->date_debut }}</td>
                                            <td>{{ $activite->date_fin }}</td>
                                            <td>{{ $activite->statut }}</td>
                                            <td class="taux_nombre ">{{ $activite->taux_de_realisation }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Aucune actvité en attente pour le moment.</p>
                    @endif
                </div>
            </div>
        </div>




        <footer>
            <h6>
                Généré par {{ Auth::user()->nom }} {{ Auth::user()->prenom }}, ce
                {{ $dateToday->format('d-m-Y') }}
            </h6>
        </footer>
    </div>
</body>



</html>
