@extends('dashboard.master')

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/pages/page_job_inner.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/pages/shortcode_timeline2.css') }}">

    <style>
        .bs-modal-open {
            overflow: hidden;
        }

        .bs-modal-open .modal {
            overflow-x: hidden;
            overflow-y: auto;
        }

        #rating i {
            cursor: pointer;
        }

        .bs-modal-open {
            @extend .modal-open;
        }
    </style>
@stop

@section('title', 'Agents Search')

@section('content')
    <?php $topmenu = 'Agents'; ?>

    @include('dashboard.include.sidebar')

    <div class="block-description">
        <div class="container">
            <div class="row md-margin-bottom-10">
                <div class="col-md-9">
                    <div class="padding-left-10">
                        @if (isset($agents->photo) && $agents->photo)
                            <img class="img-circle header-circle-img1 img-margin" width="80" height="80"
                                src="{{ URL::asset('assets/img/profile/' . $agents->photo) }}" alt="">
                        @else
                            <img class="img-circle header-circle-img1 img-margin" width="80" height="80"
                                src="{{ URL::asset('assets/img/testimonials/user.jpg') }}" alt="">
                        @endif

                        <div class="padding-top-5">
                            <h2 class="postdetailsh2">
                                {{ ucwords(strtolower($agents->name)) }}
                                <sub class="{{ $agents->login_status }}">{{ $agents->login_status }}</sub>

                                @if ($post[0]->applied_post == 1 && $post[0]->applied_user_id == $agents->id)
                                    <span class="" style="font-size:12px;color:rgb(55, 160, 0);">(Agent
                                        Selected)</span>
                                @endif

                                <span class="sitegreen hidden">
                                    @for ($i = 1; $i <= (int) $avg; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor

                                    @for ($j = (int) $avg; $j < 5; $j++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                </span>
                            </h2>

                            <span class="margin-right-20">
                                <strong>Experience :</strong>
                                {!! $agents->years_of_expreience != '' ? @str_replace('-', ' to ', $agents->years_of_expreience) . ' Year' : '' !!}
                            </span>

                            <span class="margin-right-20">
                                <strong>Broker :</strong> {{ $agents->brokers_name }}
                            </span>

                            <span class="margin-right-20">
                                <strong>Posted</strong>
                                <script type="text/javascript">
                                    document.write(timeDifference(new Date(), new Date(Date.fromISO('{{ $agents->created_at }}'))));
                                </script>
                            </span>

                            <span>
                                <strong><i class="fa fa-map-marker"></i></strong>
                                {{ $agents->city_name }}, {{ $agents->state_name }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <h4 class="hide black" id="sharedbyagent">Shared by : <br> {{ $agents->name }}</h4>

                    <div class="akes-q-buten-appen margin-bottom-10" id="akes-q-buten-appen"></div>
                    <div class="akes-q-buten-appen margin-bottom-10" id="shared-proposal-button"></div>
                    <div class="akes-q-buten-appen" id="shard-upload-files-button"></div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-9">
                    <div class="box-shadow-profile margin-bottom-40">
                        <div class="panel-profile">
                            <div class="left-inner border1-bottom padding-5-20">
                                <h2><strong>Details</strong></h2>

                                <div class="postdetailsdescription">{!! $agents->description !!}</div>
                            </div>

                            @if ($agents->additional_details != null)
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Additional Details</strong></h2>

                                    <div class="postdetailsdescription">{!! $agents->additional_details !!}</div>
                                </div>
                            @endif

                            @if ($agents->skills != '')
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Skills</strong></h2>

                                    <ul class="list-unstyled" id="skills_list"></ul>
                                </div>
                            @endif

                            @if ($agents->certifications != null)
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Certifications</strong></h2>

                                    <ul class="list-unstyled" id="certifications"></ul>
                                </div>
                            @endif

                            @if ($agents->franchise != null)
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Franchise</strong></h2>

                                    <ul class="list-unstyled" id="franchise"></ul>
                                </div>
                            @endif

                            @if ($agents->specialization != null)
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Specialization</strong></h2>

                                    <ul class="list-unstyled" id="specialization"></ul>
                                </div>
                            @endif

                            @if ($agents->associations_awards != null)
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Associations Awards</strong></h2>

                                    <ul class="list-unstyled" id="specialization">
                                        <p>{{ str_replace(',==,', ', ', $agents->associations_awards) }}</p>
                                    </ul>
                                </div>
                            @endif

                            @if ($agents->community_involvement != null)
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Community involvement</strong></h2>

                                    <ul class="list-unstyled" id="specialization">
                                        <p>{{ str_replace(',==,', ', ', $agents->community_involvement) }}</p>
                                    </ul>
                                </div>
                            @endif

                            @if ($agents->publications != null)
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Publications</strong></h2>

                                    <ul class="list-unstyled" id="specialization">
                                        <p>{{ str_replace(',==,', ', ', $agents->publications) }}</p>
                                    </ul>
                                </div>
                            @endif

                            @if (!empty($agents->show_individual_yearly_figures == 1))
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Represented Sales History</strong></h2>

                                    <ul class="list-unstyled">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Year</th>
                                                    <th class="hidden-sm">Sellers</th>
                                                    <th>Buyers</th>
                                                    <th>Total Status</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach (json_decode($agents->sales_history) as $sales)
                                                    <tr>
                                                        <td>{{ $sales->year }}</td>
                                                        <td class="hidden-sm">
                                                            ${{ number_format($sales->buyers_represented) }}</td>
                                                        <td>${{ number_format($sales->sellers_represented) }}</td>
                                                        <td>${{ number_format($sales->total_dollar_sales) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </ul>
                                </div>
                            @elseif ($agents->total_sales != 0)
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Sales History</strong></h2>

                                    <ul class="list-unstyled">
                                        <li>Over all total for 5 years Sales History
                                            ${{ number_format($agents->total_sales) }}</li>
                                    </ul>
                                </div>
                            @endif


                            @if (!empty($agents->language_proficiency != null))
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Language Proficiency</strong></h2>

                                    <ul class="list-unstyled">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Language</th>
                                                    <th class="hidden-sm">Speak</th>
                                                    <th>Read</th>
                                                    <th>Write</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach (json_decode($agents->language_proficiency) as $lang)
                                                    <tr>
                                                        <td>{{ $lang->language }}</td>
                                                        <td class="hidden-sm">{{ $lang->speak }}</td>
                                                        <td>{{ $lang->read }}</td>
                                                        <td>{{ $lang->write }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </ul>
                                </div>
                            @endif


                            @if (!empty($agents->industry_experience != null))
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Industry Experience</strong></h2>

                                    <ul class="timeline-v2 timeline-me">
                                        @foreach (json_decode($agents->industry_experience) as $industry)
                                            <li>
                                                <time datetime="" class="cbp_tmtime">
                                                    <span>{{ $industry->post }}</span>
                                                    <span>{{ str_replace('_', ' ', $industry->from) }} -
                                                        {{ str_replace('_', ' ', $industry->to) }}</span>
                                                </time>

                                                <i class="cbp_tmicon rounded-x hidden-xs"></i>

                                                <div class="cbp_tmlabel">
                                                    <h2>{{ $industry->organization }}</h2>
                                                    <p>{!! $industry->description !!}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif



                            @if (!empty($agents->real_estate_education != ''))
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Real Estate Education</strong></h2>

                                    <ul class="timeline-v2 timeline-me">
                                        @foreach (json_decode($agents->real_estate_education) as $employment)
                                            <li>
                                                <time datetime="" class="cbp_tmtime">
                                                    <span>{{ $employment->degree }}</span>
                                                    <span>{{ str_replace('_', ' ', $employment->from) }} -
                                                        {{ str_replace('_', ' ', $employment->to) }}</span>
                                                </time>

                                                <i class="cbp_tmicon rounded-x hidden-xs"></i>

                                                <div class="cbp_tmlabel">
                                                    <h2>{{ $employment->school }}</h2>
                                                    <p>{!! $employment->description !!}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            @if (!empty($agents->education != ''))
                                <div class="left-inner border1-bottom padding-5-20">
                                    <h2><strong>Non-Real Estate related Education</strong></h2>

                                    <ul class="timeline-v2 timeline-me">
                                        @foreach (json_decode($agents->education) as $employment)
                                            <li>
                                                <time datetime="" class="cbp_tmtime">
                                                    <span>{{ $employment->degree }}</span>
                                                    <span>{{ str_replace('_', ' ', $employment->from) }} -
                                                        {{ str_replace('_', ' ', $employment->to) }}</span>
                                                </time>

                                                <i class="cbp_tmicon rounded-x hidden-xs"></i>

                                                <div class="cbp_tmlabel">
                                                    <h2>{{ $employment->school }}</h2>
                                                    <p>{!! $employment->description !!}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <div class="hidden left-inner border1-bottom padding-5-20">
                                <h2><strong>Rating & Review</strong></h2>

                                @foreach ($blog as $value)
                                    <h4 class="sitegreen">
                                        @for ($i = 1; $i <= $value->star; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor

                                        @for ($j = $value->star; $j < 5; $j++)
                                            <i class="fa fa-star-o"></i>
                                        @endfor
                                    </h4>

                                    <p>{{ $value->comment }}</p>
                                    <p><i class="fa fa-user"></i> {{ ucwords($value->name) }} <i
                                            class="fa fa-calendar"></i>
                                        {{ date('d-m-Y', strtotime($value->created_date)) }}</p>
                                @endforeach

                                <hr>

                                <h4 class="sitegreen" id="rating">
                                    <i class="fa fa-star-o" id="1" onclick="staradd(this.id)"></i>
                                    <i class="fa fa-star-o" id="2" onclick="staradd(this.id)"></i>
                                    <i class="fa fa-star-o" id="3" onclick="staradd(this.id)"></i>
                                    <i class="fa fa-star-o" id="4" onclick="staradd(this.id)"></i>
                                    <i class="fa fa-star-o" id="5" onclick="staradd(this.id)"></i>
                                </h4>

                                <form id="reviewfrm">
                                    <input type="hidden" name="star" id="hid" value="">
                                    <input type="hidden" name="agent_id" id="agent_id" value="{{ $agents->id }}">

                                    <label>Your Comment</label>
                                    <textarea name="comment" class="form-control"></textarea>
                                    <br>
                                    <button class="btn btn-success">Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 sm-margin-bottom-20 grid cs-style-5">
                    <div class="bookmark-user margin-bottom-20">
                        <span class="tooltips cursor btn-block btn btn-default sitegreen"
                            onclick="user_add_bookmark_list();" data-original-title="Bookmark">
                            <i class="fa fa-star-o bookmarkquestion-icon"></i> Bookmark
                        </span>
                    </div>

                    <div class="margin-bottom-20 notebutton"></div>

                    <hr>

                    <a class="btn-u btn-block margin-bottom-20 cursor" id="chat">Connect to Chat</a>
                    <a class="btn-u btn-block margin-bottom-20 cursor" id="message">Connect to Message</a>

                    @if (count($post) == 1)
                        @if ($post[0]->applied_post == 2)
                            <hr>
                            @foreach ($post as $postdata)
                                <select>
                                    <option class="clickpostidchange" value="{{ $postdata->post_id }}">{{ $postdata->posttitle }}</option>
                                </select>
                            @endforeach
                            <h3 class="black">POST: <br>{!! ucfirst($post[0]->posttitle) !!}</h3>
                            <button class="btn-block btn btn-default agentsselectbutton"
                                onclick="select_agent_for_post('{{ $post[0]->post_id }}','{{ $agents->details_id }}','{{ ucwords($agents->name) }}');">
                                Select for post
                            </button>
                            <div class="addselectedagentsbutton"></div>
                        @endif

                        @if ($post[0]->applied_post == 1 && $post[0]->applied_user_id == $agents->id)
                            <hr>
                            <a class="btn-link">Already selected this agent for the post.</a>
                            {{-- <a class="btn-link">Selected agent this post ({{ $post[0]->posttitle }})</a> --}}
                        @endif
                    @endif

                    <hr>

                    <h3 class="black">Share to: <br>{!! ucfirst($agents->name) !!}</h3>

                    <button class="btn-block btn btn-default sitegreen margin-bottom-20" data-toggle="modal"
                        id="askquestion-model" data-target="#askquestion">
                        <i class="fa fa-question-circle bookmarkquestion-icon"></i> Ask Question
                    </button>

                    <button class="btn-block btn btn-default sitegreen margin-bottom-20" data-toggle="modal"
                        data-target="#uploaded-files-share">
                        <i class="fa fa-file bookmarkquestion-icon"></i> Uploaded Files
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Ask Question Popup --}}
    <div class="modal fade" id="askquestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="top:0 !important;bottom:0 !important;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel4">Ask Question For Post</h4>
                </div>

                <div class="modal-body profile padding-0">
                    <div class="tab-v1">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#allquestion" data-toggle="tab">Questions</a></li>
                            <li><a href="#importancequestion" data-toggle="tab">Importance</a></li>
                            <li><a href="#new-question" data-toggle="tab">Add Question</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="allquestion">
                                <div id="allquestionslist" class="sky-form"></div>
                            </div>

                            <div class="tab-pane fade" id="importancequestion">
                                <div id="importantquestionslist" class="sky-form"></div>
                            </div>

                            <div class="tab-pane fade" id="new-question">
                                <form action="#" method="POST" class="sky-form" id="add-new-question">
                                    @csrf

                                    <fieldset>
                                        <div class="body-overlay-popup body-overlay">
                                            <div>
                                                <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px"
                                                    height="64px" />
                                            </div>
                                        </div>

                                        <div class="hide Question-add-msg"></div>

                                        <section>
                                            <label class="label">Ask Question</label>
                                            <label class="textarea">
                                                <textarea rows="2" class="field-border" name="question" id="Question_id" placeholder="Enter Question"></textarea>
                                                <b class="error-text" id="question_error"></b>
                                            </label>
                                        </section>

                                        <section class="row">
                                            <div class="col col-6">
                                                <label class="label weight">Add question to Survey?</label>

                                                <div class="inline-group">
                                                    <label class="radio">
                                                        <input type="radio" name="survey" class="survey_1"
                                                            value="1"><i class="rounded-x"></i>Yes
                                                    </label>

                                                    <label class="radio">
                                                        <input type="radio" name="survey" class="survey_2"
                                                            value="0" checked><i class="rounded-x"></i>No
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col col-6">
                                                <label class="label weight">Add question to Importance?</label>

                                                <div class="inline-group">
                                                    <label class="radio">
                                                        <input type="radio" name="importance1" value="1"><i
                                                            class="rounded-x"></i>Yes
                                                    </label>

                                                    <label class="radio">
                                                        <input type="radio" name="importance1" value="0"
                                                            checked><i class="rounded-x"></i>No
                                                    </label>
                                                </div>
                                            </div>
                                        </section>
                                    </fieldset>

                                    <input type="hidden" value="{{ $agents->agents_users_role_id }}"
                                        name="question_type">
                                    <input type="hidden" value="1" name="ask_question">
                                    <input type="hidden" value="{{ $user->id }}" name="add_by">
                                    <input type="hidden" value="{{ $user->agents_users_role_id }}" name="add_by_role">

                                    <footer>
                                        <button type="submit" class="btn-u btn-u-primary pull-right"
                                            name="edit-profile-submit" value="Save changes"
                                            title="Save changes">Submit</button>
                                    </footer>
                                </form>
                            </div>

                            <div class="tab-pane fade profile-body" id="asked_question_answer">
                                <div id="asked_question_answer_list" class="sky-form">

                                </div>
                                <div class="body-existingquestionslist-popup body-overlay">
                                    <div>
                                        <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px"
                                            height="64px" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Set Answers Notes Popup --}}
    <div class="modal fade" id="set-answers-notes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" style="display:grid;">
            <div class="modal-content not-top sky-form">
                <div id="set-answers-notes-loader" class="body-overlay col-md-12 center loder set-answers-notes-loader">
                    <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" />
                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title set-answers-notes-title"></h4>
                </div>

                <div class="modal-body">
                    <div class="set-answers-notes-body">
                        <p class="notes-msg-text green"></p>

                        <section>
                            <label class="label">Enter Your Note</label>
                            <label class="textarea">
                                <textarea rows="2" class="field-border jqte-test" name="notes_textarea_answers" id="notes_textarea_answers"
                                    placeholder="Enter Notes"></textarea>
                                <b class="error-text" id="notes_textarea_answers_error"></b>
                            </label>
                        </section>
                    </div>
                </div>

                <div class="modal-footer" id="notes-answers-form-footer"></div>
            </div>
        </div>
    </div>

    {{-- Asked Question For Post Popup --}}
    <div class="modal fade" id="default_answers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="top:0 !important;bottom:0 !important;">
                <form action="#" id="enters-default-answers-submit" method="POST">
                    @csrf

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel4">{{ ucfirst($agents->name) }} Asked Question for Your Post</h4>
                    </div>

                    <div class="modal-body padding-0">
                        <div class="question-msg hide"></div>
                        <div id="enters-default-answers" class="sky-form"></div>

                        <div class="load-agent-ask-question body-overlay">
                            <div>
                                <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" />
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer margin-0">
                        <button type="submit" class="btn-u ladda-button pull-right">Send</button><br>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Add Asked Questions Note Popup --}}
    <div class="modal fade" id="set-asked_question-notes" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="display:grid;">
            <div class="modal-content not-top sky-form">
                <div id="set-asked_question-notes-loader"
                    class="body-overlay col-md-12 center loder set-asked_question-notes-loader">
                    <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" />
                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title set-asked_question-notes-title"></h4>
                </div>

                <div class="modal-body">
                    <div class="set-asked_question-notes-body">
                        <p class="notes-msg-text green"></p>

                        <section>
                            <label class="label">Enter Your Note</label>
                            <label class="textarea">
                                <textarea rows="2" class="field-border jqte-test" name="notes_textarea_asked_question"
                                    id="notes_textarea_asked_question" placeholder="Enter Notes"></textarea>
                                <b class="error-text" id="notes_textarea_asked_question_error"></b>
                            </label>
                        </section>
                    </div>
                </div>

                <div class="modal-footer" id="notes-asked_question-form-footer"></div>
            </div>
        </div>
    </div>

    {{-- Select Post For Work Popup --}}
    @if ($post_id == null && count($post) > 1)
        <div class="modal fade in" id="postcheck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true" style="display:block;background-color:#4343437d;">
            <div class="modal-dialog">
                <div class="modal-content post_work">
                    <div id="body-overlay" class="body-overlay">
                        <div>
                            <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px">
                        </div>
                    </div>

                    <form action="#" class="sky-form" method="POST">
                        @csrf

                        <div class="modal-header">
                            <h4 class="modal-title text-center">Select Post For Work {{ ucfirst($agents->name) }}</h4>
                        </div>

                        <div class="modal-body">
                            <section>
                                <div class="row">
                                    <div class="col col-12">
                                        @foreach ($post as $postdata)
                                            <label class="radio">
                                                <input type="radio" name="clickpostidchange" class="clickpostidchange"
                                                    value="{{ $postdata->post_id }}"><i></i>{{ $postdata->posttitle }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="modal-footer"></div>
                    </form>
                </div>
            </div>
        </div>
    @endif


    {{-- Share Uploaded Files Popup --}}
    <div class="modal fade bs-example-modal-lg" id="uploaded-files-share" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="top:0 !important;bottom:0 !important;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Share Uploaded files</h4>
                </div>

                <div class="modal-body">
                    <div class="panel-body row">
                        <div id="append-uploaded-files-ajax"></div>

                        <div id="loaduploadshare" class="col-md-12 center loder loaduploadshare">
                            <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" />
                        </div>

                        <div class="center col-md-12 btn-buy animated fadeInRight">
                            <a id="loaduploadandshare" class="cursor hide"><i class="fa fa-spinner"></i> load
                                more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Shared Files Popup --}}
    <div class="modal fade bs-example-modal-lg" id="uploaded-files-shared" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="top:0 !important;bottom:0 !important;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">{{ ucfirst($agents->name) }} Shared Files</h4>
                </div>

                <div class="modal-body">
                    <div class="panel-body row">
                        <div id="append-uploaded-shared-files-ajax"></div>

                        <div id="loaduploadshared" class="col-md-12 center loder loaduploadshared">
                            <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" />
                        </div>

                        <div class="center col-md-12 btn-buy animated fadeInRight">
                            <a id="loaduploadandshared" class="cursor hide"><i class="fa fa-spinner"></i> load
                                more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Proposal Shared Popup --}}
    <div class="modal fade bs-example-modal-lg" id="proposals-shared" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="top:0 !important;bottom:0 !important;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">{{ ucfirst($agents->name) }} Shared Proposal</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body row">
                        <div id="append-proposals-shared-ajax"></div>
                        <div id="loadproposalsshared" class="col-md-12 center loder loadproposalsshared">
                            <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" />
                        </div>
                        <div class="center col-md-12 btn-buy animated fadeInRight">
                            <a id="loadproposalsandshared" class="cursor hide"><i class="fa fa-spinner"> </i> load
                                more </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Proposal Notes Popup --}}
    <div class="modal fade " id="set-proposal-notes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " style="display:grid;">
            <div class="modal-content not-top sky-form">
                <div id="set-proposal-notes-loader" class="body-overlay col-md-12 center loder set-proposal-notes-loader">
                    <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" />
                </div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title set-proposal-notes-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="set-proposal-notes-body">
                        <p class="notes-msg-text green"></p>
                        <section>
                            <label class="label"> Enter Your Note</label>
                            <label class="textarea">
                                <textarea rows="2" class="field-border jqte-test" name="notes_textarea_proposal" id="notes_textarea_proposal"
                                    placeholder="Enter Notes"></textarea>
                                <b class="error-text" id="notes_textarea_proposal_error"></b>
                            </label>
                        </section>
                    </div>
                </div>
                <div class="modal-footer" id="notes-proposal-form-footer">
                </div>
            </div>
        </div>
    </div>

    {{-- Add User Notes Popup --}}
    <div class="modal fade " id="set-users-notes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " style="display:grid;">
            <div class="modal-content not-top sky-form">
                <div id="set-users-notes-loader" class="body-overlay col-md-12 center loder set-users-notes-loader">
                    <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" />
                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title set-users-notes-title">{{ ucfirst($agents->name) }}</h4>
                </div>

                <div class="modal-body">
                    <div class="set-users-notes-body">
                        <p class="notes-msg-text green"></p>
                        <section>
                            <label class="label"> Enter Your Note</label>
                            <label class="textarea">
                                <textarea rows="2" class="field-border jqte-test" name="notes_textarea_users" id="notes_textarea_users"
                                    placeholder="Enter Notes"></textarea>
                                <b class="error-text" id="notes_textarea_users_error"></b>
                            </label>
                        </section>
                    </div>
                </div>
                <div class="modal-footer" id="notes-users-form-footer">
                </div>
            </div>
        </div>
    </div>

    {{-- Open Proposal Popup --}}
    <div class="modal fade bs-example-modal-lg" id="open-proposal-popup" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content not-top">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title proposal-popup-title">{{ ucfirst($userdetails->name) }}</h4>
                </div>
                <div class="modal-body append-src-ifram">
                </div>
            </div>
        </div>
    </div>

    @if (0)
        <div class="modal fade" id="uploadsharedeleteconfirm" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content not-top">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Confirm Selected agent for post</h4>
                    </div>
                    <div class="modal-body">
                        <br>
                        <div class="body-overlay">
                            <div>
                                <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" />
                            </div>
                        </div>
                        <div id="upload-delete-msg">
                        </div>
                        <p class="prompt_message">Are you sure this question remove in survey list.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-u btn-u-primary" id="confirm-prompt">Yes I'm Sure</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop

