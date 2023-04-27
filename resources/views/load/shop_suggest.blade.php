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
@foreach($prods as $prod)
	@if ($language->id == $prod->language_id)
	<div class="docname">
		<a href="{{ route('vendor.shop.service', $prod->id) }}">
			<img src="{{ $prod->shop_image ? asset('assets/images/categories/' . $prod->shop_image) : asset('assets/common_img/shop2.jpg') }}" alt="">
			<div class="search-content">
				<p>{!! mb_strlen($prod->shop_name,'UTF-8') > 66 ? str_replace($prod->shop_name,'<b>'.$prod->shop_name.'</b>',mb_substr($prod->shop_name,0,66,'UTF-8')).'...' : str_replace($prod->shop_name,'<b>'.$prod->shop_name.'</b>',$prod->shop_name)  !!} </p>
				<span style="font-size: 14px; font-weight:600; display:block;">{{ $prod->shop_address }}</span>
			</div>

		</a>
	</div>
	@endif
@endforeach
