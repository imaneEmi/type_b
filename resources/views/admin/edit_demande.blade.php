@extends('layouts.main_admin')

@section('title')
Traitement de dossier
@endsection
@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between pl-2 pr-3">
        @if ($manifestation != null )
        <div class="d-inline mr-2"><i class="fa fa-university fa-lg mr-1 label" aria-hidden="true"></i>
            <h6 class="d-inline label mr-1">Etab: </h6>
            <span class="d-inline-block text-capitalize lead"> Faculté des Sciences Juridiques, Economiques et
                Sociales</span>
        </div>
        <div class="d-inline"><i class="fa fa-flask fa-lg mr-1 label" aria-hidden="true"></i>
            <h6 class="d-inline label mr-1">Structure: </h6>
            <span class="d-inline-block text-capitalize lead"> laboratoire de recherche en management des organisations
                droit des affaires et développement durable </span>
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
                    <div class="dropdown-divider"></div>
                </div>
            </div>
        </span>
        @if($manifestation->lettreAcceptation == null)
        <span class="m-2">
            <a href="#" id="upload" title="Télécharger la lettre d'acceptation"><i class="fa fa-upload fa-lg"></i>
            </a>
        </span>
        @endif
        <span class="m-2">
            <a href="#" id="sendEmail" title="Envoyer un email"><i class="fa fa-envelope fa-lg"></i>
            </a>
        </span>
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
                                laboratoire de recherche en management des organisations
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
                            <h5 class="d-inline">MARRAKECH - {{ date('d/m/Y H:i') }}</h5>
                        </div>
                        <div class="d-inline">
                            <i class="fa fa-users fa-lg mr-1 label" aria-hidden="true"></i>
                            <h6 class="d-inline label mr-1">Nbre participants: </h6>
                            <h5 class="d-inline">102365 </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informations sur BUDGET</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-md">
                                <tr>
                                    <td>Budget engagé de l'UCA ({{ now()->year }})</td>
                                    <td><input class="form-control text-right" style="font-weight:bold !important"
                                            readonly value="1.150.234 DHS" /></td>
                                    <td class="border-left">Budget octroyé à l'établissement</td>
                                    <td>1.235 DHS</td>
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
                </div>
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
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
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
                                        <td>Total:10.000 &nbsp;-Locaux:5.000 </td>
                                        <td>Total:100.000 &nbsp;- Locaux:50.000</td>
                                    </tr>
                                    <tr>
                                        <td class="colspan-2">Les frais d'inscription couvrent:
                                            <p>lol</p>
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <thead>
                                    <tr>
                                        <th class="text-center">Rubrique &nbsp;&nbsp;
                                            <a href="#" id="rubrique"><i class="fa fa-book" aria-hidden="true"></i></a>
                                        </th>
                                        <th class="text-center">Nombre demandé</th>
                                        <th class="text-center">Montant demandé</th>
                                        <th class="text-center">Nombre accordé</th>
                                        <th class="text-center">Montant accordé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form method="post" action="{{ route('accept.demande') }}" name="accepter-demande">
                                        <input type="text" hidden name="demande" value="{{ $demande->id }}" id="">
                                        <input type="text" hidden name="manifestation" value="{{ $manifestation->id }}"
                                            id="">
                                        @csrf
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
                                                <i class="fa fa-info-circle" aria-hidden="true" data-container="body"
                                                    data-toggle="popover" data-placement="right"
                                                    data-content="{{ $soutienSollicite[$i]->pivot->remarques_ }}"
                                                    role="button">
                                                </i>
                                            </td>
                                            <td class="text-right"><input class="form-control text-right nbrOk"
                                                    type="number" min="0" placeholder="0" name="nbrOk[{{ $i }}]" id=""
                                                    value="">
                                            </td>
                                            <td class="text-right"><input class="form-control montantOk text-right"
                                                    type="number" min="0" placeholder="0" id=""
                                                    name="montantOk[{{ $i }}]" value="" readonly>
                                            </td>
                                            </tr>
                                            @endfor
                                    </form>
                                </tbody>
                            </table>
                        </div>
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
                                            type="number" name="totalmontant" id="totalmontant"></th>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-success" id="accepter-demande">Enregistrer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div hidden>
    <div id="emailBody">
        <form action="" id="">
            @csrf
            <div class="form-group">
                <div class="">
                    <label for="objet">Destinataire:</label>
                    <input type="email" class="form-control" name="email" disabled value="{{ $coordonnateur->email }}">
                    <label for="objet">Objet:</label>
                    <input type="text" class="form-control" name="objet" placeholder="Objet">
                </div>
                <div class=" form-check form-check-inline m-2">
                    <label for="cc" class="form-check-label">CC:</label>
                    <input type="checkbox" class="form-check m-1" name="cc" value="Respo structure">Respo structure
                    <input type="checkbox" class="form-check m-1" name="cc" value="Respo dep">Respo dep
                </div>
                <div class=" m-2">
                    <textarea name="corpsEmail" class="form-control form-control-lg " id=""
                        placeholder="Votre message ici..."></textarea>
                </div>
            </div>
        </form>
    </div>
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
<script src="../assets/js/page/bootstrap-modal.js"></script>
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
$("#accepter").fireModal({
    title: "Changer l'état de cette demande",
    body: $('#etatBody'),
    onFormSubmit: function(modal, e, form) {
        let etat = '{{ App\Services\util\Config::$ACCEPTEE }}';
        url = "{{route('accept.demande')}}"
        $.ajax({
          url: url,
          dataType: 'text', // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: etat,
          type: 'POST',
          headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
          },
          success: function(response) {
            response = JSON.parse(response);
            form.stopProgress();
            if (response.code === 200) {
              modal.find('.modal-body').prepend('<div class="alert alert-info">' + response.message + '</div>')

            } else {
              modal.find('.modal-body').prepend('<div class="alert alert-danger">' + response.message + '</div>')

            }
          },
          error: function(error) {
            console.log("error", error);
            form.stopProgress();
            modal.find('.modal-body').prepend('<div class="alert alert-danger">Please try again!</div>')
          }
        });
        e.preventDefault();
      },
    buttons: [
        {
            text: 'Continuer',
            class: 'btn btn-success btn-shadow',
            submite: true,
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
$("#refuser").fireModal({
    title: "Changer l'état de cette demande",
    body: $('#etatBody'),
    buttons: [
        {
            text: 'Continuer',
            class: 'btn btn-success btn-shadow',
            submite: true,
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

$("#sendEmail").fireModal({
    title: 'Envoyer un email',
    body: $('#emailBody'),
    onFormSubmit: function(event){
        event.preventDefault();
    },
    buttons: [
        {
            text: 'Envoyer',
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
    ],
    size:'modal-lg'
});

$("#upload").fireModal({
    title: "Télécharger la lettre d'acceptation",
    body: $('#uploadBody'),
    onFormSubmit: function(modal,event,form){
       /* url = "{{ route('upload.lettre',['id'=>$demande->id]) }}"
        $.ajax({
          url: url,
          dataType: 'text', // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: $('#uploadForm').serialize(),
          type: 'POST',
          headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
          },
          success: function(response) {
            response = JSON.parse(response);
            form.stopProgress();
            if (response.code === 200) {
              modal.find('.modal-body').prepend('<div class="alert alert-info">' + response.message + '</div>')

            } else {
              modal.find('.modal-body').prepend('<div class="alert alert-danger">' + response.message + '</div>')

            }
          },
          error: function(error) {
            console.log("error", error);
            form.stopProgress();
            modal.find('.modal-body').prepend('<div class="alert alert-danger">Please try again!</div>')
          }
        });
        event.preventDefault();*/
    },
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
@endsection
