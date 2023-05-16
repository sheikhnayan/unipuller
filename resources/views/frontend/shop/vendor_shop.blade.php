@extends('layouts.front')
@section('content')
@includeIf('partials.global.common-header')

<div class="container shadow mb-4 bg-white rounded">
    <div class="row">
        <div class="col-md-4 d-flex align-items-center user-custom1">
            <img class="lazy custom-img w-100 img-fluid rounded" data-src="{{ $vendor->photo ? asset('assets/images/users/' . $vendor->photo) : asset('assets/common_img/vendor_profile.jpeg') }}" alt="">
            <div>

                <h5 class="mt-1 mb-0">{{ $vendor->shop_name }}</h5>
                <p class="call_btn_size">
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
                    <a href="{{ $vendor->website }}"><button class="btn mb-2 btn-primary btn-sm custom-padding">Website</button></a>
                @endif
                @if ($vendor->phone)
                    <a href="javascript:void(0);" onclick="seeVendorContact()"><button class="btn mb-2 btn-primary btn-sm custom-padding">Contact</button></a>
                    <p class="vendor_contact text-danger" style="display: none;margin-top: -10px">{{ $vendor->phone }}</p>
                @endif
            </div>
        </div>
        <div class="col-md-8 banner-div px-0">
            <img class="lazy custom-img2 w-100 img-fluid rounded" data-src="{{ $vendor->shop_image ? asset('assets/images/users/' . $vendor->shop_image) : asset('assets/common_img/vendor_banner.jpeg') }}" alt="">
        </div>
        <style>
            .call_btn_size {
                font-size: 14px;
                /* line-height: 20px; */
            }

            .mr-2 {
                margin-right: 5px;
            }

            .banner-div img{
                height: 100% !important;
                object-fit: cover;
            }

            .call_btn_size a {
                font-size: 14px;
                width: 100%;
                background-color: #ddd;
                padding: 2px 20px;
            }

            .custom-padding {
                line-height: 37px !important;
            }
            .contact-btn {
                display: flex;
                gap: 20px;
            }

            .vendor_sidebar {
                width: 100%;
                text-align: left;
                margin-top: 4px !important;
                padding: 15px 35px !important;
                background-color: #ddd;
                margin-bottom: 5px;
            }

            .vendor_sidebar.active {
                background-color: #424a4d !important;
            }

            .store_line_height {
                line-height: 20px;
            }

            .custom-img {
                height: 150px!important;
                width: 180px!important;
            }
            .custom-img2 {
                height: 150px!important;
            }

            .user-custom {
                gap: 25px;
            }
            .user-custom1{
                background-color: none!important;
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
    <div class="d-md-flex d-sm-block align-items-start shadow custom-shop-tab">
        <div class="nav flex-column nav-pills w-25 p-3 me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link vendor_sidebar rounded active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Associated Brands</button>
            <button class="nav-link vendor_sidebar rounded" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Marketing</button>
            <button class="nav-link vendor_sidebar rounded" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">News</button>
            <button class="nav-link vendor_sidebar rounded" id="v-pills--company-tab" data-bs-toggle="pill" data-bs-target="#v-pills-company" type="button" role="tab" aria-controls="v-pills-company" aria-selected="false">Company Info</button>
            <ul class="social-links">
                @if($vendor->sociallinks)
                    @foreach ($vendor->sociallinks as $social)
                        @if(strpos($social->icon, "facebook") === false)
                        @else
                            <li>
                                <a href="{{ $social->link }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            </li>
                        @endif
                        @if(strpos($social->icon, "instagram") === false)
                        @else
                            <li>
                                <a href="{{ $social->link }}" target="_blank"><i class="fab fa-instagram"></i></a>
                            </li>
                        @endif
                        @if(strpos($social->icon, "linkedin") === false)
                        @else
                            <li>
                                <a href="{{ $social->link }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            </li>
                        @endif
                        @if(strpos($social->icon, "twitter") === false)
                        @else
                            <li>
                                <a href="{{ $social->link }}" target="_blank"><i class="fab fa-twitter"></i></a>
                            </li>
                        @endif
                        @if(strpos($social->icon, "youtube") === false)
                        @else
                            <li>
                                <a href="{{ $social->link }}" target="_blank"><i class="fab fa-youtube"></i></a>
                            </li>
                        @endif
                        @if(strpos($social->icon, "pinterest") === false)
                        @else
                            <li>
                                <a href="{{ $social->link }}" target="_blank"><i class="fab fa-pinterest"></i></a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="tab-content w-100" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="row">
                    @if($shops->count() > 0)
                    @foreach($shops as $shop)
                    <div class="col-md-5 shadow rounded p-3 m-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ route('vendor.shop.service',$shop->id) }}">
                                        <img class="lazy" data-src="{{ $shop->shop_image ? asset('assets/images/categories/' . $shop->shop_image) : asset('assets/common_img/shop2.jpg') }}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-9">
                                    <a href="{{ route('vendor.shop.service',$shop->id) }}">
                                        <h6>{{$shop->shop_name}}</h6>
                                    </a>
                                    <p class="store_line_height">
                                        {{$shop->shop_number}}, {{$shop->shop_address}}
                                        <br>
                                        Total {{$shop->services->count()}} Services
                                    </p>
                                </div>
                            </div>

                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...
                Coming soon
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...
                Coming Soon
            </div>
            <div class="tab-pane fade" id="v-pills-company" role="tabpanel" aria-labelledby="v-pills-company-tab">...
                <div class="row">
                    {{$vendor->about}}
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
    </script>
@endsection
