<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Genuis Kids ERP
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" />
  <style type="text/css">
    div.dataTables_wrapper div.dataTables_paginate ul.pagination {
      justify-content: center !important;

    }
    .notdisplay
    {
      display: none;
    }
    input[readonly] {
  background-color: white !important;
}

  </style>
  <script src="https://kit.fontawesome.com/957af0a155.js"></script>
  
</head>
<body class="{{ $class ?? '' }}">
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
  <div class="wrapper ">
    <div class="sidebar" data-color="rose" data-background-color="black" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="http://geniuskids.be" class="simple-text logo-mini">
      GK
    </a>
    <a href="#" class="simple-text logo-normal">
      {{ __('Espace Admin') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <div class="user">
      <div class="photo">
        <img src="{{ auth()->user()->profilePicture() }}" />
      </div>
      <div class="user-info">
        <a data-toggle="collapse" href="#collapseExample" class="username">
          <span>
            {{ auth()->user()->name }}
          </span>
        </a>

      </div>
    </div>
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ Route('Admin.index') }}">
          <i class="material-icons">dashboard</i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ $menuParent == 'Gestions_inscriptions' ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Gestions_inscriptions" {{ $menuParent == 'Gestions_inscriptions' ? 'aria-expanded="true"' : '' }}>
          <i class="material-icons">apps</i>
          <p> Gestions Des Élèves
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ $menuParent == 'Gestions_inscriptions' ? ' show' : '' }}" id="Gestions_inscriptions">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'pre_insc' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('Eleve.PreIns') }}">
                <span class="sidebar-mini"> pre </span>
                <span class="sidebar-normal"> {{ __('Pré-inscriptions') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'inscr' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('Eleve.ListeInsc') }}">
                <span class="sidebar-mini"> insc </span>
                <span class="sidebar-normal"> {{ __('Inscriptions') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'abs_eleve' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('Eleves.Absences') }}">
                <span class="sidebar-mini"> pre </span>
                <span class="sidebar-normal"> {{ __('Absences') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ $menuParent == 'Gestions' ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Gestions" {{ $menuParent == 'Gestions' ? 'aria-expanded="true"' : '' }}>
          <i class="material-icons">build</i>
          <p> Gestions 
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ $menuParent == 'Gestions' ? ' show' : '' }}" id="Gestions">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'centre' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('centre.index') }}">
                <span class="sidebar-mini"> CTR </span>
                <span class="sidebar-normal"> {{ __('Centres') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'niveau' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('Niveau.index') }}">
                <span class="sidebar-mini"> NIV </span>
                <span class="sidebar-normal"> {{ __('Niveaux') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'groupe' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('Groupe.index') }}">
                <span class="sidebar-mini"> GRP </span>
                <span class="sidebar-normal"> {{ __('Groupes') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{ $menuParent == 'Gestions_RH' ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Gestions_RH" {{ $menuParent == 'Gestions_RH' ? 'aria-expanded="true"' : '' }}>
          <i class="material-icons">apps</i>
          <p> Gestions RH
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ $menuParent == 'Gestions_RH' ? ' show' : '' }}" id="Gestions_RH">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'emp' ? ' active' : '' }} ">
              <a class="nav-link" href="{{route('Employe.index')}}">
                <span class="sidebar-mini"> EMP </span>
                <span class="sidebar-normal"> {{ __('Les Employes') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'abs' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('ListePrAbsences') }}">
                <span class="sidebar-mini"> ABS </span>
                <span class="sidebar-normal"> {{ __('Absences') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ $menuParent == 'Gestion_ET' ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#Gestion_ET" {{ $menuParent == 'Gestion_ET' ? 'aria-expanded="true"' : '' }}>
        <i class="material-icons">date_range</i>
          <p> Emplois du temps
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ $menuParent == 'Gestion_ET' ? ' show' : '' }}" id="Gestion_ET">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'CSLT' ? ' active' : '' }} ">
              <a class="nav-link" href="{{route('Emplois_Temps')}}">
                <span class="sidebar-mini"> CSLT </span>
                <span class="sidebar-normal"> {{ __('Consulter ') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'CRT' ? ' active' : '' }} ">
              <a class="nav-link" href="{{ route('Emplois.create') }}">
                <span class="sidebar-mini"> CRE </span>
                <span class="sidebar-normal"> {{ __('Creer') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'Prof' ? ' active' : '' }} ">
        <a class="nav-link" href="{{ route('Prof.index') }}">
          <i class="material-icons">perm_identity</i>
          <p> Enseignants </p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'calendrie' ? ' active' : '' }} ">
        <a class="nav-link" href="{{ route('events.index') }}">
          <i class="fas fa-calendar-check"></i>
          <p> Calendrier</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'charts' ? ' active' : '' }} ">
        <a class="nav-link" href="{{ route('Admin.create') }}">
          <i class="material-icons">group</i>
          <p> Utilisateurs </p>
        </a>
      </li>
    </ul>
  </div>
