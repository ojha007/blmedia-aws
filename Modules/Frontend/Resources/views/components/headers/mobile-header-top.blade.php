<section class="select-language-section bg-site-color" style="display: none;">
    <div class="container-fluid">
        <select class="form-control form-control-sm bg-transparent border-0 text-white " onchange="location = this.value;"
                style=" transition: max-height 1s;">
            @foreach(config('editions') as $k=> $e)
                @if(in_array(request()->segment(1), config('editions')))
                    @if(request()->segment(1) != $e)
                        <option class="bg-site-color border-0"
                                value="{{route($e)}}">
                            {{ucwords($k)}}
                        </option>
                    @endif
                @else
                    <option class="bg-site-color border-0" value="{{route($e)}}">
                        {{ucwords($k)}}
                    </option>
                @endif
            @endforeach
        </select>
    </div>
</section>
