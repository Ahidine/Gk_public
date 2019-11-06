@extends('Admin.dashboard', ['activePage' => 'CRT', 'menuParent' => 'Gestion_ET', 'titlePage' => __(' Gestion des emplois du temps')])
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
            <h4 class="card-title"> Modification d'un emplois du temps <!--a style="float: right;" href="#" class="btn btn-sm btn-rose">Ajouter un Niveau</a--> </h4>

          </div>
          <div class="card-body">



            <div class="table-responsive">
              <form method="post" action="{{ route('Emplois_Temps.update') }}">
                        @csrf
                        @method('put')
         
<div id="app">
  <edit-emplois_temps-component :Groupe="{{$groupe}}" > </edit-emplois_temps-component>
</div>
                   
            </div>
           <div class="col-md-3 ml-auto text-right">
          <input type="submit" value="Valider" class="btn btn-rose" >
          </div>
          </div>

        </div>
        </form>
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
      "lengthMenu": [
      [10, 25, 50, -1],
      [10, 25, 50, "All"]
      ],
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