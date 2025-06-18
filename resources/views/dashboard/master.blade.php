<!DOCTYPE html>

<html lang="en">

@include('dashboard.include.head')

<body class="header-fixed" style="padding:0 0 0 0 !important;">

    <div class="wrapper main-dashboard" id="appmykamlesh">

        @yield('content')

        @include('dashboard.include.footer')
    </div>
    <!--/wrapper-->

    <div id="show_popin"></div>

    @include('dashboard.include.script')
</body>
<script type="text/javascript">
    function fetchPopin() {
        $.ajax({
            url: "{{ route('show-popin') }}",
            type: "GET",
            success: function(html) {
                $('#show_popin').html(html);
            }
        });
    }

    // Call immediately on load
    fetchPopin();

    // Repeat every 5 minutes
    setInterval(fetchPopin, 5 * 60 * 1000);

    $(document).on("click", ".close_popin", function() {
        $('#show_popin').html('');
    });
</script>

</html>
