@if ($agents->count())
<h3 class="text-center" style="margin:50px 0px">Our Featured Agents</h3>
    <div class="row">
        @foreach ($agents as $agent)
            <div class="col-md-3">
                <div class="card" style="background-color: white;border:1px solid green;border-radius:10px;padding:20px">
                        <h6><span class="badge">{{ $agent->tag}}</span></h6>
                        <div style="display:flex;align-items:center;justify-content:space-between">
                        @if($agent->details->photo)
                        <img src="{{ asset('assets/img/profile/' . $agent->details->photo) }}" width="50px" height="50px" alt="Image" style="border-radius:50%">
                        @else
                        <img src="{{ asset('assets/img/testimonials/user.jpg') }}" width="50px" height="50px" alt="Image" style="border-radius:50%">
                        @endif
                        <h5>{{ $agent->details->name ?? 'Unnamed Agent' }}</h5>
                        </div><br>
                        <h6 style="margin-bottom: 0px">Experience : {{$agent->details->years_of_expreience}} Years</h6>
                        <h6 style="margin-bottom: 0px">Broker : {{$agent->details->brokers_name}}</h6>
                        <h6 style="margin-bottom: 0px">Joined Date : {{date('m-d-Y',strtotime($agent->details->created_at))}}</h6>
                        <div class="text-center" style="margin-top:25px">
                        <a href="{{url('login')}}" style="color:green;width:100%;font-size:14px">Connect With Agent >></a>
                        </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center" style="margin-top: 50px">
        {!! $agents->withQueryString()->links() !!}
    </div>
@else
    &nbsp;
@endif
