@extends('layouts.front')
@section('content')
    @includeIf('partials.global.common-header')
    <!-- breadcrumb -->
    <div class="shop-list-page">

        <div class="full-row bg-light overlay-dark py-5"
            style="background-image: url({{ $gs->breadcrumb_banner ? asset('assets/images/' . $gs->breadcrumb_banner) : asset('assets/images/noimage.png') }}); background-position: center center; background-size: cover;">
            <div class="container">
                <div class="row text-center text-white">
                    <div class="col-12">
                        <h3 class="mb-2 text-white"></h3>
                    </div>
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-inline-flex bg-transparent p-0">
                                <li class="breadcrumb-item"><a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('Shop List') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->

        <style>
            .product-wrapper .product-info .product-title,
            .product-wrapper .product-info .product-title a {
                font-weight: 400;
                font-size: 22px;
            }
        </style>

        {{-- There are two product page. you have to give condition here --}}
        <div class="full-row content-circle">
            <div class="container">
                <div class="row mobile-reverse">
                    <div class="col-xl-3">
                        <div class="advertise-banner">
                            <h5 class="text-center px-4 mt-3">Create Your Free Business Profile</h5>
                            <img class="text-center mb-2" src="{{ asset('/assets/front/images/social.png') }}"
                                alt="">

                            <p> <span><i class="fa fa-check"></i></span> Help us improve by letting us know</p>
                            <p> <span><i class="fa fa-check"></i></span> Help us improve by letting us know</p>
                            <p> <span><i class="fa fa-check"></i></span> Help us improve by letting us know</p>
                            <p> <span><i class="fa fa-check"></i></span> Help us improve by letting us know</p>
                            <div class="d-flex mt-3 justify-content-between">
                                <a href="{{ route('vendor.register') }}" target="_blank"><button
                                        class="btn btn-primary mr-2">Get Started</button></a>
                                <button class="btn btn-primary">Suggest edit</button>
                            </div>
                        </div>
                        <div class="advertise-box">
                            <h6>See Anything wrong with this listing</h6>
                            <p>Help us improve by letting us know</p>
                            <button class="btn btn-primary">Suggest edit</button>
                        </div>
                        <div class="advertise-box">
                            <h6>Is this your business</h6>
                            <p>By claiming this business you can update and control company information</p>
                            <button class="btn btn-primary">Claim Your Business</button>
                        </div>
                    </div>


                    <div class="col-xl-9">
                        <div class="product-search-one">
                            <form id="searchForm" class="search-form form-inline search-pill-shape"
                                action="{{ route('vendor.list') }}" method="GET">
                                <div class="select-appearance-none categori-container" id="countryForm">
                                    <select name="country" class="form-control categoris mx-2" id="country_select">
                                        <option selected="" value="">{{ __('Select Country') }}</option>
                                        @foreach (DB::table('countries')->where('status', 1)->orderby('id', 'desc')->get() as $data)
                                            <option value="{{ $data->country_name }}">
                                                {{ $data->country_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" id="shop_name" class="col form-control search-field" name="search"
                                    placeholder="Search Location or Shop For" value="{{ request()->input('search') }}">

                                <div class="select-appearance-none categori-container" id="catSelectForm">
                                    <select name="category" class="form-control categoris" id="category_select">
                                        <option disabled selected="">{{ __('Select Categories') }}</option>
                                        @foreach (DB::table('categories')->where('language_id', $langg->id)->where('status', 1)->get() as $data)
                                            <option value="{{ $data->slug }}"
                                                {{ request()->input('category') == $data->slug ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="search-submit"><i
                                        class="flaticon-search flat-mini text-white"></i></button>
                            </form>
                        </div>
                        <div class="shopautocomplete2 position-relative">
                            <div id="shopmyInputautocomplete-list2" class="autocomplete-items"></div>
                        </div>
                        <div class="mb-4 d-xl-none">
                            <button class="dashboard-sidebar-btn btn bg-primary rounded">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>

                        <div class="showing-products pt-30 pb-50 border-2 border-bottom border-light" id="ajaxContent">
                            @if (count($vendors) > 0)
                                <div
                                    class="row row-cols-xxl-2 px-3 row-cols-md-2 mb-4 row-cols-1 g-3 product-style-1 shop-list product-list  e-title-hover-primary e-hover-image-zoom">
                                    @php
                                        $key = 0;
                                    @endphp
                                    @foreach ($vendors as $vendor)
                                        <div class="col">
                                            @php
                                                $key += 1;
                                            @endphp
                                            <div class="product type-product rounded @if ($key % 2 == 0) bg-sea-green @else bg-dark @endif">
                                                <div class=" row m-0">
                                                    <div class="  col-lg-4 col-md-4 col-sm-12 d-flex align-items-center p-0 img-small-screen">
                                                        <a href="{{ route('vendor.shop.service', $vendor->id) }}"
                                                            class="woocommerce-LoopProduct-link">
                                                            <img class="lazy img-fluid rounded"
                                                                data-src="{{ $vendor->shop_image ? asset('assets/images/categories/' . $vendor->shop_image) : asset('assets/common_img/vendor_profile.jpeg') }}"
                                                                alt="Product Image">
                                                        </a>

                                                        <div class="hover-area">

                                                        </div>
                                                    </div>
                                                    <div class=" col-lg-8 col-md-8 col-sm-12 p-4">
                                                        <h5 class="product-title large_screen  mb-0 ">
                                                            <a class="@if ($key % 2 == 1) text-white @endif"
                                                                href="{{ route('vendor.shop.service', $vendor->id) }}">
                                                                @if (strlen($vendor->shop_name) > 40)
                                                                    {{ substr($vendor->shop_name, 0, 40) . '...' }}
                                                                @else
                                                                    {{ $vendor->shop_name }}
                                                                @endif
                                                            </a>
                                                        </h5>
                                                        <h5 class="product-title small_screen  mb-0" style="display: none">
                                                            <a class="@if ($key % 2 == 1) text-white @endif"
                                                                href="{{ route('vendor.shop.service', $vendor->id) }}">
                                                                @if (strlen($vendor->shop_name) > 30)
                                                                    {{ substr($vendor->shop_name, 0, 30) . '...' }}
                                                                @else
                                                                    {{ $vendor->shop_name }}
                                                                @endif
                                                            </a>
                                                        </h5>
                                                        <p
                                                            class="category_text @if ($key % 2 == 1) text-white @endif">
                                                            {{ $vendor->subcategory->name ?? '' }}</p>
                                                        <p
                                                            class="store_line_height mb-0 @if ($key % 2 == 1) text-white @endif">
                                                            Total {{ $vendor->services->count() }} Services &
                                                            {{ $vendor->products->count() }} Products
                                                        </p>
                                                        <div @if (strlen($vendor->shop_name) > 22) class="shipping-feed-back mt-0 @if ($key % 2 == 1) text-white @endif"
                                                        @else
                                                            class="shipping-feed-back2 mt-0 @if ($key % 2 == 1) text-white @endif"
                                                            @endif>
                                                            <div class="star-rating">
                                                                <div class="rating-wrap">
                                                                    <p class="mb-0"><i class="fas fa-star"></i><span>
                                                                            {{ App\Models\Rating::ratings($vendor->id) }}
                                                                            ({{ App\Models\Rating::ratingCount($vendor->id) }})
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p
                                                            class="about_line  @if ($key % 2 == 1) text-white @endif">
                                                            @if (strlen($vendor->shop_about) > 80)
                                                                {!! substr($vendor->shop_about, 0, 77) !!}...
                                                            @else
                                                                {!! substr($vendor->shop_about, 0, 80) !!}
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="  col-lg-4 col-md-4 col-sm-12 d-flex align-items-center p-0 img-large-screen">
                                                        <a href="{{ route('vendor.shop.service', $vendor->id) }}"
                                                            class="woocommerce-LoopProduct-link">
                                                            <img class="lazy img-fluid rounded-end"
                                                                data-src="{{ $vendor->shop_image ? asset('assets/images/categories/' . $vendor->shop_image) : asset('assets/common_img/vendor_profile.jpeg') }}"
                                                                alt="Product Image">
                                                        </a>

                                                        <div class="hover-area">

                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="bg-line-1"></div>
                                                <div class="bg-line-2"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <style>
                                        .category_text {
                                            color: #225db5;
                                        }

                                        .title_height {
                                            height: 60px;
                                        }

                                        .title_height2 {
                                            height: 40px;
                                        }

                                        .shop_about {
                                            margin-left: 15px;
                                            margin-right: 15px;
                                        }

                                        p.about_line {
                                            min-height: 40px;
                                            max-height: 40px;
                                        }

                                        p.category_text {
                                            min-height: 20px;
                                            max-height: 20px;
                                        }

                                        h5.product-title {
                                            min-height: 55px;
                                            max-height: 55px;
                                        }

                                        /* .shipping-feed-back {
                                                                margin-bottom: -25px;
                                                            } */

                                        /* .shipping-feed-back2 {
                                                                margin-bottom: -15px;
                                                            } */

                                        .product-info .product-title a {
                                            font-size: 18px !important;
                                        }

                                        .product-info p {
                                            font-size: 14px;
                                            line-height: 25px;
                                            margin-bottom: 2px;
                                        }
                                    </style>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-body">
                                        <div class="page-center">
                                            <h4 class="text-center">{{ __('No Shop Found.') }}</h4>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-12 mt-3">
                            <div class="d-flex align-items-start pt-3" id="custom-pagination">
                                <div class="pagination-style-one">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            {{ $vendors->links() }}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="bg-circle-2"></div>
            <div class="bg-circle-1"></div>
        </div>
    </div>
    @includeIf('partials.global.common-footer')
@endsection

@section('script')
    <script>
        setTimeout(function() {
            if ($(window).width() < 1350) {
                $(".large_screen").css("display", "none");
                $(".small_screen").css("display", "block");
            } else {
                console.log("small");
                $(".large_screen").css("display", "block");
                $(".small_screen").css("display", "none");
            }
        }, 1000);
    </script>
@endsection
