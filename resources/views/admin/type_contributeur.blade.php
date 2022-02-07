@extends('layouts.main_admin')

@section('title')
Administration
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Types de contributeurs</h1>
    </div>
    <div class="card">
        <div class="row">
            <div class="col-6">
                <div class="card-header">
                    <h4>Liste des Types de contributeurs</h4>
                </div>
            </div>
            <div class="col-6 card-header d-flex flex-row-reverse">
                <button class="btn btn-success " id="create_form"> Ajouter </button>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th class="col-3">Libelle</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </thead>
                <tbody>

                    @foreach ($typeContributeurs as $item)
                    <tr>
                        <td class="col-3">{{$item->libelle}}</td>
                        <td class="text-center">
                            <a id="update{{$item->id}}">
                                <i class="fas fa-pen">
                                </i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a class="text-danger" id="delete{{$item->id}}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <meta name="_token" content="{{ csrf_token() }}">
</section>
@endsection
@section('scripts')
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{asset('../assets/js/page/modules-datatables.js')}}"></script>
<script src="{{asset('../assets/js/stisla.js')}}"></script>
<script>
    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.classList.add('modal-part')

    var div1 = document.createElement("div");
    div1.classList.add('form-group')


    var libelle = document.createElement("p");
    var nodeLibelle = document.createTextNode("Libelle");
    libelle.appendChild(nodeLibelle);

    var input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("id", "libelle");
    input.setAttribute("name", "libelle");
    input.setAttribute("required", true);
    input.classList.add('form-control')

    form.appendChild(div1);
    div1.appendChild(libelle);
    div1.appendChild(input);

    $("#create_form").fireModal({
        title: 'Ajouter',
        body: $(form),
        footerClass: 'bg-whitesmoke',
        autoFocus: false,
        onFormSubmit: function(modal, e, form) {
            let libelle = e.target[0].value;

            var form_data = new FormData();
            form_data.append('libelle', libelle);
            url = "{{route('type_contributeur.create')}}"
            $.ajax({
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                success: function(response) {
                    console.log(response)

                    form.stopProgress();
                    if (response.code === 200) {
                        modal.find('.modal-body').prepend('<div class="alert alert-info">' + response.message + '</div>')
                        window.location.reload();

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


    typeContributeurs = @json($typeContributeurs);
    for (var i = 0; i < typeContributeurs.length; i < i++) {

        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.classList.add('modal-part')

        var hideInput = document.createElement("input");
        hideInput.setAttribute("name", "typeVontributeur");
        hideInput.value = typeContributeurs[i].id
        hideInput.style.visibility = "hidden";


        var div1 = document.createElement("div");
        div1.classList.add('form-group')

        var libelle = document.createElement("p");
        var nodeLibelle = document.createTextNode("Vraiment ? Voulez-vous continuer ?");
        libelle.appendChild(nodeLibelle);


        form.appendChild(div1)
        div1.appendChild(libelle);
        div1.appendChild(hideInput);


        $("#delete" + typeContributeurs[i].id).fireModal({
            title: 'Supprimer ',
            body: $(form),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                let id = e.target[0].value;
                var url = '{{ route("type_contributeur.delete", ":id") }}';
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
                        modal.find('.modal-body').prepend('<div class="alert alert-danger">Please try again!</div>')
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



        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.classList.add('modal-part')

        var div1 = document.createElement("div");
        div1.classList.add('form-group')


        var libelle = document.createElement("p");
        var nodeLibelle = document.createTextNode("Libelle");
        libelle.appendChild(nodeLibelle);

        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("id", "libelle");
        input.setAttribute("name", "libelle");
        input.setAttribute("value", typeContributeurs[i].libelle);
        input.setAttribute("required", true);
        input.classList.add('form-control')


        var hideInput = document.createElement("input");
        hideInput.setAttribute("name", "typeContributeurs");
        hideInput.value = typeContributeurs[i].id
        hideInput.style.visibility = "hidden";


        form.appendChild(div1);
        div1.appendChild(libelle);
        div1.appendChild(input);
        div1.appendChild(hideInput);


        $("#update" + typeContributeurs[i].id).fireModal({
            title: 'Modifier ',
            body: $(form),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                let libelle = e.target[0].value;
                let id = e.target[1].value;

                var form_data = new FormData();
                form_data.append('libelle', libelle);
                form_data.append('id', id);
                url = "{{route('type_contributeur.update')}}"
                $.ajax({
                    url: url,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'POST',
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    },
                    success: function(response) {
                        form.stopProgress();
                        if (response.code === 200) {
                            modal.find('.modal-body').prepend('<div class="alert alert-info">' + response.message + '</div>')
                            window.location.reload();

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
                text: 'Modifier',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function(modal) {}
            }]
        });
    }
</script>
@endsection