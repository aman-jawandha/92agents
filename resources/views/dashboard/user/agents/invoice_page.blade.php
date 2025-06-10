@extends('dashboard.master')

@section('title', 'Pay Pending Invoices')

@section('content')
    @php
        $topmenu = 'pendinginvoices';
        $activemenu = 'pendinginvoices';
    @endphp

    @include('dashboard.include.sidebar')

    <div class="container content profile">
        <div class="row">
            <!--Left Sidebar-->
            @include('dashboard.user.agents.include.sidebar')
            @include('dashboard.user.agents.include.sidebar-dashbord')
            <!--End Left Sidebar-->
            <!-- Profile Content -->
            <div class="col-md-9">
                <!-- <h1 class="margin-bottom-40"></h1> -->
                <div class="box-shadow-profile homedata homedataposts ">
                    <!-- Default Proposals -->
                    <div class="panel-profile">
                        <div class="panel-heading overflow-h air-card">
                            <h2 class="panel-title heading-sm pull-left"><i class="fa fa-newspaper-o"></i>
                                Please provide your payment information
                            </h2>
                        </div>

                        <div class="panel-body">
                            <form class="text-center" action="{{ url('/downloadinvoice') }}" method="post" target="_blank">
                                {{ @csrf_field() }}
                                <input type="hidden" name="sale_ids" value="{{ $sale_ids }}">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-print" aria-hidden="true"></i> Download Unpaid Invoice
                                </button>
                            </form>
                            <div class="clearfix"></div>
                            <br>
                            <div class="row">
                                <!-- Payment form -->
                                <div class="col-md-offset-1 col-md-9">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="7">
                                                    <h1 class="text-center">92Agents.com</h1>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Agent Name</th>
                                                <td colspan="3">{{ $user->details->name }}</td>
                                                <th>Agent Email</th>
                                                <td colspan="2">{{ $user->email }}</td>
                                                {{-- <td colspan="2">rakesh.mishra@92agents.com</td> --}}
                                            </tr>
                                            <tr>
                                                <th colspan="7" class="text-center">Sale Details</th>
                                            </tr>
                                            <tr>
                                                <th>SL No.</th>
                                                <th>Post ID</th>
                                                <th>Seller Name</th>
                                                <th>Address</th>
                                                <th>Sale Date</th>
                                                <th>Sale Price</th>
                                                <th>Commision ($)</th>
                                            </tr>
                                            @if ($sale_details->isNotEmpty())
                                                @foreach ($sale_details as $key => $sale)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $sale->post_id }}</td>
                                                        <td>{{ $sale->sellers_name }}</td>
                                                        <td>{{ $sale->address }}</td>
                                                        <td>{{ est_std_date($sale->sale_date) }}</td>
                                                        <td>${{ $sale->sale_price }}</td>
                                                        <td>${{ $sale->admin_commission }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7">No Sales Found.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6"><strong>Total Pay:</strong></td>
                                                <td><strong>${{ $admin_commission }}</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                @if ($admin_commission)
                                    <div class="col-md-offset-1 col-md-9">
                                        <form method="post" id="agent-payment-form">

                                            <div class="form-row">
                                                <label for="card-element">
                                                    Credit or debit card
                                                </label>
                                                <div id="card-element">
                                                    <!-- A Stripe Element will be inserted here. -->
                                                </div>

                                                <!-- Used to display form errors. -->
                                                <div id="card-errors" role="alert"></div>
                                            </div>

                                            {{ csrf_field() }}

                                            <input type="hidden" name="sale_ids" value="{{ $sale_ids }}">
                                            <input type="hidden" name="admin_commission" value="{{ $admin_commission }}">

                                            <br>
                                            <button class="btn-u payment-btn">
                                                Pay Now
                                            </button>
                                        </form>
                                    </div>
                                @endif

                                <!-- End of payment form -->
                            </div>
                        </div>
                    </div>
                    <!-- Default Proposals -->
                </div>
            </div>
            <!-- End Profile Content -->
        </div>
    </div>

@endsection

@if ($admin_commission)
    @section('scripts')
        <script src="https://js.stripe.com/v3/"></script>

        <script type="text/javascript">
            // Create a Stripe client.
            const stripe = Stripe('{{ $stripe_data["key"] }}');
        
            // The items the customer wants to buy
            const items = JSON.parse('{!! json_encode($sale_summary) !!}');
        
            // Create an instance of Elements.
            const elements = stripe.elements({
                clientSecret: '{!! $stripe_data["client_secret"] !!}'
            });
        
            const paymentElement = elements.create("payment", {
                layout: "accordion",
            }).mount("#card-element");
        
            // Handle form submission.
            const form = document.getElementById('agent-payment-form');
        
            form.addEventListener('submit', async function(event) {
                event.preventDefault();

                // Disable the button
                const payButton = document.querySelector('.payment-btn');
                payButton.disabled = true;
                
                const sale_ids = document.querySelector('input[name="sale_ids"]').value;
                const admin_commission = document.querySelector('input[name="admin_commission"]').value;
        
                const payment_conf = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                      return_url: `{{ Route('payment_success') }}`,
                    },
                    // redirect: "if_required"
                });
        
                // This point will only be reached if there is an immediate error when
                // confirming the payment. Otherwise, your customer will be redirected to
                // your `return_url`. For some payment methods like iDEAL, your customer will
                // be redirected to an intermediate site first to authorize the payment, then
                // redirected to the `return_url`.
                if (payment_conf.error) {
                    // Inform the customer that there was an error.
                    show_stripe_error(payment_conf.error.message);
                    payButton.disabled = false;
                } else {
                    payment_conf.message;
                    payButton.disabled = false;

                    // Your customer will be redirected to your `return_url`. For some payment
                    // methods like iDEAL, your customer will be redirected to an intermediate
                    // site first to authorize the payment, then redirected to the `return_url`.
                }
            });
        
            function show_stripe_error(message) {
                const displayError = document.getElementById('card-errors');
        
                if (message) {
                    displayError.textContent = message;
                } else {
                    displayError.textContent = '';
                }
            }
        </script>
    @endsection
@endif
