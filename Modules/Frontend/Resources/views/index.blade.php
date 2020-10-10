@extends('frontend::layouts.master')
@section('content')
    <section class="page-body page-body-homepage " style="overflow-x: hidden;">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-sm-12 col-md-8 col-lg-9 col-xl-9 p-0 sm-mb-3 left-content" >
                    @include('frontend::components.left-content.left-content')
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3 right-content" >
                    @include('frontend::components.right-content.right-content')
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        window.FontAwesomeConfig = {
            searchPseudoElements: true
        };
    </script>
@endpush