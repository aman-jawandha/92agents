@extends('dashboard.master')
@section('title', 'home page')
@section('content')
    <?php $topmenu = 'Payments'; ?>
    <?php $activemenu = 'Payments'; ?>
    @include('dashboard.include.sidebar')

    <div class="container content profile">
        <div class="row">
            <!--Left Sidebar-->

            @include('dashboard.user.agents.include.sidebar')
            @include('dashboard.user.agents.include.sidebar-dashbord')
            <!--End Left Sidebar-->
            <!-- Profile Content -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                    <h1 class="margin-bottom-15">Payments History</h1>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('delete-payment-history', auth()->id()) }}"
                            onclick="return confirm('Are you sure you want to clear history of payments?')"
                            class="btn-u">Clear History</a>
                        <a href="{{ url('/dashboard') }}" class="btn-u margin-bottom-15">Back</a>
                    </div>
                </div>
                @if (session('success'))
                    <p id="succes_alert"
                        style="background-color: green; color: white; padding: 8px 10px; display: flex; justify-content: space-between; align-items: center;">
                        <span>{{ session('success') }}</span>
                        <span style="cursor: pointer; font-weight: bold;"
                            onclick="document.getElementById('succes_alert').style.display='none'">X</span>
                    </p>
                @endif
                @if (session('error'))
                    <p id="error_alert"
                        style="background-color: #bb0505; color: white; padding: 8px 10px; display: flex; justify-content: space-between; align-items: center;">
                        <span>{{ session('error') }}</span>
                        <span style="cursor: pointer; font-weight: bold;"
                            onclick="document.getElementById('error_alert').style.display='none'">X</span>
                    </p>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Plan</th>
                                <th>Plan Type</th>
                                <th>Price</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Designs</th>
                                <th>No. Of Popins</th>
                                <th>Payment Date</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($payments) > 0)
                                @foreach ($payments as $key => $payment)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $payment->payment_for }}</td>
                                        <td>{{ $payment->plan_type }}</td>
                                        <td>${{ $payment->amount }}</td>
                                        <td style="min-width: 120px">{{ date('m-d-Y',strtotime($payment->start_date)) }}</td>
                                        <td style="min-width: 120px">{{ date('m-d-Y',strtotime($payment->end_date)) }}</td>
                                        <td>{{ $payment->designs }}</td>
                                        <td>{{ $payment->no_of_popins }}</td>
                                        <td style="min-width: 200px">{{ date('m-d-Y | H:i:s',strtotime($payment->created_at)) }}</td>
                                        <td>{{ $payment->payment_status }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">
                                        <h5 class="text-center"><b>No data found!</b></h5>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    </div>
                <div class="text-center margin-top-20">
                    {{ $payments->links() }}
                </div>
            </div>
            <!-- End Profile Content -->
        </div>
    </div>

@endsection