</div>
<div class="main-panel"> 
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <div class="navbar-minimize">
          <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
            <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
            <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
          </button>
        </div>
        <a class="navbar-brand" href="#pablo">{{ $titlePage }}</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <form class="navbar-form">
          <div class="input-group no-border">
            <input type="text" value="" class="form-control" placeholder="Search...">
            <button type="submit" class="btn btn-white btn-round btn-just-icon">
              <i class="material-icons">search</i>
              <div class="ripple-container"></div>
            </button>
          </div>
        </form>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="material-icons">dashboard</i>
              <p class="d-lg-none d-md-block">
                {{ __('Stats') }}
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">notifications</i>
              <span class="notification">5</span>
              <p class="d-lg-none d-md-block">
                {{ __('Some Actions') }}
              </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">{{ __('Mike John responded to your email') }}</a>
              <a class="dropdown-item" href="#">{{ __('You have 5 new tasks') }}</a>
              <a class="dropdown-item" href="#">{{ __('You\'re now friend with Andrew') }}</a>
              <a class="dropdown-item" href="#">{{ __('Another Notification') }}</a>
              <a class="dropdown-item" href="#">{{ __('Another One') }}</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">person</i>
              <p class="d-lg-none d-md-block">
                {{ __('Account') }}
              </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
              <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
              <a class="dropdown-item" href="#">{{ __('Settings') }}</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  @yield('content')

</div>
</div>


<div class="fixed-plugin">
  <div class="dropdown show-dropdown">
    <a href="#" data-toggle="dropdown">
      <i class="fa fa-cog fa-2x"> </i>
    </a>
    <ul class="dropdown-menu">
      <li class="header-title"> Sidebar Filters</li>
      <li class="adjustments-line">
        <a href="javascript:void(0)" class="switch-trigger active-color">
          <div class="badge-colors ml-auto mr-auto">
            <span class="badge filter badge-purple" data-color="purple"></span>
            <span class="badge filter badge-azure" data-color="azure"></span>
            <span class="badge filter badge-green" data-color="green"></span>
            <span class="badge filter badge-warning" data-color="orange"></span>
            <span class="badge filter badge-danger" data-color="danger"></span>
            <span class="badge filter badge-rose active" data-color="rose"></span>
          </div>
          <div class="clearfix"></div>
        </a>
      </li>
      <li class="header-title">Sidebar Background</li>
      <li class="adjustments-line">
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="ml-auto mr-auto">
            <span class="badge filter badge-black active" data-background-color="black"></span>
            <span class="badge filter badge-white" data-background-color="white"></span>
            <span class="badge filter badge-red" data-background-color="red"></span>
          </div>
          <div class="clearfix"></div>
        </a>
      </li>
      <li class="adjustments-line">
        <a href="javascript:void(0)" class="switch-trigger">
          <p>Sidebar Mini</p>
          <label class="ml-auto">
            <div class="togglebutton switch-sidebar-mini">
              <label>
                <input type="checkbox">
                <span class="toggle"></span>
              </label>
            </div>
          </label>
          <div class="clearfix"></div>
        </a>
      </li>
      <li class="adjustments-line">
        <a href="javascript:void(0)" class="switch-trigger">
          <p>Sidebar Images</p>
          <label class="switch-mini ml-auto">
            <div class="togglebutton switch-sidebar-image">
              <label>
                <input type="checkbox" checked="">
                <span class="toggle"></span>
              </label>
            </div>
          </label>
          <div class="clearfix"></div>
        </a>
      </li>
      <li class="header-title">Images</li>
      <li class="active">
        <a class="img-holder switch-trigger" href="javascript:void(0)">
          <img src="{{ asset('material') }}/img/sidebar-1.jpg" alt="">
        </a>
      </li>
      <li>
        <a class="img-holder switch-trigger" href="javascript:void(0)">
          <img src="{{ asset('material') }}/img/sidebar-2.jpg" alt="">
        </a>
      </li>
      <li>
        <a class="img-holder switch-trigger" href="javascript:void(0)">
          <img src="{{ asset('material') }}/img/sidebar-3.jpg" alt="">
        </a>
      </li>
      <li>
        <a class="img-holder switch-trigger" href="javascript:void(0)">
          <img src="{{ asset('material') }}/img/sidebar-4.jpg" alt="">
        </a>
      </li>
    </ul>
  </div>
