@extends('errors.layout', ['classPage' => 'error-page', 'activePage' => '401', 'title' => __('Gk ERP'), 'pageBackground' => asset("material").'/img/clint-mckoy.jpg'])

@section('content')
  <div class="content-center">
    <div class="row">
      <div class="col-md-12">
        <h1 class="title">403</h1>
        <h2>Votre compte est Bloque:</h2>
        <h4>Contacter les adminstarteurs pour plus d'informations </h4>
      </div>
    </div>
  </div>
@endsection
@push('js')
<script type="text/javascript">
	window.setTimeout(function() {
    document.getElementById('logout-form').submit();
}, 5000);
</script>
@endpush