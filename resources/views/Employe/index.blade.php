@extends('Admin.dashboard', ['activePage' => 'emp', 'menuParent' => 'Gestions_RH', 'titlePage' => __(' Gestion des employes')])

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
            <h4 class="card-title">{{ __('Employe') }} <a style="float: right;" href="{{ route('Employe.create') }}" class="btn btn-sm btn-rose">{{ __('Add Employe') }}</a> </h4>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div id="app">
                <employe-component :employe="{{$employe}}"> </employe-component>
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
<script>
  $(document).ready(function() {
    $('#datatables').DataTable({
      "pagingType": "full_numbers",
      "bInfo" : false,
      "sDom": 'ifrtip',
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Chercher",
      }

    });

    var table = $('#datatable').DataTable();


  });
</script>

@endpush