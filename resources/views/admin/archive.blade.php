@extends('layouts.main_admin')

@section('title')
Archive
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
        <h1>Archive</h1>
    </div>
    <div class="section-body">
        <h2 class="section-title">{{ date('d-m-Y H:i') }}</h2>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <nav class="navbar navbar-secondary navbar-expand-lg navbar-custom">
                            <div class="container">
                                <ul class="navbar-nav">
                                    @foreach ($annees as $annee )
                                    @if($loop->index > 10) @break @endif
                                    <li class="nav-item">
                                        <a href="#{{ $annee }}" class="nav-link" style="color:#a34f23;">
                                            <h5>{{ $annee }}</h5>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @foreach ($annees as $annee )
                            <h4 id="{{ $annee }}">{{ $annee }}</h4>
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
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandes as $demande)
                                    @if($demande->created_at->format('Y') == $annee)
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
                                            @endif
                                        </td>
                                        <td>
                                            @if ($demande->etat === App\Models\DemandeStatus::ACCEPTEE)
                                            <div class="badge badge-success text-capitalize">
                                                {{$demande->etat}}
                                            </div>
                                            @elseif ($demande->etat === App\Models\DemandeStatus::COURANTE)
                                            <div class="badge badge-light text-capitalize">
                                                {{$demande->etat}}
                                            </div>
                                            @elseif ($demande->etat === App\Models\DemandeStatus::ENCOURS)
                                            <div class="badge badge-secondary text-capitalize">
                                                {{$demande->etat}}
                                            </div>
                                            @else
                                            <div class="badge badge-danger text-capitalize">
                                                {{$demande->etat}}
                                            </div>
                                            @endif
                                        </td>
                                        <td>{{ $demande->created_at }}</td>
                                        <td class="text-center">
                                            @if ($demande->etat === \App\Models\DemandeStatus::COURANTE)
                                            <a class="mr-3"
                                                href="{{ route('admin.edit.manifestation',['id'=>$demande->id]) }}"><i
                                                    class="fa fa-pen fa-lg"></i>
                                            </a>
                                            @else
                                            <span class="mr-3">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            @endif
                                            <a href="#" id="delete{{ $demande->id }}" title="Supprimer" class="mr-3"><i
                                                    class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('manifestation.details',['id'=>$demande->id]) }}"
                                                title="Plus de détails"><i class="fa fa-plus fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @endforeach
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
<script src="{{asset('../assets/js/stisla.js')}}"></script>
<script>
    demandes = @json($demandes);
    for (let i = 0; i < demandes.length; i++) {
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.classList.add('modal-part')

        var hideInput = document.createElement("input");
        hideInput.setAttribute("name", "demande");
        hideInput.value = demandes[i].id
        hideInput.style.visibility = "hidden";


        var div1 = document.createElement("div");
        div1.classList.add('form-group')

        var libelle = document.createElement("p");
        var nodeLibelle = document.createTextNode("Vraiment ? Voulez-vous continuer ?");
        libelle.appendChild(nodeLibelle);


        form.appendChild(div1)
        div1.appendChild(libelle);
        div1.appendChild(hideInput);

        $("#delete" + demandes[i].id).fireModal({
            title: 'Supprimer une demande',
            body: $(form),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                let id = e.target[0].value;

                var url = '{{ route("delete.demande", ":id") }}';
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    },
                    type: 'GET',
                    success: function(response) {

                        form.stopProgress();
                        if (response.code === 200) {
                            // modal.find('.modal-body').prepend('<div class="alert alert-info">' + response.message + '</div>')
                            window.location.reload();

                        } else {
                            modal.find('.modal-body').prepend('<div class="alert alert-danger">' + response.message + '</div>')

                        }
                    },
                    error: function(error) {
                        console.log("error", error);
                        form.stopProgress();
                        modal.find('.modal-body').prepend('<div class="alert alert-danger dissmisable">Please try again!</div>')
                    }
                });
                e.preventDefault();
            },
            shown: function(modal, form) {
                console.log(form)
            },
            buttons: [{
                text: 'Oui',
                submit: true,
                class: 'btn btn-danger btn-shadow',
                handler: function(modal) {}
            }]
        });
}
</script>
@endsection
