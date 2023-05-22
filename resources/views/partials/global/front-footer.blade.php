<!--==================== Footer Section Start ====================-->
<footer class="full-row bg-white footer-section">
    <div class="container">
        <div class="row py-2">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12 justify-content-md-start justify-content-sm-center">
                <h6 class="mb-0 ">About us</h6>
                <p class="mb-0 ">
                    <span class="pr-2"><a class="" href="{{ route('front.vendor', 'about') }}">About
                            {{ config('app.name') }}.com</a></span>
                   <span class="px-2">|</span> <span class=""><a class="" href="{{route('front.contact')}}">Help & Support</a></span>
                   <span class="px-2">|</span> <span class=""><a class="" href="{{route('front.contact')}}">Careers</a></span>
                   <span class="px-2">|</span> <span class=""><a class="" href="{{route('front.contact')}}">Contact Us</a></span>
                </p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 d-flex justify-content-md-end justify-content-sm-center align-items-center">
                <h6 class="mb-0 px-2">Pay with strip</h6>
                <a href=""><img src="{{ asset('assets/front/images/strip.png') }}" class="rounded-circle" width="70" alt=""
                        srcset=""></a>
            </div>
        </div>
        <div class="row  py-2">
            <div class="col-12 justify-content-md-start justify-content-sm-center">
                <h6 class="mb-0">Our business products and Services</h6>
                <p class="mb-0 ">
                    <span class="pr-2"><a class=""
                            href="{{ route('front.vendor', 'about') }}">Advertising</a></span>
                   <span class="px-2">|</span> <span class=""><a class="" href="https://slippa.unipuller.uk">Social Media</a></span>
                   <span class="px-2">|</span> <span class=""><a class="" href="">Online Reputation
                            Management</a></span>
                </p>
            </div>
        </div>
        <div class="row  py-2">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 justify-content-md-start justify-content-sm-center">
                <h6 class="mb-0">Disclaimer</h6>
                <p class="mb-0 ">
                    The oppinion expressed within reviews are those of the auther and not the reviews of
                    {{ config('app.name') }}. {{ $gs->copyright }}
                </p>
            </div>

        </div>
        <div class="row  py-2">
            <div class="col-lg-8 col-md-8 col-sm-12 col-12 justify-content-md-start justify-content-sm-center">
                <h6 class="mb-0">Policies</h6>
                <p class="mb-0 ">
                    @foreach (DB::table('pages')->where('language_id', $langg->id)->where('slug', '!=', 'about')->where('footer', '=', 1)->get() as $data)
                        <span><a class=""
                                href="{{ route('front.vendor', $data->slug) }}">{{ $data->title }}</a></span><span class="px-2">|</span>
                    @endforeach
                </p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 d-flex justify-content-md-end justify-content-sm-center">
                <p class="mb-0 p-3 bg-green rounded-2 text-white">Advertise here: <span class="advertise-number text-white"> 0000-000-000</span></p>
            </div>
        </div>
        <div class="row  py-2">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 justify-content-md-start justify-content-sm-center">
                <h6 class="mb-0">Latest Posts</h6>
                <p class="mb-0 ">
                </p>
            </div>

        </div>

        <div class="row  py-2 d-flex justify-content-between">
            <div class="col-md-7 col-sm-12 copy-rights">
                <a href="{{ route('front.index') }}"><img class="lazy"
                        data-src="{{ asset('assets/images/' . $gs->footer_logo) }}" width="100"
                        alt="Image not found!" /></a> <span class="">{{ $gs->copyright }}</span>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="d-flex justify-content-end social-icons">
                    @foreach (DB::table('social_links')->where('user_id', 0)->where('status', 1)->get() as $link)
                        <a href="{{ $link->link }}" class="m-3"><i class="{{ $link->icon }}"></i></a>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- old code --}}
        {{-- <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="footer-widget mb-5">
                    <div class="footer-logo mb-4">
                        <a href="{{ route('front.index') }}"><img class="lazy"
                                data-src="{{ asset('assets/images/' . $gs->footer_logo) }}"
                                alt="Image not found!" /></a>
                    </div>
                    <div class="widget-ecommerce-contact">
                        @if ($ps->phone != null)
                            <span
                                class="font-medium font-500 text-dark">{{ __('Got Questions ? Call us 24/7!') }}</span>
                            <div class="text-dark h4 font-400 ">{{ $ps->phone }}</div>
                        @endif
                        @if ($ps->street != null)
                            <span class="h6  mt-2">{{ __('Address :') }}</span>
                            <div class="text-general">{{ $ps->street }}</div>
                        @endif
                        @if ($ps->email != null)
                            <span class="h6  mt-2">{{ __('Email :') }}</span>
                            <div class="text-general">{{ $ps->email }}</div>
                        @endif
                    </div>
                </div>
                <div class="footer-widget media-widget mb-5">
                    @foreach (DB::table('social_links')->where('user_id', 0)->where('status', 1)->get() as $link)
                        <a href="{{ $link->link }}"><i class="{{ $link->icon }}"></i></a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget category-widget mb-5">
                    <h3 class="widget-title mb-4">{{ __('Product Category') }}</h3>
                    <ul>
                        @foreach (DB::table('categories')->where('language_id', $langg->id)->get()->take(6) as $cate)
                            <li><a
                                    href="{{ route('front.category', $cate->slug) }}{{ !empty(request()->input('search')) ? '?search=' . request()->input('search') : '' }}">{{ $cate->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-widget category-widget mb-5">
                    <h3 class="widget-title mb-4 xs-mx-none">{{ __('Footer Links') }}</h3>
                    <ul>
                        @if ($ps->home == 1)
                            <li>
                                <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                            </li>
                        @endif
                        @if ($ps->blog == 1)
                            <li>
                                <a href="{{ route('front.blog') }}">{{ __('Blog') }}</a>
                            </li>
                        @endif
                        @if ($ps->faq == 1)
                            <li>
                                <a href="{{ route('front.faq') }}">{{ __('Faq') }}</a>
                            </li>
                        @endif
                        @foreach (DB::table('pages')->where('language_id', $langg->id)->where('footer', '=', 1)->get() as $data)
                            <li><a href="{{ route('front.vendor', $data->slug) }}">{{ $data->title }}</a></li>
                        @endforeach
                        @if ($ps->contact == 1)
                            <li>
                                <a href="{{ route('front.contact') }}">{{ __('Contact Us') }}</a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget widget-nav mb-5">
                    <h3 class="widget-title mb-4">{{ __('Recent Post') }}</h3>
                    <ul>
                        @foreach (DB::table('blogs')->where('language_id', $langg->id)->latest()->limit(3)->get() as $footer_blog)
                            <li>
                                <div class="post">
                                    <div class="post-img">
                                        <img class="lozad lazy"
                                            data-src="{{ asset('assets/images/blogs/' . $footer_blog->photo) }}"
                                            alt="">
                                    </div>
                                    <div class="post-details">
                                        <a href="{{ route('front.blogshow', $footer_blog->slug) }}">
                                            <h4 class="post-title">
                                                {{ mb_strlen($footer_blog->title, 'UTF-8') > 45 ? mb_substr($footer_blog->title, 0, 45, 'UTF-8') . ' ..' : $footer_blog->title }}
                                            </h4>
                                        </a>
                                        <p class="date">
                                            {{ date('M d - Y', strtotime($footer_blog->created_at)) }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div> --}}
    </div>
</footer>
<!--==================== Footer Section End ====================-->

<!--==================== Copyright Section Start ====================-->

{{-- <div class="container">

    <div class="mx-auto text-center py-3">
        <span class="sm-mb-10 d-block">{{ $gs->copyright }}</span>
    </div>


</div> --}}
<!--==================== Copyright Section End ====================-->
