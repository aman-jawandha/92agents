@section('content')
    <?php $topmenu = 'my_post'; ?>
    <?php $activemenu = 'posts'; ?>
    @include('dashboard.include.sidebar')

    <!--=== Profile ===-->
    <div class="container content profile">
        <div class="row">
            <!--Left Sidebar-->
            @include('dashboard.user.buyers.include.sidebar')
            <!--End Left Sidebar-->

            <!-- Profile Content -->
            <div class="col-md-12">
                <h2><b>My Posts</b></h2>
                <div class="box-shadow-profile ">
                    <div class="panel-profile">
                        <div class="panel-heading overflow-h air-card">
                            <h2 class="heading-sm pull-left"> Posts </h2>
                            <a class="cursor pull-right btn btn-default" id="addnewpost">
                                <i class="fa fa-plus"></i> Add New Post
                            </a>
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
            <!-- End Profile Content -->
        </div>
    </div>

    <div class="modal fade" id="postaddeditmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">

        <div class="body-overlay">
            <div><img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" /></div>
        </div>
        <div class="modal-dialog modal-lg">
            <div class="modal-content not-top">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title post-modal-title">Enter Your Post Details</h4>
                </div>

                <form method="POST" action="#" class="sky-form" enctype="multipart/form-data" id="add-post-type">
                    @csrf
                    <div class="modal-body">
                        <fieldset>
                            <div class="row">
                                <div class="alert alert-danger hide post-msg"></div>
                                <section title="Post Title">
                                    <label class="label weight">Post Title<span class="mandatory">*</span></label>
                                    <label class="input">
                                        <input type="text" name="post_title" class="post_title" placeholder="Post Title">
                                        <b class="error-text" id="post_title_error"></b>
                                    </label>
                                </section>

                                <section title="Details">
                                    <label class="label weight">Property Details<span class="mandatory">*</span></label>
                                    <label class="textarea">
                                        <textarea rows="3" name="details" class="details jqte-test" placeholder="Post Details"></textarea>
                                        <b class="error-text" id="details_error"></b>
                                    </label>
                                </section>

                                <section class="row">
                                    <div class="col col-6">
                                        <label class="label weight">Address Line 1<span class="mandatory">*</span> </label>
                                        <label class="input">
                                            <input type="text" class="address_first" name="address_1" value=""
                                                placeholder="Address ">
                                            <b class="error-text" id="address_1_error"></b>
                                        </label>
                                    </div>

                                    <div class="col col-6">
                                        <label class="label weight">Address Line 2</label>
                                        <label class="input">
                                            <input type="text" class="address_2" name="address_2" value=""
                                                placeholder="Address ">
                                            <b class="error-text" id="address_2_error"></b>
                                        </label>
                                    </div>
                                </section>

                                <section class="row">

                                    <div class="col col-4">
                                        <label class="label weight">State <span class="mandatory">*</span> </label>
                                        <label class="select">
                                            <select id="state" name="state" class="" placeholder="Select State">
                                                <option value="">Select State</option>
                                            </select>
                                            <b class="error-text" id="state_error"></b>
                                        </label>
                                    </div>


                                    <div class="col col-4">
                                        <label class="label weight">City<span class="mandatory">*</span> </label>
                                        <label class="select">
                                            <!-- <input type="text" id="city" name="city"  placeholder="Enter City"> -->
                                            <select id="city" name="city" class=""
                                                placeholder="Select City">
                                                <option value="">Select City</option>
                                            </select>
                                            <b class="error-text" id="city_error"></b>
                                        </label>
                                    </div>

                                    <div class="col col-4">
                                        <label class="label weight">Zip Code<span class="mandatory">*</span> </label>
                                        <label class="input">
                                            <input type="number" id="zip" maxlength="5" name="zip"
                                                value="" placeholder="Zip Code">
                                            <b class="error-text" id="zip_error"></b>
                                        </label>
                                    </div>
                                </section>

                                <section title="When Do You Want To Sell field Is required.">
                                    <label class="label weight">When Do You want To Sell<span class="mandatory">*</span>
                                    </label>
                                    <label class="select">
                                        <select id="buy_or_sell_by" name="buy_or_sell_by"
                                            placeholder="when do you want to sell">
                                            <option value="">When do you want to sell?</option>
                                            <option value="Now">Now</option>
                                            <option value="Within 30 Days">Within 30 Days</option>
                                            <option value="Within 90 Days">Within 90 Days</option>
                                            <option value="Undecided">Undecided</option>
                                        </select>
                                        <b class="error-text" id="buy_or_sell_by_error"></b>
                                    </label>
                                </section>

                                <section>
                                    <label class="label weight">Need Cash back/Negotiate Commision<span
                                            class="mandatory">*</span></label>
                                    <div class="inline-group">
                                        <div class="infopopup">
                                            <p> Some states don’t allow cash back </p>
                                        </div>
                                        <label class="radio"><input type="radio" name="need_cash_back"
                                                class="need_cash_back_1" value="1"><i
                                                class="rounded-x"></i>Yes</label>
                                        <label class="radio"><input type="radio" name="need_cash_back"
                                                class="need_cash_back_0" value="0" checked=""><i
                                                class="rounded-x"></i>No</label>
                                    </div>
                                    <b class="error-text" id="need_cash_back_error"></b>
                                </section>

                                <section class="row">
                                    <div class="col col-6">
                                        <label class="label weight">Interested in a Short Sale</label>
                                        <div class="inline-group">
                                            <label class="radio"><input type="radio" name="interested_short_sale"
                                                    class="interested_short_sale_1" value="1"><i
                                                    class="rounded-x"></i>Yes</label>

                                            <label class="radio"><input type="radio" name="interested_short_sale"
                                                    class="interested_short_sale_2" value="0" checked><i
                                                    class="rounded-x"></i>No</label>
                                        </div>
                                    </div>

                                    <div class="col col-6 hide" id="got_lender_approval_for_short_sale">
                                        <label class="label weight">Got Lender Approval for Short Sale</label>
                                        <div class="inline-group">
                                            <label class="radio"><input type="radio"
                                                    name="got_lender_approval_for_short_sale"
                                                    class="got_lender_approval_for_short_sale_1" value="1"><i
                                                    class="rounded-x"></i>Yes</label>

                                            <label class="radio"><input type="radio"
                                                    name="got_lender_approval_for_short_sale"
                                                    class="got_lender_approval_for_short_sale_2" value="0" checked><i
                                                    class="rounded-x"></i>No</label>
                                        </div>
                                    </div>
                                </section>

                                <section title="Home type">
                                    <label class="label weight">Home Type </label>
                                    <label class="select">
                                        <select id="home_type" name="home_type" placeholder="Select home type">
                                            <option value="">Select Home type</option>
                                            <option value="single_family"> Single Family </option>
                                            <option value="condo_townhome"> Condo/Townhome </option>
                                            <option value="multi_family"> Multi Family </option>
                                            <option value="manufactured"> Manufactured </option>
                                            <option value="lots_land"> Lots/Land </option>
                                        </select>
                                        <b class="error-text" id="home_type_error"></b>
                                    </label>
                                </section>

                                <section title="Best Features Of Your Home" id="tab_feature_detail">
                                    <label class="label weight">Best Features Of Your Home</label>
                                    <div class="col-2">
                                        <button type="button" id="add_new_feature" url="{{ url('/add-new-feature') }}"
                                            class="btn btn-default">Add New</button>
                                    </div>
                                    <div id ="label_id">
                                    </div>
                                </section>

                                <script>
                                    $("#add_new_feature").click(function() {
                                        var row_id = $("#tab_feature_detail > #label_id > label").length;
                                        // console.log(row_id);
                                        var url = $(this).attr('url');

                                        $.ajax({
                                            type: 'GET',
                                            url: url,
                                            data: {
                                                row_id: row_id
                                            },
                                            beforeSend: function() {
                                                $("#add_new_feature").prop('disabled', true);
                                            },
                                            success: function(response) {
                                                $("#tab_feature_detail > #label_id").append(response);
                                                $("#add_new_feature").prop('disabled', false);
                                                return false;
                                            },
                                            error: function(e) {}
                                        });
                                    });

                                    $('body').on('click', '.trash_lab', function() {
                                        var row_id = $(this).attr('id');
                                        $('#tab_feature_detail > #label_id > #feature_' + row_id).fadeOut();
                                        return false;
                                    });
                                </script>
                            </div>
                        </fieldset>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" value="" name="id" id="post_id">
                        <input type="hidden" value="<?php echo $user->id; ?>" name="agents_user_id">
                        <input type="hidden" value="<?php echo $user->agents_users_role_id; ?>" name="agents_users_role_id">
                        <input type="hidden" value="3" name="post_type">
                        <button type="button" class="btn-u btn-u-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn-u btn-u-primary" name="add-proposal-submit"
                            value="Save changes" title="Save changes">Save</button>
                    </div>
                </form>
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
            const cur_page = parseInt($('#load_new_posts').data('page'), 10) || 0; // Get initial page from data attribute
            const nxt_page = cur_page + 1;

            $(".list_resp_message").addClass('hide');

            $.ajax({
                url: "{{ url('/') }}/profile/buyer/post/get/",
                type: 'GET',
                data: { page: nxt_page },
                beforeSend: function() {
                    $(".loading_gif").show();
                },
                success: function(result) {
                    const { data, errors, message, misc, paginate } = result;
                    const count = misc.count;

                    if (count === 0) {
                        if (cur_page === 0) {
                            $(".list_resp_message")
                                .removeClass(function(index, className) {
                                    return (className.match(/(^|\s)alert-\S+/g) || []).join(' ');
                                })
                                .addClass('alert-warning')
                                .html('No agent is connected to you. <a href="{{ URL('/agents') }}"> Find Agents..</a>')
                                .removeClass('hide');
                        }
                        $(".loading_gif").hide();
                        return; // Use return instead of return true;
                    }

                    if (paginate.current_page === cur_page) {
                        return; // Use return instead of return true;
                    }

                    $.each(data, function(key, value) {
                        postdata[value.post_id] = value;
                        const { city, state, user, user_details, connections } = value;


                        const location_var = (value.address1 || '') + (city?.city_name || '') + (state?.state_name || '') + (value.zip || '');  //Optional chaining
                        const date = dayjs(value.created_at).fromNow();
                        const close_date = value.closing_date ? dayjs(value.closing_date).format('YYYY-MM-DD') : 'Not updated yet';

                        let htm = `
                            <div class="border1-bottom">
                                <div class="funny-boxes acposts">
                                    <div style="display:flex;align-items:center;justify-content:space-between">
                                        <div style="width:70%">
                                        <h2 class="title margin-bottom-0"><a target="_blank" href="/profile/buyer/post/details/${value.post_id}">${value.posttitle}</a>
                                        ${value.when_do_you_want_to_sell?.toLowerCase() == 'now' ? `<span class="badge badge-danger" style="margin: 10px;">Urgent Buy</span>` : ''}</h2>
                                        </div>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-default dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-share"></i> Share</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <p style="margin:2px 5px;">
                                                        <a class="dropdown-item" style="color:black" href="#" onclick="copyToClipboard('${window.location.origin}/profile/buyer/post/details/${value.post_id}')">
                                                            <i class="fa fa-copy"></i> &nbsp;Copy Link
                                                        </a>
                                                    </p>
                                                    <p style="margin:2px 5px;">
                                                        <a class="dropdown-item" style="color:black" href="https://wa.me/?text=${encodeURIComponent(window.location.origin + '/profile/buyer/post/details/' + value.post_id)}" target="_blank">
                                                            <i class="fa fa-whatsapp"></i> &nbsp;Whatsapp
                                                        </a>
                                                    </p>
                                                    <p style="margin:2px 5px;">
                                                        <a class="dropdown-item" style="color:black" href="https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(window.location.origin + '/profile/buyer/post/details/' + value.post_id)}" target="_blank">
                                                            <i class="fa fa-linkedin"></i> &nbsp;LinkedIn
                                                        </a>
                                                    </p>
                                                    <p style="margin:2px 5px;">
                                                        <a class="dropdown-item" style="color:black" href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.origin + '/profile/buyer/post/details/' + value.post_id)}" target="_blank">
                                                            <i class="fa fa-facebook"></i> &nbsp;Facebook
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="funny-boxes-img">
                                        <ul class="list-inline margin-bottom-5">
                                            <li><i class="fa-fw fa fa-map-marker"></i> ${location_var || 'No location provided yet!'}</li>
                                            <li><i class="fa fa-clock-o"></i> ${date}</li>
                                        </ul>
                                    </div>
                                    ${value.details ? `<div onclick="redarecturl('/search/post/details/${value.post_id}')" class="limited-post-text hidetext2line margin-bottom-10">${value.details}</div>` : ''}
                                    <ul class="list-inline margin-bottom-0">
                                        ${value.applied_post == 2 ? `<li><a class="cursor" onclick="post_Edit(${value.post_id});"> <b>Edit Post</b></a></li> | ` : ''}
                                        <li><a class="cursor" target="_blank" href="/profile/buyer/post/details/${value.post_id}"><b>Details</b></a></li> | 
                                        <li><a rel="popover" data-popover-content="#myPopover${value.post_id}"><b>Agents Applied: </b>${value.post_view_count}</a></li> | 
                                        <li><b>Closing date: </b>${close_date}</li>
                                    </ul>
                                </div>
                                <div id="myPopover${value.post_id}" class="hide">
                                    <div class="panel panel-profile">
                                        <div class="panel-heading overflow-h border1-bottom">
                                            <h2 class="panel-title heading-sm pull-left color-black"><i class="fa fa-users"></i> Active Agents</h2>
                                        </div>
                                        <div id="postagentshowinpopup" class="panel-body no-padding" data-mcs-theme="minimal-dark">
                                            ${
                                            value.post_view_count !== 0 ? 
                                                connections.map(agentdata => {
                                                    const adate = dayjs(agentdata.created_at).fromNow();
                                                    const photo = agentdata.photo ? `<img class="rounded-x" src="{{ URL::asset('assets/img/profile/') }}/${agentdata.photo}">` : `<img class="rounded-x" src="{{ URL::asset('assets/img/testimonials/user.jpg') }}" alt="">`;
                                                    const selectedclass = value.applied_post == 1 && value.applied_user_id == agentdata.details_id ? 'agents_selected' : '';
                                                    const title = selectedclass ? `Selected this agent for post - ${value.posttitle}` : '';
                                                    return `
                                                        <div onclick="onclickagent('${agentdata.details_id}','${value.post_id}');" title="${title}" class="${selectedclass} cursor alert-blocks alert-dismissable">
                                                            ${photo}
                                                            <div class="overflow-h" style="margin-top:10px;">
                                                                <strong class="color">${agentdata.name} <small class="pull-right" style="margin-left: 20px;"><em>${adate}</em></small></strong>
                                                                <div class="hidetext1line">${agentdata.description || ' '}</div>
                                                            </div>
                                                        </div>`;
                                                    }).join('') : 
                                                    `<div class="cursor alert-blocks alert-dismissable"> No Applied Agents </div>`
                                            }
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        $('.post_wrap').append(htm);
                    });

                    $('#load_new_posts').data('page', nxt_page); // Use .data() instead of .attr()
                    $(".loading_gif").hide();
                },
                error: function(data) {
                    $(".list_resp_message")
                        .removeClass(function(index, className) {
                            return (className.match(/(^|\s)alert-\S+/g) || []).join(' ');
                        })
                        .addClass('alert-danger')
                        .html(data.status == '500' ? data.statusText : (data.status == '422' ? data.responseJSON.image[0] : 'An error occurred.')); //Simplified error message setting
                }
            });
        }

        function onclickagent(d, p) {
            window.location.href = '{{ URL('/') }}/search/agents/details/' + d + '/' + p;
        }

        function post_Edit(el) {
            var data = postdata[el];
            console.log(data);
            $('#post_id').val(data.post_id);
            $('.post_title').val(data.posttitle);
            $('.details').summernote('code', data.details);
            $('.address_first').val(data.address1);
            $('.address_2').val(data.address_2);
            // $('#state').multiselect('select', data.state);
            $('#state').val(data.state).trigger('change');

            $('#zip').val(data.zip);
            $("#buy_or_sell_by option:selected").removeAttr("selected");
            $('#buy_or_sell_by').val(data.buy_or_sell_by);
            $("input[name=need_cash_back]").removeAttr("checked");
            $(".need_cash_back_" + data.need_cash_back).prop("checked", true);
            $("input[name=interested_short_sale]").removeAttr("checked");
            $(".interested_short_sale_" + data.interested_short_sale).prop("checked", true);
            if (data.interested_short_sale == 1) {
                $('#got_lender_approval_for_short_sale').addClass('show').removeClass('hide');
            } else {
                $('#got_lender_approval_for_short_sale').addClass('hide').removeClass('show');
            }
            $("input[name=got_lender_approval_for_short_sale]").removeAttr("checked");

            $(".got_lender_approval_for_short_sale_" + data.got_lender_approval_for_short_sale).prop("checked", true);
            $("#home_type option:selected").removeAttr("selected");
            $('#home_type').val(data.home_type);
            if (data.best_features && data.best_features != 0 && data.best_features != null) {
                var befu = JSON.parse(data.best_features);
                for (let key in befu) {

                    var i = key + 1;

                    var htm = '	<label class="input" id"feature_' + i + '">' +
                        '<input type="text" class="best_features_' + i + '" id="best_features_' + i +
                        '" name="best_features[]" value="' + befu[key] + '" placeholder="">' +
                        '<i class="fa fa-trash-o trash_lab" id="' + i + '" ></i>' +
                        '</label>';

                    $("#tab_feature_detail > #label_id").append(htm);

                }

            } else {
                $('.best_features_1').val('Secure Gated subdivision');
            }
            setTimeout(() => {
                console.log($('#city').val(data.city), data.city, typeof data.city);
            }, 1000);
            $('#postaddeditmodal').modal('show');
        }

        $('input[name="interested_short_sale"]').on('change', function(e) {
            var interested_short_sale = $(this).val();
            if (interested_short_sale == 1) {
                $('#got_lender_approval_for_short_sale').addClass('show').removeClass('hide');
            } else {
                $('#got_lender_approval_for_short_sale').addClass('hide').removeClass('show');
            }
        });

        $.ajax({
            url: "{{ url('/') }}/state/get",
            type: 'get',
            success: function(result) {
                $.each(result, function(key, val) {
                    $('#state').append('<option value="' + val.state_id + '" >' + val
                        .state_name + '</option>');
                });
                /*
                $('#state').multiselect({
                    nonSelectedText: 'Select State',
                    columns: 1,
                    search: true,
                    onChange: function(option, checked) {				    	

                    },
                    buttonContainer: '<div class="btn-grouptest" />',
                });
                */
            }
        });

        $('#state').on('change', function() {
            $('#city').children('option:not(:first)').remove();
            state_id = $(this).val();
            $.ajax({
                url: "{{ url('/') }}/city/get/" + state_id,
                type: 'get',
                success: function(result) {
                    statearray = result;
                    $.each(result, function(key, val) {
                        $('#city').append('<option value="' + val.city_id + '" >' + val
                            .city_name + '</option>');
                    });
                }
            });
        });


        /*add post */
        $('#addnewpost').click(function(e) {
            e.preventDefault();
            $('#post_id').val('');
            $('.post_title').val('');
            $('.details').summernote('code', '');
            $('.address_first').val('');
            $('.address_2').val('');
            // $('#state').multiselect('select', '');
            $('#city').val('');
            $("#buy_or_sell_by").val("");
            $('#zip').val('');
            $("input[name=need_cash_back]").removeAttr("checked");
            $("input[name=interested_short_sale]").removeAttr("checked");
            $('#got_lender_approval_for_short_sale').addClass('hide').removeClass('show');
            $("input[name=got_lender_approval_for_short_sale]").removeAttr("checked");
            $("#home_type").val("");
            var i = 0;
            var row_id = $("#tab_feature_detail > #label_id > label").length;
            for (i == 0; i == row_id; i++) {
                $('.best_features_' + i).val('Secure Gated subdivision');
            }


            $('#postaddeditmodal').modal('show');
        });

        /* submit post data */
        $('#add-post-type').submit(function(e) {
            e.preventDefault();
            var $form = $(e.target);
            var esmsg = $('.post-msg');
            $.ajax({
                url: "{{ url('/') }}/profile/buyer/newpost",
                type: 'POST',
                data: $form.serialize(),
                beforeSend: function() {
                    $(".body-overlay").show();
                },
                processData: false,
                success: function(result) {
                    $(".body-overlay").hide();
                    $('.error-text').text('');
                    $('#add-post-type input, #add-post-type select, #add-post-type textarea')
                        .removeClass('error-border');

                    if (typeof result.error != 'undefined' && result.error != null) {
                        $.each(result.error, function(key, value) {
                            $('#' + key + '_error').removeClass('success-text')
                                .addClass('error-text').text(value);
                            var text = $('#' + key + '_error').text();
                            text = text.replace("id", "");
                            $('#' + key + '_error').text(text);
                            $('#' + key).addClass('error-border');
                        });
                        esmsg.text('').addClass('hide');
                        $('.modal-content').animate({
                            scrollTop: 0
                        }, 400);
                    }

                    if (typeof result.msg != 'undefined' && result.msg != null) {
                        esmsg.text('').css({
                            'color': 'green'
                        });
                        esmsg.removeClass('hide').addClass(
                            'show alert alert-success text-center').html(result.msg).css({
                            'color': 'green'
                        });
                        setInterval(function() {
                            location.reload();
                        }, 5000);
                        $('.modal-content').animate({
                            scrollTop: 0
                        }, 400);
                        setTimeout(location.reload(), 5000);
                    }
                },

                error: function(data) {
                    console.log("error===========");
                    console.log(data.responseJSON.error);
                    if (data.status == '500') {
                        esmsg.text(data.statusText).css({
                            'color': 'red'
                        }).removeClass('hide').addClass('show');
                    } else if (data.status == '422') {
                        displayValidationErrors('.post-msg', data.responseJSON.error)
                    }
                    $(".body-overlay").hide();
                    $('.modal-content').animate({
                        scrollTop: 0
                    }, 400);
                }
            });
        });
        /* edit edit-prasnol-bio*/
function copyToClipboard(text) {
    navigator.clipboard.writeText(text)
        .then(() => alert("Link copied to clipboard!"))
        .catch(err => alert("Failed to copy link."));
}
    </script>
@stop
