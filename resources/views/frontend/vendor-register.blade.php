@extends('layouts.front')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
@include('partials.global.common-header')

 <!-- breadcrumb -->
 <div class="full-row bg-light overlay-dark py-5" style="background-image: url({{ $gs->breadcrumb_banner ? asset('assets/images/'.$gs->breadcrumb_banner):asset('assets/images/noimage.png') }}); background-position: center center; background-size: cover;">
    <div class="container">
        <div class="row text-center text-white">
            <div class="col-12">
                <h3 class="mb-2 text-white">{{ __('Register') }}</h3>
            </div>
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 d-inline-flex bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>

                        <li class="breadcrumb-item active" aria-current="page">{{ __('Vendor Register') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb -->

        <!--==================== Registration Form Start ====================-->
        <div class="full-row">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="woocommerce">
                            <div class="row">
                                <div class="col-lg-6 col-md-8 col-12 mx-auto">
                                    <div class="registration-form border">
                                        @include('includes.admin.form-login')
                                        <h3>{{ __('Vendor Registration') }}</h3>
                                        <form id="registerform" action="{{route('user-register-submit')}}" method="POST">
                                            @csrf
                                            <p>
                                                <input type="text" name="name" class="form-control" placeholder="{{ __('Vendor Full Name') }}"  >
                                            </p>
                                            <p>
                                                <input type="email" name="email" class="form-control" required=""  placeholder="{{ __('Vendor Email Address') }}" >
                                            </p>
                                            <p>
                                                <input type="text" name="phone" class="form-control" required=""  placeholder="{{ __('Vendor Phone Number') }}" >
                                            </p>
                                            <p>
                                                <select name="country" class="form-control select2" required="">
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            <p>
                                                <input type="text" name="address" class="form-control" required=""  placeholder="{{ __('Vendor Address') }}" >
                                            </p>
                                            <p>
                                                <textarea type="text" name="about" class="form-control" required=""  placeholder="{{ __('About') }}" ></textarea>
                                            </p>
                                            <p>
                                                <input type="text" name="website" class="form-control" placeholder="{{ __('Vendor Website Address') }}" />
                                            </p>
                                            <p>
                                                <select name="service_category_id[]" placeholder="" class="form-control select2" multiple required="">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                            <style>
                                                .select2::placeholder{
                                                    top:0;
                                                    margin-top: -8px;
                                                    position: absolute;
                                                }
                                                .registration-form textarea {
                                                    width: 100%;
                                                    background: var(--theme-light-color);
                                                    padding: 5px 20px;
                                                    border: 1px solid var(--theme-gray-color);
                                                    border-radius: 0;
                                                }
                                                .registration-form select {
                                                    width: 100%;
                                                    background: var(--theme-light-color);
                                                    padding: 5px 20px;
                                                    border: 1px solid var(--theme-gray-color);
                                                    border-radius: 0;
                                                }
                                                .select2-container .select2-search--inline .select2-search__field{
                                                    height: 35px;
                                                }
                                                .select2-container .select2-selection--multiple{
                                                    min-height: 42px;
                                                    line-height: 33px;
                                                }
                                            </style>
                                            <p>
                                                <input type="text" name="shop_name" class="form-control" required=""  placeholder="{{ __('Shop Name') }}" >
                                            </p>
                                            <p>
                                                <input type="text" name="owner_name" class="form-control" required=""  placeholder="{{ __('Shop Owner Name') }}" >
                                            </p>
                                            <p>
                                                <input type="text" name="shop_number" class="form-control" required=""  placeholder="{{ __('Shop Number') }}" >
                                            </p>
                                            <p>
                                                <input type="text" name="shop_address" class="form-control" required=""  placeholder="{{ __('Shop Address') }}" >
                                            </p>

                                            <p>
                                                <input type="text" name="reg_number" class="form-control" required=""  placeholder="{{ __('Registration Number') }}" >
                                            </p>
                                            <p>
                                                <input type="text" name="shop_message" class="form-control" required=""  placeholder="{{ __('Shop Message') }}" >
                                            </p>

                                            <p>
                                                <input type="password" name="password" class="form-control" required=""  placeholder="{{ __('Password') }}" >
                                            </p>
                                            <p>
                                                <input type="password" name="password_confirmation" class="form-control" required=""  placeholder="{{ __('Confirm Password') }}" >
                                            </p>

                                            @if($gs->is_capcha == 1)
                                            <div class="form-input mb-3">
                                                 {!! NoCaptcha::display() !!}
                                                 {!! NoCaptcha::renderJs() !!}
                                                 @error('g-recaptcha-response')
                                                 <p class="my-2">{{$message}}</p>
                                                 @enderror
                                             </div>
                                             @endif
                                             <input type="hidden" name="vendor"  value="1">
                                            <input id="processdata" type="hidden" value="{{ __('Processing...') }}">
                                                <button type="submit" class="btn btn-primary float-none w-100 rounded-0 submit-btn" name="register" value="Register">{{ __('Register') }}</button>
                                            </p>
                                        </form>
                                        <p>
                                                {{ __("Do have any account?") }}<a href="{{ route('user.login') }}"  class="text-secondary">{{__(' Login')}}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--==================== Registration Form Start ====================-->


@include('partials.global.common-footer')
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
    placeholder: "Select Category",
    allowClear: true
  });
        });
    </script>
@endsection
