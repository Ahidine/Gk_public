<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/957af0a155.js"></script>
</head>
<body>
                          <div class="row"> 
        <div class="col-md-12" id="autre" >
            <div class="card">
              <div class="card-header card-header-rose card-header-icon">
                <div class="card-icon">
                  <i class="fas fa-university"></i>
                </div>
                <h4 class="card-title">{{ __('Les groupes') }}  </h4>
                
              </div>
              <div class="card-body">
 
                <table id="datatables" class="table table-striped table-no-bordered table-hover">
                    <thead class="text-primary">
                      <th>
                          {{ __('Nom') }}
                      </th>
                      <th>
                        {{ __('Capacite') }}
                      </th>
                      <th>
                        {{ __('Nombres Inscrits') }}
                      </th>
                      <th>
                        {{ __('Nombres Restans') }}
                      </th>
                      <th> {{ __('Action') }}</th>

                    </thead>
                    <tbody id="body">
                      
                      @foreach($groupes as $g)
                        <tr>
                          <td>
                            {{ $g->nom_groupe }}
                          </td>
                          <td>
                            {{ $g->capacite }} 
                          </td>
                          <td>
                           {{  $g->eleve()->count() }}                           
                          </td>
                          <td>
                            {{ $g->capacite - $g->eleve()->count() }} 
                          </td>
                            <td class="td-actions text-right">
                  <div class="form-check form-check-inline">
                    <label class="form-check-label">
                      <input class="form-check-input" name="groupe_id"  type="radio" value="{{ $g->id }}"> 
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div>
                                
                               </td>

                            </td>

                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                <div class="table-responsive" >

                  
                </div>
              </div>
            </div>
        </div>
                        </div>
   
</body>
</html>
<script type="text/javascript">
  $('.choice').click(function(){
    var radioValue = $("input[name='niveau']:checked").val();
            if(radioValue){
                  document.getElementById('monframe').src='http://gk.test/Eleve/groupes/'+radioValue;
            
            $('#monframe').css('display','block');

            }

});
</script>
               