<section class="select-language-section bg-site-color" style="display: none;">
    <div class="container-fluid">
        <select class="form-control form-control-sm bg-transparent border-0 text-white "
                onchange="location = this.value;"
                style=" transition: max-height 1s;">

            @foreach(config('editions') as $k=> $e)

                <option class="bg-site-color border-0"
                        {{request()->segment(1) == $e ? 'selected' :''}}
                        value="{{url('/'.$e)}}"
                >
                    {{ucwords($k)}}
                </option>
            @endforeach
        </select>
    </div>
</section>
