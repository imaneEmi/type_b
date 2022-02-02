@extends('layouts.main_admin')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Archive</h1>
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
                                        <th>Etat</th>
                                        <th>Date reçu</th>
                                        <th>
                                            Details
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
                                            {{ $demande->coordonnateur->name }}&nbsp;{{ $demande->coordonnateur->prenom
                                            }}
                                        </td>
                                        <td>
                                            @if ($demande->etat ==='Acceptée')
                                            <div class="badge badge-success">
                                                {{$demande->etat}}
                                            </div>
                                            @elseif ($demande->etat === 'Courante')
                                            <div class="badge badge-warning">
                                                {{$demande->etat}}
                                            </div>
                                            @else
                                            <div class="badge badge-danger">
                                                {{$demande->etat}}
                                            </div>
                                            @endif
                                        </td>
                                        <td>{{ $demande->created_at }}</td>
                                        <td class="text-center">
                                            @if (Route::is('demandes.courantes'))
                                            <a href="{{ route('admin.edit.manifestation',['id'=>$demande->id]) }}"
                                                class="text-job has-icon"><i class="fas fa-pen"></i>
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
