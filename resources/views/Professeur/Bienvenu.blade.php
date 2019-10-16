@extends('Professeur.dashboard', ['activePage' => 'dashboard', 'menuParent' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
  Bienvenu Professeur
</div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

      md.initVectorMap();

    });
  </script>
@endpush