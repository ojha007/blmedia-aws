{{--<script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>--}}
{{--<script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f6ae4aab8c08fb7"></script>--}}
{{--<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f6ae1e2ff9ad600123ed18b&product=inline-share-buttons' async='async'></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" crossorigin="anonymous"></script>

<script>
    mybutton = document.getElementById("scrollTop");
    window.onscroll = function () {
        scrollFunction()
    };
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }
    function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
</script>
