@extends('Admin.dashboard', ['activePage' => 'niveau', 'menuParent' => 'Gestions', 'titlePage' => __(' Gestion des centres')])
@section('content')
<div class="col-md-12" style="margin-top: 100px;">
  <div class="card ">
    <div class="card-header card-header-rose card-header-text">
      <div class="card-text">
        <h4 class="card-title">Modification du niveau </h4>
      </div>
    </div>
    <div class="card-body ">
      <form method="post" action="{{ route('Niveau.update', $niveau->id) }}" autocomplete="off" class="form-horizontal">
        @csrf
        @method('put')
        <div id="accordion" role="tablist">
          <div class="card card-collapse">
            <div class="card-header card-header-rose card-header-icon" role="tab" id="headingOne">
              <div class="card-icon">
                <i class="material-icons">assignment</i>
              </div>

              <h4 class="mb-0">
                <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                 Information sur le niveau 
                 <i class="material-icons">keyboard_arrow_down</i>
               </a>
             </h4>
           </div>

           <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="row">
               <div class="col-md-12 text-right">
                <a href="{{ route('Niveau.index') }}" class="btn btn-sm btn-rose">{{ __('Back to list') }}</a>
              </div>
              <label class="col-sm-2 col-form-label">Nom du niveau </label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input name="type" type="text" value="{{ old('type', $niveau->type) }}"  class="form-control" required>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">min age</label>
              <div class="col-sm-10">
                <div class="form-group">
                 <input name="min_age" type="number" value="{{ old('min_age', $niveau->min_age) }}"  class="form-control" required>
               </div>
             </div>
           </div>
           <div class="row">
            <label class="col-sm-2 col-form-label">max age</label>
            <div class="col-sm-10">
              <div class="form-group">
               <input name="max_age" type="number" value="{{ old('max_age', $niveau->max_age) }}" class="form-control" required>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>

   <div class="card card-collapse">
    <div class="card-header card-header-rose card-header-icon" role="tab" id="headingTwo">

      <div class="card-icon">
        <i class="material-icons">assignment</i>
      </div>
      <h4 class="mb-0">
        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Affectation des centres
          <i class="material-icons">keyboard_arrow_down</i>

        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <div id="app">
         <affectationniveaumodif-component
         :cent="{{$niveau->centre}}" >
       </affectationniveaumodif-component>
     </div>

   </div>
 </div>
</div>

<div class="card card-collapse">
  <div class="card-header card-header-rose card-header-icon"  role="tab" id="headingThree">
    <div class="card-icon">
      <i class="material-icons">assignment</i>
    </div>
    <h4 class="mb-0">
     <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      Affectation Des Modules
      <i class="material-icons">keyboard_arrow_down</i>
    </a></h4>
  </div>
  <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
    <div class="card-body">
     <div class="col-md-12">
      <div id="appseconde">
        <modifmodule-component :modules="{{$modules}}" :ids="{{$ids}}"> </modifmodule-component>
      </div>


    </div>
  </div>
</div>
<div class="text-right">
  <button type="submit" class="btn btn-primary btn-round mt-4">{{ __('Valider') }}</button>
</div>
</form>
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



</script>
@endpush
