@extends('layouts.main_user')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Liste des demandes</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Demandes</div>
            <div class="breadcrumb-item">Liste des demandes</div>
        </div>
    </div>


    <div class="section-body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Résultats</h4>
                            <div class="card-header-action">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="chercher">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped" id="sortable-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                <i class="fas fa-th"></i>
                                            </th>
                                            <th>Reference</th>
                                            <th>Date d'envoi</th>
                                            <th>Remarques</th>
                                            <th class="text-center">Etat</th>
                                            <th>Rapport</th>
                                            <th class="text-center">Lettre d'acceptation</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($demandes as $demande)
                                        <tr>
                                            <td>
                                                <div class="sort-handler">
                                                    <i class="fas fa-th"></i>
                                                </div>
                                            </td>
                                            <td>{{$demande->code}}</td>
                                            <td class="align-middle">
                                                {{$demande->date_envoie->format('d/m/Y H:i')}}
                                            </td>
                                            <td> {{$demande->remarques}}</td>
                                            <td>
                                                @if ($demande->etat === App\Services\util\Config::$COURANTE)
                                                <div class="badge badge-light text-capitalize">{{$demande->etat}}</div>
                                                @elseif($demande->etat === App\Services\util\Config::$ACCEPTEE)
                                                <div class="badge badge-success text-capitalize">{{$demande->etat}}</div>
                                                @elseif($demande->etat === App\Services\util\Config::$REFUSEE )
                                                <div class="badge badge-danger text-capitalize">{{$demande->etat}}</div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="" class=" has-icon" id="modal-5{{$demande->id}}">
                                                    @if (!is_null($demande->manifestation->rapport))
                                                    <i class="fas fa-pen fa-lg" aria-hidden="true" title="Modifier le rapport"></i>
                                                    @else
                                                    <i class="fa fa-upload fa-lg" aria-hidden="true" title="Télécharger le rapport"></i>
                                                    @endif
                                                </a>
                                                @if (!is_null($demande->manifestation->rapport))
                                                <a href="{{route('manifestation.read.rapport',['url'=>Str::replace('/','-',$demande->manifestation->rapport->url)])}}" class="has-icon ml-2"><i class="fa fa-file-pdf fa-lg" aria-hidden="true" title="Consulter le rapport"></i></a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a @if (!is_null($demande->manifestation->lettreAcceptation) )
                                                    href="{{route('manifestation.read.rapport',['url'=>Str::replace('/','-',$demande->manifestation->lettreAcceptation->url)])}}"
                                                    disabled
                                                    @endif
                                                    class="has-icon" target="_blank">
                                                    <i class="fa fa-envelope fa-lg" aria-hidden="true"></i></a>
                                            </td>
                                            <td class="text-center">
                                                @if ($demande->editable)
                                                <a class="has-icon m-1" href="" id="modal-6{{$demande->id}}">
                                                    <i class="fa fa-upload fa-lg" aria-hidden="true" title="Télécharger les documents manquants"></i>
                                                </a>
                                                @endif
                                                <a href="{{route('request.pdf',['id'=>$demande->id])}}"
                                                    class="has-icon m-1" target="_blank">
                                                    <i class="fa fa-plus fa-lg" aria-hidden="true" title="Plus de détails"></i></a>
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
    </div>
    <meta name="_token" content="{{ csrf_token() }}">
</section>

@endsection
@section('scripts')
<script>
    demandes = @json($demandes);
        for (var i = 0; i < demandes.length; i < i++) {

        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("enctype", "multipart/form-data");
        form.classList.add('modal-part')

        var hideInput = document.createElement("input");
        hideInput.setAttribute("name", "demande");
        hideInput.value = demandes[i].id
        hideInput.style.visibility = "hidden";


        var div1 = document.createElement("div");
        div1.classList.add('form-group')

        var div2 = document.createElement("div");
        div2.classList.add('custom-file')

        var input = document.createElement("input");
        input.setAttribute("type", "file");
        input.setAttribute("id", "customFile");
        input.setAttribute("name", "rapport");
        input.setAttribute("required", true);
        input.classList.add('custom-file-input')

        var label = document.createElement("label");
        label.setAttribute("type", "file");
        label.setAttribute("id", "customFile");
        label.setAttribute("for", "customFile");
        label.classList.add('custom-file-label');
        label.innerHTML = 'Choose files'

        form.appendChild(div1);
        form.appendChild(hideInput);
        div1.appendChild(div2);
        div2.appendChild(input);
        div2.appendChild(label);


        $("#modal-5" + demandes[i].id).fireModal({
            title: 'Upload Rapport',
            body: $(form),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                // Form Data

                let repport = e.target[0].files[0];
                let demande = e.target[1].value;
                var form_data = new FormData();
                form_data.append('rapport', repport);
                form_data.append('demande', demande);
                url = "{{route('manifestation.upload.rapport')}}"
                $.ajax({
                    url: url,
                    dataType: 'text', // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
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
            shown: function(modal, form) {
                console.log(form)
            },
            buttons: [{
                text: 'Upload',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function(modal) {}
            }]
        });


        $("#modal-6" + demandes[i].id).fireModal({
            title: 'Ajouter un fichier',
            body: $(form),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                // Form Data
                let file = e.target[0].files[0];
                let demande = e.target[1].value;
                var form_data = new FormData();
                form_data.append('file', file);
                form_data.append('demande', demande);
                url = "{{route('manifestation.add.file')}}"
                $.ajax({
                    url: url,
                    dataType: 'text', // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
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
            shown: function(modal, form) {
                console.log(form)
            },
            buttons: [{
                text: 'Ajouter',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function(modal) {}
            }]
        });

        }
</script>
@endsection
