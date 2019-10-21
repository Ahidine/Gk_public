@extends('Admin.dashboard', ['activePage' => 'pre_insc', 'menuParent' => 'Gestions_inscriptions', 'titlePage' => __(' Gestion des pre-inscrits')])
@section('content')  
<div class="col-md-12" style="margin-top: 100px;">   
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
          <form method="post" action="{{ route('PreInsc.store') }}"  class="form-horizontal">
          <div class="card">
            <div class="card-header card-header-rose card-header-icon" role="tab" id="headingOne">
              <div class="card-icon">
                <i class="material-icons">assignment</i>
              </div>
@csrf
              <h4 class="mb-0">
                <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                 Ajouter un pré-inscit
                 <i class="material-icons">keyboard_arrow_down</i>
               </a>
             </h4>
           </div>
            <div class="card-body">
              <div class="row">
               <div class="col-md-12 text-right">
                <a href="{{ route('Eleve.PreIns') }}" class="btn btn-sm btn-rose">{{ __('Back to list') }}</a>
              </div>
              <label class="col-sm-2 col-form-label">Nom </label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input name="nom" type="text"   class="form-control" required>
                </div>
              </div>
            </div>
            <div class="row">
            <label class="col-sm-2 col-form-label">Prénom </label>
            <div class="col-sm-10">
              <div class="form-group">
                <input name="prenom" type="text"   class="form-control" required>
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-2 col-form-label">Sex </label>
            <div class="col-sm-10">
        <div class="form-group">
          <select class="selectpicker" name="sex"  data-size="3"  data-style="select-with-transition" title="sex">
            <option value="1">Garçon</option>
            <option value="0">Fille</option>

          </select>
        </div>
            </div>
          </div>

          <div class="row">
            <label class="col-sm-2 col-form-label">Age</label>
            <div class="col-sm-10">
              <div class="form-group">
               <input name="age"  type="number"    class="form-control" required>
             </div>
           </div>
         </div>
       <div class="row">
      <label class="col-sm-2 col-form-label"> Centre </label>
      <div class="col-sm-10">
        <div class="form-group">
          <select class="selectpicker" name="centre"  data-size="7"  data-style="select-with-transition" title="Single Select">
            @foreach($centres as $c)
            <option value="{{$c->id}}">{{$c->nom}}</option>
            @endforeach

          </select>
        </div>
      </div>
    </div>
         <div class="row">
          <label class="col-sm-2 col-form-label">Téléphone </label>
          <div class="col-sm-10">
            <div class="form-group">
             <input name="numero" type="number"  class="form-control" required>
           </div>
         </div>
       </div>
     <div class="row">
      <label class="col-sm-2 col-form-label"> entendu grace á ! </label>
      <div class="col-sm-10">
        <div class="form-group">
          <select class="selectpicker" name="comment" data-size="10"  data-style="select-with-transition" title="Single Select">
            <option disabled selected>Selctionner !</option>
            <option value="Presse">Presse</option>
            <option value="Facebook">Facebook</option>
            <option value="Flyer">Flyer</option>
            <option value="Panneau publicitaire">Panneau publicitaire</option>
            <option value="Internet">Internet</option>
            <option value="Bouche a oreille">Bouche a oreille</option>
            <option value="autre">Autre</option>

          </select>
        </div>
      </div>
    </div>

      <div class="text-right">
        <button type="submit" class="btn btn-primary btn-round mt-4">{{ __('Ajouter') }}</button>
      </div>
 </div>
</div>
</form>
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
@endpush
