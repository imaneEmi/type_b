@extends('layouts.main_admin')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Budget Total Fixé</h1>
    </div>
    <div class="card">
        <form method="post" class="needs-validation" novalidate="">
            <div class="card-header">
                <h4>Ajouter un nouveau budget fixe</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Libelle</label>
                        <input type="text" class="form-control" value="" required>
                        <div class="invalid-feedback">
                            Veuillez remplir ce champs
                        </div>
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <label>Forfait</label>
                        <input type="text" class="form-control" value="" required>
                        <div class="invalid-feedback">
                            Veuillez remplir ce champs
                        </div>
                    </div>
                    <div class="form-group col-md-2 col-12">
                        <label>Limite</label>
                        <input type="number" class="form-control" value="" required>
                        <div class="invalid-feedback">
                            Veuillez remplir ce champs
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6 col-12">
                        <label>Description</label>
                        <input type="text" class="form-control" value="">
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>Remarques</label>
                        <input type="text" class="form-control" value="ujang@maman.com">
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-success">Enregister</button>
                <button class="btn btn-danger">Annuler</button>
            </div>
        </form>
    </div>


    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>Libelle</th>
                    <th>Forfait</th>
                    <th>Limite</th>
                    <th>Description</th>
                    <th>Remarques</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Libelle</td>
                        <td>Forfait</td>
                        <td>Limite</td>
                        <td>Description</td>
                        <td>Remarques</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
@section('scripts')
@endsection