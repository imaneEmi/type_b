@extends('layouts.main_admin')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tableau de bord</h1>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-file-alt"></i>
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
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-check"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Demades Acceptées</h4>
                    </div>
                    <div class="card-body">
                        {{$nbrTotalAccepte}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Demades Refusées</h4>
                    </div>
                    <div class="card-body">
                        {{ $nbrTotalRefused
}}
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- <h2 class="section-title">Statistiques</h2>
    <p class="section-lead"></p> -->

    <div class="row">
        <!-- <div class="col-12 col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Summary</h4>
                    <div class="card-header-action">
                        <a href="#summary-chart" data-tab="summary-tab" class="btn active">Chart</a>
                        <a href="#summary-text" data-tab="summary-tab" class="btn">Text</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="summary">
                        <div class="summary-info" data-tab-group="summary-tab" id="summary-text">
                            <h4>$1,858</h4>
                            <div class="text-muted">Sold 4 items on 2 customers</div>
                            <div class="d-block mt-2">
                                <a href="#">View All</a>
                            </div>
                        </div>
                        <div class="summary-chart active" data-tab-group="summary-tab" id="summary-chart">
                            <canvas id="myChart" height="180"></canvas>
                            <div class="statistic-details mt-1">
                                <div class="statistic-details-item">
                                    <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</div>
                                    <div class="detail-value">$243</div>
                                    <div class="detail-name">Today</div>
                                </div>
                                <div class="statistic-details-item">
                                    <div class="text-small text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</div>
                                    <div class="detail-value">$2,902</div>
                                    <div class="detail-name">This Week</div>
                                </div>
                                <div class="statistic-details-item">
                                    <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>9%</div>
                                    <div class="detail-value">$12,821</div>
                                    <div class="detail-name">This Month</div>
                                </div>
                                <div class="statistic-details-item">
                                    <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</div>
                                    <div class="detail-value">$92,142</div>
                                    <div class="detail-name">This Year</div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div> -->
        <div class="col-12 col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Statistiques sur le budget par année</h4>

                </div>
                <div class="card-body">
                    <canvas id="myChart2" height="180"></canvas>
                    <div class="statistic-details mt-1">

                    </div>
                </div>
                <div class="card-footer pt-3 d-flex justify-content-center">
                    <div class="budget-price justify-content-center">
                        <div class="budget-price-square bg-primary" style="color: #6777ef" data-width="20"></div>
                        <div class="budget-price-label" >Budget Annuel Restant</div>
                    </div>
                    <div class="budget-price justify-content-center">
                        <div class="budget-price-square bg-danger" data-width="20"></div>
                        <div class="budget-price-label">Budget Annuel Total</div>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Demandes Acceptées</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="text-small float-right font-weight-bold text-muted">2,100</div>
                        <div class="font-weight-bold mb-1">FSTG</div>
                        <div class="progress" data-height="3">
                            <div class="progress-bar" role="progressbar" data-width="80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="text-small float-right font-weight-bold text-muted">1,880</div>
                        <div class="font-weight-bold mb-1">FSSM</div>
                        <div class="progress" data-height="3">
                            <div class="progress-bar" role="progressbar" data-width="67%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="text-small float-right font-weight-bold text-muted">1,521</div>
                        <div class="font-weight-bold mb-1">ENS</div>
                        <div class="progress" data-height="3">
                            <div class="progress-bar" role="progressbar" data-width="58%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="text-small float-right font-weight-bold text-muted">884</div>
                        <div class="font-weight-bold mb-1">FMPM</div>
                        <div class="progress" data-height="3">
                            <div class="progress-bar" role="progressbar" data-width="36%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="text-small float-right font-weight-bold text-muted">473</div>
                        <div class="font-weight-bold mb-1">FSJES</div>
                        <div class="progress" data-height="3">
                            <div class="progress-bar" role="progressbar" data-width="28%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="text-small float-right font-weight-bold text-muted">418</div>
                        <div class="font-weight-bold mb-1">ENSA SAFI</div>
                        <div class="progress" data-height="3">
                            <div class="progress-bar" role="progressbar" data-width="20%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <input id="annees" type="text" value="{{$annees}}" hidden>
                    </div>
                </div>
            </div>


        </div>

    <div class="row">


    </div>

    <div class="row">


    </div>
</section>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
<script src="../assets/js/page/components-statistic.js" async></script>
<script>
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
                label: 'Budget Annuel Total',
                data: convertToAray('{{($budgetsAnnuelsFixes)}}'),
                borderWidth: 2,
                backgroundColor: 'rgba(254,86,83,.7)',
                borderColor: 'rgba(254,86,83,.7)',
                borderWidth: 2.5,
                pointBackgroundColor: '#ffffff',
                pointRadius: 4
            }, {
                label: 'Budget Annuel Restant',
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
