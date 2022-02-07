@extends('layouts.main_admin')

@section('title')
Administration
@endsection

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
                <form method="post" action="{{ route('profile.admin') }}" id="updateForm" class="needs-validation" novalidate="">
                    @csrf
                    <div class="card-header">
                        <h4>Modifier Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Nom</label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}" required>
                                <div class="invalid-feedback">

                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Prenom</label>
                                <input type="text" class="form-control" name="prenom" value="{{$user->prenom}}" required>
                                <div class="invalid-feedback">
                                    Veuillez remplir ce champs
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Email </label>
                                <input type="email" class="form-control" value="{{$user->email}}" disabled>
                                <div class="invalid-feedback">
                                    Veuillez remplir ce champs
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Tel</label>
                                <input type="tel" class="form-control" name="tel" value="{{$user->tel}}">
                            </div>
                            <div class="form-group  col-12">
                                <label>Fax</label>
                                <input type="tel" class="form-control" name="fax" value="{{$user->fax}}">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="updateProfile" name="updateProfile">

                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Enregister</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                @if ($errors->any())
                <div class="alert alert-danger alert-has-icon">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <form method="POST" class="needs-validation" action="{{ route('profile.admin') }}">
                    @csrf
                    <div class="card-header">
                        <h4>Ajouter admin</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Nom</label>
                                <input type="text" class="form-control" name="nameAdmin">
                                <div class="invalid-feedback">
                                    Veuillez remplir ce champs
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Prenom</label>
                                <input type="text" class="form-control" name="prenomAdmin">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Tel</label>
                                <input type="tel" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Mot de passe</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Confirmer Mot de passe</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="addAdmin" name="addAdmin">
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Enregister</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
@endsection