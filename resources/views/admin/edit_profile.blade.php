@extends('layouts.main_admin')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Admin</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Profile</div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                        <h4>Modifier Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Nom</label>
                                <input type="text" class="form-control" value="">
                                <div class="invalid-feedback">
                                    Veuillez remplir ce champs
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Prenom</label>
                                <input type="text" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Email</label>
                                <input type="email" class="form-control" value="ujang@maman.com">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Tel</label>
                                <input type="tel" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Mot de passe</label>
                                <input type="password" class="form-control" value="ujang@maman.com">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Confirmer Mot de passe</label>
                                <input type="password" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Enregister</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                        <h4>Ajouter admin</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Nom</label>
                                <input type="text" class="form-control" value="">
                                <div class="invalid-feedback">
                                    Veuillez remplir ce champs
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Prenom</label>
                                <input type="text" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Email</label>
                                <input type="email" class="form-control" value="ujang@maman.com">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Tel</label>
                                <input type="tel" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Mot de passe</label>
                                <input type="password" class="form-control" value="ujang@maman.com">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Confirmer Mot de passe</label>
                                <input type="password" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Enregister</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
