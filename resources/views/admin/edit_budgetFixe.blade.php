@extends('layouts.main_admin')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Budget Annuel de l'année</h1>
    </div>
    <div class="card ">
        <form method="post" class="needs-validation" novalidate="" action="{{route('save.budgetFixe')}}">
            @csrf
            <div class="card-header">
                <h4>Ajouter un nouveau budget annuel</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6 col-6">


                        <label>Année</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-calendar"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control phone-number" name="annee">
                        </div>


                    </div>


                    <div class="form-group col-md-6 col-6">
                        <label>Budget en (MAD)</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    MAD
                                </div>
                            </div>
                            <input type="text" class="form-control currency" name="budget">
                            <div class="invalid-feedback">
                                Veuillez remplir ce champs
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="card-footer text-right">
                <button class="btn btn-success" type="submit">Enregister</button>
                <button class="btn btn-danger">Annuler</button>
            </div>
        </form>
    </div>



</section>
@endsection
@section('scripts')

<!-- Page Specific JS File -->

<script src="../assets/js/page/forms-advanced-forms.js" async></script>
@endsection