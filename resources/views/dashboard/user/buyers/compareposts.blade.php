@extends('dashboard.master')
@section('style')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/pages/shortcode_timeline2.css') }}">
@stop
@section('title', 'Profile')
@section('content')
    <?php $topmenu = 'my_post'; ?>
    <?php $activemenu = 'compareposts'; ?>
    @include('dashboard.include.sidebar')
    <!--=== Profile ===-->
    <div class="container content profile">
        <div class="row">
            <!--Left Sidebar-->
            @include('dashboard.user.buyers.include.sidebar')
            <!--End Left Sidebar-->

            <!-- Profile Content -->
            <div class="col-md-12">
                <h2><b>Select Post to Compare</b></h2>
                <div class="box-shadow-profile ">
                    <div class="panel-profile">
                        <div class="panel-heading overflow-h air-card">
                            <h2 class="heading-sm pull-left"> Posts </h2>
                        </div>

                        <div class="post_wrap"></div>

                        <div class="col-md-12 center loder margin-bottom-5 loading_gif">
                            <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" />
                        </div>

                        <div id="list_resp_message" class="alert alert-danger list_resp_message hide" role="alert">
                            This is an alert!
                        </div>

                        <div class="text-center">
                            <button type="button" id="load_new_posts" data-page="0" class="btn-u btn-u-default btn-u-sm ">
                                Load More Posts
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End Profile Content -->

    </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        var postdata = [];

        /* post  */
        $(document).ready(function() {
            load_new_posts();
        });


        $('#load_new_posts').click(function(e) {
            e.preventDefault();
            load_new_posts();
        });

        function load_new_posts() {
            var cur_page = $('#load_new_posts').attr('data-page');
            var nxt_page = parseInt(cur_page, 10) + 1;

            $(".list_resp_message").addClass('hide')

            $.ajax({
                url: "{{ url('/') }}/profile/buyer/post/get/",
                type: 'GET',
                data: {
                    page: nxt_page,
                },
                beforeSend: function() {
                    $(".loading_gif").show();
                },
                success: function(result) {
                    var data = result.data;
                    var errors = result.errors;
                    var message = result.message;
                    var misc = result.misc;
                    var paginate = result.paginate;

                    var count = misc.count;

                    if (count == 0) {
                        if (cur_page == 0) {
                            $(".list_resp_message").removeClass(function(index, className) {
                                return (className.match(/(^|\s)alert-\S+/g) || []).join(' ');
                            });

                            $(".list_resp_message").addClass('alert-warning').html(
                                'No agent is connected to you. <a href="{{ URL('/agents') }}"> Find Agents..'
                            ).removeClass('hide');
                        }

                        $(".loading_gif").hide();
                        return true;
                    }

                    if (paginate.current_page == cur_page) {
                        return true;
                    }

                    $.each(data, function(key, value) {
                        postdata[value.post_id] = value;

                        var city = value.city;
                        var state = value.state;
                        var user = value.user;
                        var user_details = value.user_details;
                        var connections = value.connections;

                        var location_var =
                            `No location provided yet!`;

                        if (value.address1 != null || city != null || state != null || value.zip !=
                            null) {
                            location_var =
                                (value.address1 != null ? ` ${value.address1}` : ``) +
                                (city != null ? ` ${city.city_name}` : ``) +
                                (state != null ? ` ${state.state_name}` : ``) +
                                (value.zip != null ? ` ${value.zip}` : ``);
                        }

                        var date = "Some days ago";

                        if (value.created_at) {
                            date = dayjs(value.created_at).fromNow();
                        }

                        var close_date = 'Not updated yet';

                        if (value.closing_date != null) {
                            close_date = new Date(Date.fromISO(value.closing_date)).toISOString().slice(
                                0, 10);
                        }

                        var htm = `<div class="border1-bottom">` +
                            `<div class="funny-boxes acposts">` +
                            `<h2 class="title margin-bottom-0"><a target="_blank" onclick="comapretoselecteagents('${value.post_id}');">${value.posttitle}</a></h2>` +
                            `<div class="funny-boxes-img">` +
                            `<ul class="list-inline margin-bottom-5">` +
                            `<li><i class="fa-fw fa fa-map-marker"></i> ${location_var}</li>` +
                            `<li><i class="fa fa-clock-o"></i> ${date}</li>` +
                            `</ul>` +
                            `</div>`;

                        if (value.details) {
                            htm +=
                                `<div onlick="redarecturl('/search/post/details/${value.post_id}')" class="limited-post-text hidetext2line margin-bottom-10" >${value.details}</div>`;
                        }

                        htm += `<ul class="list-inline margin-bottom-0">`;

                        if (value.applied_post == 2) {
                            htm +=
                                `<li><a class="cursor" onclick="post_Edit(${value.post_id});"> <b>Edit Post</b></a></li> | `;
                        }

                        htm +=
                            `<li><a class="cursor" target="_blank" href="/profile/buyer/post/details/${value.post_id}"><b>Details</b></a></li> | ` +
                            `<li><a rel="popover" data-popover-content="#myPopover${value.post_id}"><b>Agents Applied: </b>${value.post_view_count}</a></li> | ` +
                            `<li><b>Closing date: </b>${close_date}</li>` +
                            `</ul>` +
                            `</div>` +
                            `<div id="myPopover${value.post_id}" class="hide">` +
                            `<div class="panel panel-profile">` +
                            `<div class="panel-heading overflow-h border1-bottom">` +
                            `<h2 class="panel-title heading-sm pull-left color-black"><i class="fa fa-users"></i> Active Agents</h2>` +
                            `</div>` +
                            `<div id="postagentshowinpopup" class="panel-body no-padding" data-mcs-theme="minimal-dark">`;

                        if (value.post_view_count != 0) {
                            $.each(value.connections, function(key, agentdata) {
                                var adate = timeDifference(new Date(), new Date(Date
                                    .fromISO(agentdata.created_at)));
                                // console.log(agentdata);
                                if (agentdata.photo) {
                                    var photo =
                                        '<img class="rounded-x" src="{{ URL::asset('assets/img/profile/') }}/' +
                                        agentdata.photo + '">';
                                } else {
                                    var photo =
                                        '<img class="rounded-x" src="{{ URL::asset('assets/img/testimonials/user.jpg') }}" alt="">';
                                }

                                var selectedclass = '';
                                var title = '';
                                if (value.applied_post == 1 && value.applied_user_id ==
                                    agentdata.details_id) {
                                    selectedclass = 'agents_selected';
                                    title = `Selected this agent for post - ${value.posttitle}`;
                                }

                                htm +=
                                    `<div onclick="onclickagent('${agentdata.details_id}','${value.post_id}');" title="${title}" class="${selectedclass} cursor alert-blocks alert-dismissable">${photo}<div class="overflow-h" style="margin-top:10px;">` +
                                    `<strong class="color">` + agentdata.name +
                                    ` <small class="pull-right" style="margin-left: 20px;"><em>${adate}</em></small></strong>` +
                                    `<div class="hidetext1line">` + (agentdata.description !=
                                        null ? agentdata.description : `&nbsp;`) + `</div>` +
                                    `</div>` +
                                    `</div>`;
                            });
                        } else {
                            htm +=
                                `<div class="cursor alert-blocks alert-dismissable"> No Applied Agents </div>`;
                        }
                        htm += `</div>` +
                            `</div>` +
                            `</div>` +
                            `</div>`;

                        $('.post_wrap').append(htm);
                    });

                    $(document).on("click", ".popover .close", function() {
                        $(this).parents(".popover").popover('hide');
                    });

                    cur_page = nxt_page;
                    $('#load_new_posts').attr('data-page', nxt_page);

                    $(".loading_gif").hide();
                },
                error: function(data) {
                    $(".list_resp_message").removeClass(function(index, className) {
                        return (className.match(/(^|\s)alert-\S+/g) || []).join(' ');
                    });

                    $(".list_resp_message").addClass('alert-danger');

                    if (data.status == '500') {
                        $('.list_resp_message').html(data.statusText);
                    } else if (data.status == '422') {
                        $('.list_resp_message').html(data.responseJSON.image[0]);
                    }
                }
            });

        }

        function onclickagent(d, p) {
            window.location.href = '{{ URL('/') }}/search/agents/details/' + d + '/' + p;
        }

        function comapretoselecteagents(post_id) {
            var postdata1 = postdata[post_id];
            $.ajax({
                url: "{{ url('/') }}/profile/buyer/post/details/agents/get/few/" + post_id + "/" + postdata1
                    .agents_user_id + "/" + postdata1.agents_users_role_id,
                type: 'get',
                beforeSend: function() {
                    $(".loadredirectcompare").show();
                },
                processData: true,
                success: function(result) {
                    console.log(result);
                    var proppos = result;
                    $(".loadredirectcompare").hide();
                    if (proppos.count !== 0) {
                        $.each(proppos.result, function(key, value) {
                            $.ajax({
                                url: "{{ url('/compare/insert') }}",
                                type: 'post',
                                data: {
                                    post_id: post_id,
                                    compare_item_id: value.id,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(result) {},
                                error: function(result) {}
                            });
                        });
                    }
                    window.location.href = '{{ URL('/') }}/profile/buyer/post/details/' + post_id +
                        '/compare';
                },
                error: function(data) {}
            });
        }
    </script>
@stop
