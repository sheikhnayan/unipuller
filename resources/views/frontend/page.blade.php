@extends('layouts.front')

@section('content')
    @include('partials.global.common-header')



    <div class="page-section">
        <!-- breadcrumb -->
        <div class="full-row bg-light overlay-dark py-5"
            style="background-image: url({{ $gs->breadcrumb_banner ? asset('assets/images/' . $gs->breadcrumb_banner) : asset('assets/images/noimage.png') }}); background-position: center center; background-size: cover;">
            <div class="container">
                <div class="row text-center text-white">
                    <div class="col-12">
                        <h3 class="mb-2 text-white">{{ $page->title }}</h3>
                    </div>
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-inline-flex bg-transparent p-0">
                                <li class="breadcrumb-item"><a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <!--==================== About Owner Section Start ====================-->
        <div class="full-row">
            <div class="container">
                <div class="row">
                    <div class="mb-4 d-lg-none">
                        <button class="dashboard-sidebar-btn btn bg-dark rounded">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                    <div class="col-lg-4 md-mb-50">
                        <div id="sidebar" class="sidebar-category bg-light  p-30">
                            <div class="dashbaord-sidebar-close d-lg-none d-flex justify-content-end">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="widget border-0 py-0 search-widget">
                                <form class="contactform" action="#" id="categoryForm" method="GET">
                                    <input type="text" class="form-control " id="category-search" name="search"
                                        placeholder="{{ __('Search Here') }}"
                                        value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}" required>
                                    <div class="text-danger" id="message"></div>
                                    <button type="submit" name="submit"><i
                                            class="flaticon-search flat-mini text-red"></i></button>
                                </form>
                            </div>
                            <div class="widget border-0 py-0 widget_categories">
                                <h4 class="widget-title down-line">{{ __('Categories') }}</h4>
                                <ul id="category-list">
                                    @php
                                    @endphp
                                    {{-- @foreach ($categories as $category)
                                        <li><a class=""
                                                href="{{ route('front.service_category', $category->slug) }}{{ !empty(request()->input('search')) ? '?search=' . request()->input('search') : '' }}">
                                                {{ $category->name }} </a></li>
                                    @endforeach --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-7 col-md-12">
                                {!! clean($page->details, ['Attr.EnableID' => true]) !!}
                            </div>
                            <div class="col-lg-5 col-md-12 sm-mx-none mt-5">
                                <img class="sm-mb-30"
                                    src="{{ $page->photo ? asset('assets/images/pages/' . $page->photo) : 'Image not found!' }}"
                                    alt="Image not found!">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--==================== About Owner Section End ====================-->

    </div>

    <script>
        // const categoryForm = document.getElementById('categoryForm');
        const categories = @json($categories); // Fetch the categories from Laravel

        // Generate the category list
        const categoryList = document.getElementById('category-list');
        categories.forEach(category => {
            console.log('category.slug', category.slug);
            const li = document.createElement('li');
            const link = document.createElement('a');
            link.textContent = category.name;
            var routeUrl = "{{ route('front.service_category', ':slug') }}";
            var generatedUrl = routeUrl.replace(':slug', category.slug);
            link.href = generatedUrl;
            li.appendChild(link);
            categoryList.appendChild(li);
        });

        // Add event listener to the search box
        const searchBox = document.getElementById('category-search');

        searchBox.addEventListener('keyup', (e) => {
            console.log(' i m here', searchBox);
            const searchValue = e.target.value.trim().toLowerCase();

            if (searchValue.length >= 1) {
                // Filter the categories based on the search value
                const filteredCategories = categories.filter(category =>
                    category.name.toLowerCase().includes(searchValue)
                );

                // Generate the filtered category list
                categoryList.innerHTML = '';
                filteredCategories.forEach(category => {
                    const li = document.createElement('li');
                    const link = document.createElement('a');
                    link.textContent = category.name;
                    var routeUrl = "{{ route('front.service_category', ':slug') }}";
                    var generatedUrl = routeUrl.replace(':slug', category.slug);
                    link.href = generatedUrl;
                    li.appendChild(link);
                    categoryList.appendChild(li);
                });
            } else {
                // If the search value is less than 3 characters, display the whole category list
                categoryList.innerHTML = '';
                categories.forEach(category => {
                    const li = document.createElement('li');
                    const link = document.createElement('a');
                    link.textContent = category.name;
                    var routeUrl = "{{ route('front.service_category', ':slug') }}";
                    var generatedUrl = routeUrl.replace(':slug', category.slug);
                    link.href = generatedUrl;
                    li.appendChild(link);
                    categoryList.appendChild(li);
                });
            }
        });
    </script>

    {{-- {{-- @includeIf('partials.global.common-footer') --}}
 --}}
@endsection
