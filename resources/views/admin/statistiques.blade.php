@extends('layouts.main_admin')

@section('title')
Statistiques
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Statistiques</h1>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Rechercher</h4>
        </div>
        <div class="card-body">

            <form method="post" action="{{route('statistiques.search')}}" id="search_form">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="budgetDemandes">Budgets/Demandes</label>

                        <select id="budgetDemandes" class="form-control" name="budgetDemandes">
                            <option value="budget" selected>Budgets</option>
                            <option value="demande">Demandes</option>

                        </select>

                    </div>

                    <div class="form-group col-md-3">
                        <label for="etablissements">Etablissement</label>
                        <select id="etablissements" class="form-control" onChange="onChange();" name="etablissements">
                            <option value="all" selected>Tous les établissement</option>

                            @foreach (Session::get('etablissements') as $etablissement)
                            <option id="{{$etablissement->id}}" value="{{$etablissement->id}}">{{$etablissement->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="structuresScientifiques">Structure scientifique</label>
                        <select id="structuresScientifiques" class="form-control" name="structuresScientifiques">
                            <option value="all" selected>Toutes les structures scientifiques</option>

                            @foreach (Session::get('entiteOrganisatrices') as $entite)
                            <option id="{{$entite->etab_id}}" value="{{$entite->id}}">{{$entite->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="annees">Année</label>


                        <select id="annees" class="form-control" name="annees">
                            <option selected value="all">Toutes les années</option>

                            @foreach (Session::get('annees') as $annee)
                            <option value="{{$annee->annee}}">{{$annee->annee}}</option>
                            @endforeach
                        </select>


                    </div>

                    <div class="form-group col-md-2 text-center mt-1 ">

                        <a href="#" id="inputState" class="mb-3 mt-4 h-50 w-50 btn btn-icon icon-left btn-primary bg-primary" onclick="document.getElementById('search_form').submit();"><i class="mt-2 fas fa-search"></i> </a>

                    </div>




                </div>
            </form>
        </div>
    </div>
    @if(!empty(Session::get('result')))
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Résultats de la recherche</h4>
                <div class="card-header-action">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-btn">

                                <button class="btn btn-primary bg-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                @if(!empty($isBudget) && $isBudget==true)
                <div class="section-title mt-0">Budget(s) Annuel(s)</div>
                @else
                <div class="section-title mt-0">Demande(s)</div>
                @endif
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Etablissement(s)</th>
                            <th scope="col">Structure(s) Scientifique(s)</th>
                            <th scope="col">Année(s)</th>
                            <th scope="col">Budget(s) Annuel(s)</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach(Session::get('result') as $r)
                        <tr>
                            <td scope="row">{{$r->nom_etablissement}}</td>

                            <td>{{$r->nom_labo}}</td>
                            @php $year = substr($r->date_debut, 0, 4); @endphp


                            <td>{{$year}}</td>
                            <td>{{$r->montant}} MAD</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    @endif
</section>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
<script src="{{asset('../assets/js/page/components-statistic.js')}}" async></script>
<script>
    function onChange() {
        var selectParent = document.getElementById("etablissements");
        var keyword = selectParent[selectParent.selectedIndex].id;
        var select = document.getElementById("structuresScientifiques");
        var matched = "false";
        for (var i = 0; i < select.length; i++) {
            var value = select.options[i].id;
            if (!value.match(keyword)) $(select.options[i]).attr('disabled', 'disabled').hide();
            else {
                $(select.options[i]).removeAttr('disabled').show();
                matched = "true";
            }
        }
        if (matched == "false") select.options[0].innerHTML = "Aucune structure scientifique existante";
        else select.options[0].innerHTML = "Toutes les structures scientifiques";
    }
</script>

@endsection
