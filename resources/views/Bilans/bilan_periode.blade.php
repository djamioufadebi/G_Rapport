<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            font-family: arial, sans-serif;
            letter-spacing: 0.5px;
            margin: 5px;
            padding: 5px;
        }

        table {
            width: 98%;
            border-collapse: collapse;
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
            margin-bottom: 2px;
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

        .separator {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
            color: #333;
            /* Couleur grise, vous pouvez ajuster selon vos préférences */
        }

        .document-title {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            text-decoration: underline;
            color: #333;
            text-align: right;
            /* Couleur grise, vous pouvez ajuster selon vos préférences */
        }

        hr {
            border: 1px solid black;
            /* Couleur bleue pour le hr, ajustez selon vos préférences */
        }

        thead {
            display: table-header-group;
            page-break-inside: avoid;
        }

        @media print {
            thead {
                display: table-header-group;
            }
        }



        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            /* couleur de fond, ajustez selon vos préférences */
            text-align: right;
            padding: 1px;
        }
    </style>

</head>

<body>

    <div class="container-fluid">

        <!-- En-tête de la société et du document -->
        <div class="company-header">
            <div>
                <img src="{{ public_path('images/innov2b.jpg') }}" alt="Logo de la société" class="company-logo">
                <span class="module-title text-center">INNOVATION BULDING BUSINESS SAS</span>
            </div>
            <hr>
            <h1 class="document-title text-center">Bilans du {{ $dateDebut }} au {{ $dateFin }}</h1>
        </div>

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
                <h2 class="module-title">Rapports du {{ $dateDebut }} au
                    {{ $dateFin }} </h2>

                {{-- ici --}}
                @foreach ($rapportsCreesAujourdhui as $rapport)
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th> <strong> RAPPORT N° : </strong>{{ $rapport->id }}</th>
                                <th> <strong> Libellé : </strong> {{ $rapport->libelle }}</th>
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
                                    <strong>PROJET N°: {{ $rapport->activite->projet->id }}</strong><br>
                                    <br>
                                    <strong>NOM DU PROJET :</strong><br>
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
                                    <strong class="text-center">TRAVAUX EFFECTUES DE LA JOURNEE :</strong><br>
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
                                    <strong class="text-center">PROBLEMES/RETARDS :</strong><br>
                                    <p>{{ $rapport->difficultes_rencontrees }}</p>
                                </td>
                                <td class="report-detail">
                                    <strong class="text-center">MESURES CORRECTIVES OU A METTRE EN OEUVRE :</strong><br>
                                    <p>{{ $rapport->solutions_apportees }}</p>
                                </td>
                            </tr>

                            <tr>
                                <td class="report-detail">
                                    <strong class="text-center">TRAVAUX RESTANTS A FAIRE :</strong><br>
                                    <p>{{ $rapport->travaux_restants }}</p>
                                </td>
                                <td class="report-detail">
                                    <strong class="text-center">BESOINS EN MATERIAUX :</strong><br>
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
            <p>Aucun rapport n'a été fait en cette période pour ce projet.</p>
        @endif



        <footer>
            <h6>
                Généré par {{ Auth::user()->nom }} {{ Auth::user()->prenom }}, ce
                {{ $dateToday->format('d-m-Y') }}
            </h6>
        </footer>
    </div>
</body>


</html>
