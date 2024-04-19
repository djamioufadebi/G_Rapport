<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilan de l'activité</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 10px;
            padding: 10px;
            font-size: 16px;
        }

        table {
            width: 98%;
            border: 1px solid #ccc;
            border-collapse: collapse;
        }

        table tbody tr td {
            padding: 5px;
            border: 2px solid #77B5FE;
        }

        table thead th {
            background: #ccc;
            font-size: 15px;
            padding: 5px;
            border: 1px solid #77B5FE;
        }

        thead {
            display: table-header-group;
        }


        .container-fluid {
            max-width: 960px;
            margin: 0 auto;
        }

        .company-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .company-logo {
            max-height: 70px;
            margin-right: 20px;
        }

        .module-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        h1,
        h2,
        h3 {
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            font-weight: italic;
        }

        .document-title {
            font-size: 28px;
            font-weight: bold;
            text-align: right;
            margin-bottom: 20px;
            text-decoration: underline;
        }

        hr {
            border: 1px solid #333;
            margin: 20px 0;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            text-align: right;
            padding: 10px;
            font-size: 14px;
        }

        .table-responsive {
            overflow-x: auto;
            scroll-behavior: smooth;
        }

        .report-detail {
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 5px solid #000000;
            background-attachment: fixed;
            padding-bottom: 10px;
        }

        .report-detail strong {
            display: block;
            margin-bottom: 5px;
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
            <h2 class="document-title">Bilan du {{ $dateToday->format('d-m-Y') }}</h2>
        </div>

        <div class="module">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="module-title">Détails de l'activité</h2>

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
                                @foreach ($activites as $activite)
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

        @if (count($rapportsSelectedActivity) > 0)
            <div class="module">
                <h2 class="module-title">Rapports du jour de l'activité</h2>

                @foreach ($rapportsSelectedActivity as $rapport)
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
                                <td class="report-detail">
                                    <strong>Nombre de Personnels :</strong> <br>
                                    <p>{{ $nbIntervenants }}</p>
                                </td>
                                <td class="report-detail">
                                    <strong>NOMS DES INTERVENANTS :</strong><br>
                                    <p>
                                        @foreach ($intervenants as $intervenant)
                                            <li>{{ $intervenant->nom }} {{ $intervenant->prenom }}</li>
                                        @endforeach
                                    </p><br>
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
            <p>Aucun rapport n'a été fait aujourd'hui pour cette activité.</p>
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
