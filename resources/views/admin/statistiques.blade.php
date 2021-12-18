@extends('layouts.main_admin')

@section('content')
<section class="section">

    <div class="row">



        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">Statistiques sur les demandes

                    </div>


                    <div class="card-stats-items mb-5">

                        <div class="card-stats-item mt-5">
                            <div class="card-stats-item-count">$nbrTotalCourant}}</div>
                            <div class="card-stats-item-label text-info font-weight-bold text-uppercase">Courantes</div>
                        </div>
                        <div class="card-stats-item mt-5">
                            <div class="card-stats-item-count"> $nbrTotalAccepte}}</div>
                            <div class="card-stats-item-label text-success font-weight-bold text-uppercase">Acceptées</div>
                        </div>
                        <div class="card-stats-item mt-5">
                            <div class="card-stats-item-count"> $nbrTotalRefused}}</div>
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
                        $nbrTotal}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">Statistiques sur les demandes

                    </div>


                    <div class="card-stats-items mb-5">

                        <div class="card-stats-item mt-5">
                            <div class="card-stats-item-count">$nbrTotalCourant}}</div>
                            <div class="card-stats-item-label text-info font-weight-bold text-uppercase">Courantes</div>
                        </div>
                        <div class="card-stats-item mt-5">
                            <div class="card-stats-item-count"> $nbrTotalAccepte}}</div>
                            <div class="card-stats-item-label text-success font-weight-bold text-uppercase">Acceptées</div>
                        </div>
                        <div class="card-stats-item mt-5">
                            <div class="card-stats-item-count"> $nbrTotalRefused}}</div>
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
                        $nbrTotal}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <h2 class="section-title">Statistiques</h2>
    <p class="section-lead"></p> -->

    <div class="col-lg-6">
        <div class="card gradient-bottom">
            <div class="card-header">
                <h4>Budget Annuel Par Années</h4>
                <div class="card-header-action dropdown">
                    <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Du</a>
                    <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <li class="dropdown-title">Selectionner l'année</li>
                        @foreach($annees as $annee)
                        <li><a href="#" class="dropdown-item">{{$annee->annee}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-header-action dropdown">
                    <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Jusqu'à</a>
                    <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <li class="dropdown-title">Selectionner l'année</li>
                        @foreach($annees as $annee)
                        <li><a href="#" class="dropdown-item">{{$annee->annee}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="card-body" id="top-5-scroll">
                <ul class="list-unstyled list-unstyled-border">
                    @foreach($annees as $annee)

                    <li class="media">
                        <img class="mr-3 rounded" width="55" src="../assets/img/products/product-3-50.png" alt="product">
                        <div class="media-body">
                            <div class="float-right">
                                <div class="font-weight-600 text-muted text-small">86 Sales</div>
                            </div>
                            <div class="media-title">oPhone S9 Limited</div>
                            <div class="mt-1">
                                <div class="budget-price">
                                    <div class="budget-price-square bg-primary" data-width="64%"></div>
                                    <div class="budget-price-label">$68,714</div>
                                </div>
                                <div class="budget-price">
                                    <div class="budget-price-square bg-danger" data-width="43%"></div>
                                    <div class="budget-price-label">$38,700</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>
            <div class="card-footer pt-3 d-flex justify-content-center">
                <div class="budget-price justify-content-center">
                    <div class="budget-price-square bg-primary" data-width="20"></div>
                    <div class="budget-price-label">Budget Annuel Fixe</div>
                </div>
                <div class="budget-price justify-content-center">
                    <div class="budget-price-square bg-danger" data-width="20"></div>
                    <div class="budget-price-label">Budget Annuel Restant</div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-6 col-md-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4>Demandes Acceptées Par établissement</h4>
            </div>
            <div class="card-body">
                @if(empty($nbrTotalAccepte))
                <div class="alert alert-primary alert-has-icon">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <div class="alert-title">Infos</div>
                        Aucune demande n'est acceptée
                    </div>
                </div>@else
                @foreach($demandesAcceParEtab as $demandeacc)

                <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">$demandeacc->total}}</div>
                    <div class="font-weight-bold mb-1">$demandeacc->libelle}}</div>
                    <div class="progress progress-bar-success" data-height="20">

                        <div class="progress-bar progress-bar-success" role="progressbar" data-width=" (($demandeacc->total)/$nbrTotalAccepte)*100}}%" aria-valuenow=" (($demandeacc->total)/$nbrTotal)*100}}" aria-valuemin="0" aria-valuemax="100">
                            (($demandeacc->total)/$nbrTotalAccepte)*100}}%
                        </div>
                    </div>


                </div>
                @endforeach

                @endif









            </div>
        </div>


    </div>



</section>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
<script src="../assets/js/page/components-statistic.js" async></script>


@endsection