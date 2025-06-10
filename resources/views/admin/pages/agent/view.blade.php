@extends('admin.master')
@section('title', 'dashboard')
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.5/css/bootstrap-dialog.min.css" rel="stylesheet"
        type="text/css" />
@stop
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Agent Profile
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{ route('admin.agents') }}">Agent</a></li>
                <li class="active">{{ $userdetails->name }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle"
                                src="@if ($userdetails->photo != '') {{ url('/assets/img/profile/' . $userdetails->photo) }} @else {{ url('/assets/img/team/img32-md.jpg') }} @endif"
                                alt="User profile picture">

                            <h3 class="profile-username text-center">{{ $userdetails->name }}</h3>

                            <p class="text-muted text-center hidetext2line">{!! $userdetails->description !!}</p>
                            <a class="btn btn-info reset_button"
                                href={{ url('/password/') }}/resetcodesendbyadmin/{{ $userdetails->email }}> Send Reset Link
                            </a>
                            <div class="text-center">
                                {{ session()->get('msg') }}
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#Profile" data-toggle="tab">Profile</a></li>
                            <li><a href="#Personal" data-toggle="tab">Personal Bio</a></li>
                            <li><a href="#Statement" data-toggle="tab">Statement document </a></li>
                            <li><a href="#Professional" data-toggle="tab">Professional Bio</a></li>
                            <li><a href="#Questions" data-toggle="tab">Questions</a></li>
                            <li><a href="#Proposals" data-toggle="tab">Proposals</a></li>
                            <li><a href="#Documents" data-toggle="tab">Documents</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="Profile">
                                <table class="table">

                                    <tr>
                                        <td>
                                            <strong> Name </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->name }}
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong> Address line 1 </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->address }}
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong> Address line 2 </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->address2 }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Phone No. </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->phone }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Home Phone No. </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->phone_home }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Work Phone No. </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->phone_work }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> State </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->state_name }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> City </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->city_name }}
                                            </span>
                                        </td>
                                    </tr>
                                    <?php
                                    /*
                <tr>
                  <td>
                    <strong> Area  </strong>
                  </td>
                  <td>
                    <span class="text-muted">
                      @if(!empty($userdetails->area))
                      @foreach($userdetails->area as $area)
                        <span skey="{{$area->area_id}}">{{$area->area_name}},</span>
                      @endforeach
                      @endif
                    </span>
                  </td>
                </tr>
                */
                                    ?>
                                    <tr>
                                        <td>
                                            <strong> Fax No </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->fax_no }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Zip Code </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->zip_code }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Licence Number </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->licence_number }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Description </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {!! $userdetails->description !!}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Skills </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                @if (!empty($userdetails->skills))
                                                    @foreach ($userdetails->skills as $skills)
                                                        <span skey="{{ $skills->skill_id }}"
                                                            class="label label-success">{{ $skills->skill }}</span>
                                                    @endforeach
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Education </strong>
                                        </td>
                                        <td>
                                            <!-- The timeline -->
                                            <ul class="timeline timeline-inverse">
                                                @if (!empty($userdetails->education))
                                                    @foreach (json_decode($userdetails->education) as $education)
                                                        <li class="time-label">
                                                            <span class="bg-red">
                                                                {{ $education->degree }} . {{ $education->from }} -
                                                                {{ $education->to }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-graduation-cap bg-blue"></i>
                                                            <div class="timeline-item">
                                                                <h3 class="timeline-header">{{ $education->school }}</h3>
                                                                <div class="timeline-body">
                                                                    {!! $education->description !!}
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Experience </strong>
                                        </td>
                                        <td>
                                            <!-- The timeline -->
                                            <ul class="timeline timeline-inverse">
                                                @if (!empty($userdetails->employment))
                                                    @foreach (json_decode($userdetails->employment) as $employment)
                                                        <li class="time-label">
                                                            <span class="bg-green">
                                                                {{ $employment->post }} .
                                                                {{ str_replace('_', ' ', $employment->from) }} -
                                                                {{ str_replace('_', ' ', $employment->to) }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-certificate bg-purple"></i>
                                                            <div class="timeline-item">
                                                                <h3 class="timeline-header">{{ $employment->organization }}
                                                                </h3>
                                                                <div class="timeline-body">
                                                                    {!! $employment->description !!}
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                            <div class=" tab-pane" id="Personal">
                                <table class="table">

                                    <tr>
                                        <td>
                                            <strong> Office address </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->office_address }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> State </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->state_name }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> City </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->city_name }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Area </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                @if (!empty($userdetails->area))
                                                    @foreach ($userdetails->area as $area)
                                                        <span skey="{{ $area->area_id }}">{{ $area->area_name }},</span>
                                                    @endforeach
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Fax No </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->fax_no }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Zip code where <br> I concentrate for <br> buying & selling </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->zip_code }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Licence Number </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->licence_number }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Franchise / Affiliation </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                @if (!empty($userdetails->franchise) && $userdetails->franchise != 'other')
                                                    {{ $userdetails->franchise }}
                                                @else
                                                    {{ $userdetails->other_franchise }}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Company name </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->company_name }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Years of experience </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->years_of_expreience }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Brokers name </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->brokers_name }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> MLS public id </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->MLS_public_id }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> MLS office id </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->MLS_office_id }}
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong> Terms and Conditions </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                @if ($userdetails->terms_and_conditions == 1)
                                                    Yes
                                                @else
                                                    No
                                                @endif
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong> Statement document <br> <small>Physically sign that pdf
                                                </small></strong>
                                        </td>
                                        <td>
                                            @if ($userdetails->statement_document != '')
                                                <iframe src="<?php echo $userdetails->statement_document; ?>"></iframe>
                                            @else
                                                User has not completed his profile yet.
                                            @endif
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                </table>

                            </div>
                            <div class="tab-pane padding-20" id="Statement">

                                <span class="text-muted">
                                    @if ($userdetails->statement_document != null)
                                        <ul class="mailbox-attachments clearfix">
                                            <li>
                                                <span class="mailbox-attachment-icon has-img">
                                                    <iframe
                                                        src="https://docs.google.com/viewer?url={{ $userdetails->statement_document }}&embedded=true"
                                                        frameborder="0" scrolling="no" width="198"
                                                        height="132"></iframe>
                                                </span>
                                                <div class="text-center">
                                                    <a href="#"
                                                        onclick="showdocs('https://docs.google.com/viewer?url={{ $userdetails->statement_document }}&embedded=true','doc');"
                                                        class="btn-u btn-block margin-bottom-20"> View</a>
                                                    <!-- <a href="#" class="btn-u btn-block margin-bottom-20">  </a> -->
                                                </div>
                                            </li>
                                        </ul>
                                    @endif
                                </span>
                            </div>
                            <div class=" tab-pane" id="Professional">
                                <table class="table">

                                    <tr>
                                        <td>
                                            <strong> Real Estate Education </strong>
                                        </td>
                                        <td>
                                            <ul class="timeline timeline-inverse">
                                                @if (!empty($userdetails->real_estate_education))
                                                    @foreach (json_decode($userdetails->real_estate_education) as $real_estate_education)
                                                        <li class="time-label">
                                                            <span class="bg-red">
                                                                {{ $real_estate_education->degree }} .
                                                                {{ str_replace('_', ' ', $real_estate_education->from) }} -
                                                                {{ str_replace('_', ' ', $real_estate_education->to) }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-graduation-cap bg-purple"></i>
                                                            <div class="timeline-item">
                                                                <h3 class="timeline-header">
                                                                    {{ $real_estate_education->school }}</h3>
                                                                <div class="timeline-body">
                                                                    {!! $real_estate_education->description !!}
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong> Certifications </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                @if (!empty($userdetails->certifications))
                                                    @foreach ($userdetails->certifications as $certifications)
                                                        <span
                                                            skey="{{ $certifications->certifications_id }}">{{ $certifications->certifications_description }},</span>
                                                    @endforeach
                                                @endif
                                            </span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong> Specialization </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ $userdetails->specialization }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Industry Experience </strong>
                                        </td>
                                        <td>
                                            <ul class="timeline timeline-inverse">
                                                @if (!empty($userdetails->industry_experience))
                                                    @foreach (json_decode($userdetails->industry_experience) as $industry_experience)
                                                        <li class="time-label">
                                                            <span class="bg-green">
                                                                {{ $industry_experience->post }} .
                                                                {{ str_replace('_', ' ', $industry_experience->from) }} -
                                                                {{ str_replace('_', ' ', $industry_experience->to) }}
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-certificate bg-purple"></i>
                                                            <div class="timeline-item">
                                                                <h3 class="timeline-header">
                                                                    {{ $industry_experience->organization }}</h3>
                                                                <div class="timeline-body">
                                                                    {!! $industry_experience->description !!}
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Sales history </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                @if ($userdetails->show_individual_yearly_figures == 1)
                                                    <ul class="timeline timeline-inverse">
                                                        @if (!empty($userdetails->sales_history))
                                                            @foreach (json_decode($userdetails->sales_history) as $sales_history)
                                                                <li class="time-label">
                                                                    <span class="bg-green">
                                                                        {{ $sales_history->year }}
                                                                    </span>
                                                                </li>
                                                                <li>
                                                                    <i class="fa fa-bar-chart bg-purple"></i>
                                                                    <div class="timeline-item">
                                                                        <table class="table border">
                                                                            <tr>
                                                                                <th>Sellers Represented</th>
                                                                                <th>Buyers Represented</th>
                                                                                <th>Total Dollar Sales</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>{{ $sales_history->sellers_represented }}
                                                                                </td>
                                                                                <td>{{ $sales_history->buyers_represented }}
                                                                                </td>
                                                                                <td>{{ $sales_history->total_dollar_sales }}
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                @else
                                                    No Sales
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Associations & Awards </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                @if ($userdetails->associations_awards)
                                                    @foreach (explode(',==,', $userdetails->associations_awards) as $awardd)
                                                        {{ $awardd }},
                                                    @endforeach
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Publications </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                @if ($userdetails->publications)
                                                    @foreach (explode(',==,', $userdetails->publications) as $public)
                                                        {{ $public }},
                                                    @endforeach
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Community involvement </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                @if ($userdetails->community_involvement)
                                                    @foreach (explode(',==,', $userdetails->community_involvement) as $comuni)
                                                        {{ $comuni }},
                                                    @endforeach
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Language Proficiency </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                <ul class="timeline timeline-inverse">
                                                    @if (!empty($userdetails->language_proficiency))
                                                        @foreach (json_decode($userdetails->language_proficiency) as $language_proficiency)
                                                            <li class="time-label">
                                                                <span class="bg-green">
                                                                    {{ $language_proficiency->language }}
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-language bg-purple"></i>
                                                                <div class="timeline-item">
                                                                    <table class="table border">
                                                                        <tr>
                                                                            <th>speak</th>
                                                                            <th>read</th>
                                                                            <th>write</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>{{ $language_proficiency->speak }}</td>
                                                                            <td>{{ $language_proficiency->read }}</td>
                                                                            <td>{{ $language_proficiency->write }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong> Additional details </strong>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                {{ strip_tags($userdetails->additional_details) }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="Questions">
                                <div class="tab-v1">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#default-answers" data-toggle="tab">Admin asked
                                                question with answers</a></li>
                                        <li><a href="#questions-ask" data-toggle="tab">{{ $userdetails->name }} uploaded
                                                questions</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <!-- Default Questions Answers -->
                                        <div class="profile-edit tab-pane fade in active" id="default-answers">
                                            <div id="enters-default-answers" class="sky-form">
                                                <header> <i class="fa fa-question" aria-hidden="true"> </i> Admin
                                                    Questions with Answers</header>


                                            </div>
                                            <div class="body-overlay_default body-overlay">
                                                <div><img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px"
                                                        height="64px" /></div>
                                            </div>
                                        </div>
                                        <!-- End Default Questions Answers -->
                                        <!-- agents -->
                                        <div class="profile-edit tab-pane fade " id="questions-ask">
                                            <div id="enters-questions-to-ask" class="sky-form">
                                                <header> <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    {{ $userdetails->name }} uploaded questions For Buyer/Seller </header>
                                                <br>
                                                <div class="tab-v1">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#Buyer" data-toggle="tab">Buyer</a>
                                                        </li>
                                                        <li><a href="#Seller" data-toggle="tab">Seller</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <!-- Buyer -->
                                                        <div class="tab-pane fade in active" id="Buyer">
                                                            <div id="BuyerQuestions" class="sky-form">
                                                                <header>Buyer Questions </header>



                                                            </div>
                                                        </div>
                                                        <!-- Seller -->
                                                        <div class="tab-pane fade" id="Seller">
                                                            <div id="SellerQuestions" class="sky-form">
                                                                <header>Seller Questions</header>



                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="body-overlay_questions body-overlay">
                                                <div><img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px"
                                                        height="64px" /></div>
                                            </div>
                                        </div>
                                        <!-- end agents ask question -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="Proposals">
                                <div class="row">
                                    <div id="append-proposal-ajax"></div>
                                    <div id="loadproposal" class="col-md-12 center loder loadproposal"><img
                                            src="{{ url('/assets/img/loder/loading.gif') }}" width="64px"
                                            height="64px" /></div>
                                    <div class="center col-md-12 btn-buy animated fadeInRight">
                                        <a id="loadmoreproposal" class="cursor hide">Load More </a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="Documents">
                                <div class="row">
                                    <div id="append-uploadshares-ajax"></div>
                                    <div id="loaduploadshare" class="col-md-12 center loder loaduploadshare"><img
                                            src="{{ url('/assets/img/loder/loading.gif') }}" width="64px"
                                            height="64px" /></div>
                                    <div class="center col-md-12 btn-buy animated fadeInRight">
                                        <a id="loaduploadandshare" class="cursor hide"><i class="fa fa-spinner"> </i>
                                            load more </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- docs open -->
    <div class="modal fade bs-example-modal-lg" id="open-docs-popup" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content not-top">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body src-ifram">

                </div>
            </div>
        </div>
    </div>

    <!-- proposal -->
    <div class="modal fade" id="open-proposal-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content not-top">
                <div class="body-overlay">
                    <div><img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" /></div>
                </div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title proposal-popup-title">{{ ucfirst($userdetails->name) }}</h4>
                </div>
                <div class="modal-body append-src-ifram">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="proposaledeleteconfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content not-top">
                <div class="body-overlay">
                    <div><img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" /></div>
                </div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title proposal-popup-title">{{ ucfirst($userdetails->name) }}</h4>
                </div>
                <div class="modal-body">
                    <br>
                    <div class="proposal-delete-msg"> </div>
                    <p>Are you sure this proposal delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-u btn-u-primary" id="delete">Delete</button>
                    <button type="button" class="btn-u btn-u-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- documents -->
    <div class="modal fade" id="uploadsharedeleteconfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content not-top">
                <div class="body-overlay">
                    <div><img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" /></div>
                </div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{ ucfirst($userdetails->name) }}</h4>
                </div>
                <div class="modal-body">
                    <br>
                    <div class="upload-delete-msg"> </div>
                    <p>Are you sure this file delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-u btn-u-primary" id="delete">Delete</button>
                    <button type="button" class="btn-u btn-u-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="open-uploadshare-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content not-top">
                <div class="body-overlay">
                    <div><img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" /></div>
                </div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{ ucfirst($userdetails->name) }}</h4>
                </div>
                <div class="modal-body uploadshare-src-ifram">

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        function showdocs(url, type) {
            $('#open-docs-popup').modal('show');
            if (type == 'img') {
                var htmll = '<img   src="' + url + '" frameborder="0" scrolling="no" width="100%" height="500">';
            } else {
                var htmll = '<iframe  src="' + url + '" frameborder="0" scrolling="no" width="100%" height="500"></iframe>';
            }
            $('.src-ifram').html(htmll);
        }

        var proposale_data = [];
        var shared_proposal_connected_user_list = [];
        var uploadshare_data = [];
        var shared_document_connected_user_list = [];

        $(document).ready(function() {
            $('#loadmoreproposal').click(function(e) {
                e.preventDefault();
                var limit = $(this).attr('title');
                loadproposal(limit);
            });
            /*default-proposal*/
            loadproposal(0);

            /* upload and share */
            $('#loaduploadandshare').click(function(e) {
                e.preventDefault();
                var limit = $(this).attr('title');
                loaduploadandshare(limit);
            });
            loaduploadandshare(0);

            /* question and ans  */
            $.ajax({
                url: "{{ url('/agentadmin/') }}/question/get",
                type: 'POST',
                data: {
                    question_type: '{{ $user->agents_users_role_id }}',
                    add_by: 1,
                    add_by_role: 1,
                    _token: '{{ csrf_token() }}',
                    from_id: '{{ $user->id }}',
                    from_role: '{{ $user->agents_users_role_id }}'
                },
                beforeSend: function() {
                    $(".body-overlay_default").show();
                },
                success: function(result) {
                    $(".body-overlay_default").hide();
                    $.each(result[0], function(key, val) {
                        var htm = '' +
                            '<fieldset>' +
                            '<section>' +
                            '<label><b>Q.' + (key + 1) + ') ' + val.question + '</b></label>' +
                            '<label class="textarea ">';
                        if (result[1][val.question_id] && result[1][val.question_id] != '') {
                            htm += 'Ans. ' + result[1][val.question_id];
                        } else {
                            htm += 'Ans. No Answer';
                        }
                        htm += '</label>' +
                            '</section>' +
                            '</fieldset><hr>' +
                            '';
                        $('#enters-default-answers').append(htm);
                    });
                }
            });
            /* question and ans  */
            $.ajax({
                url: "{{ url('/agentadmin/') }}/question/get/only/user",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    add_by: '{{ $user->id }}',
                    add_by_role: '{{ $user->agents_users_role_id }}'
                },
                beforeSend: function() {
                    $(".body-overlay_questions").show();
                },
                success: function(result) {
                    $(".body-overlay_questions").hide();
                    var by = 1,
                        sel = 1;
                    $.each(result, function(key, val) {
                        if (val.question_type == 2) {
                            key = by;
                            by = 1 + by;
                            var utyp = 'buyer';
                            var apen = $('#BuyerQuestions');
                        }
                        if (val.question_type == 3) {
                            key = sel;
                            sel = 1 + sel;
                            var utyp = 'seller';
                            var apen = $('#SellerQuestions');
                        }
                        var htm = '<fieldset class="askquestioncount_' + utyp + '">' +
                            '<div class="panel-group acc-v1 " id="accordion-' + utyp + '-' +
                            key + '">' +
                            '<div class="panel panel-default">' +
                            '<div class="panel-heading">' +
                            '<h4 class="panel-title">' +
                            '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-' +
                            utyp + '-' + key + '" href="#collapse-' + utyp + '-' + key + '">' +
                            '<b>' + (key) + ') <span class="q-s-' + val.question_id + '">' + val
                            .question + '<span></b>' +
                            '<span href="#" class="sitegreen pull-right"> <i class="fa fa-edit  marginediticon"> </i> <small> Edit </small></span>';
                        // '<span class="clicksurvey_'+val.question_id+'">';
                        // if(val.survey==0){
                        //   htm +='<span href="#" class="green pull-right" onclick="survey('+val.question_id+');"> <i class="fa fa-check-circle-o"> </i> <small>Survey</small> | </span>';
                        // }else{
                        //   htm +='<span href="#" class="red pull-right" onclick="surveyremove('+val.question_id+');"> <i class="fa fa-times-circle-o"> </i> <small>Survey</small> | </span>';
                        // } 
                        // </span>
                        htm += '</a>' +
                            '</h4>' +
                            '</div>' +
                            '<div id="collapse-' + utyp + '-' + key +
                            '" class="panel-collapse collapse">' +
                            '<div class="panel-body">' +
                            '<div class="row">' +
                            '<form action="#" class="sky-form enters-questions-to-ask">' +
                            '<fieldset>' +
                            '<div class="hide question-ask-msg-' + val.question_id +
                            '"></div>' +
                            '<section>' +
                            '<label class="textarea ">' +
                            '<textarea rows="2" class="field-border" name="questions_to_ask_' +
                            key + '" id="question_default_' + key +
                            '" placeholder="Enter Question">' + val.question + '</textarea>' +
                            '<b class="error-text" id="questions_to_ask_' + key +
                            '_error"></b>' +
                            '</label>' +
                            '</section>' +
                            '<input type="hidden" name="question_id" value="' + val
                            .question_id + '">' +
                            '<button type="submit" class="btn-u pull-right">Change</button>' +
                            '</fieldset>' +
                            '</form>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</fieldset>';

                        apen.append(htm);
                    });
                }
            });
            $('#enters-questions-to-ask').submit(function(e) {
                e.preventDefault();
                var question = e.target[2].value;
                var question_id = e.originalEvent.srcElement[3].value;
                var fieldname = e.originalEvent.srcElement[2].name;
                var esmsg = $(".question-ask-msg-" + question_id);

                $.ajax({
                    url: "{{ url('/agentadmin/') }}/updatequestion",
                    type: 'POST',
                    data: {
                        question_id: question_id,
                        question: question,
                        _token: '{{ csrf_token() }}',
                        add_by: '{{ $user->id }}',
                        add_by_role: '{{ $user->agents_users_role_id }}'
                    },
                    success: function(result) {
                        $('.error-text').text('');
                        $('.field-border').removeClass('error-border');
                        if (typeof result.error != 'undefined' && result.error != null) {
                            $.each(result.error, function(key, value) {
                                $('#' + fieldname + '_error').removeClass(
                                    'success-text').addClass('error-text').text(
                                    value);
                                $('#' + fieldname).addClass('error-border');
                            });
                            esmsg.text('').addClass('hide');
                        }
                        if (typeof result.msg != 'undefined' && result.msg != null) {

                            esmsg.text('').css({
                                'color': 'green'
                            });
                            esmsg.removeClass('hide').addClass(
                                'show alert alert-success text-center').text(result.msg);
                            // setTimeout(location.reload(),5000);
                            $('.q-s-' + question_id).text(question);
                            setInterval(function() {
                                esmsg.text('').addClass('hide').removeClass(
                                    'show alert-success');
                            }, 5000);
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
                        setInterval(function() {
                            esmsg.text('').addClass('hide').removeClass('show');
                        }, 5000);
                    }
                });
            });

        });

        /*load proposal */
        function loadproposal(limit) {

            $.ajax({
                url: "{{ url('/agentadmin/') }}/agent/proposal/get/ten/" + limit +
                    "/{{ $user->id }}/{{ $user->agents_users_role_id }}",
                type: 'get',
                beforeSend: function() {
                    $(".loadproposal").show();
                },
                processData: false,
                contentType: false,
                success: function(result) {
                    $(".loadproposal").hide();
                    if (result.count !== 0) {

                        $.each(result.result, function(key, value) {
                            proposale_data[value.proposals_id] = value;

                            var extension = value.proposals_attachments.substr((value
                                .proposals_attachments.lastIndexOf('.') + 1));
                            extension = extension.toLowerCase();
                            var docep = '';
                            if (extension == 'png' || extension == 'jpg' || extension == 'jpeg' ||
                                extension == 'gif' || extension == 'tif') {
                                docep = '<img    class="documen document_' + value.proposals_id +
                                    '" src="' + value.proposals_attachments +
                                    '" frameborder="0" scrolling="no" width="225" height="142">';
                            } else {
                                docep = '<iframe   class="documen document_' + value.proposals_id +
                                    '" src="https://docs.google.com/viewer?url=' + value
                                    .proposals_attachments +
                                    '&embedded=true" frameborder="0" scrolling="no" width="225" height="142"></iframe>';
                            }
                            var htmll = '<div class="col-md-4">' +
                                '<div class="thumbnails thumbnail-style thumbnail-kenburn">' +
                                '<div class="cbp-caption thumbnail-img">' +
                                '<div class="overflow-hidden cbp-caption-defaultWrap">' +
                                docep +
                                '</div>' +
                                '<div class="removehover cbp-caption-activeWrap">' +
                                '<div class="cbp-l-caption-alignCenter">' +
                                '<div class="cbp-l-caption-body">' +
                                '<ul class="link-captions no-bottom-space">' +
                                '<li><a class="cursor" title="View" onclick="openpropop(' + value
                                .proposals_id + ')" id="' + value.proposals_id +
                                '"><i class="rounded-x fa fa-eye"></i></a>' +
                                '<li><a class="cursor" Title="Remove" onclick="removeproposal(' + value
                                .proposals_id + ')" id="' + value.proposals_id +
                                '"><i class="rounded-x fa fa-trash-o"></i></a>' +
                                '</ul>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="caption cbp-title-dark">' +
                                '<span class="cbp-l-grid-agency-title"><a class="cursor hover-effect" onclick="openpropop(' +
                                value.proposals_id + ')"   title="' + value.proposals_attachments +
                                '"><strong>' + value.proposals_title + '</strong></a></span>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            $('#append-proposal-ajax').append(htmll);
                        });
                        if (result.next != 0) {
                            $('#loadmoreproposal').removeClass('hide').attr('title', result.next);
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

        function openpropop(el) {
            var src = proposale_data[el].proposals_attachments;
            var text = proposale_data[el].proposals_title;
            $('.proposal-popup-title').text(text);
            var extension = src.substr((src.lastIndexOf('.') + 1));
            extension = extension.toLowerCase();
            var docs = '';
            if (extension == 'png' || extension == 'jpg' || extension == 'jpeg' || extension == 'gif' || extension ==
                'tif') {
                docs = '<img     class="documen document_' + proposale_data[el].proposals_id + '" src="' + proposale_data[
                    el].proposals_attachments + '" frameborder="0" scrolling="no"  width="100%" height="300">';
            } else {
                docs = '<iframe  class="documen document_' + proposale_data[el].proposals_id +
                    '" src="https://docs.google.com/viewer?url=' + proposale_data[el].proposals_attachments +
                    '&embedded=true" frameborder="0" scrolling="no"  width="100%" height="300"></iframe>';
            }
            $('.append-src-ifram').html(docs);
            $('#open-proposal-popup').modal('show');
        }

        function removeproposal(el) {
            var text = proposale_data[el].proposals_title;

            $('.proposal-popup-title').text(text);
            $('#proposaledeleteconfirm')
                .modal({
                    backdrop: 'static',
                    keyboard: false
                })
                .one('click', '#delete', function(e) {

                    $.ajax({
                        url: "{{ url('/agentadmin/') }}/agent/proposal/delete/" + el,
                        type: 'get',
                        beforeSend: function() {
                            $(".body-overlay").show();
                        },
                        processData: false,
                        success: function(result) {
                            $(".body-overlay").hide();
                            if (result.status == 'error') {
                                $('.proposal-delete-msg').addClass('alert alert-danger text-center').text(
                                    result.msg);
                            } else {
                                $('.proposal-delete-msg').addClass('alert alert-success text-center').text(
                                    result.msg);
                            }
                            setTimeout(location.reload(), 7000);
                        },
                        error: function(data) {
                            $(".body-overlay").hide();
                        }

                    });

                });

        }
        /*load uploadandshare */
        function loaduploadandshare(limit) {

            $.ajax({
                url: "{{ url('/agentadmin/') }}/uploadshare/get/ten/" + limit +
                    "/{{ $user->id }}/{{ $user->agents_users_role_id }}",
                type: 'get',
                beforeSend: function() {
                    $(".loaduploadshare").show();
                },
                processData: false,
                contentType: false,
                success: function(result) {
                    $(".loaduploadshare").hide();
                    // console.log(result);
                    if (result.count !== 0) {
                        $.each(result.result, function(key, value) {
                            uploadshare_data[value.upload_share_id] = value;
                            var extension = value.attachments.substr((value.attachments.lastIndexOf(
                                '.') + 1));
                            extension = extension.toLowerCase();
                            var docs = '';
                            if (extension == 'png' || extension == 'jpg' || extension == 'jpeg' ||
                                extension == 'gif' || extension == 'tif') {
                                docs = '<img     class="documen document_' + value.upload_share_id +
                                    '" src="' + value.attachments +
                                    '" frameborder="0" scrolling="no"  width="225" height="142">';
                            } else {
                                docs = '<iframe  class="documen document_' + value.upload_share_id +
                                    '" src="https://docs.google.com/viewer?url=' + value.attachments +
                                    '&embedded=true" frameborder="0" scrolling="no"  width="225" height="142"></iframe>';
                            }
                            var htmll = '<div class="col-md-4">' +
                                '<div class="thumbnails thumbnail-style thumbnail-kenburn">' +
                                '<div class="cbp-caption thumbnail-img">' +
                                '<div class="overflow-hidden cbp-caption-defaultWrap">' + docs +
                                '</div>' +
                                '<div class="removehover cbp-caption-activeWrap">' +
                                '<div class="cbp-l-caption-alignCenter">' +
                                '<div class="cbp-l-caption-body">' +
                                '<ul class="link-captions no-bottom-space">' +
                                '<li><a class="cursor" title="View" onclick="openuploadshare(' + value
                                .upload_share_id + ')"><i class="rounded-x fa fa-eye"></i></a>' +
                                '<li><a class="cursor" title="Remove" onclick="removeuploadshare(' +
                                value.upload_share_id +
                                ')"><i class="rounded-x fa fa-trash-o"></i></a>' +
                                '</ul>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            $('#append-uploadshares-ajax').append(htmll);
                        });
                        if (result.next != 0) {
                            $('#loaduploadandshare').removeClass('hide').attr('title', result.next);
                        } else {
                            $('#loaduploadandshare').addClass('hide');
                        }
                    }

                },
                error: function(data) {
                    $(".loaduploadshare").hide();
                    if (data.status == '500') {
                        $('.loaduploadshare').text(data.statusText).css({
                            'color': 'red'
                        });
                    } else if (data.status == '422') {
                        $('.loaduploadshare').text(data.responseJSON.image[0]).css({
                            'color': 'red'
                        });
                    }
                }
            });
        }

        function openuploadshare(el) {
            var src = uploadshare_data[el].attachments;
            var extension = uploadshare_data[el].attachments.substr((uploadshare_data[el].attachments.lastIndexOf('.') +
                1));
            extension = extension.toLowerCase();
            var docs = '';
            if (extension == 'png' || extension == 'jpg' || extension == 'jpeg' || extension == 'gif' || extension ==
                'tif') {
                docs = '<img     class="documen document_uploadfiles_' + uploadshare_data[el].upload_share_id + '" src="' +
                    uploadshare_data[el].attachments + '" frameborder="0" scrolling="no" width="100%" height="300">';
            } else {
                docs = '<iframe  class="documen document_uploadfiles_' + uploadshare_data[el].upload_share_id +
                    '" src="https://docs.google.com/viewer?url=' + uploadshare_data[el].attachments +
                    '&embedded=true" frameborder="0" scrolling="no" width="100%" height="300"></iframe>';
            }
            var hh = docs;
            $('.uploadshare-src-ifram').html(hh);
            $('#open-uploadshare-popup').modal('show');
        }

        function removeuploadshare(el) {

            $('#uploadsharedeleteconfirm')
                .modal({
                    backdrop: 'static',
                    keyboard: false
                })
                .one('click', '#delete', function(e) {

                    $.ajax({
                        url: "{{ url('/agentadmin/') }}/uploadshare/delete/" + el,
                        type: 'get',
                        beforeSend: function() {
                            $(".body-overlay").show();
                        },
                        processData: false,
                        success: function(result) {
                            $(".body-overlay").hide();
                            if (result.status == 'error') {
                                $('.upload-delete-msg').addClass('alert alert-danger text-center').text(
                                    result.msg);
                            } else {
                                $('.upload-delete-msg').addClass('alert alert-success text-center').text(
                                    result.msg);
                            }
                            setTimeout(location.reload(), 7000);
                        },
                        error: function(data) {
                            $(".body-overlay").hide();
                        }

                    });

                });

        }
    </script>
@stop
