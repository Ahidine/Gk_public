@extends('Admin.dashboard', ['activePage' => 'emp', 'menuParent' => 'Gestions_RH', 'titlePage' => __(' Gestion des pre-inscrits')])
@section('content')     
<div class="col-md-12" style="margin-top: 100px;">
  <form method="post" action="{{ route('Employe.store') }}"  class="form-horizontal" enctype="multipart/form-data">
    @csrf 

    <div class="card">
      <div class="card-header card-header-rose card-header-icon" role="tab" id="headingOne">
        <div class="card-icon">
          <i class="material-icons">assignment</i>
        </div>

        <h4 class="mb-0">
          <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
           Ajouter un employe

         </a>
       </h4>
     </div>
     <div class="card-body">
      <div class="row">
       <div class="col-md-12 text-right">
        <a href="{{ route('Employe.store') }}"  class="btn btn-sm btn-rose">{{ __('Back to list') }}</a>
      </div>
      <label class="col-sm-2 col-form-label">Nom </label>
      <div class="col-sm-10">
        <div class="form-group">
          <input name="nom" type="text"  value=" {{ old('nom') }} " class="@error('nom') is-invalid @enderror form-control" required>
          @if ($errors->has('nom'))
          <span class="error">{{ $errors->first('nom') }}</span>
          @endif

        </div>
      </div>
    </div>
    <div class="row">
      <label class="col-sm-2 col-form-label">Prenom </label>
      <div class="col-sm-10">
        <div class="form-group">
          <input name="prenom" type="text"  value=" {{ old('prenom') }}"  class="form-control @error('prenom') is-invalid @enderror" required>
          @if ($errors->has('prenom'))
          <span class="error">{{ $errors->first('prenom') }}</span>
          @endif
        </div>
      </div>
    </div>
    <div class="row">
      <label class="col-sm-2 col-form-label"> Sex </label>
      <div class="col-sm-10">
        <div class="form-group">
          <select name="sex" value=" {{ old('sex') }}" class="selectpicker  @error('prenom') is-invalid @enderror" data-size="3" data-style="select-with-transition" title="" required>
           <option selected hidden value >Selectionner !</option>
           <option value="1">Homme</option>
           <option value="0">Femme</option>


         </select>
         @if ($errors->has('sex'))
         <span class="error">{{ $errors->first('sex') }}</span>
         @endif
       </div>
     </div>
   </div>
   <div class="row">
    <label class="col-sm-2 col-form-label">Date naissance</label>
    <div class="col-sm-10">
      <div class="form-group">
       <input name="date_naissance" value=" {{ old('date_naissance') }}" type="text"  data-date-format='Y-MM-DD'   class="form-control datepicker @error('date_naissance') is-invalid @enderror" required>

       @if ($errors->has('date_naissance'))
       <span class="error">{{ $errors->first('date_naissance') }}</span>
       @endif
     </div>
   </div>
 </div>
 <div class="row">
  <label class="col-sm-2 col-form-label"> Centre </label>
  <div class="col-sm-10">
    <div class="form-group">
      <select multiple value=" {{ old('centre_id') }}" class="selectpicker @error('centre') is-invalid @enderror" data-size="7" data-style="select-with-transition" title="Centre !" name="centre[]" >
        @foreach($centres as $c)
        <option value="{{$c->id}}">{{$c->nom}}</option>
        @endforeach

      </select>
      @if ($errors->has('centre'))
      <span class="error">{{ $errors->first('centre') }}</span>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label">Fonction</label>
  <div class="col-sm-10">
    <div class="form-group">
      <select value=" {{ old('fonction') }}" class="selectpicker @error('fonction') is-invalid @enderror" data-size="7" data-style="select-with-transition" title="Fonction !" name="fonction" required>
        <option value="Responsable">Directeur</option>
        <option value="Responsable_commerciale">Responsable Commerciale</option>
        <option value="Responsable_pedagogique">Responsable Pedagogique</option>
      </select>
      @if ($errors->has('fonction'))
      <span class="error">{{ $errors->first('fonction') }}</span>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label">Type</label>
  <div class="col-sm-10">
    <div class="form-group">
      <select value=" {{ old('Type') }}" class="selectpicker @error('Type') is-invalid @enderror" data-size="7" data-style="select-with-transition" title="Type !" name="Type" required>
        <option value="Independant">Independant</option>
        <option value="Eleve-Independant"> Eleve Independant</option>
        <option value="Employer">Employer</option>
      </select>
      @if ($errors->has('Type'))
      <span class="error">{{ $errors->first('Type') }}</span>
      @endif
    </div>
  </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label">Salaire</label>
  <div class="col-sm-6">
    <div class="form-group">
     <input name="salaire" type="number" step="any" value=" {{ old('salaire') }}" class="form-control @error('salaire') is-invalid @enderror" required>
     @if ($errors->has('salaire'))
     <span class="error">{{ $errors->first('salaire') }}</span>
     @endif
   </div>
 </div>
 <div class="col-sm-4">
  <div class="form-group">
   <select  value=" {{ old('devise') }}" class="selectpicker @error('devise') is-invalid @enderror" data-size="4" data-style="select-with-transition" title="Devise !" name="devise" required>
    <option value="$">$</option>
    <option selected value="€">€</option>
    <option value="DH">DH</option>

  </select>
  @if ($errors->has('devise'))
  <span class="error">{{ $errors->first('devise') }}</span>
  @endif
</div>
</div>

</div>
<div class="row">
  <label class="col-sm-2 col-form-label">Date Affectation</label>
  <div class="col-sm-10">
    <div class="form-group">
     <input value=" {{ old('date_affectation') }}" name="date_affectation" type="text"  data-date-format='Y-MM-DD'   class=" @error('date_affectation') is-invalid @enderror form-control datepicker" required>
     @if ($errors->has('date_affectation'))
     <span class="error">{{ $errors->first('date_affectation') }}</span>
     @endif
   </div>
 </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label">Tel Mobile </label>
  <div class="col-sm-10">
    <div class="form-group">
     <input value=" {{ old('Tel_mobile') }}" name="mobile" type="number"  class="form-control @error('mobile') is-invalid @enderror" required>
     @if ($errors->has('mobile'))
     <span class="error">{{ $errors->first('mobile') }}</span>
     @endif
   </div>
 </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label">Tel Fixe </label>
  <div class="col-sm-10">
    <div class="form-group">
     <input name="fixe" type="number" value=" {{ old('Tel_fixe') }}" class="form-control @error('fixe') is-invalid @enderror" >
     @if ($errors->has('fixe'))
     <span class="error">{{ $errors->first('fixe') }}</span>
     @endif
   </div>
 </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label">Adresse </label>
  <div class="col-sm-10">
    <div class="form-group">
     <input name="adresse" type="text" value=" {{ old('adresse') }}"  class="form-control @error('adresse') is-invalid @enderror" required>
     @if ($errors->has('adresse'))
     <span class="error">{{ $errors->first('adresse') }}</span>
     @endif
   </div>
 </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label">Email </label>
  <div class="col-sm-10">
    <div class="form-group">
     <input name="email" type="email" value=" {{ old('email') }}"  class=" @error('email') is-invalid @enderror form-control" required>
     @if ($errors->has('email'))
     <span class="error">{{ $errors->first('email') }}</span>
     @endif
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