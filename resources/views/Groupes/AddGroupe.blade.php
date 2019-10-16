@extends('Admin.dashboard', ['activePage' => 'groupe', 'menuParent' => 'Gestions', 'titlePage' => __(' Gestion des centres')])

@section('content')
<div class="col-md-12" style="margin-top: 100px;">
  <div class="card ">
    <div class="card-header card-header-rose card-header-text">
      <div class="card-text">
        <h4 class="card-title">Ajouter un groupe</h4>
      </div>
    </div> 
    <div class="card-body ">
      <form method="Post" action="{{ route('Groupe.store') }}" class="form-horizontal">
        @csrf
        <div class="row">
         <div class="col-md-12 text-right">
          <a href="{{ route('Groupe.index') }}" class="btn btn-sm btn-rose">{{ __('Back to list') }}</a>
        </div>
      </div>

      <div id="app">
        <addgroupe-component 
        :centres="{{$centres}}" 
        :trimestres="{{$trimestres}}"
        :modules="{{$modules}}"
        :niveaux="{{$niveaux}}"> 
       </addgroupe-component>
      </div>


      <div class="text-right">
        <button type="submit" class="btn btn-primary btn-round mt-4">{{ __('Ajouter') }}</button>
      </div>
    </div>
  </div>
</div>
</form>
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