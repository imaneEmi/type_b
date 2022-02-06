@extends('layouts.main_admin')

@section('title')
Traitement de dossier
@endsection
@section('content')
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
    <div class="section-header d-flex justify-content-between pl-2 pr-3">
        @if ($manifestation != null )
        <div class="d-inline mr-2"><i class="fa fa-university fa-lg mr-1 label" aria-hidden="true"></i>
            <h6 class="d-inline label mr-1">Etab: </h6>
            <span class="d-inline-block text-capitalize lead">{{ $coordonnateur->laboratoire->etablissement->nom
                }}</span>
        </div>
        <div class="d-inline"><i class="fa fa-flask fa-lg mr-1 label" aria-hidden="true"></i>
            <h6 class="d-inline label mr-1">Structure: </h6>
            <span class="d-inline-block text-capitalize lead">{{ $coordonnateur->laboratoire->nom }}</span>
        </div>
        @endif
    </div>
    <div class="d-inline d-flex justify-content-end">
        <span style="margin-right: auto">Etat:
            <span class="badge badge-light text-capitalize">{{ $demande->etat }}</span>
            <div class="float-right dropdown">
                <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                <div class="dropdown-menu">
                    <div class="dropdown-title">Options</div>
                    <a href="#" id="accepter" class="dropdown-item has-icon text-success"><i class="fas fa-check"></i>
                        Accepter</a>
                    <a href="#" id="refuser" class="dropdown-item has-icon text-danger"><i class="fas fa-times"></i>
                        Resuser</a>
                    <div class="dropdown-footer">
                    </div>
                </div>
            </div>
        </span>
        <span class="m-2">
            <a href="#" id="sendEmail" title="Envoyer un email"><i class="fa fa-envelope fa-lg"></i>
            </a>
        </span>
        @if ($demande->editable)
        <span class="m-2">
            <a href="#" id="disableUpload" title="Désactiver l'upload de nouveaux documents"><i
                    class="fas fa-toggle-on fa-5x"></i>
            </a>
        </span>
        @endif
        <span class="m-2">
            <a href="{{ route('pdf',['id'=>$demande->id]) }}" title="Télécharger fiche traitement de dossier"><i
                    class="fa fa-download fa-lg"></i>
            </a>
        </span>
        <span class="m-2">
            <a href="{{ route('manifestation.details',['id'=>$demande->id]) }}" title="Plus de détails"><i
                    class="fa fa-plus fa-lg"></i>
            </a>
        </span>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <div class="d-inline mr-3">
                            <h6 class="d-inline label mr-1"><i class="fa fa-tag label mr-1"
                                    aria-hidden="true"></i>Titre: </h6>
                            <span class="d-inline-block text-capitalize lead">
                                {{ $manifestation->intitule }}
                            </span>
                        </div>
                        <div class="d-inline">
                            <h6 class="d-inline label mr-1"><i class="fa fa-user fa-lg mr-1 label"
                                    aria-hidden="true"></i>Demandeur: </h6>
                            <span class="d-inline-block text-uppercase lead mr-1">el aimani</span>
                            <span class="text-capitalize lead"> {{$coordonnateur->prenom }}</span>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-whitesmoke">
                        <div class="d-inline mr-2">
                            <i class="fa fa-calendar fa-lg mr-1 label" aria-hidden="true"></i>
                            <h6 class="d-inline label mr-1">Lieu&Date:</h6>
                            <h5 class="d-inline text-muted"><span class="text-uppercase">{{ $manifestation->lieu
                                    }}</span> - <span class="label">Du</span>
                                {{ $manifestation->date_debut->format('d/m/Y') }}
                                <span class="label">Au</span> {{ $manifestation->date_fin->format('d/m/Y') }}
                            </h5>
                        </div>
                        <div class="d-inline">
                            <i class="fa fa-users fa-lg mr-1 label" aria-hidden="true"></i>
                            <h6 class="d-inline label mr-1">Nbre participants: </h6>
                            <h5 class="d-inline  text-muted">{{ $manifestation->nbr_participants_prevus }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <form action="" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Informations sur BUDGET (en MAD)</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-md">
                                    <tr>
                                        <td>Budget engagé de l'UCA ({{ now()->year }})</td>
                                        <td><input class="form-control text-right" name="budgetRestant"
                                                style="font-weight:bold !important" readonly
                                                value="{{ $budgetRestant->budget_restant }}" /></td>
                                        <td class="border-left">Budget octroyé à l'établissement</td>
                                        <td><input class="form-control text-right" type="number" min="0"
                                                max="{{ $budgetRestant->budget_restant }}" name="budgetEtab"
                                                style="font-weight:bold !important" value="" /></td>
                                    </tr>
                                    <tr>
                                        <td>Budget de la structure</td>
                                        <td><input class="form-control text-right" type="number" min="0"
                                                name="budgetStructure" style="font-weight:bold !important" value="" />
                                        </td>
                                        <td class="border-left">Estimation de dotation</td>
                                        <td><input class="form-control text-right" type="number" min="0"
                                                name="estimationDotation" style="font-weight:bold !important"
                                                value="" />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-right">
                            <button class="btn btn-success" type="">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Contribution des sponsors</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-md">
                                <thead>
                                    <tr>
                                        <th>Organisme</th>
                                        <th>Montant</th>
                                    </tr>
                                </thead>
                                @if ($contributeurs != null)
                                <tbody>
                                    @foreach ($contributeurs as $sponsor )
                                    @if ($sponsor->typeContributeur->libelle == "Sponsor")
                                    <tr>
                                        <td>{{ $sponsor->nom }}</td>
                                        <td>{{ $sponsor->montant }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Contribution estimative des participants</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-md">
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
                                                ($manifestation->nbr_enseignants_locaux +
                                                $manifestation->nbr_enseignants_non_locaux) }}</span>
                                            -Locaux: <span class="label mr-1 ml-1 font-weight-bold">{{
                                                $manifestation->nbr_enseignants_locaux }}</span> </td>
                                        <td class="border-right border-bottom">Total: <span
                                                class="label mr-1 ml-1 font-weight-bold">{{
                                                ($manifestation->nbr_etudiants_locaux +
                                                $manifestation->nbr_etudiants_non_locaux) }}</span>
                                            - Locaux: <span class="label mr-1 ml-1 font-weight-bold">{{
                                                $manifestation->nbr_etudiants_locaux }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="colspan-2">Les frais d'inscription couvrent:
                                            @if($natureContributionParticipant != null)
                                            <p>
                                                @foreach ($natureContributionParticipant as $contribution)
                                                @if ($loop->index != 0)
                                                ,
                                                @endif
                                                <span class="mr-1">{{ $contribution->natureContribution->libelle
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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Soutien de l'Université</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('edit.montant') }}" id="edit-montant-form"
                            name="edit-montant-form">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Rubrique &nbsp;&nbsp;
                                                <a href="#" id="rubrique"><i class="fa fa-book"
                                                        aria-hidden="true"></i></a>
                                            </th>
                                            <th class="text-center">Nombre demandé</th>
                                            <th class="text-center">Montant demandé</th>
                                            <th class="text-center">Nombre accordé</th>
                                            <th class="text-center">Montant accordé</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="text" hidden name="demande" value="{{ $demande->id }}" id="">
                                        <input type="text" hidden name="manifestation" value="{{ $manifestation->id }}"
                                            id="">
                                        @for ($i = 0; $i < sizeof($soutienSollicite); $i++) <tr>
                                            <td name="forfaits" class="text-center">{{ $soutienSollicite[$i]->libelle }}
                                                &nbsp;({{
                                                $soutienSollicite[$i]->forfait }})
                                                <input type="number" hidden name="forfait_id[{{ $i }}]"
                                                    value="{{ $soutienSollicite[$i]->id }}">
                                                <input type="number" hidden value="{{ $soutienSollicite[$i]->forfait }}"
                                                    id="{{ $soutienSollicite[$i]->id }}" name="forfait">
                                            </td>
                                            <td class="">{{ $soutienSollicite[$i]->pivot->nbr }}</td>
                                            <td class="text-center">{{ $soutienSollicite[$i]->pivot->montant }}
                                                &nbsp;&nbsp;
                                                @if($soutienSollicite[$i]->pivot->remarques_ != "")
                                                <i class="fa fa-info-circle" aria-hidden="true" data-container="body"
                                                    data-toggle="popover" data-placement="right"
                                                    data-content="{{ $soutienSollicite[$i]->pivot->remarques_ }}"
                                                    role="button">
                                                </i>
                                                @endif
                                            </td>
                                            <td class="text-right"><input class="form-control text-right nbrOk"
                                                    type="number" min="0" placeholder="0" name="nbrOk[{{ $i }}]" id=""
                                                    @if (sizeof($soutienAccorde) !=0 )
                                                    value="{{ $soutienAccorde[$i]->pivot->nbr }}" @endif>
                                            </td>
                                            <td class="text-right"><input class="form-control montantOk text-right"
                                                    type="number" min="0"  placeholder="0" id=""
                                                    name="montantOk[{{ $i }}]" @if (sizeof($soutienAccorde) !=0)
                                                    value="{{ $soutienAccorde[$i]->pivot->montant }}" @endif readonly>
                                            </td>
                                            </tr>
                                            @endfor
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <input type="text" class="form-control" name="observations" placeholder="Observations"
                                    @if ($demande->remarques != "")
                                value="{{ $demande->remarques }}"
                                @endif
                                @if (sizeof($soutienSollicite)==0)
                                disabled @endif>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tr>
                                    <th>Total demandé</th>
                                    <th class="text-right"><input class="form-control" disabled type="number" name=""
                                            id="" value="{{ $manifestation->soutienSollicite()->sum('montant') }}"></th>
                                    <th>Total accordé</th>
                                    <th class="text-right"><input class="form-control totalmontant text-right" disabled
                                            type="number" name="totalmontant" max="{{ $budgetRestant->budget_restant }}" id="totalmontant" @if($soutienAccorde
                                            !=null) value="{{ $manifestation->soutienAccorde()->sum('montant') }}"
                                            @endif>
                                            <div class="text-danger" id="errorBudget" style="visibility :hidden">ATTENTION! Budget dépassé! </div>
                                    </th>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-success" id="editMontant" @if (sizeof($soutienSollicite)==0) disabled
                                @endif>Enregistrer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div hidden>
    <div id="emailBody">
        <form method="POST" action=" {{ route('emails.custom') }}" id="email-form" name="email-form">
            @csrf
            <div class="form-group">
                <div class="">
                    <label for="email">Destinataire:</label>
                    <input type="email" class="form-control" name="email" readonly value="{{ $coordonnateur->email }}">
                    <input type="text" class="form-control" name="nom" hidden
                        value="{{ $coordonnateur->nom }}&nbsp;{{ $coordonnateur->prenom }}">
                    <input type="text" hidden name="demandeId" value="{{ $demande->id }}">
                    <label for="objet">Objet:</label>
                    <input type="text" class="form-control" name="objet" required placeholder="Objet">
                    @error('objet')
                    <div class="text-danger">* Ce champs est requis</div>
                    @enderror
                </div>
                <div class=" form-check form-check-inline m-2">
                    <label for="cc" class="form-check-label">CC:</label>
                    <input type="checkbox" class="form-check m-1" name="cc[]"
                        value="{{ $coordonnateur->laboratoire->responsable->email }}">Responsable structure<small
                        class="ml-1 text-danger">(Envoyer une copie au responsable)</small>
                </div>
                <div class="form-group">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-envelope fa-lg"></i></div>
                        </div>
                        <input type="email" id="autreEmail" class="form-control" name="cc[]"
                            placeholder="envoyer une copie à une autre adresse" value="">
                    </div>
                </div>
                <div class=" form-group mt-2">
                    <textarea name="corpsEmail" class="form-control form-control-lg " id=""
                        placeholder="Votre message ici..." required></textarea>@error('corpsEmail')
                    <div class="text-danger">* Ce champs est requis</div>
                    @enderror
                </div>
                <div class=" form-check form-check-inline m-2">
                    <input type="checkbox" class="form-check m-1" id="editable" name="editable" value="1">Demande de
                    pièces manquantes
                </div>
            </div>
        </form>
    </div>
    <div id="etatBody">
        <div>Vous êtes sur le point de changer l'état de cette demande.</div>
        <form method="POST" action="">
            @csrf
            <div class="form-group">
                <input type="text" value="" name="etat" hidden>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('../assets/js/page/bootstrap-modal.js')}}"></script>
<script src="{{asset('../assets/js/sweetalert/dist/sweetalert.min.js')}}"></script>
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 1)
<script>
    $(document).ready(function(){
    $('#sendEmail').click()});
