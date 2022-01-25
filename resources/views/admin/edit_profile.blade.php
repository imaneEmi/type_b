@extends('layouts.main_admin')

@section('title')
Administration
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Admin</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Profile</div>
        </div>
    </div>
    <div class="row">

        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <form method="post" action="{{ route('save-admin') }}" id="updateForm" class="needs-validation"
                    novalidate="">
                    @csrf
                    <div class="card-header">
                        <h4>Modifier Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Nom</label>
                                <input type="text" class="form-control" value="" name="nom" required>
                                <div class="invalid-feedback">

                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Prenom</label>
                                <input type="text" class="form-control" value="" name="prenom" required>
                                <div class="invalid-feedback">
                                    Veuillez remplir ce champs
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Email</label>
                                <input type="email" class="form-control" value="" name="email" required>
                                <div class="invalid-feedback">
                                    Veuillez remplir ce champs
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Tel</label>
                                <input type="tel" class="form-control" value="" name="tel">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Mot de passe</label>
                                <input type="password" class="form-control" value="" name="password" required>
                                <div class="invalid-feedback">
                                    Veuillez remplir ce champs
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Confirmer Mot de passe</label>
                                <input type="password" class="form-control" value="" name="password_confirmation"
                                    required>
                                <div class="invalid-feedback">
                                    Veuillez remplir ce champs
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" id="updateBtn" type="submit">Enregister</button>
                        <button class="btn btn-primary" type="reset">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                        <h4>Ajouter admin</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Nom</label>
                                <input type="text" class="form-control" value="">
                                <div class="invalid-feedback">
                                    Veuillez remplir ce champs
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Prenom</label>
                                <input type="text" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Email</label>
                                <input type="email" class="form-control" value="ujang@maman.com">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Tel</label>
                                <input type="tel" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Mot de passe</label>
                                <input type="password" class="form-control" value="ujang@maman.com">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Confirmer Mot de passe</label>
                                <input type="password" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Enregister</button>
                    </div>
                </form>
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
rubrique_body += '';
rubrique_body += '<tr><td></td>';
rubrique_body += '<td><span>-----</span></td>';
rubrique_body += '<td></td>';
rubrique_body += '<td></td>';
rubrique_body += '<td></td>';
rubrique_body += '</tr></table></div>';
var my_form =$("#updateForm");
url = "{{ route('save-admin') }}";
$("#updateBtn").fireModal({
    title: 'Rubrique',
    body: rubrique_body,
    onFormSubmit: function(my_form,e){
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url:url,
            data: my_form.serialize(),
            success: function (data) {
                console.log('Submission was successful.');
                console.log(data);
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
    },
    buttons: [
        {
            text: 'Continuer',
            class: 'btn btn-success btn-shadow',
            submit: true,
            handler: function () {
            }
        },
        {
            text: 'Fermer',
            class: 'btn btn-danger btn-shadow',
            handler: function (modal) {
                modal.modal('toggle');
            }
        }],
});



$("#rubrique").fireModal({
    title: 'Rubrique',
    body: rubrique_body,
    buttons: [
        {
            text: 'Continuer',
            class: 'btn btn-success btn-shadow',
            handler: function () {
                $("#updateForm").submit(function(){
                   if($(this).valid())
                   console.log('valid form');
                });
            }
        },
        {
            text: 'Fermer',
            class: 'btn btn-danger btn-shadow',
            handler: function (modal) {
                modal.modal('toggle');
            }
        }],
});
</script>
@endsection
