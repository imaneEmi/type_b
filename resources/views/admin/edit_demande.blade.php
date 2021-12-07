@extends('layouts.main_admin')

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between pl-2 pr-3">
        @if ($manifestation != null )
        <div class="d-inline"><label for="">Intitule: </label>&nbsp;<span> {{ $manifestation->intitule }}</span></div>
        <div class="d-inline"><label for="">Type: </label>&nbsp;<span> {{ $manifestation->type }}</span></div>
        <div class="d-inline"><label for="">Coordonnateur: </label>&nbsp;<span> {{ $coordonnateur->name }}&nbsp;{{
                $coordonnateur->prenom }}</span></div>
        <div class="d-inline"><label for="">Date reçue: </label>&nbsp;<span> {{ $demande->date_envoie }}</span></div>
        <div class="d-inline"><span><a href="{{ route('manifestation.details',['id'=>$demande->id]) }}" title="Plus de
                    détails"><i class="fa fa-plus fa-lg"></i></a></span></div>
        @endif
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Modification du montant sollicité</h4>
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
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
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
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-success" id="accepter-demande">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
</script>
@endsection