</script>
@endif
<script type="text/javascript">
    let rubrique_body = '<div class="table-responsive">';
rubrique_body += '<table class="table table-bordered table-md">';
rubrique_body += '<tr><th>Rubrique</th><th>Forfait</th><th>Limite</th><th>Description</th><th>Remarques</th></tr>';
rubrique_body += '@foreach ($frais as $frais_)';
rubrique_body += '<tr><td>{{ $frais_->libelle }}</td>';
rubrique_body += '<td>{{ $frais_->forfait }}@if ( $frais_->forfait =="" )<span>-----</span>@endif </td>';
rubrique_body += '<td>{{ $frais_->limite }}</td>';
rubrique_body += '<td>{{ $frais_->description }}</td>';
rubrique_body += '<td>{{ $frais_->remarques }}</td>';
rubrique_body += '</tr>@endforeach</table></div>';

$("#rubrique").fireModal({
    title: 'Rubrique',
    body: rubrique_body,
    buttons: [
        {
            text: 'Fermer',
            class: 'btn btn-danger btn-shadow',
            handler: function (modal) {
                modal.modal('toggle');
            }
        }
    ],
    size:'modal-lg'
});
$("#accepter").click(function(){
    swal({
      title: '',
      text: "Vous êtes sur le point d'accepter cette demande.",
      icon: 'warning',
      buttons: ['Annuler','Continuer'],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href ="{{ route('accept.demande',['id'=>$demande->id]) }}";
      } else {
      }
    });
});
$("#editMontant").click(function() {
   
  swal({
      title: '',
      text: "Vous êtes sur le point de changer l'état de cette demande.",
      icon: 'warning',
      buttons: ['Annuler','Continuer'],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
         $('#edit-montant-form').submit();
      } else {
        $('#edit-montant-form')[0].reset();
        $('#totalmontant').val(0);
      }
    });
});
$("#refuser").click(function(){
    swal({
      title: '',
      text: "Vous êtes sur le point de refuser cette demande.",
      icon: 'warning',
      buttons: ['Annuler','Continuer'],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href ="{{ route('reject.demande',['id'=>$demande->id]) }}";
      } else {
      }
    });
});

$("#sendEmail").fireModal({
    title: 'Envoyer un email',
    body: $('#emailBody'),
    buttons: [
        {
            text: 'Envoyer',
            class: 'btn btn-success btn-shadow',
            handler: function () {
                swal({
                    title: '?',
                    text: "Voulez-vous vraiment envoyer cet e-mail?.",
                    icon: 'warning',
                    buttons: ['NON','OUI'],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#email-form').submit();
                    } else {
                        $('#email-form')[0].reset();
                    }
                });
            }
        },
        {
            text: 'Annuler',
            class: 'btn btn-danger btn-shadow',
            handler: function (modal) {
                $('#email-form')[0].reset();
                modal.modal('toggle');
            }
        }
    ],
    size:'modal-lg'
});

$("#disableUpload").click(function(){
    swal({
      title: "Désactiver l'ajout de nouveaux document pour cette demande",
      text: "",
      icon: 'warning',
      buttons: ['Annuler','Continuer'],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href ="{{ route('disableUpload',['id'=>$demande->id]) }}";
      } else {
      }
    });
});
</script>
@endsection
