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

                        <div class="col-md-12 center margin-bottom-5 loading_gif">
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

            <!--right Sidebar-->
            @include('dashboard.user.buyers.include.sidebar-advert')
            <!--End right Sidebar-->
        </div>
        <!-- End Profile Content -->

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

                <form action="#" method="POST" class="sky-form" enctype="multipart/form-data" id="add-post-type">
                    @csrf

                    <div class="modal-body">
                        <fieldset>
                            <div class="row">
                                <div class="alert alert-danger hide post-msg"></div>

                                <section title="Post Title" class="padding-bottom-10 border1-bottom">
                                    <label class="label weight">Post Title <span class="mandatory">*</span></label>
                                    <label class="input">
                                        <input type="text" name="post_title" class="post_title" placeholder="Post Title">
                                        <b class="error-text" id="post_title_error"></b>
                                    </label>
                                </section>
                                <section title="Details" class="padding-bottom-10 border1-bottom">
                                    <label class="label weight">Specific requirements <span
                                            class="mandatory">*</span></label>
                                    <label class="textarea">
                                        <textarea rows="3" name="details" class="details jqte-test" placeholder="Post Details"></textarea>
                                        <b class="error-text" id="details_error"></b>
                                    </label>
                                </section>

                                <section class="row padding-bottom-10 border1-bottom">
                                    <div class="col col-6">
                                        <label class="label weight">State <span class="mandatory">*</span> </label>
                                        <label class="select">
                                            <select id="state" name="state" class="" placeholder="Select State">
                                                <option value="">Select State</option>
                                            </select>
                                            <b class="error-text" id="state_error"></b>
                                        </label>
                                    </div>

                                    <div class="col col-6">
                                        <label class="label weight">City<span class="mandatory">*</span> </label>
                                        <label class="select">
                                            <!-- <input type="text" id="city" name="city"  placeholder="Enter City"> -->
                                            <select id="city" name="city" class="" placeholder="Select City">
                                                <option value="">Select City</option>
                                            </select>
                                            <b class="error-text" id="city_error"></b>
                                        </label>
                                    </div>
                                </section>

                                <section class="border1-bottom padding-bottom-10" title="Suburb / Neighborhood">
                                    <label class="label weight">Suburb / Neighborhood<span class="mandatory">*</span>
                                    </label>
                                    <label class="input">
                                        <input type="text" class="area" id="area" name="area"
                                            value="" placeholder="Suburb / Neighborhood">
                                        <b class="error-text" id="area_error"></b>
                                    </label>
                                </section>

                                <section class="border1-bottom padding-bottom-10" id="zip_err">
                                    <span class="zipErr"></span>
                                    <label class="label weight">
                                        Zipcodes where you want to focus
                                        <span class="mandatory">*</span>
                                    </label>
                                    <div class="row">
                                        <label class="input zipfew">
                                            <input type="text" class="zip" id="zip1" name="zip[]"
                                                maxlength="5" placeholder="zip">
                                        </label>

                                        <label class="input zipfew">
                                            <input type="text" class="zip" id="zip2" name="zip[]"
                                                maxlength="5" placeholder="zip">
                                        </label>

                                        <label class="input zipfew">
                                            <input type="text" class="zip" id="zip3" name="zip[]"
                                                maxlength="5" placeholder="zip">
                                        </label>

                                        <label class="input zipfew">
                                            <input type="text" class="zip" id="zip4" name="zip[]"
                                                maxlength="5" placeholder="zip">
                                        </label>

                                        <label class="input zipfew">
                                            <input type="text" class="zip" id="zip5" name="zip[]"
                                                maxlength="5" placeholder="zip">
                                        </label>
                                    </div>
                                    <b class="error-text" id="zip_error"></b>
                                </section>



                                <section class="border1-bottom padding-bottom-10" title="Years of experience">
                                    <label class="label weight">When do you want to buy ?<span class="mandatory">*</span>
                                    </label>

                                    <label class="select">
                                        <select id="buy_or_sell_by" name="buy_or_sell_by"
                                            placeholder="When u want to buy">
                                            <option value="">When do you want to buy?</option>
                                            <option value="Now">Now</option>
                                            <option value="Within 30 Days">Within 30 Days</option>
                                            <option value="Within 90 Days">Within 90 Days</option>
                                            <option value="Undecided">Undecided</option>
                                        </select>
                                        <b class="error-text" id="buy_or_sell_by_error"></b>
                                    </label>
                                </section>

                                <section class="border1-bottom padding-bottom-10">
                                    <label class="label weight">Price range<span class="mandatory">*</span> </label>
                                    <label class="select">
                                        <select id="price_range" name="price_range" placeholder="Price Range">
                                            <option value="">Price range</option>
                                            <option value="75">Less Than 75k</option>
                                            <option value="75-150">75k - 150k</option>
                                            <option value="150-250">150k - 250k</option>
                                            <option value="250-400">250k - 400k</option>
                                            <option value="400">Above 400k</option>
                                        </select>
                                        <b class="error-text" id="price_range_error"></b>
                                    </label>
                                </section>

                                <section title="Home type">
                                    <label class="label weight">Property type<span class="mandatory">*</span> </label>
                                    <label class="select">
                                        <select id="home_type" name="home_type" placeholder="Select Property type">
                                            <option value="">Property type</option>
                                            <option value="single_family"> Single Family </option>
                                            <option value="condo_townhome"> Condo/Townhome </option>
                                            <option value="multi_family"> Multi Family </option>
                                            <option value="manufactured"> Manufactured </option>
                                            <option value="lots_land"> Lots/Land </option>
                                        </select>
                                        <b class="error-text" id="home_type_error"></b>
                                    </label>
                                </section>

                                <section class="border1-bottom padding-bottom-10">
                                    <label class="label weight">Are you a first time home buyer ?</label>
                                    <div class="inline-group">
                                        <label class="radio"><input type="radio" name="firsttime_home_buyer"
                                                class="firsttime_home_buyer_1" value="1"><i
                                                class="rounded-x"></i>Yes</label>
                                        <label class="radio"><input type="radio" name="firsttime_home_buyer"
                                                class="firsttime_home_buyer_2" value="0"><i
                                                class="rounded-x"></i>No</label>
                                        <b class="error-text" id="firsttime_home_buyer_error"></b>
                                    </div>
                                </section>

                                <section class="row border1-bottom padding-bottom-10">
                                    <div class="col col-6 ">
                                        <label class="label weight">Do you have a home to sell ?</label>
                                        <div class="inline-group">
                                            <label class="radio"><input type="radio" name="do_u_have_a_home_to_sell"
                                                    class="do_u_have_a_home_to_sell_1" value="1"><i
                                                    class="rounded-x"></i>Yes</label>

                                            <label class="radio"><input type="radio" name="do_u_have_a_home_to_sell"
                                                    class="do_u_have_a_home_to_sell_2" value="0"><i
                                                    class="rounded-x"></i>No</label>
                                        </div>
                                    </div>

                                    <div class="col col-6">
                                        <label class="label weight">If so do you need help selling</label>
                                        <div class="inline-group">
                                            <label class="radio"><input type="radio"
                                                    name="if_so_do_you_need_help_selling"
                                                    class="if_so_do_you_need_help_selling_1" value="1"><i
                                                    class="rounded-x"></i>Yes</label>

                                            <label class="radio"><input type="radio"
                                                    name="if_so_do_you_need_help_selling"
                                                    class="if_so_do_you_need_help_selling_2" value="0"><i
                                                    class="rounded-x"></i>No</label>
                                        </div>
                                    </div>
                                </section>

                                <section class="border1-bottom padding-bottom-10">
                                    <label class="label weight">Are you interested in buying a foreclosure, short sale or
                                        junker ?</label>
                                    <div class="inline-group">
                                        <label class="radio"><input type="radio" name="interested_in_buying"
                                                class="interested_in_buying_1" value="1"><i
                                                class="rounded-x"></i>Yes</label>
                                        <label class="radio"><input type="radio" name="interested_in_buying"
                                                class="interested_in_buying_2" value="0"><i
                                                class="rounded-x"></i>No</label>
                                    </div>
                                </section>

                                <section class="border1-bottom padding-bottom-10">
                                    <label class="label weight">Do you want the bids emailed once a day or as it arrives
                                    </label>
                                    <label class="select">
                                        <select id="bids_emailed" name="bids_emailed" placeholder="Property type">
                                            <option value="">Select Option</option>
                                            <option value="Once a day"> Once a day </option>
                                            <option value="As it arrives"> As it arrives </option>
                                        </select>
                                        <b class="error-text" id="bids_emailed_error"></b>
                                    </label>
                                </section>

                                <section title="Do you need financing? If So Amount"
                                    class="border1-bottom padding-bottom-10">
                                    <label class="label weight">Do you need financing?. If so amount</label>
                                    <label class="input">
                                        <input type="number" name="do_you_need_financing" id="do_you_need_financing"
                                            class="do_you_need_financing"
                                            value="{{ $userdetails->do_you_need_financing }}"
                                            placeholder="Do you need financing?. If so amount">
                                        <b class="error-text" id="do_you_need_financing_error"></b>
                                    </label>
                                </section>

                                <section>
                                    <label class="label weight">Need Cash back/Negotiate Commision<span
                                            class="mandatory">*</span></label>
                                    <div class="inline-group">
                                        <div class="infopopup">
                                            <p>some states dont allow cash back </p>
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
                            </div>
                        </fieldset>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" value="" name="id" id="post_id">
                        <input type="hidden" value="<?php echo $user->id; ?>" name="agents_user_id">
                        <input type="hidden" value="<?php echo $user->agents_users_role_id; ?>" name="agents_users_role_id">
                        <input type="hidden" value="2" name="post_type">
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
            const cur_page = parseInt($('#load_new_posts').data('page'), 10) || 0;
            const nxt_page = cur_page + 1;

            $(".list_resp_message").addClass('hide');

            $.ajax({
                url: "{{ url('/') }}/profile/buyer/post/get/",
                type: 'GET',
                data: { page: nxt_page },
                beforeSend: () => $(".loading_gif").show(),
                success: (result) => { 
                    const { data, misc, paginate } = result;
                    const count = misc.count;

                    if (!count) {
                        if (!cur_page) {
                            $(".list_resp_message")
                                .removeClass(function(index, className) {
                                    return (className.match(/(^|\s)alert-\S+/g) || []).join(' ');
                                })
                                .addClass('alert-warning')
                                .html('No agent is connected to you. <a href="{{ URL('/agents') }}"> Find Agents..</a>')
                                .removeClass('hide');
                        }
                        $(".loading_gif").hide();
                        return;
                    }

                    if (paginate.current_page === cur_page) {
                        return;
                    }

                    data.forEach(value => { // Use forEach for simpler iteration
                        postdata[value.post_id] = value;

                        const location_var = [value.address1, value.city?.city_name, value.state?.state_name, value.zip].filter(Boolean).join(' '); // more concise way to build location
                        const date = dayjs(value.created_at).fromNow();
                        const close_date = value.closing_date ? dayjs(value.closing_date).format('YYYY-MM-DD') : 'Not updated yet';
                        const photoUrl = "{{ URL::asset('assets/img/profile/') }}";
                        const defaultPhoto = "{{ URL::asset('assets/img/testimonials/user.jpg') }}";


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
                                    ${value.details ? `<div onclick="redirecturl('/search/post/details/${value.post_id}');" class="limited-post-text hidetext2line margin-bottom-10">${value.details}</div>` : ''}                           <ul class="list-inline margin-bottom-0">
                                    ${value.applied_post === 2 ? `<li><a class="cursor" onclick="post_Edit(${value.post_id});"> <b>Edit Post</b></a></li> | ` : ''}
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
                                        <div id="postagentshowinpopup" class="panel-body no-padding" data-mcs-theme="minimal-dark">`;

                        // improved agent rendering
                        htm += (value.connections && value.connections.length) ? 
                                value.connections.map(agentdata => { // Use map to create array of agent HTML
                                    const adate = dayjs(agentdata.created_at).fromNow();
                                    const photo = agentdata.photo ? `<img class="rounded-x" src="${photoUrl}/${agentdata.photo}">` : `<img class="rounded-x" src="${defaultPhoto}" alt="">`;
                                    const selectedclass = value.applied_post === 1 && value.applied_user_id === agentdata.details_id ? 'agents_selected' : '';
                                    const title = selectedclass ? `Selected this agent for post - ${value.posttitle}` : '';
                                    return `<div onclick="onclickagent('${agentdata.details_id}','${value.post_id}');" title="${title}" class="${selectedclass} cursor alert-blocks alert-dismissable">${photo}<div class="overflow-h" style="margin-top:10px;"><strong class="color">${agentdata.name} <small class="pull-right" style="margin-left: 20px;"><em>${adate}</em></small></strong><div class="hidetext1line">${agentdata.description || ' '}</div></div></div>`;
                                }).join('') :  // join the array elements into a single string
                                `<div class="cursor alert-blocks alert-dismissable"> No Applied Agents </div>`;

                        htm += `</div></div></div></div>`;

                        $('.post_wrap').append(htm);
                    });

                        // Assuming you are using bootstrap popover, initialize it after appending new elements to DOM             
                    $('[rel="popover"]').popover({
                        html: true, // Ensure HTML content is rendered correctly
                        trigger: 'click', // Or hover, depending on your desired behavior
                        placement: 'bottom', // Adjust as needed
                        container: 'body' //To avoid any potential positioning issues if your popover content is larger than its container, try adding container: 'body' to your popover initialization
                    });


                    $('#load_new_posts').data('page', nxt_page);
                    $(".loading_gif").hide();
                },
                error: (data) => {  // Use arrow function
                    $(".list_resp_message")
                        .removeClass(function(index, className) {
                            return (className.match(/(^|\s)alert-\S+/g) || []).join(' ');
                        })
                        .addClass('alert-danger')
                        .html(data.status === 500 ? data.statusText : (data.status === 422 ? data.responseJSON?.image?.[0] : 'An error occurred.')); // optional chaining and simplified
                }
            });
        }

        function onclickagent(d, p) {
            window.location.href = '{{ URL('/') }}/search/agents/details/' + d + '/' + p;
        }

        function select_city(city) {
            var option_len = $('#city > option').length;

            if (option_len > 1) {
                $('#city').val(city);
            } else {
                // console.log('Not Met');
                setTimeout(function() {
                    select_city(city);
                }, 1000); // check again in a second
            }
        }

        function post_Edit(el) {
            var data = postdata[el];
            // console.log(data);
            $('#post_id').val(data.post_id);
            $('.post_title').val(data.posttitle);
            $('.details').summernote('code', data.details);
            // $('#state').multiselect('select', data.state);
            // $('#city').val(data.city);
            $('#area').val(data.area);
            $('.zip').val('');

            if (data.state != 0) {
                $('#state').val(data.state);
                $('#state').trigger('change');
                select_city(data.city);
            }

            if (data.zip != null) {
                var zipp = data.zip.split(',');
                $.each(zipp, function(key, value) {
                    $('#zip' + (key + 1)).val(value);
                });
            }

            $("#buy_or_sell_by option:selected").removeAttr("selected");
            $('#buy_or_sell_by').val(data.when_do_you_want_to_sell);
            $('#price_range').val(data.price_range);
            $('#home_type').val(data.home_type);
            $("input[name=firsttime_home_buyer]").removeAttr("checked");
            $(".firsttime_home_buyer_" + data.firsttime_home_buyer).prop("checked", true);
            $("input[name=do_u_have_a_home_to_sell]").removeAttr("checked");
            $(".do_u_have_a_home_to_sell_" + data.do_u_have_a_home_to_sell).prop("checked", true);
            $("input[name=if_so_do_you_need_help_selling]").removeAttr("checked");
            $(".if_so_do_you_need_help_selling_" + data.if_so_do_you_need_help_selling).prop("checked", true);
            $("input[name=interested_in_buying]").removeAttr("checked");
            $(".interested_in_buying_" + data.interested_in_buying).prop("checked", true);
            $('#bids_emailed').val(data.bids_emailed);
            $('#do_you_need_financing').val(data.do_you_need_financing);
            $("input[name=need_cash_back]").removeAttr("checked");
            $(".need_cash_back_" + data.need_cash_back).prop("checked", true);
            $('#postaddeditmodal').modal('show');
        }


        $.ajax({
            url: "{{ url('/') }}/state/get",
            type: 'get',
            success: function(result) {
                $.each(result, function(key, val) {
                    $('#state').append('<option value="' + val.state_id + '" >' + val
                        .state_name + '</option>');
                });

                /*$('#state').multiselect({
                    nonSelectedText: 'Select State',
                    columns: 1,
                    search: true,
                    onChange: function(option, checked) {
                    }
                });*/
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

            //$('#state').multiselect('select', '');
            $('#city').val('');
            $('#area').val('');
            $('.zip').val('');
            // $('#zip1').val('');
            $("#buy_or_sell_by").val("");
            $("#price_range").val("");
            $("#home_type").val("");
            $("input[name=firsttime_home_buyer]").removeAttr("checked");
            $("input[name=do_u_have_a_home_to_sell]").removeAttr("checked");
            $("input[name=if_so_do_you_need_help_selling]").removeAttr("checked");
            $("input[name=interested_in_buying]").removeAttr("checked");
            $("#bids_emailed").val("");
            $("#do_you_need_financing").val("");
            $("input[name=need_cash_back]").removeAttr("checked");
            $('#postaddeditmodal').modal('show');
        });

        /* submit post data */
        $('#add-post-type').submit(function(e) {
            e.preventDefault();
            var $form = $(e.target);
            var esmsg = $('.post-msg');
            $.ajax({
                url: "{{ url('/') }}/profile/buyer/newpost",
                type: 'post',
                dataType: 'json',
                data: $form.serialize(),
                beforeSend: function() {
                    $(".body-overlay").show();
                },
                processData: false,
                success: function(result) {
                    // alert(result);
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

                    if (result.ziperr != null) {
                        $('.modal-content').animate({
                            scrollTop: 0
                        }, 400);

                        $(".zipErr").html(result.ziperr);
                        $(".zipErr").css({
                            "color": "red"
                        });
                        $('.zip').addClass('error-border');
                    }
                    if (result.alfa_err != null) {
                        $('.modal-content').animate({
                            scrollTop: 0
                        }, 400);

                        $(".zipErr").html(result.alfa_err);
                        $(".zipErr").css({
                            "color": "red"
                        });
                        $('.zip').addClass('error-border');
                    }
                },
                error: function(data) {
                    if (data.status == '500') {
                        esmsg.text(data.statusText).css({
                            'color': 'red'
                        }).removeClass('hide').addClass('show');
                    } else if (data.status == '422') {
                        displayValidationErrors('.post-msg', data.responseJSON.error)
                    }
                    $(".zipErr").html(result.ziperr);
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
