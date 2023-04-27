<div class="products-header">
   <div class="products-header-right justify-content-first">
         <div class="mb-3 mx-2">
            <select name="country_id[]" class="form-control select2 country" id="country_id" onchange="countryChange(this)">
               <option value="" disabled selected>Select Country</option>
               @foreach ($countries as $country)
                  <option data-href="{{ route('front-city-load',$country->id) }}" value="{{ $country->id }}">{{ $country->country_name }}</option>
               @endforeach
            </select>
         </div>
         
         <div class="mb-3 city-div" style="display:none">
            <select name="city_id[]" id="citylist" class="select2" multiple>
               <option value="all">All City</option>

            </select>
         </div>
   </div>
</div>
<div class="products-header d-flex justify-content-between align-items-center py-10 px-20 bg-light md-mt-30">
    <div class="products-header-left d-flex align-items-center">
       <h6 class="woocommerce-products-header__title page-title"> <strong> {{ __('Products')  }}</strong>  </h6>
       <div class="woocommerce-result-count"></div> 
    </div>
    <div class="products-header-right">
       <div class="products-view px-4">
         <a href="{{route('front.category')}}"><button class="btn btn-sm btn-primary">Product</button></a>
         <a href="{{route('front.service_category')}}"><button class="btn btn-sm">Service</button></a>
       </div>
       <form class="woocommerce-ordering" method="get">
          <select name="sort" class="orderby short-item" aria-label="Shop order" id="sortby">
             <option value="date_desc">{{ __('Latest Product') }}</option>
             <option value="date_asc">{{ __('Oldest Product') }}</option>
             <option value="price_asc">{{ __('Lowest Price') }}</option>
             <option value="price_desc">{{ __('Highest Price') }}</option>
          </select>
          @if($gs->product_page != null)
          <select id="pageby" name="pageby" class="short-itemby-no">
             @foreach (explode(',',$gs->product_page) as $element)
             <option value="{{ $element }}">{{ $element }}</option>
             @endforeach
          </select>
          @else
          <input type="hidden" id="pageby" name="paged" value="{{ $gs->page_count }}">
          <input type="hidden" name="shop-page-layout" value="left-sidebar">
          @endif
       </form>
       
       <div class="products-view">
          {{-- <a  class="grid-view check_view" data-shopview="grid-view" href="javascript:;"><i class="flaticon-menu-1 flat-mini"></i></a> --}}
          <a class="list-view check_view" data-shopview="list-view" href="javascript:;"><i class="flaticon-list flat-mini"></i></a>
       </div>
    </div>
 </div>
