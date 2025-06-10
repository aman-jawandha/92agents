@extends('dashboard.master')
@section('style')
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('assets/css/pages/page_job_inner.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/pages/profile.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css"
        integrity="sha512-TQQ3J4WkE/rwojNFo6OJdyu6G8Xe9z8rMrlF9y7xpFbQfW5g8aSWcygCQ4vqRiJqFsDsE1T6MoAOMJkFXlrI9A=="
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous"></script>
    <style>
        .ui-datepicker-unselectable {
            cursor: not-allowed !important;
        }
    </style>
@stop
@section('title', $post->posttitle)
@section('content')
    <?php $topmenu = 'Post'; ?>
    @include('dashboard.include.sidebar')

    <!--=== Block Description ===-->
    <div class="block-description">
        <div class="container">
            <!-- <i class="center-icon rounded-x fa fa-edit"></i> -->
            <div class="row margin-bottom-40">
                <!-- Profile Content -->
                <div class="col-md-9 ">
                    <div class="padding-left-10 ">
                        <h2 class="postdetailsh2 ">{{ $post->posttitle }} <small
                                style="font-size: 55%;">{{ $post->role_name }}</small> <span class=""
                                style="font-size:11px; color:rgb(55, 160, 0);">{{ $post->applied_post == 1 ? ($post->applied_user_id == $user->id ? 'You are selected for this post.' : 'Post is selected.') : '' }}</span>
                        </h2>
                        <div>
                            <span class="margin-right-20"> <strong> Closing Date :</strong>
                                {{ $post->closing_date != null ? est_std_date($post->closing_date) : 'Not updated yet' }}
                            </span>
                            <span class="margin-right-20"> <strong> Posted by:</strong> {{ ucfirst($post->name) }} <sub
                                    class="{{ $post->login_status }} mini"> {{ $post->login_status }}</sub></span>
                            @if ($post->when_do_you_want_to_sell)
                                <span class="margin-right-20 skill-lable label label-success"> {{ $types }}
                                    {{ str_replace('_', ' ', $post->when_do_you_want_to_sell) }}</span>
                            @endif
                            @if ($post->home_type)
                                <span
                                    class="margin-right-20 skill-lable label label-success">{{ str_replace('_', ' ', $post->home_type) }}
                                </span>
                            @endif
                            <script type="text/javascript">
                                // 	var date = timeDifference(new Date(), new Date(Date.fromISO('{{ $post->created_at }}')));
                                //
                                // document.write(date);
                            </script>
                            <span class="margin-right-20"> Posted :
                                <script type="text/javascript">
                                    document.write(timeDifference(new Date(), new Date(Date.fromISO('{{ $post->created_at }}'))));
                                </script>
                            </span>
                            <span> <strong><i class="fa fa-map-marker"></i></strong>
                                {{ $post->city_name != null ? $post->city_name . ',' : '' }}{{ $post->state_name !== null ? $post->state_name . ',' : '' }}{{ $post->area != null ? $post->area . ',' : '' }}
                                {{ $post->zip != null ? $post->zip : '' }}</span>
                        </div>
                        <div>
                            @if ($post->applied_post == 1 && $post->applied_user_id == $user->id && $post->closing_date == '')
                                <button class="btn-u margin-top-20 cursor" data-target="#set-agent-closingdate"
                                    data-toggle="modal"> Add Closing Date </button>
                            @endif

                            @if (
                                $post->applied_post == 1 &&
                                    $post->applied_user_id == $user->id &&
                                    $post->closing_date != '' &&
                                    $post->agent_payment == 'completed' &&
                                    $post->buyer_seller_send_review == 1 &&
                                    $post->agent_send_review == 1)
                                <button class="btn-u margin-top-20 cursor" data-toggle="modal"> Post has been
                                    closed</button>
                            @endif

                            @if (
                                $post->applied_post == 1 &&
                                    $post->applied_user_id == $user->id &&
                                    $post->closing_date != '' &&
                                    $post->agent_payment != 'completed' &&
                                    $agentPaymentStatus == true)

                                @if (isset($commission_amount))
                                    <button class="btn-u margin-top-20 cursor" data-target="#make_payment"
                                        data-toggle="modal">Pay Now</button>
                                @else
                                    <button class="btn-u margin-top-20 cursor" disabled="true" style="background: #aaa;">Pay
                                        Now</button>
                                @endif


                            @endif

                            @if ($post->mark_complete == 1 && $post->buyer_seller_send_review == 1)
                                <div>
                                    <h2>{{ $post->name }} is gave you rating</h2>
                                </div>
                            @endif

                            @if (
                                $post->buyer_seller_send_review == 1 &&
                                    $post->applied_post == 1 &&
                                    $post->applied_user_id == $user->id &&
                                    $post->closing_date != '' &&
                                    $post->agent_payment == 'completed' &&
                                    $post->agent_send_review == 2)
                                <button class="btn-u margin-top-20 cursor" data-target="#set-agent-review"
                                    data-toggle="modal">Give a Review for post</button>

                                <!-- give agent review start  -->
                                <div class="modal fade " id="set-agent-review" tabindex="-1" role="dialog"
                                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " style="display: grid;">
                                        <div class="modal-content not-top sky-form">

                                            <div id="set-agent-review-loader"
                                                class="body-overlay col-md-12 center loder set-agent-review-loader"><img
                                                    src="{{ url('/assets/img/loder/loading.gif') }}" width="64px"
                                                    height="64px" /></div>

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                                <h4 class="modal-title set-agent-review-title">Give a feedback to
                                                    {{ $post->name }} for post ({{ $post->posttitle }}) </h4>
                                            </div>
                                            <form id="give_a_review_for_agents" class="sky-form">
                                                @csrf
                                                <div class="modal-body">
                                                    <fieldset style="padding: 0px 15px;">
                                                        <p class="review-msg-text hide"></p>
                                                        <section class="margin-0">
                                                            <label class="label margin-0"> Rating </label>
                                                            <label class="margin-0">
                                                                <div id="ratinganswer" class="rating1">
                                                                    <input class="stars star5" type="radio" name="rating"
                                                                        id="star5" value="5" />
                                                                    <label class = "full tooltips" data-toggle="tooltip"
                                                                        data-original-title="Awesome" data-placement="top"
                                                                        for="star5" title="Awesome"></label>

                                                                    <input class="stars star4_5" type="radio"
                                                                        name="rating" id="star4_5" value="4_5" />
                                                                    <label class="half tooltips" data-toggle="tooltip"
                                                                        data-original-title="Pretty good"
                                                                        data-placement="top" for="star4_5"
                                                                        title="Pretty good"></label>

                                                                    <input class="stars star4" type="radio" name="rating"
                                                                        id="star4" value="4" />
                                                                    <label class = "full tooltips" data-toggle="tooltip"
                                                                        data-original-title="Pretty good"
                                                                        data-placement="top" for="star4"
                                                                        title="Pretty good"></label>

                                                                    <input class="stars star3_5" type="radio"
                                                                        name="rating" id="star3_5" value="3_5" />
                                                                    <label class="half tooltips" data-toggle="tooltip"
                                                                        data-original-title="Meh" data-placement="top"
                                                                        for="star3_5" title="Meh"></label>

                                                                    <input class="stars star3" type="radio"
                                                                        name="rating" id="star3" value="3" />
                                                                    <label class = "full tooltips" data-toggle="tooltip"
                                                                        data-original-title="Meh" data-placement="top"
                                                                        for="star3" title="Meh"></label>

                                                                    <input class="stars star2_5" type="radio"
                                                                        name="rating" id="star2_5" value="2_5" />
                                                                    <label class="half tooltips" data-toggle="tooltip"
                                                                        data-original-title="Kinda bad"
                                                                        data-placement="top" for="star2_5"
                                                                        title="Kinda bad "></label>

                                                                    <input class="stars star2" type="radio"
                                                                        name="rating" id="star2" value="2" />
                                                                    <label class = "full tooltips" data-toggle="tooltip"
                                                                        data-original-title="Kinda bad"
                                                                        data-placement="top" for="star2"
                                                                        title="Kinda bad"></label>

                                                                    <input class="stars star1_5" type="radio"
                                                                        name="rating" id="star1_5" value="1_5" />
                                                                    <label class="half tooltips" data-toggle="tooltip"
                                                                        data-original-title="Meh" data-placement="top"
                                                                        for="star1_5" title="Meh"></label>

                                                                    <input class="stars star1" type="radio"
                                                                        name="rating" id="star1" value="1" />
                                                                    <label class = "full tooltips" data-toggle="tooltip"
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
                                                    <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                                                    <input type="hidden" name="notification_type" value="15">
                                                    <input type="hidden" name="notification_message"
                                                        value="{{ $userdetails->name }} has given you a review for post ({{ $post->posttitle }})">
                                                    <input type="hidden" name="rating_type" value="4">
                                                    <input type="hidden" name="rating_item_id"
                                                        value="{{ $post->agents_user_id }}">
                                                    <input type="hidden" name="rating_item_parent_id"
                                                        value="{{ $post->post_id }}">
                                                    <input type="hidden" name="receiver_id"
                                                        value="{{ $post->agents_user_id }}">
                                                    <input type="hidden" name="receiver_role"
                                                        value="{{ $post->agents_users_role_id }}">
                                                    <input type="hidden" name="sender_id" value="{{ $user->id }}">
                                                    <input type="hidden" name="sender_role"
                                                        value="{{ $user->agents_users_role_id }}">

                                                    <!-- <button type="button" class="btn btn-link" data-dismiss="modal" aria-hidden="true">Colse</button> -->
                                                    <button type="button" data-dismiss="modal" aria-hidden="true"
                                                        class="btn-u"
                                                        style="padding: 10px 20px;margin-right: 5px;color: #74c52c;box-shadow: 0 0.5px 4px rgba(57,73,76,.35);background: white;">Cancel</button>
                                                    <button type="submit" class="btn-u">Give</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- give agent review end  -->
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <h4 class="hide black" id="sharedbyagent"> Shared by:<br> {{ $post->name }} </h4>
                    <div class="akes-q-buten-appen margin-bottom-10" id="akes-q-buten-appen"></div>
                    <div class="akes-q-buten-appen " id="shard-upload-files-button"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="box-shadow-profile margin-bottom-40">
                        <div class="panel-profile">
                            <!--/start row-->
                            <div class="left-inner border1-bottom padding-5-20">
                                <h2><strong> Details </strong></h2>
                                <div class="postdetailsdescription"> {!! $post->details !!} </div>
                            </div>
                            <div class="left-inner border1-bottom padding-5-20">
                                <h2><strong>Home Overview</strong></h2>
                                <ul class="list-unstyled">
                                    @if ($post->when_do_you_want_to_sell)
                                        <li><i class="fa fa-check color-green"></i> <strong> Want to {{ $types }}
                                            </strong> {{ str_replace('_', ' ', $post->when_do_you_want_to_sell) }}.</li>
                                    @endif

                                    @if ($post->need_Cash_back == 1)
                                        <li><i class="fa fa-check color-green"></i> <strong> Need Cash back and Negotiate
                                                Commision </strong></li>
                                    @endif

                                    @if ($post->interested_short_sale == 1)
                                        <li><i class="fa fa-check color-green"></i> <strong> Interested in a Short Sale
                                            </strong></li>
                                        @if ($post->interested_short_sale == 1)
                                            <li><i class="fa fa-check color-green"></i> <strong> Got Lender approval for
                                                    short sale </strong></li>
                                        @endif
                                    @endif

                                    @if ($post->price_range)
                                        <li><i class="fa fa-check color-green title"></i> <strong>Price Range</strong>
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
                                        <li><i class="fa fa-check color-green"></i> <strong> yes </strong> interested in
                                            buying a foreclosure, short sale or junker </li>
                                    @endif

                                    @if ($post->bids_emailed != null)
                                        <li><i class="fa fa-check color-green"></i> <strong>
                                                {{ str_replace('_', ' ', $post->bids_emailed) }} </strong> </li>
                                    @endif

                                    @if ($post->do_you_need_financing != null)
                                        <li><i class="fa fa-check color-green"></i> need financing amount <strong>
                                                ${{ @number_format(str_replace('_', ' ', $post->do_you_need_financing)) }}
                                            </strong> </li>
                                    @endif
                                </ul>
                            </div>
                            @php
                                $best_features = json_decode($post->best_features);
                            @endphp
                            @if ($best_features)
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Best Features of Home</strong></h2>
                                    <ul class="list-unstyled">
                                        @foreach ($best_features as $value)
                                            <li><i class="fa fa-check color-green"></i> {!! $value !!} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <!--/end row-->
                        </div>
                    </div>

                    <!-- Notes -->

                    <div class="box-shadow-profile homedata homedatanotes margin-bottom-40">
                        <!-- Default Proposals -->
                        <div class="panel-profile">
                            <div class="panel-heading overflow-h air-card">
                                <h2 class="panel-title heading-sm pull-left"><i class="fa fa-commenting"></i>Notes History
                                </h2>

                            </div>
                            <div class="panel-body no-padding" data-mcs-theme="minimal-dark">
                                <ul class="list-group">
                                    <?php foreach ($notes_history as $note){ ?>
                                    <li class="list-group-item"><i class="fa fa-clock-o"> </i>
                                        <b>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $note->created_at)->format('d, M Y h:i A') }}</b>
                                        : {!! $note->notes !!}
                                    </li>
                                    {{-- <li class="list-group-item"><i class="fa fa-clock-o"> </i> <b>{{ date('d M Y h:i A') }}</b> : {!! $note->notes  !!}</li> --}}
                                    <?php } ?>
                                </ul>
                            </div>
                            <input type="hidden" name="notes-more-load" id="notes-more-load">
                            <div class="center"><img src="{{ url('/assets/img/loder/loading.gif') }}"
                                    class="messageloadertop notes-loader" width="40px" height="40px" /></div>
                        </div>
                        <!-- Default Proposals -->
                    </div>
                    <div class="box-shadow-profile margin-bottom-40">

                    </div>

                </div>
                <div class="col-md-3 sm-margin-bottom-20 grid cs-style-5">
                    <?php
					if(!empty($review)) {
						?>
                    <div class=" margin-bottom-20"
                        style="background-color: #fff;padding: 1.5rem;box-shadow: 0 1px 6px rgba(57, 73, 76, 0.52)">
                        <h4>Review you have received</h4>
                        <br>
                        <ul class="list-unstyled">
                            <li> <b>Rating</b> : {{ str_replace('_', '.', $review->rating) }}</li>
                            <li> <b>Review</b> : {!! $review->review !!}</li>
                        </ul>
                    </div>
                    <?php
					}
					?>


                    <div class="bookmark-user margin-bottom-20">
                        <span class="tooltips cursor btn-block btn btn-default sitegreen"
                            onclick="user_add_bookmark_list();" data-original-title="Bookmark"><i
                                class="fa fa-star-o bookmarkquestion-icon"></i> Bookmark Post</span>
                    </div>
                    <div class="margin-bottom-20 notebutton">
                        <span class="tooltips cursor btn-block btn btn-default sitegreen"
                            onclick="set_post_note_by_agent( '{{ $post->agents_user_id }}', '{{ $post->post_id }}', '{{ $post->posttitle }}')"
                            data-original-title="Note"><i class="fa fa-commenting bookmarkquestion-icon"></i> Note</span>


                    </div>
                    <hr>
                    <a class="btn-u btn-block margin-bottom-20 cursor" id="chat"> Connect to Chat </a>
                    <a class="btn-u btn-block margin-bottom-20 cursor" id="message"> Connect to Message</a>
                    <hr>
                    <h3 class="black"> Share to: <br>{!! ucfirst($post->name) !!}</h3>
                    <button class="btn-block btn btn-default sitegreen margin-bottom-20" data-toggle="modal"
                        data-target="#askquestion"><i class="fa fa-question-circle bookmarkquestion-icon"></i> Ask
                        Question</button>
                    <button class="btn-block btn btn-default sitegreen margin-bottom-20" data-toggle="modal"
                        data-target="#proposals-share"><i class="fa fa-file-text-o bookmarkquestion-icon"></i> Proposals
                    </button>
                    <button class="btn-block btn btn-default sitegreen margin-bottom-20" data-toggle="modal"
                        data-target="#uploaded-files-share"><i class="fa fa-file bookmarkquestion-icon"></i> Uploaded
                        Files </button>
                </div>
                <!-- End Profile Content -->
            </div>
        </div>
    </div>
    <!--=== End Block Description ===-->
    <div class="modal fade" id="askquestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="top: 0 !important;bottom: 0 !important;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel4">Ask Question For Post</h4>
                </div>
                <div class="modal-body profile padding-0">
                    <div class="tab-v1">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#existing-question" data-toggle="tab">Questions</a></li>
                            <li><a href="#new-question" data-toggle="tab">Add New Question</a></li>
                            <!-- <li><a href="#asked_question_answer" data-toggle="tab">Asked Questions Answered</a></li> -->
                        </ul>
                        <div class="tab-content">
                            <!-- Datepicker Forms -->
                            <div class="tab-pane fade in active" id="existing-question">
                                <div id="existingquestionslist" class="sky-form">

                                </div>
                                <div class="body-existingquestionslist-popup body-overlay">
                                    <div><img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px"
                                            height="64px" /></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="new-question">
                                <form url="#" class="sky-form" id="add-new-question">
                                    @csrf
                                    <fieldset>
                                        <div class="body-overlay-popup body-overlay">
                                            <div><img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px"
                                                    height="64px" /></div>
                                        </div>
                                        <div class="hide Question-add-msg"></div>
                                        <section>
                                            <label class="label">Ask Question</label>
                                            <label class="textarea ">
                                                <textarea rows="2" class="field-border" name="question" id="Question_id" placeholder="Enter Question"></textarea>
                                                <b class="error-text" id="question_error"></b>
                                            </label>
                                        </section>
                                        <section class="row">
                                            <div class="col col-12">
                                                <label class="label weight">Add question to Survey? </label>
                                                <div class="inline-group">
                                                    <label class="radio"><input type="radio" name="survey"
                                                            class="survey_1" value="1"><i
                                                            class="rounded-x"></i>Yes</label>
                                                    <label class="radio"><input type="radio" name="survey"
                                                            class="survey_2" value="0" checked><i
                                                            class="rounded-x"></i>No</label>
                                                </div>
                                            </div>
                                        </section>
                                    </fieldset>
                                    <input type="hidden" value="{{ $post->agents_users_role_id }}"
                                        name="question_type">
                                    <input type="hidden" value="1" name="ask_question">
                                    <input type="hidden" value="0" name="importance1">
                                    <input type="hidden" value="{{ $user->id }}" name="add_by">
                                    <input type="hidden" value="{{ $user->agents_users_role_id }}" name="add_by_role">
                                    <footer>
                                        <button type="submit" class="btn-u btn-u-primary pull-right"
                                            name="edit-profile-submit" value="Save changes"
                                            title="Save changes">Submit</button>
                                    </footer>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- note model start  -->
    <div class="modal fade " id="set-answers-notes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " style="display: grid;">
            <div class="modal-content not-top sky-form">
                <div id="set-answers-notes-loader" class="body-overlay col-md-12 center loder set-answers-notes-loader">
                    <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" />
                </div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title set-answers-notes-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="set-answers-notes-body">
                        <p class="notes-msg-text green"></p>
                        <section>
                            <label class="label"> Enter Your Note</label>
                            <label class="textarea">
                                <textarea rows="2" class="field-border jqte-test" name="notes_textarea_answers" id="notes_textarea_answers"
                                    placeholder="Enter Notes"></textarea>
                                <b class="error-text" id="notes_textarea_answers_error"></b>
                            </label>
                        </section>
                    </div>
                </div>
                <div class="modal-footer" id="notes-answers-form-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- note model end  -->
    <div class="modal fade" id="default_answers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="top: 0 !important;bottom: 0 !important;">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel4">{{ ucfirst($post->name) }} Asked Question</h4>
                </div>

                <div class="modal-body padding-0">
                    <div id="enters-default-answers" class="sky-form"></div>
                    <div class="load-agent-ask-question body-overlay">
                        <div><img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- note model start  -->
    <div class="modal fade " id="set-asked_question-notes" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog " style="display: grid;">
            <div class="modal-content not-top sky-form">
                <div id="set-asked_question-notes-loader"
                    class="body-overlay col-md-12 center loder set-asked_question-notes-loader"><img
                        src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" /></div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title set-asked_question-notes-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="set-asked_question-notes-body">
                        <p class="notes-msg-text green"></p>
                        <section>
                            <label class="label"> Enter Your Note</label>
                            <label class="textarea">
                                <textarea rows="2" class="field-border jqte-test" name="notes_textarea_asked_question"
                                    id="notes_textarea_asked_question" placeholder="Enter Notes"></textarea>
                                <b class="error-text" id="notes_textarea_asked_question_error"></b>
                            </label>
                        </section>
                    </div>
                </div>
                <div class="modal-footer" id="notes-asked_question-form-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- note model end  -->

    <div class="modal fade bs-example-modal-lg" id="proposals-share" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="top: 0 !important;bottom: 0 !important;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Share Proposals</h4>
                </div>
                <div class="modal-body">
                    <!--=== Cube-Portfdlio ===-->
                    <div class="panel-body row">
                        <div id="append-proposal-ajax"></div>
                        <div id="loadproposal" class="col-md-12 center loder loadproposal"><img
                                src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" /></div>
                        <div class="center col-md-12 btn-buy animated fadeInRight">
                            <a id="loadmoreproposal" class="cursor hide"><i class="fa fa-spinner"> </i> load more </a>
                        </div>
                    </div>
                    <!--=== End Cube-Portfdlio ===-->

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" id="uploaded-files-share" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="top: 0 !important;bottom: 0 !important;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Share Uploaded files</h4>
                </div>
                <div class="modal-body">
                    <!--=== Cube-Portfdlio ===-->
                    <div class="panel-body row">
                        <div id="append-uploaded-files-ajax"></div>
                        <div id="loaduploadshare" class="col-md-12 center loder loaduploadshare"><img
                                src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" /></div>
                        <div class="center col-md-12 btn-buy animated fadeInRight">
                            <a id="loaduploadandshare" class="cursor hide"><i class="fa fa-spinner"> </i> load more </a>
                        </div>
                    </div>
                    <!--=== End Cube-Portfdlio ===-->

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" id="uploaded-files-shared" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="top: 0 !important;bottom: 0 !important;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{ ucfirst($post->name) }} Shared Files</h4>
                </div>
                <div class="modal-body">
                    <!--=== Cube-Portfdlio ===-->
                    <div class="panel-body row">
                        <div id="append-uploaded-shared-files-ajax"></div>
                        <div id="loaduploadshared" class="col-md-12 center loder loaduploadshared"><img
                                src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" /></div>
                        <div class="center col-md-12 btn-buy animated fadeInRight">
                            <a id="loaduploadandshared" class="cursor hide"><i class="fa fa-spinner"> </i> load more </a>
                        </div>
                    </div>
                    <!--=== End Cube-Portfdlio ===-->

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" id="open-proposal-popup" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content not-top">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title proposal-popup-title">{{ ucfirst($userdetails->name) }}</h4>
                </div>
                <div class="modal-body append-src-ifram">

                </div>
            </div>
        </div>
    </div>

    <!-- Add Closing Date -->
    @if ($post->applied_post == 1 && $post->applied_user_id == $user->id && $post->closing_date == '')
        <div class="modal fade " id="set-agent-closingdate" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog " style="display: grid;">
                <div class="modal-content not-top sky-form">

                    <div id="set-agent-review-loader" class="body-overlay col-md-12 center loder set-agent-review-loader">
                        <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" />
                    </div>


                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title set-agent-review-title">Add Closing Date</h4>
                    </div>
                    <form id="set_closing_date" class="sky-form">
                        @csrf
                        <div class="modal-body">
                            <fieldset style="padding: 0px 15px;">
                                <p class="review-msg-text hide"></p>


                                <section class="margin-0">
                                    <label class="label margin-0"> Closing Date </label>
                                    <label class="textarea margin-0">
                                        <!-- <input type="date" class="form-control field-border" name="closing_date" value="" required/> -->
                                        <input type="text" class="form-control field-border datepicker"
                                            name="closing_date" value="" required onkeydown="return false"
                                            autocomplete="off" placeholder="Select closing date" />
                                        <b class="error-text" id="closing_date_error"></b>
                                    </label>
                                </section>
                                <br>
                                <b class='error-text closing_date_warning' style="text-transform: none;"></b>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="post_id"
                                value="{{ isset($post->post_id) ? $post->post_id : '' }}">
                            <input type="hidden" name="agent_id" value="{{ isset($user->id) ? $user->id : '' }}">
                            <input type="hidden" name="notification_type" value="14">
                            <input type="hidden" name="notification_message"
                                value="{{ isset($userdetails->name) ? $userdetails->name : '' }} has given you a review for post ({{ isset($post->posttitle) ? $post->posttitle : '' }})">
                            <input type="hidden" name="rating_type" value="3">
                            <input type="hidden" name="rating_item_id"
                                value="{{ isset($post->applied_user_id) ? $post->applied_user_id : '' }}">
                            <input type="hidden" name="rating_item_parent_id" value="{{ $post->post_id }}">
                            <input type="hidden" name="receiver_id" value="{{ $post->agents_user_id }}">
                            <input type="hidden" name="receiver_role" value="{{ $post->agents_users_role_id }}">
                            <input type="hidden" name="sender_id" value="{{ $user->id }}">
                            <input type="hidden" name="sender_role" value="{{ $user->agents_users_role_id }}">

                            <?php // <button type="button" class="btn btn-link" data-dismiss="modal" aria-hidden="true">Cancel</button>
                            ?>

                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn-u"
                                style="padding: 10px 20px;margin-right: 5px;color: #74c52c;box-shadow: 0 0.5px 4px rgba(57,73,76,.35);background: white;">Cancel</button>
                            <button type="submit" class="btn-u" id='closingbtn'>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <!-- Add Closing Date -->

    <div class="modal fade " id="make_payment" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " style="display: grid;">
            <div class="modal-content not-top sky-form">

                <div id="set-agent-review-loader" class="body-overlay col-md-12 center loder set-agent-review-loader"><img
                        src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" /></div>


                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title set-agent-review-title">Make Payment To 92agents.com </h4>
                </div>
                <form id="make_payment_for_agents" class="sky-form">
                    @csrf
                    <div class="modal-body">
                        <div id="paymentResponse"></div>
                        <fieldset style="padding: 0px 15px;">
                            <p class="review-msg-text hide"></p>


                            <section class="margin-0">
                                <label class="label margin-0"> 92agents.com 3% Charges </label>
                                <label class="textarea margin-0">
                                    <input type="text" id="amount" name="amount" class="form-control"
                                        value="{{ isset($commission_amount) ? $commission_amount : '100' }}" readonly>
                                    <b class="error-text" id="amount_error"></b>
                                </label>
                            </section>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="post_id" value="{{ isset($post->post_id) ? $post->post_id : '' }}">
                        <input type="hidden" name="agent_id" value="{{ isset($user->id) ? $user->id : '' }}">
                        <input type="hidden" name="notification_type" value="14">
                        <input type="hidden" name="notification_message"
                            value="{{ isset($userdetails->name) ? $userdetails->name : '' }} has given you a review for post ({{ isset($post->posttitle) ? $post->posttitle : '' }})">
                        <input type="hidden" name="rating_type" value="3">
                        <input type="hidden" name="rating_item_id"
                            value="{{ isset($post->applied_user_id) ? $post->applied_user_id : '' }}">
                        <input type="hidden" name="rating_item_parent_id" value="{{ $post->post_id }}">
                        <input type="hidden" name="receiver_id" value="{{ $post->agents_user_id }}">
                        <input type="hidden" name="receiver_role" value="{{ $post->agents_users_role_id }}">
                        <input type="hidden" name="sender_id" value="{{ $user->id }}">
                        <input type="hidden" name="sender_role" value="{{ $user->agents_users_role_id }}">

                        <!-- <button type="button" class="btn btn-link" data-dismiss="modal" aria-hidden="true">Close</button> -->
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn-u"
                            style="padding: 10px 20px;margin-right: 5px;color: #74c52c;box-shadow: 0 0.5px 4px rgba(57,73,76,.35);background: white;">Cancel</button>
                        <button type="submit" class="btn-u">Make Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade " id="set-users-notes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " style="display: grid;">
            <div class="modal-content not-top sky-form">
                <div id="set-users-notes-loader" class="body-overlay col-md-12 center loder set-users-notes-loader"><img
                        src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" /></div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title set-users-notes-title">{{ ucfirst($post->posttitle) }}</h4>
                </div>
                <div class="modal-body">
                    <div class="set-users-notes-body">
                        <p class="notes-msg-text green"></p>
                        <section>
                            <label class="label"> Enter Your Note</label>
                            <label class="textarea">
                                <textarea rows="2" class="field-border jqte-test" name="notes_textarea_users" id="notes_textarea_users"
                                    placeholder="Enter Notes"></textarea>
                                <b class="error-text" id="notes_textarea_users_error" style="display: none"></b>
                            </label>
                        </section>
                    </div>
                </div>
                <div class="modal-footer" id="notes-users-form-footert">
                    <button class="btn-u btn-u-primary notes-users-form-submit"
                        onclick="set_agent_note_with_text('{{ $post->agents_user_id }}', '{{ $post->post_id }}','{{ $post->agents_users_role_id }}')"
                        title="Save note">Save</button>

                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script type="text/javascript" src="https://checkout.stripe.com/checkout.js"></script>

    <script type="text/javascript">
        $('.datepicker').datepicker({
            dateFormat: "dd/mm/yy",
            maxDate: 'now',
            placeholder: "Select closing date"
        });
        // $('#set-agent-closingdate').on('hidden.bs.modal', function () {
        // 	$("[name='closing_date']").val('');
        // 	$('.closing_date_warning').html('');
        // 	$('#closingbtn').html('Save');
        // 	count = 0;
        // });
    </script>

    <script type="text/javascript">
        //alert('{{ $uri_segment }}');
        var agent_question = [];
        var proposale_data = [];
        var uploadfiles_data = [];
        var shareduploadfiles_data = [];
        var sharedquestion_data = [];
        var share_question_return_answer = [];


        // function publicConnection() {
        //     $.ajax({
        //         url: "{{ url('/users/public/Connection') }}",
        //         type: 'post',
        //         data: {
        //             post_id: '{{ $post->post_id }}',
        //             from_id: '{{ $post->agents_user_id }}',
        //             from_role: '{{ $post->agents_users_role_id }}',
        //             to_id: '{{ $user->id }}',
        //             to_role: '{{ $user->agents_users_role_id }}',
        //             _token: '{{ csrf_token() }}'
        //         },
        //         success: function(result) {},
        //         error: function(result) {}
        //     });
        // }

        $(document).ready(function() {

            $('#message').click(function(e) {
                // publicConnection();
                localStorage.clear();
                window.location.href =
                    "{{ URL('/messages/' . $post->post_id . '/' . $post->agents_user_id . '/' . $post->agents_users_role_id) }}";
            });

            $('#chat').click(function(e) {
                register_popup('{{ $post->post_id }}', '{{ $post->agents_user_id }}',
                    '{{ $post->agents_users_role_id }}');
                // publicConnection();
            });

            /* question and ans  */
            $.ajax({
                url: "{{ url('/question/get/only/user') }}",
                type: 'POST',
                data: {
                    shared_item_type: 1,
                    _token: '{{ csrf_token() }}',
                    add_by: '{{ $user->id }}',
                    add_by_role: '{{ $user->agents_users_role_id }}',
                    question_type: '{{ $post->agents_users_role_id }}',
                    post_id: '{{ $post->post_id }}',
                    receiver_id: '{{ $post->agents_user_id }}',
                    share: 'ask_question'
                },
                beforeSend: function() {
                    $(".body-existingquestionslist-popup").show();
                },
                success: function(result) {
                    console.log('ab test');
                    console.log(result[0]);
                    console.log('ac test');
                    $(".body-existingquestionslist-popup").hide();
                    var by = 1,
                        sel = 1;
                    var askqi = 1;
                    $.each(result[0], function(key, val) {
                        console.log('abhi test');
                        console.log(result[0]);
                        console.log('achi test');
                        agent_question[val.question_id] = val
                        var qi = val.question_id;
                        var sharequetion = result[1][qi];
                        var checkanswer = result[2][qi];
                        // var answerdhtml = $('#asked_question_answer_list');

                        if (val.question_type == 2) {
                            key = by;
                            by = 1 + by;
                            var utyp = 'buyer';
                            var apen = $('#existingquestionslist');
                        }
                        if (val.question_type == 3) {
                            key = sel;
                            sel = 1 + sel;
                            var utyp = 'seller';
                            var apen = $('#existingquestionslist');
                        }
                        var htm = '<div class="askquestioncount_' + utyp + '">' +
                            '<div class="panel-group margin-0" id="accordion-' + utyp + '-' +
                            key + '">' +
                            '<div class="panel-heading border1-bottom">' +
                            '<h4 class="text-15 panel-title position-r question-title">' +
                            '<span>' + key + ') </span>' +
                            '<a class="question-question q-s-' + val.question_id + '">' + val
                            .question + '</a>' +

                            '<img class="ovloader imgloader_' + val.question_id +
                            ' pull-right" src="{{ url('/assets/img/loder/loading.gif') }}" width="15px" height="15px" >' +
                            '<span class="text-13 clicksurvey_' + val.question_id + '">';

                        if (sharequetion) {
                            htm +=
                                '<span href="#" class="margin cursor green pull-right" onclick="add_ask_list_question_remove(' +
                                val.question_id + ',' + sharequetion +
                                ');"> <i class="fa fa-check-circle-o"> </i> <strong>Asked</strong> </span>';
                        } else {
                            htm +=
                                '<span href="#" class="margin cursor pull-right" onclick="add_ask_list_question(' +
                                val.question_id +
                                ');"> <i class="fa fa-circle-o" aria-hidden="true"></i> <strong>Ask</strong> </span>';
                        }
                        htm += '</span>';
                        if (checkanswer != '' && checkanswer != null) {
                            htm +=
                                '<span class="text-13 margin cursor sitegreen pull-right accordion-toggle collapsed" data-toggle="collapse" data-target="#collapse-' +
                                utyp + '-' + key +
                                '" > <i class="fa fa-reply" aria-hidden="true"></i> <strong> Answered </strong> </span>';
                        }
                        htm += '</h4>';
                        if (checkanswer != '' && checkanswer != null) {
                            var ansewrdd = checkanswer;
                            share_question_return_answer[ansewrdd.answers_id] = ansewrdd;
                            var qdate = timeDifference(new Date(), new Date(Date.fromISO(val
                                .created_at)));
                            var adate = timeDifference(new Date(), new Date(Date.fromISO(
                                ansewrdd.created_at)));

                            htm += '<div id="collapse-' + utyp + '-' + key +
                                '" class="panel-collapse collapse">' +
                                '<div class="media padding-5 media-v2">' +
                                '<div class="media-body">' +
                                '<h4 class="media-heading color-black">' +
                                '<strong><a href="#"> Answered by {{ ucfirst($post->name) }} </a></strong>' +
                                '<li onclick="setnotesinanswer(' + ansewrdd.answers_id + ',' +
                                ansewrdd.question_id +
                                ');" data-toggle="tooltip" data-original-title="Note" data-placement="bottom"  class="tooltips fa fa-commenting bookmarkquestion-icon"></li>' +
                                '<small class="media-small"> <i class="fa fa-clock-o green"> </i> ' +
                                adate + '</small>' +
                                '</h4>' +
                                '<div>' + ansewrdd.answers + ' </div>' +

                                '</div>' +
                                '</div>' +
                                '</div>';
                        }
                        htm += '</div>' +
                            '</div>' +
                            '</div>';
                        apen.append(htm);

                    });

                    if ('{{ $uri_segment }}' === '10') {
                        $('#askquestion').modal('show');
                        $('a[href="#asked_question_answer"]').tab('show');
                        readnotificationbyreciverid('{{ $post->agents_user_id }}',
                            '{{ $post->agents_users_role_id }}', '{{ $user->id }}',
                            '{{ $user->agents_users_role_id }}', 10);
                    }
                    $('#askquestion-model').on('click', function() {
                        readnotificationbyreciverid('{{ $post->agents_user_id }}',
                            '{{ $post->agents_users_role_id }}', '{{ $user->id }}',
                            '{{ $user->agents_users_role_id }}', 10);
                    });
                },
                error: function(data) {
                    location.reload();
                }
            });

            $('#add-new-question').submit(function(e) {
                e.preventDefault();
                var $form = $(e.target),
                    esmsg = $(".Question-add-msg");
                $.ajax({
                    url: "{{ url('/insertquestion') }}",
                    type: 'POST',
                    data: $form.serialize(),
                    beforeSend: function() {
                        $(".body-overlay-popup").show();
                    },
                    processData: false,
                    success: function(result) {
                        $('#Question_id').val('');
                        $('#question_type').val('');
                        $(".body-overlay-popup").hide();
                        $('.error-text').text('');
                        $('.field-border').removeClass('error-border');
                        if (typeof result.error != 'undefined' && result.error != null) {
                            $.each(result.error, function(key, value) {
                                $('#' + key + '_error').removeClass('success-text')
                                    .addClass('error-text').text(value);
                                $('#' + key).addClass('error-border');
                            });
                            esmsg.text('').addClass('hide');
                        }
                        if (typeof result.msg != 'undefined' && result.msg != null) {

                            esmsg.text('').addClass('hide');
                            // esmsg.removeClass('hide').addClass('show alert alert-success text-center').text(result.msg);
                            // setInterval(function() { esmsg.text('').addClass('hide').removeClass('show alert-success'); },5000);
                            msgshowfewsecond(result.msg);
                            var val = result.data;
                            agent_question[val.question_id] = val
                            if (val.question_type == 2) {
                                key = $('.askquestioncount_buyer').length + 1;;
                                var utyp = 'buyer';
                                var apen = $('#existingquestionslist');
                            }

                            if (val.question_type == 3) {
                                key = $('.askquestioncount_seller').length + 1;;
                                var utyp = 'seller';
                                var apen = $('#existingquestionslist');
                            }

                            var htm = '<div class="askquestioncount_' + utyp + '">' +
                                '<div class="panel-group margin-0" id="accordion-' + utyp +
                                '-' + key + '">' +
                                '<div class="panel-heading border1-bottom">' +
                                '<h4 class="text-15 panel-title position-r question-title">' +
                                '<span>' + key + ') </span>' +
                                '<a class="question-question q-s-' + val.question_id + '">' +
                                val.question + '</a>' +

                                '<img class="ovloader imgloader_' + val.question_id +
                                ' pull-right" src="{{ url('/assets/img/loder/loading.gif') }}" width="15px" height="15px" >' +
                                '<span class="text-13 clicksurvey_' + val.question_id + '">' +
                                '<span href="#" class="margin cursor pull-right" onclick="add_ask_list_question(' +
                                val.question_id +
                                ');"> <i class="fa fa-circle-o" aria-hidden="true"></i> <strong>Ask</strong> </span>' +
                                '</span>' +
                                '</h4>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            apen.append(htm);
                            add_ask_list_question(val.question_id);
                        }
                    },
                    error: function(data) {
                        if (data.status == '500') {
                            esmsg.text(data.statusText).css({
                                'color': 'red'
                            }).removeClass('hide').addClass('show');
                        } else if (data.status == '422') {
                            esmsg.text(data.responseJSON.image[0]).css({
                                'color': 'red'
                            }).removeClass('hide').addClass('show');
                        }
                        $(".body-overlay").hide();
                        setInterval(function() {
                            esmsg.text('').addClass('hide').removeClass('show');
                        }, 5000);
                    }
                });
            });

            /* question answear */
            $('#enters-default-answers, #enters-default-question-answers').submit(function(e) {
                e.preventDefault();

                var answers = e.target[1].value;
                var fieldname = e.target[1].name;
                var question_id = e.target[2].value;
                var $form = $(e.target),
                    esmsg = $(".question-msg-" + question_id);
                var qdd = sharedquestion_data[question_id];
                $.ajax({
                    url: "{{ url('/questiontoanswer') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        post_id: '{{ $post->post_id }}',
                        notification_message: '{{ $userdetails->name }} replied ( ' + answers +
                            ' ). your question ( ' + qdd.question + ' )',
                        receiver_id: '{{ $post->agents_user_id }}',
                        receiver_role: '{{ $post->agents_users_role_id }}',
                        question_id: question_id,
                        answers: answers,
                        _token: '{{ csrf_token() }}',
                        from_id: '{{ $user->id }}',
                        from_role: '{{ $user->agents_users_role_id }}'
                    },
                    beforeSend: function() {
                        $(".loader-question-proccess_" + question_id).show();
                        $('.question-submit-b_' + question_id).hide();
                    },
                    success: function(result) {

                        $(".loader-question-proccess_" + question_id).hide();
                        $(".question-submit-b_" + question_id).show();
                        $('.error-text').text('');
                        $('.field-border').removeClass('error-border');

                        $('#default_answers').modal('hide');
                        if (typeof result.error !== 'undefined') {
                            $.each(result.error, function(key, value) {
                                $('#' + fieldname + '_error').removeClass(
                                    'success-text').addClass('error-text').text(
                                    value);
                                $('#' + fieldname).addClass('error-border');
                            });
                            esmsg.text('').addClass('hide');
                        }
                        if (typeof result.msg !== 'undefined') {

                            esmsg.text('').addClass('hide');
                            msgshowfewsecond(result.msg);
                        }

                        // publicConnection();
                    },
                    error: function(data) {
                        $(".loader-question-proccess_" + question_id).hide();
                        $(".question-submit-b_" + question_id).show();
                        if (data.status == '500') {
                            esmsg.text(data.statusText).css({
                                'color': 'red'
                            }).removeClass('hide').addClass('show');
                        } else if (data.status == '422') {
                            esmsg.text(data.responseJSON.image[0]).css({
                                'color': 'red'
                            }).removeClass('hide').addClass('show');
                        }
                        setInterval(function() {
                            esmsg.text('').addClass('hide').removeClass('show');
                        }, 5000);
                    }
                });
            });

            /* shared question and ans  */
            $.ajax({
                url: "{{ url('/shared/question/answer/get') }}",
                type: 'POST',
                data: {
                    shared_type: 1,
                    shared_item_type: 2,
                    shared_item_type_id: '{{ $post->post_id }}',
                    _token: '{{ csrf_token() }}',
                    receiver_id: '{{ $user->id }}',
                    receiver_role: '{{ $user->agents_users_role_id }}',
                    question_type: '{{ $user->agents_users_role_id }}',
                    sender_id: '{{ $post->agents_user_id }}',
                    sender_role: '{{ $post->agents_users_role_id }}',
                    bookmark_type: 1,
                    rating: 'rating'
                },
                beforeSend: function() {
                    $(".load-agent-ask-question").show();
                },
                success: function(result) {
                    console.log('atest');
                    console.log(result[0]);
                    console.log('btest');
                    if (result[0] != '') {
                        $(".load-agent-ask-question").hide();
                        var apptypeqa = $('#enters-default-answers');
                        $.each(result[0], function(key, val) {

                            sharedquestion_data[val.question_id] = val;
                            var rating1 = '';
                            var ratingset = 0;
                            if (result[3][val.question_id] != null && result[3][val
                                    .question_id
                                ] != 'undefined' && result[3][val.question_id] != '') {

                                var rat = result[3][val.question_id];
                                var ratingset = rat.rating;

                                rating1 = '<div id="ratinganswer_' + val.question_id +
                                    '" class="rating-show-only anserrating">' +

                                    '<input class="stars" disabled type="radio"  id="star5_' +
                                    val.question_id + '" value="5" />' +
                                    '<label class = "full tooltips" data-original-title="Awesome " data-placement="top" for="star5_' +
                                    val.question_id + '" title="Awesome"></label>' +

                                    '<input class="stars" disabled type="radio" id="star4_5_' +
                                    val.question_id + '" value="4_5" />' +
                                    '<label class="half tooltips" data-original-title="Pretty good " data-placement="top" for="star4_5_' +
                                    val.question_id + '" title="Pretty good"></label>' +

                                    '<input class="stars" disabled type="radio" id="star4_' +
                                    val.question_id + '" value="4" />' +
                                    '<label class = "full tooltips" data-original-title="Pretty good " data-placement="top" for="star4_' +
                                    val.question_id + '" title="Pretty good"></label>' +

                                    '<input class="stars" disabled type="radio" id="star3_5_' +
                                    val.question_id + '" value="3_5" />' +
                                    '<label class="half tooltips" data-original-title="Meh " data-placement="top" for="star3_5_' +
                                    val.question_id + '" title="Meh"></label>' +

                                    '<input class="stars" disabled type="radio" id="star3_' +
                                    val.question_id + '" value="3" />' +
                                    '<label class = "full tooltips" data-original-title="Meh " data-placement="top" for="star3_' +
                                    val.question_id + '" title="Meh"></label>' +

                                    '<input class="stars" disabled type="radio" id="star2_5_' +
                                    val.question_id + '" value="2_5" />' +
                                    '<label class="half tooltips" data-original-title="Kinda bad " data-placement="top" for="star2_5_' +
                                    val.question_id + '" title="Kinda bad "></label>' +

                                    '<input class="stars" disabled type="radio" id="star2_' +
                                    val.question_id + '" value="2" />' +
                                    '<label class = "full tooltips" data-original-title="Kinda bad " data-placement="top" for="star2_' +
                                    val.question_id + '" title="Kinda bad"></label>' +

                                    '<input class="stars" disabled type="radio" id="star1_5_' +
                                    val.question_id + '" value="1_5" />' +
                                    '<label class="half tooltips" data-original-title="Meh " data-placement="top" for="star1_5_' +
                                    val.question_id + '" title="Meh"></label>' +

                                    '<input class="stars" disabled type="radio" id="star1_' +
                                    val.question_id + '" value="1" />' +
                                    '<label class = "full tooltips" data-original-title="Sucks big time " data-placement="top" for="star1_' +
                                    val.question_id + '" title="Sucks big time"></label>' +

                                    '<input class="stars" disabled type="radio"  id="star0_5_' +
                                    val.question_id + '" value="0_5" />' +
                                    '<label class="half tooltips" data-original-title="Sucks big time " data-placement="top" for="star0_5_' +
                                    val.question_id + '" title="Sucks big time"></label>' +
                                    '</div>';

                            }

                            var questionsharedate = timeDifference(new Date(), new Date(Date
                                .fromISO(val.created_at)));

                            var htm =
                                '<div class="panel-group margin-0"><div class="panel-heading border1-bottom clear-both">' +

                                '<h4 class="text-15 panel-title question-title">' +
                                '<span onclick="setnotesinaskedquestion(' + val.question_id +
                                ',{{ $post->post_id }});" data-toggle="tooltip" data-original-title="Note" data-placement="top"  class="text-13 tooltips fa fa-commenting bookmarkquestion-icon"></span>' +
                                '<span class="text-13 bookmark_q_' + val.question_id + '">';

                            if (result[2][val.question_id] != '') {
                                var book = result[2][val.question_id];
                                htm += '<span onclick="remove_bookmark_list(' + val
                                    .question_id + ',' + book.bookmark_id +
                                    ');" data-toggle="tooltip" data-original-title="Bookmarked " class="tooltips fa fa-bookmark sitegreen book_question_' +
                                    val.question_id + ' bookmarkquestion-icon"></span> ';
                            } else {

                                htm += '<span onclick="add_bookmark_list(' + val.question_id +
                                    ');" data-toggle="tooltip" data-original-title="Bookmark" class="tooltips fa fa-bookmark-o book_question_' +
                                    val.question_id + ' bookmarkquestion-icon"></span> ';
                            }
                            htm += '</span>' +
                                '<span>' +
                                (key + 1) + ') </span><a class="question-question q-s-' + val
                                .question_id + '" >' +
                                val.question +
                                ' <span class="padding-left-10 text-12"><strong> Posted: </strong>' +
                                questionsharedate + '</span>' +
                                '</a>' +
                                '<span href="#" class="text-13 margin cursor sitegreen pull-right accordion-toggle collapsed" data-toggle="collapse" data-target="#collapse-answer-' +
                                key +
                                '"> <i class="fa fa-reply"> </i> <small> Answer </small> </span>' +
                                '</h4>' +

                                '<div id="collapse-answer-' + key +
                                '" class="panel-collapse collapse panel-body padding-0 margin-top-10">' +

                                '<form url="#" class="row enters-default-answers"> @csrf' +
                                '<div class="hide question-msg-' + val.question_id +
                                '"></div>' +
                                '<div class="col-md-8">' +
                                '<label class="textarea ">' +
                                '<textarea data-original-title="Enter your interesting answer" rows="2" class="field-border tooltips" name="question_default_' +
                                key + '" id="question_default_' + key +
                                '" placeholder="Enter your interesting answer">' + result[1][val
                                    .question_id
                                ] + '</textarea>' +
                                '<b class="error-text" id="question_default_' + key +
                                '_error"></b>' +
                                '</label>' +
                                '</div>' +
                                '<div class="col-md-4 margin-top-5"> ' +
                                '<input type="hidden" name="question_id" value="' + val
                                .question_id + '">' +
                                '<img class="ovloader loader-question-proccess_' + val
                                .question_id +
                                ' pull-right" src="{{ url('/assets/img/loder/loading.gif') }}" width="15px" height="15px">' +
                                '<button type="submit" class="question-submit-b_' + val
                                .question_id +
                                ' btn-u ladda-button pull-right">Save</button><br>' +
                                rating1 +
                                '</div>' +

                                '</form>' +
                                '</div>' +

                                '</div></div>';

                            apptypeqa.append(htm);

                            $('#star' + ratingset + '_' + val.question_id).attr("checked",
                                "checked");

                        });

                        $('#sharedbyagent').removeClass('hide').addClass('show');
                        $('#akes-q-buten-appen').html(
                            '<button  type="button" class="btn btn-default black btn-block margin-top-10" data-toggle="modal" data-target="#default_answers"> <i class="fa fa-reply" aria-hidden="true"></i> Asked Question</button>'
                        );

                        if ('{{ $uri_segment }}' === '4' || '{{ $uri_segment }}' === '8') {
                            $('#default_answers').modal('show');
                            if ('{{ $uri_segment }}' === '8') {
                                $('a[href="#asked-question-with-answer-tab"]').tab('show');
                            }
                            readnotificationbyreciverid('{{ $post->agents_user_id }}',
                                '{{ $post->agents_users_role_id }}', '{{ $user->id }}',
                                '{{ $user->agents_users_role_id }}', 4);
                            readnotificationbyreciverid('{{ $post->agents_user_id }}',
                                '{{ $post->agents_users_role_id }}', '{{ $user->id }}',
                                '{{ $user->agents_users_role_id }}', 8);
                        }

                        $('#akes-q-buten-appen button').on('click', function() {
                            readnotificationbyreciverid('{{ $post->agents_user_id }}',
                                '{{ $post->agents_users_role_id }}',
                                '{{ $user->id }}',
                                '{{ $user->agents_users_role_id }}', 4);
                            readnotificationbyreciverid('{{ $post->agents_user_id }}',
                                '{{ $post->agents_users_role_id }}',
                                '{{ $user->id }}',
                                '{{ $user->agents_users_role_id }}', 8);
                        });
                    }
                }
            });

            /*shared upload file get */
            $.ajax({
                url: "{{ url('/shared/upload/files/get') }}",
                type: 'POST',
                data: {
                    shared_type: 2,
                    shared_item_type: 2,
                    shared_item_type_id: '{{ $post->post_id }}',
                    receiver_id: '{{ $user->id }}',
                    receiver_role: '{{ $user->agents_users_role_id }}',
                    sender_id: '{{ $post->agents_user_id }}',
                    sender_role: '{{ $post->agents_users_role_id }}',
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    $(".loaduploadshared").show();
                },
                success: function(result) {
                    if (result != 'undefined' && result != null && result != '') {
                        $(".loaduploadshared").hide();
                        $.each(result, function(key, value) {
                            shareduploadfiles_data[value.upload_share_id] = value;
                            var extension = value.attachments.substr((value.attachments
                                .lastIndexOf('.') + 1));
                            extension = extension.toLowerCase();

                            var htmll = '<div class="col-md-4">' +
                                '<div class="thumbnails uploadfiles_' + value.upload_share_id +
                                ' thumbnail-style box-shdow thumbnail-kenburn">' +
                                '<div class="cbp-caption thumbnail-img">' +
                                '<div class="overflow-hidden cbp-caption-defaultWrap">';

                            if (extension == 'png' || extension == 'jpg' || extension ==
                                'jpeg' || extension == 'gif' || extension == 'tif') {
                                htmll += '<img 		class="documen document_uploadfiles_' + value
                                    .upload_share_id + '" src="' + value.attachments +
                                    '" frameborder="0" scrolling="no" width="246" height="182px">';
                            } else {
                                htmll += '<iframe 	class="documen document_uploadfiles_' + value
                                    .upload_share_id +
                                    '" src="https://docs.google.com/viewer?url=' + value
                                    .attachments +
                                    '&embedded=true" frameborder="0" scrolling="no" width="246" height="176"></iframe>';
                            }

                            htmll += '</div>' +
                                '<div class="removehover cbp-caption-activeWrap">' +
                                '<div class="cbp-l-caption-alignCenter">' +
                                '<div class="cbp-l-caption-body">' +
                                '<ul class="link-captions no-bottom-space">' +
                                '<li><a class="cursor" onclick="openuploadfilesshared(' + value
                                .upload_share_id +
                                ')"><i class="rounded-x fa fa-search"></i></a>' +
                                '</ul>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +

                                '</div>' +
                                '</div>';
                            $('#append-uploaded-shared-files-ajax').append(htmll);
                        });
                        $('#sharedbyagent').removeClass('hide').addClass('show');
                        $('#shard-upload-files-button').html(
                            '<button  type="button" class="btn black btn-block btn-default margin-top-10" data-toggle="modal" data-target="#uploaded-files-shared"> <i class="fa fa-reply" aria-hidden="true"></i> Shared Files </button>'
                        );
                        if ('{{ $uri_segment }}' === '5') {
                            $('#uploaded-files-shared').modal('show');
                            readnotificationbyreciverid('{{ $post->agents_user_id }}',
                                '{{ $post->agents_users_role_id }}', '{{ $user->id }}',
                                '{{ $user->agents_users_role_id }}', 5);
                        }
                        $('#shard-upload-files-button button').on('click', function() {
                            readnotificationbyreciverid('{{ $post->agents_user_id }}',
                                '{{ $post->agents_users_role_id }}',
                                '{{ $user->id }}',
                                '{{ $user->agents_users_role_id }}', 5);
                        });
                    }
                }
            });

            /* user get bookmarked */
            $.ajax({
                url: "{{ url('/bookmarked/get/') }}/{{ $user->id }}/{{ $user->agents_users_role_id }}/2/{{ $post->agents_user_id }}/{{ $post->post_id }}",
                type: 'get',
                success: function(result) {

                    if (result.bookmark_id != null && result.bookmark_id != 'undefined') {
                        var html =
                            '<span class="tooltips cursor btn-block btn btn-default sitegreen" onclick="user_remove_bookmark_list(' +
                            result.bookmark_id +
                            ');" data-original-title="Bookmarked"><i class="fa fa-star bookmarkquestion-icon"></i> Bookmarked</span>';
                        // var html ='<span onclick="user_remove_bookmark_list('+result.bookmark_id+');" data-toggle="tooltip" data-original-title="Bookmarked" class="tooltips fa fa-star bookmarkquestion-icon"></span> ';
                    } else {
                        var html =
                            '<span class="tooltips cursor btn-block btn btn-default sitegreen" onclick="user_add_bookmark_list();" data-original-title="Bookmark"><i class="fa fa-star-o bookmarkquestion-icon"></i> Bookmark Post</span>';
                        // var html ='<span onclick="user_add_bookmark_list();" data-toggle="tooltip" data-original-title="Bookmark" class="tooltips fa fa-star-o bookmarkquestion-icon"></span> ';
                    }
                    $('.bookmark-user').html(html);

                }
            });

            $('#loadmoreproposal').click(function(e) {
                e.preventDefault();
                var limit = $(this).attr('title');
                loadproposal(limit);
            });
            $('#loaduploadandshare').click(function(e) {
                e.preventDefault();
                var limit = $(this).attr('title');
                loaduploadshare(limit);
            });
            loadproposal(0);
            loaduploadshare(0);

            /* edit password*/
            $('#give_a_review_for_agents').submit(function(e) {
                e.preventDefault();
                var $form = $(e.target),
                    esmsg = $('.review-msg-text');

                $.ajax({
                    url: "{{ Route('agent_rating') }}",
                    type: 'POST',
                    data: $form.serialize(),
                    beforeSend: function() {
                        $(".set-agent-review-loader").show();
                    },
                    processData: false,
                    success: function(result) {
                        $(".set-agent-review-loader").hide();
                        $('.error-text').text('').removeClass('show').addClass('hide');
                        esmsg.text('').removeClass('show').addClass('hide');

                        if (typeof result.error != 'undefined' && result.error != null) {
                            $.each(result.error, function(key, value) {
                                $('#' + key + '_error').removeClass('success-text hide')
                                    .addClass('error-text show').text(value);
                            });
                        }

                        if (typeof result.data != 'undefined' && result.data != null) {
                            $('#set-agent-review').modal('hide');
                            msgshowfewsecond('Your feedback successfully send.');
                            location.reload();
                        }

                    },
                    error: function(data) {
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
        /*survey*/
        function add_ask_list_question(id) {

            // publicConnection();

            var postque = agent_question[id];
            $.ajax({
                url: "{{ url('/shared/data/insert') }}",
                type: 'post',
                data: {
                    notification_type: 1,
                    notification_message: '{{ $userdetails->name }} asked questions related to your post `{{ $post->posttitle }}`',
                    shared_type: 1,
                    shared_item_id: id,
                    shared_item_type: 1,
                    shared_item_type_id: '{{ $post->post_id }}',
                    receiver_id: '{{ $post->agents_user_id }}',
                    receiver_role: '{{ $post->agents_users_role_id }}',
                    sender_id: '{{ $user->id }}',
                    sender_role: '{{ $user->agents_users_role_id }}',
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    $('.imgloader_' + id).show();
                    $('.clicksurvey_' + id + ' span').hide();
                },
                success: function(result) {
                    $('.imgloader_' + id).hide();
                    $('.clicksurvey_' + id + ' span').show();
                    $('.clicksurvey_' + id).html(
                        '<span href="#" class="margin cursor green pull-right" onclick="add_ask_list_question_remove(' +
                        id + ',' + result.data +
                        ');"> <i class="fa fa-check-circle-o"> </i> <strong>Asked</strong> </span>');
                    msgshowfewsecond(postque.question + ' is shared successfully.');
                },
                error: function(result) {
                    $('.clicksurvey_' + id).hide();
                    $('.clicksurvey_' + id + ' span').show();
                }
            });
        }

        function add_ask_list_question_remove(id, shared_id) {
            var postque = agent_question[id];
            $.ajax({
                url: "{{ url('/shared/data/delete') }}",
                type: 'post',
                data: {
                    id: id,
                    shared_id: shared_id,
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    $('.imgloader_' + id).show();
                    $('.clicksurvey_' + id + ' span').hide();
                },
                success: function(result) {
                    $('.imgloader_' + id).hide();
                    $('.clicksurvey_' + id + ' span').show();
                    $('.clicksurvey_' + id).html(
                        '<span href="#" class="margin cursor pull-right" onclick="add_ask_list_question(' +
                        id +
                        ');"> <i class="fa fa-circle-o" aria-hidden="true"></i> <strong>Ask</strong> </span>'
                    );
                    msgshowfewsecond(postque.question + ' successfully remove in shared list.');
                },
                error: function(result) {
                    $('.clicksurvey_' + id).hide();
                    $('.clicksurvey_' + id + ' span').show();
                }
            });
        }

        /*load proposal */
        function loadproposal(limit) {

            $.ajax({
                url: "{{ url('/') }}/get/proposal/with/shared/" + limit,
                type: 'post',
                data: {
                    shared_item_type: 1,
                    _token: '{{ csrf_token() }}',
                    sender_id: '{{ $user->id }}',
                    sender_role: '{{ $user->agents_users_role_id }}',
                    receiver_id: '{{ $post->agents_user_id }}',
                    receiver_role: '{{ $post->agents_users_role_id }}',
                    post_id: '{{ $post->post_id }}'
                },
                beforeSend: function() {
                    $(".loadproposal").show();
                },
                processData: true,
                success: function(result) {

                    var proppos = result[0];
                    var sharedpro = result[1];

                    $(".loadproposal").hide();
                    if (proppos.count !== 0) {

                        $.each(proppos.result, function(key, value) {
                            proposale_data[value.proposals_id] = value;
                            var pp = value.proposals_id;
                            var shareproposals = sharedpro[pp];
                            var extension = value.proposals_attachments.substr((value
                                .proposals_attachments.lastIndexOf('.') + 1));
                            extension = extension.toLowerCase();
                            if (shareproposals != null && shareproposals != 'undefined' &&
                                shareproposals) {
                                var classactive = 'proposal-active';
                                var asrvfun = '<i onclick="shareproposalremove(' + value.proposals_id +
                                    ',' + shareproposals.shared_id +
                                    ')"  aria-hidden="true" class="icon-custom rounded-x icon-line fa fa-times proposal-icon"></i>';
                            } else {
                                var classactive = '';
                                var asrvfun = '<i onclick="shareproposal(' + value.proposals_id +
                                    ')"  aria-hidden="true" class="icon-custom rounded-x icon-line fa fa-share-alt proposal-icon"></i>';
                            }
                            var htmll = '<div class="col-md-4">' +
                                '<div class="thumbnails ' + classactive + ' proposal_' + value
                                .proposals_id + ' thumbnail-style box-shdow thumbnail-kenburn">' +
                                '<span class="proposal_share_' + value.proposals_id + '">' + asrvfun +
                                '</span>' +
                                '<div class="cbp-caption thumbnail-img">' +
                                '<div class="overflow-hidden cbp-caption-defaultWrap">';

                            if (extension == 'png' || extension == 'jpg' || extension == 'jpeg' ||
                                extension == 'gif' || extension == 'tif') {
                                htmll += '<img 		class="documen document_' + value.proposals_id +
                                    '" src="' + value.proposals_attachments +
                                    '" frameborder="0" scrolling="no" width="246" height="182px">';
                            } else {
                                htmll += '<iframe 	class="documen document_' + value.proposals_id +
                                    '" src="https://docs.google.com/viewer?url=' + value
                                    .proposals_attachments +
                                    '&embedded=true" frameborder="0" scrolling="no" width="246" height="176"></iframe>';
                            }

                            htmll += '</div>' +
                                '<div class="removehover cbp-caption-activeWrap">' +
                                '<div class="cbp-l-caption-alignCenter">' +
                                '<div class="cbp-l-caption-body">' +
                                '<ul class="link-captions no-bottom-space">' +
                                '<li><a class="cursor" onclick="openpropop(' + value.proposals_id +
                                ')"><i class="rounded-x fa fa-search"></i></a>' +
                                '</ul>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +

                                '<div class="caption cbp-title-dark border-top">' +
                                '<span class="cbp-l-grid-agency-title proposal-title"><a class="hidetext1line cursor hover-effect"><strong>' +
                                value.proposals_title + '</strong></a></span>' +
                                '</div>' +

                                '</div>' +
                                '</div>';
                            $('#append-proposal-ajax').append(htmll);
                        });
                        if (proppos.next != 0) {
                            $('#loadmoreproposal').removeClass('hide').attr('title', proppos.next);
                        } else {
                            $('#loadmoreproposal').addClass('hide');
                        }
                    }

                },
                error: function(data) {
                    $(".loadproposal").hide();
                    if (data.status == '500') {
                        $('.loadproposal').text(data.statusText).css({
                            'color': 'red'
                        });
                    } else if (data.status == '422') {
                        $('.loadproposal').text(data.responseJSON.image[0]).css({
                            'color': 'red'
                        });
                    }
                }
            });
        }

        function openpropop(id) {
            var ee = $('.document_' + id).get();
            var text = proposale_data[id].proposals_title;
            $('.proposal-popup-title').text(text);
            $('.append-src-ifram').html(ee[0].outerHTML);
            $('#open-proposal-popup').modal('show');

        }

        function shareproposal(id) {

            // publicConnection();

            var postque = proposale_data[id];
            $('.proposal_' + id).addClass('proposal-active');
            $.ajax({
                url: "{{ url('/shared/data/insert') }}",
                type: 'post',
                data: {
                    notification_type: 3,
                    notification_message: '{{ $userdetails->name }} share a proposal related to your post `{{ $post->posttitle }}`',
                    shared_type: 3,
                    shared_item_id: id,
                    shared_item_type: 1,
                    shared_item_type_id: '{{ $post->post_id }}',
                    receiver_id: '{{ $post->agents_user_id }}',
                    receiver_role: '{{ $post->agents_users_role_id }}',
                    sender_id: '{{ $user->id }}',
                    sender_role: '{{ $user->agents_users_role_id }}',
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    $('.proposal_share_' + id).html('<i onclick="shareproposalremove(' + id + ',' + result
                        .data +
                        ')"  aria-hidden="true" class="icon-custom rounded-x icon-line fa fa-times proposal-icon"></i>'
                    );
                    msgshowfewsecond('This proposal is shared successfully.');
                },
                error: function(result) {
                    $('.proposal_' + id).removeClass('proposal-active');
                }
            });

        }

        function shareproposalremove(id, shared_id) {

            var postque = proposale_data[id];
            $('.proposal_' + id).removeClass('proposal-active');
            $.ajax({
                url: "{{ url('/shared/data/delete') }}",
                type: 'post',
                data: {
                    id: id,
                    shared_id: shared_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    $('.proposal_share_' + id).html('<i onclick="shareproposal(' + id +
                        ')"  aria-hidden="true" class="icon-custom rounded-x icon-line fa fa-share-alt proposal-icon"></i>'
                    );
                    msgshowfewsecond('This proposal successfully remove in your shared list.');
                },
                error: function(result) {
                    $('.proposal_' + id).addClass('proposal-active');
                }
            });
        }

        /*load uploaded fils */
        function loaduploadshare(limit) {

            $.ajax({
                url: "{{ url('/') }}/get/uploaded/files/with/shared/" + limit,
                type: 'post',
                data: {
                    shared_item_type: 1,
                    _token: '{{ csrf_token() }}',
                    sender_id: '{{ $user->id }}',
                    sender_role: '{{ $user->agents_users_role_id }}',
                    receiver_id: '{{ $post->agents_user_id }}',
                    receiver_role: '{{ $post->agents_users_role_id }}',
                    post_id: '{{ $post->post_id }}'
                },
                beforeSend: function() {
                    $(".loaduploadshare").show();
                },
                processData: true,
                success: function(result) {

                    var proppos = result[0];
                    var sharedpro = result[1];

                    $(".loaduploadshare").hide();
                    if (proppos.count !== 0) {

                        $.each(proppos.result, function(key, value) {
                            uploadfiles_data[value.upload_share_id] = value;
                            var pp = value.upload_share_id;
                            var shareproposals = sharedpro[pp];
                            var extension = value.attachments.substr((value.attachments.lastIndexOf(
                                '.') + 1));
                            extension = extension.toLowerCase();
                            if (shareproposals != null && shareproposals != 'undefined' &&
                                shareproposals) {
                                var classactive = 'proposal-active';
                                var asrvfun = '<i onclick="shareuploadfilesremove(' + value
                                    .upload_share_id + ',' + shareproposals.shared_id +
                                    ')"  aria-hidden="true" class="icon-custom rounded-x icon-line fa fa-times proposal-icon"></i>';
                            } else {
                                var classactive = '';
                                var asrvfun = '<i onclick="shareuploadfiles(' + value.upload_share_id +
                                    ')"  aria-hidden="true" class="icon-custom rounded-x icon-line fa fa-share-alt proposal-icon"></i>';
                            }
                            var htmll = '<div class="col-md-4">' +
                                '<div class="thumbnails ' + classactive + ' uploadfiles_' + value
                                .upload_share_id + ' thumbnail-style box-shdow thumbnail-kenburn">' +
                                '<span class="uploadfiles_share_' + value.upload_share_id + '">' +
                                asrvfun + '</span>' +
                                '<div class="cbp-caption thumbnail-img">' +
                                '<div class="overflow-hidden cbp-caption-defaultWrap">';

                            if (extension == 'png' || extension == 'jpg' || extension == 'jpeg' ||
                                extension == 'gif' || extension == 'tif') {
                                htmll += '<img 		class="documen document_uploadfiles_' + value
                                    .upload_share_id + '" src="' + value.attachments +
                                    '" frameborder="0" scrolling="no" width="246" height="182px">';
                            } else {
                                htmll += '<iframe 	class="documen document_uploadfiles_' + value
                                    .upload_share_id + '" src="https://docs.google.com/viewer?url=' +
                                    value.attachments +
                                    '&embedded=true" frameborder="0" scrolling="no" width="246" height="176"></iframe>';
                            }

                            htmll += '</div>' +
                                '<div class="removehover cbp-caption-activeWrap">' +
                                '<div class="cbp-l-caption-alignCenter">' +
                                '<div class="cbp-l-caption-body">' +
                                '<ul class="link-captions no-bottom-space">' +
                                '<li><a class="cursor" onclick="openuploadfiles(' + value
                                .upload_share_id + ')"><i class="rounded-x fa fa-search"></i></a>' +
                                '</ul>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +

                                '</div>' +
                                '</div>';
                            $('#append-uploaded-files-ajax').append(htmll);
                        });
                        if (proppos.next != 0) {
                            $('#loaduploadandshare').removeClass('hide').attr('title', proppos.next);
                        } else {
                            $('#loaduploadandshare').addClass('hide');
                        }
                    } else {
                        $('#append-uploaded-files-ajax').append("<b>Nothing uploaded yet</b>");
                    }

                },
                error: function(data) {
                    $(".loadproposal").hide();
                    if (data.status == '500') {
                        $('.loadproposal').text(data.statusText).css({
                            'color': 'red'
                        });
                    } else if (data.status == '422') {
                        $('.loadproposal').text(data.responseJSON.image[0]).css({
                            'color': 'red'
                        });
                    }
                }
            });
        }

        function openuploadfiles(id) {
            var ee = $('.document_uploadfiles_' + id).get();
            $('.proposal-popup-title').text('').text('{{ $userdetails->name }}');
            $('.append-src-ifram').html(ee[0].outerHTML);
            $('#open-proposal-popup').modal('show');

        }

        function openuploadfilesshared(id) {
            var ee = $('.document_uploadfiles_' + id).get();
            $('.proposal-popup-title').text('').text('{{ ucfirst($post->name) }} Shared Files');
            $('.append-src-ifram').html(ee[0].outerHTML);
            $('#open-proposal-popup').modal('show');

        }

        function shareuploadfiles(id) {

            // publicConnection();

            $('.uploadfiles_' + id).addClass('proposal-active');
            $.ajax({
                url: "{{ url('/shared/data/insert') }}",
                type: 'post',
                data: {
                    notification_type: 2,
                    notification_message: '{{ $userdetails->name }} share a files related to your post `{{ $post->posttitle }}`',
                    shared_type: 2,
                    shared_item_id: id,
                    shared_item_type: 1,
                    shared_item_type_id: '{{ $post->post_id }}',
                    receiver_id: '{{ $post->agents_user_id }}',
                    receiver_role: '{{ $post->agents_users_role_id }}',
                    sender_id: '{{ $user->id }}',
                    sender_role: '{{ $user->agents_users_role_id }}',
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    $('.uploadfiles_share_' + id).html('<i onclick="shareuploadfilesremove(' + id + ',' + result
                        .data +
                        ')"  aria-hidden="true" class="icon-custom rounded-x icon-line fa fa-times proposal-icon"></i>'
                    );
                    msgshowfewsecond('Shared the documents successfully');
                },
                error: function(result) {
                    $('.uploadfiles_' + id).removeClass('proposal-active');
                }
            });

        }

        function shareuploadfilesremove(id, shared_id) {
            $('.uploadfiles_' + id).removeClass('proposal-active');
            $.ajax({
                url: "{{ url('/shared/data/delete') }}",
                type: 'post',
                data: {
                    id: id,
                    shared_id: shared_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    $('.uploadfiles_share_' + id).html('<i onclick="shareuploadfiles(' + id +
                        ')"  aria-hidden="true" class="icon-custom rounded-x icon-line fa fa-share-alt proposal-icon"></i>'
                    );
                    msgshowfewsecond('Document has been removed from shared list.');
                },
                error: function(result) {
                    $('.uploadfiles_' + id).addClass('proposal-active');
                }
            });
        }

        /*Bookmark option question*/
        function add_bookmark_list(id) {

            // publicConnection();

            var qq = sharedquestion_data[id];
            $.ajax({
                url: "{{ url('/bookmark/data/insert') }}",
                type: 'post',
                data: {
                    bookmark_type: 1,
                    bookmark_item_id: id,
                    bookmark_item_parent_id: '{{ $post->post_id }}',
                    receiver_id: '{{ $post->agents_user_id }}',
                    receiver_role: '{{ $post->agents_users_role_id }}',
                    sender_id: '{{ $user->id }}',
                    sender_role: '{{ $user->agents_users_role_id }}',
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    $('.bookmark_q_' + id).html('<span onclick="remove_bookmark_list(' + id + ',' + result
                        .data +
                        ');" data-toggle="tooltip" data-original-title="Bookmarked" class="tooltips fa fa-bookmark sitegreen book_question_' +
                        id + ' bookmarkquestion-icon"></span> ');
                    msgshowfewsecond('successfully bookmark.');
                },
                error: function(result) {

                }
            });
        }

        function remove_bookmark_list(id, bookmark_id) {
            var qq = sharedquestion_data[id];
            $.ajax({
                url: "{{ url('/bookmark/data/delete') }}/" + bookmark_id,
                type: 'get',
                success: function(result) {
                    $('.bookmark_q_' + id).html('<span onclick="add_bookmark_list(' + id +
                        ');" data-toggle="tooltip" data-original-title="Bookmark" class="tooltips fa fa-bookmark-o sitegreen book_question_' +
                        id + ' bookmarkquestion-icon"></span> ');
                    msgshowfewsecond('remove in bookmark list.');
                },
                error: function(result) {}
            });
        }
        /*Bookmark option user*/
        function user_add_bookmark_list() {
            $.ajax({
                url: "{{ url('/bookmark/data/insert') }}",
                type: 'post',
                data: {
                    bookmark_type: 2,
                    bookmark_item_id: '{{ $post->agents_user_id }}',
                    bookmark_item_parent_id: '{{ $post->post_id }}',
                    receiver_id: '{{ $post->agents_user_id }}',
                    receiver_role: '{{ $post->agents_users_role_id }}',
                    sender_id: '{{ $user->id }}',
                    sender_role: '{{ $user->agents_users_role_id }}',
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {

                    $('.bookmark-user').html(
                        '<span class="tooltips cursor btn-block btn btn-default sitegreen" onclick="user_remove_bookmark_list(' +
                        result.data +
                        ');" data-original-title="Bookmarked"><i class="fa fa-star bookmarkquestion-icon"></i> Bookmarked</span>'
                    );
                    msgshowfewsecond('Item is bookmarked');
                },
                error: function(result) {

                }
            });

            // publicConnection();
        }

        function user_remove_bookmark_list(bookmark_id) {
            $.ajax({
                url: "{{ url('/bookmark/data/delete') }}/" + bookmark_id,
                type: 'get',
                success: function(result) {
                    $('.bookmark-user').html(
                        '<span class="tooltips cursor btn-block btn btn-default sitegreen" onclick="user_add_bookmark_list();" data-original-title="Bookmark"><i class="fa fa-star-o bookmarkquestion-icon"></i> Bookmark Post</span>'
                    );
                    msgshowfewsecond('Bookmark is removed');
                },
                error: function(result) {}
            });
        }
        $('#set-answers-notes').on('hidden.bs.modal', function(e) {
            $('#askquestion').modal('show');
        });
        $('#set-answers-notes').on('show.bs.modal', function(e) {
            $('#askquestion').modal('hide');
        });
        $('#set-asked_question-notes').on('hidden.bs.modal', function(e) {
            $('#default_answers').modal('show');
        });
        $('#set-asked_question-notes').on('show.bs.modal', function(e) {
            $('#default_answers').modal('hide');
        });
        window.history.pushState('data', "Title", '{{ url('/search/post/details/') }}/{{ $post->post_id }}');
    </script>
    <!-- payment script -->
    <script>
        $(function() {
            $('form.require-validation').bind('submit', function(e) {
                var $form = $(e.target).closest('form'),
                    inputSelector = ['input[type=email]', 'input[type=number]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault(); // cancel on first error
                    }
                });
            });
        });
        $(function() {
            var $form = $("#payment-form");
            $form.on('submit', function(e) {
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $.ajax({

                        url: "{{ url('/') }}/paymentagents",
                        type: 'POST',
                        data: $form.serialize(),
                        beforeSend: function() {
                            $("#set-payment-loader").show();
                        },
                        processData: false,
                        success: function(result) {
                            $("#set-payment-loader").hide();
                            $('.error-text').text('').addClass('hide').removeClass('show');

                            if (typeof result.error != 'undefined' && result.error != null) {

                                $.each(result.error, function(key, value) {
                                    $('#' + key + '_error').removeClass('hide').addClass('show')
                                        .text(value);
                                });
                            }
                            if (typeof result.normalerror != 'undefined' && result.normalerror !=
                                null) {

                                $('.error').removeClass('hide').find('.alert').text(result.normalerror);
                            }
                            if (typeof result.msg != 'undefined' && result.msg != null) {
                                $('.error').removeClass('hide').find('.alert').removeClass(
                                    'alert-danger').addClass('alert alert-success').html(result.msg);
                                setInterval(function() {
                                    location.reload();
                                }, 10000);
                            }
                        },
                        error: function(data) {
                            $("#set-payment-loader").hide();
                            if (data.status == '500') {
                                $('.error').removeClass('hide').find('.alert').text(data.statusText);
                            } else if (data.status == '422') {
                                $('.error').removeClass('hide').find('.alert').text(data.responseJSON
                                    .image[0]);
                            }
                        }

                    });
                }
            }
            count = 0;

            function process(date) {
                var parts = date.split("/");
                return new Date(parts[2], parts[1] - 1, parts[0]);
            }

            $('#set_closing_date').submit(function(e) {
                e.preventDefault();

                if (count > 0) {
                    // continue to submit the form
                } else {
                    count++;
                    $('.closing_date_warning').html(
                        'Once you save the closing date, you won\'t be able to change it later');
                    $('#closingbtn').html(
                        'Confirm <i class="fa fa-check-circle-o" aria-hidden="true"></i>');
                    return false;
                }

                var $form = $(e.target),
                    esmsg = $('.review-msg-text');
                let closing_date = process($form.find('input[name="closing_date"]').val());
                let post_create_date = process('{{ date('d/m/Y', strtotime($post->created_at)) }}');

                if ((closing_date.getTime() >= post_create_date.getTime()) == false) {
                    $('.closing_date_warning').html(
                        'You can not set closing date before the post was created');
                    return false;
                }

                $.ajax({
                    url: "{{ url('/') }}/addClosingDate",
                    type: 'POST',
                    data: $form.serialize(),
                    beforeSend: function() {
                        $(".set-agent-review-loader").show();
                    },
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        $(".set-agent-review-loader").hide();
                        $('.error-text').text('').removeClass('show').addClass('hide');
                        esmsg.text('').removeClass('show').addClass('hide');

                        if (typeof result.error != 'undefined' && result.error != null) {
                            $.each(result.error, function(key, value) {
                                $('#' + key + '_error').removeClass('success-text hide')
                                    .addClass('error-text show').text(value);
                            });
                        }

                        if (typeof result.status != 2) {
                            $('#set_closing_date').modal('hide');
                            msgshowfewsecond('Your closing date successfully added.');
                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        }
                    },
                    error: function(data) {
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
                key: 'pk_test_51Hso8eG631bdjDJFxxjr69uA3X7qVzFKcGZaCHgORUlQuJ2Cwi5QbUOU9HtMdtsmIl2pTn4dXB2N290L1pZHWBsi00Bj3YoYeB',
                image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                locale: 'auto',
                token: function(token) {
                    // You can access the token ID with `token.id`.
                    // Get the token ID to your server-side code for use.
                }
            });

            function handleToken(token) {
                fetch("{{ url('/') }}/validatepaymentamount", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(token)
                    })
                    .then(response => {
                        if (!response.ok)
                            throw response;
                        return response.json();
                    })
                    .then(output => {
                        if (output.status == 1) {
                            var alert = '<div class="alert alert-success"><strong>Success!</strong>' + output
                                .msg + '</div>';
                            $("#paymentResponse").html(alert);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);


                        } else {
                            var alert = '<div class="alert alert-danger"><strong>Info!</strong>' + output.msg +
                                '</div>';
                            $("#paymentResponse").html(alert);
                        }
                    })
                    .catch(err => {
                        console.log("Purchase failed:", err);
                    })
            }
            $('#make_payment_for_agents').submit(function(e) {
                e.preventDefault();
                var $form = $(e.target),
                    esmsg = $('.review-msg-text');
                console.log($form.serialize());
                $.ajax({
                    url: "{{ url('/') }}/validatepaymentamount",
                    type: 'POST',
                    data: $form.serialize(),
                    beforeSend: function() {
                        $(".set-agent-review-loader").show();
                    },
                    processData: false,
                    success: function(result) {
                        $(".set-agent-review-loader").hide();
                        $('.error-text').text('').removeClass('show').addClass('hide');
                        esmsg.text('').removeClass('show').addClass('hide');

                        if (result.status == 2) {
                            var amount = parseInt($('#amount').val() * 100);
                            handler.open({
                                name: '3% Agent Charges',
                                description: '3% Agent Charges paying to agent.',
                                amount: amount,
                                currency: 'usd',
                                token: handleToken,
                                email: '{{ $user->email }}'
                            });
                            e.preventDefault();
                        }

                        if (typeof result.error != 'undefined' && result.error != null) {
                            $.each(result.error, function(key, value) {
                                $('#' + key + '_error').removeClass('success-text hide')
                                    .addClass('error-text show').text(value);
                            });
                        }

                        if (typeof result.data != 'undefined' && result.data != null) {
                            $('#set-agent-review').modal('hide');
                            msgshowfewsecond('Payment done succeed.');
                            location.reload();
                        }

                    },
                    error: function(data) {
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
    </script>
@stop