@section('scripts')
    <script type="text/javascript">
        function staradd(id) {
            var sid = parseInt(id);
            $("#hid").val(sid);
            var i = 1;

            $("#rating i").each(function(index, el) {
                if (i <= sid) {
                    $(this).removeClass('fa-star-o').addClass('fa-star');
                    i++;
                } else {
                    $(this).removeClass('fa-star').addClass('fa-star-o');
                }
            });
        }

        var agent_question = [];
        var share_question_return_answer = [];
        var uploadfiles_data = [];
        var shareduploadfiles_data = [];
        var sharedproposale_data = [];
        var sharedquestion_data = [];
        var agents_data = [];
        var post_id = '{{ $post[0]->post_id ?? '' }}';

        agents_data[{{ $agents->id }}] = {
            id: '{{ $agents->id }}',
            photo: '{{ $agents->photo }}',
            name: '{{ $agents->name }}',
            description: '{{ $agents->description }}',
            agents_users_role_id: '{{ $agents->agents_users_role_id }}',
        };

        function publicConnection() {
            $.ajax({
                url: "{{ url('/users/public/Connection') }}",
                type: 'post',
                data: {
                    post_id: post_id,
                    from_id: '{{ $agents->id }}',
                    from_role: '{{ $agents->agents_users_role_id }}',
                    to_id: '{{ $user->id }}',
                    to_role: '{{ $user->agents_users_role_id }}',
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {},
                error: function(result) {}
            });
        }


        function select_agent_for_post(post_id, agent_id, name) {
            $('.agentsselectbutton').addClass('hide');
            $('#upload-delete-msg').addClass('hide');

            if (!confirm(`Are you sure that [${name}] should be chosen for the post.`) == true) {
                $('.agentsselectbutton').removeClass('hide');
                return false;
            }

            $.ajax({
                url: "{{ Route('SelectAgentForPost') }}",
                type: 'POST',
                data: {
                    post_id: post_id,
                    agent_id: agent_id,
                },
                beforeSend: function() {
                    $(".body-overlay").show();
                },
                success: function(result) {
                    $(".body-overlay").hide();
                    msgshowfewsecond(`${name} successfully selected for this post.`);

                    // $('.addselectedagentsbutton').html(
                    //     '<a class="btn-link">Selected agent this post ({{ @$post[0]->posttitle }})</a>'
                    // );
                    // $('.agentsselectbutton').remove();
                },
                error: function(data) {
                    $(".body-overlay").hide();
                }
            });
        }


        function selectagentforpost_jk_bk(post_id, agentid, name) {
            publicConnection();

            $('#upload-delete-msg').addClass('hide');
            $('.prompt_message').html(`Are you sure that (${name}) should be chosen for the post.`);

            $('#uploadsharedeleteconfirm')
                .modal({
                    backdrop: 'static',
                    keyboard: false
                })
                .one('click', '#confirm-prompt', function(e) {
                    $.ajax({
                        url: "{{ url('/') }}/appliedagents/" + post_id + '/' + agentid,
                        type: 'get',
                        processData: false,
                        beforeSend: function() {
                            $(".body-overlay").show();
                        },
                        success: function(result) {
                            $(".body-overlay").hide();
                            msgshowfewsecond(name + ' successfully selected for this post.');

                            $('#uploadsharedeleteconfirm').modal('hide');
                            $('.addselectedagentsbutton').html(
                                '<a class="btn-link">Selected agent this post ({{ @$post[0]->posttitle }})</a>'
                            );
                            $('.agentsselectbutton').remove();
                        },

                        error: function(data) {
                            $(".body-overlay").hide();
                        }
                    });
                });
        }

        $(document).ready(function() {
            $("#reviewfrm").submit(function(event) {
                event.preventDefault();

                $.ajax({
                        url: "{{ route('comment.addcomment') }}",
                        type: 'POST',
                        dataType: 'json',
                        data: $("#reviewfrm").serialize()
                    })
                    .done(function(data) {
                        if (data.success == 'ok') {
                            location.reload();
                        } else {
                            alert('You can not comment again.');
                        }
                    })
                    .fail(function() {
                        console.log("error");
                    });
            });

            @if ('{{ count($post) }}' == 1)
                loadquestion();
                loadaskedquestionandansuwer();

                $('.notebutton').html(
                    '<span class="tooltips cursor btn-block btn btn-default sitegreen" onclick="setnotesinusers(\'{{ $agents->id }}\',' +
                    post_id +
                    ');" data-original-title="Note"><i class="fa fa-commenting bookmarkquestion-icon"></i> Note</span> '
                );
            @endif

            /*skills*/
            if ('{{ $agents->skills }}' != '') {
                $.ajax({
                    url: "{{ url('/skills/get') }}",
                    type: 'POST',
                    data: {
                        skill_id: '{{ $agents->skills }}',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        var apen = $('#skills_list');

                        $.each(result, function(key, val) {
                            var htm = '<li class="skill-lable label label-success">' + val
                                .skill + '</li>';
                            apen.append(htm);
                        });
                    }
                });
            }

            if ('{{ $agents->specialization }}' != '') {
                $.ajax({
                    url: "{{ url('/skills/get') }}",
                    type: 'POST',
                    data: {
                        skill_id: '{{ $agents->specialization }}',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        var apen = $('#specialization');
                        $.each(result, function(key, val) {
                            var htm = '<li class="skill-lable label label-success">' + val
                                .skill + '</li>';
                            apen.append(htm);
                        });
                    }
                });
            }

            if ('{{ $agents->certifications }}' != '') {
                $.ajax({
                    url: "{{ url('/certifications/get') }}",
                    type: 'POST',
                    data: {
                        certifications_id: '{{ $agents->certifications }}',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        var apen = $('#certifications');

                        $.each(result, function(key, val) {
                            var htm = '<li class="skill-lable label label-success">' + val
                                .certifications_description + '</li>';
                            apen.append(htm);
                        });
                    }
                });
            }

            if ('{{ $agents->franchise }}' != null) {
                var franchise = '{{ $agents->franchise }}';

                if (franchise != 'other') {
                    $.ajax({
                        url: "{{ url('/franchise/get') . '/' . $agents->franchise }}",
                        type: 'get',
                        success: function(result) {
                            var apen = $('#franchise');

                            if (result[0] != null) {
                                var htm = '<li class="skill-lable label label-success">' + result[0]
                                    .franchise_name + '</li>';
                            }

                            apen.append(htm);
                        }
                    });
                } else {
                    $('#franchise').html(
                        '<li class="skill-lable label label-success"> {{ $agents->other_franchise }} </li>'
                    );
                }
            }

            $('.clickpostidchange').click(function(e) {
                $('#postcheck').addClass('hide').css('background', '#fff');
                post_id = $(this).val();

                window.location.href =
                    `{{ URL('/search/agents/details/') }}/{{ $agents->id }}/${post_id}`;
            });

            $('#add-new-question').submit(function(e) {
                e.preventDefault();

                var $form = $(e.target),
                    esmsg = $(".Question-add-msg");

                $.ajax({
                    url: "{{ url('/') }}/insertquestion",
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
                            msgshowfewsecond(result.msg);

                            var val = result.data;
                            agent_question[val.question_id] = val;

                            if (val.importance == 1) {
                                key = $('.askquestioncount_buyer').length + 1;
                                var utyp = 'buyer';
                                var apen = $('#importantquestionslist');
                                var htm = '<div class="askquestioncount_' + utyp + '">' +
                                    '<div class="panel-group margin-0" id="accordion-' +
                                    utyp +
                                    '-' + key + '">' +
                                    '<div class="panel-heading border1-bottom">' +
                                    '<h4 class="text-15 panel-title position-r question-title">' +
                                    '<span>' + key + ') </span>' +
                                    '<a class="question-question q-s-' + val.question_id +
                                    '">' + val.question + '</a>' +
                                    '<img class="ovloader imgloader_' + val.question_id +
                                    ' pull-right" src="{{ url('/assets/img/loder/loading.gif') }}" width="15px" height="15px" >' +
                                    '<span class="text-13 clicksurvey_' + val.question_id +
                                    '">' +
                                    '<span href="#" class="margin cursor pull-right" onclick="add_ask_list_question(' +
                                    val.question_id +
                                    ');"> <i class="fa fa-circle-o" aria-hidden="true"></i> <strong>Ask</strong> </span>' +
                                    '</span>' +
                                    '</h4>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';

                                apen.append(htm);
                            }

                            key = $('.askquestioncount_seller').length + 1;
                            var utyp = 'seller';
                            var apen = $('#allquestionslist');
                            var htm = '<div class="askquestioncount_' + utyp + '">' +
                                '<div class="panel-group margin-0" id="accordion-' + utyp +
                                '-' + key + '">' +
                                '<div class="panel-heading border1-bottom">' +
                                '<h4 class="text-15 panel-title position-r question-title">' +
                                '<span>' + key + ') </span>' +
                                '<a class="question-question q-s-' + val.question_id +
                                '">' +
                                val.question + '</a>' +
                                '<img class="ovloader imgloader_' + val.question_id +
                                ' pull-right" src="{{ url('/assets/img/loder/loading.gif') }}" width="15px" height="15px" >' +
                                '<span class="text-13 clicksurvey_' + val.question_id +
                                '">' +
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
            $('#enters-default-answers-submit').submit(function(e) {
                e.preventDefault();

                // publicConnection();


                var $form = $(e.target),
                    esmsg = $(".question-msg");

                $.ajax({
                    url: "{{ url('/') }}/allsubmitquestiontoanswer",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: $form.serialize(),
                    beforeSend: function() {
                        $(".load-agent-ask-question").show();
                    },
                    success: function(result) {
                        $(".load-agent-ask-question").hide();

                        if (typeof result.msg != 'undefined' && result.msg != null) {
                            esmsg.text('').addClass('hide');
                            msgshowfewsecond(result.msg);
                        }
                    },
                    error: function(data) {
                        $(".load-agent-ask-question").hide();

                        if (data.status == '500') {
                            esmsg.text("Please fill this feild.").css({
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

            $('#message').click(function(e) {
                // publicConnection();
                localStorage.clear();
                window.location.href = "{{ URL('/') }}/messages/" + post_id +
                    "/{{ $agents->id }}/{{ $agents->agents_users_role_id }}";
            });

            $('#chat').click(function(e) {
                // publicConnection();
                register_popup(post_id, '{{ $agents->id }}',
                    '{{ $agents->agents_users_role_id }}');
            });

            $('#loaduploadandshare').click(function(e) {
                e.preventDefault();
                var limit = $(this).attr('title');
                loaduploadshare(limit);
            });

            loaduploadshare(0);

            /* user get bookmarked */
            $.ajax({
                url: "/bookmarked/get/{{ $user->id }}/{{ $user->agents_users_role_id }}/2/{{ $agents->id }}/" +
                    post_id,
                type: 'get',
                success: function(result) {
                    if (result.bookmark_id != null && result.bookmark_id != 'undefined') {
                        var html =
                            '<span class="tooltips cursor btn-block btn btn-default sitegreen" onclick="user_remove_bookmark_list(' +
                            result.bookmark_id +
                            ');" data-original-title="Bookmarked"><i class="fa fa-star bookmarkquestion-icon"></i> Bookmarked</span>';
                    } else {
                        var html =
                            '<span class="tooltips cursor btn-block btn btn-default sitegreen" onclick="user_add_bookmark_list();" data-original-title="Bookmark"><i class="fa fa-star-o bookmarkquestion-icon"></i> Bookmark</span>';
                    }

                    $('.bookmark-user').html(html);
                }
            });
        });

        function loadquestion() {
            $.ajax({
                url: "{{ url('/question/get/only/user') }}",
                type: 'POST',
                data: {
                    rating: 'rating',
                    bookmark: 'bookmark',
                    shared_item_type: 2,
                    _token: '{{ csrf_token() }}',
                    add_by: '{{ $user->id }}',
                    add_by_role: '{{ $user->agents_users_role_id }}',
                    question_type: '{{ $agents->agents_users_role_id }}',
                    post_id: post_id,
                    receiver_id: '{{ $agents->id }}',
                    share: 'ask_question'
                },
                beforeSend: function() {
                    $(".body-existingquestionslist-popup").show();
                },
                success: function(result) {
                    $(".body-existingquestionslist-popup").hide();
                    let by = 1;
                    let sel = 1;

                    $.each(result[0], function(key, val) {
                        agent_question[val.question_id] = val;
                        let qi = val.question_id;
                        let sharequetion = result[1][qi];
                        let checkanswer = result[2][qi];

                        // Function to generate HTML for question and answer
                        function generateQuestionHTML(utyp, apen, counter) {
                            let htm = `
                            <div class="askquestioncount_${utyp}">
                                <div class="panel-group margin-0" id="accordion-${utyp}-${counter}">
                                    <div class="panel-heading border1-bottom">
                                        <h4 class="text-15 panel-title position-r question-title">
                                            <span>${counter}) </span>
                                            <a class="question-question q-s-${val.question_id}">${val.question}</a>
                                            <img class="ovloader imgloader_${val.question_id} pull-right" src="{{ url('/assets/img/loder/loading.gif') }}" width="15px" height="15px" >
                                            <span class="text-13 clicksurvey_${val.question_id}">
                                                ${sharequetion ? 
                                                    `<span class="margin cursor green pull-right" onclick="add_ask_list_question_remove(${val.question_id}, ${sharequetion});"> <i class="fa fa-check-circle-o"> </i> <strong>Asked</strong> </span>` :
                                                    `<span class="margin cursor pull-right" onclick="add_ask_list_question(${val.question_id});"> <i class="fa fa-circle-o" aria-hidden="true"></i> <strong>Ask</strong> </span>`
                                                }
                                            </span>`;

                            if (checkanswer) {
                                htm += generateAnswerHTML(utyp, counter, checkanswer);
                            }

                            htm += `</h4></div></div></div>`;
                            apen.append(htm);

                            if (checkanswer) {
                                let ratingset = (result[4][checkanswer.answers_id] && result[4][
                                    checkanswer.answers_id
                                ].rating) || 0;
                                $(`#star${ratingset.toString().replace('.', '_')}_${checkanswer.answers_id}`)
                                    .prop("checked", true);
                            }
                        }

                        // Function to generate HTML for the answer part
                        function generateAnswerHTML(utyp, counter, ansewrdd) {
                            share_question_return_answer[ansewrdd.answers_id] = ansewrdd;
                            let adate = dayjs(ansewrdd.created_at).fromNow();
                            let ratingset = (result[4][ansewrdd.answers_id] && result[4][ansewrdd
                                .answers_id
                            ].rating) || 0;
                            let bookmarked = result[3][ansewrdd.answers_id];

                            let bookmarkHTML = bookmarked ?
                                `<li onclick="remove_bookmark_list(${ansewrdd.answers_id}, ${ansewrdd.question_id}, ${bookmarked.bookmark_id});" data-toggle="tooltip" data-original-title="Bookmarked " data-placement="bottom"  class="tooltips fa fa-bookmark sitegreen book_question_${ansewrdd.answers_id} bookmarkquestion-icon"></li>` :
                                `<li onclick="add_bookmark_list(${ansewrdd.answers_id}, ${ansewrdd.question_id});" data-toggle="tooltip" data-original-title="Bookmark" data-placement="bottom"  class="tooltips fa fa-bookmark-o book_question_${ansewrdd.answers_id} bookmarkquestion-icon"></li>`;


                            let htm = `
                                <span class="text-13 margin cursor sitegreen pull-right accordion-toggle collapsed" data-target="#collapse-${utyp}-${counter}" data-toggle="collapse"> <i class="fa fa-reply" aria-hidden="true"></i> <strong> Answered </strong> </span>
                                <div id="collapse-${utyp}-${counter}" class="panel-collapse collapse">
                                    <div class="media padding-5 media-v2">
                                        <div class="media-body">
                                            <h4 class="media-heading color-black">
                                                <strong><a href="#"> Answered by {{ ucfirst($agents->name) }} </a></strong>
                                                <span class="bookmark_q_${ansewrdd.answers_id}">${bookmarkHTML}</span>
                                                <li onclick="setnotesinanswer(${ansewrdd.answers_id},${ansewrdd.question_id});" data-toggle="tooltip" data-original-title="Note" data-placement="bottom"  class="tooltips fa fa-commenting bookmarkquestion-icon"></li>
                                                <small class="media-small"> <i class="fa fa-clock-o green"> </i> ${adate}</small>
                                            </h4>
                                            <div>${ansewrdd.answers}</div>
                                            <ul class="text-10 margin-0 list-inline pull-right ">
                                                <div id="ratinganswer_${ansewrdd.answers_id}" class="rating1">`;

                            for (let star = 5; star >= 0.5; star -= 0.5) {
                                let starValue = star.toString().replace('.', '_');
                                let starClass = (star == Math.floor(star)) ? 'full' : 'half';
                                let starTitle = getStarTitle(star);
                                htm +=
                                    `<input class="stars star${starValue}_${ansewrdd.answers_id}" onclick="rating_add(${ansewrdd.answers_id},'star${starValue}_${ansewrdd.answers_id}');" type="radio" name="rating${ansewrdd.answers_id}" id="star${starValue}_${ansewrdd.answers_id}" value="${starValue}" />`;
                                htm +=
                                    `<label class="${starClass} tooltips" data-toggle="tooltip" data-original-title="${starTitle}" data-placement="top" for="star${starValue}_${ansewrdd.answers_id}" title="${starTitle}"></label>`;
                            }

                            htm += `</div></ul></div></div></div>`;
                            return htm;
                        }


                        if (val.importance == 1) {
                            generateQuestionHTML('buyer', $('#importantquestionslist'), by++);
                        }

                        generateQuestionHTML('seller', $('#allquestionslist'), sel++);

                    });


                    if ('{{ $uri_segment }}' === '10') {
                        $('#askquestion').modal('show');
                        $('a[href="#asked_question_answer"]').tab('show');
                        readnotificationbyreciverid('{{ $agents->id }}',
                            '{{ $agents->agents_users_role_id }}', '{{ $user->id }}',
                            '{{ $user->agents_users_role_id }}', 10);
                    }

                    $('#askquestion-model').on('click', function() {
                        readnotificationbyreciverid('{{ $agents->id }}',
                            '{{ $agents->agents_users_role_id }}', '{{ $user->id }}',
                            '{{ $user->agents_users_role_id }}', 10);
                    });
                },
                error: function(data) {
                    // Handle error
                    console.error("Error loading questions:", data);
                }
            });

            window.history.pushState('data', "Title", '{{ url('/search/agents/details/') }}/{{ $agents->id }}/' +
                post_id);
        }

        // Helper function for star titles
        function getStarTitle(starValue) {
            switch (starValue) {
                case 0.5:
                    return "0.5 Stars";
                case 1:
                    return "1 Star";
                case 1.5:
                    return "1.5 Stars";
                case 2:
                    return "2 Stars";
                case 2.5:
                    return "2.5 Stars";
                case 3:
                    return "3 Stars";
                case 3.5:
                    return "3.5 Stars";
                case 4:
                    return "4 Stars";
                case 4.5:
                    return "4.5 Stars";
                case 5:
                    return "5 Stars";
                default:
                    return "";
            }
        }

        /*ask question*/
        function loadquestion_jk() {
            /* question and ans  */
            $.ajax({
                url: "{{ url('/question/get/only/user') }}",
                type: 'POST',
                data: {
                    rating: 'rating',
                    bookmark: 'bookmark',
                    shared_item_type: 2,
                    _token: '{{ csrf_token() }}',
                    add_by: '{{ $user->id }}',
                    add_by_role: '{{ $user->agents_users_role_id }}',
                    question_type: '{{ $agents->agents_users_role_id }}',
                    post_id: post_id,
                    receiver_id: '{{ $agents->id }}',
                    share: 'ask_question'
                },
                beforeSend: function() {
                    $(".body-existingquestionslist-popup").show();
                },

                success: function(result) {
                    $(".body-existingquestionslist-popup").hide();
                    var askqi = 1;
                    var by = 1,
                        sel = 1;

                    $.each(result[0], function(key, val) {
                        agent_question[val.question_id] = val;
                        var qi = val.question_id;
                        var sharequetion = result[1][qi];
                        var checkanswer = result[2][qi];

                        if (val.importance == 1) {
                            key = by;
                            by = 1 + by;
                            var utyp = 'buyer';
                            var apen = $('#importantquestionslist');
                            var htm = '<div class="askquestioncount_' + utyp + '">' +
                                '<div class="panel-group margin-0" id="accordion-' + utyp +
                                '-' + key +
                                '">' +
                                '<div class="panel-heading border1-bottom">' +
                                '<h4 class="text-15 panel-title position-r question-title">' +
                                '<span>' + key + ') </span>' +
                                '<a class="question-question q-s-' + val.question_id + '">' +
                                val
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
                                    '<span class="text-13 margin cursor sitegreen pull-right accordion-toggle collapsed" data-target="#collapse-' +
                                    utyp + '-' + key +
                                    '" data-toggle="collapse" > <i class="fa fa-reply" aria-hidden="true"></i> <strong> Answered </strong> </span>';
                            }

                            htm += '</h4>';

                            if (checkanswer != '' && checkanswer != null) {
                                var ansewrdd = checkanswer;
                                share_question_return_answer[ansewrdd.answers_id] = ansewrdd;
                                var qdate = timeDifference(new Date(), new Date(Date.fromISO(val
                                    .created_at)));
                                var adate = timeDifference(new Date(), new Date(Date.fromISO(
                                    ansewrdd
                                    .created_at)));

                                if (result[4][ansewrdd.answers_id] != null && result[4][ansewrdd
                                        .answers_id
                                    ] != 'undefined' && result[4][ansewrdd.answers_id] != '') {
                                    var rat = result[4][ansewrdd.answers_id];
                                    var ratingset = rat.rating;
                                } else {
                                    var ratingset = 0;
                                }

                                htm += '<div id="collapse-' + utyp + '-' + key +
                                    '" class="panel-collapse collapse">' +
                                    '<div class="media padding-5 media-v2">' +
                                    '<div class="media-body">' +
                                    '<h4 class="media-heading color-black">' +
                                    '<strong><a href="#"> Answered by {{ ucfirst($agents->name) }} </a></strong>' +
                                    '<span class="bookmark_q_' + ansewrdd.answers_id + '">';


                                if (result[3][ansewrdd.answers_id] != null && result[3][ansewrdd
                                        .answers_id
                                    ] != 'undefined' && result[3][ansewrdd.answers_id] != '') {
                                    var book = result[3][ansewrdd.answers_id];

                                    htm += '<li onclick="remove_bookmark_list(' + ansewrdd
                                        .answers_id +
                                        ',' + ansewrdd.question_id + ',' + book.bookmark_id +
                                        ');" data-toggle="tooltip" data-original-title="Bookmarked " data-placement="bottom"  class="tooltips fa fa-bookmark sitegreen book_question_' +
                                        ansewrdd.answers_id + ' bookmarkquestion-icon"></li> ';
                                } else {
                                    htm += '<li onclick="add_bookmark_list(' + ansewrdd
                                        .answers_id +
                                        ',' + ansewrdd.question_id +
                                        ');" data-toggle="tooltip" data-original-title="Bookmark" data-placement="bottom"  class="tooltips fa fa-bookmark-o book_question_' +
                                        ansewrdd.answers_id + ' bookmarkquestion-icon"></li> ';
                                }

                                htm += '</span>' +
                                    '<li onclick="setnotesinanswer(' + ansewrdd.answers_id +
                                    ',' +
                                    ansewrdd.question_id +
                                    ');" data-toggle="tooltip" data-original-title="Note" data-placement="bottom"  class="tooltips fa fa-commenting bookmarkquestion-icon"></li>' +
                                    '<small class="media-small"> <i class="fa fa-clock-o green"> </i> ' +
                                    adate + '</small>' +
                                    '</h4>' +
                                    '<div>' + ansewrdd.answers + '</div>' +
                                    '<ul class="text-10 margin-0 list-inline pull-right ">' +
                                    '<div id="ratinganswer_' + ansewrdd.answers_id +
                                    '" class="rating1">';

                                // Rating stars - Simplified and removed duplicate code
                                for (let star = 5; star >= 0.5; star -= 0.5) {
                                    let starValue = star.toString().replace('.', '_');
                                    let starClass = (star == Math.floor(star)) ? 'full' :
                                        'half';
                                    let starTitle = getStarTitle(
                                        star); // Function to get title based on star value
                                    htm += '<input class="stars star' + starValue + '_' +
                                        ansewrdd
                                        .answers_id + '" onclick="rating_add(' + ansewrdd
                                        .answers_id +
                                        ',\'star' + starValue + '_' + ansewrdd.answers_id +
                                        '\');" type="radio" name="rating' + ansewrdd
                                        .answers_id +
                                        '" id="star' + starValue + '_' + ansewrdd.answers_id +
                                        '" value="' + starValue + '" />';
                                    htm += '<label class = "' + starClass +
                                        ' tooltips" data-toggle="tooltip" data-original-title="' +
                                        starTitle + '" data-placement="top" for="star' +
                                        starValue +
                                        '_' + ansewrdd.answers_id + '" title="' + starTitle +
                                        '"></label>';
                                }


                                htm += '</div></ul></div></div></div>';
                            }

                            apen.append(htm);

                            if (checkanswer != '' && checkanswer != null) {
                                $('#star' + ratingset + '_' + checkanswer.answers_id).attr(
                                    "checked",
                                    "checked");
                            }
                        }


                        key = sel;
                        sel = 1 + sel;


                        var utyp = 'seller';
                        var apen = $('#allquestionslist');

                        var htm = '<div class="askquestioncount_' + utyp + '">' +
                            '<div class="panel-group margin-0" id="accordion-' + utyp + '-' +
                            key +
                            '">' +
                            '<div class="panel-heading border1-bottom">' +
                            '<h4 class="text-15 panel-title position-r question-title">' +
                            '<span>' + key + ') </span>' +
                            '<a class="question-question q-s-' + val.question_id + '">' + val
                            .question +
                            '</a>' +
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
                                '<span class="text-13 margin cursor sitegreen pull-right accordion-toggle collapsed" data-target="#collapse-' +
                                utyp + '-' + key +
                                '" data-toggle="collapse"> <i class="fa fa-reply" aria-hidden="true"></i> <strong class="accordion-toggle"> Answered </strong> </span>';
                        }

                        htm += '</h4>';

                        if (checkanswer != '' && checkanswer != null) {
                            var ansewrdd = checkanswer;
                            share_question_return_answer[ansewrdd.answers_id] = ansewrdd;
                            var qdate = timeDifference(new Date(), new Date(Date.fromISO(val
                                .created_at)));
                            var adate = timeDifference(new Date(), new Date(Date.fromISO(
                                ansewrdd
                                .created_at)));

                            if (result[4][ansewrdd.answers_id] != null && result[4][ansewrdd
                                    .answers_id
                                ] != 'undefined' && result[4][ansewrdd.answers_id] != '') {
                                var rat = result[4][ansewrdd.answers_id];
                                var ratingset = rat.rating;
                            } else {
                                var ratingset = 0;
                            }


                            htm += '<div id="collapse-' + utyp + '-' + key +
                                '" class="panel-collapse collapse">' +
                                '<div class="media padding-5 media-v2">' +
                                '<div class="media-body">' +
                                '<h4 class="media-heading color-black">' +
                                '<strong><a href="#"> Answered by {{ ucfirst($agents->name) }} </a></strong>' +
                                '<span class="bookmark_q_' + ansewrdd.answers_id + '">';

                            if (result[3][ansewrdd.answers_id] != null && result[3][ansewrdd
                                    .answers_id
                                ] != 'undefined' && result[3][ansewrdd.answers_id] != '') {
                                var book = result[3][ansewrdd.answers_id];
                                htm += '<li onclick="remove_bookmark_list(' + ansewrdd
                                    .answers_id +
                                    ',' + ansewrdd.question_id + ',' + book.bookmark_id +
                                    ');" data-toggle="tooltip" data-original-title="Bookmarked " data-placement="bottom"  class="tooltips fa fa-bookmark sitegreen book_question_' +
                                    ansewrdd.answers_id + ' bookmarkquestion-icon"></li> ';
                            } else {
                                htm += '<li onclick="add_bookmark_list(' + ansewrdd.answers_id +
                                    ',' +
                                    ansewrdd.question_id +
                                    ');" data-toggle="tooltip" data-original-title="Bookmark" data-placement="bottom"  class="tooltips fa fa-bookmark-o book_question_' +
                                    ansewrdd.answers_id + ' bookmarkquestion-icon"></li> ';
                            }

                            htm += '</span>' +
                                '<li onclick="setnotesinanswer(' + ansewrdd.answers_id + ',' +
                                ansewrdd
                                .question_id +
                                ');" data-toggle="tooltip" data-original-title="Note" data-placement="bottom"  class="tooltips fa fa-commenting bookmarkquestion-icon"></li>' +
                                '<small class="media-small"> <i class="fa fa-clock-o green"> </i> ' +
                                adate + '</small>' +
                                '</h4>' +
                                '<div>' + ansewrdd.answers + ' </div>' +
                                '<ul class="text-10 margin-0 list-inline pull-right ">' +
                                '<div id="ratinganswer_' + ansewrdd.answers_id +
                                '" class="rating1">';

                            // Rating stars - Simplified and removed duplicate code
                            for (let star = 5; star >= 0.5; star -= 0.5) {
                                let starValue = star.toString().replace('.', '_');
                                let starClass = (star == Math.floor(star)) ? 'full' : 'half';
                                let starTitle = getStarTitle(
                                    star); // Function to get title based on star value

                                htm += '<input class="stars star' + starValue + '_' + ansewrdd
                                    .answers_id + '" onclick="rating_add(' + ansewrdd
                                    .answers_id +
                                    ',\'star' + starValue + '_' + ansewrdd.answers_id +
                                    '\');" type="radio" name="rating' + ansewrdd.answers_id +
                                    '" id="star' + starValue + '_' + ansewrdd.answers_id +
                                    '" value="' +
                                    starValue + '" />';
                                htm += '<label class = "' + starClass +
                                    ' tooltips" data-toggle="tooltip" data-original-title="' +
                                    starTitle + '" data-placement="top" for="star' + starValue +
                                    '_' +
                                    ansewrdd.answers_id + '" title="' + starTitle +
                                    '"></label>';
                            }

                            htm += '</div></ul></div></div></div>';
                        }

                        htm += '</div></div></div>';

                        apen.append(htm);

                        if (checkanswer != '' && checkanswer != null) {
                            $('#star' + ratingset + '_' + checkanswer.answers_id).attr(
                                "checked",
                                "checked");
                        }
                    });



                    if ('{{ $uri_segment }}' === '10') {
                        $('#askquestion').modal('show');
                        $('a[href="#asked_question_answer"]').tab('show');
                        readnotificationbyreciverid('{{ $agents->id }}',
                            '{{ $agents->agents_users_role_id }}', '{{ $user->id }}',
                            '{{ $user->agents_users_role_id }}', 10);
                    }

                    $('#askquestion-model').on('click', function() {
                        readnotificationbyreciverid('{{ $agents->id }}',
                            '{{ $agents->agents_users_role_id }}',
                            '{{ $user->id }}',
                            '{{ $user->agents_users_role_id }}', 10);
                    });
                },
                error: function(data) {

                }
            });

            window.history.pushState('data', "Title",
                '{{ url('/search/agents/details/') }}/{{ $agents->id }}/' +
                post_id);
        }


        function getStarTitle(starValue) { //Helper function to generate titles for rating stars

            if (starValue >= 4) {
                return "Awesome";
            } else if (starValue >= 3) {
                return "Pretty good";
            } else if (starValue >= 2) {
                return "Meh";
            } else if (starValue >= 1) {
                return "Kinda bad";
            } else {
                return "Sucks big time";
            }
        }


        /*asked question answer*/
        function loadaskedquestionandansuwer() {

            $.ajax({
                url: "{{ url('/shared/question/answer/get') }}",
                type: 'POST',
                data: {
                    shared_type: 1,
                    shared_item_type: 1,
                    shared_item_type_id: post_id,
                    _token: '{{ csrf_token() }}',
                    receiver_id: '{{ $user->id }}',
                    receiver_role: '{{ $user->agents_users_role_id }}',
                    question_type: '{{ $user->agents_users_role_id }}',
                    sender_id: '{{ $agents->id }}',
                    sender_role: '{{ $agents->agents_users_role_id }}'
                },

                beforeSend: function() {
                    $(".load-agent-ask-question").show();
                },

                success: function(result) {
                    if (result[0] != '') {
                        $(".load-agent-ask-question").hide();

                        var apptypeqa = $('#enters-default-answers');

                        $.each(result[0], function(key, val) {

                            sharedquestion_data[val.question_id] = val;

                            var questionsharedate = timeDifference(new Date(), new Date(Date
                                .fromISO(val
                                    .created_at)));

                            var htm =
                                '<div class="panel-group margin-0"><div class="panel-heading border1-bottom clear-both">' +
                                '<h4 class="text-15 panel-title question-title">' +
                                '<span onclick="setnotesinaskedquestion(' + val.question_id +
                                ',' +
                                post_id +
                                ');" data-toggle="tooltip" data-original-title="Note" data-placement="top"  class="text-13 tooltips fa fa-commenting bookmarkquestion-icon"></span>' +
                                '<span>' + (key + 1) +
                                ') </span><a class="question-question q-s-' + val
                                .question_id + '" >' + val.question +
                                ' <span class="padding-left-10 text-12"><strong> Posted: </strong>' +
                                questionsharedate + '</span>' +
                                '</a>' +
                                '<span href="#" class="text-13 margin cursor sitegreen pull-right accordion-toggle collapsed" data-target="#collapse-answer-' +
                                key +
                                '" data-toggle="collapse"> <i class="fa fa-reply"> </i> <small> Answer </small> </span>' +
                                '</h4>' +
                                '<div id="collapse-answer-' + key +
                                '" class="panel-collapse collapse panel-body padding-0 margin-top-10">' +
                                '<div class="row">' +
                                '<div class="hide question-msg-' + val.question_id +
                                '"></div>' +
                                '<div class="col-md-8">' +
                                '<label class="textarea ">' +
                                '<textarea data-original-title="Enter your interesting answer"  rows="2" class="field-border tooltips" name="question_default[' +
                                val.question_id + ']" id="question_default_' + key +
                                '" placeholder="Enter your interesting answer">' + result[1][val
                                    .question_id
                                ] + '</textarea>' +
                                '<b class="error-text" id="question_default_' + key +
                                '_error"></b>' +
                                '</label>' +
                                '</div>' +
                                '<div class="col-md-4 margin-top-5"> ' +
                                '<input type="hidden" name="question_id[]" value="' + val
                                .question_id +
                                '">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div></div>';

                            apptypeqa.append(htm);
                        });

                        apptypeqa.append('<input type="hidden" name="post_id" value="' + post_id +
                            '" >' +
                            '<input type="hidden" name="receiver_id" value="{{ $agents->id }}" >' +
                            '<input type="hidden" name="receiver_role" value="{{ $agents->agents_users_role_id }}" >' +
                            '<input type="hidden" name="from_id" value="{{ $user->id }}" >' +
                            '<input type="hidden" name="from_role" value="{{ $user->agents_users_role_id }}" >' +
                            '<input type="hidden" name="notification_message" value="Your question get answer by {{ $userdetails->name }}" >'
                        );

                        $('#sharedbyagent').removeClass('hide').addClass('show');
                        $('#akes-q-buten-appen').html(
                            '<button  type="button" class="btn btn-default black btn-block margin-top-10" data-toggle="modal" data-target="#default_answers"> <i class="fa fa-reply" aria-hidden="true"></i>  Asked Question </button>'
                        );

                        if ('{{ $uri_segment }}' == '1') {
                            $('#default_answers').modal('show');
                            readnotificationbyreciverid('{{ $agents->id }}',
                                '{{ $agents->agents_users_role_id }}', '{{ $user->id }}',
                                '{{ $user->agents_users_role_id }}', 1);
                        }

                        $('#akes-q-buten-appen').on('click', function() {
                            readnotificationbyreciverid('{{ $agents->id }}',
                                '{{ $agents->agents_users_role_id }}',
                                '{{ $user->id }}',
                                '{{ $user->agents_users_role_id }}', 1);
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
                    shared_item_type: 1,
                    shared_item_type_id: post_id,
                    receiver_id: '{{ $user->id }}',
                    receiver_role: '{{ $user->agents_users_role_id }}',
                    sender_id: '{{ $agents->id }}',
                    sender_role: '{{ $agents->agents_users_role_id }}',
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
                                .lastIndexOf(
                                    '.') + 1)).toLowerCase();
                            var htmll = '<div class="col-md-4">' +
                                '<div class="thumbnails uploadfiles_' + value.upload_share_id +
                                ' thumbnail-style box-shdow thumbnail-kenburn">' +
                                '<div class="cbp-caption thumbnail-img">' +
                                '<div class="overflow-hidden cbp-caption-defaultWrap">';

                            if (extension == 'png' || extension == 'jpg' || extension ==
                                'jpeg' ||
                                extension == 'gif' || extension == 'tif') {
                                htmll += '<img class="documen document_uploadfiles_' + value
                                    .upload_share_id + '" src="' + value.attachments +
                                    '" frameborder="0" scrolling="no" width="246" height="182px">';
                            } else {
                                htmll += '<iframe class="documen document_uploadfiles_' + value
                                    .upload_share_id +
                                    '" src="https://docs.google.com/viewer?url=' +
                                    value.attachments +
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
                            '<button type="button" class="btn black btn-block btn-default margin-top-10" data-toggle="modal" data-target="#uploaded-files-shared"> <i class="fa fa-reply" aria-hidden="true"></i> Shared Files </button>'
                        );

                        if ('{{ $uri_segment }}' === '2') {
                            $('#uploaded-files-shared').modal('show');
                            readnotificationbyreciverid('{{ $agents->id }}',
                                '{{ $agents->agents_users_role_id }}', '{{ $user->id }}',
                                '{{ $user->agents_users_role_id }}', 2);
                        }

                        $('#shard-upload-files-button').on('click', function() {
                            readnotificationbyreciverid('{{ $agents->id }}',
                                '{{ $agents->agents_users_role_id }}',
                                '{{ $user->id }}',
                                '{{ $user->agents_users_role_id }}', 2);
                        });
                    }
                }
            });

            /* shared Proposal get */
            $.ajax({
                url: "{{ url('/shared/proposals/get') }}",
                type: 'POST',
                data: {
                    shared_type: 3,
                    shared_item_type: 1,
                    shared_item_type_id: post_id,
                    receiver_id: '{{ $user->id }}',
                    receiver_role: '{{ $user->agents_users_role_id }}',
                    sender_id: '{{ $agents->id }}',
                    sender_role: '{{ $agents->agents_users_role_id }}',
                    _token: '{{ csrf_token() }}',
                    bookmark_type: '5'
                },

                beforeSend: function() {
                    $(".loadproposalsshared").show();
                },

                success: function(result) {
                    var bookmarkdata = result[1];
                    var result = result[0];

                    if (result != 'undefined' && result != null && result != '') {
                        $(".loadproposalsshared").hide();

                        $.each(result, function(key, value) {
                            sharedproposale_data[value.proposals_id] = value;
                            var extension = value.proposals_attachments.substr((value
                                .proposals_attachments.lastIndexOf('.') + 1)).toLowerCase();

                            var htmll = '<div class="col-md-4">' +
                                '<div class="thumbnails proposal_' + value.proposals_id +
                                ' thumbnail-style box-shdow thumbnail-kenburn">' +
                                '<div class="cbp-caption thumbnail-img">' +
                                '<div class="overflow-hidden cbp-caption-defaultWrap">';

                            if (extension == 'png' || extension == 'jpg' || extension ==
                                'jpeg' ||
                                extension == 'gif' || extension == 'tif') {
                                htmll += '<img class="documen document_' + value.proposals_id +
                                    '" src="' + value.proposals_attachments +
                                    '" frameborder="0" scrolling="no" width="246" height="182px">';
                            } else {
                                htmll += '<iframe class="documen document_' + value
                                    .proposals_id +
                                    '" src="https://docs.google.com/viewer?url=' + value
                                    .proposals_attachments +
                                    '&embedded=true" frameborder="0" scrolling="no" width="246" height="176"></iframe>';
                            }

                            htmll += '</div>' +
                                '<div class="removehover cbp-caption-activeWrap">' +
                                '<div class="cbp-l-caption-alignCenter">' +
                                '<div class="cbp-l-caption-body">' +
                                '<ul class="link-captions no-bottom-space">' +
                                '<li><a class="cursor" onclick="openpropopshared(' + value
                                .proposals_id +
                                ')"><i class="rounded-x fa fa-search"></i></a></li>' +
                                '<li class="bookmark_proposal_' + value.proposals_id + '">';


                            if (bookmarkdata[value.proposals_id] != null && bookmarkdata[value
                                    .proposals_id] != 'undefined' && bookmarkdata[value
                                    .proposals_id] !=
                                '') {
                                var book = bookmarkdata[value.proposals_id];
                                htmll +=
                                    '<a class="cursor tooltips" onclick="remove_proposal_bookmark_list(' +
                                    value.proposals_id + ',' + post_id + ',' + book
                                    .bookmark_id +
                                    ')" data-toggle="tooltip" data-original-title="Bookmarked " data-placement="bottom"><i class="rounded-x  fa fa-bookmark"></i></a>';
                            } else {
                                htmll +=
                                    '<a class="cursor tooltips" onclick="add_proposal_bookmark_list(' +
                                    value.proposals_id + ',' + post_id +
                                    ')" data-toggle="tooltip" data-original-title="Bookmark" data-placement="bottom"><i class="rounded-x fa fa-bookmark-o "></i></a>';
                            }


                            htmll +=
                                '</li><li><a class="cursor tooltips" onclick="setnotesinproposal(' +
                                value.proposals_id + ',' + post_id +
                                ')" data-toggle="tooltip" data-original-title="Note" data-placement="bottom"><i class="rounded-x fa fa-commenting"></i></a></li>' +
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

                            $('#append-proposals-shared-ajax').append(htmll);
                        });


                        $('#sharedbyagent').removeClass('hide').addClass('show');
                        $('#shared-proposal-button').html(
                            '<button  type="button" class="btn black btn-block btn-default margin-top-10" data-toggle="modal" data-target="#proposals-shared"> <i class="fa fa-reply" aria-hidden="true"></i> Shared Proposal </button>'
                        );

                        if ('{{ $uri_segment }}' === '3') {
                            $('#proposals-shared').modal('show');
                            readnotificationbyreciverid('{{ $agents->id }}',
                                '{{ $agents->agents_users_role_id }}', '{{ $user->id }}',
                                '{{ $user->agents_users_role_id }}', 3);
                        }


                        $('#shared-proposal-button').on('click', function() {
                            readnotificationbyreciverid('{{ $agents->id }}',
                                '{{ $agents->agents_users_role_id }}',
                                '{{ $user->id }}',
                                '{{ $user->agents_users_role_id }}', 3);
                        });
                    }
                }
            });
        }

        /*survey*/
        function add_ask_list_question(id) {

            // publicConnection();

            var postque = agent_question[id];
            $.ajax({
                url: "{{ url('/shared/data/insert') }}",
                type: 'post',
                data: {
                    notification_type: 4,
                    notification_message: '{{ $userdetails->name }} asked questions related to {{ $types }}ing Home ',
                    shared_type: 1,
                    shared_item_id: id,
                    shared_item_type: 2,
                    shared_item_type_id: post_id,
                    receiver_id: '{{ $agents->id }}',
                    receiver_role: '{{ $agents->agents_users_role_id }}',
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
                        ');"> <i class="fa fa-check-circle-o"> </i> <strong> Asked </strong> </span>'
                    );

                    msgshowfewsecond(postque.question + ' successfully shared.');
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
                        ');">  <strong> <i class="fa fa-circle-o" aria-hidden="true"></i> Ask </strong> </span>'
                    );
                    msgshowfewsecond(postque.question + ' successfully remove in shared list.');
                },

                error: function(result) {
                    $('.clicksurvey_' + id).hide();
                    $('.clicksurvey_' + id + ' span').show();
                }
            });
        }

        /*load uploaded fils */
        function loaduploadshare(limit) {
            $.ajax({
                url: "{{ url('/') }}/get/uploaded/files/with/shared/" + limit,
                type: 'post',
                data: {
                    shared_item_type: 2,
                    _token: '{{ csrf_token() }}',
                    sender_id: '{{ $user->id }}',
                    sender_role: '{{ $user->agents_users_role_id }}',
                    receiver_id: '{{ $agents->id }}',
                    receiver_role: '{{ $agents->agents_users_role_id }}',
                    post_id: post_id
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
                            var extension = value.attachments.substr((value.attachments
                                .lastIndexOf(
                                    '.') + 1)).toLowerCase();
                            var classactive = '';
                            var asrvfun = '';


                            if (shareproposals != null && shareproposals != 'undefined' &&
                                shareproposals) {
                                classactive = 'proposal-active';
                                asrvfun = '<i onclick="shareuploadfilesremove(' + value
                                    .upload_share_id + ',' + shareproposals.shared_id +
                                    ')"  aria-hidden="true" class="icon-custom rounded-x icon-line fa fa-times proposal-icon"></i>';
                            } else {
                                classactive = '';
                                asrvfun = '<i onclick="shareuploadfiles(' + value
                                    .upload_share_id +
                                    ')"  aria-hidden="true" class="icon-custom rounded-x icon-line fa fa-share-alt proposal-icon"></i>';
                            }


                            var htmll = '<div class="col-md-4">' +
                                '<div class="thumbnails ' + classactive + ' uploadfiles_' +
                                value
                                .upload_share_id +
                                ' thumbnail-style box-shdow thumbnail-kenburn">' +
                                '<span class="uploadfiles_share_' + value.upload_share_id +
                                '">' +
                                asrvfun + '</span>' +
                                '<div class="cbp-caption thumbnail-img">' +
                                '<div class="overflow-hidden cbp-caption-defaultWrap">';

                            if (extension == 'png' || extension == 'jpg' || extension ==
                                'jpeg' ||
                                extension == 'gif' || extension == 'tif') {
                                htmll += '<img class="documen document_uploadfiles_' + value
                                    .upload_share_id + '" src="' + value.attachments +
                                    '" frameborder="0" scrolling="no" width="246" height="182px">';
                            } else {
                                htmll += '<iframe class="documen document_uploadfiles_' + value
                                    .upload_share_id +
                                    '" src="https://docs.google.com/viewer?url=' +
                                    value.attachments +
                                    '&embedded=true" frameborder="0" scrolling="no" width="246" height="176"></iframe>';
                            }


                            htmll += '</div>' +
                                '<div class="removehover cbp-caption-activeWrap">' +
                                '<div class="cbp-l-caption-alignCenter">' +
                                '<div class="cbp-l-caption-body">' +
                                '<ul class="link-captions no-bottom-space">' +
                                '<li><a class="cursor" onclick="openuploadfiles(' + value
                                .upload_share_id +
                                ')"><i class="rounded-x fa fa-search"></i></a>' +
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
            $('.proposal-popup-title').text('{{ $userdetails->name }}');
            $('.append-src-ifram').html(ee[0].outerHTML);
            $('#open-proposal-popup').modal('show');
        }


        function openuploadfilesshared(id) {
            var ee = $('.document_uploadfiles_' + id).get();
            $('.proposal-popup-title').text('{{ ucfirst($agents->name) }} Shared Files');
            $('.append-src-ifram').html(ee[0].outerHTML);
            $('#open-proposal-popup').modal('show');
        }


        function openpropopshared(id) {
            var ee = $('.document_' + id).get();
            $('.proposal-popup-title').text('{{ ucfirst($agents->name) }} Shared Proposal');
            $('.append-src-ifram').html(ee[0].outerHTML);
            $('#open-proposal-popup').modal('show');
        }


        function shareuploadfiles(id) {

            // publicConnection();

            $('.uploadfiles_' + id).addClass('proposal-active');

            let share_title = '{{ $userdetails->name }} share a files related to {{ $types }}ing Home';

            $.ajax({
                url: "{{ url('/shared/data/insert') }}",
                type: 'post',
                data: {
                    notification_type: 5,
                    notification_message: share_title,
                    shared_type: 2,
                    shared_item_id: id,
                    shared_item_type: 2,
                    shared_item_type_id: post_id,
                    receiver_id: '{{ $agents->id }}',
                    receiver_role: '{{ $agents->agents_users_role_id }}',
                    sender_id: '{{ $user->id }}',
                    sender_role: '{{ $user->agents_users_role_id }}',
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    $('.uploadfiles_share_' + id).html('<i onclick="shareuploadfilesremove(' + id +
                        ',' + result
                        .data +
                        ')"  aria-hidden="true" class="icon-custom rounded-x icon-line fa fa-times proposal-icon"></i>'
                    );
                    msgshowfewsecond('Document is shared successfully');
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
        function add_bookmark_list(aid, qid) {

            // publicConnection();

            $.ajax({
                url: "{{ url('/bookmark/data/insert') }}",
                type: 'post',
                data: {
                    bookmark_type: 4,
                    bookmark_item_id: aid,
                    bookmark_item_parent_id: qid,
                    receiver_id: '{{ $agents->id }}',
                    receiver_role: '{{ $agents->agents_users_role_id }}',
                    sender_id: '{{ $user->id }}',
                    sender_role: '{{ $user->agents_users_role_id }}',
                    _token: '{{ csrf_token() }}'
                },

                success: function(result) {
                    $('.bookmark_q_' + aid).html(
                        '<li data-placement="bottom"  onclick="remove_bookmark_list(' +
                        aid + ',' + qid + ',' + result.data +
                        ');" data-toggle="tooltip" data-original-title="Bookmarked" class="tooltips fa fa-bookmark sitegreen book_question_' +
                        aid + ' bookmarkquestion-icon"></li> ');
                    msgshowfewsecond('Answer successfully bookmark.');
                },

                error: function(result) {}
            });
        }


        function remove_bookmark_list(aid, qid, bookmark_id) {
            $.ajax({
                url: "{{ url('/bookmark/data/delete') }}/" + bookmark_id,
                type: 'get',

                success: function(result) {
                    $('.bookmark_q_' + aid).html(
                        '<li data-placement="bottom"  onclick="add_bookmark_list(' +
                        aid + ',' + qid +
                        ');" data-toggle="tooltip" data-original-title="Bookmark" class="tooltips fa fa-bookmark-o sitegreen book_question_' +
                        aid + ' bookmarkquestion-icon"></li> ');
                    msgshowfewsecond('Answer remove in bookmark list.');
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
                    bookmark_item_id: '{{ $agents->id }}',
                    bookmark_item_parent_id: post_id,
                    receiver_id: '{{ $agents->id }}',
                    receiver_role: '{{ $agents->agents_users_role_id }}',
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
                    msgshowfewsecond('Bookmark Done');
                },
                error: function(result) {}
            });

            // publicConnection();
        }



        function user_remove_bookmark_list(bookmark_id) {
            $.ajax({
                url: "{{ url('/bookmark/data/delete') }}/" + bookmark_id,
                type: 'get',

                success: function(result) {
                    $('.bookmark-user').html(
                        '<span class="tooltips cursor btn-block btn btn-default sitegreen" onclick="user_add_bookmark_list();" data-original-title="Bookmark"><i class="fa fa-star-o bookmarkquestion-icon"></i> Bookmark</span>'
                    );
                    msgshowfewsecond('Bookmark is removed');
                },

                error: function(result) {}
            });
        }


        /*rating*/
        function rating_add(aid, id) {
            var asedata = share_question_return_answer[aid];
            var value = $("#" + id).val();

            $.ajax({
                url: "{{ url('/rating/data/insert') }}",
                type: 'post',
                data: {
                    post_id: post_id,
                    notification_type: 8,
                    notification_message: '{{ $userdetails->name }} give ' + removedsh(value) +
                        ' rating on your answer `' + asedata.answers + '`',
                    rating_type: 1,
                    rating: value,
                    rating_item_id: aid,
                    rating_item_parent_id: asedata.question_id,
                    receiver_id: '{{ $agents->id }}',
                    receiver_role: '{{ $agents->agents_users_role_id }}',
                    sender_id: '{{ $user->id }}',
                    sender_role: '{{ $user->agents_users_role_id }}',
                    _token: '{{ csrf_token() }}'
                },

                success: function(result) {},
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

        $('#set-proposal-notes').on('hidden.bs.modal', function(e) {
            $('#proposals-shared').modal('show');
        });
        $('#set-proposal-notes').on('show.bs.modal', function(e) {
            $('#proposals-shared').modal('hide');
        });

        /*Bookmark option proposal*/
        function add_proposal_bookmark_list(proposals_id, post_id) {

            // publicConnection();

            $.ajax({
                url: "{{ url('/bookmark/data/insert') }}",
                type: 'post',
                data: {
                    bookmark_type: 5,
                    bookmark_item_id: proposals_id,
                    bookmark_item_parent_id: post_id,
                    receiver_id: '{{ $agents->id }}',
                    receiver_role: '{{ $agents->agents_users_role_id }}',
                    sender_id: '{{ $user->id }}',
                    sender_role: '{{ $user->agents_users_role_id }}',
                    _token: '{{ csrf_token() }}'
                },

                success: function(result) {
                    $('.bookmark_proposal_' + proposals_id).html(
                        '<a class="cursor tooltips" onclick="remove_proposal_bookmark_list(' +
                        proposals_id + ',' + post_id + ',' + result.data +
                        ')" data-toggle="tooltip" data-original-title="Bookmarked " data-placement="bottom"><i class="rounded-x  fa fa-bookmark"></i></a>'
                    );
                    msgshowfewsecond('Proposal successfully bookmark.');
                },
                error: function(result) {}
            });
        }


        function remove_proposal_bookmark_list(proposals_id, post_id, bookmark_id) {
            $.ajax({
                url: "{{ url('/bookmark/data/delete') }}/" + bookmark_id,
                type: 'get',
                success: function(result) {
                    $('.bookmark_proposal_' + proposals_id).html(
                        '<a class="cursor tooltips" onclick="add_proposal_bookmark_list(' +
                        proposals_id +
                        ',' + post_id +
                        ')" data-toggle="tooltip" data-original-title="Bookmark " data-placement="bottom"><i class="rounded-x  fa fa-bookmark-o"></i></a>'
                    );
                    msgshowfewsecond('Proposal remove in bookmark list.');
                },

                error: function(result) {}
            });
        }


        function removedsh(str) {
            str = str.replace("_5", ".5");
            return str;
        }
    </script>
@stop
