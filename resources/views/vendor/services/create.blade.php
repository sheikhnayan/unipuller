@extends('layouts.vendor')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet" />
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')

<div class="content-area">
	<div class="mr-breadcrumb">
		<div class="row">
			<div class="col-lg-12">
				<h4 class="heading">{{ __('Services') }} <a class="add-btn" href="{{ route('vendor-services-index') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
				<ul class="links">
					<li>
						<a href="{{ route('vendor.dashboard') }}">{{ __('Dashboard') }} </a>
					</li>
					<li>
						<a href="javascript:;">{{ __('Services') }} </a>
					</li>
					<li>
						<a href="{{ route('vendor-services-index') }}">{{ __('All Services') }}</a>
					</li>
					<li>
						<a href="{{ route('vendor-services-create') }}">{{ __('Add Service') }}</a>
					</li>

				</ul>
			</div>
		</div>
	</div>
	<form id="geniusform" action="{{route('vendor-services-store')}}" method="POST" enctype="multipart/form-data">
		{{csrf_field()}}
		@include('alerts.admin.form-both')
		<div class="row">
			<div class="col-lg-8">
				<div class="add-product-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="product-description">
								<div class="body-area">
									<div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Select Language') }}*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select name="language_id" required="">
												@foreach(DB::table('languages')->get() as $ldata)
												<option value="{{ $ldata->id }}">{{ $ldata->language }}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Service Name') }}* </h4>
												<p class="sub-heading">{{ __('(In Any Language)') }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<input type="text" class="input-field" placeholder="{{ __('Enter Service Name') }}" name="name" required="">
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Shops') }}*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="shop" name="shop_id" required="">
												<option value="">{{ __('Select Shop') }}</option>
												@foreach($shops as $shop)
												<option value="{{ $shop->id }}">{{$shop->shop_name}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('National or International') }}*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select name="national_int" id="national_int">
												<option value="" disabled selected>Select type</option>
												<option value="1">National</option>
												<option value="2">International</option>
											</select>
										</div>
									</div>

									<div class="showbox">
										<div class="row country-list">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Country') }}*</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<select name="country_id[]" class="form-control select2" multiple>
													<option value="all">All Country</option>
													@foreach ($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                                    @endforeach
												</select>
											</div>
										</div>
										<div class="row city-list">
										<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Country') }}*</h4>
												</div>
											</div>
											<div class="col-lg-12 mb-3">
												<select name="single_country_id[]" class="form-control select2 country">
													<option value="" disabled selected>Select Country</option>
													@foreach ($countries as $country)
                                                        <option data-href="{{ route('vendor-city-load',$country->id) }}" value="{{ $country->id }}">{{ $country->country_name }}</option>
                                                    @endforeach
												</select>
											</div>
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('City') }}*</h4>
												</div>
											</div>
											<div class="col-lg-12">
												<select name="city_id[]" id="citylist" class="select2" multiple>
													<option value="all">All City</option>
													
												</select>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Service Category') }}*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="cat" name="category_id" required="">
												<option value="">{{ __('Select Service Category') }}</option>
												@foreach($cats as $cat)
												<option data-href="{{ route('vendor-subcat-load',$cat->id) }}" value="{{ $cat->id }}">{{$cat->name}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Sub Category') }}</h4>
												<p class="sub-heading">{{ __('(Optional)') }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="subcat" name="subcategory_id" disabled="">
												<option value="">{{ __('Select Sub Category') }}</option>
											</select>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Child Category') }}</h4>
												<p class="sub-heading">{{ __('(Optional)') }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="childcat" name="childcategory_id" disabled="">
												<option value="">{{ __('Select Child Category') }}</option>
											</select>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													{{ __('Service Description') }}*
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="text-editor">
												<textarea class="nic-edit-p" name="description"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													{{ __('Service Short Description (max 20 words)') }}*
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="text-editor">
												<textarea class="nic-edit-p" name="short_description"></textarea>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">
													{{ __('Service Buy/Return Policy') }}*
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="text-editor">
												<textarea class="nic-edit-p" name="policy"></textarea>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="checkbox-wrapper">
												<input type="checkbox" name="seo_check" value="1" class="checkclick" id="allowProductSEO" value="1">
												<label for="allowProductSEO">{{ __('Allow Service SEO') }}</label>
											</div>
										</div>
									</div>



									<div class="showbox">
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Meta Tags') }}</h4>
													<p class="sub-heading">{{ __('(Optional)') }}</p>
												</div>
											</div>
											<div class="col-lg-12">
												<ul id="metatags" class="myTags">
												</ul>
											</div>
										</div>

										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Meta Description') }}
													</h4>
													<p class="sub-heading">{{ __('(Optional)') }}</p>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="text-editor">
													<textarea name="meta_description" class="input-field" placeholder="{{ __('Meta Description') }}"></textarea>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Service Type') }}*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="service_type" class="servicetype" name="service_type" required="">
												<option value="">{{ __('Select Service Type') }}</option>
												<option value="hourly">Hourly</option>
												<option value="contractual" selected>Contractual</option>
												<option value="other">Other</option>
											</select>
										</div>
									</div>

									<div class="showbox">
										<div class="row">
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Day') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Start Time') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('End Time') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<select class="" name="day[]" required="">
														<option value="saturday" selected>Saturday</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<input type="time" name="start_time[]" class="input-field" placeholder="{{ __('Start Time') }}" />
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<input type="time" name="end_time[]" class="input-field" placeholder="{{ __('End Time') }}" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Day') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Start Time') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('End Time') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<select class="" name="day[]" required="">
														<option value="sunday" selected>Sunday</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<input type="time" name="start_time[]" class="input-field" placeholder="{{ __('Start Time') }}" />
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<input type="time" name="end_time[]" class="input-field" placeholder="{{ __('End Time') }}" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Day') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Start Time') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('End Time') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<select class="" name="day[]" required="">
														<option value="monday" selected>Monday</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<input type="time" name="start_time[]" class="input-field" placeholder="{{ __('Start Time') }}" />
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<input type="time" name="end_time[]" class="input-field" placeholder="{{ __('End Time') }}" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Day') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Start Time') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('End Time') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<select class="" name="day[]" required="">
														<option value="tuesday" selected>Tuesday</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<input type="time" name="start_time[]" class="input-field" placeholder="{{ __('Start Time') }}" />
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<input type="time" name="end_time[]" class="input-field" placeholder="{{ __('End Time') }}" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Day') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Start Time') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('End Time') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<select class="" name="day[]" required="">
														<option value="wednesday" selected>Wednesday</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<input type="time" name="start_time[]" class="input-field" placeholder="{{ __('Start Time') }}" />
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<input type="time" name="end_time[]" class="input-field" placeholder="{{ __('End Time') }}" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Day') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Start Time') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('End Time') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<select class="" name="day[]" required="">
														<option value="thursday" selected>Thursday</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<input type="time" name="start_time[]" class="input-field" placeholder="{{ __('Start Time') }}" />
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<input type="time" name="end_time[]" class="input-field" placeholder="{{ __('End Time') }}" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Day') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('Start Time') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="left-area">
													<h4 class="heading">
														{{ __('End Time') }} *
													</h4>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<select class="" name="day[]" required="">
														<option value="friday" selected>Friday</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<input type="time" name="start_time[]" class="input-field" placeholder="{{ __('Start Time') }}" />
												</div>
											</div>
											<div class="col-lg-4">
												<div class="text-editor">
													<input type="time" name="end_time[]" class="input-field" placeholder="{{ __('End Time') }}" />
												</div>
											</div>
										</div>
									</div>



								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="add-product-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="product-description">
								<div class="body-area">
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Service Image') }} *</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="panel panel-body">
												<div class="span4 cropme text-center" id="landscape" style="width: 100%; height: 285px; border: 1px dashed #ddd; background: #f1f1f1;">
													<a href="javascript:;" id="crop-image" class=" mybtn1" style="">
														<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}
													</a>
												</div>
											</div>
										</div>
									</div>
									<input type="hidden" id="feature_photo" name="photo" value="">
									<input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*" multiple>
									<div class="row mb-4">
										<div class="col-lg-12 mb-2">
											<div class="left-area">
												<h4 class="heading">
													{{ __('Service Gallery Images') }} *
												</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<a href="#" class="set-gallery" data-toggle="modal" data-target="#setgallery">
												<i class="icofont-plus"></i> {{ __('Set Gallery') }}
											</a>
										</div>
									</div>



									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Service Price') }}*</h4>
												<p class="sub-heading">
													({{ __('In') }} {{$sign->name}})
												</p>
											</div>
										</div>
										<div class="col-lg-12">
											<input name="price" type="number" class="input-field" placeholder="{{ __('e.g 20') }}" step="0.1" required="" min="0">
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Service Discount Price') }}</h4>
												<p class="sub-heading">{{ __('(Optional)') }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<input name="previous_price" step="0.1" type="number" class="input-field" placeholder="{{ __('e.g 20') }}" min="0">
										</div>
									</div>

									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Payment Installment') }}</h4>
												<p class="sub-heading">{{ __('(Optional)') }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="payment_installment" class="servicetype" name="payment_installment" required="">
												<option value="">{{ __('Select Payment Installment') }}</option>
												<option value="1">Available</option>
												<option value="2" selected>Unavailable</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Service Availability') }}</h4>
												<p class="sub-heading">{{ __('(Optional)') }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="service_availability" class="servicetype" name="availability" required="">
												<option value="">{{ __('Select Service Availability') }}</option>
												<option value="1">Online</option>
												<option value="2">Offline</option>
												<option value="3" selected>Online/Offline</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Emergency Service') }}</h4>
												<p class="sub-heading">{{ __('(Optional)') }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="emergency_service" class="servicetype" name="is_emergency" required="">
												<option value="">{{ __('Select Emergency Service') }}</option>
												<option value="1">Available</option>
												<option value="2" selected>Unavailable</option>
											</select>
										</div>
									</div>
									<div class="showbox">
										<div class="row">
											<div class="col-lg-12">
												<div class="left-area">
													<h4 class="heading">{{ __('Emergency Charge') }}</h4>
													<p class="sub-heading">{{ __('(Optional)') }}</p>
												</div>
											</div>
											<div class="col-lg-12">
												<input name="emergency_charge" step="0.1" type="number" class="input-field" placeholder="{{ __('e.g 20') }}" min="0">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Experience') }}*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<input name="experience" type="text" class="input-field" placeholder="{{ __('1 years') }}">
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Specialization') }}</h4>
												<p class="sub-heading">{{ __('(Optional)') }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<input name="specialization" type="text" class="input-field" placeholder="{{ __('Enter speciality') }}">
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Facilities') }}</h4>
												<p class="sub-heading">{{ __('(Optional)') }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<textarea name="facilities" type="text" class="input-field" placeholder="{{ __('write service facilities') }}"></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Note') }}</h4>
												<p class="sub-heading">{{ __('(Optional)') }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<textarea name="note" type="text" class="input-field" placeholder="{{ __('write service note') }}"></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Youtube Video URL') }}</h4>
												<p class="sub-heading">{{ __('(Optional)') }}</p>
											</div>
										</div>
										<div class="col-lg-12">
											<input name="youtube" type="text" class="input-field" placeholder="{{ __('Enter Youtube Video URL') }}">
										</div>
									</div>
									<div class="row text-center">
										<div class="col-6 offset-3">
											<button class="addProductSubmit-btn" type="submit">{{ __('Create Service') }}</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Image Gallery') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="top-area">
					<div class="row">
						<div class="col-sm-6 text-right">
							<div class="upload-img-btn">
								<label for="image-upload" id="prod_gallery"><i class="icofont-upload-alt"></i>{{ __('Upload File') }}</label>
							</div>
						</div>
						<div class="col-sm-6">
							<a href="javascript:;" class="upload-done" data-dismiss="modal"> <i class="fas fa-check"></i> {{ __('Done') }}</a>
						</div>
						<div class="col-sm-12 text-center">( <small>{{ __('You can upload multiple Images.') }}</small> )</div>
					</div>
				</div>
				<div class="gallery-images">
					<div class="selected-image">
						<div class="row">


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')

<script src="{{asset('assets/admin/js/jquery.Jcrop.js')}}"></script>
<script src="{{asset('assets/admin/js/jquery.SimpleCropper.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

<script type="text/javascript">
	(function($) {
		"use strict";

		// Gallery Section Insert

		$(document).on('click', '.remove-img', function() {
			var id = $(this).find('input[type=hidden]').val();
			$('#galval' + id).remove();
			$(this).parent().parent().remove();
		});

		$(document).on('click', '#prod_gallery', function() {
			$('#uploadgallery').click();
			$('.selected-image .row').html('');
			$('#geniusform').find('.removegal').val(0);
		});


		$("#uploadgallery").change(function() {
			var total_file = document.getElementById("uploadgallery").files.length;
			for (var i = 0; i < total_file; i++) {
				$('.selected-image .row').append('<div class="col-sm-6">' +
					'<div class="img gallery-img">' +
					'<span class="remove-img"><i class="fas fa-times"></i>' +
					'<input type="hidden" value="' + i + '">' +
					'</span>' +
					'<a href="' + URL.createObjectURL(event.target.files[i]) + '" target="_blank">' +
					'<img src="' + URL.createObjectURL(event.target.files[i]) + '" alt="gallery image">' +
					'</a>' +
					'</div>' +
					'</div> '
				);
				$('#geniusform').append('<input type="hidden" name="galval[]" id="galval' + i + '" class="removegal" value="' + i + '">')
			}

		});

		// Gallery Section Insert Ends

	})(jQuery);
</script>

<script type="text/javascript">
	(function($) {
		"use strict";

		$('.cropme').simpleCropper();

	})(jQuery);


	$(document).on('click', '#size-check', function() {
		if ($(this).is(':checked')) {
			$('#default_stock').addClass('d-none')
		} else {
			$('#default_stock').removeClass('d-none');
		}
	})
</script>


@include('partials.admin.product.product-scripts')
@endsection