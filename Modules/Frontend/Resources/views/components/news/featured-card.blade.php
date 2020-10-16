<div class="card mb-3">
    @include('frontend::components.news.news-image',['figureClass'=>'card-img-wrap img-zoom-in','imgClass'=>'card-img-top'])
    <div class="card-body">
        @include('frontend::components.news.news-title')
        @include('frontend::components.news.news-author')
        @include('frontend::components.news.news-short-description')
    </div>
</div>
