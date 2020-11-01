<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
            @include('frontend::components.news.news-image',['figureClass'=>'','imgClass'=>'card-img'])
        </div>
        <div class="col-md-8">
            <div class="card-body">
                @include('frontend::components.news.news-title')
                @include('frontend::components.news.news-author')
                @include('frontend::components.news.news-short-description')
            </div>
        </div>
    </div>
</div>