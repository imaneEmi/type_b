<!doctype html>
<html lang="fr">

<head>
    <style type="text/css">
        @page {
            font-size: 100%;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            font-size: 100%;
            word-wrap: break-word;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 100%;
            position: relative;
            background-color: #fff;
            border-radius: 3px;
        }

        #header {
            position: relative;
            height: 15%;
            width: 100%;
        }

        img {
            max-width: 100px;
            max-height: 100px;
            margin: 0%;
            padding: 0%;
        }

        #header {
            padding: 0%;
            margin: 0%;
        }

        #header div {
            position: absolute;
            height: 13%;
            width: 50%;
            top: 0%;
        }

        #header_box_left {
            margin-top: 30px;
            padding: 1% 0% 0% 1.5%;
            left: 0%;
        }


        #header_box_center {
            left: 33%;
        }

        #header_box_right {
            left: 80%;
        }

        #billing_info {
            position: relative;
            padding: 0%;
            margin: 0%;
            width: 100%;
            height: 12%;
        }

        #billing_info_left {
            position: absolute;
            width: 40%;
            height: 12%;
            top: 0%;
            left: 8%;
        }

        #billing_info_right {
            position: absolute;
            width: 40%;
            height: 15%;
            right: 8%;
            top: 0%;
        }

        .billing-header {
            background-color: #e1eaf1;
            text-align: center;
            font-weight: bold;
            font-size: 60%;
            letter-spacing: 2px;
            color: #005093;
            margin-bottom: 0.8%;
            padding: 0.4%;
        }

        .invoice_info {
            border: 1px solid #ebebeb;
            border-radius: 3px;
            height: 12%;
            font-size: 70%;
            padding-left: 5%;
        }

        .invoice_info p {
            padding: 0.3em;
            margin: 0%;
        }

        #invoice_references {
            padding-top: 0.5em;
        }

        #invoice_references p {
            padding: 1em 0em;
        }

        #invoice_recipient {
            padding-top: 0.5em;
        }

        #content_wrapper {
            margin-top: 2%;
            height: 56%;

        }

        #content {
            min-height: 30%;
            border: 1px solid #ebebeb;
            border-radius: 3px;
        }

        #title {
            color: #005093;
            margin-bottom: 7px;
        }

        #table_invoice_details {
            width: 90%;
            margin-left: 5%;
            padding: 2% 0%;
        }

        #table_invoice_details table {
            width: 100%;
            font-size: 60%;
        }

        table {
            border-collapse: collapse;
        }

        #th_1 {
            width: 30%;
            padding: 0.4%;
            background-color: #e1eaf1;
        }

        #th_2 {
            width: 30%;
            padding: 0.2%;
            background-color: #cdd6dc;
        }

        #th_3 {
            width: 20%;
            padding: 0.2%;
            background-color: #e1eaf1;
        }

        #th_4 {
            width: 15%;
            padding: 0.2%;
            background-color: #cdd6dc;
        }


        tbody td {

            padding: 1% 0% 2%;

        }

        .td-3 {
            text-align: center;
            border-bottom: 1px solid #ebebeb;
        }

        .td-2 {
            text-align: center;
            border-bottom: 1px solid #ebebeb;
        }

        .td-4 {
            text-align: center;
            border-bottom: 1px solid #ebebeb;

        }

        .td-1 {
            text-align: center;
            border-bottom: 1px solid #ebebeb;
        }

        tfoot th {
            background-color: #78889c;
            color: #fff;
        }

        #tfoot_total_text {
            text-align: right;
            padding: 1%;
        }

        #tfoot_total {
            text-align: right;
            padding: 0.3%;
        }


        #footer {

            height: 8%;
            width: 100%;
            margin: 0%;
            padding: 2% 0% 0%;
            text-align: left;
            border-top: 6px solid #C68A24;
        }

        #footer p {
            font-size: 70%;
        }
    </style>

