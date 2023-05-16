@extends('layouts.front')
@section('content')
@includeIf('partials.global.common-header')

<div class="container mb-4 bg-white rounded">
    <div class="row shadow m-0 p-0 custom">
        <div class="col-lg-4 d-flex pl-0 user-custom1">
            <a href="{{ route('vendor.service',$vendor->id) }}">
                <img class="lazy custom-img w-100 img-fluid rounded" data-src="{{ $vendor->photo ? asset('assets/images/users/' . $vendor->photo) : asset('assets/common_img/vendor_profile.jpeg') }}" alt="">
            </a>
            <div class="mt-2">
                <a href="{{ route('vendor.service',$vendor->id) }}">
                    <h5>{{ $vendor->shop_name }}</h5>
                </a>
                <p class="call_btn_size">
                    {{ $vendor->address }}
                    <br>
                    5 year experience
                    <br>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <span class="ml-2">
                        (0) Reviews
                    </span>
                </p>
                @if ($vendor->website)
                    <a href="{{ $vendor->website }}" target="_blank"><button class="btn btn-primary mb-3 btn-sm custom-padding">Website</button></a>
                @endif
                @if ($vendor->phone)
                    <a href="javascript:void(0);" onclick="seeVendorContact()"><button class="btn btn-primary mb-3 btn-sm custom-padding">Contact</button></a>
                    <p class="vendor_contact text-danger" style="display: none;margin-top: -10px">{{ $vendor->phone }}</p>
                @endif
            </div>
        </div>
        <style>
            
            .product-service-tab {
                max-width: 200px;
                margin-right: 15px;
                margin-left: auto;
            }
            .banner-img{
                height:100%;
                /* object-fit: cover; */
                width: fit-content;
            }
            #v-pills-tabContent .fade:not(.show){
                display: none;
            }
        </style>
        <div class="col-lg-5 d-flex user-custom">
            <img class="lazy custom-img w-100 img-fluid rounded" data-src="{{ $shop->shop_image ? asset('assets/images/categories/' . $shop->shop_image) : asset('assets/common_img/vendor_profile.jpeg') }}" alt="">
            <div class="mt-2">
                <h5 class="mb-0">{{ $shop->shop_name }}</h5>
                <p class="call_btn_size">
                    {{ $shop->address }}
                    <br>
                    5 year experience
                    <br>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <span class="ml-2">
                        (0) Reviews
                    </span>
                </p>
                @if ($shop->website)
                    <a href="{{ $shop->website }}"><button class="btn btn-white mb-3 btn-sm custom-padding">Website</button></a>
                @endif
                @if ($shop->phone)
                    <a href="javascript:void(0);" onclick="seeShopContact()"><button class="btn btn-white mb-3 btn-sm custom-padding">Contact</button></a>
                    <p class="shop_contact text-danger" style="display: none;margin-top: -10px">{{ $shop->phone }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-3 banner">
            <img class="lazy banner-img w-100 img-fluid rounded" data-src="{{ $shop->shop_banner ? asset('assets/images/categories/' . $shop->shop_banner) : asset('assets/common_img/shop_banner.jpeg') }}" alt="">
        </div>
    </div>
    <style>
        .call_btn_size {
            font-size: 14px;
            /* line-height: 20px; */
        }
        .custom{
            background: #f9f6f6;
        }

        .mr-2 {
            margin-right: 5px;
        }

        .custom-padding{
            line-height: 37px!important;
            padding: 0 12px!important;
        }

        .call_btn_size a {
            font-size: 14px;
            width: 100%;
            background-color: #ddd;
            padding: 2px 20px;
        }

        /* .width-20 {
                width: 20%;
            } */

        .contact-btn {
            display: flex;
            gap: 20px;
        }

        .vendor_sidebar {
            width: 100%;
            text-align: left;
            margin-top: 4px !important;
            padding: 15px 35px;
            background-color: #ddd;
            margin-bottom: 5px;
        }

        .vendor_sidebar.active {
            background-color: #424a4d !important;
        }

        .store_line_height {
            line-height: 20px;
        }

        /* .custom-img {
            max-width: 140px;
        } */
        .custom-img {
                height: 150px!important;
                width: 180px!important;
        }

        .user-custom, .user-custom1 {
            gap: 15px;
        }
        .banner{
            padding: 10px;
            background-color: #424a4d !important;
        }
        .product-wrapper .product-info .product-title, .product-wrapper .product-info .product-title a {
            font-weight: 500;
            font-size: 18px;
        }
        .social-links li a {
            width: 36px;
            height: 36px;
            line-height: 36px;
            text-align: center;
            border-radius: 50%;
            background: #a439ee;
            display: block;
            color: #fff;
        }
    </style>
</div>
</div>

<div class="container mb-5">
    <div class="d-flex align-items-start shadow custom-shop-tab">
        <div class="nav flex-column nav-pills w-25 p-3 me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link vendor_sidebar rounded active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Products & Services</button>
            <button class="nav-link vendor_sidebar rounded" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Marketing</button>
            <button class="nav-link vendor_sidebar rounded" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">News</button>
            <button class="nav-link vendor_sidebar rounded" id="v-pills--company-tab" data-bs-toggle="pill" data-bs-target="#v-pills-company" type="button" role="tab" aria-controls="v-pills-company" aria-selected="false">Company Info</button>
            <ul class="social-links">
                @if ($shop->facebook)
                    <li>
                        <a href="{{ $shop->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    </li>
                @endif
                @if ($shop->instagram)
                    <li>
                        <a href="{{ $shop->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    </li>
                @endif
                @if ($shop->linkedin)
                    <li>
                        <a href="{{ $shop->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </li>
                @endif
                @if ($shop->twitter)
                    <li>
                        <a href="{{ $shop->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                    </li>
                @endif
                @if ($shop->youtube)
                    <li>
                        <a href="{{ $shop->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                    </li>
                @endif
                @if ($shop->pinterest)
                    <li>
                        <a href="{{ $shop->pinterest }}" target="_blank"><i class="fab fa-pinterest"></i></a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="tab-content w-100" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <ul role="tablist" aria-owns="nav-tab1 nav-tab2 nav-tab3 nav-tab4" class="nav nav-tabs mt-3 mb-2 product-service-tab" id="nav-tab-with-nested-tabs">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" aria-current="page" id="nav-tab1" href="#tab1-content" data-bs-toggle="tab" data-bs-target="#tab1-content" role="tab" aria-controls="tab1-content" aria-selected="true">Service</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="nav-tab2" data-bs-toggle="tab" href="#tab2-content" data-bs-target="#tab2-content" role="tab" aria-controls="tab2-content" aria-selected="false">Product</a>
                    </li>

                </ul>

                <div class="tab-content" id="nav-tabs-content">
                    <div class="tab-pane-with-nested-tab fade show active" id="tab1-content" role="tabpanel" aria-labelledby="nav-tab1">
                        <div class="row row-cols-xxl-2 px-3 row-cols-md-2 mb-4 row-cols-1 g-3 product-style-1 shop-list product-list e-bg-light e-title-hover-primary e-hover-image-zoom">
                            @if($shop->services && $shop->services->count() > 0)
                                @foreach($shop->services as $service)
                                <div class="col">
                                    <div class="product type-product">
                                        <div class="product-wrapper">
                                            <div class="product-image">
                                                <a href="{{ route('service.details', $service->id) }}" class="woocommerce-LoopProduct-link"><img class="lazy" data-src="{{ $service->photo ? asset('assets/images/products/'.$service->photo):asset('assets/common_img/shop2.jpg') }}" alt="Product Image"></a>

                                                <div class="hover-area">
                                                    @if($service->product_type == "affiliate")
                                                    <div class="cart-button buynow">
                                                        <a class="add-to-cart-quick button add_to_cart_button" href="javascript:;" data-href="{{ route('product.cart.quickadd',$service->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Buy Now') }}" aria-label="{{ __('Buy Now') }}"></a>
                                                    </div>
                                                    @else

                                                    <div class="cart-button">
                                                        <a href="javascript:;" data-href="{{ route('product.cart.add',$service->id) }}" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Add To Cart') }}" aria-label="{{ __('Add To Cart') }}"></a>
                                                    </div>

                                                    <div class="cart-button buynow">
                                                        <a class="add-to-cart-quick button add_to_cart_button" href="javascript:;" data-href="{{ route('product.cart.quickadd',$service->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Buy Now') }}" aria-label="{{ __('Buy Now') }}"></a>
                                                    </div>

                                                    @endif
                                                    @if(Auth::check())
                                                    <div class="wishlist-button">
                                                        <a class="add_to_wishlist  new button add_to_cart_button" id="add-to-wish" href="javascript:;" data-href="{{ route('user-wishlist-add',$service->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
                                                    </div>
                                                    @else
                                                    <div class="wishlist-button">
                                                        <a class="add_to_wishlist button add_to_cart_button" href="{{ route('user.login') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
                                                    </div>
                                                    @endif
                                                    <div class="compare-button">
                                                        <a class="compare button button add_to_cart_button" data-href="{{ route('product.compare.add',$service->id) }}" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">{{ __('Compare') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3 class="product-title"><a href="{{ route('service.details', $service->id) }}">{{ $service->showName() }}</a></h3>
                                                <p>{{ $service->categories->name ?? "" }}</p>
                                                <p style="text-align: justify">{!! $service->short_description !!}</p>
                                                <div class="product-price">
                                                    <div class="price">

                                                        <ins>{{ $service->setCurrency() }}</ins>
                                                        <del>{{ $service->showPreviousPrice() }}</del>
                                                    </div>
                                                </div>
                                                <div class="shipping-feed-back">
                                                    <div class="star-rating">
                                                        <div class="rating-wrap">
                                                            <p><i class="fas fa-star"></i><span> {{ App\Models\Rating::ratings($service->id) }} ({{ App\Models\Rating::ratingCount($service->id) }})</span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div class="col-lg-9">
                                    <div class="card">
                                    <div class="card-body">
                                        <div class="page-center">
                                            <h4 class="text-center">{{ __('No Service Found.') }}</h4>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @endif
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2-content" role="tabpanel" aria-labelledby="nav-tab2">
                        <div class="row row-cols-xxl-2 row-cols-md-2 mb-4 row-cols-1 g-3 product-style-1 shop-list product-list e-bg-light e-title-hover-primary e-hover-image-zoom">
                            @if($shop->products && $shop->products->count() > 0)
                            @foreach($shop->products as $product)
                                <div class="col">
                                  <div class="product type-product">
                                    <div class="product-wrapper">
                                        <div class="product-image">
                                            <a href="{{ route('front.product', $product->slug) }}" class="woocommerce-LoopProduct-link"><img class="lazy" data-src="{{ $product->photo ? asset('assets/images/products/'.$product->photo):asset('assets/common_img/shop2.jpg') }}" alt="Product Image"></a>
                                            {{-- @if (round($product->offPercentage() )>0)
                                            <div class="on-sale">- {{ round($product->offPercentage() )}}%</div>
                                            @endif --}}
                                            <div class="hover-area">
                                                @if($product->product_type == "affiliate")
                                                <div class="cart-button buynow">
                                                    <a class="add-to-cart-quick button add_to_cart_button" href="javascript:;" data-href="{{ route('product.cart.quickadd',$product->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Buy Now') }}" aria-label="{{ __('Buy Now') }}"></a>
                                                </div>
                                                @else
                                                @if($product->emptyStock())
                                                <div class="closed">
                                                    <a class="cart-out-of-stock button add_to_cart_button" href="#" title="{{ __('Out Of Stock') }}"><i class="flaticon-cancel flat-mini mx-auto"></i></a>
                                                </div>
                                                @else
                                                <div class="cart-button">
                                                    <a href="javascript:;" data-href="{{ route('product.cart.add',$product->id) }}" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Add To Cart') }}" aria-label="{{ __('Add To Cart') }}"></a>
                                                </div>

                                                <div class="cart-button buynow">
                                                    <a class="add-to-cart-quick button add_to_cart_button" href="javascript:;" data-href="{{ route('product.cart.quickadd',$product->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Buy Now') }}" aria-label="{{ __('Buy Now') }}"></a>
                                                </div>
                                                @endif
                                                @endif
                                                @if(Auth::check())
                                                <div class="wishlist-button">
                                                    <a class="add_to_wishlist  new button add_to_cart_button" id="add-to-wish" href="javascript:;" data-href="{{ route('user-wishlist-add',$product->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
                                                </div>
                                                @else
                                                <div class="wishlist-button">
                                                    <a class="add_to_wishlist button add_to_cart_button" href="{{ route('user.login') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
                                                </div>
                                                @endif
                                                <div class="compare-button">
                                                    <a class="compare button button add_to_cart_button" data-href="{{ route('product.compare.add',$product->id) }}" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">{{ __('Compare') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h3 class="product-title"><a href="{{ route('front.product', $product->slug) }}">{{ $product->showName() }}</a></h3>
                                            <p>{{ $product->category->name ?? "" }}</p>
                                            <p style="text-align: justify">{!! $product->short_description !!}</p>
                                            <div class="product-price">
                                                <div class="price">

                                                    <ins>{{ $product->setCurrency() }}</ins>
                                                    <del>{{ $product->showPreviousPrice() }}</del>
                                                </div>
                                            </div>
                                            <div class="shipping-feed-back">
                                                <div class="star-rating">
                                                    <div class="rating-wrap">
                                                        <p><i class="fas fa-star"></i><span> {{ App\Models\Rating::ratings($product->id) }} ({{ App\Models\Rating::ratingCount($product->id) }})</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div class="col-lg-9">
                                <div class="card">
                                <div class="card-body">
                                    <div class="page-center">
                                        <h4 class="text-center">{{ __('No Product Found.') }}</h4>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>

            </div>

            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...
                message
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...
                settings
            </div>
            <div class="tab-pane fade" id="v-pills-company" role="tabpanel" aria-labelledby="v-pills-company-tab">
                <p class="pt-3 text-justify">{{ $shop->shop_about }}</p>
            </div>
        </div>
    </div>
</div>
</div>

</div>
</div>

{{-- @includeIf('partials.global.common-footer') --}}

@endsection
@section('script')
    <script>
        function seeVendorContact(){
            $(".vendor_contact").css("display", "block");
        }
        function seeShopContact(){
            $(".shop_contact").css("display", "block");
        }
    </script>
@endsection