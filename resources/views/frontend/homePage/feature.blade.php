{{-- s  main-features-section --}}
@php
    // currently the tables are not proerly structured so i have to just make it dynamic --added by huma
    $subcategories = DB::table('subcategories')
        ->take(4)
        ->get();
@endphp
<div class="container container-sm py-4 main-features-section">
    <div class="row">
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 buy-sell py-2">
            <a href="#">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Top Deal</h5>
                        <div class="row">

                            <div class="col-12">
                                <div class="card-img">
                                    <img class="lazy" data-src="{{ asset('assets/front/images/deal.png') }}"
                                        alt="" height="">
                                </div>
                                <span class="badge bg-danger text-white">Up to 37% off</span><span class="text-danger">
                                    Deal</span>
                                <p class="text-secondary card-text mb-2">Lorem ipsum dolor Lorem ipsum dolor
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
                                <div class="col-6 card-item">
                                    <a href="{{ route('front.categories') }}" class="text-decoration-none">
                                        <img class="lazy" data-src="{{ asset('assets/front/images/sample.png') }}"
                                            alt="">
                                        <p class="text-secondary card-text mb-2">
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
                                    <img class="lazy" data-src="{{ asset('assets/front/images/sell-a-product.png') }}"
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
                            <div class="col-6 card-item">
                                <a href="#" class="text-decoration-none">
                                    <img class="lazy" data-src="{{ asset('assets/front/images/tutoring.png') }}"
                                        alt="">
                                    <p class="text-secondary card-text mb-2">
                                        Tutoring
                                    </p>
                                </a>
                            </div>
                            <div class="col-6 card-item">
                                <a href="#" class="text-decoration-none">
                                    <img class="lazy" data-src="{{ asset('assets/front/images/elearning.png') }}"
                                        alt="">
                                    <p class="text-secondary card-text mb-2">
                                        E-learning
                                    </p>
                                </a>
                            </div>
                            <div class="col-6 card-item">
                                <a href="#" class="text-decoration-none">
                                    <img class="lazy" data-src="{{ asset('assets/front/images/study-abroad.png') }}"
                                        alt="">
                                    <p class="text-secondary card-text mb-2">
                                        Study Abroad
                                    </p>
                                </a>
                            </div>
                            <div class="col-6 card-item">
                                <a href="#" class="text-decoration-none">
                                    <img class="lazy" data-src="{{ asset('assets/front/images/purchase-book.png') }}"
                                        alt="">
                                    <p class="text-secondary card-text mb-2">
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
    </div>
</div>
</div>
