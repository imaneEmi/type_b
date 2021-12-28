@extends('layouts.main_user')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Créer une demande</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Demandes</div>
                <div class="breadcrumb-item">Créer une demande</div>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger alert-has-icon">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @isset($message)
            <div class="alert alert-warning alert-has-icon">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Warning</div>
                    Vous ne pouvez pas créer de demande, car ,une demande appartenant a votre structurene contient pas
                    le rapport!
                </div>
            </div>
        @else
            <div class="steps">
                <div class="step ">
                    <p>
                    </p>
                    <div class="bullet">
                        <span>1</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p>
                    </p>
                    <div class="bullet">
                        <span>2</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p>
                    </p>
                    <div class="bullet">
                        <span>3</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p>
                    </p>
                    <div class="bullet">
                        <span>4</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
            </div>
            <div class="section-body">
                <div class="container">
                    <div class="form-outer">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('create.request.store') }}"
                              id="manifestationForm">
                            @csrf
                            <div class="page slide-page">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Informations concernant la manifestation</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label> Intitulé de la manifestation <label
                                                            style="color: red ">*</label> </label>
                                                    <input type="text" class="form-control" name="intitule" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Type(Workshop...) <label
                                                            style="color: red ">*</label></label>
                                                    <input type="text" class="form-control" name="type" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Lieu <label style="color: red ">*</label></label>
                                                    <input type="text" class="form-control" name="lieu" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Etendue(Locale,Régionale...) <label
                                                            style="color: red ">*</label></label>
                                                    <input type="text" class="form-control" name="etendue" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label> Site Web de la manifestation</label>
                                                    <input type="text" class="form-control" name="site_web" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Agence organisatrice </label>
                                                    <input type="text" class="form-control" name="agence_organisatrice"
                                                           required="">
                                                </div>
                                                <div class="form-group">
                                                    <label> Partenaire(s) impliqué(s) <label
                                                            style="color: red ">*</label> </label>
                                                    <input type="text" class="form-control" name="partenaires"
                                                           required="">
                                                </div>
                                                <div class="section-title mt-0"></div>
                                                <div class="form-group">
                                                    <label>Etablissement(s) de l’UCAM impliqué(s) dans
                                                        l’organisation </label>
                                                    <select class="custom-select" name="etablissements_organisateur[]"
                                                            id="etablissements_organisateur" multiple="multiple"
                                                            data-height="100%">
                                                        @foreach ($etablissements as $etablissement)
                                                            <option value="{{$etablissement->id}}"
                                                                    id="{{$etablissement->id}}"
                                                                    selected>{{$etablissement->nom}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Numbre etudiants locaux <label
                                                                    style="color: red ">*</label> </label>
                                                            <input type="number" class="form-control"
                                                                   name="nbr_etudiants_locaux" min="0" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <label>Liste des etudiants locaux <label
                                                                style="color: red ">*</label></label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile"
                                                                   name="file_nbr_etudiants_locaux" required>
                                                            <label class="custom-file-label" for="customFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Numbre enseignants locaux <label style="color: red ">*</label></label>
                                                            <input type="number" class="form-control"
                                                                   name="nbr_enseignants_locaux" min="0" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <label>Liste des enseignants locaux <label
                                                                style="color: red ">*</label></label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile"
                                                                   name="file_nbr_enseignants_locaux" required>
                                                            <label class="custom-file-label" for="customFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Numbre enseignants non locaux <label
                                                                    style="color: red ">*</label> </label>
                                                            <input type="number" class="form-control"
                                                                   name="nbr_enseignants_non_locaux" min="0"
                                                                   required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label>Numbre etudiants non locaux <label
                                                                    style="color: red ">*</label></label>
                                                            <input type="number" class="form-control"
                                                                   name="nbr_etudiants_non_locaux" min="0" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label> Du <label style="color: red ">*</label></label>
                                                    <input type="date" class="form-control" name="date_debut"
                                                           required="">
                                                </div>
                                                <div class="form-group">
                                                    <label> Au <label style="color: red ">*</label></label>
                                                    <input type="date" class="form-control" name="date_fin" required="">
                                                </div>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button class="btn btn-primary firstNext next"> Suivante</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="page">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4> Comment la gestion financière est-elle prévue ?</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Libelle(Agence,Association scientifique...) <label
                                                        style="color: red ">*</label></label>
                                                <input type="text" class="form-control" id='libelle_gestion_financiere'>
                                            </div>
                                            <div class="form-group">
                                                <label>Information <label style="color: red ">*</label></label>
                                                <input type="text" min="0" class="form-control"
                                                       id='information_gestion_financiere'>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <p style="cursor:pointer" class="btn btn-primary"
                                               onclick="addGestionFinanciere(document.getElementById('libelle_gestion_financiere').value,document.getElementById('information_gestion_financiere').value );">
                                                +</p>
                                        </div>
                                        <div style="overflow-x:auto;">
                                            <table class="table " id="gestion_financiere_table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Libelle</th>
                                                    <th scope="col">Information</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Contributeurs(Sponsors,établissements)</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Nom <label style="color: red ">*</label></label>
                                                <input type="text" class="form-control" id='nom_contributeur'
                                                       name="nom_contributeur">
                                            </div>
                                            <div class="form-group">
                                                <label>Montant <label style="color: red ">*</label></label>
                                                <input type="number" min="0" class="form-control"
                                                       id='montant_contributeur' name="montant_contributeur">
                                            </div>
                                            <div class="section-title mt-0">Nature</div>
                                            <div class="form-group">
                                                <select class="custom-select" id="nature_contributeur"
                                                        name="nature_contributeur">
                                                    @foreach ($natureContributions as $natureContribution)
                                                        <option value="{{$natureContribution->id}}"
                                                                id="{{$natureContribution->libelle}}"
                                                                selected>{{$natureContribution->libelle}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <p style="cursor:pointer" class="btn btn-primary"
                                               onclick="addContributeur(document.getElementById('nom_contributeur').value,document.getElementById('montant_contributeur').value,$('#nature_contributeur').children(':selected').attr('id'),document.getElementById('nature_contributeur').value );">
                                                +</p>
                                        </div>
                                        <div style="overflow-x:auto;">
                                            <table class="table " id="contributeurs_table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Montant</th>
                                                    <th scope="col">Nature</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer text-right">
                                            <p class="btn btn-primary prev-1 prev"> Précédente </p>
                                            <p class="btn btn-primary next-1 next"> Suivante </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="page">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Contribution des participants</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="section-title mt-0"></div>
                                                <label> Les frais d’inscription couvrent </label>
                                                <select class="custom-select" name="typeContributeurs[]"
                                                        id="type_contributeurs" multiple="multiple" data-height="100%">
                                                    @foreach ($typeContributeurs as $typeContributeur)
                                                        <option value="{{$typeContributeur->id}}"
                                                                id="{{$typeContributeur->id}}"
                                                                selected>{{$typeContributeur->libelle}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Nom <label style="color: red ">*</label></label>
                                                <input type="text" class="form-control"
                                                       id='nom_contribution_participant'>
                                            </div>
                                            <div class="form-group">
                                                <label>Montant <label style="color: red ">*</label></label>
                                                <input type="number" min="0" class="form-control"
                                                       id='montant_contribution_participant'>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <p style="cursor:pointer" class="btn btn-primary"
                                               onclick="addContributionParticipant(document.getElementById('nom_contribution_participant').value ,document.getElementById('montant_contribution_participant').value );">
                                                +</p>
                                        </div>
                                        <div style="overflow-x:auto;">
                                            <table class="table " id="contribution_participants_table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Montant</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer text-right">
                                            <p class="btn btn-primary prev-2 prev"> Précédente </p>
                                            <p class="btn btn-primary next-2 next"> Suivante </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="page">
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Comité d'organisation local</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="section-title mt-0"></div>
                                                <label> Les frais d’inscription couvrent </label>
                                                <select class="js-example-basic-multiple"
                                                        name="comiteOrganisationLocal[]"
                                                        multiple="multiple">
                                                    @foreach ($chercheurs as $chercheur)
                                                        <option value="{{$chercheur->id_cher}}"
                                                                id="{{$chercheur->id_cher}}"
                                                        >{{$chercheur->nom}} {{$chercheur->prenom}}
                                                            ({{$chercheur->laboratoire->etablissement->nom}}
                                                            /{{$chercheur->laboratoire->nom}} )
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Comité d'organisation non local</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Nom <label style="color: red ">*</label></label>
                                                <input type="text" class="form-control" id="nom_organisateur_non_local">
                                            </div>
                                            <div class="form-group">
                                                <label> prénom <label style="color: red ">*</label></label>
                                                <input type="text" class="form-control"
                                                       id="prenom_organisateur_non_local">
                                            </div>
                                            <div class="form-group">
                                                <label> Tel</label>
                                                <input type="tel" class="form-control" id="tel_organisateur_non_local">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control"
                                                       id="email_organisateur_non_local">
                                            </div>
                                            <div class="form-group">
                                                <label> Université</label>
                                                <input type="text" class="form-control"
                                                       id="universite_organisateur_non_local">
                                            </div>

                                            <div class="form-group">
                                                <label> établissement</label>
                                                <input type="text" class="form-control"
                                                       id="etablissement_organisateur_non_local">
                                            </div>
                                            <div class="form-group">
                                                <label> ville</label>
                                                <input type="text" class="form-control"
                                                       id="ville_organisateur_non_local">
                                            </div>

                                            <div class="card-footer text-right">
                                                <p style="cursor:pointer" class="btn btn-primary"
                                                   onclick="addOrganisateurNonLocal(document.getElementById('tel_organisateur_non_local').value,document.getElementById('nom_organisateur_non_local').value ,document.getElementById('prenom_organisateur_non_local').value,document.getElementById('email_organisateur_non_local').value,document.getElementById('etablissement_organisateur_non_local').value ,document.getElementById('universite_organisateur_non_local').value,document.getElementById('ville_organisateur_non_local').value);">
                                                    +</p>
                                            </div>
                                            <div style="overflow-x:auto;">
                                                <table class="table " id="organisateurs_non_local_table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">nom & prénom</th>
                                                        <th scope="col">établissement</th>
                                                        <th scope="col">email</th>
                                                        <th scope="col">tel</th>
                                                        <th scope="col">université</th>
                                                        <th scope="col">ville</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Comité scientifique local</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Nom <label style="color: red ">*</label></label>
                                                <input type="text" class="form-control"
                                                       id="nom_comite_scientifique_local">
                                            </div>
                                            <div class="form-group">
                                                <label> Prénom <label style="color: red ">*</label></label>
                                                <input type="text" class="form-control"
                                                       id="prenom_comite_scientifique_local">
                                            </div>
                                            <div class="form-group">
                                                <label> Tel</label>
                                                <input type="tel" class="form-control"
                                                       id="tel_comite_scientifique_local">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control"
                                                       id="email_comite_scientifique_local">
                                            </div>
                                            <div class="form-group">
                                                <label> type de l'entité</label>
                                                <input type="text" class="form-control"
                                                       id="type_entite_comite_scientifique_local">
                                            </div>
                                            <div class="form-group">
                                                <label>nom de l'entité</label>
                                                <input type="text" class="form-control"
                                                       id="nom_entite_comite_scientifique_local">
                                            </div>
                                            <div class="card-footer text-right">
                                                <p style="cursor:pointer" class="btn btn-primary"
                                                   onclick="addComiteScientifiqueLocal(document.getElementById('nom_comite_scientifique_local').value,document.getElementById('prenom_comite_scientifique_local').value ,document.getElementById('tel_comite_scientifique_local').value,document.getElementById('email_comite_scientifique_local').value,document.getElementById('type_entite_comite_scientifique_local').value ,document.getElementById('nom_entite_comite_scientifique_local').value);">
                                                    +</p>
                                            </div>
                                            <div style="overflow-x:auto;">
                                                <table class="table " id="comite_scientifique_local_table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">nom & prénom</th>
                                                        <th scope="col">email</th>
                                                        <th scope="col">tel</th>
                                                        <th scope="col">type de l'entité</th>
                                                        <th scope="col">nom de l'entité</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Comité scientifique non local</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Nom <label style="color: red ">*</label></label>
                                                <input type="text" class="form-control"
                                                       id="nom_comite_scientifique_non_local">
                                            </div>
                                            <div class="form-group">
                                                <label> Prénom <label style="color: red ">*</label></label>
                                                <input type="text" class="form-control"
                                                       id="prenom_comite_scientifique_non_local">
                                            </div>
                                            <div class="form-group">
                                                <label> Tel</label>
                                                <input type="tel" class="form-control"
                                                       id="tel_comite_scientifique_non_local">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control"
                                                       id="email_comite_scientifique_non_local">
                                            </div>
                                            <div class="form-group">
                                                <label> type de l'entité</label>
                                                <input type="text" class="form-control"
                                                       id="type_entite_comite_scientifique_non_local">
                                            </div>
                                            <div class="form-group">
                                                <label>nom de l'entité</label>
                                                <input type="text" class="form-control"
                                                       id="nom_entite_comite_scientifique_non_local">
                                            </div>
                                            <div class="form-group">
                                                <label>pays</label>
                                                <input type="text" class="form-control"
                                                       id="pays_entite_comite_scientifique_non_local">
                                            </div>
                                            <div class="card-footer text-right">
                                                <p style="cursor:pointer" class="btn btn-primary"
                                                   onclick="addComiteScientifiqueNonLocal(document.getElementById('nom_comite_scientifique_non_local').value,document.getElementById('prenom_comite_scientifique_non_local').value ,document.getElementById('tel_comite_scientifique_non_local').value,document.getElementById('email_comite_scientifique_non_local').value,document.getElementById('type_entite_comite_scientifique_non_local').value ,document.getElementById('nom_entite_comite_scientifique_non_local').value,document.getElementById('pays_entite_comite_scientifique_non_local').value);">
                                                    +</p>
                                            </div>
                                            <div style="overflow-x:auto;">
                                                <table class="table " id="comite_scientifique_non_local_table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">nom & prénom</th>
                                                        <th scope="col">email</th>
                                                        <th scope="col">tel</th>
                                                        <th scope="col">type de l'entité</th>
                                                        <th scope="col">nom de l'entité</th>
                                                        <th scope="col">pays</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Soutien sollicité de l’Université</h4>
                                        </div>
                                        <div class="card-body">
                                            <div id="accordion">
                                                @foreach ($fraisCouvert as $fr)
                                                    <div class="accordion">
                                                        <div class="accordion-header" role="button"
                                                             data-toggle="collapse"
                                                             data-target="#panel-body-{{$fr->id}}" aria-expanded="true">
                                                            <h4>{{$fr->libelle}}</h4>
                                                        </div>
                                                        <div class="accordion-body collapse "
                                                             id="panel-body-{{$fr->id}}" data-parent="#accordion">
                                                            @if($fr->forfait!="")
                                                                <p class="mb-0">Forfait: {{$fr->forfait}}</p>
                                                            @endif
                                                            @if($fr->unite!="")
                                                                <p class="mb-0">Unité: {{$fr->unite}}</p>
                                                            @endif
                                                            @if($fr->limite!="")
                                                                <p class="mb-0">Limite: {{$fr->limite}}</p>
                                                            @endif
                                                            @if($fr->description!="")
                                                                <p class="mb-0">Description: {{$fr->description}}</p>
                                                            @endif

                                                            <input type="checkbox" name="frais-ouvert-{{$fr->id}}"
                                                                   id="frais-ouvert-{{$fr->id}}">
                                                            <div class="form-group">
                                                                <label> Nombre</label>
                                                                <input type="number" min="0" class="form-control"
                                                                       id='nombre_frais_ouvert_{{$fr->id}}'
                                                                       name="nombre_frais_ouvert_{{$fr->id}}"
                                                                       required="" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Montant (DH)</label>
                                                                <input type="number" min="0" class="form-control"
                                                                       id='montant_frais_ouvert_{{$fr->id}}'
                                                                       name="montant_frais_ouvert_{{$fr->id}}"
                                                                       required="" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label> Remarques</label>
                                                                <input type="text" class="form-control"
                                                                       id='remarques_frais_ouvert_{{$fr->id}}'
                                                                       name="remarques_frais_ouvert_{{$fr->id}}"
                                                                       required="" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Pièces</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Liste des pieces </label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile"
                                                           name="pieces[]" multiple required>
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        files</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <p class="btn btn-primary prev-3 prev">Précédente </p>
                                            <p class="btn btn-primary" id="submitManifestationForm">Créer </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endisset
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var comiteOrganisationNonLocal = []
        var comiteScientifiqueLocal = []
        var comiteScientifiqueNonLocal = []
        var contributeurs = []
        var gestionFinanciere = []
        var contributionParticipants = []
        var comiteOrganisationNonLocalCount = 0
        var comiteScientifiqueLocalCount = 0
        var comiteScientifiqueNonLocalCount = 0
        var contributeurCount = 0
        var contributionParticipantsCount = 0
        var gestionFinanciereCount = 0

        function addOrganisateurNonLocal(tel_organisateur, nom_organisateur, prenom_organisateur, email_organisateur, etablissement_organisateur, universite_organisateur, ville_organisateur) {

            tel_organisateur = tel_organisateur.trim()
            nom_organisateur = nom_organisateur.trim()
            email_organisateur = email_organisateur.trim()
            prenom_organisateur = prenom_organisateur.trim()
            universite_organisateur = universite_organisateur.trim()
            ville_organisateur = ville_organisateur.trim()
            etablissement_organisateur = etablissement_organisateur.trim()
            if (nom_organisateur != "" && prenom_organisateur != "") {
                var organisateur = {
                    nom: nom_organisateur,
                    prenom: prenom_organisateur,
                    tel: tel_organisateur,
                    email: email_organisateur,
                    etablissement: etablissement_organisateur,
                    ville: ville_organisateur,
                    universite: universite_organisateur
                }
                comiteOrganisationNonLocal[comiteOrganisationNonLocalCount] = organisateur;
                comiteOrganisationNonLocalCount = comiteOrganisationNonLocalCount + 1
                var HtmlContent = " <tr><td>" + nom_organisateur + " " + prenom_organisateur + " </td> <td>" + etablissement_organisateur + " </td><td>" + email_organisateur + " </td><td>" + tel_organisateur + " </td><td>" + universite_organisateur + " </td><td>" + ville_organisateur + " </td><td> <button  class='btn btn-icon btn-danger' onClick='deleteOrganisateurNonLocalRow(this);'><i class='fas fa-times'></i></button> </td></tr>"
                var tableRef = document.getElementById('organisateurs_non_local_table').getElementsByTagName('tbody')[0];
                var newRow = tableRef.insertRow(tableRef.rows.length);
                newRow.innerHTML = HtmlContent;

                $('#tel_organisateur_non_local').val('')
                $('#nom_organisateur_non_local').val('')
                $('#email_organisateur_non_local').val('')
                $('#prenom_organisateur_non_local').val('')
                $('#ville_organisateur_non_local').val('')
                $('#universite_organisateur_non_local').val('')
                $('#etablissement_organisateur_non_local').val('')
            } else {

            }

        }

        function addComiteScientifiqueLocal(nom, prenom, tel, email, type_entite, nom_entite) {

            nom = nom.trim()
            prenom = prenom.trim()
            tel = tel.trim()
            email = email.trim()
            type_entite = type_entite.trim()
            nom_entite = nom_entite.trim()
            if (nom != "" && prenom != "") {
                var organisateur = {
                    nom: nom,
                    prenom: prenom,
                    tel: tel,
                    email: email,
                    type_entite: type_entite,
                    nom_entite: nom_entite,
                }
                comiteScientifiqueLocal[comiteScientifiqueLocalCount] = organisateur;
                comiteScientifiqueLocalCount = comiteScientifiqueLocalCount + 1
                var HtmlContent = " <tr><td>" + nom + " " + prenom + " </td> <td>" + email + " </td><td>" + tel + " </td><td>" + type_entite + " </td><td>" + nom_entite + " </td><td> <button  class='btn btn-icon btn-danger' onClick='deleteComiteScientifiqueLocalRow(this);'><i class='fas fa-times'></i></button> </td></tr>"
                var tableRef = document.getElementById('comite_scientifique_local_table').getElementsByTagName('tbody')[0];
                var newRow = tableRef.insertRow(tableRef.rows.length);
                newRow.innerHTML = HtmlContent;


                $('#nom_comite_scientifique_local').val('')
                $('#prenom_comite_scientifique_local').val('')
                $('#tel_comite_scientifique_local').val('')
                $('#email_comite_scientifique_local').val('')
                $('#type_entite_comite_scientifique_local').val('')
                $('#nom_entite_comite_scientifique_local').val('')
            } else {

            }
        }

        function addComiteScientifiqueNonLocal(nom, prenom, tel, email, type_entite, nom_entite, pays) {

            nom = nom.trim()
            prenom = prenom.trim()
            tel = tel.trim()
            email = email.trim()
            type_entite = type_entite.trim()
            nom_entite = nom_entite.trim()
            pays = pays.trim()
            if (nom != "" && prenom != "") {
                var organisateur = {
                    nom: nom,
                    prenom: prenom,
                    tel: tel,
                    email: email,
                    type_entite: type_entite,
                    nom_entite: nom_entite,
                    pays: pays
                }
                comiteScientifiqueNonLocal[comiteScientifiqueNonLocalCount] = organisateur;
                comiteScientifiqueNonLocalCount = comiteScientifiqueNonLocalCount + 1
                var HtmlContent = " <tr><td>" + nom + " " + prenom + " </td> <td>" + email + " </td><td>" + tel + " </td><td>" + type_entite + " </td><td>" + nom_entite + " </td><td>" + pays + " </td><td> <button  class='btn btn-icon btn-danger' onClick='deleteComiteScientifiqueNonLocalRow(this);'><i class='fas fa-times'></i></button> </td></tr>"
                var tableRef = document.getElementById('comite_scientifique_non_local_table').getElementsByTagName('tbody')[0];
                var newRow = tableRef.insertRow(tableRef.rows.length);
                newRow.innerHTML = HtmlContent;


                $('#nom_comite_scientifique_non_local').val('')
                $('#prenom_comite_scientifique_non_local').val('')
                $('#tel_comite_scientifique_non_local').val('')
                $('#email_comite_scientifique_non_local').val('')
                $('#type_entite_comite_scientifique_non_local').val('')
                $('#nom_entite_comite_scientifique_non_local').val('')
                $('#pays_entite_comite_scientifique_non_local').val('')
            } else {

            }
        }

        function addContributeur(nom_contributeur, montant_contributeur, nature_contributeur, id_nature_contributeur) {
            nom_contributeur = nom_contributeur.trim()
            montant_contributeur = montant_contributeur.trim()
            nature_contributeur = nature_contributeur.trim()

            if (nature_contributeur != "" && montant_contributeur != "" && nom_contributeur != "") {
                var contributeur = {
                    nom: nom_contributeur,
                    montant: montant_contributeur,
                    nature_contribution_id: id_nature_contributeur,
                }
                contributeurs[contributeurCount] = contributeur;
                contributeurCount = contributeurCount + 1
                var HtmlContent = " <tr><td>" + nom_contributeur + " </td> <td>" + montant_contributeur + " </td><td>" + nature_contributeur + " </td><td> <button  class='btn btn-icon btn-danger' onClick='deleteContributeurRow(this);'><i class='fas fa-times'></i></button> </td></tr>"
                var tableRef = document.getElementById('contributeurs_table').getElementsByTagName('tbody')[0];
                var newRow = tableRef.insertRow(tableRef.rows.length);
                newRow.innerHTML = HtmlContent;

                $('#nom_contributeur').val('')
                $('#montant_contributeur').val('')

            } else {

            }

        }

        function addContributionParticipant(nom_contributeur, montant_contributeur) {
            nom_contributeur = nom_contributeur.trim()
            montant_contributeur = montant_contributeur.trim()

            if (montant_contributeur != "" && nom_contributeur != "") {
                var contributeur = {
                    nom: nom_contributeur,
                    montant: montant_contributeur,
                }
                contributionParticipants[contributionParticipantsCount] = contributeur;
                contributionParticipantsCount = contributionParticipantsCount + 1
                var HtmlContent = " <tr><td>" + nom_contributeur + " </td> <td>" + montant_contributeur + " </td><td> <button  class='btn btn-icon btn-danger' onClick='deleteContributionParticipantRow(this);'><i class='fas fa-times'></i></button> </td></tr>"
                var tableRef = document.getElementById('contribution_participants_table').getElementsByTagName('tbody')[0];
                var newRow = tableRef.insertRow(tableRef.rows.length);
                newRow.innerHTML = HtmlContent;

                $('#nom_contribution_participant').val('')
                $('#montant_contribution_participant').val('')

            } else {

            }

        }

        function addGestionFinanciere(libelle_gestion_financiere, information_gestion_financiere) {
            libelle_gestion_financiere = libelle_gestion_financiere.trim()
            information_gestion_financiere = information_gestion_financiere.trim()

            if (libelle_gestion_financiere != "" && information_gestion_financiere != "") {
                var gf = {
                    libelle: libelle_gestion_financiere,
                    information: information_gestion_financiere,
                }
                gestionFinanciere[gestionFinanciereCount] = gf;
                gestionFinanciereCount = gestionFinanciereCount + 1
                var HtmlContent = " <tr><td>" + libelle_gestion_financiere + "</td><td> " + information_gestion_financiere + " </td><td> <button  class='btn btn-icon btn-danger' onClick='deleteGestionFinanciereRow(this);'><i class='fas fa-times'></i></button> </td></tr>"
                var tableRef = document.getElementById('gestion_financiere_table').getElementsByTagName('tbody')[0];
                var newRow = tableRef.insertRow(tableRef.rows.length);
                newRow.innerHTML = HtmlContent;

                $('#information_gestion_financiere').val('')
                $('#libelle_gestion_financiere').val('')

            } else {

            }

        }


        function deleteOrganisateurNonLocalRow(row) {
            var i = row.parentNode.parentNode.rowIndex;
            comiteOrganisation.splice((i - 1), 1)
            document.getElementById('organisateurs_non_local_table').deleteRow(i);
        }

        function deleteComiteScientifiqueLocalRow(row) {
            var i = row.parentNode.parentNode.rowIndex;
            comiteOrganisation.splice((i - 1), 1)
            document.getElementById('comite_scientifique_local_table').deleteRow(i);
        }

        function deleteComiteScientifiqueNonLocalRow(row) {
            var i = row.parentNode.parentNode.rowIndex;
            comiteOrganisation.splice((i - 1), 1)
            document.getElementById('comite_scientifique_non_local_table').deleteRow(i);
        }


        function deleteContributeurRow(row) {
            var i = row.parentNode.parentNode.rowIndex;
            contributeurs.splice((i - 1), 1)
            document.getElementById('contributeurs_table').deleteRow(i);
        }

        function deleteContributionParticipantRow(row) {
            var i = row.parentNode.parentNode.rowIndex;
            contributeurs.splice((i - 1), 1)
            document.getElementById('contribution_participants_table').deleteRow(i);
        }

        function deleteGestionFinanciereRow(row) {
            var i = row.parentNode.parentNode.rowIndex;
            gestionFinanciere.splice((i - 1), 1)
            console.log(gestionFinanciere)

            document.getElementById('gestion_financiere_table').deleteRow(i);
        }

        var fraisOuvert = <?php echo json_encode($fraisCouvert); ?>;
        for (var i = 0; i < fraisOuvert.length; i++) {
            $('#frais-ouvert-' + fraisOuvert[i].id).change(
                function () {
                    var str = 'frais-ouvert-'
                    var id = this.name.slice(str.length)
                    if ($(this).is(':checked')) {
                        $('#nombre_frais_ouvert_' + id).prop("disabled", false);
                        $('#montant_frais_ouvert_' + id).prop("disabled", false);
                        $('#remarques_frais_ouvert_' + id).prop("disabled", false);
                    } else {
                        $('#nombre_frais_ouvert_' + id).prop("disabled", true);
                        $('#montant_frais_ouvert_' + id).prop("disabled", true);
                        $('#remarques_frais_ouvert_' + id).prop("disabled", true);

                    }
                });
        }
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
        $("#submitManifestationForm").on('click', function (eventObj) {
            $("<input />").attr("type", "hidden")
                .attr("name", "contributeurs")
                .attr("value", JSON.stringify(contributeurs))
                .appendTo("#manifestationForm");
            $("<input />").attr("type", "hidden")
                .attr("name", "gestionFinanciere")
                .attr("value", JSON.stringify(gestionFinanciere))
                .appendTo("#manifestationForm");
            $("<input />").attr("type", "hidden")
                .attr("name", "contributionParticipants")
                .attr("value", JSON.stringify(contributionParticipants))
                .appendTo("#manifestationForm");
            $("<input />").attr("type", "hidden")
                .attr("name", "comiteOrganisationNonLocal")
                .attr("value", JSON.stringify(comiteOrganisationNonLocal))
                .appendTo("#manifestationForm");
            $("<input />").attr("type", "hidden")
                .attr("name", "comiteScientifiqueLocal")
                .attr("value", JSON.stringify(comiteScientifiqueLocal))
                .appendTo("#manifestationForm");
            $("<input />").attr("type", "hidden")
                .attr("name", "comiteScientifiqueNonLocal")
                .attr("value", JSON.stringify(comiteScientifiqueNonLocal))
                .appendTo("#manifestationForm");

            Swal.fire({
                title: 'Attention!!',
                text: 'Something went wrong!',
                icon: 'error',
                confirmButtonText: "Oui",
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#manifestationForm").submit();
                }
            })

        });
    </script>
@endsection
