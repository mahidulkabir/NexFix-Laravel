{{-- Admin Template JS --}}
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin-template/lib/chart/chart.min.js') }}"></script>
<script src="{{ asset('admin-template/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('admin-template/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('admin-template/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('admin-template/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('admin-template/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('admin-template/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

{{-- Template Main JS --}}
<script src="{{ asset('admin-template/js/main.js') }}"></script>

{{-- Page Specific JS --}}
    @stack('scripts')