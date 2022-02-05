@extends('layouts.main_admin')

@section('title')
Administration
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Frais couverts</h1>
    </div>
    <div class="card">
        <div class="row">
            <div class="col-6">
                <div class="card-header">
                    <h4>Liste des frais couverts</h4>
                </div>
            </div>
            <div class="col-6 card-header d-flex flex-row-reverse">
                <button class="btn btn-success " id="create_form"> Ajouter </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>Libelle</th>
                        <th>Forfait</th>
                        <th>Unité
                        </th>
                        <th>Limite</th>
                        <th>Description</th>
                        <th>Remarques</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </thead>
                    <tbody>
                        @foreach ($fraisCouvert as $item)
                        <tr>
                            <td>{{ $item->libelle}}</td>
                            <td> {{ $item->forfait}}</td>
                            <td> {{ $item->unite}}</td>
                            <td> {{ $item->limite}} </td>
                            <td> {{ $item->description}}</td>
                            <td> {{ $item->remarques}}</td>
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
</section>
<div class="modal" id="saveModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
    <meta name="_token" content="{{ csrf_token() }}">
</div>
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

    form.appendChild(div1);


    var libelle = document.createElement("p");
    var nodeLibelle = document.createTextNode("Libelle");
    libelle.appendChild(nodeLibelle);

    var input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("id", "libelle");
    input.setAttribute("name", "libelle");
    input.setAttribute("required", true);
    input.classList.add('form-control')

    div1.appendChild(libelle);
    div1.appendChild(input);


    var description = document.createElement("p");
    var nodeDescription = document.createTextNode("Description");
    description.appendChild(nodeDescription);

    var inputDescription = document.createElement("input");
    inputDescription.setAttribute("type", "text");
    inputDescription.setAttribute("id", "description");
    inputDescription.setAttribute("name", "description");
    inputDescription.setAttribute("required", true);
    inputDescription.classList.add('form-control')


    div1.appendChild(description);
    div1.appendChild(inputDescription);

    var lebel = document.createElement("p");
    var node = document.createTextNode("Forfait");
    lebel.appendChild(node);

    var input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("id", "forfait");
    input.setAttribute("name", "forfait");
    input.setAttribute("required", true);
    input.classList.add('form-control')

    div1.appendChild(lebel);
    div1.appendChild(input);




    var lebel = document.createElement("p");
    var node = document.createTextNode("Unité");
    lebel.appendChild(node);

    var input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("id", "unite");
    input.setAttribute("name", "unite");
    input.setAttribute("required", true);
    input.classList.add('form-control')

    div1.appendChild(lebel);
    div1.appendChild(input);



    var lebel = document.createElement("p");
    var node = document.createTextNode("Limite");
    lebel.appendChild(node);

    var input = document.createElement("input");
    input.setAttribute("type", "numebr");
    input.setAttribute("id", "limite");
    input.setAttribute("name", "limite");
    input.setAttribute("required", true);
    input.classList.add('form-control')

    div1.appendChild(lebel);
    div1.appendChild(input);


    var lebel = document.createElement("p");
    var node = document.createTextNode("Remarques");
    lebel.appendChild(node);

    var input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("id", "remarques");
    input.setAttribute("name", "remarques");
    input.setAttribute("required", true);
    input.classList.add('form-control')

    div1.appendChild(lebel);
    div1.appendChild(input);


    $("#create_form").fireModal({
        title: 'Ajouter une nouvelle pièce',
        body: $(form),
        footerClass: 'bg-whitesmoke',
        autoFocus: false,
        onFormSubmit: function(modal, e, form) {
            let libelle = e.target[0].value;
            let description = e.target[1].value;
            let forfait = e.target[2].value;
            let unite = e.target[3].value;
            let limite = e.target[4].value;
            let remarques = e.target[5].value;


            var form_data = new FormData();
            form_data.append('libelle', libelle);
            form_data.append('description', description);
            form_data.append('forfait', forfait);
            form_data.append('unite', unite);
            form_data.append('limite', limite);
            form_data.append('remarques', remarques);

            url = "{{route('frais_couvert.create')}}"
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


    fraisCouvert = @json($fraisCouvert);
    for (var i = 0; i < fraisCouvert.length; i < i++) {

        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.classList.add('modal-part')

        var hideInput = document.createElement("input");
        hideInput.setAttribute("name", "demande");
        hideInput.value = fraisCouvert[i].id
        hideInput.style.visibility = "hidden";


        var div1 = document.createElement("div");
        div1.classList.add('form-group')

        var libelle = document.createElement("p");
        var nodeLibelle = document.createTextNode("Vraiment ? Voulez-vous continuer ?");
        libelle.appendChild(nodeLibelle);


        form.appendChild(div1)
        div1.appendChild(libelle);
        div1.appendChild(hideInput);



        $("#delete" + fraisCouvert[i].id).fireModal({
            title: 'Supprimer une pièce',
            body: $(form),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                let id = e.target[0].value;

                var url = '{{ route("frais_couvert.delete", ":id") }}';
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

        form.appendChild(div1);


        var libelle = document.createElement("p");
        var nodeLibelle = document.createTextNode("Libelle");
        libelle.appendChild(nodeLibelle);

        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("id", "libelle");
        input.setAttribute("name", "libelle");
        input.setAttribute("value", fraisCouvert[i].libelle);
        input.setAttribute("required", true);
        input.classList.add('form-control')

        div1.appendChild(libelle);
        div1.appendChild(input);


        var description = document.createElement("p");
        var nodeDescription = document.createTextNode("Description");
        description.appendChild(nodeDescription);

        var inputDescription = document.createElement("input");
        inputDescription.setAttribute("type", "text");
        inputDescription.setAttribute("id", "description");
        inputDescription.setAttribute("name", "description");
        inputDescription.setAttribute("value", fraisCouvert[i].description);
        inputDescription.setAttribute("required", true);
        inputDescription.classList.add('form-control')


        div1.appendChild(description);
        div1.appendChild(inputDescription);

        var lebel = document.createElement("p");
        var node = document.createTextNode("Forfait");
        lebel.appendChild(node);

        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("id", "forfait");
        input.setAttribute("name", "forfait");
        input.setAttribute("value", fraisCouvert[i].forfait);
        input.setAttribute("required", true);
        input.classList.add('form-control')

        div1.appendChild(lebel);
        div1.appendChild(input);




        var lebel = document.createElement("p");
        var node = document.createTextNode("Unité");
        lebel.appendChild(node);

        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("id", "unite");
        input.setAttribute("name", "unite");
        input.setAttribute("value", fraisCouvert[i].unite);
        input.setAttribute("required", true);
        input.classList.add('form-control')

        div1.appendChild(lebel);
        div1.appendChild(input);



        var lebel = document.createElement("p");
        var node = document.createTextNode("Limite");
        lebel.appendChild(node);

        var input = document.createElement("input");
        input.setAttribute("type", "numebr");
        input.setAttribute("id", "limite");
        input.setAttribute("name", "limite");
        input.setAttribute("value", fraisCouvert[i].limite);
        input.setAttribute("required", true);
        input.classList.add('form-control')

        div1.appendChild(lebel);
        div1.appendChild(input);


        var lebel = document.createElement("p");
        var node = document.createTextNode("Remarques");
        lebel.appendChild(node);

        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("id", "remarques");
        input.setAttribute("name", "remarques");
        input.setAttribute("value", fraisCouvert[i].remarques);
        input.setAttribute("required", true);
        input.classList.add('form-control')

        div1.appendChild(lebel);
        div1.appendChild(input);

        var hideInput = document.createElement("input");
        hideInput.setAttribute("name", "fraisCouvert");
        hideInput.value = fraisCouvert[i].id
        hideInput.style.visibility = "hidden";

        div1.appendChild(hideInput);

        $("#update" + fraisCouvert[i].id).fireModal({
            title: 'Modifier',
            body: $(form),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function(modal, e, form) {
                let libelle = e.target[0].value;
                let description = e.target[1].value;
                let forfait = e.target[2].value;
                let unite = e.target[3].value;
                let limite = e.target[4].value;
                let remarques = e.target[5].value;
                let id = e.target[6].value;

                var form_data = new FormData();
                form_data.append('libelle', libelle);
                form_data.append('description', description);
                form_data.append('forfait', forfait);
                form_data.append('unite', unite);
                form_data.append('limite', limite);
                form_data.append('remarques', remarques);
                form_data.append('id', id);

                url = "{{route('frais_couvert.update')}}"
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
                text: 'Modifier',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function(modal) {}
            }]
        });

    }
</script>
@endsection