@extends('Admin.dashboard', ['activePage' => 'inscr', 'menuParent' => 'Gestions_inscriptions', 'titlePage' => __('La liste des inscrits')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-rose card-header-icon">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">La Liste des inscrits</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">

                 
          
                      <div id="app">
                      <infoeleve-component :student="{{$eleve}}"> </infoeleve-component >
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
    // Javascript method's body can be found in assets/js/demos.js
    demo.initGoogleMaps();
  });
</script>
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