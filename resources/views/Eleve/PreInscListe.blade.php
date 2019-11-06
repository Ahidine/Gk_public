@extends('Admin.dashboard', ['activePage' => 'pre_insc', 'menuParent' => 'Gestions_inscriptions', 'titlePage' => __('La listes des pré-inscrits')])

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
                <h4 class="card-title">{{ __('Les pré-inscrits') }} <a style="float: right;" href="{{ route('Eleve.Preinsciptions') }}" class="btn btn-sm btn-rose">{{ __('Ajouter un Pre-inscit') }}</a> </h4>
                
              </div>
              <div class="card-body">
 


                <div class="table-responsive">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" style="width: 100% !important">
                    <thead class="text-primary">
                      <th>
                          {{ __('Nom') }}
                      </th>
                      <th>
                        {{ __('Prénom') }}
                      </th>
                      <th>
                        {{ __('Age') }}
                      </th>
                      <th>
                        {{ __('Téléphone') }}
                      </th>
                      <th>
                        {{ __('Commentaire') }}
                      </th>
                      <th> {{ __('Action') }}</th>

                    </thead>
                    <tbody>
                    	
                      @foreach($eleve as $e)
                        <tr>
                          <td class="text-center">
                            {{ $e->nom }}
                          </td>
                          <td class="text-center">
                            {{ $e->prenom }} 
                          </td>
                          <td class="text-center">
                           {{  $e->age }} Ans                           
                          </td>
                          <td class="text-center">
                            {{ $e->numero }} 
                          </td>
                          <td class="text-center">
                            {{ $e->comment }} 
                          </td>


                   
                            <td class="td-actions text-center" >


                                    <form action="{{ route('Eleve.destroy', $e) }}" method="post">
                                        @csrf
                                        @method('delete')
                                           <a rel="tooltip" class="btn btn-success btn-link edit" href="{{ route('Eleve.show',$e->id) }}" data-original-title="" 
                                                                        	title="Valider">
                                  <i class="material-icons">edit</i>
                                  <div class="ripple-container"></div>
                                </a>
                                  
                                          <button type="button" class="btn btn-danger btn-link delete"  title="supp" onclick="confirm('{{ __("Are you sure you want to delete this nivel?") }}') ? this.parentElement.submit() : ''">
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
<script type="text/javascript">
$( "#target" ).click(function() 
{
			$.ajax({
									  type: "POST",
									  url: "http://gk.test/api/preInscriptions",
									  accepet:"application/json ",
									  data: {
									    "data": {
									        "nom": "achrafthree",
									        "prenom": "hidinethree",
									        "numero": "0766332245",
									        "comment": "facebook",
									        "date_naissance": "1996-08-10",
									        "centre_name":"centre_A"
												}
											}.done(function(data)
											{
									             
									            // show the response
									            $('#response').html(data);
									        })
					});
});
</script>
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
