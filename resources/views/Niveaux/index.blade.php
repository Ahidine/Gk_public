@extends('Admin.dashboard', ['activePage' => 'niveau', 'menuParent' => 'Gestions', 'titlePage' => __(' Gestion des centres')])

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
                <h4 class="card-title">{{ __('Niveaux') }} <a style="float: right;" href="{{ route('Niveau.create') }}" class="btn btn-sm btn-rose">{{ __('Ajouter un Niveau') }}</a> </h4>
                
              </div>
              <div class="card-body">
 


                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover">
                    <thead class="text-primary">
                      <th>
                          {{ __('Niveau') }}
                      </th>
                      <th>

                          {{ __('Age') }}
                      </th>
                      <th>

                        {{ __('Centre') }}
                      </th>
                      <th>
                        {{ __('Prix') }}
                      </th>
                      <th>
                        {{ __('Modules') }}
                      </th>
                      <th> {{ __('Action') }}</th>

                    </thead>
                    <tbody>
                      
                      @foreach($niveau as $n)
                        <tr>
                          <td>
                            {{ $n->type }}
                          </td>
                          <td>

                            {{ $n->min_age }}-{{ $n->max_age }} ans
                          </td>
                          <td>
                      @foreach($n->centre()->get() as $c)
                          <li>
                            {{ $c->nom}}
                          </li>
                       @endforeach
                          </td>
                          <td>
                     @foreach($n->centre()->get() as $c)
                          <li>
                            {{ $c->pivot->prix}} {{ $c->pivot->devise}}
                          </li>
                       @endforeach                         

                          </td>

                          <td>
                      @foreach($n->module()->get() as $module)
                          <li>
                            {{ $module->nom_module}}
                          </li>
                       @endforeach
                          </td>
                   
                            <td class="td-actions text-right">


                                    <form action="{{ route('Niveau.destroy', $n) }}" method="post">
                                        @csrf
                                        @method('delete')
      <a rel="tooltip" class="btn btn-success btn-link edit" href="{{ route('Niveau.edit',$n->id) }}" data-original-title="" title="">
                                  <i class="material-icons">edit</i>
                                  <div class="ripple-container"></div>
                                </a>
                                  
                                          <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to delete this nivel?") }}') ? this.parentElement.submit() : ''">
                                              <i class="material-icons">close</i>
                                              <div class="ripple-container"></div>
                                          </button>
                                 
                                    </form>
                                
                               </td>

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