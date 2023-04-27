@extends('layouts.vendor')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/jquery.Jcrop.css')}}" rel="stylesheet"/>
<link href="{{asset('assets/admin/css/Jcrop-style.css')}}" rel="stylesheet"/>

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
			<form id="geniusform" action="{{route('vendor-services-update',$data->id)}}" method="POST" enctype="multipart/form-data">
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
															<option value="{{ $ldata->id }}" {{ $ldata->id == $data->language_id ? 'selected' : '' }}>{{ $ldata->language }}</option>
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
													<input type="text" class="input-field" placeholder="{{ __('Enter Service Name') }}" name="name" value="{{$data->name}}" required="">
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
															<option value="{{ $shop->id }}" {{ $shop->id == $data->shop_id ? 'selected' : '' }}>{{$shop->shop_name}}</option>
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
													<select name="national_int">
														<option value="1" @if($data->national_int == 1) selected @endif>National</option>
														<option value="2" @if($data->national_int == 2) selected @endif>International</option>
													</select>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-12">
													<div class="left-area">
														<h4 class="heading">{{ __('Category') }}*</h4>
													</div>
												</div>
												<div class="col-lg-12">
													<select id="cat" name="category_id" required="">
														<option>{{ __('Select Category') }}</option>
														@foreach($cats as $cat)
															<option data-href="{{ route('vendor-subcat-load',$cat->id) }}" value="{{$cat->id}}" {{$cat->id == $data->category_id ? "selected":""}} >{{$cat->name}}</option>
														@endforeach
													</select>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-12">
													<div class="left-area">
														<h4 class="heading">{{ __('Sub Category') }}*</h4>
													</div>
												</div>
												<div class="col-lg-12">
														<select id="subcat" name="subcategory_id">
															<option value="">{{ __('Select Sub Category') }}</option>
															@if($data->subcategory_id == null)
															@foreach($data->category->subs as $sub)
															<option data-href="{{ route('vendor-childcat-load',$sub->id) }}" value="{{$sub->id}}" >{{$sub->name}}</option>
															@endforeach
															@else
															@foreach($data->category->subs as $sub)
															<option data-href="{{ route('vendor-childcat-load',$sub->id) }}" value="{{$sub->id}}" {{$sub->id == $data->subcategory_id ? "selected":""}} >{{$sub->name}}</option>
															@endforeach
															@endif
														</select>
												</div>
											</div>

											<div class="row">
												<div class="col-lg-12">
													<div class="left-area">
														<h4 class="heading">{{ __('Child Category') }}*</h4>
													</div>
												</div>
												<div class="col-lg-12">
													<select id="childcat" name="childcategory_id" {{$data->subcategory_id == null ? "disabled":""}}>
															<option value="">{{ __('Select Child Category') }}</option>
															@if($data->subcategory_id != null)
															@if($data->childcategory_id == null)
															@foreach($data->subcategory->childs as $child)
															<option value="{{$child->id}}" >{{$child->name}}</option>
															@endforeach
															@else
															@foreach($data->subcategory->childs as $child)
															<option value="{{$child->id}} " {{$child->id == $data->childcategory_id ? "selected":""}}>{{$child->name}}</option>
															@endforeach
															@endif
															@endif
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
														<textarea class="nic-edit-p" name="description">{{$data->description}}</textarea>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="left-area">
														<h4 class="heading">
															{{ __('Service Short Description') }}*
														</h4>
													</div>
												</div>
												<div class="col-lg-12">
													<div class="text-editor">
														<textarea class="nic-edit-p" name="short_description">{{$data->short_description}}</textarea>
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
														<textarea class="nic-edit-p" name="policy">{{$data->policy}}</textarea>
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
													<h4 class="heading">{{ __('Meta Tags') }} *</h4>
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
													  {{ __('Meta Description') }} *
												  </h4>
												</div>
											  </div>
											  <div class="col-lg-12">
												<div class="text-editor">
												  <textarea name="meta_description" class="input-field" placeholder="{{ __('Meta Description') }}"></textarea>
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
															<div class="span4 cropme text-center" id="landscape"
																style="width: 100%; height: 285px; border: 1px dashed #ddd; background: #f1f1f1;">
																<a href="javascript:;" id="crop-image" class=" mybtn1" style="">
																	<i class="icofont-upload-alt"></i> {{ __('Upload Image Here') }}
																</a>
															</div>
														</div>
												</div>
											</div>
											<input type="hidden" id="feature_photo" name="photo" value="">
											<input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*"
												multiple>
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

											<div class="row">
												<div class="col-lg-12">
													<div class="left-area">
														<h4 class="heading">
															{{ __('Service Price') }}*
														</h4>
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
															<h4 class="heading">{{ __('Service Discount Price') }}*</h4>
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
														<h4 class="heading">{{ __('Youtube Video URL') }}*</h4>
														<p class="sub-heading">{{ __('(Optional)') }}</p>
													</div>
												</div>
												<div class="col-lg-12">
													<input  name="youtube" type="text" class="input-field" placeholder="{{ __('Enter Youtube Video URL') }}">
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

<script type="text/javascript">

(function($) {
		"use strict";

// Gallery Section Insert

  $(document).on('click', '.remove-img' ,function() {
    var id = $(this).find('input[type=hidden]').val();
    $('#galval'+id).remove();
    $(this).parent().parent().remove();
  });

  $(document).on('click', '#prod_gallery' ,function() {
    $('#uploadgallery').click();
     $('.selected-image .row').html('');
    $('#geniusform').find('.removegal').val(0);
  });


  $("#uploadgallery").change(function(){
     var total_file=document.getElementById("uploadgallery").files.length;
     for(var i=0;i<total_file;i++)
     {
      $('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+i+'">'+
                                            '</span>'+
                                            '<a href="'+URL.createObjectURL(event.target.files[i])+'" target="_blank">'+
                                            '<img src="'+URL.createObjectURL(event.target.files[i])+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  '</div> '
                                      );
      $('#geniusform').append('<input type="hidden" name="galval[]" id="galval'+i+'" class="removegal" value="'+i+'">')
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


$(document).on('click','#size-check',function(){
	if($(this).is(':checked')){
		$('#default_stock').addClass('d-none')
	}else{
		$('#default_stock').removeClass('d-none');
	}
})

</script>


@include('partials.admin.product.product-scripts')
@endsection
