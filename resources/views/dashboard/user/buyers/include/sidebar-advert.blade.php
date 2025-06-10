@php
    $square_ads = DB::table('agents_advertise as ap')
        ->join('agents_package as pa', 'ap.package_id', '=', 'pa.package_id')
        ->select('ap.id', 'ap.ad_link', 'ap.ad_banner', 'ap.ad_content', 'pa.image', 'pa.content')
        ->where(['ap.status' => 1, 'pa.type' => 'SQUARE'])
        ->get();
@endphp

@if (count($square_ads))
    <!-- Start of side advert -->
    <div class="col-md-3">
        @if ($square_ads && count($square_ads))
            <h2><b>Advertisements</b></h2>
            @foreach ($square_ads as $ad)
                @if ($ad->image == 1)
                    <div class="col-md-12 padding-0 margin-bottom-5 img-advert squareAds">
                        <a href="{{ url('/adclicks/' . $ad->id) }}" target="_blank">
                            <img src="{{ asset('storage/' . $ad->ad_banner) }}" class="img-responsive ">
                        </a>
                    </div>
                @elseif ($ad->content == 1)
                    <div class="col-md-12 padding-0 margin-bottom-5 squareAds">
                        <a href="{{ url('/adclicks/' . $ad->id) }}" target="_blank">
                            <div class="text-advert">
                                {!! $ad->ad_content !!}
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        @endif
    </div> <!-- End of side advert -->
@endif
