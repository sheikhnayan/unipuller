@if($products && $products->count() > 0)
    @foreach($products as $product)
    <div class="col-md-6 mb-4">
        <div class="card news-card">
            <img src="{{ asset('assets/images/products/'.$product->photo) }}" class="card-img-top" alt="...">
            <!-- <img src="https://picsum.photos/id/1011/400/250" class="card-img-top" alt="..."> -->
            <div class="card-body">
            <h5 class="card-title news-card-title">{{ $product->showName() }}</h5>
            <p class="card-text news-card-text">
                @if(strlen($product->details) > 200)
                {!! substr($product->details, 0, 200) !!}...
                @else
                {!! $product->details !!}
                @endif
            </p>
            <a href="{{ route('front.product', $product->slug) }}" class="btn btn-primary news-card-btn">Learn More</a>
            </div>
        </div>
    </div>
    @endforeach
@else
    <div class="col-lg-9 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="page-center">
                    <h4 class="text-center">{{ __('No News Found.') }}</h4>
                </div>
            </div>
        </div>
    </div>
@endif