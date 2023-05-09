{{-- s  main-features-section --}}
@php
    // currently the tables are not proerly structured so i have to just make it dynamic --added by huma
    $subcategories = DB::table('subcategories')
        ->take(4)
        ->get();
    $shopUser = DB::table('user_shops')
        ->take(4)
        ->get();
@endphp
<div class="container container-sm py-4 main-features-section">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 buy-sell py-2">
            <a href="#">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Top Deal</h5>
                        <div class="row">

                            <div class="col-12">
                                <div class="card-img">
                                    <img class="lazy" data-src="{{ asset('assets/front/images/services/deal.png') }}"
                                        alt="" height="">
                                </div>
                                <span class="badge bg-danger text-white">Up to 37% off</span><span class="text-danger">
                                    Deal</span>
                                <p class="text-secondary card-text mb-2 ">Lorem ipsum dolor Lorem ipsum dolor
                                    Lorem ipsum dolor Lorem ipsum dolor </p>
                            </div>
                        </div>
                        <a href="#" class="card-link text-dark text-deconration-none mt-2">Show more details</a>
                    </div>
                </div>

            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 buy-sell py-2">
            <a href="#">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Buy products</h5>
                        <div class="row">
                            @foreach ($subcategories as $category)
                                <div class="col-6">
                                    <a href="{{ route('front.categories') }}" class="text-decoration-none">
                                        <div class="card-item">
                                            <img class="lazy"
                                                data-src="{{ asset('assets/front/images/products/sample.png') }}"
                                                alt="">
                                        </div>
                                        <p class="text-secondary card-text mb-2 text-center">
                                            @if (strlen($category->name) > 30)
                                                {{ substr($category->name, 0, 30) . '...' }}
                                            @else
                                                {{ $category->name }}
                                            @endif
                                        </p>
                                    </a>

                                </div>
                            @endforeach
                        </div>
                        <a href="#" class="card-link text-dark text-deconration-none mt-2">Show more details</a>
                    </div>
                </div>

            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 buy-sell py-2">
            @php
                $route = route('vendor.login');
                if ($gs->reg_vendor == 1) {
                    if (Auth::check()) {
                        if (Auth::guard('web')->user()->is_vendor == 2) {
                            $route = route('vendor.dashboard');
                        } else {
                            $route = route('user-package');
                        }
                    }
                }
            @endphp
            <a href="{{ $route }}">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sell a product</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-img-sell-product">
                                    <img class="lazy"
                                        data-src="{{ asset('assets/front/images/services/sell-product.png') }}"
                                        alt="" height="">
                                </div>
                            </div>
                        </div>
                        <a href="#" class="card-link text-dark text-deconration-none mt-2">Show more details</a>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 buy-sell py-2">
            <a href="#">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Study Support</h5>
                        <div class="row">
                            <div class="col-6">
                                <a href="#" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/tutoring.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Tutoring
                                    </p>
                                </a>
                            </div>
                            <div class="col-6 ">
                                <a href="#" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/elearning.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        E-learning
                                    </p>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/study-abroad.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Study Abroad
                                    </p>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/books.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Purchase Books
                                    </p>
                                </a>
                            </div>
                        </div>
                        <a href="#" class="card-link text-dark text-deconration-none mt-2">Show more details</a>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 buy-sell py-2">
            <a href="#">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Book a service</h5>
                        <div class="row">
                            <div class="col-6 ">
                                <a href="{{ route('front.categories') }}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/doctor.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Doctor
                                    </p>
                                </a>

                            </div>
                            <div class="col-6 ">
                                <a href="{{ route('front.categories') }}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/engineer.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Engineer
                                    </p>
                                </a>

                            </div>
                            <div class="col-6">
                                <a href="{{ route('front.categories') }}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/lawyer.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Lawyer
                                    </p>
                                </a>

                            </div>
                            <div class="col-6">
                                <a href="{{ route('front.categories') }}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/meison.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Meison
                                    </p>
                                </a>

                            </div>
                        </div>
                        <a href="#" class="card-link text-dark text-deconration-none mt-2">Show more details</a>
                    </div>
                </div>

            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 buy-sell py-2">
            <a href="#">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Technology services</h5>
                        <div class="row">
                            <div class="col-6 ">
                                <a href="{{ route('front.categories') }}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/app-dev.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Application Development
                                    </p>
                                </a>

                            </div>
                            <div class="col-6 ">
                                <a href="{{ route('front.categories') }}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/web-desiogn.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Web Designing
                                    </p>
                                </a>

                            </div>
                            <div class="col-6">
                                <a href="{{ route('front.categories') }}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/web-dev.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Web Development
                                    </p>
                                </a>

                            </div>
                            <div class="col-6">
                                <a href="{{ route('front.categories') }}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/cyber.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Cyber Secuity
                                    </p>
                                </a>

                            </div>
                        </div>
                        <a href="#" class="card-link text-dark text-deconration-none mt-2">Show more details</a>
                    </div>
                </div>

            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 buy-sell py-2">
            <a href="{{route('front.contact')}}">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Domain Hosting</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-img-sell-product">
                                    <img class="lazy"
                                        data-src="{{ asset('assets/front/images/services/domain-hosting.png') }}"
                                        alt="" height="">
                                </div>
                            </div>
                        </div>
                        <a href="#" class="card-link text-dark text-deconration-none mt-2">Show more details</a>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 buy-sell py-2">
            <a href="#">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search for local companies</h5>
                        <div class="row">
                            @foreach ($shopUser as $vendor)
                                <div class="col-6">
                                    <a href="{{ route('vendor.list') }}" class="text-decoration-none">
                                        <div class="card-item text-center">
                                                <img class="lazy img-fluid" data-src="{{ $vendor->shop_image ? asset('assets/images/categories/'.$vendor->shop_image):asset('assets/common_img/vendor_profile.jpeg') }}" alt="Product Image">
                                        </div>
                                        <p class="text-secondary card-text mb-2 text-center">
                                            @if (strlen($vendor->shop_name) > 30)
                                                {{ substr($vendor->shop_name, 0, 30) . '...' }}
                                            @else
                                                {{ $vendor->shop_name }}
                                            @endif
                                        </p>
                                    </a>

                                </div>
                            @endforeach

                        </div>
                        <a href="#" class="card-link text-dark text-deconration-none mt-2">Show more details</a>
                    </div>
                </div>

            </a>
        </div>

    </div>
</div>
</div>
