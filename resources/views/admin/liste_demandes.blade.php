@extends('layouts.main_admin')

@section('title')
@if (Route::is('demandes.courantes'))
Demandes courantes
@elseif (Route::is('demandes.acceptees'))
Demandes acceptées
@else
Demandes refusées
@endif
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
    <div class="section-header">
        @if (Route::is('demandes.courantes'))
        <h1>Demandes courantes</h1>
        @elseif (Route::is('demandes.acceptees'))
        <h1>Demandes acceptées</h1>
        @else
        <h1>Demandes refusées</h1>
        @endif
    </div>
    <div class="section-body">
        <h2 class="section-title">{{ date('d-m-Y H:i') }}</h2>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            Code
                                        </th>
                                        <th>Intitule</th>
                                        <th>Coordonnateur</th>
                                        <th>
                                            @if (Route::is('demandes.acceptees'))
                                            Montant accordé
                                            @else
                                            Montant demandé
                                            @endif
                                        </th>
                                        <th>Date reçu</th>
                                        <th>@if (Route::is('demandes.courantes'))
                                            Modifier
                                            @else
                                            Details
                                            @endif
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandes as $demande)
                                    <tr>
                                        <td>
                                            {{ $demande->code }}
                                        </td>
                                        <td>{{ $demande->manifestation->intitule }}</td>
                                        <td class="align-middle">
                                            @if ($coordonnateurs[$loop->index] != null)
                                            {{ $coordonnateurs[$loop->index]->nom }}&nbsp;{{
                                            $coordonnateurs[$loop->index]->prenom
                                            }}
                                            @else
                                            <span class="text-danger">!! Introuvable !!</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (Route::is('demandes.acceptees'))
                                            {{ $demande->manifestation->soutienAccorde()->sum('montant') }}
                                            @else
                                            {{ $demande->manifestation->soutienSollicite()->sum('montant') }}
                                            @endif
                                        </td>
                                        <td>{{ $demande->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-center">
                                            @if (Route::is('demandes.courantes'))
                                            <a href="{{ route('admin.edit.manifestation',['id'=>$demande->id]) }}"
                                                class=" has-icon"><i class="fas fa-pen"></i>
                                            </a>
                                            @else
                                            @if ($demande->etat ===\App\Models\DemandeStatus::ACCEPTEE && $demande->manifestation->lettreAcceptation == null)
                                            <a href="#" id="upload" class="mr-2" title="Télécharger la lettre d'acceptation"><i
                                                    class="fa fa-upload fa-lg"></i>
                                            </a>
                                            @endif
                                            <a href="{{ route('manifestation.details',['id'=>$demande->id]) }}"
                                                title="Plus de détails"><i class="fa fa-plus fa-lg"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="uploadBody" hidden>
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
@endsection
@section('scripts')
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{asset('../assets/js/page/modules-datatables.js')}}"></script>
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
@endsection
