@extends('Admin.dashboard', ['activePage' => 'centre', 'menuParent' => 'Gestions', 'titlePage' => __(' Gestion des centres')])

@section('content')
  <div class="col-md-12" style="margin-top: 100px;">
        <div class="card ">
          <div class="card-header card-header-rose card-header-text">
            <div class="card-text">
              <h4 class="card-title">Ajouter un centre</h4>
            </div>
          </div> 
          <div class="card-body ">
            <form method="Post" action="{{ route('centre.store') }}" class="form-horizontal">
                @csrf
              <div class="row">
             <div class="col-md-12 text-right">
                      <a href="{{ route('centre.index') }}" class="btn btn-sm btn-rose">{{ __('Back to list') }}</a>
                  </div>
                <label class="col-sm-2 col-form-label">Nom du centre</label>
                <div class="col-sm-10">
                  <div class="form-group">
                    <input name="nom" type="text" class="form-control" required>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <label class="col-sm-2 col-form-label">Adresse du centre</label>
                <div class="col-sm-10">
                  <div class="form-group">
                     <input name="adresse" type="text" class="form-control" required>
                  </div>
                </div>
              </div>
              <input type="hidden" name="type" value="1">
              <div class="row">
                <label class="col-sm-2 col-form-label">Responsable</label>
                <div class="col-sm-10">
                  <div class="form-group" >

                      <select class="selectpicker" style="display:inline-block" name="responsable" data-style="select-with-transition" title="" data-size="100" required>
                  <option value="" selected hidden>{{ __('Selectionner') }}</option>
                        @foreach($responsables as $r)
                        <option value="{{ $r->id }}" >{{ $r->nom }}</option>
                        @endforeach 
                      </select>
              
                
                     
                  </div>
                </div>
              </div>
              <div id="app">
                <paysville-component> </paysville-component>
              </div>
              <div id="appseconde">
                <add-classes-component> </add-classes-component>
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