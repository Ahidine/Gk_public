@extends('Admin.dashboard', ['activePage' => 'Prof', 'menuParent' => '', 'titlePage' => __(' Gestion des enseignants')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header card-header-rose card-header-icon">
            <div class="card-icon">
              <i class="material-icons">recent_actors</i>
            </div>
            <h4 class="card-title">{{ __('Enseignants') }} <a style="float: right;" href="{{ route('Prof.create') }}" class="btn btn-sm btn-rose">{{ __('Add Professeur') }}</a> </h4>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div id="app">
                <profindex-component :professeur="{{$Pr}}"> </profindex-component>
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