@extends('dashboard.master')
@section('title', 'home page')
@section('content')
    <?php $topmenu = 'Agents'; ?>
    <?php $activemenu = 'Plans'; ?>
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
                <h1 class="margin-bottom-15">Advertisement Plans</h1>
                </div>
                <div class="col-md-6 text-right">
                <a href="{{route('agent-advertisement')}}" class="btn-u margin-bottom-15">View Advertisements</a>
                </div>
                </div>
                @if (session('success'))
                    <p id="succes_alert" style="background-color: green; color: white; padding: 8px 10px; display: flex; justify-content: space-between; align-items: center;">
                        <span>{{ session('success') }}</span>
                        <span style="cursor: pointer; font-weight: bold;" onclick="document.getElementById('succes_alert').style.display='none'">X</span>
                    </p>
                @endif
                @if (session('error'))
                    <p id="error_alert" style="background-color: #bb0505; color: white; padding: 8px 10px; display: flex; justify-content: space-between; align-items: center;">
                        <span>{{ session('error') }}</span>
                        <span style="cursor: pointer; font-weight: bold;" onclick="document.getElementById('error_alert').style.display='none'">X</span>
                    </p>
                @endif
            <div class="row">
                <p class="text-danger">Note : Recurring Plans renews automatically. You will be charged at the beginning of each billing cycle unless you cancel. You may cancel your subscription any time.</p>
                @if($plans->count() > 0)
            @foreach ($plans as $plan)
                <div class="col-md-4" style="padding: 8px">
                    <div class="air-card box-shadow-profile" style="border-radius:10px;background-color: white !important">
                        <h3 style="color:#6ecd1b"><b>{{$plan->title}}</b></h3>
                        <h6><b>${{$plan->price}} \ {{$plan->duration}} months \  Adds allowed : {{$plan->no_of_popins}}</b></h6>
                        @if($user_plan && $user_plan->plan_id == $plan->id && $user_plan->start_date <= date('Y-m-d') && $user_plan->end_date >= date('Y-m-d'))
                        <small>Subscription : {{date('m-d-Y',strtotime($user_plan->start_date))}} - {{date('m-d-Y',strtotime($user_plan->end_date))}}</small><br>
                        @if($user_plan->subscription_status == 'cancel_at_period_end')
                        <small>Cancel Request Date : {{date('m-d-Y',strtotime($user_plan->cancelled_at))}}</small>
                        @endif
                        @endif
                        <hr style="margin:12px 0px 0px 0px">
                        <div style="height:225px;overflow-y:auto;margin-top:10px">
                            <div class="row m-0">
                                <div class="col-md-6">
                                    <p>Description</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <span class="badge">{{$plan->type}}</span>
                                </div>
                            </div>
                            {!! nl2br(e($plan->description)) !!}
                        </div>
                        <div style="display:flex;justify-content:center">
                                @if($user_plan && $user_plan->plan_id == $plan->id && $user_plan->start_date <= date('Y-m-d') && $user_plan->end_date >= date('Y-m-d'))
                                    <button type="button" style="color:white" class="btn btn-warning margin-top-20">Subscribed</button>
                                    @if(strtolower($plan->type) == 'recurring' && $user_plan->subscription_status != 'cancel_at_period_end')
                                    <form action="{{ route('agent-cancel-subscription') }}" method="post" style="display:inline-block; margin-left:5px" onsubmit="return confirm('Are you sure you want to cancel automatic renewals for this plan?');">
                                        @csrf
                                        <button type="submit" style="color:white" class="btn btn-danger margin-top-20">Cancel</button>
                                    </form>
                                    @endif
                                @else
                                    <form action="{{ route('advertisement-payment-form') }}" method="post" enctype="multipart/form-data" style="display:inline-block">
                                    @csrf
                                    <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                        <button type="submit" class="btn-u margin-top-20">Subscribe</button>
                                    </form>
                                @endif
                        </div>
                    </div>
            </div>
            @endforeach
            @else
            <h5 style="margin-left:10px"><b>No plans added Yet!</b></h5>
            @endif
            </div>
            <div class="text-center margin-top-20">
                {{$plans->links()}}
            </div>
            </div>
            <!-- End Profile Content -->
        </div>
    </div>
   
@endsection
