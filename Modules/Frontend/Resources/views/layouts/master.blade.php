<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Media for all across the globe">
    <meta name="description" content="Media for all across the globe">
    <meta name="keywords" content="Media for all across the globe">
    <title>
        Media for all across the globe
    </title>
    @stack('meta')
    @include('frontend::partials.style')
    @stack('styles')
</head>

<body>
<div id="fb-root"></div>

<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0&appId=3228453080521488&autoLogAppEvents=1"
        nonce="zR3d9Tsr"></script>

<button onclick="topFunction()" id="scrollTop" class="btn btn-sm " title="Scroll top"><i class="fas fa-arrow-up"></i>
</button>

<!-- Main Header -->
@include('frontend::partials.header')
{{--    Header Close--}}
<!-- Main content -->
@yield('content')
<!-- /.content -->
{{--Main Footer--}}
@include('frontend::partials.footer')
{{--    Close Footer--}}

</body>
@include('frontend::partials.script')
@stack('scripts')
</html>

