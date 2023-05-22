@if($products && $products->count() > 0)
    @foreach($products as $product)
    <div class="col-md-6 mb-4">
        <div class="marketing-card">
            <div class="marketing-card-image">
                <img src="{{ asset('assets/images/products/'.$product->photo) }}" alt="...">
                <!-- <img src="https://picsum.photos/id/1015/400/250" alt="..."> -->
            </div>
            <div class="marketing-card-body">
                <h5 class="marketing-card-title">{{ $product->showName() }}</h5>
                <p class="marketing-card-text">
                    @if(strlen($product->details) > 200)
                    {!! substr($product->details, 0, 200) !!}...
                    @else
                    {!! $product->details !!}
                    @endif
                </p>
                <a href="{{ route('front.product', $product->slug) }}" class="marketing-card-learn-more">Learn More</a>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="col-lg-9 mb-4">
        <div class="card">
        <div class="card-body">
            <div class="page-center">
                <h4 class="text-center">{{ __('No Product Found.') }}</h4>
            </div>
        </div>
    </div>
@endif