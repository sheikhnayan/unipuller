<div class="row">
    @if($services->count() > 0)
    @foreach($services as $service)
    <div class="col-md-5 shadow rounded p-3 m-3">
        <div class="row">
            <div class="col-md-3">
                <img class="lazy" data-src="{{ asset('assets/images/categories/' . $shop->shop_image) }}" alt="">
            </div>
            <div class="col-md-9">
                <h6>{{$service->name}}</h6>
                <p class="store_line_height">
                    {{$service->short_description}}
                    <br>
                    {{$service->price}}
                </p>
            </div>
        </div>
    </div>
    @endforeach
    @endif


</div>
</div>