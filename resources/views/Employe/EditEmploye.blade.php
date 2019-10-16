@extends('Admin.dashboard', ['activePage' => 'emp', 'menuParent' => 'Gestions_RH', 'titlePage' => __(' Gestion des pre-inscrits')])
@section('content')     
<div class="col-md-12" style="margin-top: 100px;">
  <form method="post" action="{{ route('Employe.update',$employe->id) }}"  class="form-horizontal" enctype="multipart/form-data">
    @csrf 
    @method('put')

    <div class="card">
      <div class="card-header card-header-rose card-header-icon" role="tab" id="headingOne">
        <div class="card-icon">
          <i class="material-icons">assignment</i>
        </div>

        <h4 class="mb-0">
          <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
           Modifier un employe

         </a>
       </h4>
     </div>
     <div class="card-body">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="row">
       <div class="col-md-12 text-right">
        <a href="{{ route('Employe.store') }}" class="btn btn-sm btn-rose">{{ __('Back to list') }}</a>
      </div>
      <label class="col-sm-2 col-form-label">Nom </label>
      <div class="col-sm-10">
        <div class="form-group">
          <input name="nom" type="text" value="{{ $employe->nom }}"  class="form-control" required>
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
          <input name="prenom" type="text" value="{{ $employe->prenom }}"  class="form-control" required>
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
          <select name="sex" class="selectpicker" data-size="3" data-style="select-with-transition" title="">
           <option selected hidden>Selectionner !</option>
           <option value="1" {{ ( $employe->sex == 1) ? 'selected' : '' }}>Homme</option>
           <option value="0" {{ ( $employe->sex == 0) ? 'selected' : '' }}>Femme</option>


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
       <input name="date_naissance" type="text"  data-date-format='Y-MM-DD' value="{{ $employe->date_naissance }}=='1'"   class="form-control datepicker" required>
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
      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Centre !" name="centre[]" multiple>
        @foreach($centres as $c)
        <option value="{{$c->id}}" {{ ( $id_centres->contains($c->id)) ? 'selected' : '' }}>{{$c->nom}}</option>
        @endforeach

      </select>
      @if ($errors->has('centre'))
      <span class="error">{{ $errors->first('centre') }}</span>
      @endif'
    </div>
  </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label">Fonction</label>
  <div class="col-sm-10">
    <div class="form-group">
      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Fonction !" name="fonction">
        <option value="Professeur" {{ ( $employe->fonction == 'Professeur') ? 'selected' : '' }}>Professeur</option>
        <option value="Responsable" {{ ( $employe->fonction == 'Responsable') ? 'selected' : '' }}>Responsable</option>
        <option value="Responsable_commerciale" {{ ( $employe->fonction == 'Responsable_commerciale') ? 'selected' : '' }}>Responsable Commerciale</option>
        <option value="Responsable_pedagogique"  {{ ( $employe->fonction == 'Responsable_pedagogique') ? 'selected' : '' }}>Responsable Pedagogique</option>
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
      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Centre !" name="Type">
        <option value="Independant" {{ ( $employe->Type == 'Independant') ? 'selected' : '' }} >Independant</option>
        <option value="Eleve-Independant" {{ ( $employe->Type == 'Eleve-Independant') ? 'selected' : '' }}> Eleve Independant</option>
        <option value="Employer" {{ ( $employe->Type == 'Employer') ? 'selected' : '' }}>Employer</option>
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
     <input name="salaire" type="number" value="{{ $employe->salaire }}"  class="form-control" required>
     @if ($errors->has('salaire'))
     <span class="error">{{ $errors->first('salaire') }}</span>
     @endif
   </div>
 </div>
 <div class="col-sm-4">
  <div class="form-group">
   <select class="selectpicker" data-size="4" data-style="select-with-transition" title="Devise !" name="devise">
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
     <input name="date_affectation" value="{{ $employe->date_affectation }}" type="text"  data-date-format='Y-MM-DD'   class="form-control datepicker" required>
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
     <input name="Tel_mobile" type="number" value="{{ $employe->Tel_mobile }}" class="form-control" required>
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
     <input name="Tel_fixe" type="number"  value="{{ $employe->Tel_fixe }}" class="form-control" required>
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
     <input name="adresse" type="text" value="{{ $employe->adresse }}" class="form-control" required>
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
     <input name="email" type="email" value="{{ $employe->email }}"   class="form-control" required>
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
      <input type="file" name="contrat" class="form-control" >
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
      <input type="file" name="cv" class="form-control" >
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
      <input type="file" name="diplomes" value=" {{ $employe->path_diplomes }}" class="form-control @error('diplomes') is-invalid @enderror" id="diplomes"  accept=".zip" >
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