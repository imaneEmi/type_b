<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{asset('assets/img/uca-logo.png')}}" rel="icon">
    <link href="{{asset('assets/assets/img/uca-logo.png')}}" rel="apple-touch-icon">
    <title>UCA</title>
    <style>
        .font {
            font-family: 'TIMES NEW ROMAN';
            font-size: 11;
        }

        .header-font {
            font-family: 'TIMES NEW ROMAN';
            font-size: 10;
        }

        .ml-6 {
            margin-left: 6em;
        }

        .text-dark{
            font-weight: bold;
        }
        .text-color{
            color: #a34f23;
        }
    </style>
</head>

<body>
    <div class="header-font">
        <img src="{{ public_path('/assets/img/uca-logo.jpg') }}" alt="UCA logo" height="53px" style="float: left;">
        <p class="d-inline">Université Cadi Ayyad</p>
        <p class="ml-6">Présidence</p>
    </div>
    <section class="section font">
        <div class="section-header">
            <h3 style="text-align: center">Type: B</h3>
            <h6 style="text-align: center;text-decoration: underline;">Traitement de dossier</h6>
        </div>
        <table class="table table-bordered mt-3 font">
            <tr>
                <td>Etab: <span class="ml-1 text-uppercase text-dark text-color">{{ $data['coordonnateur']->laboratoire->etablissement->nom }}</span></td>
                <td class="border-left">Demandeur: <span class="ml-1 text-uppercase text-dark text-color">{{ $data['coordonnateur']->nom }} </span><span class="text-capitalize">{{ $data['coordonnateur']->prenom }}</span></td>
            </tr>
            <tr>
                <td colspan="2">Structure de recherche:
                    <span class="ml-1 text-uppercase text-color text-dark">{{ $data['coordonnateur']->laboratoire->nom }}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">Titre:
                    <span class="ml-1 text-capitalize text-color text-dark">{{ $data['manifestation']->intitule }}</span>
                </td>
            </tr>
            <tr>
                <td>Lieu & Date: <span class="ml-1"><span class="text-uppercase text-color text-dark">{{ $data['manifestation']->lieu }} </span>
                - Du <span class="text-color text-dark"> {{ $data['manifestation']->date_debut->format('d/m/Y') }} </span> Au <span class="text-color text-dark">{{ $data['manifestation']->date_fin->format('d/m/Y') }}</span></span></td>
                <td class="border-left">Nbre de participants: <span class="ml-1 text-color text-dark">{{ $data['manifestation']->nbr_participants_prevus }}</span></td>
            </tr>
        </table>

        <div class="section-body">
            <div class="">
                <div class="">
                    <h4>Informations sur BUDGET</h4>
                    <table class="table table-bordered">
                        <tr>
                            <td>Budget engagé de l'UCA (DHS)</td>
                            <td class="text-color text-dark">{{ $data['budgetRestant']->budget_fixe }}</td>
                            <td class="border-left">Budget octroyé à l'établissement (DHS)</td>
                            <td class="text-color text-dark">{{ $data['budgetEtablissement'] }}</td>
                        </tr>
                        <tr>
                            <td>Budget de la structure</td>
                            <td class="text-color text-dark">{{ $data['budgetStructure'] }}</td>
                            <td class="border-left">Estimation de dotation</td>
                            <td class="text-color text-dark">{{ $data['demande']->estimationDotationMax }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="">
                <div class="m-3">
                    <h4>Contribution des sponsors</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Organisme</th>
                                <th>Montant</th>
                            </tr>
                        </thead>
                        @if ($data['contributeurs'] != null)
                        <tbody>
                            @foreach ($data['contributeurs'] as $sponsor )
                            @if ($sponsor->typeContributeur->libelle == "Sponsors")
                            <tr>
                                <td>{{ $sponsor->nom }}</td>
                                <td>{{ $sponsor->montant }} MAD</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
                <div class="m-3">
                    <h4>Contribution estimative des participants</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Enseignants</th>
                                <th>Etudiants</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-right border-bottom">Total: <span
                                        class="label mr-1 ml-1 font-weight-bold">{{
                                        ($data['manifestation']->nbr_enseignants_locaux +
                                        $data['manifestation']->nbr_enseignants_non_locaux) }}</span>
                                    -Locaux: <span class="label mr-1 ml-1 font-weight-bold">{{
                                        $data['manifestation']->nbr_enseignants_locaux }}</span> </td>
                                <td class="border-right border-bottom">Total: <span
                                        class="label mr-1 ml-1 font-weight-bold">{{
                                        ($data['manifestation']->nbr_etudiants_locaux +
                                        $data['manifestation']->nbr_etudiants_non_locaux) }}</span>
                                    - Locaux: <span class="label mr-1 ml-1 font-weight-bold">{{
                                        $data['manifestation']->nbr_etudiants_locaux }}</span></td>
                            </tr>
                            <tr>
                                <td colspan="2">Total contribution:
                                    <span class="label mr-1 ml-1 font-weight-bold">{{ $data['contributionParticipants'] }} MAD</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Les frais d'inscription couvrent:
                                    @if($data['natureContributionParticipant'] != null)
                                    <p>
                                        @foreach ($data['natureContributionParticipant'] as $contribution)
                                        @if ($loop->index != 0)
                                        ,
                                        @endif
                                        <span class="label font-weight-bold mr-1">{{ $contribution->natureContribution->libelle
                                            }}</span>
                                        @endforeach
                                    </p>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="break-after: avoid;"></div>
            <div class="">
                <div class="font">
                    <h4>Soutien de l'Université</h4>
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th class="text-center">Rubrique</th>
                                <th class="text-center">Montant demandé</th>
                                <th class="text-center">Montant octroyé</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < sizeof($data['soutienSollicite']); $i++)
                            <tr>
                                <td>{{ $data['soutienSollicite'][$i]->libelle }}</td>
                                <td class="text-right text-dark text-color"><span>{{ $data['soutienSollicite'][$i]->pivot->montant }} MAD</span></td>
                                <td class="text-right text-dark text-color"><span>{{ $data['soutienAccorde'][$i]->pivot->montant }} MAD</span></td>
                            </tr>
                            <tr>
                                <td class="text-left">TOTAL</td>
                                <td class="text-right text-dark text-color"><span>{{ $data['manifestation']->soutienSollicite()->sum('montant') }} MAD</span></td>
                                <td class="text-right text-dark text-color"><span>{{ $data['manifestation']->soutienAccorde()->sum('montant') }} MAD</span></td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script type="text/php">
        if (isset($pdf)) {
           $pdf->page_text(555,800, "Page {PAGE_NUM}/{PAGE_COUNT}", null, 7, array(0, 0, 0));
        }
        </script>
</body>

</html>
