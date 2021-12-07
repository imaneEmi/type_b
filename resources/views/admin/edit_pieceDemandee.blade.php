@extends('layouts.main_admin')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pièces demandées</h1>
    </div>
    <div class="card">
        <form method="post" class="needs-validation" novalidate="">
            <div class="card-header">
                <h4>Ajouter une nouvelle pièce</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3 col-12">
                        <label>Libelle</label>
                        <input type="text" class="form-control" value="">
                        <div class="invalid-feedback">
                            Veuillez remplir ce champs
                        </div>
                    </div>
                    <div class="form-group col-md-7 col-12">
                        <label>Description</label>
                        <input type="text" class="form-control" value="">
                    </div>
                    <div class="form-group col-md-2 col-12">
                        <label>Nombre de copie</label>
                        <input type="number" class="form-control" value="ujang@maman.com">
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-success">Enregister</button>
                <button class="btn btn-danger">Annuler</button>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Liste des pièces demandées</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th class="col-3">Libelle</th>
                        <th class="col-6">Description</th>
                        <th class="col-2">Nombre de copie</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-3">Libelle</td>
                            <td class="col-6">Description</td>
                            <td class="col-2">Nombre de copie</td>
                            <td class="text-center"><i class="fas fa-pen"></i></td>
                            <td class="text-center">
                                <a class="text-danger" data-confirm="Realy?|Do you want to continue?" data-confirm-yes="alert('Deleted :)');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</section>
@endsection
@section('scripts')
<script src="{{ mix('js/app.js') }}"></script>
<script src="../assets/js/page/modules-datatables.js"></script>
<script src="../assets/js/page/bootstrap-modal.js"></script>
@endsection