@extends('Admin.dashboard', ['activePage' => 'inscr', 'menuParent' => 'Gestions_inscriptions', 'titlePage' => __('ajouter un eleve')])
@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="col-md-8 col-12 mr-auto ml-auto">
      <!--      Wizard container        -->
      <div class="wizard-container">
        <div class="card card-wizard" data-color="rose" id="wizardProfile">
          <form id="myforme" action="{{ route('Eleve.store') }}" method="post">
            <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
            {{csrf_field()}}
            <div class="card-header text-center">
              <h3 class="card-title">
                Fiche d'inscription
              </h3>
            </div>
            <input type="hidden" name="eleve" value="{{ $eleve->id }}">
            <div class="wizard-navigation">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link active" href="#eleve" data-toggle="tab" role="tab">
                    Information sur l'eleve
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#parents" data-toggle="tab" role="tab">
                    Information sur les parents
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="#affectation" data-toggle="tab" role="tab">
                    Affectation
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="#paiement" data-toggle="tab" role="tab">
                    Payement
                  </a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane" id="parents">

                  <div class="row justify-content-center">

                    <div class="col-sm-10">
                      <div class="input-group form-control-lg">

                        <div class="input-group-prepend">
                          <span class="input-group-text">
                           <i class="fa fa-female" aria-hidden="true"></i>

                         </span>
                       </div>

                       <div class="form-group">
                        <label for="nom_mere" class="bmd-label-floating">Nom de mére </label>
                        <input type="text" class="form-control"  id="nom_mere" name="mere_nom" required>
                      </div>
                    </div>
                    <div class="input-group form-control-lg">

                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         <i class="fa fa-male" aria-hidden="true"></i>
                       </span>
                     </div>

                     <div class="form-group">
                      <label for="nom_pere" class="bmd-label-floating">Nom du pére</label>
                      <input type="text" class="form-control"  id="nom_pere" name="pere_nom" required>
                    </div>
                  </div>

                  <div class="input-group form-control-lg">

                    <div class="input-group-prepend">
                      <span class="input-group-text">
                       <i class="fa fa-mobile" aria-hidden="true"></i>
                     </span>
                   </div>

                   <div class="form-group">
                    <label for="num_mere" class="bmd-label-floating">Numéro de mére</label>
                    <input type="number" class="form-control" id="num_mere"  name="mobile_mere" required>
                  </div>
                </div>
                <div class="input-group form-control-lg">

                  <div class="input-group-prepend">
                    <span class="input-group-text">
                     <i class="fa fa-mobile" aria-hidden="true"></i>
                   </span>
                 </div>

                 <div class="form-group">
                  <label for="num_pere" class="bmd-label-floating">Numéro du pére</label>
                  <input type="number" class="form-control" id="num_pere"  name="mobile_pere" required>
                </div>
              </div>
              <div class="input-group form-control-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-phone-square" aria-hidden="true"></i>
                  </span>
                </div>
                <div class="form-group">
                  <label for="num_fixe" class="bmd-label-floating">Numéro fixe</label>
                  <input type="number" class="form-control" id="num_fixe" name="fixe" >
                </div>
              </div>

              <div class="input-group form-control-lg">

                <div class="input-group-prepend">
                  <span class="input-group-text">
                   <i class="fa fa-envelope-o" aria-hidden="true"></i>
                 </span>
               </div>

               <div class="form-group">
                <label for="email_mere" class="bmd-label-floating">Email de mére</label>
                <input type="email" class="form-control" id="email_mere"  name="email_mere" >
              </div>
            </div>
            <div class="input-group form-control-lg">

              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
              </div>

              <div class="form-group">
                <label for="email_pere" class="bmd-label-floating">Email du pére</label>
                <input type="email" class="form-control" id="email_pere"  name="email_pere" >
              </div>
            </div>

            <div class="input-group form-control-lg">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="fa fa-home" aria-hidden="true"></i>
                </span>
              </div>
              <div class="form-group">
                <label for="adresse" class="bmd-label-floating">Adresse</label>
                <input type="text" class="form-control"  id="adresse" name="adresse1" required>
              </div>
            </div>

        </div>

      </div> 
    </div>


    <div class="tab-pane active" id="eleve">

      <div class="row justify-content-center">
        <div class="col-sm-4">
          <div class="picture-container">
            <div class="picture">
              <img src="../../assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title="" />
              <input type="file" name="photo" id="wizard-picture">
            </div>
            <h6 class="description">Choose Picture</h6>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="input-group form-control-lg">

            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">face</i>
              </span>
            </div>

            <div class="form-group">
              <label for="prenom" class="bmd-label-floating">Prénom</label>
              <input type="text" class="form-control" value="{{ $eleve->prenom }}" id="prenom" name="prenom" required>
            </div>
          </div>
          <div class="input-group form-control-lg">

            <div class="input-group-prepend">
              <span class="input-group-text">
               <i class="material-icons">record_voice_over</i>
             </span>
           </div>

           <div class="form-group">
            <label for="nom" class="bmd-label-floating">Nom</label>
            <input type="text" class="form-control" value="{{ $eleve->nom }}" id="nom" name="nom" required>
          </div>
        </div>
        <div class="input-group form-control-lg">

          <div class="input-group-prepend">
            <span class="input-group-text">
             <i class="fas fa-birthday-cake"></i>
           </span>
         </div>

         <div class="form-group">
          <label for="dateN" class="bmd-label-floating">Age</label>
          <input type="number" class="form-control" id="dateN" value="{{ $eleve->age }}" name="age" required>
        </div>
      </div>
      <div class="input-group form-control-lg">
        <div class="input-group-prepend">
          <span class="input-group-text">
            <i class="fa fa-venus-mars" aria-hidden="true"></i>
          </span>
        </div>
        <div class="form-group">
          <label for="sex" class="bmd-label-floating">Sex</label>
          <select class="selectpicker" name="sex" data-size="2" data-style="select-with-transition" title="sex">
            @if($eleve->sex==1)
            <option value="1" selected > Garcon </option>
             <option value="0"> Fille </option>
            @else
            <option value="1"> Garcon </option>
            <option value="0" selected > Fille </option>
            @endif
          </select>
        </div>
      </div>
      <div class="input-group form-control-lg">
        <div class="input-group-prepend">
          <span class="input-group-text">
           <i class="fas fa-flag-checkered"></i>
         </span>
       </div>
       <div class="form-group">
        <label for="nationalite" class="bmd-label-floating">Nationalité</label>
        <input type="text" class="form-control" value="{{ $eleve->nationalite=='null' ? 'Belgique': $eleve->nationalite }}" id="nationalite" name="nationalite" required>
      </div>
    </div>
    <div class="input-group form-control-lg">
      <div class="input-group-prepend">
        <span class="input-group-text">
         <i class="fas fa-address-card"></i>
       </span>
     </div>
     <div class="form-group">
      <label for="adresse" class="bmd-label-floating">Adresse</label>
      <input type="text" class="form-control" id="adresse" value="{{ $eleve->adresse }}" name="adresse" required>
    </div>
  </div>
