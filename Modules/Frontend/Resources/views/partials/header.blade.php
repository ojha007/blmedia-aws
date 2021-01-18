<header class="page-header ">
    <div class="container-fluid px-0">
        @include('frontend::components.headers.mobile-header-top')
{{--        @include('frontend::components.headers.sidebar')--}}
        @include('frontend::components.headers.header-top')
        @include('frontend::components.headers.header-mid')
        @include('frontend::components.headers.header-end')
    </div>
</header>
@push('scripts')
    <script>
        $(document).ready(function () {
            $(window).scroll(function () {
                var sticky = $('.amnavnd'),
                    scroll = $(window).scrollTop();

                if (scroll >= 150) sticky.addClass('headerfixed');
                else sticky.removeClass('headerfixed');
            });
           /* $(".mySidebar-btn").click(function(){
                // alert('pp');
                $(".mySidebar").css("display", "block");
            });*/
        });
        /*function sidebarFunction() {
            // alert('pp');
            var x = document.getElementById("mySidebar");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }*/
    </script>
    <script>

    </script>
@endpush
