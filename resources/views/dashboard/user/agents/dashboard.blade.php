@extends('dashboard.master')

@section('title', 'home page')

@section('style')
<style>
    @keyframes popBounce {
    0%, 100% {
      transform: translateY(-50%) scale(1);
    }
    50% {
      transform: translateY(-50%) scale(1.2);
    }
  }
</style>
@endsection

@section('content')

    <?php $topmenu = 'Home'; ?>
    <?php $activemenu = 'dashboard'; ?>

    @include('dashboard.include.sidebar')

    <div class="container content profile">
        <div class="row">
            <!--Left Sidebar-->
            @include('dashboard.user.agents.include.sidebar')
            @include('dashboard.user.agents.include.sidebar-dashbord')
            <!--End Left Sidebar-->

            <!-- Profile Content -->
            <div class="col-md-9">
                <div style="display:flex;align-items:center;justify-content:space-between">
                <h1 class="margin-bottom-40">Welcome to your Dashboard.</h1>
                <div class="margin-bottom-30">
                <a href="{{route('agent-advertisement')}}" class="btn-u">Advertise Your Skills</a>
                <a href="{{route('get-agent-rating',auth()->id())}}" class="btn-u">Ratings</a>
                </div>
                </div>
                <div class="box-shadow-profile hide homedata homedatanotes margin-bottom-40">
                    <!-- Default Proposals -->
                    <div class="panel-profile">
                        <div class="panel-heading overflow-h air-card">
                            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-commenting"></i>Notes</h2>
                            <a href="{{ url('/' . str_replace(' ', '', $userdetails->name) . '/notes/') }}" class="cursor pull-right">See All</a>
                        </div>

                        <div id="scrollbar" class="panel-body no-padding mCustomScrollbar" data-mcs-theme="minimal-dark">
                        </div>

                        <input type="hidden" name="notes-more-load" id="notes-more-load">

                        <div class="center">
                            <img src="{{ url('/assets/img/loder/loading.gif') }}" class="messageloadertop notes-loader" width="40px" height="40px"/>
                        </div>
                    </div>
                    <!-- Default Proposals -->
                </div>

                <div class="box-shadow-profile hide homedata homedataBookmark margin-bottom-40">
                    <!-- Default Proposals -->
                    <div class="panel-profile">
                        <div class="panel-heading overflow-h air-card">
                            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-star"></i>Bookmark List</h2>
                            <a href="{{ url('/' . str_replace(' ', '', $userdetails->name) . '/bookmark/') }}" class="cursor pull-right">See All</a>
                        </div>

                        <div id="scrollbar2" class="panel-body no-padding mCustomScrollbar" data-mcs-theme="minimal-dark">
                        </div>

                        <input type="hidden" name="bookmark-more-load" id="bookmark-more-load">

                        <div class="center">
                            <img src="{{ url('/assets/img/loder/loading.gif') }}" class="messageloadertop bookmark-loader" width="40px" height="40px"/>
                        </div>
                    </div>
                    <!-- Default Proposals -->
                </div>

                <div class="box-shadow-profile hide homedata homedataposts">
                    <!-- Default Proposals -->
                    <div class="panel-profile">
                        <div class="panel-heading overflow-h air-card">
                            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-newspaper-o"></i>list of selected posts.</h2>
                        </div>

                        <div id="scrollbar3" class="panel-body no-padding mCustomScrollbar" data-mcs-theme="minimal-dark">
                        </div>

                        <input type="hidden" name="selectedagent-more-load" id="selectedagent-more-load">

                        <div class="center">
                            <img src="{{ url('/assets/img/loder/loading.gif') }}" class="messageloadertop selectedagent-loader" width="40px" height="40px"/>
                        </div>
                    </div>
                    <!-- Default Proposals -->
                </div>

            </div>
            <!-- End Profile Content -->
        </div>
    </div>

    <!-- survey popup -->
    <div class="modal fade" id="deletefromnb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content not-top">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title-text"></h4>
                </div>

                <div class="modal-body">
                    <br>
                    <div class="body-overlay body-overlay-nb">
                        <div>
                            <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px"/>
                        </div>
                    </div>
                    <p class="model-bodu-text">Are you sure remove?</p>
                </div>

                <div class="modal-footer foote-nb">
                    <button type="button" class="btn-u btn-u-primary delete">Sure</button>
                    <button type="button" class="btn-u btn-u-default" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>


    @if ($pending_post_count > 0)
        <!-- Pending Closed POst Count -->
        <div id="pending_closed_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Attention Agents</h4>
                    </div>
                    <div class="modal-body">
                        You have {{ $pending_post_count }} pending post(s), please navigate to the <a href="{{ url('/agent/selected/post') }}">Selected Posts</a> and update the closing date.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    @endif

