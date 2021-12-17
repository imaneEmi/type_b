<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #a34f23;
            color: white;
        }
    </style>
</head>

<body>

<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="invoice-title">
                    <img src="{{asset('assets/img/uca-logo.png')}}" alt="">
                      <div class="invoice-number">Code: {{$demande->code}}</div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <address>
                          <strong>Billed To:</strong><br>
                            Ujang Maman<br>
                            1234 Main<br>
                            Apt. 4B<br>
                            Bogor Barat, Indonesia
                        </address>
                      </div>
                      <div class="col-md-6 text-md-right">
                        <address>
                          <strong>Shipped To:</strong><br>
                          Muhamad Nauval Azhar<br>
                          1234 Main<br>
                          Apt. 4B<br>
                          Bogor Barat, Indonesia
                        </address>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <address>
                          <strong>Payment Method:</strong><br>
                          Visa ending **** 4242<br>
                          ujang@maman.com
                        </address>
                      </div>
                      <div class="col-md-6 text-md-right">
                        <address>
                          <strong>Order Date:</strong><br>
                          September 19, 2018<br><br>
                        </address>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
            </div>
          </div>
        </section>
      </div>

    <h3>Entité de recherche organisant la manifestation</h3>

    <table id="customers">
        <tr>
            <th>Nom de l’entité de recherche </th>
            <th>Responsable de l’entité</th>
            <th>Etablissement</th>
        </tr>
        <tr>
            <td>{{$demande->manifestation->entiteOrganisatrice->nom}}</td>
            <td>{{$demande->manifestation->entiteOrganisatrice->responsable}}</td>
            <td>{{$demande->manifestation->entiteOrganisatrice->etablissement->libelle}}</td>
        </tr>
    </table>

    <h3>Coordonnateur de la manifestation</h3>

    <table id="customers">
        <tr>
            <th>Nom </th>
            <th>Prénom </th>
            <th>Etablissement</th>
            <th>E-mail</th>
            <th>N° de téléphone personnelle</th>
            <th>Fax</th>
        </tr>
        <tr>
            <td>{{$demande->coordonnateur->name}}</td>
            <td>{{$demande->coordonnateur->prenom}}</td>
            <td>{{$demande->coordonnateur->etablissement->libelle}}</td>
            <td>{{$demande->coordonnateur->email}}</td>
            <td>{{$demande->coordonnateur->tel}}</td>
            <td>{{$demande->coordonnateur->fax}}</td>
        </tr>
    </table>

    <h3>Comité d'organisation</h3>

    <table id="customers">
        <tr>
            <th>Nom & Prénom </th>
            <th>tel </th>
            <th>Etablissement/ Université </th>
            <th>Contact / E-Mail</th>
        </tr>
        <tr>
        @foreach ($manifestationComite as $mc)
            <td>{{$mc->comiteOrganisation->nom}}  {{$mc->comiteOrganisation->prenom}}</td>
            <td>{{$mc->comiteOrganisation->tel}}</td>
            <td>{{$mc->comiteOrganisation->etablissement->libelle}}</td>
            <td>{{$mc->comiteOrganisation->email}}</td>
        </tr>
        @endforeach
    </table>

    <h3>Contribution </h3>
    <table id="customers">
        <tr>
            <th>type </th>
            <th>nom </th>
            <th>montant </th>
            <th>nature</th>
        </tr>
        <tr>
        @foreach ($manifestationContributeur as $mc)
            <td>{{$mc->contributeur->typeContributeur->libelle}}  </td>
            <td>{{$mc->contributeur->nom}}</td>
            <td>{{$mc->contributeur->montant}}</td>
            <td>{{$mc->contributeur->natureContribution->libelle}}</td>
        </tr>
        @endforeach
    </table>

</body>

</html>