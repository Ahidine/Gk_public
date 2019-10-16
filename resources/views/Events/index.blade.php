@extends('Admin.dashboard', ['activePage' => 'calendrie', 'menuParent' => '', 'titlePage' => __('Calendarie')])

@section('content')
<div class="content">
  <div class="container-fluid card">
    <div class="card-header card-header-rose card-header-text">
      <div class="card-icon">
        <i class="material-icons">av_timer</i>
      </div>
      <h4 class="card-title">Ma calnedrie
        <a   data-toggle="modal" data-target=".bd-Addevent-modal" class="btn btn-sm btn-rose float-right"> <i class="material-icons">add</i>{{ __('Add Event') }}</a>
      </h4>
    </div>

    <div class="card-body">
      <div class="col-md-10 ml-auto mr-auto">
        <div class="card card-calendar">
          <div class="card-body ">
            {!! $calendar->calendar() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade bd-Addevent-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="card card-signup card-plain">
        <div class="modal-header">
          <div class="card-header card-header-primary text-center">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="material-icons">clear</i>
            </button>
            <div class="card-title">
              <h4 >Ajout un evenement </h4>
            </div>

          </div>
        </div>
        <div class="modal-body">
          <div class="card-body">

            <div class="row justify-content-center">
              <div class="col-md-12">

                <form method="post" action="{{ route('events.store') }}" >
                  @csrf
                  @method('post')
                  <div class="row">
                    <div class="form-group col-md-10 ml-auto mr-auto" >
                      <label for="libelle" class="bmd-label-floating">Nom</label>
                      <input type="text" name="libelle" class="form-control" id="libelle">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                   <div class="col-md-10 ml-auto mr-auto">
                    <div class="card ">
                      <div class="card-header card-header-rose card-header-text">
                        <div class="card-icon">
                          <i class="material-icons">today</i>
                        </div>
                        <h4 class="card-title">Date debut</h4>
                      </div>
                      <div class="card-body ">
                        <div class="form-group">
                          <input type="text" name="date_debut" data-date-format='Y-MM-DD' class="form-control datepicker text-center" >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row"> 
                  <div class="col-md-10 ml-auto mr-auto">
                    <div class="card ">
                      <div class="card-header card-header-rose card-header-text">
                        <div class="card-icon">
                          <i class="material-icons">today</i>
                        </div>
                        <h4 class="card-title">Date fin</h4>
                      </div>
                      <div class="card-body ">
                        <div class="form-group">
                          <input type="text" name="date_fin" data-date-format='Y-MM-DD' class="form-control datepicker text-center">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>



                <div class="col-md-4 float-right">
                  <button style="width: 100%;" type="submit" class="btn btn-fill btn-rose">Add</button>
                </div>

              </form>

            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-start">
        <button data-dismiss="modal"   class=" close btn btn-primary mt-4 btn-lg">Cancel</button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@push('js')
<script>
  $(document).ready(function() {
    md.initFullCalendar();
  });

</script>
<script>
  $(document).ready(function() {
      // initialise Datetimepicker and Sliders
      md.initFormExtendedDatetimepickers();
      if ($('.slider').length != 0) {
        md.initSliders();
      }
    });
  </script>
  {!! $calendar->script() !!}
  @endpush