<body>
    <div id="header">
        <div id="header_box_left">
            <small> Université Cadi Ayyad </small>
            <small> Commission Recherche Scientifique & Coopération du Conseil de l'Université </small>
            <small> Division de la Recherche Scientifique de la Présidence</small>
        </div>
        <div id="header_box_right">
            <img alt="logo" src="{{public_path('assets/img/uca.jpg')}}" />
        </div>
    </div>
    <div id="billing_info">
        <div id="billing_info_left">
            <div class="billing-header">Soutien à la recherche Type B</div>
            <div class="invoice_info">
                <div id="invoice_references">
                    <p>Reference : {{$demande->code}} </p>
                    <p>Date : {{$demande->created_at}}</p>
                </div>
            </div>
        </div>
        {{-- <div id="billing_info_right">
          <div class="billing-header">ADRESSE DE FACTURATION</div>
          <div class="invoice_info">
              <div id="invoice_recipient">
                  <p></p>

              </div>
          </div>
      </div>--}}
    </div>


    <div id="content_wrapper">
        <div id="content">
            <div id="title">Informations concernant la manifestation</div>
            <div id="table_invoice_details">
                <table>
                    <thead>
                        <tr>
                            <th id="th_1">Intitulé de la manifestation</th>
                            <th id="th_2">Etendue</th>
                            <th id="th_2">Type</th>
                            <th id="th_3">Dates</th>
                            <th id="th_4">Lieu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="td-1">{{$demande->manifestation->intitule}}</td>
                            <td class="td-2"> {{$demande->manifestation->etendue}}</td>
                            <td class="td-2"> {{$demande->manifestation->type}}</td>
                            <td class="td-3">Du: {{$demande->manifestation->date_debut}}
                                Au: {{$demande->manifestation->date_fin}}</td>
                            <td class="td-4"> {{$demande->manifestation->lieu}}</td>
                        </tr>
                    </tbody>

                </table>
                <table>
                    <thead>
                        <tr>
                            <th id="th_1">Etablissement(s) de l’UCAM impliqué(s) dans l’organisation</th>
                            <th id="th_2">Partenaire(s) impliqué(s)</th>
                            <th id="th_3">Nombre de participants prévus</th>
                            <th id="th_4">Site Web de la manifestation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="td-1">
                                @foreach($etablissementsOrganisateur as $e)
                                {{$e->nom}}
                                @endforeach
                            </td>
                            <td class="td-2"><br>{{$demande->manifestation->partenaires}}</td>
                            <td class="td-3"><br>{{$demande->manifestation->nbr_participants_prevus}}</td>
                            <td class="td-4"><br>{{$demande->manifestation->site_web}} &nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                <small>La gestion financière</small>
                <table>
                    <thead>
                        <tr>
                            <th id="th_1">Libelle</th>
                            <th id="th_2">Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gestionFinanciere as $g)
                        <tr>
                            <td class="td-1"><br>{{$g->libelle}}</td>
                            <td class="td-2"><br>{{$g->information}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div id="content">
            <div id="title">Entité de recherche organisant la manifestation</div>
            <div id="table_invoice_details">
                <table>
                    <thead>
                        <tr>
                            <th id="th_1"> Nom</th>
                            <th id="th_2"> Responsable de l’entité</th>
                            <th id="th_3"> Etablissement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="td-1"><br>{{$entiteOrganisatrice->nom}}</td>
                            <td class="td-2">
                                <br> {{$responsableEntiteOrganisatrice->nom}} {{$responsableEntiteOrganisatrice->prenom}}
                            </td>
                            <td class="td-3"><br>{{$entiteOrganisatrice->etablissement->nom}} </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>


        <div id="content">
            <div id="title">Coordonnateur de la manifestation</div>
            <div id="table_invoice_details">
                <table>
                    <thead>
                        <tr>
                            <th id="th_1"> Nom, Prénom, Grade</th>
                            <th id="th_2"> Etablissement</th>
                            <th id="th_3"> E-mail</th>
                            <th id="th_3"> N° de téléphone personnelle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="td-1"><br>{{$coordonnateur->nom }} {{$coordonnateur->prenom }}
                                , {{$coordonnateur->grade }}</td>
                            <td class="td-2"><br> {{$entiteOrganisatrice->etablissement->nom}}</td>
                            <td class="td-3"><br> {{$coordonnateur->email }}</td>
                            <td class="td-3"><br> {{$coordonnateur->tel }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="content">
            <div id="title">Comité d'organisation local</div>
            <div id="table_invoice_details">
                <table>
                    <thead>
                        <tr>
                            <th id="th_1"> Nom & Prénom</th>
                            <th id="th_2"> Etablissement</th>
                            <th id="th_3"> E-Mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comiteOrganisationLocal as $item)
                        <tr>
                            <td class="td-1"><br>{{$item->nom}} {{$item->prenom}}</td>
                            <td class="td-2"><br> {{$item->laboratoire->etablissement->nom}}</td>
                            <td class="td-3"><br> {{$item->email}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="content">
            <div id="title">Comité d'organisation non local</div>
            <div id="table_invoice_details">
                <table>
                    <thead>
                        <tr>
                            <th id="th_1"> Nom & Prénom</th>
                            <th id="th_2"> Etablissement</th>
                            <th id="th_2"> ville</th>
                            <th id="th_3"> E-Mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comiteOrganisationNonLocal as $item)
                        <tr>
                            <td class="td-1"><br>{{$item->nom}} {{$item->prenom}}</td>
                            <td class="td-2"><br> {{$item->etablissement}}</td>
                            <td class="td-2"><br>{{$item->ville}}</td>
                            <td class="td-3"><br>{{$item->email}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div id="content">
            <div id="title">Comité scientifique local</div>
            <div id="table_invoice_details">
                <table>
                    <thead>
                        <tr>
                            <th id="th_1"> Nom & Prénom</th>
                            <th id="th_2"> Type d'entité</th>
                            <th id="th_2"> Nom d'entité</th>
                            <th id="th_3"> E-Mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comiteScientifiqueLocal as $item)
                        <tr>
                            <td class="td-1"><br>{{$item->nom}} {{$item->prenom}}</td>
                            <td class="td-2"><br> {{$item->type_entite}}</td>
                            <td class="td-2"><br>{{$item->nom_entite}}</td>
                            <td class="td-3"><br>{{$item->email}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div id="content">
            <div id="title">Comité scientifique non local</div>
            <div id="table_invoice_details">
                <table>
                    <thead>
                        <tr>
                            <th id="th_1"> Nom & Prénom</th>
                            <th id="th_2"> Type d'entité</th>
                            <th id="th_2"> Nom d'entité</th>
                            <th id="th_2"> Pays</th>
                            <th id="th_3"> E-Mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comiteScientifiqueLocal as $item)
                        <tr>
                            <td class="td-1"><br>{{$item->nom}} {{$item->prenom}}</td>
                            <td class="td-2"><br> {{$item->type_entite}}</td>
                            <td class="td-2"><br>{{$item->nom_entite}}</td>
                            <td class="td-2"><br> {{$item->pays}}</td>
                            <td class="td-3"><br> {{$item->email}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="content">
            <div id="title">Contribution des Sponsors & établissements de l’Université</div>
            <div id="table_invoice_details">
                <table>
                    <thead>
                        <tr>
                            <th id="th_1"><br> nom</th>
                            <th id="th_2"><br> Montant en DH</th>
                            <th id="th_2"><br>Type</th>
                            <th id="th_2"><br>Nature</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($manifestationcontributeurs as $item)
                        <tr>
                            <td class="td-1"><br>{{$item->contributeur->nom}}</td>
                            <td class="td-2"><br>{{$item->contributeur->montant}}</td>
                            <td class="td-2"><br>{{$item->contributeur->typeContributeur->libelle}}</td>
                            <td class="td-2"><br>{{$item->contributeur->natureContribution->libelle}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div id="content">
            <div id="title"> Contribution des participants:</div>

            <div id="table_invoice_details">
                <small> Montant des frais d'inscription</small>
                <table>
                    <thead>
                        <tr>
                            <th id="th_1"> nom</th>
                            <th id="th_2"> Montant en DH</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($manifestationContributionParticipant as $item)
                        <tr>
                            <td class="td-1"><br />{{$item->contributionParticipant->nom}}</td>
                            <td class="td-2"><br />{{$item->contributionParticipant->montant}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <small> Les frais d’inscription couvrent: </small>
                <div>
                    @foreach($natureContributionManifestation as $item)
                    {{$item->natureContribution->libelle}},
                    @endforeach
                </div>
            </div>
        </div>

        <div id="content">
            <div id="title">Soutien sollicité de l’Université</div>
            <div id="table_invoice_details">
                <table>
                    <thead>
                        <tr>
                            <th id="th_1"> Rubrique</th>
                            <th id="th_2">Nombre</th>
                            <th id="th_2">Montant (DH)</th>
                            <th id="th_2">Remarques</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($soutienSollicite as $item)
                        <tr>
                            <td class="td-1"> <br />{{$item->fraisCouvert->libelle}}</td>
                            <td class="td-2"> <br />{{$item->nbr}}</td>
                            <td class="td-2"> <br />{{$item->montant}}</td>
                            <td class="td-2"> <br />{{$item->remarques}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th id="tfoot_total_text" colspan="3"> Montant Global Sollicité</th>
                            <th id="tfoot_total"> {{$totalSoutienSollicite}} DH</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>

</body>

</html>