</div>

</div> 
</div>


<div class="tab-pane" id="affectation">

  <div id="app">
    <table-component :centre="{{$eleve->centre}}"> </table-component>
  </div>

</div>


<div class="tab-pane" id="paiement">
<div id="appseconde">
  <addpaiement-component> </addpaiement-component>
</div>
</div>
</div>
</div>
<div class="card-footer">
  <div class="mr-auto">
    <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Previous">
  </div>
  <div class="ml-auto">
    <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" name="next" value="Next">
    <input type="submit" class="btn btn-finish btn-fill btn-rose btn-wd" name="finish" value="Finish" style="display: none;">
  </div>
  <div class="clearfix"></div>
</div>
</form>
</div>
</div>
<!-- wizard container -->
</div>
</div>


</div>

@endsection

@push('js')

<script>
  $(document).ready(function() {
      // Initialise the wizard
      demo.initMaterialWizard();
      setTimeout(function() {
        $('.card.card-wizard').addClass('active');
      }, 600);
    });
  </script>

  <script>
    function setFormValidation(id) {
      $(id).validate({
        highlight: function(element) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
          $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
        },
        success: function(element) {
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
          $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        errorPlacement: function(error, element) {
          $(element).closest('.form-group').append(error);
        },
      });
    }

    $(document).ready(function() {
      setFormValidation('#myforme');
    });
  </script>
  @endpush