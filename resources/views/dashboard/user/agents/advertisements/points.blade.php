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
                <div class="row">
                    <div class="col-md-6">
                    <h1 class="margin-bottom-15">Rewarded Points History</h1>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('delete-points-history', auth()->id()) }}"
                            onclick="return confirm('Are you sure you want to clear history of points?')"
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
                <div class="row" style="margin: 0px">
                    <div class="col-md-7" style="padding:10px;background-color:white;">
                        <h1 class="text-center">Rewarded Points - {{auth()->user()->points}}</h1>
                        @if(auth()->user()->points <= 0)
                        <h5 class="text-center"><b>To get reward points you can post some blogs, can add questions or can answer
                                                questions of buyers and sellers.</b></h5>
                        @endif
                    </div>
                </div><br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No.</th>
                                <th scope="col">Points</th>
                                <th scope="col">For</th>
                                <th scope="col">Date\Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($points) > 0)
                                @foreach ($points as $key => $point)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if ($point->plus_points)
                                                <span style="color:green"><strong>+
                                                        {{ $point->plus_points }}</strong></span>
                                            @else
                                                <span style="color:red"><strong>- {{ $point->minus_points }}</strong></span>
                                            @endif
                                        </td>
                                        <td>{{ $point->points_for }}</td>
                                        <td>{{ date('d-m-Y | H:i:s',strtotime($point->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">
                                        <h5 class="text-center"><b>No data found!</b></h5>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                <div class="text-center margin-top-20">
                    {{ $points->links() }}
                </div>
            </div>
            <!-- End Profile Content -->
        </div>
    </div>

@endsection
