@php
	// fetch the ad
	$horizontal_ads = DB::table('agents_advertise as ap')
		->join('agents_package as pa', 'ap.package_id', '=', 'pa.package_id')
		->select('ap.id', 'ap.ad_link', 'ap.ad_banner', 'ap.ad_content', 'pa.image', 'pa.content')
		->where(['ap.status' => 1, 'pa.type' => 'HORIZONTAL'])
		->get();
@endphp

@if (count($horizontal_ads))

	<br>

	<div class="row text-center">
		@foreach ($horizontal_ads as $ad)
			<div class="col-md-offset-2 col-md-8">
				<a href="{{ url('/adclicks/' . $ad->id) }}" target="_blank">
					<img class="img-responsive" src="{{ asset('storage/' . $ad->ad_banner) }}">
				</a>
			</div>
		@endforeach
	</div>

	<br>

@endif
