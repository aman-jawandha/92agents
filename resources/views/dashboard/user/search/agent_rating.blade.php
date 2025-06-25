@extends('dashboard.master')

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/pages/page_job_inner.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/pages/shortcode_timeline2.css') }}">
@stop

@section('title', 'Agents Search')

@section('content')
    <?php $topmenu = 'Agents'; ?>

    @include('dashboard.include.sidebar')

    <div class="block-description">
        <div class="container">
            <div class="row md-margin-bottom-10">
                <div class="col-md-12">
                    <div class="padding-left-10">
                        @if (isset($agent->photo) && $agent->photo)
                            <img class="img-circle header-circle-img1 img-margin" width="80" height="80"
                                src="{{ URL::asset('assets/img/profile/' . $agent->photo) }}" alt="">
                        @else
                            <img class="img-circle header-circle-img1 img-margin" width="80" height="80"
                                src="{{ URL::asset('assets/img/testimonials/user.jpg') }}" alt="">
                        @endif

                        <div class="padding-top-5">
                            <div style="display:flex;justify-content:space-between">
                                <h2 class="postdetailsh2">
                                {{ ucwords(strtolower($agent->name)) }}
                               </h2>
                                @if (session('success'))
                                <p id="succes_alert" style="background-color: green;color:white;padding:8px 10px 0px 10px">{{session('success')}}&nbsp;&nbsp;&nbsp;<span style="cursor: pointer" onclick="$('#succes_alert').hide()"><b>X</b></span></p>
                                @endif
                            </div>
                            <span class="margin-right-20">
                                <strong>Experience :</strong>
                                {!! $agent->years_of_expreience != '' ? @str_replace('-', ' to ', $agent->years_of_expreience) . ' Year' : '' !!}
                            </span>

                            <span class="margin-right-20">
                                <strong>Broker :</strong> {{ $agent->brokers_name }}
                            </span>

                            <span class="margin-right-20">
                                <strong>Posted</strong>
                                <script type="text/javascript">
                                    document.write(timeDifference(new Date(), new Date(Date.fromISO('{{ $agent->created_at }}'))));
                                </script>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rating_card">
                <div class="row md-margin-bottom-10">
                <div class="col-md-8">
                <form action="{{ route('store-agent-rating') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="agent_id" value="{{ $agent->details_id }}">
                        <input type="hidden" name="rating" value="{{$rating->rating ?? 0}}" class="rating-value">
                        <div style="display:flex;align-items:center;">
                        <div class="star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                    <?php
                                        if($rating && $rating->rating >= $i){  
                                            $color = 'gold';
                                        }else{
                                            $color = '#ccc';
                                        }
                                    ?>
                                <span class="star" style="color:{{$color}};cursor: pointer;font-size:35px"
                                    data-value="{{ $i }}">&#9733;</span>
                            @endfor
                        </div>
                        <div>&nbsp;&nbsp;&nbsp;
                            <strong>Total Ratings:</strong> {{ $ratingStats->total }}
                            <strong> | Average Rating:</strong> {{ number_format($ratingStats->average, 1) }} / 5
                        </div>
                    </div>
                    @if($agent->details_id != auth()->id())
                            <label>Add Review</label>
                        <textarea name="review" class="form-control" rows="7" maxlength="1000" placeholder="Write Something">{{$rating->review ?? ''}}</textarea>
                        <button type="submit" class="btn-u margin-top-10">Save</button>
                        @if($rating)
                        <a href="{{ route('delete-agent-rating', $agent->details_id) }}" class="btn-u" onclick="return confirm('Are you sure you want to delete rating for this agent?')">
                            Delete Rating
                        </a>
                        @endif
                        @endif
                </div>
            </div>
            <div class="row">
                <h1 style="margin:20px 0px 10px 5px">Ratings & Reviews</h1>
                @if($ratings->count() > 0)
                @foreach ($ratings as $rating)
                    <div class="col-md-3" style="padding:5px">
                    <div class="rating_block" style="background-color: white;padding:10px;border:1px solid green; border-radius:10px">
                        <?php 
                            $user = App\Models\User::where('id',$rating->rating_by)->first();
                            $details = $user->details;
                            if($rating->rating_by_role == 2){
                                $role = 'Buyer';
                            }elseif($rating->rating_by_role == 3){
                                $role = 'Seller';
                            }else{
                                $role = 'Unknown User';
                            }
                        ?>
                        <div style="display:flex">
                            @if (isset($details->photo) && $details->photo)
                            <img class="img-circle" width="40px" height="40px"
                                src="{{ URL::asset('assets/img/profile/' . $details->photo) }}" alt="">
                                @else
                            <img class="img-circle" width="40px" height="40px"
                                src="{{ URL::asset('assets/img/testimonials/user.jpg') }}" alt="">
                                @endif
                                <div>
                                    <p style="margin: 5px 5px 0px 5px"><b>{{$details->name}} ({{$role}})</b></p>
                                    <p style="margin-left: 5px">
                                        @for ($i = 1; $i <= 5; $i++)
                                        <?php
                                        if($rating->rating >= $i){  
                                            $color = 'gold';
                                        }else{
                                            $color = '#ccc';
                                        }
                                        ?>
                                        <span style="color:{{$color}};cursor: pointer;font-size:20px"
                                            data-value="{{ $i }}">&#9733;</span>
                                        @endfor
                                    </p>
                                </div>
                        </div>
                        <div style="height:175px;overflow-y:auto;padding-right:5px;">
                            {!! nl2br(e($rating->review)) !!}
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p style="margin-left: 8px">No rating found for the agent!</p>
                @endif
            </div>
            <div style="text-align: center;margin-top:20px">
                {{ $ratings->links() }}
            </div>
        </div>
    </div>

 
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).on('click', '.rating_card .star', function() {
            const val = $(this).data('value');
            $('.rating-value').val(val);

            $(this).parent().children('.star').each(function() {
                const starVal = $(this).data('value');
                $(this).css('color', starVal <= val ? 'gold' : '#ccc');
            });
        });
    </script>
@stop