</div>
<!--   Core JS Files   -->
<script src="{{ asset('material') }}/js/core/jquery.min.js"></script>
<script src="{{ asset('material') }}/js/core/popper.min.js"></script>
<script src="{{ asset('material') }}/js/core/bootstrap-material-design.min.js"></script>
<script src="{{ asset('material') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Plugin for the momentJs  -->
<script src="{{ asset('material') }}/js/plugins/moment.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="{{ asset('material') }}/js/plugins/sweetalert2.js"></script>
<!-- Forms Validations Plugin -->
<script src="{{ asset('material') }}/js/plugins/jquery.validate.min.js"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{ asset('material') }}/js/plugins/jquery.bootstrap-wizard.js"></script>
<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{ asset('material') }}/js/plugins/bootstrap-selectpicker.js"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{ asset('material') }}/js/plugins/bootstrap-datetimepicker.min.js"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
<!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{ asset('material') }}/js/plugins/bootstrap-tagsinput.js"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset('material') }}/js/plugins/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{ asset('material') }}/js/plugins/fullcalendar.min.js"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{ asset('material') }}/js/plugins/jquery-jvectormap.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{ asset('material') }}/js/plugins/nouislider.min.js"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="{{ asset('material') }}/js/plugins/arrive.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chartist JS -->
<script src="{{ asset('material') }}/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('material') }}/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('material') }}/js/material-dashboard.js?v=2.1.0" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('material') }}/demo/demo.js"></script>
<script src="{{ asset('material') }}/js/application.js"></script>
<script>
  $(document).ready(function () {
    @if (session('success'))
    $.notify({
      icon: "done",
      message: "{{ session('success') }}"
    }, {
      type: 'success',
      timer: 3000,
      placement: {
        from: 'top',
        align: 'right'
      }
    });
    @php
    Session::forget('success');
    @endphp
    @endif
  });
  $(document).ready(function () {
    @if (session('error'))
    $.notify({
      icon: "done",
      message: "{{ session('error') }}"
    }, {
      type: 'danger',
      timer: 3000,
      placement: {
        from: 'top',
        align: 'left'
      }
    });
    @php
    Session::forget('error');
    @endphp
    @endif
  });
  $(document).ready(function () {
    @if (session('warning'))
    $.notify({
      icon: "done",
      message: "{{ session('warning') }}"
    }, {
      type: 'warning',
      timer: 3000,
      placement: {
        from: 'top',
        align: 'center'
      }
    });
    @php
    Session::forget('warning');
    @endphp
    @endif
  });
</script>
@stack('js')



<script src="{{ asset('js/app.js') }}" defer></script>


</body>
</html>