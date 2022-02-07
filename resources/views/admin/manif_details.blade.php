<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $manifestation->intitule }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="{{asset('assets/img/uca-logo.png')}}" rel="icon">
    <link href="{{asset('assets/assets/img/uca-logo.png')}}" rel="apple-touch-icon">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('../assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('../assets/css/components.css')}}">
    <link rel="stylesheet" href="{{asset('../assets/css/customStyle.css')}}">
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
                                <li class="nav-item"><a href="#comite" class="nav-link">Comité d'organisation</a></li>
                                <li class="nav-item"><a href="#comiteS" class="nav-link">Comité scientifique</a></li>
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
                        <li class="nav-item dropdown">
                            <a href="#piecesFournies" class="nav-link"><i class="far fa-clone"></i>
                                <span>Piéces fournies</span></a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    @if(Session::get('success') != null)
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ Session::get('success') }}
                        </div>
                    </div>
                    @endif
                    @if(Session::get('error') != null)
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ Session::get('error') }}
                        </div>
                    </div>
                    @endif
                    <div class="section-header">
                        <h1>{{ $manifestation->intitule }}</h1>
                        <div class="section-header-breadcrumb">
                            <div class="d-inline m-3">
                                <span>
                                    @if($demande->etat === \App\Models\DemandeStatus::ACCEPTEE &&
                                    $demande->manifestation->lettreAcceptation != null)
                                    <a href="{{route('manifastation.lettre',['url'=>Str::replace('/','-',$demande->manifestation->lettreAcceptation->url)])}}"
                                       target="_blank" title="Lettre d'acceptation"><i class="fa fa-file-pdf fa-lg"
                                            aria-hidden="true"></i>
                                    </a>
                                    @endif
                                </span>
                            </div>
                            @if ($demande->etat ===\App\Models\DemandeStatus::ACCEPTEE &&
                            $demande->manifestation->lettreAcceptation == null)
                            <div class="d-inline m-3">
                                <span><a href="#" id="upload" title="Télécharger la lettre d'acceptation">
                                        <i class="fa fa-upload fa-lg"></i>
                                    </a>
                                </span>
                            </div>
                            @endif
                            @if ($demande->etat === \App\Models\DemandeStatus::ACCEPTEE || $demande->etat ===
                            \App\Models\DemandeStatus::ENCOURS)
                            <div class="d-inline">
                                <span>
                                    <a href="{{ route('pdf',['id'=>$demande->id]) }}" target="_blank"
                                        title="Télécharger Fiche traitement de dossier"><i
                                            class="fa fa-download fa-lg"></i>
                                    </a>
                                </span>
                            </div>

                            @endif
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
                                @if ( $manifestation->site_web != null)
                                <i class="fas fa-globe mr-1"></i>Site web: <a href="{{ $manifestation->site_web}}"> {{
                                    $manifestation->site_web}}</a>
                                @endif
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
                                            <th>Ville</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($etablissements as $etablissement )
                                        @if ($etablissement != null)
                                        <tr>
                                            <td>{{ $etablissement->nom }}</td>
                                            <td>{{ $etablissement->ville }}</td>
                                        </tr>
                                        @endif
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
                                            <td>{{ $entiteOrganisatrice->responsable->nom }}</td>
                                            <td>{{ $entiteOrganisatrice->etablissement->nom }}</td>
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
                                @if ($coordonnateur == null)
                                <span class="text-danger">!! Introuvable !!</span>
                                @else
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Nom Prenom</th>
                                            <th>Specialité</th>
                                            <th>Grade</th>
                                            <th>Etablissement</th>
                                            <th>E-mail</th>
                                            <th>N° tel personnel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $coordonnateur->nom }}&nbsp;{{ $coordonnateur->prenom }}</td>
                                            <td>{{ $coordonnateur->specialite }}</td>
                                            <td>{{ $coordonnateur->grade }}</td>
                                            <td>{{ $coordonnateur->laboratoire->etablissement->nom }}</td>
                                            <td>{{ $coordonnateur->email }}</td>
                                            <td>{{ $coordonnateur->tel }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif
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
                            <h5>Local</h5>
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>NOM Prénom</th>
                                        <th>Contact (email/tel)</th>
                                        <th>Etablissement</th>
                                    </tr>
                                </thead>
                                @if($membresComiteOrganisationsLocal != null)
                                <tbody>
                                    @foreach ($membresComiteOrganisationsLocal as $membre)
                                    @if($membre != null)
                                    <tr>
                                        <td><span class="text-uppercase mr-1">{{ $membre->nom
                                                }}</span>
                                            <span class="text-capitalize">{{ $membre->prenom
                                                }}</span>
                                        </td>
                                        <td>{{ $membre->email }}&nbsp;/{{
                                            $membre->tel }}</td>
                                        <td class="text-capitalize">{{
                                            $membre->laboratoire->etablissement->nom }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                            <h5>Non local</h5>
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>NOM Prénom</th>
                                        <th>Contact</th>
                                        <th>Université / Etablissement</th>
                                        <th>Ville</th>
                                    </tr>
                                </thead>
                                @if ($comiteOrganisationsNonLocal != null)
                                <tbody>
                                    @foreach ($comiteOrganisationsNonLocal as $comite )
                                    @if ($comite != null)
                                    <tr>
                                        <td><span class="mr-1 text-uppercase">{{ $comite->nom }}</span>
                                            <span class="text-capitalize">{{ $comite->prenom }}</span>
                                        </td>
                                        <td> <span class="mr-1">{{ $comite->email }}</span>
                                            <span>/ {{ $comite->tel }}</span>
                                        </td>
                                        <td><span class="mr-1 text-capitalize">{{ $comite->universite }}</span>
                                            <span class="text-capitalize">/ {{ $comite->etablissement }}</span>
                                        </td>
                                        <td class="text-uppercase">{{ $comite->ville }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                        </div>
                    </div>
                    <div class="card" id="comiteS">
                        <div class="card-header">
                            <h4>Comité scientifique</h4>
                        </div>
                        <div class="card-body">
                            <h5>Local</h5>
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>NOM Prénom</th>
                                        <th>Contact</th>
                                        <th>Entité</th>
                                        <th>Université / Etablissement</th>
                                        <th>Ville</th>
                                    </tr>
                                </thead>
                                @if ($comiteScientifiqueLocal != null)
                                <tbody>
                                    @foreach ($comiteScientifiqueLocal as $comite )
                                    @if ($comite != null)
                                    <tr>
                                        <td><span class="mr-1 text-uppercase">{{ $comite->nom }}</span>
                                            <span class="text-capitalize">{{ $comite->prenom }}</span>
                                        </td>
                                        <td> <span class="mr-1">{{ $comite->email }}</span>
                                            <span>/ {{ $comite->tel }}</span>
                                        </td>
                                        <td><span class="mr-1 text-capitalize">{{ $comite->type_entite }}:</span>
                                            <span class="text-capitalize"> {{ $comite->nom_entite }}</span>
                                        </td>
                                        <td><span class="mr-1 text-capitalize">{{ $comite->universite }}</span>
                                            <span class="text-capitalize">/ {{ $comite->etablissement }}</span>
                                        </td>
                                        <td class="text-uppercase">{{ $comite->ville }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                            <h5>Non local</h5>
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>NOM Prénom</th>
                                        <th>Contact</th>
                                        <th>Entité</th>
                                        <th>Université / Etablissement</th>
                                        <th>Pays</th>
                                    </tr>
                                </thead>
                                @if ($comiteScientifiqueNonLocal != null)
                                <tbody>
                                    @foreach ($comiteScientifiqueNonLocal as $comite )
                                    @if ($comite != null)
                                    <tr>
                                        <td><span class="mr-1 text-uppercase">{{ $comite->nom }}</span>
                                            <span class="text-capitalize">{{ $comite->prenom }}</span>
                                        </td>
                                        <td> <span class="mr-1">{{ $comite->email }}</span>
                                            <span>/ {{ $comite->tel }}</span>
                                        </td>
                                        <td><span class="mr-1 text-capitalize">{{ $comite->type_entite }}:</span>
                                            <span class="text-capitalize"> {{ $comite->nom_entite }}</span>
                                        </td>
                                        <td><span class="mr-1 text-capitalize">{{ $comite->universite }}</span>
                                            <span class="text-capitalize">/ {{ $comite->etablissement }}</span>
                                        </td>
                                        <td class="text-uppercase">{{ $comite->pays }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                @endif
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
                                        <td>{{ $contributeur->typeContributeur->libelle }}</td>

                                        @if ($contributeur->nom !='')
                                        <td>
                                            {{ $contributeur->nom }}
                                        </td>
                                        @else
                                        <td>
                                            --------
                                        </td>
                                        @endif

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
                                                disabled name="" id="" @if (sizeof($soutienAccorde) !=0 )
                                                value="{{ $soutienAccorde[$i]->pivot->nbr }}" @endif>
                                        </td>
                                        <td class="text-right"><input class="form-control montantOk text-right"
                                                type="number" disabled id="" @if (sizeof($soutienAccorde) !=0 )
                                                value="{{ $soutienAccorde[$i]->pivot->montant }}" @endif>
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
                                                @if($soutienAccorde !=null)
                                                value="{{ $manifestation->soutienAccorde()->sum('montant') }}" @endif>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="piecesFournies">
                        <div class="card-header">
                            <h4>Piéces fournies</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Intitulé</th>
                                        <th>Document</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                    <tr>
                                        <td>
                                            <span class="text-capitalize">{{ $file->titre
                                                }}</span>
                                        </td>
                                        <td>
                                            <a href="{{route('manifestation.read.rapport',['url'=>Str::replace('/','-',$file->url)])}}"
                                                title="{{ $file->titre }}" target="_blank"><i class="fa fa-file-pdf fa-lg"
                                                    aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>


                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-whitesmoke">
                        </div>
                    </div>
                </section>
            </div>
            <a href="#" class="back-to-top"><i class="fas fa-angle-up mr-1"></i></a>
            <footer class="main-footer d-flex justify-content-center">
                <div class="footer-center">
                    Copyright &copy; Made with 🧡 by EL OUADI, KHADIM and EL AIMANI
                </div>
            </footer>
        </div>
    </div>
    <div hidden>
        <div id="uploadBody">
            <form method="POST" action="{{ route('upload.lettre',['id'=>$demande->id]) }}" enctype="multipart/form-data"
                id="uplodaForm">
                @csrf
                <div class="form-group">
                    <div class="custom-file">
                        <label for="customFile" class="custom-file-label">Télécharger la lettre d'acceptation</label>
                        <input type="file" class="custom-file-input" id="customFile" required name="lettre"
                            accept="application/pdf">
                    </div>
                </div>
            </form>
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
    <script src="{{asset('../assets/js/stisla.js')}}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{asset('../assets/js/scripts.js')}}"></script>
    <script src="{{asset('../assets/js/custom.js')}}"></script>
    <script src="{{asset('../assets/js/page/bootstrap-modal.js')}}"></script>
    <script type="text/javascript">
        $("#upload").fireModal({
        title: "Télécharger la lettre d'acceptation",
        body: $('#uploadBody'),
        buttons: [
            {
                text: 'Télécharger',
                class: 'btn btn-success btn-shadow',
                submit: true,
                handler: function (modal) {
                    modal.modal('toggle');
                }
            },
            {
                text: 'Annuler',
                class: 'btn btn-danger btn-shadow',
                handler: function (modal) {
                    modal.modal('toggle');
                }
            }
        ]
    });
    </script>
</body>

</html>
