@php
	if (Session::has('language'))
	{
		$language = DB::table('languages')->find(Session::get('language'));
	}
	else
	{
		$language = DB::table('languages')->where('is_default','=',1)->first();
	}
@endphp
<ul class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item mx-1" role="presentation">
		<button class="nav-link active" id="product-tab" data-bs-toggle="tab" data-bs-target="#product" type="button" role="tab" aria-controls="product" aria-selected="true">Product</button>
	</li>
	<li class="nav-item" role="presentation">
		<button class="nav-link" id="service-tab" data-bs-toggle="tab" data-bs-target="#service" type="button" role="tab" aria-controls="service" aria-selected="false">Service</button>
	</li>
</ul>
<div class="tab-content" id="myTabContent">
	<div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="product-tab">
		@foreach($prods as $prod)
		@if ($language->id == $prod->language_id)
		<div class="docname">
			<a href="{{ route('front.product', $prod->slug) }}">
				<img src="{{ asset('assets/images/thumbnails/'.$prod->thumbnail) }}" alt="">
				<div class="search-content">
					<p>{!! mb_strlen($prod->name,'UTF-8') > 66 ? str_replace($slug,'<b>'.$slug.'</b>',mb_substr($prod->name,0,66,'UTF-8')).'...' : str_replace($slug,'<b>'.$slug.'</b>',$prod->name) !!} </p>
					<span style="font-size: 14px; font-weight:600; display:block;">{{ $prod->showPrice() }}</span>
				</div>
			</a>
		</div>
		@endif
		@endforeach
	</div>
	<div class="tab-pane fade" id="service" role="tabpanel" aria-labelledby="service-tab">
		@foreach($sers as $prod)
		@if ($language->id == $prod->language_id)
		<div class="docname">
			<a href="{{ route('service.details', $prod->id) }}">
				<img src="{{ asset('assets/images/thumbnails/'.$prod->thumbnail) }}" alt="">
				<div class="search-content">
					<p>{!! mb_strlen($prod->name,'UTF-8') > 66 ? str_replace($slug,'<b>'.$slug.'</b>',mb_substr($prod->name,0,66,'UTF-8')).'...' : str_replace($slug,'<b>'.$slug.'</b>',$prod->name) !!} </p>
					<span style="font-size: 14px; font-weight:600; display:block;">{{ $prod->showPrice() }}</span>
				</div>

			</a>
		</div>
		@endif
		@endforeach
	</div>
</div>