@endsection

@section('scripts')

    <script type="text/javascript">

        var pending_post_count = {{ $pending_post_count }};
        if (pending_post_count > 0) {
            $('#pending_closed_modal').modal('show');
        }

        let bookmark_data = [];
        let notes_data = [];
        let selectedagent_data = [];

        $(document).ready(function () {
            loadbookmark(0);
            loadnotes(0);
            loadselectedagents(0);
        });

        /*load Bookmark */
        function loadbookmark(limit) {
            if (limit === 0) {
                $('#scrollbar2 .mCustomScrollBox .mCSB_container').html('');
            }

            $.ajax({
                url: "{{ url('/bookmarked/list/get/') }}/" + limit,
                type: 'get',
                beforeSend: function () {
                    $(".bookmark-loader").show();
                },
                processData: false,
                contentType: false,
                success: function (result) {
                    $(".bookmark-loader").hide();

                    if (result.count !== 0) {
                        $('.homedataBookmark').removeClass('hide').addClass('show');
                        $.each(result.result, function (key, value) {
                            bookmark_data[value.bookmark_id] = value;

                            let usertype = '';
                            let url = '';

                            if (value.bookmark_type === 1) {
                                usertype = '<strong>Question  -> Post</strong> <span>(' + value.post_text + ')</span>';
                                url = '{{ url("/search/post/details/") }}/' + value.bookmark_item_parent_id + '/8';
                            }

                            if (value.bookmark_type === 2) {
                                if (value.receiver_role === 2) {
                                    usertype = '<strong>Buyer for Post </strong><span>(' + value.post_text + ')</span>';
                                }
                                if (value.receiver_role === 3) {
                                    usertype = '<strong>Sellar for Post </strong><span>(' + value.post_text + ')</span>';
                                }
                                if (value.receiver_role === 4) {
                                    usertype = '<strong>Agents for Post </strong><span>(' + value.post_text + ')</span>';
                                }
                                url = '{{ url("/search/post/details/") }}/' + value.bookmark_item_parent_id;
                            }

                            if (value.bookmark_type === 3) {
                                usertype = '<strong>Message</strong> (' + value.name + ')  -> <strong>Post </strong><span>(' + value.post_text + ')</span>';
                                url = '{{ url("/messages/") }}/' + value.post_id + '/' + value.message_id + '/' + value.message_role_id;
                            }

                            if (value.bookmark_type === 4) {
                                usertype = '<strong>Asked Question Answer -> Post </strong><span>(' + value.post_text + ')</span>';
                                url = '{{ url("/search/post/details/") }}/' + value.post_id + '/10';
                            }

                            let date = timeDifference(new Date(), new Date(Date.fromISO(value.created_at)));
                            let bhtml = '<div class="profile-event border1-bottom" id="bookmark_id_' + value.bookmark_id + '">' +
                                '<div class="width-90 profile-post-in">' +
                                '<a class="cursor" onclick="redarecturl(\'' + url + '\');"><h3 class="heading-xs hidetext2line">' + usertype + '</h3></a>' +
                                '<p class="displayinherit"><span>' + value.bookmark_text + '</span> <span class=""><i class="fa fa-clock-o"> </i> <small> ' + date + '</small></span> </p>' +
                                '</div>' +
                                '<span class="width-10 profile-post-icon-remove" title="Remove bookmark from list" onclick="removebookmark(' + value.bookmark_id + ');"><i class="fa  fa-trash"></i></span>' +
                                '</div>';

                            let msc = $('#bookmark_id_' + value.bookmark_id).find('#scrollbar2 .mCustomScrollBox .mCSB_container');
                            let msct = msc.prevObject.length;

                            if (msct === 0) {
                                if (limit === 0) {
                                    $('#scrollbar2 .mCustomScrollBox .mCSB_container').append(bhtml);
                                } else {
                                    $('#scrollbar2 .mCustomScrollBox .mCSB_container .mCustomScrollBox .mCSB_container').append(bhtml);
                                }
                            } else {
                                $('#bookmark_id_' + value.bookmark_id).replaceWith(bhtml);
                            }
                        });

                        if (result.next !== 0) {
                            $('#bookmark-more-load').val(result.next);
                        } else {
                            $('#bookmark-more-load').val('');
                        }

                        if (limit === 0) {
                            $("#scrollbar2 .mCustomScrollBox .mCSB_container").mCustomScrollbar({
                                theme: "minimal-dark",
                                callbacks: {
                                    onTotalScroll: function () {
                                        if ($('#bookmark-more-load').val() != 0) {
                                            loadbookmark($('#bookmark-more-load').val());
                                        }
                                    }
                                }
                            });
                        }
                    } else {
                        $('#scrollbar2 .mCustomScrollBox .mCSB_container').html('<p class="profile-event">No bookmark available in list.</p>');
                    }

                },
                error: function (data) {
                    $("#scrollbar2 .mCustomScrollBox .mCSB_container").hide();
                    if (data.status === '500') {
                        $('#scrollbar2 .mCustomScrollBox .mCSB_container').text(data.statusText).css({'color': 'red'});
                    } else if (data.status === '422') {
                        $('#scrollbar2 .mCustomScrollBox .mCSB_container').text(data.responseJSON.image[0]).css({'color': 'red'});
                    }
                }
            });
        }

        /*load notes */
        function loadnotes(limit) {
            if (limit === 0) {
                $('#scrollbar .mCustomScrollBox .mCSB_container').html('');
            }

            $.ajax({
                url: "{{ url('/notes/list/get/') }}/" + limit,
                type: 'get',
                beforeSend: function () {
                    $(".notes-loader").show();
                },
                processData: false,
                contentType: false,
                success: function (result) {
                    $(".notes-loader").hide();

                    if (result.count !== 0) {
                        $('.homedatanotes').removeClass('hide').addClass('show');

                        $.each(result.result, function (index, value) {
                            notes_data[value.notes_id] = value;

                            let usertype = '';
                            let url = '';


                            if (value.notes_type === 1) {
                                usertype = 'Message';
                                url = '{{ url("/messages/") }}/' + value.post_id + '/' + value.receiver_id + '/' + value.receiver_role;
                            }

                            if (value.notes_type === 2) {
                                usertype = 'Asked Question';
                                url = '{{ url("/search/post/details/") }}/' + value.post_id + '/8';
                            }

                            if (value.notes_type === 3) {
                                usertype = 'Asked Question Answer';
                                url = '{{ url("/search/post/details/") }}/' + value.post_id + '/10';
                            }

                            let date = timeDifference(new Date(), new Date(Date.fromISO(value.created_at)));

                            let bhtml = '<div class="profile-post border1-bottom" id="notes_id_' + value.notes_id + '">' +
                                '<span class="width-5 profile-post-numb">' + (index + 1) + '</span>' +
                                '<div class="width-85 profile-post-in">' +
                                '<h3 class="heading-xs hidetext2line"><a class="cursor" onclick="redarecturl(\'' + url + '\');"><strong>' + usertype + '</strong> (' + value.notes_type_text + ') for <strong>Post</strong> (' + value.post_text + ')</a></h3>' +
                                '<strong class="float-left"> Note : </strong> <div style="display: inline-flex;" class="hidetext1line">' + value.notes + '</div> <span class=""><i class="fa fa-clock-o"> </i> <small> ' + date + '</small></span>' +
                                '</div>' +
                                '</div>';

                            let msc = $('#notes_id_' + value.notes_id).find('#scrollbar .mCustomScrollBox .mCSB_container');
                            let msct = msc.prevObject.length;

                            if (msct === 0) {
                                if (limit === 0) {
                                    $('#scrollbar .mCustomScrollBox .mCSB_container').append(bhtml);
                                } else {
                                    $('#scrollbar .mCustomScrollBox .mCSB_container .mCustomScrollBox .mCSB_container').append(bhtml);
                                }
                            } else {
                                $('#notes_id_' + value.notes_id).replaceWith(bhtml);
                            }
                        });


                        if (result.next !== 0) {
                            $('#notes-more-load').val(result.next);

                        } else {
                            $('#notes-more-load').val('');
                        }

                        if (limit === 0) {
                            $("#scrollbar .mCustomScrollBox .mCSB_container").mCustomScrollbar({
                                theme: "minimal-dark",
                                callbacks: {
                                    onTotalScroll: function () {
                                        if ($('#notes-more-load').val() != 0) {
                                            loadnotes($('#notes-more-load').val());
                                        }
                                    }
                                }
                            });
                        }
                    } else {
                        $('#scrollbar .mCustomScrollBox .mCSB_container').html('<p class="profile-event">No notes available in list.</p>');
                    }

                },
                error: function (data) {
                    $("#scrollbar .mCustomScrollBox .mCSB_container").hide();
                    if (data.status === '500') {
                        $('#scrollbar .mCustomScrollBox .mCSB_container').text(data.statusText).css({'color': 'red'});
                    } else if (data.status === '422') {
                        $('#scrollbar .mCustomScrollBox .mCSB_container').text(data.responseJSON.image[0]).css({'color': 'red'});
                    }
                }
            });
        }

        function removenotes(id) {
            $('.model-bodu-text').removeClass('alert alert-success alert-danger text-center').text('Are you sure this note remove in note list?');
            $('.modal-title-text').text('Note');
            $('.foote-nb').show();
            $('#deletefromnb')
                .modal({backdrop: 'static', keyboard: false})
                .one('click', '.delete', function (e) {
                    $.ajax({
                        url: "{{url('/notes/delete/by/')}}" + "/" + id,
                        type: 'get',
                        beforeSend: function () {
                            $('.foote-nb').hide();
                            $(".body-overlay-nb").show();
                        },
                        success: function (result) {
                            $(".body-overlay-nb").hide();
                            $('.model-bodu-text').addClass('alert alert-success text-center').text('Removed from note.');
                            $('#notes_id_' + id).remove();
                            anymodelhideinfewsecond('#deletefromnb');
                            loadnotes(0);
                        },
                        error: function (data) {
                            $(".body-overlay-nb").hide();
                        }
                    });
                });
        }

        function removebookmark(id) {
            $('.model-bodu-text').removeClass('alert alert-success alert-danger text-center').text('Are you sure this bookmark remove in bookmark list?');
            $('.modal-title-text').text('Note');
            $('.foote-nb').show();
            $('#deletefromnb')
                .modal({backdrop: 'static', keyboard: false})
                .one('click', '.delete', function (e) {
                    $.ajax({
                        url: "{{url('/bookmarked/delete/by/')}}" + "/" + id,
                        type: 'get',
                        beforeSend: function () {
                            $('.foote-nb').hide();
                            $(".body-overlay-nb").show();
                        },
                        success: function (result) {
                            $(".body-overlay-nb").hide();
                            $('.model-bodu-text').addClass('alert alert-success text-center').text('Removed from bookmarks.');
                            $('#bookmark_id_' + id).remove();
                            anymodelhideinfewsecond('#deletefromnb');
                            loadbookmark(0);
                        },
                        error: function (data) {
                            $(".body-overlay-nb").hide();
                        }
                    });
                });
        }

        /*load notes */
        function loadselectedagents(limit) {
            if (limit === 0) {
                $('#scrollbar3 .mCustomScrollBox .mCSB_container').html('');
            }

            $.ajax({
                url: "{{ url('/applied/post/list/get/') }}/" + limit + "/{{ $user->id }}/{{ $user->agents_users_role_id }}/1",
                type: 'get',
                beforeSend: function () {
                    $(".selectedagent-loader").show();
                },
                success: function (result) {
                    $(".selectedagent-loader").hide();

                    if (result.count !== 0) {
                        $('.homedataposts').removeClass('hide').addClass('show');
                        $.each(result.result, function (index, value) {
                            selectedagent_data[value.post_id] = value;

                            let usertype = '';
                            let purl = '{{ URL("/") }}/search/post/details/' + value.post_id;
                            let date = timeDifference(new Date(), new Date(Date.fromISO(value.pupdated_at)));

                            let bhtml = '<div class="profile-post border1-bottom" id="selectedagent_id_' + value.post_id + '">' +
                                '<div class="width-100 profile-post-in">' +
                                '<span class="profile-post-numb">' + (index + 1) + '</span>' +
                                '<h3 class="heading-xs hidetext2line"><span>You have been selected for <strong>post</strong> <a class="cursor sitegreen" onclick="redarecturl(\'' + purl + '\');"> (' + value.posttitle + ')</a>. </span></h3>' +
                                '<div class="texteditp"> <span class="pull-right"> Selected date <i class="fa fa-clock-o"> </i> <small> ' + date + '</small></span> </div>' +
                                '</div>' +
                                '</div>';


                            let msc = $('#selectedagent_id_' + value.post_id).find('#scrollbar3 .mCustomScrollBox .mCSB_container');

                            let msct = msc.prevObject.length;

                            if (msct === 0) {
                                if (limit === 0) {
                                    $('#scrollbar3 .mCustomScrollBox .mCSB_container').append(bhtml);
                                } else {
                                    $('#scrollbar3 .mCustomScrollBox .mCSB_container .mCustomScrollBox .mCSB_container').append(bhtml);
                                }
                            } else {
                                $('#selectedagent_id_' + value.post_id).replaceWith(bhtml);
                            }
                        });

                        if (result.next !== 0) {
                            $('#selectedagent-more-load').val(result.next);
                        } else {
                            $('#selectedagent-more-load').val('');
                        }

                        if (limit === 0) {
                            $("#scrollbar3 .mCustomScrollBox .mCSB_container").mCustomScrollbar({
                                theme: "minimal-dark",
                                callbacks: {
                                    onTotalScroll: function () {
                                        if ($('#selectedagent-more-load').val() != 0) {
                                            loadselectedagent($('#selectedagent-more-load').val());
                                        }
                                    }
                                }
                            });
                        }

                    } else {
                        $('#scrollbar3 .mCustomScrollBox .mCSB_container').html('<p class="profile-event">No record found.</p>');
                    }

                },
                error: function (data) {
                    $("#scrollbar3 .mCustomScrollBox .mCSB_container").hide();
                    if (data.status === '500') {
                        $('#scrollbar3 .mCustomScrollBox .mCSB_container').text(data.statusText).css({'color': 'red'});
                    } else if (data.status === '422') {
                        $('#scrollbar3 .mCustomScrollBox .mCSB_container').text(data.responseJSON.image[0]).css({'color': 'red'});
                    }
                }
            });
        }

    </script>

@endsection