@extends('Admin.dashboard', ['activePage' => 'Gestions_users', 'menuParent' => '', 'titlePage' => __(' Gestion des utilisateurs')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-rose card-header-icon">
            <div class="card-icon">
              <i class="material-icons">recent_actors</i>
            </div>
            <h4 class="card-title">{{ __('Users') }} </h4>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div id="app">
                
                <users-component > 

                </users-component>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@endsection
@push('js')


@endpush