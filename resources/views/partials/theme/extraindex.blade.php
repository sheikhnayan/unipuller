<style>
    .text-center {
        text-align: center !important;
    }

    .custom-service img {
        max-width: 150px;
        width: 100%;
        min-width: 120px;
    }

    .custom-service-title {
        font-weight: 500;
        font-size: 16px;
        margin-top: 5px;
    }
</style>


{{-- @include('frontend.homePage.trendingCategories') --}}

@include('frontend.homePage.feature')

{{-- @if ($ps->deal_of_the_day == 1)
    <!--==================== Deal of the day Section Start ====================-->
    <div class="full-row bg-light">
        <div class="container">
            <div class="row offer-product align-items-center">
                <div class="col-xl-5 col-lg-7">
                    <h1 class="down-line-secondary text-dark text-uppercase mb-30">{{ __('Deal') }} <br>
                        {{ __('of the Day') }}</h1>
                    <div class="product type-product">
                        <div class="product-wrapper">
                            <div class="product-info">

                                <h3 class="product-title">{{ $gs->deal_title }}</h3>
                                <div class="product-price">

                                    <div class="on-sale"><span>50</span><span>% off</span></div>
                                </div>
                                <div class="font-fifteen">
                                    <p>{{ $gs->deal_details }}</p>
                                </div>
                                <div class="time-count time-box text-center my-30 flex-between w-75"
                                    data-countdown="{{ $gs->deal_time }}"></div>
                                <a href="{{ route('front.category') . '?type=flash' }}"
                                    class="btn btn-dark text-uppercase rounded-0">{{ __('Shop Now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5 offset-xl-1">

                    <div class="xs-mt-30"><img
                            src="{{ $gs->deal_background ? asset('assets/images/' . $gs->deal_background) : asset('assets/images/noimage.png') }}"
                            alt=""></div>

                </div>
            </div>
        </div>
    </div>
    <!--==================== Deal of the day Section End ====================-->
@endif --}}

@include('frontend.homePage.popularCategories')
@include('frontend.homePage.meetups')
@include('frontend.homePage.recuitments')
@include('frontend.homePage.realEstate')
@include('frontend.homePage.ubsSystem')
@include('frontend.homePage.digitalSolutions')
{{-- @include('frontend.homePage.partner') --}}


<!--==================== Service Section Start ====================-->
{{-- @if ($service_categories->count() > 1)
    <div class="full-row bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <span
                        class="text-secondary pb-2 d-table tagline mx-auto text-uppercase text-center">{{ __('Services') }}</span>
                    <h2 class="main-title mb-4 text-center text-secondary">{{ __('We Providing Helpful Services') }}
                    </h2>
                </div>
            </div>
            <div class="row g-3 justify-content-center">
                @foreach ($service_categories as $data)
                    <div class="col-6 col-sm-4 col-lg-2 col-xl-2 custom-service text-center">
                        <a href="{{ route('front.service_category', $data->slug) }}">
                            <div class="simple-service">
                                <img class="lazy" data-src="{{ asset('assets/images/categories/' . $data->photo) }}"
                                    alt="">
                            </div>
                            <p class="text-center text-dark custom-service-title">{{ $data->name }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endif --}}

<!--==================== Service Section End ====================-->

@if ($ps->category == 1)
    <div class="full-row">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <span
                        class="text-secondary pb-2 d-table tagline mx-auto text-uppercase text-center">{{ __('Featured Products') }}</span>
                    <h2 class="main-title mb-4 text-center text-secondary">{{ __('Our Featured Products') }}</h2>
                </div>
            </div>
            <div class="products product-style-1">
                <div
                    class="row g-4 row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-1 e-title-general e-title-hover-primary e-image-bg-light e-hover-image-zoom e-info-center">

                    @foreach ($popular_products as $prod)
                        <div class="col">
                            @include('partials.product.home-product')
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--==================== Top Products Section End ====================-->
@endif


<!--==================== Deal of the day Section End ====================-->


{{-- @if ($ps->top_big_trending == 1)
    <!--==================== Top Collection Section Start ====================-->
    <div class="full-row bg-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="top-collection-tab nav-tab-active-secondary">
                        <ul class="nav nav-pills list-color-general justify-content-center mb-5">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="pill"
                                    href="#pills-new-arrival-two">{{ __('New Arrival') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill"
                                    href="#pills-Trending-two">{{ __('Trending') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill"
                                    href="#pills-best-selling-two">{{ __('Best Selling') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="pill"
                                    href="#pills-featured-two">{{ __('Popular') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-new-arrival-two">
                                <div class="products product-style-1">
                                    <div
                                        class="row g-4 row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-1 e-title-general e-title-hover-primary e-image-bg-light e-hover-image-zoom e-info-center">
                                        @if ($latest_products->count() > 0)

                                            @foreach ($latest_products as $prod)
                                                <div class="col">
                                                    @include('partials.product.home-product')
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-center">
                                                <h2>{{ __('No Product Found!') }}</h2>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-Trending-two">
                                <div class="products product-style-1">
                                    <div
                                        class="row g-4 row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-1 e-title-general e-title-hover-primary e-image-bg-light e-hover-image-zoom e-info-center">
                                        @if ($trending_products->count() > 0)
                                            @foreach ($trending_products as $prod)
                                                <div class="col">
                                                    @include('partials.product.home-product')
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-center">
                                                <h2>{{ __('No Product Found!') }}</h2>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-best-selling-two">
                                <div class="products product-style-1">
                                    <div
                                        class="row g-4 row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-1 e-title-general e-title-hover-primary e-image-bg-light e-hover-image-zoom e-info-center">
                                        @if ($sale_products->count() > 0)
                                            @foreach ($sale_products as $prod)
                                                <div class="col">
                                                    @include('partials.product.home-product')
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-center">
                                                <h2>{{ __('No Product Found!') }}</h2>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-featured-two">
                                <div class="products product-style-1">
                                    <div
                                        class="row g-4 row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-1 e-title-general e-title-hover-primary e-image-bg-light e-hover-image-zoom e-info-center">
                                        @if ($popular_products->count() > 0)
                                            @foreach ($popular_products as $prod)
                                                <div class="col">
                                                    @include('partials.product.home-product')
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-center">
                                                <h2>{{ __('No Product Found!') }}</h2>
                                            </div>

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==================== Top Collection Section End ====================-->
@endif --}}


<!--==================== Top Products Section Start ====================-->
@if ($ps->best_sellers == 1)
    <div class="full-row">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <span
                        class="text-secondary pb-2 d-table tagline mx-auto text-uppercase text-center">{{ __('Top Products') }}</span>
                    <h2 class="main-title mb-4 text-center text-secondary">{{ __('Best Selling Products') }}</h2>

                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    <div class="products product-style-1 owl-mx-15">
                        <div
                            class="four-carousel owl-carousel dot-disable nav-arrow-middle-show e-title-general e-title-hover-primary e-image-bg-light  e-info-center e-title-general e-title-hover-primary e-image-bg-light e-hover-image-zoom e-info-center">
                            @foreach ($best_products as $prod)
                                <div class="item">
                                    @include('partials.product.home-product')
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==================== Top Products Section End ====================-->
@endif

@if ($ps->partner == 1)
    <div class="full-row bg-light mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">

                    <h2 class="main-title mb-4 text-center text-secondary">{{ $gs->partner_title }}</h2>
                    <span
                        class="mb-30 sub-title text-general font-medium ordenery-font font-400 text-center">{{ $gs->partner_text }}</span>
                </div>
            </div>
            <div class="row g-3">
                @foreach (DB::table('partners')->get() as $data)
                    <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                        <div class="simple-service">
                            <img class="lazy" data-src="{{ asset('assets/images/partner/' . $data->photo) }}"
                                alt="">

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endif

<!--==================== Our Blog Section Start ====================-->
@if ($ps->blog == 1)
    <div class="full-row pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">

                    <h2 class="main-title mb-4 text-center text-secondary">{{ __('Latest Post') }}</h2>
                    <span
                        class="mb-30 sub-title text-general font-medium ordenery-font font-400 text-center">{{ __('Cillum eu id enim aliquip aute ullamco anim. Culpa deserunt nostrud excepteur voluptate velit ipsum esse enim.') }}</span>
                </div>
            </div>
            <div class="row row-cols-lg-2 row-cols-1">
                @foreach ($blogs as $blog)
                    <div class="col">
                        <div class="thumb-latest-blog text-center transation hover-img-zoom mb-3">
                            <div class="post-image overflow-hidden">
                                <a href="{{ route('front.blogshow', $blog->slug) }}">
                                    <img class="lazy" data-src="{{ asset('assets/images/blogs/' . $blog->photo) }}"
                                        alt="Image not found!">
                                </a>

                            </div>
                            <div class="post-content">
                                <h3><a href="{{ route('front.blogshow', $blog->slug) }}"
                                        class="transation text-dark hover-text-dark d-table my-10 mx-sm-auto">{{ mb_strlen($blog->title, 'UTF-8') > 200 ? mb_substr($blog->title, 0, 200, 'UTF-8') . '...' : $blog->title }}</a>
                                </h3>
                                <div class="post-meta font-small text-uppercase list-color-general my-3">
                                    <p class="post-date">{{ date('d M, Y', strtotime($blog->created_at)) }}</p>
                                </div>
                                <a href="{{ route('front.blogshow', $blog->slug) }}"
                                    class="btn-link-left-line">{{ __('Read More') }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!--==================== Our Blog Section End ====================-->
@endif
{{-- @if ($ps->third_left_banner == 1)
    <!--==================== Newsleter Section Start ====================-->
    <div class="full-row bg-dark py-30">
        <div class="container">
            <div class="row mx-auto">
                <div class="col-lg-5 col-md-6 mx-auto">
                    <div class="d-flex align-items-center h-100">
                        <h4 class="text-white mb-0 text-uppercase">{{ __('Sign up to newslatter') }}</h4>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12">
                    <form action="{{ route('front.subscribe') }}"
                        class="subscribe-form subscribeform  position-relative md-mt-20" method="POST">
                        @csrf
                        <input class="form-control rounded-pill mb-0" type="text" placeholder="Enter your email"
                            aria-label="Address" name="email">
                        <button type="submit"
                            class="btn btn-secondary rounded-right-pill text-white">{{ __('Send') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--==================== Newsleter Section End ====================-->
@endif --}}



<script src="{{ asset('assets/front/js/extraindex.js') }}"></script>

<script>
    $(".lazy").Lazy();
</script>
