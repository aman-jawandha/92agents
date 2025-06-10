@extends('dashboard.master')

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/pages/shortcode_timeline2.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/pages/page_job.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    <style type="text/css">
        .pay_selected_posts {
            display: none;
        }

        table {
            table-layout: fixed;
            border-collapse: collapse;
            /* Prevents double borders */
        }
    </style>
@endsection

@section('title', 'Applied Post')

@section('content')

    @php
        $topmenu = 'Home';
        $activemenu = 'appliedpost';
    @endphp

    @include('dashboard.include.sidebar')

    <div class="container content profile">
        <div class="row">
            @include('dashboard.user.agents.include.sidebar')

            <div class="col-md-12">
                <h2><b>All My Jobs</b></h2>

                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('applied_posts') }}" class="btn-u padding-8">All</a>
                        <a href="{{ route('applied_posts') . '?status=paid' }}" class="btn-u padding-8">Paid</a>
                        <a href="{{ route('applied_posts') . '?status=unpaid' }}" class="btn-u padding-8">Unpaid</a>
                    </div>

                    <div class="container profile">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-shadow-profile">
                                    <div class="panel-profile">
                                        <div class="panel-heading air-card">
                                            <form action="{{ route('appliedpostsbydate') }}" id="search_post_form"
                                                class="sky-form" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-5 datediv">
                                                        <div class="input-group">
                                                            @php
                                                                $actual_link = basename(request()->path());
                                                            @endphp
                                                            <input type="hidden" name="status"
                                                                value="{{ $actual_link }}">
                                                            <span class="input-group-addon sitegreen"><i
                                                                    class="fa fa-calendar"></i></span>
                                                            <input type="text" id="date" title="Select Date"
                                                                name="date" value="{{ $search_post['date'] ?? '' }}"
                                                                class="text-13 col-lg-10 form-control date"
                                                                placeholder="Date">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-5 md-margin-bottom-10 usertypediv">
                                                        <div class="input-group width100">
                                                            <select id="usertype" name="usertype"
                                                                class="usertype form-control multipalselecte text-13">
                                                                <option value="2" @selected(isset($search_post['usertype']) && $search_post['usertype'] == '2')>
                                                                    Buyer
                                                                </option>
                                                                <option value="3" @selected(isset($search_post['usertype']) && $search_post['usertype'] == '3')>
                                                                    Seller
                                                                </option>
                                                            </select>
                                                            <p class="usertypeerror red hide">Please select user type.</p>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <button type="submit" class="btn-u pull-right" id="search_post">
                                                            Search Post
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="box-shadow-profile">
                    <div class="panel-profile" style="padding: 10px;">

                        @if ($post_status != 'paid')
                            <div class="row">
                                <div class="col-sm-1">
                                    <a href="{{ route('invoice_payment_page') }}" class="btn-u">
                                        Pay All
                                    </a>
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" class="btn-u pay_selected_posts">
                                        Pay Selected
                                    </button>
                                </div>
                            </div>
                        @endif

                        <div class="table-responsive" style="margin: 1rem 0;">
                            <table class="table table-bordered table-striped agent-jobs">
                                <thead>
                                    <tr>
                                        @if ($post_status != 'paid')
                                            <th style="width: 3%">
                                                @if ($post_status != 'paid')
                                                    <input type="checkbox" value="" id="checkAll" />
                                                @endif
                                            </th>
                                        @endif
                                        <th style="width: 5%">Sr. No.</th>
                                        <th style="width: 20%">Project</th>
                                        <th style="width: 5%">Post ID</th>
                                        <th style="width: 20%">Address</th>
                                        <th style="width: 10%; word-break: break-all;">Commission</th>
                                        <th style="width: 5%">Platform Fee</th>
                                        <th style="width: 10%">Closing Date</th>
                                        <th style="width: 10%">Sale Price</th>
                                        @if ($post_status != 'paid')
                                            <th>Status</th>
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    <div class="body-overlay">
                                        <img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px"
                                            height="64px" />
                                    </div>
                                    @foreach ($invoice_details as $key => $invoice)
                                        @php
                                            $post_stat = null;

                                            if (
                                                empty($invoice->sale_date) ||
                                                empty($invoice->sale_price) ||
                                                empty($invoice->agent_comission) ||
                                                empty($invoice->address)
                                            ) {
                                                $post_stat = null;
                                            } elseif ($invoice->payment_status == 1) {
                                                $post_stat = 'paid';
                                            } else {
                                                $post_stat = 'payment_pending';
                                            }
                                        @endphp
                                        <form class="sky-form" id="edit-personal-bio" method="POST"
                                            action="{{ route('update_sell') }}">
                                            <tr style="min-height: 80px;" data-id="{{ $invoice->id }}">
                                                @if ($post_status != 'paid')
                                                    <td>
                                                        @if ($post_stat)
                                                            <input type="checkbox" class="form-control select_post"
                                                                value="{{ $invoice->id }}">
                                                        @endif
                                                    </td>
                                                @endif
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <a href="{{ Route('post_details', $invoice->post_id) }}"
                                                        target="_blank">{{ $invoice->posttitle }}</a>
                                                    <hr style="margin: 10px 0;">
                                                    {{ $invoice->sellers_name }}
                                                </td>
                                                <td>{{ $invoice->post_id }}</td>
                                                <td>
                                                    @if ($post_stat)
                                                        {{ $invoice->address ?? '' }}
                                                    @else
                                                        <textarea title="Add exact address" name="address" style="resize: vertical;" class="col-lg-10 form-control">{{ $invoice->address ?? '' }}</textarea>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($post_stat)
                                                        {{ $invoice->agent_comission . '%' ?? '' }}
                                                    @else
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-percent"></i>
                                                            </span>
                                                            <input type="number" title="Add charged comission"
                                                                value="{{ $invoice->agent_comission ?? '' }}"
                                                                name="agent_comission" class="col-lg-10 form-control" />
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $per_10 = ($invoice->sale_price * 10) / 100;
                                                        $per_10_03 = ($per_10 * 3) / 100;
                                                        echo "$" . number_format((float) $per_10_03, 2, '.', '');
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                        $sale_date = $invoice->sale_date
                                                            ? \Carbon\Carbon::createFromFormat(
                                                                'Y-m-d',
                                                                $invoice->sale_date,
                                                            )->format('d/m/Y')
                                                            : '';
                                                    @endphp

                                                    @if ($post_stat)
                                                        {{ $sale_date }}
                                                    @else
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                            {{-- I'm not sure if it's agents_selldetails.sale_date/agents_posts.closing_date JkWorkz --}}
                                                            {{-- Shouldn't this field get updated when the client adds a closing date? JkWorkz --}}
                                                            <input type="text" title="Select Closing Date"
                                                                value="{{ $sale_date }}" name="sale_date"
                                                                class="col-lg-10 form-control datepicker sale_date"
                                                                autocomplete="off" />
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($post_stat)
                                                        {{ '$' . $invoice->sale_price ?? '' }}
                                                    @else
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-dollar"></i>
                                                            </span>
                                                            <input type="number" class="form-control" name="sale_price"
                                                                placeholder="Price"
                                                                value="{{ $invoice->sale_price ?? '' }}" />
                                                        </div>
                                                    @endif
                                                </td>

                                                @if ($post_status != 'paid')
                                                    @if ($post_stat == 'paid')
                                                        <td>
                                                            <span class="badge badge-green">
                                                                Paid
                                                            </span>
                                                        </td>
                                                        <td></td>
                                                    @elseif ($post_stat == 'payment_pending')
                                                        <td>
                                                            <span class="badge badge-red">
                                                                Sale<br>Pending
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <button class="btn-u padding-6 pay_single_post"
                                                                data-id="{{ $invoice->id }}">PAY</button>

                                                            {{-- <a class="btn btn-u padding-6" href="{{ route('invoice_payment_page') . "?sales=$invoice->id" }}">PAY</a> --}}
                                                        </td>
                                                    @else
                                                        <td>
                                                            <span class="badge badge-blue">
                                                                Closing<br>Pending
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-default" type="submit"
                                                                style="padding: 5px;">
                                                                <i class="fa fa-save" style="font-size: 25px;"></i>
                                                            </button>
                                                        </td>
                                                    @endif
                                                @endif
                                            </tr>

                                            @csrf
                                            <input type="hidden" class="form-control" name="id"
                                                value="{{ $invoice->id }}" />
                                        </form>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($post_status != 'paid')
                            <button type='submit' class="btn-u padding-6 pay_selected_posts">
                                Pay Selected
                            </button>
                        @endif

                        <form class="inv_pay_form hide" action="{{ route('invoice_payment_page') }}" method="POST">
                            {{-- pay_pendinginvoices --}}
                            @csrf
                            <input type="hidden" name="sales_csv" id="inv_ids" value="">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

    <script type="text/javascript">
        $('.datepicker').datepicker({
            'dateFormat': "dd/mm/yy",
            'minDate': 1,
        });

        var start = moment().subtract(29, 'days');
        var end = moment();

        $('#date').daterangepicker({
            format: 'MM/DD/YYYY',
            "opens": "center",
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            },
            locale: {
                format: 'MM/DD/YYYY'
            }
        });

        $('.search_post').on('click', function(e) {
            e.preventDefault();
            $(".search_post_form").submit();
        });
    </script>

    <script type="text/javascript">
        $("#checkAll").change(function() {
            const is_checked = $(this).is(':checked');
            const checked_count = $('.select_post:checked').length;

            // Check if some but not all are checked
            const partially_checked = checked_count > 0 && checked_count < $('.select_post').length;

            if (is_checked && partially_checked) {
                // Uncheck all if some, but not all, are checked. 
                $('input:checkbox').prop('checked', false);
            } else {
                $('input:checkbox').prop('checked', is_checked);
            }
        });

        // Show / Hide 
        $("input:checkbox").change(function() {
            if ($('.select_post:checked').length) $(".pay_selected_posts").show();
            else $(".pay_selected_posts").hide();
        });

        $('.pay_single_post').on('click', function(e) {
            e.preventDefault();

            const inv_id = $(this).attr('data-id');

            $('#inv_ids').val(inv_id);
            $(".inv_pay_form").submit();
        });

        $('.pay_selected_posts').on('click', function(e) {
            e.preventDefault();

            const payArr = $('.select_post:checked').map(function() {
                return $(this).val();
            }).get();

            $('#inv_ids').val(payArr.join(','));
            $(".inv_pay_form").submit();
        });
    </script>
@endsection
