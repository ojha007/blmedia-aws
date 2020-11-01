<div class="col-12 px-0">
    @if(count($allNews))
        <div class="card border-primary mb-3 {{ $positionClass ?? '' }}">
            @include('frontend::components.card-header',['header'=>$allNews])
            <div class="card-block">
                @foreach($allNews as $news)
                    <div class="card mb-3">
                        <div class="row ">
                            <div class="col-12 mb-3">
                                @include('frontend::components.news.news-image',['figureClass'=>'text-center','imgClass'=>' rounded-img'])
                            </div>
                            <div class="col-12">
                                <div class="card-body text-center">
                                    @include('frontend::components.news.news-title')
                                    @include('frontend::components.news.news-author')
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @include('frontend::components.buttons.view-all-category-button', ['position' => $allNews])
            </div>
        </div>
    @endif
</div>
