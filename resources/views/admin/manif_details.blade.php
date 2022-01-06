<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Layout &rsaquo; Top Navigation &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="index.html" class="navbar-brand sidebar-gone-hide">UCA</a>
                <div class="navbar-nav">
                    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                </div>
            </nav>

            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i
                                    class="fas fa-fire"></i><span>Organisation</span></a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a href="#entite" class="nav-link">Entité</a></li>
                                <li class="nav-item"><a href="#coordonnateur" class="nav-link">Coordonnateur</a></li>
                                <li class="nav-item"><a href="#comite" class="nav-link">Comité</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#contribution" class="nav-link"><i
                                    class="fas fa-fire"></i><span>Contribution</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#soutienSollicite" class="nav-link"><i class="far fa-clone"></i><span>Soutien
                                    sollicité</span></a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>{{ $manifestation->intitule }}</h1>
                        <div class="section-header-breadcrumb">
                            <div class="d-inline m-3">
                                <span>
                                    @if($demande->manifestation->lettreAcceptation != null)
                                    <a  href="{{route('manifastation.lettre',['url'=>Str::replace('/','-',$demande->manifestation->lettreAcceptation->url)])}}"
                                        title="Lettre d'acceptation"><i class="fa fa-file-pdf fa-lg" aria-hidden="true"></i>
                                    </a>
                                    @endif
                                </span>
                            </div>
                            <div class="d-inline">
                                <span>
                                    <a href="{{ route('pdf',['id'=>$demande->id]) }}"
                                        title="Télécharger Fiche traitement de dossier"><i class="fa fa-download fa-lg"></i>
                                    </a>
                                </span>
                            </div>
                            <div class="d-inline m-3">
                                <span>
                                    <a href="{{ url()->previous() }}" title="Retour en arrière">
                                        <i class="fa fa-reply fa-lg"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="section-body">
                        <h2 class="section-title">{{ $manifestation->type }}</h2>
                        <p class="section-lead">This page is just an example for you to create your own page.</p>
                        <div class="card">
                            <div class="card-header">
                                <h4>Informations concernant la manifestation</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Etendue</th>
                                                <th>Lieu</th>
                                                <th>Date début</th>
                                                <th>Date fin</th>
                                                <th>Nombre participants prévus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $manifestation->type }}</td>
                                                <td>{{ $manifestation->etendue }}</td>
                                                <td>{{ $manifestation->lieu }}</td>
                                                <td>{{ $manifestation->date_debut }}</td>
                                                <td>{{ $manifestation->date_fin }}</td>
                                                <td>{{ $manifestation->nbr_participants_prevus }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer bg-whitesmoke">
                                site web: <a href="{{ $manifestation->site_web}}"> {{ $manifestation->site_web}}</a>
                            </div>
                        </div>
                        @if ($gestionFinanciere != null )
                        <div class="card" id="gestion-financiere">
                            <div class="card-header">
                                <h4>Gestion financière</h4>
                            </div>
                            <div class="card-body">
                                <p>Délégué à: <span>{{ $gestionFinanciere->libelle }}</span>
                                <h6>{{ $gestionFinanciere->information }}</h6>
                                </p>
                            </div>
                            <div class="card-footer bg-whitesmoke">
                            </div>
                        </div>
                        @endif

                        @if ($etablissements != null )
                        <div class="card" id="etablissements">
                            <div class="card-header">
                                <h4>Etablissement(s) de l’UCAM impliqué(s) dans l’organisation </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Etablissement</th>
                                            <th>Intitule</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($etablissements as $etablissement )
                                        <tr>
                                            <td>{{ $etablissement->libelle }}</td>
                                            <td>{{ $etablissement->intitule }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer bg-whitesmoke">
                            </div>
                        </div>
                        @endif
                        @if ($entiteOrganisatrice != null)
                        <div class="card" id="entite">
                            <div class="card-header">
                                <h4>Entité de recherche organisant la manifestation</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Responsable</th>
                                            <th>Etablissement</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $entiteOrganisatrice->nom }}</td>
                                            <td>{{ $entiteOrganisatrice->responsable }}</td>
                                            <td>{{ $entiteOrganisatrice->etablissement->libelle }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <div class="card-footer bg-whitesmoke">
                                @if ($manifestation->agence_organisatrice != null)
                                <span>Organisation confié à l'agence: {{ $manifestation->agence_organisatrice }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="card" id="coordonnateur">
                            <div class="card-header">
                                <h4>Coordonnateur</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Nom Prenom</th>
                                            <th>Grade</th>
                                            <th>Etablissement</th>
                                            <th>E-mail</th>
                                            <th>N° tel personnel</th>
                                            <th>Fax</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $coordonnateur->name }}&nbsp;{{ $coordonnateur->prenom }}</td>
                                            <td>{{ $coordonnateur->profession }}</td>
                                            <td>{{ $coordonnateur->etablissement->libelle }}</td>
                                            <td>{{ $coordonnateur->email }}</td>
                                            <td>{{ $coordonnateur->tel }}</td>
                                            <td>{{ $coordonnateur->fax }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer bg-whitesmoke">
                            </div>
                        </div>
                    </div>

                    <div class="card" id="comite">
                        <div class="card-header">
                            <h4>Comité d'organisation</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Nom Prénom</th>
                                        <th>Etablissement</th>
                                        <th>Contact</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td> $comiteOrganisation->nom }}&nbsp; $comiteOrganisation->prenom }}</td>
                                        <td> $comiteOrganisation->etablissement->libelle }}</td>
                                        <td> $comiteOrganisation->email }}&nbsp;/ $comiteOrganisation->tel }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                        </div>
                    </div>

                    @if ($contributeurs != null)
                    <div class="card" id="contribution">
                        <div class="card-header">
                            <h4>Contribution</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Catégorie</th>
                                        <th>Nom</th>
                                        <th>Montant</th>
                                        <th>Nature</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contributeurs as $contributeur )
                                    <tr>
                                        <td> $contributeur->typeContributeur->libelle }}</td>
                                        <td>
                                            @if ($contributeur->nom !='')
                                            {{ $contributeur->nom }}
                                            @endif
                                        </td>
                                        <td>{{ $contributeur->montant }}&nbsp;DH</td>
                                        <td>{{ $contributeur->natureContribution->libelle }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                        </div>
                    </div>
                    @endif
                    <div class="card" id="soutienSollicite">
                        <div class="card-header">
                            <h4>Soutien sollicité</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th class="text-center">Rubrique</th>
                                        <th class="text-center">Nombre demandé</th>
                                        <th class="text-center">Montant demandé</th>
                                        <th class="text-center">Nombre accordé</th>
                                        <th class="text-center">Montant accordé</th>
                                    </tr>
                                    @for ($i = 0; $i < sizeof($soutienSollicite); $i++) <tr>
                                        <td class="text-center">{{ $soutienSollicite[$i]->libelle }} &nbsp;({{
                                            $soutienSollicite[$i]->forfait }})
                                        </td>
                                        <td class="">{{ $soutienSollicite[$i]->pivot->nbr }}</td>
                                        <td class="text-center">{{ $soutienSollicite[$i]->pivot->montant }} &nbsp;&nbsp;
                                            <i class="fa fa-info-circle" aria-hidden="true" data-container="body"
                                                data-toggle="popover" data-placement="right"
                                                data-content="{{ $soutienSollicite[$i]->pivot->remarques }}"
                                                role="button">
                                            </i>
                                        </td>
                                        <td class="text-right"><input class="form-control text-right" type="number"
                                                disabled name="" id="" value="{ $soutienAccorde[$i]->pivot->nbr }}">
                                        </td>
                                        <td class="text-right"><input class="form-control montantOk text-right"
                                                type="number" disabled id=""
                                                value="{ $soutienAccorde[$i]->pivot->montant }}">
                                        </td>
                                        </tr>
                                        @endfor

                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>Total demandé</th>
                                        <th class="text-right"><input class="form-control" disabled type="number"
                                                name="" id=""
                                                value="{{ $demande->manifestation->soutienSollicite()->sum('montant') }}">
                                        </th>
                                        <th>Total accordé</th>
                                        <th class="text-right"><input class="form-control totalmontant text-right"
                                                disabled type="number" name="totalmontant" id="totalmontant"
                                                value="{{ $demande->manifestation->soutienAccorde()->sum('montant') }}">
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-right">
                    Copyright &copy; Made with 🧡 by EL OUADI, KHADIM and EL AIMANI
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>
</body>

</html>
