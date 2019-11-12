@extends('Admin.dashboard', ['activePage' => 'Prof', 'menuParent' => '', 'titlePage' => __(' Gestion des enseignants')])
@section('content')
<div class="col-md-12" style="margin-top: 100px;">
  <div class="card ">
    <div class="card-header card-header-rose card-header-text">
      <div class="card-text">
        <h4 class="card-title">Ajout d'un Professeur </h4>
      </div>
    </div>
    <div class="card-body ">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form method="post" action="{{ route('Prof.store') }}" autocomplete="off"  class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div id="accordion" role="tablist">
          <div class="card card-collapse">
            <div class="card-header card-header-rose card-header-icon" role="tab" id="headingOne">
              <div class="card-icon">
                <i class="material-icons">assignment</i>
              </div>

              <h4 class="mb-0">
                <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                 Information Personnels 
                 <i class="material-icons">keyboard_arrow_down</i>
               </a>
             </h4>
           </div>

           <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              <div class="row">
               <div class="col-md-12 text-right">
                <a href="{{ route('Prof.index') }}" class="btn btn-sm btn-rose">{{ __('Back to list') }}</a>
              </div>
              <label class="col-sm-2 col-form-label">Nom du Professeur </label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input name="nom" type="text" value=" {{ old('nom') }}"    class="form-control" required>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Prenom du Professeur </label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input name="prenom" type="text" value=" {{ old('prenom') }}"  class="form-control" required>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Sex</label>
              <div class="col-sm-10">
                <div class="form-group">
                 <select name="sex" class="selectpicker" value=" {{ old('sex') }}" data-size="3" data-style="select-with-transition" title="">
                   <option selected hidden value>Selectionner !</option>
                   <option value="1">Homme</option>
                   <option value="0">Femme</option>


                 </select>
               </div>
             </div>
           </div>

           <div class="row">
            <label class="col-sm-2 col-form-label">Date de naissance</label>
            <div class="col-sm-10">
              <div class="form-group">
                <input name="date_naissance" value=" {{ old('date_naissance') }}" type="text"  data-date-format='Y-MM-DD'   class="form-control datepicker" required>
              </div>
            </div>
          </div>


          <div class="row">
            <label class="col-sm-2 col-form-label">Numero Mobile</label>
            <div class="col-sm-10">
              <div class="form-group">
               <input name="mobile" type="number" value=" {{ old('Tel_mobile') }}"  class="form-control" required>
             </div>
           </div>
         </div>

         <div class="row">
          <label class="col-sm-2 col-form-label">Numero Fixe</label>
          <div class="col-sm-10">
            <div class="form-group">
             <input name="fixe" type="number" value=" {{ old('Tel_fixe') }}"  class="form-control" >
           </div>
         </div>
       </div>
       <div class="row">
        <label class="col-sm-2 col-form-label">Adresse</label>
        <div class="col-sm-10">
          <div class="form-group">
           <input name="adresse" type="text" value=" {{ old('adresse') }}" class="form-control" >
         </div>
       </div>
     </div>
     <div class="row">
      <label class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <div class="form-group">
         <input name="email" type="email" value=" {{ old('email') }}" class="form-control" >
       </div>
     </div>
   </div>
   <div class="row">
    <label class="col-sm-2 col-form-label">Ancienneté</label>
    <div class="col-sm-10">
      <div class="form-group">
       <input name="anciennete" type="number" value=" {{ old('anciennete') }}"  class="form-control">
     </div>
   </div>
 </div>
 <div class="row">
  <label class="col-sm-2 col-form-label">Nombre de seance </label>
  <div class="col-sm-10">
    <div class="form-group">
     <input name="nombreSeance" type="number" value=" {{ old('nombreSeance') }}" class="form-control" >
   </div>
 </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label">Salaire Par seance</label>
  <div class="col-sm-6">
    <div class="form-group">
     <input name="salaire" type="number" step="any" value=" {{ old('salaire') }}"  class="form-control" required>
   </div>
 </div>
 <div class="col-sm-4">
  <div class="form-group">
   <select class="selectpicker" data-size="4" data-style="select-with-transition" title="Devise !" name="devise">
    <option value="$">$</option>
    <option selected value="€">€</option>
    <option value="DH">DH</option>

  </select>
</div>
</div>

</div>
<div class="row">
  <label class="col-sm-2 col-form-label">Centre</label>
  <div class="col-sm-10">
    <div class="form-group">
     <select name="centre[]" multiple="" class="selectpicker" 
     value="{{ old('centre') }}" data-size="100" data-style="select-with-transition" title="centres !">
       @foreach($centres as $c)
       <option value="{{ $c->id }}">{{ $c->nom }}</option>
       @endforeach

     </select>
   </div>
 </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label">Type</label>
  <div class="col-sm-10">
    <div class="form-group">
      <select class="selectpicker" data-size="7" value=" {{ old('Type') }}" data-style="select-with-transition" title="Type !" name="Type">
        <option value="Independant">Independant</option>
        <option value="Eleve-Independant"> Eleve Independant</option>
        <option value="Employer">Employer</option>
      </select>
    </div>
  </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label">Date Affectation</label>
  <div class="col-sm-10">
    <div class="form-group">
     <input name="date_affectation" type="text" value=" {{ old('date_affectation') }}" data-date-format='Y-MM-DD' class="form-control datepicker"  required>
   </div>
 </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label" for="contrat">Contrat </label>
  <div class="col-sm-10">
    <div >
      <input type="file" name="contrat" value=" {{ old('path_contrat') }}" class=" form-control @error('contrat') is-invalid @enderror" accept=".pdf,.doc,docx" id="contrat"  required>
      @if ($errors->has('contrat'))
      <span class="error">{{ $errors->first('contrat') }}</span>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label" for="cv">CV </label>
  <div class="col-sm-10">
    <div >
      <input type="file" name="cv" value=" {{ old('path_Cv') }}" class="form-control @error('cv') is-invalid @enderror" accept=".pdf,.doc,docx" id="cv" required>
      @if ($errors->has('cv'))
      <span class="error">{{ $errors->first('cv') }}</span>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label" for="diplomes">Les diplômes </label>
  <div class="col-sm-10">
    <div >
      <input type="file" name="diplomes" value=" {{ old('path_diplomes') }}" class="form-control @error('diplomes') is-invalid @enderror" id="diplomes"  accept=".zip" >
      @if ($errors->has('diplomes'))
      <span class="error">{{ $errors->first('diplomes') }}</span>
      @endif
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
        Information Professionel 
        <i class="material-icons">keyboard_arrow_down</i>

      </a>
    </h4>
  </div>
  <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
    <div class="card-body">
      <div id="app">
       <profcv-component>
       </profcv-component>
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
  $(document).ready(function() {
      // initialise Datetimepicker and Sliders
      md.initFormExtendedDatetimepickers();
      if ($('.slider').length != 0) {
        md.initSliders();
      }
    });
  </script>
  @endpush