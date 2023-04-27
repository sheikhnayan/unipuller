@if(Auth::guard('admin')->check())

<option data-href="" value="all">All City</option>
@foreach($cities as $city)
<option  value="{{ $city->id }}">{{ $city->state }}</option>
@endforeach

@else

<option data-href="" value="all">All City</option>
@foreach($cities as $city)
<option  value="{{ $city->id }}">{{ $city->state }}</option>
@endforeach
@endif
