@extends('layouts.main_admin')

@section('title')
Tableau de bord
@endsection

@section('content')
<section class="section">

    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title card-header  ">
                        Statistiques sur le budget de l'année courante
                        @if(!empty($error) && $error==0)
                        <div style="float: right;"> <a href="#" class="btn btn-primary" id="modal-5">Modifier</a></div>

                        @endif

                    </div>


                    <div class="row">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Budget Fixe</h4>
                            </div>
                            @if(empty($budgetCourantFixe))
                            <div class="card-body">

                                MAD 0
                            </div>
                            @else
                            <div class="card-body">

                                MAD {{$budgetCourantFixe}}
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="row">
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Budget Restant</h4>
                            </div>
                            @if(empty($budgetCourantRestant))
                            <div class="card-body">

                                MAD 0
                            </div>
                            @else
                            <div class="card-body">

                                MAD {{$budgetCourantRestant}}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card card-statistic-2 card-warning">
                <div class="card-stats">
                    <div class="card-stats-title">Statistiques sur les demandes de l'année courante

                    </div>


                    <div class="card-stats-items mb-5">

                        <div class="card-stats-item mt-5">
                            <div class="card-stats-item-count">{{$nbrTotalCourant}}</div>
                            <div class="card-stats-item-label text-info font-weight-bold text-uppercase">Courantes</div>
                        </div>
                        <div class="card-stats-item mt-5">
                            <div class="card-stats-item-count"> {{$nbrTotalAccepte}}</div>
                            <div class="card-stats-item-label text-success font-weight-bold text-uppercase">Acceptées</div>
                        </div>
                        <div class="card-stats-item mt-5">
                            <div class="card-stats-item-count">{{ $nbrTotalRefused}}</div>
                            <div class="card-stats-item-label text-danger font-weight-bold text-uppercase">Refusées</div>
                        </div>

                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total des demandes</h4>
                    </div>
                    <div class="card-body">
                        {{$nbrTotal}}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- <h2 class="section-title">Statistiques</h2>
    <p class="section-lead"></p> -->

    <div class="row">

        <div class="col-12 col-sm-12 col-lg-6">
            <div class="card card-warning">
                <div class="card-header">
                    <h4>Statistiques sur le budget annuel des 4 dernières années</h4>

                </div>
                <div class="card-body">
                    <canvas id="myChart2" height="180"></canvas>
                    <div class="statistic-details mt-1">

                    </div>
                </div>
                <div class="card-footer pt-3 d-flex justify-content-center">
                    <div class="budget-price justify-content-center">
                        <div class="budget-price-square bg-primary" style="color: #6777ef" data-width="20"></div>
                        <div class="budget-price-label">Budget Annuel Restant</div>
                    </div>
                    <div class="budget-price justify-content-center">
                        <div class="budget-price-square bg-danger" data-width="20"></div>
                        <div class="budget-price-label">Budget Annuel Total</div>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h4>Demandes Acceptées Par établissement</h4>
                </div>
                <div class="card-body">
                    @if(empty($nbrTotalAccepte))
                    <div class="alert alert-primary alert-has-icon">
                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                        <div class="alert-body">
                            <div class="alert-title">Infos</div>
                            Aucune demande n'est acceptée jusqu'à présent !
                        </div>
                    </div>@else
                    @foreach($demandesAcceParEtab as $demandeacc)

                    <div class="mb-4">
                        <div class="text-small float-right font-weight-bold text-muted">{{$demandeacc->total}}</div>
                        <div class="font-weight-bold mb-1">{{$demandeacc->nom_etablissement}}</div>
                        <div class="progress progress-bar-success" data-height="20">

                            <div class="progress-bar progress-bar-success" role="progressbar" data-width="{{ (($demandeacc->total)/$nbrTotalAccepte)*100}}%" aria-valuenow="{{ (($demandeacc->total)/$nbrTotal)*100}}" aria-valuemin="0" aria-valuemax="100">
                                @php
                                $number= number_format(((($demandeacc->total)/$nbrTotalAccepte)*100), 2, '.', '');
                                @endphp
                                {{ $number}}%

                            </div>
                        </div>


                    </div>
                    @endforeach

                    @endif









                </div>
            </div>


        </div>



</section>
<form class="modal-part" id="modal-login-part" method="post" id="saveBudgetForm" class="needs-validation" novalidate="" action="{{route('budget.update')}}">
    @csrf
    <p>Veuillez saisir le nouvez budget annuel</p>

    <div class="form-group">
        <label>Budget en (MAD)</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    MAD
                </div>
            </div>
            <input type="number" class="form-control currency @error('budget') is-invalid @enderror" value="{{ old('annee') }}" min=0 name="budget" required>
            @error('budget')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
<script src="{{asset('../assets/js/sweetalert/dist/sweetalert.min.js')}}"></script>

@if (!empty(Session::get('succes')))
<script>
    swal('Succés', 'le budget a été bien modifié!', 'success');
</script>
@endif


<script>
    $("#modal-5").fireModal({
        title: 'Modifier le budget annuel de cette année courante',
        body: $("#modal-login-part"),
        footerClass: 'bg-whitesmoke',
        autoFocus: false,
        onFormSubmit: function(modal, e, form) {

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

    function convertToAray(data) {

        var myvar = data.substr(1, ((data.length) - 2));
        return myvar.split(',');
    }
    var ctx = document.getElementById("myChart2").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: convertToAray('{{($annees)}}'),
            datasets: [{
                label: 'Budget Annuel Total (MAD)',
                data: convertToAray('{{($budgetsAnnuelsFixes)}}'),
                borderWidth: 2,
                backgroundColor: 'rgba(254,86,83,.7)',
                borderColor: 'rgba(254,86,83,.7)',
                borderWidth: 2.5,
                pointBackgroundColor: '#ffffff',
                pointRadius: 4
            }, {
                label: 'Budget Annuel Restant (MAD)',
                data: convertToAray('{{($budgetsAnnuelsRestant)}}'),
                borderWidth: 2,
                backgroundColor: 'rgba(63,82,227,.8)',
                borderColor: 'transparent',
                borderWidth: 0,
                pointBackgroundColor: '#999',
                pointRadius: 4
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 10000
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            },
        }
    });
</script>

@endsection