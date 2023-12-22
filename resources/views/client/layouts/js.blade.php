<script src="{{ asset('client-theme/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('client-theme/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('client-theme/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('client-theme/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('client-theme/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('client-theme/js/mixitup.min.js') }}"></script>
<script src="{{ asset('client-theme/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('client-theme/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@if(Session::has('success'))
<script>
    toastr.options = {
    "closeButton": true,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "800",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }

    toastr.success("{{ Session::get('success') }}");
</script>
@endif

@if(Session::has('error'))
<script>
    toastr.options = {
    "closeButton": true,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "800",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }

    toastr.error("{{ Session::get('error') }}");
</script>
@endif

@if(Session::has('info'))
<script>
    toastr.options = {
    "closeButton": true,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "800",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }

    toastr.info("{{ Session::get('info') }}");

</script>
@endif

@if(Session::has('warning'))
<script>
    toastr.options = {
    "closeButton": true,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "800",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }

    toastr.warning("{{ Session::get('warning') }}");
</script>
@endif
