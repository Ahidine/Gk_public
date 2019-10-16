@extends('Admin.dashboard', ['activePage' => 'centre', 'menuParent' => 'Gestions', 'titlePage' => __(' Gestion des centres')])

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
            <h4 class="card-title">{{ __('Centres') }} <a style="float: right;" href="{{ route('centre.create') }}" class="btn btn-sm btn-rose">{{ __('Add Centre') }}</a> </h4>

          </div>
          <div class="card-body">



            <div class="table-responsive">
              <table id="datatables" class="table table-striped table-no-bordered table-hover">
                <thead class="text-primary">

                  <th >
                    {{ __('Centres') }}
                  </th>
                  <th >
                    {{ __('Adresse') }}
                  </th>
                  <th >
                    {{ __('Ville') }}
                  </th>
                  <th >
                    {{ __('Directeur') }}
                  </th>
                  <th >
                    {{ __('N élèves') }}
                  </th>
                  <th >
                    {{ __('N Professeurs') }}
                  </th>
                  <th >
                    {{ __('Date de création') }}
                  </th>

                  <th  >

                    {{ __('Actions') }}
                  </th>

                </thead>
                <tbody>

                  @foreach($centres as $centre)
                  <tr>

                    <td >
                      {{ $centre->nom }}
                    </td>
                    <td >
                      {{ $centre->adresse }}
                    </td >
                    <td >
                      {{ $centre->ville->nom }}
                    </td>
                    <td >
                      {{ $centre->responsable->nom }}
                    </td>
                    <td >
                      {{ $centre->eleve_count }}
                    </td>
                    <td >
                      {{ $centre->employe_count }}
                    </td>
                    <td >
                      {{ $centre->created_at}}
                    </td>
                    <td class="td-actions text-right" > 
                      <form action="{{ route('centre.destroy', $centre) }}" method="post">
                        @csrf
                        @method('delete')
                      <a rel="tooltip" class="btn btn-success btn-link edit" href="{{ route('centre.edit',$centre) }}" data-original-title="" title="">
                        <i class="material-icons">edit</i>
                        <div class="ripple-container"></div>
                      </a>

                        <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this center?") }}') ? this.parentElement.submit() : ''">
                          <i class="material-icons">close</i>
                          <div class="ripple-container"></div>
                        </button>

                      </form>



                    </td>

                  </tr>
                  @endforeach
                </tbody>
              </table>
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