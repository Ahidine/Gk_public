@extends('Admin.dashboard', ['activePage' => 'CSLT', 'menuParent' => 'Gestion_ET', 'titlePage' => __('Emplois du temps')])
@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="col-md-12 col-12 mr-auto ml-auto">
      <div id="app">
        <emplois-component > </emplois-component>
      </div>
    </div>

</div>
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

  <script type="text/javascript">
    $('.choice').click(function(){
      var radioValue = $("input[name='niveau']:checked").val();
      if(radioValue){
        alert(radioValue);
        $.get('groupes/'+ radioValue, function(data){
          $.each(data,function(index,subcatObj){
            console.log(subcatObj.nom_groupe);

          });
        });

      }

    });
  </script>
  @endpush