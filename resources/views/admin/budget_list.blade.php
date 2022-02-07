@extends('layouts.main_admin')
@section('style')

<link rel="stylesheet" href="{{asset('../css/ionicons201/css/ionicons.min.css')}}">
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4>Résultats de la recherche</h4>
            <div class="card-header-action">
                <form>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">

                            <button class="btn btn-primary bg-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                Année
                            </th>
                            <th>Budget Annuel Fixe</th>
                            <th>Budget Annuel Restant</th>
                            <th>
                                Actions
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $res)
                        <tr>
                            <td id="anneeSelected">
                                {{ $res->annee }}
                            </td>
                            <td id="budgetSelected">{{ $res->budget_fixe }}</td>
                            <td>
                                {{ $res->budget_restant }}

                            </td>
                            <td>
                                <ul id="icons" class="ionicons">

                                    <li class="ion ion-edit text-success" id="modalUpdateBudget" data-toggle="tooltip" data-placement="bottom" title="Modifier" style="font-size: 2rem;" data-pack="default" data-tags="change, update, write, type, pencil"></li>
                                    <li class="ion ion-trash-a text-danger" data-toggle="tooltip" data-placement="bottom" title="Supprimer" style="font-size: 2rem;" data-pack="default" data-tags="change, update, write, type, pencil"></li>

                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">Deseja realmente excluir o registro?</div>
                    <div class="modal-footer">
                        <form class="modal-part" id="modal-update-part" method="post" action="{{route('budget.update')}}">
                            <div class="form-group">
                                <label>Année</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input type="number" id='anneeForm' class="form-control @error('annee') is-invalid @enderror year" min=1800 name="annee" required onkeyup="manage(this)" value="{{ old('annee') }}">
                                    @error('annee')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Budget Annuel</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                MAD
                                            </div>
                                        </div>
                                        <input type="number" id="budgetForm" class="form-co
                                        ntrol currency @error('budget') is-invalid @enderror" value="{{ old('budget') }}" min=0 name="budget" required onkeyup="manage(this)">
                                        @error('budget')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script src="{{asset('../assets/js/page/modules-datatables.js')}}"></script>
<script src="{{asset('../assets/js/page/modules-ion-icons.js')}}"></script>
<script src="{{asset('../assets/js/page/bootstrap-modal.js')}}"></script>
<script>
    function manage(txt) {
        var bt = document.getElementById('update');
        var ele = document.getElementsByTagName('input');

        // Loop through each element.
        for (i = 0; i < ele.length; i++) {

            // Check the element type
            if (ele[i].type == 'number' && ele[i].value == '') {
                bt.disabled = true; // Disable the button.
                return false;
            } else {
                bt.disabled = false; // Enable the button.
            }
        }
    }
    $("#modalUpdateBudget").fireModal({
        title: 'Modifier le budget annuel',
        body: $("#modal-update-part"),
        footerClass: 'bg-whitesmoke',
        autoFocus: false,
        onFormSubmit: function(modal, e, form) {
            // Form Data
            let form_data = $(e.target).serialize();
            console.log(form_data)

            // DO AJAX HERE
            let fake_ajax = setTimeout(function() {
                form.stopProgress();
                modal.find('.modal-body').prepend('<div class="alert alert-info">Please check your browser console</div>')

                clearInterval(fake_ajax);
            }, 1500);

            e.preventDefault();
        },
        shown: function(modal, form) {
            console.log(form)
        },
        buttons: [{
            id: 'update',
            text: 'Modifier',
            submit: true,
            class: 'btn btn-primary btn-shadow',
            handler: function(modal) {}
        }]
    });

    $("#modalUpdateBudget").on("click", function() {
        $("#anneeForm").val($("#anneeSelected").text().trim());
        $("#budgetForm").val($("#budgetSelected").text());

    });
</script>


@endsection