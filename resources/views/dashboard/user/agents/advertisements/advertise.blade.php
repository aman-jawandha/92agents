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
                <h1 class=" margin-bottom-40 pull-left">Manage Advertisements</h1>
                <div>
                <a href="{{route('create-advrtismnt')}}" class="btn-u margin-bottom-25">Add Advertisement</a>
                <a href="{{route('agent-adds-plans')}}" class="btn-u margin-bottom-25">View Plans</a>
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
                @if($popins->count() > 0)
            @foreach ($popins as $popin)
                <div class="col-md-12" style="padding: 8px">
                    <div class="air-card box-shadow-profile" style="border-radius:10px;background-color: white !important">
                        <div style="display:flex;align-items:center;justify-content:space-between">
                        <h3 style="color:#6ecd1b"><b>{{$popin->title}}</b></h3>
                        <div>
                            @if($popin->status == "Active")
                            <button type="button" class="btn btn-success btn-sm" style="color:white !important;">{{$popin->status}}</button>
                            @elseif($popin->status == "Inactive")
                            <button type="button" class="btn btn-danger btn-sm" style="color:white !important;">{{$popin->status}}</button>
                            @elseif($popin->status == "Most Liked")
                            <button type="button" class="btn btn-warning btn-sm" style="color:white !important;">{{$popin->status}}</button>
                            @endif
                            <button type="button" onclick="viewPopin('{{$popin->id}}')" class="btn btn-success btn-sm" style="color:white !important;">View</button>
                            @if(($user_plan && $user_plan->start_date <= date('Y-m-d') && $user_plan->end_date >= date('Y-m-d')) || $popin->status == 'Most Liked')
                            <a href="{{route('edit-advrtismnt',$popin->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit" style="color:white !important;"></i></a>
                            @endif
                            <a href="{{ route('delete-advrtismnt', $popin->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this advertisement?')">
                            <i class="fa fa-trash" style="color:white !important;"></i>
                        </a>
                        </div>
                        </div>
                        <h6><b>{{$popin->heading}}</b></h6>
                        <hr style="margin:12px 0px 0px 0px">
                        <div style="max-height:150px;overflow-y:auto;padding-right:5px;">
                            <p style="margin:12px 0px">Description</p>
                            {!! $popin->description !!}
                        </div>
                    </div>
            </div>
            @endforeach
            @else
            <h5 style="margin-left:10px"><b>No advertisement added Yet!</b></h5>
            @endif
            </div>
            <div class="text-center margin-top-20">
                {{$popins->links()}}
            </div>
            </div>
            <!-- End Profile Content -->
        </div>
    </div>
   
@endsection