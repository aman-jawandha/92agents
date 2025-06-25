@extends('dashboard.master')
@section('title', 'home page')
@section('content')
    <?php $topmenu = 'Advertise'; ?>
    <?php $activemenu = 'Advertise'; ?>
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
                <h1 class=" margin-bottom-40 pull-left">Advertisement Plans</h1>
                <a href="{{route('agent-advertisement')}}" class="btn-u margin-bottom-25">View Advertisements</a>
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
                @if($plans->count() > 0)
            @foreach ($plans as $plan)
                <div class="col-md-4" style="padding: 8px">
                    <div class="air-card box-shadow-profile" style="border-radius:10px;background-color: white !important">
                        <h3 style="color:#6ecd1b"><b>{{$plan->title}}</b></h3>
                        <h6><b>${{$plan->price}} \ {{$plan->duration}} months \  Adds allowed : {{$plan->no_of_popins}}</b></h6>
                        <hr style="margin:12px 0px 0px 0px">
                        <div style="height:225px;overflow-y:auto;padding-right:5px;">
                            <p style="margin:12px 0px">Description</p>
                            {!! nl2br(e($plan->description)) !!}
                        </div>
                        <div class="text-center">
                            <form action="{{ route('advertisement-payment-form') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                @if($user_plan && $user_plan->plan_id == $plan->id && $user_plan->start_date <= date('Y-m-d') && $user_plan->end_date >= date('Y-m-d'))
                                    <button type="button" style="color:white" class="btn btn-danger margin-top-20">Subscribed</button>
                                @else
                                <button type="submit" class="btn-u margin-top-20">Subscribe</button>
                                @endif
                            </form>
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
