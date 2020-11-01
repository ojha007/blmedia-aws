<div class="card mb-3 {{ $verticalClass ?? '' }}">
    @include('frontend::components.news.news-image',['figureClass'=>'','imgClass'=>'card-img-top'])
    <div class="card-body">
        @include('frontend::components.news.news-title')
        @include('frontend::components.news.news-author')
    </div>
</div>