<header class="page-header ">
    @include('frontend::components.headers.mobile-header-top')
    @include('frontend::components.headers.header-top')
    @include('frontend::components.headers.header-mid')
    @include('frontend::components.headers.header-end')
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
        });
    </script>
@endpush
