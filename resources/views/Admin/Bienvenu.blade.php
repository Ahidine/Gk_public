@extends('Admin.dashboard', ['activePage' => 'dashboard', 'menuParent' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
  <div class="container">
    <div class=" col-md-6 ml-auto mr-auto
 card card-nav-tabs text-center">
  <div class="card-header card-header-primary">
    Super Admin
  </div>
  <div class="card-body">
    <p class="card-text"> Bonjour Monsieur , ce compte represente le compte du super Admin qui a la main de faire ce qu'il veut , il a une vision globales sur la plateforme</p>

  </div>
</div>


                <hr>
    <div class="panel panel-primary">
  <div class="row">
          <div class="col-4">
            <div class="card card-pricing card-raised">
              <div class="card-body">
                <h6 class="card-category">Centres</h6>
                <div class="card-icon icon-primary">
                  <i class="fa fa-university" aria-hidden="true"></i>
                </div>
                <h3 class="card-title">{{ $centres  }} centres</h3>
                
                <p class="card-description">
                  Genuis Kides possède des centres dans différentes villes afin d'aider les enfants à s'améliorer leurs compétences   .
                </p>
                <a href="{{ route('centre.index') }}" class="btn btn-primary btn-round">Decouvrir les  centres</a>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card card-pricing card-raised">
              <div class="card-body">
                <h6 class="card-category">Niveau</h6>
                <div class="card-icon icon-warning">
                  <i class="material-icons">home</i>
                </div>
                <h3 class="card-title">{{ $niveau  }} niveaux</h3>
                <p class="card-description">
                  Différents niveaux existent dans Genuis Kides dans le but de donner les chances à tous les enfants de différents age.
                </p>
                <a href="{{ route('Niveau.index') }}" class="btn btn-warning btn-round">découvrir  les niveaux</a>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card card-pricing card-raised">
              <div class="card-body">
                <h6 class="card-category">Groupes</h6>
                <div class="card-icon icon-rose">
                  <i class="fa fa-users" aria-hidden="true"></i>
                </div>
                <h3 class="card-title">{{ $groupes }} groupes</h3>
                <p class="card-description">
                  Chaque niveau possède plusieurs groupes, et leurs capacités ne dépassent pas 15, afin d'engendrer  un environnement confortable aux  chers enfants .
                </p>
                <a href="{{ Route('Groupe.index') }}" class="btn btn-rose btn-round">Découvrir les groupes </a>
              </div>
            </div>
          </div>


  </div>
  <div class="row">
          <div class="col-4">
            <div class="card card-pricing card-raised">
              <div class="card-body">
                <h6 class="card-category">Professeurs</h6>
                <div class="card-icon icon-succes">
                  <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h3 class="card-title">{{ $professeurs }} professeurs</h3>
                <p class="card-description">
                    Des Professeurs compétents travaillent dans nos centres avec des CV riches, des principes et des valeurs et surtout de bonne formation pédagogique.
                </p>
                <a href="{{ route('Prof.index') }}" class="btn btn-succes btn-round">Decouvrir les  professeurs</a>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card card-pricing card-raised">
              <div class="card-body">
                <h6 class="card-category">Les élèves </h6>
                <div class="card-icon icon-info">
                  <i class="fa fa-child" aria-hidden="true"></i>
                </div>
                <h3 class="card-title">{{ $eleves  }} élèves</h3>
                <p class="card-description">
                  Des élèves de différents ages ont rejoint nos centre, des élèves qui cherchent à augmenter leur puissance mentale et se distinguer des autres  .
                </p>
                <a href="{{ route('Eleve.ListeInsc') }}" class="btn btn-info btn-round">découvrir  nos élèves</a>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card card-pricing card-raised">
              <div class="card-body">
                <h6 class="card-category">Les responsables</h6>
                <div class="card-icon icon-success">
                 <i class="fas fa-user-tie"></i>
                </div>
                <h3 class="card-title">{{ $employes }} responsables</h3>
                <p class="card-description">
                  Des responsables de qualites et de quantites travaillent jours et nuits afin de satisfaires les besoins de nos chers élèves. 
                </p>
                <a href="{{ Route('Employe.index') }}" class="btn btn-success btn-round">Découvrir les responsables  </a>
              </div>
            </div>
          </div>


  </div>
    </div>
</div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

      md.initVectorMap();

    });

  </script>
@endpush
