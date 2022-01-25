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
        <form id="saveForm" class="needs-validation" novalidate="">
            <div class="card-header">
                <h4>Ajouter un nouveaux frais</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-5 col-12">
                        <label>Libelle</label>
                        <input type="text" class="form-control" value="" required>
                        <div class="invalid-feedback">
                            Veuillez remplir ce champs
                        </div>
                    </div>
                    <div class="form-group col-md-3 col-12">
                        <label>Forfait</label>
                        <input type="number" class="form-control" value=""  required>
                        <div class="invalid-feedback">
                            Veuillez remplir ce champs
                        </div>
                    </div>
                    <div class="form-group col-md-2 col-12">
                        <label>Unité</label>
                        <input type="text" class="form-control" value=""  required>
                        <div class="invalid-feedback">
                            Veuillez remplir ce champs
                        </div>
                    </div>
                    <div class="form-group col-md-2 col-12">
                        <label>Limite</label>
                        <input type="number" class="form-control" value=""  required>
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
                        <input type="text" class="form-control" value="">
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-success"  >Enregister</button>
                <button class="btn btn-danger"type="reset" >Annuler</button>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Liste des frais couverts</h4>
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
<div class="modal"  id="saveModal">
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
  </div>
@endsection
@section('scripts')
<script src="{{ mix('js/app.js') }}"></script>
<script src="../assets/js/page/modules-datatables.js"></script>
<script src="../assets/js/page/bootstrap-modal.js"></script>
<script type="text/javascript">
    let rubrique_body = '<div class="table-responsive">';
rubrique_body += '<table class="table table-bordered table-md">';
rubrique_body += '<tr><th>Rubrique</th><th>Forfait</th><th>Limite</th><th>Description</th><th>Remarques</th></tr>';
rubrique_body += '';
rubrique_body += '<tr><td></td>';
rubrique_body += '<td>span>-----</span></td>';
rubrique_body += '<td></td>';
rubrique_body += '<td></td>';
rubrique_body += '<td></td>';
rubrique_body += '</tr></table></div>';

$("#save").fireModal({
    title: 'Rubrique',
    body: rubrique_body,
    buttons: [
        {
            text: 'Fermer',
            class: 'btn btn-danger btn-shadow',
            handler: function (modal) {
                modal.modal('toggle');
            }
        }
    ],
    size:'modal-lg'
});
</script>
@endsection
