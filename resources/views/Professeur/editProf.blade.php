@extends('Admin.dashboard', ['activePage' => 'Prof', 'menuParent' => '', 'titlePage' => __(' Gestion des enseignants')])
@section('content')
<div class="col-md-12" style="margin-top: 100px;">
  <div class="card ">
    <div class="card-header card-header-rose card-header-text">
      <div class="card-text">
        <h4 class="card-title">Modification d'un professeur</h4>
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
      <form method="post" action="{{ route('Prof.update', $Pr->id) }}" autocomplete="off"  class="form-horizontal" enctype="multipart/form-data">
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
                  <input name="nom" type="text" value="{{ old('nom', $Pr->employe->nom) }}"  class="form-control" required>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Prenom du Professeur </label>
              <div class="col-sm-10">
                <div class="form-group">
                  <input name="prenom" type="text"  value="{{ old('prenom', $Pr->employe->prenom) }}"   class="form-control" required>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 col-form-label">Sex</label>
              <div class="col-sm-10">
                <div class="form-group">
                 <select name="sex" class="selectpicker" data-size="3" data-style="select-with-transition" title="">
                   <option selected hidden>Selectionner !</option>
                   @if($Pr->employe->sex)
                   <option value="1" selected>Homme</option>
                   <option value="0">Femme</option>
                   @else
                   <option value="0" selected>Femme</option>
                   <option value="1">Homme</option>
                   @endif


                 </select>
               </div>
             </div>
           </div>

           <div class="row">
            <label class="col-sm-2 col-form-label">Date de naissance</label>
            <div class="col-sm-10">
              <div class="form-group">
                <input name="date_naissance" type="text" value="{{ old('date_naissance', $Pr->employe->date_naissance) }}"  data-date-format='Y-MM-DD'   class="form-control datepicker" required>
              </div>
            </div>
          </div>


          <div class="row">
            <label class="col-sm-2 col-form-label">Numero Mobile</label>
            <div class="col-sm-10">
              <div class="form-group">
               <input name="Tel_mobile" type="number"  value="{{ old('Tel_mobile', $Pr->employe->Tel_mobile) }}" class="form-control" required>
             </div>
           </div>
         </div>

         <div class="row">
          <label class="col-sm-2 col-form-label">Numero Fixe</label>
          <div class="col-sm-10">
            <div class="form-group">
             <input name="Tel_fixe" type="number" value="{{ old('Tel_fixe', $Pr->employe->Tel_fixe) }}"  class="form-control" >
           </div>
         </div>
       </div>
       <div class="row">
        <label class="col-sm-2 col-form-label">Adresse</label>
        <div class="col-sm-10">
          <div class="form-group">
           <input name="adresse" type="text" value="{{ old('adresse', $Pr->employe->adresse) }}"  class="form-control" >
         </div>
       </div>
     </div>
     <div class="row">
      <label class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <div class="form-group">
         <input name="email" type="text" value="{{ old('email', $Pr->employe->email) }}"  class="form-control" >
       </div>
     </div>
   </div>
 <div class="row">
  <label class="col-sm-2 col-form-label"> Centre </label>
  <div class="col-sm-10">
    <div class="form-group">
      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Centre !" multiple name="centre[]">
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
<input type="hidden" name="fonction" value="Professeur">
<div class="row">
  <label class="col-sm-2 col-form-label">Type</label>
  <div class="col-sm-10">
    <div class="form-group">
      <select class="selectpicker" data-size="7" data-style="select-with-transition" title="Type !" name="Type">
        <option value="Independant" {{ ( $Pr->employe->Type == 'Independant') ? 'selected' : '' }} >Independant</option>
        <option value="Eleve-Independant" {{ ( $Pr->employe->Type == 'Eleve-Independant') ? 'selected' : '' }}> Eleve Independant</option>
        <option value="Employer" {{ ( $Pr->employe->Type == 'Employer') ? 'selected' : '' }}>Employer</option>
      </select>
      @if ($errors->has('Type'))
      <span class="error">{{ $errors->first('Type') }}</span>
      @endif
    </div>
  </div>

</div>
          <div class="row">
            <label class="col-sm-2 col-form-label">Ancienneté</label>
            <div class="col-sm-10">
              <div class="form-group">
               <input name="anciennete" type="number"  value="{{ old('anciennete', $Pr->anciennete) }}" class="form-control" >
             </div>
           </div>
         </div>
   <div class="row">
    <label class="col-sm-2 col-form-label">Nombre de seance</label>
    <div class="col-sm-10">
      <div class="form-group">
       <input name="nombreSeance" type="text" value="{{ old('nombreSeance', $Pr->nombreSeance) }}"  class="form-control" >
     </div>
   </div>
 </div>
 <div class="row">
  <label class="col-sm-2 col-form-label">Salaire Par seance</label>
  <div class="col-sm-6">
    <div class="form-group">
     <input name="salaire" type="number" value="{{ old('salaire', $Pr->employe->salaire) }}"  class="form-control" required>
   </div>
 </div>
 <div class="col-sm-4">
  <div class="form-group">
   <select class="selectpicker" data-size="4" data-style="select-with-transition" title="Devise !" name="devise">
    <option value="$"  {{$Pr->employe->devise=='$' ? 'selected' : '' }}>$</option>
    <option value="€"  {{$Pr->employe->devise=='€' ? 'selected' : '' }}>€</option>
    <option value="DH" {{$Pr->employe->devise=='DH' ? 'selected' : '' }}>DH</option>

  </select>
</div>
</div>

</div>
<div class="row">
  <label class="col-sm-2 col-form-label">Date Affectation</label>
  <div class="col-sm-10">
    <div class="form-group">
     <input name="date_affectation" type="text"  value="{{ old('date_affectation', $Pr->employe->date_affectation) }}" data-date-format='Y-MM-DD' class="form-control datepicker"  required>
   </div>
 </div>
</div>
<div class="row">
  <label class="col-sm-2 col-form-label" for="contrat">Contrat </label>
  <div class="col-sm-10">
    <div >
      <input type="file" name="contrat" class="form-control"  value=" {{ $Pr->employe->path_contrat }}">
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
      <input type="file" name="cv" value=" {{ $Pr->employe->path_Cv }}" class="form-control" >
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
      <input type="file" name="diplomes" value=" {{ $Pr->employe->path_diplomes }}" class="form-control @error('diplomes') is-invalid @enderror" id="diplomes"  accept=".zip" >
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
        <profcvedit-component :professeur="{{ $Pr }}"> </profcvedit-component>
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