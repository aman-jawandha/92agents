@extends('dashboard.master')

@section('title', $post->posttitle)

@section('content')
    <?php $topmenu = 'Home'; ?>
    @include('dashboard.include.sidebar')

    <div class="block-description margin-top-20">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row md-margin-bottom-10">
                        <div class="col-md-12 ">
                            <div class="">
                                <h2 class="postdetailsh2 ">{{ $post->posttitle }}</h2>

                                <div>
                                    <span class="margin-right-20">
                                        <strong>Post ID:</strong> {{ $post->id }}
                                    </span>

                                    <span class="margin-right-20">
                                        <strong>Posted by:</strong> {{ ucfirst($post->name) }}
                                    </span>

                                    <span class="margin-right-20">
                                        <strong>Posted On: <i class="fa fa-clock-o"></i></strong>
                                        {{ date('F j, Y', strtotime($post->created_at)) }}
                                    </span>

                                    <span class="margin-right-20">
                                        <strong>Closing Date:</strong>
                                        {{ $post->closing_date != null ? date('d-m-Y', strtotime($post->closing_date)) : 'Not updated yet' }}
                                    </span>

                                    <br>

                                    <span>
                                        <strong>Address: <i class="fa fa-map-marker"></i></strong>
                                        {{ $post->address1 != null ? $post->address1 . ',' : '' }}
                                        {{ $post->address2 != null ? $post->address2 . ',' : '' }}
                                        {{ $post->city_name != null ? $post->city_name . ',' : '' }}
                                        {{ $post->state_name != null ? $post->state_name . ',' : '' }}
                                        {{ $post->area != null ? $post->area . ',' : '' }}
                                        {{ $post->zip != null ? $post->zip : '' }}
                                    </span>

                                    <br>

                                    @if ($post->when_do_you_want_to_sell)
                                        <span class="margin-right-20 skill-lable label label-success">
                                            {{ $types }}
                                            {{ str_replace('_', ' ', $post->when_do_you_want_to_sell) }}
                                        </span>
                                    @endif

                                    @if ($post->home_type)
                                        <span class="margin-right-20 skill-lable label label-success">
                                            {{ ucfirst(str_replace('_', ' ', $post->home_type)) }}
                                        </span>
                                    @endif
                                </div>

                                @if ($post->agent_send_review == 1 && !empty($selected_agent) && $selected_agent != '' && $post->applied_post == 1)
                                    <div>
                                        <h2>{{ $selected_agent->name }} gave you a rating</h2>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if (!empty($selected_agent) && $selected_agent != '' && $post->applied_post == 1)
                        <div class="card-wrap box-shadow-profile margin-bottom-40">
                            <div class="panel-profile">
                                <div class="panel-heading overflow-h air-card">
                                    <h2 class="panel-title heading-sm pull-left">
                                        <i class="fa fa-commenting"></i>
                                        Selected Agent
                                    </h2>
                                </div>
                                <div class="panel-body" data-mcs-theme="minimal-dark">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="padding-left-10 ">
                                                @php
                                                    $selected_agent_img = $selected_agent->photo
                                                        ? asset("public/2_FrontEnd/img/profile/{$selected_agent->photo}")
                                                        : asset('assets/img/team/img32-md.jpg');
                                                @endphp

                                                <img class="img-circle header-circle-img1 img-margin"
                                                    src="{{ $selected_agent_img }}" width="80" height="80"
                                                    alt="">

                                                <div class="padding-top-5">
                                                    <h2 class="postdetailsh2"><a target="_blank"
                                                            href="{{ URL('/') }}/search/agents/details/{{ $selected_agent->id }}/{{ $selected_agent->post_id }}">{{ ucwords(strtolower($selected_agent->name)) }}</a>
                                                        <sub class="{{ $selected_agent->login_status }}">
                                                            {{ $selected_agent->login_status }} </sub>
                                                    </h2>

                                                    <span class="margin-right-20"> <strong> Experience : </strong>
                                                        {!! $selected_agent->years_of_expreience != ''
                                                            ? @str_replace('-', ' to ', $selected_agent->years_of_expreience) . ' Year'
                                                            : '' !!} </span>

                                                    <span class="margin-right-20"> <strong> Broker : </strong>
                                                        {{ $selected_agent->brokers_name }} </span>

                                                    <span class="margin-right-20"> <strong> Selected date </strong>
                                                        <script type="text/javascript">
                                                            document.write(timeDifference(new Date(), new Date(Date.fromISO('{{ $selected_agent->agent_select_date }}'))));
                                                        </script>
                                                    </span>

                                                    <span> <strong><i class="fa fa-map-marker"></i></strong>
                                                        {{ $post->city_name }},{{ $selected_agent->state_name }}
                                                    </span>
                                                </div>

                                            </div>
                                            
                                            @if ($selected_agent->description)
                                            <div class="padding-left-10 ">
                                                <h2><strong>Agent Details</strong></h2>
                                                <div class="postdetailsdescription">
                                                    {!! $selected_agent->description !!}
                                                </div>
                                            </div>
                                        @endif
                                        </div>

                                        <div class="col-md-3">
                                            <a class="btn-u cursor"
                                                href="{{ URL('/messages/') }}/{{ $selected_agent->post_id }}/{{ $selected_agent->id }}/{{ $selected_agent->agents_users_role_id }}">
                                                Message
                                            </a>

                                            @php
                                                $min_close_minutes = env('ADD_CLOSE_DATE_HOUR') * 60; // Calculate total minutes from hours
                                                $diff_in_minutes = 0;
                                                if ($post->agent_select_date != '') {
                                                    $to = \Carbon\Carbon::createFromFormat(
                                                        'Y-m-d H:s:i',
                                                        $post->agent_select_date,
                                                        'UTC',
                                                    );
                                                    $from = \Carbon\Carbon::now('UTC');
                                                    $diff_in_minutes = $to->diffInMinutes($from);
                                                }
            
                                                $remaining_minutes = $min_close_minutes - $diff_in_minutes;
            
                                                function format_minutes($minutes)
                                                {
                                                    if ($minutes >= 1440) {
                                                        // 1440 minutes = 24 hours
                                                        $days = floor($minutes / 1440);
                                                        return $days . ' day' . ($days > 1 ? 's' : '');
                                                    } elseif ($minutes >= 60) {
                                                        $hours = floor($minutes / 60);
                                                        return $hours . ' hour' . ($hours > 1 ? 's' : '');
                                                    } else {
                                                        return $minutes . ' minute' . ($minutes > 1 || $minutes == 0 ? 's' : '');
                                                    }
                                                }
                                            @endphp
            
                                            @if ($post->closing_date == '' && $post->agents_user_id == $user->id && $post->applied_user_id != '')
                                                @if ($diff_in_minutes >= $min_close_minutes)
                                                    <button class="btn-u margin-top-10 cursor" data-target="#set-agent-closingdate"
                                                        data-toggle="modal">
                                                        Add Closing Date
                                                    </button>
                                                @else
                                                    <button class="btn-u margin-top-10 cursor" disabled="true" style="background: #aaa;">
                                                        Add Closing Date
                                                    </button>
                                                    <small>
                                                        You can only add closing date after <strong>{{ format_minutes($min_close_minutes) }} of selecting an agent.</strong>
                                                        <br>
                                                        Button will be enabled in <strong>{{ format_minutes($remaining_minutes) }}</strong>
                                                    </small>
                                                @endif
                                            @endif

                                            @if ($post->closing_date != '' && $post->final_status != 2)
                                                <button class="btn-u margin-top-10 cursor" data-target="#set-agent-review"
                                                    data-toggle="modal">
                                                    Close This Post
                                                </button>
                                            @elseif ($post->final_status == 2)
                                                <button class="btn-u margin-top-10 cursor">
                                                    Post Is Closed
                                                </button>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($selected_agent->buyer_seller_send_review == 2)
                            <div class="modal fade " id="set-agent-review" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog " style="display: grid;">
                                    <div class="modal-content not-top sky-form">
                                        <div id="set-agent-review-loader"
                                            class="body-overlay col-md-12 center loder set-agent-review-loader">
                                            <img src="{{ url('assets/img/loder/loading.gif') }}" class="loader">
                                        </div>

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×</button>

                                            <h4 class="modal-title set-agent-review-title">Give a feedback to
                                                {{ ucwords(strtolower($selected_agent->name)) }} </h4>
                                        </div>

                                        <form class="sky-form" id="give_a_review_for_agents">
                                            <div class="modal-body">
                                                <fieldset style="padding: 0px 15px;">

                                                    <p class="review-msg-text hide"></p>

                                                    <section class="margin-0">
                                                        <label class="label margin-0"> Rating </label>
                                                        <label class="margin-0">

                                                            <div id="ratinganswer" class="rating1">

                                                                <input class="stars star5" type="radio" name="rating"
                                                                    id="star5" value="5" />

                                                                <label class="full tooltips" data-toggle="tooltip"
                                                                    data-original-title="Awesome" data-placement="top"
                                                                    for="star5" title="Awesome"></label>



                                                                <input class="stars star4_5" type="radio" name="rating"
                                                                    id="star4_5" value="4_5" />

                                                                <label class="half tooltips" data-toggle="tooltip"
                                                                    data-original-title="Pretty good" data-placement="top"
                                                                    for="star4_5" title="Pretty good"></label>



                                                                <input class="stars star4" type="radio" name="rating"
                                                                    id="star4" value="4" />

                                                                <label class="full tooltips" data-toggle="tooltip"
                                                                    data-original-title="Pretty good" data-placement="top"
                                                                    for="star4" title="Pretty good"></label>



                                                                <input class="stars star3_5" type="radio"
                                                                    name="rating" id="star3_5" value="3_5" />

                                                                <label class="half tooltips" data-toggle="tooltip"
                                                                    data-original-title="Meh" data-placement="top"
                                                                    for="star3_5" title="Meh"></label>



                                                                <input class="stars star3" type="radio" name="rating"
                                                                    id="star3" value="3" />

                                                                <label class="full tooltips" data-toggle="tooltip"
                                                                    data-original-title="Meh" data-placement="top"
                                                                    for="star3" title="Meh"></label>



                                                                <input class="stars star2_5" type="radio"
                                                                    name="rating" id="star2_5" value="2_5" />

                                                                <label class="half tooltips" data-toggle="tooltip"
                                                                    data-original-title="Kinda bad" data-placement="top"
                                                                    for="star2_5" title="Kinda bad "></label>



                                                                <input class="stars star2" type="radio" name="rating"
                                                                    id="star2" value="2" />

                                                                <label class="full tooltips" data-toggle="tooltip"
                                                                    data-original-title="Kinda bad" data-placement="top"
                                                                    for="star2" title="Kinda bad"></label>



                                                                <input class="stars star1_5" type="radio"
                                                                    name="rating" id="star1_5" value="1_5" />

                                                                <label class="half tooltips" data-toggle="tooltip"
                                                                    data-original-title="Meh" data-placement="top"
                                                                    for="star1_5" title="Meh"></label>



                                                                <input class="stars star1" type="radio" name="rating"
                                                                    id="star1" value="1" />

                                                                <label class="full tooltips" data-toggle="tooltip"
                                                                    data-original-title="Sucks big time"
                                                                    data-placement="top" for="star1"
                                                                    title="Sucks big time"></label>



                                                                <input class="stars star0_5" type="radio"
                                                                    name="rating" id="star0_5" value="0_5" />

                                                                <label class="half tooltips" data-toggle="tooltip"
                                                                    data-original-title="Sucks big time"
                                                                    data-placement="top" for="star0_5"
                                                                    title="Sucks big time"></label>

                                                            </div>

                                                            <b class="error-text" id="rating_error"></b>

                                                        </label>

                                                    </section>



                                                    <section class="margin-0">

                                                        <label class="label margin-0"> Review </label>

                                                        <label class="textarea margin-0">

                                                            <textarea rows="2" class="field-border jqte-test" name="review" id="review" placeholder="Enter Review"></textarea>

                                                            <b class="error-text" id="review_error"></b>

                                                        </label>

                                                    </section>

                                                </fieldset>

                                            </div>

                                            <div class="modal-footer">

                                                <input type="hidden" name="post_id"
                                                    value="{{ $selected_agent->post_id }}">

                                                <input type="hidden" name="notification_type" value="14">

                                                <input type="hidden" name="notification_message"
                                                    value="{{ $user->details->name }} has given you a review for post ({{ $selected_agent->posttitle }})">

                                                <input type="hidden" name="rating_type" value="3">

                                                <input type="hidden" name="rating_item_id"
                                                    value="{{ $selected_agent->applied_user_id }}">

                                                <input type="hidden" name="rating_item_parent_id"
                                                    value="{{ $selected_agent->post_id }}">

                                                <input type="hidden" name="receiver_id"
                                                    value="{{ $selected_agent->id }}">

                                                <input type="hidden" name="receiver_role"
                                                    value="{{ $selected_agent->agents_users_role_id }}">

                                                <input type="hidden" name="sender_id" value="{{ $user->id }}">

                                                <input type="hidden" name="sender_role"
                                                    value="{{ $user->agents_users_role_id }}">



                                                <button type="button" data-dismiss="modal" aria-hidden="true"
                                                    class="btn-u"
                                                    style="padding: 10px 20px;margin-right: 5px;color: #74c52c;box-shadow: 0 0.5px 4px rgba(57,73,76,.35);background: white;">Close</button>

                                                <button type="submit" class="btn-u">Give</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="modal fade " id="make_payment" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog " style="display: grid;">
                                <div class="modal-content not-top sky-form">
                                    <div id="set-agent-review-loader"
                                        class="body-overlay col-md-12 center loder set-agent-review-loader">
                                        <img src="{{ url('assets/img/loder/loading.gif') }}" class="loader">
                                    </div>

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>

                                        <h4 class="modal-title set-agent-review-title">Make Payment To
                                            {{ $selected_agent->name }} </h4>
                                    </div>

                                    <form class="sky-form" id="make_payment_for_agents">

                                        <div class="modal-body">
                                            <div id="paymentResponse"></div>

                                            <fieldset style="padding: 0px 15px;">
                                                <p class="review-msg-text hide"></p>
                                                <section class="margin-0">
                                                    <label class="label margin-0"> Agent 3% Charges </label>
                                                    <label class="textarea margin-0">
                                                        <input type="text" id="amount" name="amount"
                                                            class="form-control" />
                                                        <b class="error-text" id="amount_error"></b>
                                                    </label>
                                                </section>
                                            </fieldset>
                                        </div>

                                        <div class="modal-footer">
                                            <input type="hidden" name="post_id" value="{{ $selected_agent->post_id }}">

                                            <input type="hidden" name="notification_type" value="14">

                                            <input type="hidden" name="notification_message"
                                                value="{{ $user->details->name }} has given you a review for post ({{ $selected_agent->posttitle }})">

                                            <input type="hidden" name="rating_type" value="3">

                                            <input type="hidden" name="rating_item_id"
                                                value="{{ $selected_agent->applied_user_id }}">

                                            <input type="hidden" name="rating_item_parent_id"
                                                value="{{ $selected_agent->post_id }}">

                                            <input type="hidden" name="receiver_id" value="{{ $selected_agent->id }}">

                                            <input type="hidden" name="receiver_role"
                                                value="{{ $selected_agent->agents_users_role_id }}">

                                            <input type="hidden" name="sender_id" value="{{ $user->id }}">

                                            <input type="hidden" name="sender_role"
                                                value="{{ $user->agents_users_role_id }}">



                                            <button type="button" class="btn btn-link" data-dismiss="modal"
                                                aria-hidden="true">Close</button>

                                            <button type="submit" class="btn-u">Make Payment</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                    @if($post->agents_user_id == auth()->user()->id)
                        <div class="card-wrap box-shadow-profile margin-bottom-40">
                            <div class="panel-profile">
                                <div class="panel-heading overflow-h air-card">
                                    <h2 class="panel-title heading-sm pull-left">
                                        <i class="fa fa-commenting"></i>
                                        Compare Agents
                                    </h2>
                                </div>
                                <div class="panel-body" data-mcs-theme="minimal-dark">
                                    <div class="profile-edit">
                                        <div class="compare-thumb-main col-md-12" id="addecomparediv">
                                        </div>

                                        <div class="col-md-12 margin-top-5"><a onclick="comparenow();"
                                                class="cursor btn-u pull-right">Compare</a></div>

                                        <div id="compare-loader"
                                            class="body-overlay col-md-12 center loder compare-loader">
                                            <img src="{{ url('assets/img/loder/loading.gif') }}" class="loader">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif
                    @if($post->agents_user_id == auth()->user()->id)
                    <div class="box-shadow-profile homedata homedatanotes margin-bottom-40">
                        <div class="panel-profile">
                            <div class="panel-heading overflow-h air-card">
                                <h2 class="panel-title heading-sm pull-left">
                                    <i class="fa fa-commenting"></i>
                                    Applied Agents
                                </h2>
                            </div>
                            <div class="panel-body" data-mcs-theme="minimal-dark">
                                <div class="connectedagents-data" id="connectedagents-data">
                                </div>

                                <div class="center margin-bottom-5 loading_gif">
                                    <img src="{{ url('assets/img/loder/loading.gif') }}" class="loader">
                                </div>

                                <div id="list_resp_message" class="alert alert-danger list_resp_message" role="alert">
                                    This is an alert!
                                </div>

                                <div class="text-center">
                                    <button type="button" id="load_new_posts" data-page="0"
                                        class="btn-u btn-u-default btn-u-sm ">
                                        Load More
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="card-wrap box-shadow-profile margin-bottom-40">
                        <div class="panel-profile">
                            <div class="panel-heading overflow-h air-card">
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-commenting"></i>
                                    {{ $user->agents_users_role_id == 2 ? 'Specific Requirements' : 'Post Details' }}
                                </h2>
                            </div>
                            <div class="panel-body" data-mcs-theme="minimal-dark">
                                {!! $post->details !!}
                            </div>
                        </div>
                    </div>

                    <div class="card-wrap box-shadow-profile margin-bottom-40">
                        <div class="panel-profile">
                            <div class="panel-heading overflow-h air-card">
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-commenting"></i>
                                    Post Overview
                                </h2>
                            </div>
                            <div class="panel-body" data-mcs-theme="minimal-dark">
                                <ul class="list-unstyled">
                                    @if ($post->when_do_you_want_to_sell)
                                        <li><i class="fa fa-check color-green"></i> <strong> Want to
                                                {{ $types }} </strong>
                                            {{ str_replace('_', ' ', $post->when_do_you_want_to_sell) }}.</li>
                                    @endif
                                    @if ($post->need_Cash_back == 1)
                                        <li><i class="fa fa-check color-green"></i> <strong> Need Cash back and
                                                Negotiate Commision </strong></li>
                                    @endif
                                    @if ($post->interested_short_sale == 1)
                                        <li><i class="fa fa-check color-green"></i> <strong> Interested in a Short
                                                Sale
                                            </strong></li>
                                        @if ($post->got_lender_approval_for_short_sale == 1)
                                            <li><i class="fa fa-check color-green"></i> <strong> Got Lender approval
                                                    for
                                                    short sale </strong></li>
                                        @endif
                                    @endif

                                    @if ($post->price_range)
                                        <li><i class="fa fa-check color-green title"></i> <strong>Price
                                                Range</strong>
                                            {{ str_replace('-', 'k to', $post->price_range) . 'k' }}.</li>
                                    @endif

                                    @if ($post->home_type)
                                        <li><i class="fa fa-check color-green title"></i> <strong>
                                                {{ $user->agents_users_role_id == 2 ? 'Property Type' : 'Home type' }}</strong>
                                            {{ str_replace('_', ' ', $post->home_type) }}.</li>
                                    @endif

                                    @if ($post->firsttime_home_buyer == 1)
                                        <li><i class="fa fa-check color-green"></i> <strong> first time home buyer
                                            </strong></li>
                                    @endif

                                    @if ($post->do_u_have_a_home_to_sell == 1)
                                        <li><i class="fa fa-check color-green"></i> have a home to sell
                                            @if ($post->if_so_do_you_need_help_selling == 1)
                                                <strong> yes </strong>
                                            @else
                                                <strong> No </strong>
                                            @endif
                                        </li>
                                    @endif

                                    @if ($post->interested_in_buying == 1)
                                        <li><i class="fa fa-check color-green"></i> <strong> yes </strong>
                                            interested in
                                            buying a foreclosure, short sale or junker </li>
                                    @endif

                                    @if ($post->bids_emailed != null)
                                        <li><i class="fa fa-check color-green"></i> <strong>
                                                {{ str_replace('_', ' ', $post->bids_emailed) }} </strong> </li>
                                    @endif

                                    @if ($post->do_you_need_financing != null)
                                        <li><i class="fa fa-check color-green"></i> need financing amount <strong>
                                                {{ str_replace('_', ' ', $post->do_you_need_financing) . '$' }}
                                            </strong>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>

                    @php
                        $best_features = json_decode($post->best_features);
                    @endphp
                    @if ($best_features)
                        <div class="card-wrap box-shadow-profile margin-bottom-40">
                            <div class="panel-profile">
                                <div class="panel-heading overflow-h air-card">
                                    <h2 class="panel-title heading-sm pull-left"><i class="fa fa-commenting"></i>
                                        Best Features of Home
                                    </h2>
                                </div>
                                <div class="panel-body" data-mcs-theme="minimal-dark">
                                    {!! $post->details !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card-wrap box-shadow-profile margin-bottom-40">
                        <div class="panel-profile">
                            <div class="panel-heading overflow-h air-card">
                                <h2 class="panel-title heading-sm pull-left">
                                    <i class="fa fa-commenting"></i>
                                    Notes History
                                </h2>
                            </div>
                            <div class="panel-body" data-mcs-theme="minimal-dark">
                                <ul class="list-group">
                                    @foreach ($notes_history as $note)
                                        <li class="list-group-item"><i class="fa fa-clock-o">
                                            </i>
                                            <b>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $note->created_at)->format('d, M Y h:i A') }}</b>
                                            : {!! $note->notes !!}
                                        </li>
                                    @endforeach
                                </ul>

                                <input type="hidden" name="notes-more-load" id="notes-more-load">
                                <div class="center">
                                    <img src="{{ url('assets/img/loder/loading.gif') }}"
                                        class="loader messageloadertop notes-loader">
                                </div>

                            </div>
                        </div>
                    </div>

                    @include('dashboard.user.buyers.include.sidebar-advert')

                </div>
            </div>
        </div>

        <form class="sky-form" id="compare_agents" action=" {{ url('compare') }}" method="POST">
            @csrf
            <div class="modal fade bs-example-modal-sm" id="set-compare-peramitter" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" style="display: grid;">
                    <div class="modal-content not-top">
                        <div id="set-compare-peramitter-loader"
                            class="body-overlay col-md-12 center loder set-compare-peramitter-loader">
                            <img src="{{ url('assets/img/loder/loading.gif') }}" class="loader">
                        </div>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title set-compare-peramitter-title">Select Compare Staging Parameter</h4>
                        </div>

                        <div class="modal-body sky-form" id="compcheckbox">
                            <fieldset>
                                <section>
                                    <label class="checkbox">
                                        <input type="checkbox" name="agent_rating" value="1" id="agent_rating">
                                        <i></i>Agent Rating
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="asked_question" value="1" id="asked_question">
                                        <i></i>Asked Question
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="bookmark_agents" value="1"
                                            id="bookmark_agents">
                                        <i></i>Bookmark Agents
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="bookmark_answers" value="1"
                                            id="bookmark_answers">
                                        <i></i>Bookmark Answers
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="bookmark_messages" value="1"
                                            id="bookmark_messages">
                                        <i></i>Bookmark Messages
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="bookmark_proposal" value="1"
                                            id="bookmark_proposal">
                                        <i></i>Bookmark Proposal
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="rating_answers" value="1" id="rating_answers">
                                        <i></i>Rating Answers
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="rating_messages" value="1"
                                            id="rating_messages">
                                        <i></i>Rating Messages
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="proposals" value="1" id="proposals">
                                        <i></i>Proposals
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="documents" value="1" id="documents">
                                        <i></i>Documents
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="notes_messages" value="1" id="notes_messages">
                                        <i></i>Notes Messages
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="notes_asked_question" value="1"
                                            id="notes_asked_question">
                                        <i></i>Notes Asked Question
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="notes_answers" value="1" id="notes_answers">
                                        <i></i>Notes Answer
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="notes_proposal" value="1" id="notes_proposal">
                                        <i></i>Notes Proposal
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="notes_agents" value="1" id="notes_agents">
                                        <i></i>Notes Agents
                                    </label>
                                </section>
                            </fieldset>

                            <input type="hidden" value="" name="compare_id" class="compare_id" id="compare_id">
                            <input type="hidden" value="{{ $user->id }}" name="sender_id">
                            <input type="hidden" value="{{ $user->agents_users_role_id }}" name="sender_role">
                        </div>

                        <div class="modal-footer" id="notes-compare-peramitter-footer">
                            <button type="button" class="btn-u btn-u-primary pull-right" id="comparebutton"
                                name="submit" title="Compare Now">Compare</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade bs-example-modal-md" id="set-compare-asked_question-modal" tabindex="-1"
                role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" style="display: grid;">
                    <div class="modal-content not-top">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title set-compare-peramitter-title">Select Asked Question</h4>
                        </div>

                        <div class="modal-body sky-form">

                            <div id="set-asked_question-loader"
                                class="body-overlay col-md-12 center loder set-asked_question-loader">
                                <img src="{{ url('assets/img/loder/loading.gif') }}" class="loader">
                            </div>
                            <fieldset>
                                <section class="row">
                                    <label class="radio col-md-6">
                                        <input type="radio" id="sellectall" name="selectall" value="1">
                                        <i></i>Select all
                                    </label>
                                    <label class="radio col-md-6">
                                        <input type="radio" id="sellectallnone" name="selectall" value="1">
                                        <i></i>Select none
                                    </label>
                                </section>
                                <section id="asked_question_list">
                                </section>
                            </fieldset>
                            <footer>
                                <button type="button" class="btn-u btn-u-primary" data-dismiss="modal"
                                    aria-hidden="true">Done</button>
                            </footer>
                        </div>
                    </div>
                    <div class="modal-footer" id="notes-compare-peramitter-footer">
                    </div>
                </div>
            </div>
        </form>

        @if ($post->closing_date == '' && $selected_agent != '')
            <div class="modal fade " id="set-agent-closingdate" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog " style="display: grid;">
                    <div class="modal-content not-top sky-form">

                        <div id="set-agent-review-loader"
                            class="body-overlay col-md-12 center loder set-agent-review-loader">
                            <img src="{{ url('assets/img/loder/loading.gif') }}" class="loader">
                        </div>

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title set-agent-review-title">Add Closing Date</h4>
                        </div>

                        <form class="sky-form" id="set_closing_date">

                            <div class="modal-body">
                                <fieldset style="padding: 0px 15px;">
                                    <p class="review-msg-text hide"></p>

                                    <section class="margin-0">
                                        <label class="label margin-0"> Closing Date </label>
                                        <label class="textarea margin-0">
                                            <input type="text" class="form-control field-border datepicker"
                                                name="closing_date" value="" required onkeydown="return false"
                                                autocomplete="off" />
                                            <b class="error-text" id="closing_date_error"></b>
                                        </label>
                                    </section>
                                </fieldset>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="post_id"
                                    value="{{ isset($selected_agent->post_id) ? $selected_agent->post_id : '' }}">

                                <input type="hidden" name="agent_id"
                                    value="{{ isset($selected_agent->id) ? $selected_agent->id : '' }}">

                                <input type="hidden" name="notification_type" value="14">

                                <input type="hidden" name="notification_message"
                                    value="{{ isset($selected_agent->name) ? $selected_agent->name : '' }} has given you a review for post ({{ isset($selected_agent->posttitle) ? $selected_agent->posttitle : '' }})">

                                <input type="hidden" name="rating_type" value="3">

                                <input type="hidden" name="rating_item_id"
                                    value="{{ isset($selected_agent->applied_user_id) ? $selected_agent->applied_user_id : '' }}">

                                <input type="hidden" name="rating_item_parent_id" value="{{ $selected_agent->post_id }}">

                                <input type="hidden" name="receiver_id" value="{{ $selected_agent->id }}">

                                <input type="hidden" name="receiver_role"
                                    value="{{ $selected_agent->agents_users_role_id }}">

                                <input type="hidden" name="sender_id" value="{{ $user->id }}">

                                <input type="hidden" name="sender_role" value="{{ $user->agents_users_role_id }}">



                                <button type="button" data-dismiss="modal" aria-hidden="true" class="btn-u"
                                    style="padding: 10px 20px;margin-right: 5px;color: #74c52c;box-shadow: 0 0.5px 4px rgba(57,73,76,.35);background: white;">Close</button>

                                <button type="submit" class="btn-u">Save</button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('public/2_FrontEnd/css/pages/page_job_inner.css') }}">
    <link rel="stylesheet" href="{{ asset('public/2_FrontEnd/css/pages/profile.css') }}">
