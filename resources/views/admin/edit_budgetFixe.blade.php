@extends('layouts.main_admin')

@section('content')
<section class="section">
    <div class="section-header">

        <h1>Budget Annuel de l'année</h1>
    </div>
    <div class="card ">
        <form method="post" id="saveBudgetForm" class="needs-validation" novalidate="" action="{{route('save.budgetFixe')}}">
            @csrf
            <div class="card-header">
                <h4>Ajouter un nouveau budget annuel</h4>

            </div>
            @if(!empty($error) && $error==1)
            <div class="alert alert-danger alert-has-icon">
                <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                <div class="alert-body">
                    <div class="alert-title">Attention</div>
                    Vous avez déjà fixé le budget pour l'année saisie!
                </div>
            </div>
            @endif
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
                            <input type="text" class="form-control year" name="annee" required onkeyup="manage(this)">
                            <div class="invalid-feedback">
                                Veuillez remplir ce champs
                            </div>
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
                            <input type="number" class="form-control " min=0 name="budget" required onkeyup="manage(this)">
                            <div class="invalid-feedback">
                                Veuillez remplir ce champs
                            </div>
                        </div>
                    </div>

                </div>
        </form>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-success" disabled id="submit">Enregistrer</button>

    </div>




    </div>



</section>
@endsection
@section('scripts')

<!-- Page Specific JS File -->

<script src="{{asset('../assets/js/page/forms-advanced-forms.js')}}" async></script>
<script src="{{asset('../assets/js/sweetalert/dist/sweetalert.min.js')}}"></script>

<script>
    function manage(txt) {
        var bt = document.getElementById('submit');
        var ele = document.getElementsByTagName('input');

        // Loop through each element.
        for (i = 0; i < ele.length; i++) {

            // Check the element type
            if (ele[i].type == 'text' && ele[i].value == '') {
                bt.disabled = true; // Disable the button.
                return false;
            } else {
                bt.disabled = false; // Enable the button.
            }
        }
    }

    $("#submit").click(function() {
        swal({
                title: 'Est ce que vous  êtes sûr?',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.getElementById('saveBudgetForm').submit();


                } else {
                    swal('Votre opération a été annulée!');
                }
            });
    });
</script>
@if (!empty($success))
<script>
    swal('Succés', 'le budget a été bien enregistré!', 'success');
</script>
@endif
@endsection