<?php
    use App\Models\AgentRating;
    use Illuminate\Support\Facades\DB;
?>
@if ($agents->count())
<h3 class="text-center" style="margin:50px 0px">Our Featured Agents</h3>
    <div class="row">
        @foreach ($agents as $agent)
            <div class="col-md-3">
                <div class="card" style="background-color: white;border:1px solid green;border-radius:10px;padding:20px">
                        <h6>
                            @if(!empty($agent->tags))
                                @foreach($agent->tags as $tag)
                                    <span class="badge badge-success" style="margin-right:5px;">{{ $tag }}</span>
                                @endforeach
                            @endif
                        </h6>
                        <div style="display:flex;align-items:center;justify-content:space-between">
                                    @if ($agent->details->photo)
                                        <img src="{{ asset('assets/img/profile/' . $agent->details->photo) }}"
                                            width="50px" height="50px" alt="Image" style="border-radius:50%">
                                    @else
                                        <img src="{{ asset('assets/img/testimonials/user.jpg') }}" width="50px"
                                            height="50px" alt="Image" style="border-radius:50%">
                                    @endif
                                    <h6>Name : {{ $agent->details->name ?? 'Unnamed Agent' }}</h6>
                                </div><br>
                                @php 
                                $ratingStats = AgentRating::where('rating_for', $agent->id)
                                    ->selectRaw('COUNT(*) as total, AVG(rating) as average')
                                    ->first();
                                $blogs = DB::table('agents_blog')->where('added_by',$agent->id)->count();
                                if ($agent->details->specialization != null) {
                                    $specialization_array = explode(',', $agent->details->specialization);
                                    $specialization = DB::table('agents_users_agent_skills')
                                        ->whereIn('skill_id', $specialization_array)->get();
                                    $all_specializations = [];

                                    foreach ($specialization as $single_specialization) {
                                        $all_specializations[] = $single_specialization->skill;
                                    }

                                    $specialization = implode(',', $all_specializations);
                                }
                                $postIds = DB::table('agents_selldetails')->where('agent_id', $agent->id)->where('status',1)->pluck('post_id');
                                $bought = DB::table('agents_posts')->whereIn('post_id', $postIds)->where('agents_users_role_id', 2)->count();
                                $sold = DB::table('agents_posts')->whereIn('post_id', $postIds)->where('agents_users_role_id', 3)->count();
                                @endphp
                                <h6 style="margin-bottom: 0px">Homes Sold : {{ $sold }}</h6>
                                <h6 style="margin-bottom: 0px">Homes Bought : {{ $bought }}</h6>
                                <h6 style="margin-bottom: 0px">Experience : {{ $agent->details->years_of_expreience }} Years
                                </h6>
                                <h6 style="margin-bottom: 0px">Education : {{ $agent->details->real_estate_education[0]['degree'] ?? 'N\A' }}</h6>
                                <h6 style="margin-bottom: 0px">Expertise In : {{ $specialization ?? 'N\A' }}</h6>
                                <h6 style="margin-bottom: 0px">Total Ratings : {{ $ratingStats->total }}</h6>
                                <h6 style="margin-bottom: 0px">Average Rating : {{ number_format($ratingStats->average, 1) }} / 5</h6>
                                <h6 style="margin-bottom: 0px">No. Of Blogs Published : {{ $blogs }}</h6>
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
