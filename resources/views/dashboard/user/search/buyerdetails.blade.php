@extends('dashboard.master')

@section('style')
<link rel="stylesheet" href="{{URL::asset('assets/css/pages/page_job_inner.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/css/pages/shortcode_timeline2.css')}}">
@stop

@section('title','Agents Search')

@section('content')

<?php $topmenu='Agents';?>

@include('dashboard.include.sidebar')

<div class="block-description">
    <div class="container">
        <div class="row md-margin-bottom-10">
            <div class="col-md-12">
                <div class="padding-left-10">
                    @if($buyer->photo)
                    <img class="img-circle header-circle-img1 img-margin" width="80" height="80" src="{{ URL::asset("assets/img/profile/{$buyer->photo}") }}" alt="">
                    @else
                    <img class="img-circle header-circle-img1 img-margin" width="80" height="80" src="{{ URL::asset('assets/img/testimonials/user.jpg') }}" alt="">
                    @endif

                    <div class="padding-top-5">
                        <h2 class="postdetailsh2">{{ ucwords(strtolower($buyer->name)) }} <sub class="{{ $buyer->login_status }}">{{ $buyer->login_status }}</sub></h2>
                        <span class="margin-right-20"><strong>visiting date</strong>
                            <script type="text/javascript">
                                document.write(timeDifference(new Date(),new Date(Date.fromISO("{{ $buyer->created_at }}"))));
                            </script>
                        </span>
                        <span><strong><i class="fa fa-map-marker"></i></strong> {{ $buyer->city_id }},{{ $buyer->state_name }},{{ $buyer->zip_code }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box-shadow-profile margin-bottom-10">
                    <div class="panel-profile">
                        <div class="panel-heading overflow-h air-card">
                            <h2 class="heading-sm pull-left">Details</h2>
                        </div>
                        <div class="left-inner border1-bottom">
                            <div class="postdetailsdescription">{!! $buyer->description !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box-shadow-profile">
                    <div class="panel-profile">
                        <div class="panel-heading overflow-h air-card">
                            <h2 class="heading-sm pull-left">Posts by <span	class="underline">{{ ucwords(strtolower($buyer->name)) }}</span></h2>
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
            data:{
                agents_user_id:"{{ $buyer->id }}",
                agents_users_role_id:"{{ $roleid }}",
                selectedpost:'2',
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
							'No Posts Found..'
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

					var htm = `<div class="border1-bottom" id="post_list_data_${value.post_id}">` +
						`<div class="funny-boxes acposts">` +
						`<h2 class="title margin-bottom-0"><a target="_blank" href="/search/post/details/${value.post_id}">${value.posttitle}</a></h2>` +
						`<div class="funny-boxes-img">` +
						`<ul class="list-inline margin-bottom-5">` +
						`<li><i class="fa-fw fa fa-user"></i> ${value.name}</li>` +
						`<li><i class="fa fa-clock-o"></i> ${date}</li>` +
						`</ul>` +
						`</div>`;

					if (value.details) {
						htm +=
							`<div onlick="redarecturl('/search/post/details/${value.post_id}')" class="limited-post-text hidetext2line margin-bottom-10" >${value.details}</div>`;
					}

					htm += `<ul class="list-inline">
								<li><strong>Agents:</strong>${value.post_view_count}</li>
							</ul>` +
							`<ul class="list-inline">` +
								value.when_do_you_want_to_sell != null ?
								`<li>${types} ${value.when_do_you_want_to_sell.replace('_',' ')}</li> - ` : `` + 

								value.home_type != null ?
								`<li>${value.home_type.replace('_', ' ')}</li> - ` : `` + 

								`<li><strong><i class="fa fa-map-marker"></i></strong>${value.state_name}</li>
							</ul>
						</div>
					</div>`;

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

    function loadpostlimit(limit){
        $.ajax({
            url:"{{url('/')}}/profile/buyer/post/get/"+limit,
            type:'POST',
            data:{
                agents_user_id:"{{$buyer->id}}",
                agents_users_role_id:"{{$roleid}}",
                selectedpost:'2',
                _token:"{{csrf_token()}}"
            },
            beforeSend:function(){
                $(".loaduploadshare").show();
            },
            success:function(result){
                $(".loaduploadshare").hide();

                if(result.count!=0){
                    if(limit==0){
                        $('.postappend').html('');
                    }

                    $.each(result.result,function(key,value){
                        postdata[value.post_id]=value;

                        var ht = value.home_type ? value.home_type.replace("_"," ") : value.home_type;
                        var dd = new Date(value.created_at);
                        var date = dd.toDateString();
                        var types = value.agents_users_role_id==2 ? 'Buy' : 'Sell';

                        var htmll = `<div class="border1-bottom" id="post_list_data_${value.post_id}">
                            <div class="funny-boxes acpost" onclick="redarecturl('{{URL('/')}}/search/post/details/${value.post_id}')">
                                <h2 class="title margin-bottom-20"><a class="cursor">${value.posttitle}</a></h2>
                                <div class="funny-boxes-img">
                                    <ul class="list-inline">
                                        <li><strong>Posted By:</strong>${value.name}</li>-
                                        <li><strong>Posted <i class="fa fa-clock-o"></i>:</strong>${date}</li>
                                    </ul>
                                </div>`;

                        if (value.details) {
                            htmll += `<div class="limited-post-text hidetext2line margin-bottom-10" onclick="redarecturl('{{URL('/')}}/search/post/details/${value.post_id}')" title="${value.details}">${value.details}</div>`;
                        }

                        htmll += `<ul class="list-inline">
                                    <li><strong>Agents:</strong>${value.post_view_count}</li>
                                </ul>
                                <ul class="list-inline">
                                    ${value.when_do_you_want_to_sell!=null ? '<li>'+types+' '+value.when_do_you_want_to_sell.replace('_',' ')+'</li>-' : ''}
                                    ${value.home_type!=null ? '<li>' + value.home_type.replace('_', ' ') + '</li>-' : ''}
                                    <li><strong><i class="fa fa-map-marker"></i></strong>${value.state_name}</li>
                                </ul>
                            </div>
                        </div>`;

                        var msc = $('#post_list_data_'+value.post_id).find('#postappend');
                        var msct = msc.prevObject.length;

                        if(msct==0){
                            $('#postappend').append(htmll);
                        }else{
                            $('#post_list_data_'+value.post_id).replaceWith(htmll);
                        }
                    });

                    if(result.next!=0){
                        $('#loaduploadandshare').attr('title',result.next).addClass('show').removeClass('hide');
                    }else{
                        $('#loaduploadandshare').addClass('hide').removeClass('show');
                    }
                }else{
                    $('.postappend').html('<h2 style="padding:20px;text-align:center;">No Post</h2>');
                }
            },
            error:function(data){
                if(data.status=='500'){
                    $('.loaduploadshare').text(data.statusText).css({'color':'red'});
                }else if(data.status=='422'){
                    $('.loaduploadshare').text(data.responseJSON.image[0]).css({'color':'red'});
                }
            }
        });
    }
</script>
@stop