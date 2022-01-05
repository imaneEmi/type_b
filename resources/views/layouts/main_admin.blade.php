<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>UCA</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li hidden><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element" hidden>
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        <div class="search-backdrop"></div>

                    </div>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Bienvenue, {{ Auth::user()->name }}&nbsp;{{
                                Auth::user()->prenom
                                }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">

                            <a href="{{ route('edit.profile') }}" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Paramètres
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{route('home')}}">uca</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">UCA</a>
                    </div>
                    <ul class="sidebar-menu">

                        <li class="menu-header">Tableau de bord</li>
                        <li @if (Route::is('dashboard.admin')) class="nav-item dropdown active" @endif>
                            <a href="{{ route('dashboard.admin') }}" class="nav-link"><i class="fas fa-fire"></i><span>Tableau de bord</span></a>

                        </li>
                        <li class="nav-item {{Route::is('statistiques.admin')?'active':''}} ">
                            <a href="{{ route('statistiques.admin') }}" class="nav-link"><i class="fas fa-fire"></i><span>Statistiques</span></a>
                        </li>

                        <li class="menu-header">Liste des Demandes</li>
                        <li class="nav-item dropdown {{Route::is('demandes.courantes')?'active':''}}"><a class="" href="{{ route('demandes.courantes') }}">
                                <i class="fas fa-folder-open"></i>
                                <span> Courantes</span>
                            </a></li>
                        <li class="nav-item dropdown {{Route::is('demandes.acceptees')?'active':''}}"><a class="" href="{{ route('demandes.acceptees') }}">
                                <i class="fas fa-folder"></i>
                                <span>Acceptées</span>
                            </a></li>
                        <li class="nav-item dropdown {{Route::is('demandes.refusees')?'active':''}}"><a class="" href="{{ route('demandes.refusees') }}">
                                <i class="fas fa-window-close"></i>
                                <span>Refusées</span>
                            </a></li>
                        <li class="nav-item dropdown {{Route::is('demandes')?'active':''}}"><a class="" href="{{ route('archive') }}">
                                <i class="fas fa-archive"></i>
                                <span>Archive</span>
                            </a></li>

                        <li class="menu-header">Paramétres</li>
                        <li class="nav-item dropdown {{Route::is('edit.budgetFixe') || Route::is('edit.frais') || Route::is('edit.pieces') ?'active':''}}">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i><span>Liste des
                                    paramétres</span></a>
                            <ul class="dropdown-menu ">
                                <li class="{{Route::is('edit.budgetFixe') ? 'active':''}}"><a class="{{Route::is('edit.budgetFixe') ? 'beep beep-sidebar':''}}" href="{{ route('edit.budgetFixe') }}">Budget Total Fixe</a></li>
                                <li class="{{Route::is('edit.frais')?'active':''}}"><a class="{{Route::is('edit.frais')?'beep beep-sidebar':''}}" href="{{ route('edit.frais') }}">Frais couvert</a></li>
                                <li class="{{Route::is('edit.pieces')?'active':''}}"><a class="{{Route::is('edit.pieces')?'beep beep-sidebar':''}}" href="{{ route('edit.pieces') }}">Pieces demandées</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown {{Route::is('edit.profile')?'active':''}}">
                            <a href="{{ route('edit.profile') }}" class="nav-link">
                                <i class="fas fa-user"></i>
                                <span>Admin</span>
                            </a>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <!-- End of Main Content -->
            <footer class="main-footer">
                <div class="footer-right">Copyright &copy; Made with 🧡 by EL OUADI, KHADIM and EL AIMANI
                </div>
            </footer>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous" defer>
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js" defer>
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <script src="../assets/js/cleave.js/dist/cleave.min.js"></script>

    <script src="../assets/js/select2/dist/js/select2.full.min.js"></script>
    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    @yield('scripts')
</body>

</html>