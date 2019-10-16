@extends('Admin.dashboard', ['activePage' => 'abs', 'menuParent' => 'Gestions_RH', 'titlePage' => __('Absences')])

@section('content')
<div class="content">
  <div class="container-fluid card">
    <div class="card-header card-header-rose card-header-text">
      <div class="card-icon">
        <i class="material-icons">av_timer</i>
      </div>
      <h4 class="card-title">L'absences des employes
      </h4>
    </div>

    <div class="card-body">
      <div class="col-md-12 ml-auto mr-auto">
        <div class="card ">
          <div class="card-body ">
            <div id="app">
            <absence-component :villes="{{ $villes }}"  :employes="{{ $employes }}"> </absence-component>
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
      // initialise Datetimepicker and Sliders
      md.initFormExtendedDatetimepickers();
      if ($('.slider').length != 0) {
        md.initSliders();
      } 
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




