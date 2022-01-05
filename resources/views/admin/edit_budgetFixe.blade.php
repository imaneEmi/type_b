@extends('layouts.main_admin')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Budget Annuel de l'année</h1>
    </div>
    <div class="card ">
        <form method="post" class="needs-validation" novalidate="">
            <div class="card-header">
                <h4>Ajouter un nouveau budget annuel</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6 col-6">


                        <label>Phone Number (US Format)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-phone"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control phone-number">
                        </div>


                    </div>


                    <div class="form-group col-md-6 col-6">
                        <label>Budget en (MAD)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    $
                                </div>
                            </div>
                            <input type="text" class="form-control currency">
                            <div class="invalid-feedback">
                                Veuillez remplir ce champs
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer text-right">
                <button class="btn btn-success">Enregister</button>
                <button class="btn btn-danger">Annuler</button>
            </div>
        </form>
    </div>



</section>
@endsection
@section('scripts')
<script src="../assets/js/page/forms-advanced-forms.js"></script>

@endsection