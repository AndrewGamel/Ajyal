@push('styles')
 <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 <!-- Font Awesome Icons -->
 <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/fontawesome-free/css/all.min.css') }} ">
 <!-- overlayScrollbars -->
 <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
 <!-- Theme style -->
 <link rel="stylesheet" href="{{ asset('assets/dashboard/dist/css/adminlte.min.css') }}">
@endpush

@push('script')
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('assets/dashboard/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dashboard/dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('assets/dashboard/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/dashboard/plugins/chart.js/Chart.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dashboard/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('assets/dashboard/dist/js/pages/dashboard2.js') }}"></script>
@endpush





@section('category','Category Items')

<x-dashboard-layout>
    <div class="row">
        <div class="col-12">
            <h3 class="text-center">hello</h3>
        </div>
    </div>
</x-dashboard-layout>