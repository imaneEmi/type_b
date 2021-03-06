@extends('layouts.main_admin')

@section('title')
@if (Route::is('demandes.courantes'))
Demandes nouvelles
@elseif (Route::is('demandes.acceptees'))
Demandes acceptées
@elseif (Route::is('demandes.refusées'))
Demandes refusées
@else
Demandes en cours de traitement
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
        <h1>Demandes nouvelles</h1>
        @elseif (Route::is('demandes.acceptees'))
        <h1>Demandes acceptées</h1>
        @elseif (Route::is('demandes.refusees'))
        <h1>Demandes refusées</h1>
        @else
        <h1>Demandes en cours de traitements</h1>
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
                                        <th>@if (Route::is('demandes.courantes') || Route::is('demandes.enCours'))
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
                                            @if (Route::is('demandes.courantes') || Route::is('demandes.enCours'))
                                            <a href="{{ route('admin.edit.manifestation',['id'=>$demande->id]) }}"
                                                class=" has-icon"><i class="fas fa-pen"></i>
                                            </a>
                                            @else
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
@endsection
@section('scripts')
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{asset('../assets/js/page/modules-datatables.js')}}"></script>
@endsection
