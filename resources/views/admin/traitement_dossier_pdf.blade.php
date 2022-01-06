<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>UCA</title>
    <style>
        .font {
            font-family: 'TIMES NEW ROMAN';
            font-size: 12;
        }
        .header-font{
            font-family: 'TIMES NEW ROMAN';
            font-size: 10;
        }
    </style>
</head>

<body>
    <div class="header-font">
        <p>Université Cadi Ayyad</p>
        <p class="ml-3">Présidence</p>
    </div>
    <section class="section font">
        <div class="section-header">
            <h3 style="text-align: center">Type: B</h3>
            <h6 style="text-align: center;text-decoration: underline;">Traitement de dossier</h6>
        </div>

        <table class="table table-bordered mt-3 font">
            <tr>
                <td>Etab: <span class="ml-1">FSTG</span></td>
                <td class="border-left">Demandeur: <span class="ml-1">Moi Imane</span></td>
            </tr>
            <tr>
                <td colspan="2">Structure de recherche:
                    <span class="ml-1">FSTG</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">Titre:
                    <span class="ml-1">FSTG</span>
                </td>
            </tr>
            <tr>
                <td>Lieu & Date: <span class="ml-1">{{ Date::now() }}</span></td>
                <td class="border-left">Nbre de participants: <span class="ml-1 text-dark">10.020</span></td>
            </tr>
        </table>

        <div class="section-body">
            <div class="">
                <div class="">
                    <h4>Informations sur BUDGET</h4>
                    <table class="table table-bordered">
                        <tr>
                            <td>Budget engagé de l'UCA (DHS)</td>
                            <td>1.150.234 </td>
                            <td class="border-left">Budget octroyé à l'établissement (DHS)</td>
                            <td>1.235</td>
                        </tr>
                        <tr>
                            <td>Budget de la structure</td>
                            <td>1.150.234 DHS</td>
                            <td class="border-left">Estimation de dotation</td>
                            <td>1.235 DHS</td>
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
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
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
                                <td>Total:10.000 &nbsp;-Locaux:5.000 </td>
                                <td>Total:100.000 &nbsp;- Locaux:50.000</td>
                            </tr>
                            <tr>
                                <td colspan="2">Les frais d'inscription couvrent:
                                    <span>lol</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="page-break-after: always;"></div>
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
                            <tr>
                                <td></td>
                                <td class="text-right"><span></span></td>
                                <td class="text-right"><span></span></td>
                            </tr>
                            <tr>
                                <td class="text-center">TOTAL</td>
                                <td class="text-right"><span></span></td>
                                <td class="text-right"><span></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
