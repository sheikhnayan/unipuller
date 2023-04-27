@extends('layouts.load')

@section('content')
    <div class="content-area">

        <div class="add-product-content1">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-description">
                        <div class="body-area">
                            @include('alerts.admin.form-error')
                            <form id="geniusformdata" action="{{ route('vendor-shop-create') }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Select Language') }}*</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <select name="language_id" required="">
                                            @foreach (DB::table('languages')->get() as $ldata)
                                                <option value="{{ $ldata->id }}">{{ $ldata->language }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Select Country') }}*</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <select name="country">
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->country_name }}">{{ $country->country_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Select Category') }}*</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <select name="category_id" id="cat" required="">
                                            @foreach ($categories as $data)
                                                <option data-href="{{ route('vendor-subcat-load',$data->id) }}" value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
										<div class="col-lg-4">
											<div class="left-area">
												<h4 class="heading">{{ __('Sub Category') }}</h4>
												<p class="sub-heading">{{ __('(Optional)') }}</p>
											</div>
										</div>
										<div class="col-lg-7">
											<select id="subcat" name="subcategory_id" disabled="">
												<option value="">{{ __('Select Sub Category') }}</option>
											</select>
										</div>
									</div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Name') }} *</h4>
                                            <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="shop_name"
                                            placeholder="{{ __('Enter Name') }}" required="" value="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Owner Name') }} *</h4>
                                            <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="owner_name"
                                            placeholder="{{ __('Enter Owner Name') }}" required="" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Email') }} </h4>
                                            <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="email"
                                            placeholder="{{ __('Enter Email') }}" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Phone') }} </h4>
                                            <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="phone"
                                            placeholder="{{ __('Enter Phone Number') }}" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Shop Number') }} *</h4>
                                            <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="shop_number"
                                            placeholder="{{ __('Enter Shop Number') }}" required="" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Shop Address') }} *</h4>
                                            <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="shop_address"
                                            placeholder="{{ __('Enter Shop Address') }}" required="" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Shop About') }} *</h4>
                                            <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <textarea type="text" class="input-field" name="shop_about"
                                            placeholder="{{ __('Enter Shop About') }}" required=""></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Reg Number') }} *</h4>
                                            <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="reg_number"
                                            placeholder="{{ __('Enter Reg Number') }}" required="" value="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Shop Website') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="website" placeholder="{{ __('Shop Website') }}" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Facebook URL') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="facebook" placeholder="{{ __('Facebook URL') }}" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Instagram URL') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="instagram" placeholder="{{ __('Instagram URL') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Linkedin URL') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="linkedin" placeholder="{{ __('Linkedin URL') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Twitter URL') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="twitter" placeholder="{{ __('Twitter URL') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Youtube URL') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="youtube" placeholder="{{ __('Youtube URL') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Pinterest URL') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="input-field" name="pinterest" placeholder="{{ __('Pinterest URL') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading">{{ __('Set Image') }} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="img-upload">
                                            <div id="image-preview" class="img-preview"
                                                style="background: url({{ asset('assets/admin/images/upload.png') }});">
                                                <label for="image-upload" class="img-label" id="image-label"><i
                                                        class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                                <input type="file" name="shop_image" class="img-upload"
                                                    id="image-upload">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">
                                        <h4 class="heading">{{ __('Set Banner') }} *</h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="img-upload full-width-img">
                                        <div id="image-preview" class="img-preview" style="background: url({{ asset('assets/admin/images/upload.png') }});">
                                            <label for="image-upload" class="img-label"><i class="icofont-upload-alt"></i>{{ __('Upload Banner') }}</label>
                                            <input type="file" name="shop_banner" class="img-upload">
                                        </div>
                                        <p class="text">{{__('Prefered Size: (1230x267) or Square Sized Image')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <button class="addProductSubmit-btn"
                                            type="submit">{{ __('Create Shop') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