@endpush

@section('scripts')
    <script type="text/javascript" src="https://checkout.stripe.com/checkout.js"></script>

    <script type="text/javascript">
        let post_id = {{ $post->post_id }};
        let agents_user_id = {{ $post->agents_user_id }};
        let agents_users_role_id = {{ $post->agents_users_role_id }};

        /*load proposal */
        function loadagents(limit) {
            $.ajax({
                'url': `{{ url('/') }}/profile/buyer/post/details/agents/get/${limit}/${post_id}/${agents_user_id}/${agents_users_role_id}`,
                'type': 'get',
                'beforeSend': function() {
                    $(".loading_gif").show()
                    $(".list_resp_message").hide()
                },
                'processData': true,
                'success': function(result) {
                    var proppos = result;

                    if (proppos.count == 0) {
                        $(".loading_gif").hide()
                        $('#connectedagents-data').html('<p class="text-center"> No agents applied. </p>');
                    }

                    if ('{{ $compare }}' == 'compare') {
                        $('html, body').animate({
                            'scrollTop': $('#comparecount').offset().top
                        }, 1000);
                    }

                    $.each(proppos.result, function(key, value) {

                        var date = timeDifference(new Date(), new Date(Date.fromISO(value.created_at)));

                        var img_path = (value.photo) ?
                            `{{ asset('assets/img/profile/${value.photo}') }}/` :
                            `{{ asset('assets/img/team/img32-md.jpg') }}`;

                        var photo =
                            `<img class="img-circle header-circle-img1 img-margin" width="50" height="50" src="${img_path}">`;

                        var selectedclass = '';
                        var selected = '';
                        var title = '';

                        if ('{{ $post->applied_post }}' == 1 && '{{ $post->applied_user_id }}' ==
                            value.details_id) {
                            selectedclass = 'agent_selected';
                            title = 'Selected for this post';
                            selected = '(Selected for this post)';
                        }

                        var brokers_name = (value.brokers_name != null) ? value.brokers_name : '';
                        var description = (value.description != null) ?
                            `<div class="hidetext2line clear-both sm-margin-bottom-20">${value.description}</div>` :
                            '';

                        var ul = gen_ul(value);
                        var notify = gen_notify(value)

                        var htmll = `<div class="${selectedclass} funny-boxes border-gre margin-bottom-10" title="${title}">
                                        ${photo}
                                        <div class="name-location sm-margin-bottom-20">
                                            <h2 class="title sm-margin-bottom-10">
                                                <a href="/search/agents/details/${value.details_id}/{{ $post->post_id }}" target="_blank">
                                                    ${value.name} ${selected} <sub class="${value.login_status}"></sub>
                                                </a>
                                            </h2>
                                            <span><strong>Broker: </strong>${brokers_name}</span> - 
                                            <span><strong>Applied Time: </strong>${date}</span>
                                        </div>

                                        ${description}

                                        ${ul}
                        
                                        <div class="panel panel-profile hide" id="myPopover${value.connection_id}">
                                            <div class="panel-heading overflow-h border1-bottom">
                                                <h2 class="panel-title heading-sm pull-left color-black">
                                                    <i class="fa fa-users"></i> ${value.name} Notifications
                                                </h2>
                                            </div>
                                            <div id="scrollbar3" class="panel-body no-padding mCustomScrollbar" data-mcs-theme="minimal-dark">
                                                ${notify}
                                            </div>
                                        </div>

                                    </div>`;

                        $('#connectedagents-data').append(htmll);
                    });

                    if (proppos.next != 0) {
                        $('#load_new_posts').removeClass('hide').attr('title', proppos.next);
                    } else {
                        $('#load_new_posts').addClass('hide');
                    }

                    $('[rel="popover"]').popover({
                        'container': 'body',
                        'html': true,
                        'trigger': 'manual',
                        'animation': true,
                        'content': function() {
                            var clone = $($(this).data('popover-content')).clone(true).removeClass(
                                'hide');
                            return clone;
                        }
                    }).toggle(function(e) {
                        e.preventDefault();
                        $(this).popover('show');
                    }, function(e) {
                        e.preventDefault();
                        $(this).popover('hide');
                    });

                    $(document).on('click touch', function(event) {
                        if (!$(event.target).parents().addBack().is('[rel="popover"]')) {
                            $('.popover').hide();
                        }
                    });
                },
                'error': function(data) {
                    $(".loading_gif").hide()

                    var error_type = "";
                    var error_msg = "";
                    if (data.status == '500') {
                        error_type = "warning";
                        error_msg = data.statusText;
                    } else if (data.status == '422') {
                        error_type = "warning";
                        error_msg = data.responseJSON.image[0];
                    }

                    if (error_type) {
                        $(".list_resp_message")
                            .removeClass(function(index, className) {
                                return (className.match(/(^|\s)alert-\S+/g) || []).join(' ');
                            })
                            .addClass(`alert-${error_type}`)
                            .html(error_msg)
                            .removeClass('hide');
                    }
                },
                'complete': function() {
                    $(".loading_gif").hide();
                }
            });
        }

        function gen_ul(data) {

            var compare = ``;

            @if ($post->applied_post == '2')
                if (data.compare.result != null) {
                    $('#compare_id').val(data.compare.result.compare_id);

                    compare = ` - <li class="pull-right compare_list_${data.details_id}">
                                <a class="cursor red" onclick="removetocompare(${data.compare.result.compare_id},${data.details_id})">
                                    <i class="fa fa-times-circle red"></i> Remove To Compare</a>
                            </li>`;
                } else {
                    compare = ` - <li class="pull-right compare_list_${data.details_id}">
                                <a class="cursor sitegreen" onclick="addtocompare(${data.details_id})">
                                    <i class="fa fa-plus-circle sitegreen"></i> Add To Compare
                                </a>
                            </li>`;
                }
            @endif

            var ul = `
                <ul class="list-inline clear-both">
                    <li>
                        <strong><a target="_blank" href="/search/agents/details/${data.details_id}/{{ $post->post_id }}"> Agent Details
                        </a></strong>
                    </li> - 
                    <li>
                        <i class="fa fa-bell"></i>
                        <a  rel="popover" data-popover-content="#myPopover${data.connection_id}">
                            ${data.notificatio.count} Notifications
                        </a>
                    </li> - 
                    <li>
                        <i class="fa fa-comments"></i>
                        <a class="cursor" onclick="register_popup(${data.post_id},${data.details_id},${data.details_id_role_id});">
                            ${data.message_notificatio.count} Message
                        </a>
                    </li>
                    ${compare}
                </ul>`;

            return ul;
        }

        function gen_notify(data) {

            if (data.notificatio.count == 0) {
                return `<div class="cursor alert-blocks alert-dismissable">No Notification</div>`;
            }

            var html = ``;

            $.each(data.notificatio.result, function(key, agentdata) {
                var url = '';

                if (agentdata.receiver_role == 4) {
                    url = (agentdata.notification_type == 9) ?
                        `{{ url('/messages/') }}/${agentdata.post_id}/${agentdata.sender_id}/${agentdata.sender_role}` :
                        `{{ url('/search/post/details/') }}/${agentdata.post_id}/${agentdata.notification_type}`;
                } else {
                    url =
                        `{{ url('/search/agents/details/') }}/${agentdata.sender_id}/${agentdata.post_id}/${agentdata.notification_type}`;
                }

                var date = timeDifference(new Date(), new Date(Date.fromISO(agentdata.created_at)));

                html += `<div onclick="readnotification(${agentdata.notification_id},'${url}');" class="cursor alert-blocks alert-dismissable">
                    <div class="overflow-h">
                        <div class="hidetext2line">${agentdata.notification_message}</div>
                        <strong><small class="pull-right"><em>${date}</em></small></strong>
                    </div>
                </div>`;
            });

            return html;
        }

        $('#load_new_posts').click(function(e) {
            e.preventDefault();
            var limit = $(this).attr('title');
            loadagents(limit);
        });

        var asked_question_list = [];
        var valid = 0;
        var $checkboxes = $('#compcheckbox input[type="checkbox"]');

        $(document).ready(function() {

            loadagents(0);

            $('.datepicker').datepicker({
                'dateFormat': "dd/mm/yy",
                'minDate': 1,
            });

            $('#set-agent-closingdate').on('hidden.bs.modal', function() {
                $("[name='closing_date']").val('');
                $('.closing_date_warning').html('');
                $('#closingbtn').html('Save');
                count = 0;
            });

            jQuery("#comparebutton").prop('disabled', true);

            $checkboxes.change(function() {
                var countCheckedCheckboxes = $checkboxes.filter(':checked').length;

                if (countCheckedCheckboxes > 0) {
                    jQuery("#comparebutton").prop('disabled', false);
                    jQuery("#comparebutton").attr('type', 'submit');
                }
            });

            $('#sellectall').click(function(e) {
                $('.allcheckbox').prop('checked', true);
            });

            $('#sellectallnone').click(function(e) {
                $('.allcheckbox').prop('checked', false);
            });

            $('#message').click(function(e) {
                localStorage.clear();
                window.location.href = "{{ url('/messages/') }}";
            });

            loadcompare('{{ $post->post_id }}');

            $('#give_a_review_for_agents').submit(function(e) {
                e.preventDefault();

                var $form = $(e.target),
                    esmsg = $('.review-msg-text');

                $.ajax({
                    'url': "{{ Route('agent_rating') }}",
                    'type': 'POST',
                    'data': $form.serialize(),
                    'beforeSend': function() {
                        $(".set-agent-review-loader").show();
                    },
                    'processData': false,
                    'success': function(result) {
                        $(".set-agent-review-loader").hide();
                        $('.error-text').text('').removeClass('show').addClass('hide');
                        esmsg.text('').removeClass('show').addClass('hide');

                        if (result.error !== undefined && result.error !== null) {
                            $.each(result.error, function(key, value) {
                                $('#' + key + '_error').removeClass('success-text hide')
                                    .addClass('error-text show').text(value);
                            });
                        }

                        if (result.data !== undefined && result.data !== null) {
                            $('#set-agent-review').modal('hide');
                            msgshowfewsecond('Your feedback successfully send.');
                            location.reload();
                        }
                    },
                    'error': function(data) {
                        $(".set-agent-review-loader").hide();

                        if (data.status == '500') {
                            esmsg.text(data.statusText).css({
                                'color': 'red'
                            }).removeClass('hide').addClass('show');
                        } else if (data.status == '422') {
                            esmsg.text(data.responseJSON.image[0]).css({
                                'color': 'red'
                            }).removeClass('hide').addClass('show');
                        }
                    }
                });
            });

            /* Make 3% of payment to Agent*/
            var handler = StripeCheckout.configure({
                'key': 'pk_test_oJH1jATmGtjY6pprv6lXxxxn',
                'image': 'https://stripe.com/img/documentation/checkout/marketplace.png',
                'locale': 'auto',
                'token': function(token) {
                    // You can access the token ID with `token.id`.
                    // Get the token ID to your server-side code for use.
                }
            });

            function handleToken(token) {
                fetch("{{ url('/') }}/validatepaymentamount", {
                        'method': "POST",
                        'headers': {
                            "Content-Type": "application/json"
                        },
                        'body': JSON.stringify(token)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw response;
                        }
                        return response.json();
                    })
                    .then(output => {
                        if (output.status == 1) {
                            var alert =
                                '<div class="alert alert-success"><strong>Success!</strong>' +
                                output.msg + '</div>';
                            $("#paymentResponse").html(alert);

                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            var alert =
                                `<div class="alert alert-danger"><strong>Info!</strong>${output.msg}</div>`;
                            $("#paymentResponse").html(alert);
                        }
                    })
                    .catch(err => {
                        console.log("Purchase failed:", err);
                    });
            }

            $('#make_payment_for_agents').submit(function(e) {
                e.preventDefault();

                var $form = $(e.target);
                var esmsg = $('.review-msg-text');

                $.ajax({
                    'url': "{{ url('/') }}/validatepaymentamount",
                    'type': 'POST',
                    'data': $form.serialize(),
                    'beforeSend': function() {
                        $(".set-agent-review-loader").show();
                    },
                    'processData': false,
                    'success': function(result) {
                        $(".set-agent-review-loader").hide();
                        $('.error-text').text('').removeClass('show').addClass('hide');
                        esmsg.text('').removeClass('show').addClass('hide');

                        if (result.status == 2) {
                            var amount = parseInt($('#amount').val() * 100);
                            handler.open({
                                'name': '3% Agent Charges',
                                'description': '3% Agent Charges paying to agent.',
                                'amount': amount,
                                'currency': 'usd',
                                'token': handleToken,
                                'email': '{{ $user->email }}'
                            });
                            e.preventDefault();
                        }

                        if (result.error !== undefined && result.error !== null) {
                            $.each(result.error, function(key, value) {
                                $('#' + key + '_error').removeClass('success-text hide')
                                    .addClass('error-text show').text(value);
                            });
                        }

                        if (result.data !== undefined && result.data !== null) {
                            $('#set-agent-review').modal('hide');
                            msgshowfewsecond('Your feedback successfully send.');
                            location.reload();
                        }
                    },
                    'error': function(data) {
                        $(".set-agent-review-loader").hide();

                        if (data.status == '500') {
                            esmsg.text(data.statusText).css({
                                'color': 'red'
                            }).removeClass('hide').addClass('show');
                        } else if (data.status == '422') {
                            esmsg.text(data.responseJSON.image[0]).css({
                                'color': 'red'
                            }).removeClass('hide').addClass('show');
                        }
                    }
                });
            });

            function process(date) {
                var parts = date.split("/");
                return new Date(parts[2], parts[1] - 1, parts[0]);
            }

            $('#set_closing_date').submit(function(e) {
                e.preventDefault();

                var $form = $(e.target);
                var esmsg = $('.review-msg-text');

                let closing_date = process($form.find('input[name="closing_date"]').val());
                let post_create_date = process('{{ date('d/m/Y', strtotime($post->created_at)) }}');

                if ((closing_date.getTime() >= post_create_date.getTime()) == false) {
                    $('#closing_date_error').html(
                        'You can not set closing date before the post was created');
                    return false;
                }

                $.ajax({
                    'url': "{{ url('/') }}/addClosingDate",
                    'type': 'POST',
                    'data': $form.serialize(),
                    'beforeSend': function() {
                        $(".set-agent-review-loader").show();
                    },
                    'processData': false,
                    'success': function(result) {
                        console.log(result);
                        $(".set-agent-review-loader").hide();
                        $('.error-text').text('').removeClass('show').addClass('hide');
                        esmsg.text('').removeClass('show').addClass('hide');


                        if (result.error !== undefined && result.error !== null) {
                            $.each(result.error, function(key, value) {
                                $('#' + key + '_error').removeClass('success-text hide')
                                    .addClass('error-text show').text(value);
                            });
                        }

                        if (result.status != 2) {
                            $('#set_closing_date').modal('hide');
                            msgshowfewsecond('Your closing date successfully added.');

                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        }
                    },
                    'error': function(data) {
                        $(".set-agent-review-loader").hide();

                        if (data.status == '500') {
                            esmsg.text(data.statusText).css({
                                'color': 'red'
                            }).removeClass('hide').addClass('show');
                        } else if (data.status == '422') {
                            esmsg.text(data.responseJSON.image[0]).css({
                                'color': 'red'
                            }).removeClass('hide').addClass('show');
                        }
                    }
                });
            });
        });



        function comparenow() {
            if ($checkboxes.filter(':checked').length > 0) {
                jQuery("#comparebutton").prop('disabled', false);
                jQuery("#comparebutton").attr('type', 'submit');
            }

            $('#set-compare-peramitter').modal('show');
        }

        $('#asked_question').click(function() {
            if ($('#asked_question').prop('checked')) {
                $('#set-compare-asked_question-modal').modal('show');
                $('#set-compare-peramitter').modal('hide');
            }
        });

        $('#set-compare-asked_question-modal').on('hidden.bs.modal', function(e) {
            $('#set-compare-peramitter').modal('show');
        });

        function compareagent() {
            $.ajax({
                'url': "{{ url('/compared/data/get/') }}/{{ $post->post_id }}/{{ $post->agents_user_id }}/{{ $post->agents_users_role_id }}",
                'type': 'get',
                'beforeSend': function() {
                    $(".set-compare-peramitter-loader").show();
                },
                'success': function(result) {
                    $(".set-compare-peramitter-loader").hide();

                    if (result.comparedata != null && result.comparedata.compare_json != null) {
                        var comparedata = result.comparedata;
                        var comdd = JSON.parse(comparedata.compare_json);

                        $('#asked_question').prop('checked', comdd.asked_question == 1);
                        $('#bookmark_agents').prop('checked', comdd.bookmark_agents == 1);
                        $('#bookmark_answers').prop('checked', comdd.bookmark_answers == 1);
                        $('#bookmark_messages').prop('checked', comdd.bookmark_messages == 1);
                        $('#bookmark_proposal').prop('checked', comdd.bookmark_proposal == 1);
                        $('#rating_answers').prop('checked', comdd.rating_answers == 1);
                        $('#rating_messages').prop('checked', comdd.rating_messages == 1);
                        $('#proposals').prop('checked', comdd.proposals == 1);
                        $('#documents').prop('checked', comdd.documents == 1);
                        $('#notes_messages').prop('checked', comdd.notes_messages == 1);
                        $('#notes_asked_question').prop('checked', comdd.notes_asked_question == 1);
                        $('#notes_answers').prop('checked', comdd.notes_answers == 1);
                        $('#notes_proposal').prop('checked', comdd.notes_proposal == 1);
                        $('#notes_agents').prop('checked', comdd.notes_agents == 1);
                    }

                    if (result.askedquestiondata != '') {
                        $.each(result.askedquestiondata, function(key, val) {
                            asked_question_list[val.question_id] = val;
                            var apen = $('#asked_question_list');
                            var checked = val.asked != '' && val.asked == val.question_id ? 'checked' :
                                '';

                            var htm = '<label class="checkbox">' +
                                '<input type="hidden" value="' + val.question +
                                '" name="asked_question_text[' + val.question_id +
                                ']" class="asked_question_text">' +
                                '<input type="checkbox" name="asked_question_list[' + val.question_id +
                                ']" ' + checked + ' value="' + val.question_id +
                                '" class="asked_question_list allcheckbox asked_question_' + val
                                .question_id + '">' +
                                '<i></i>' + val.question +
                                '</label>';

                            apen.append(htm);
                        });
                    }
                },
                'error': function(data) {
                    $(".set-compare-peramitter-loader").hide();
                }
            });
        }
    </script>

@stop
