@extends('front.master')
@section('title', 'Home')

<!-- content start -->
@section('content')
    <?php $topmenu = 'Agents'; 
    use App\Models\AgentRating;
    use Illuminate\Support\Facades\DB;
    ?>
    @include('front.include.sidebar')
    <section id="main" style="padding: 70px 0px;" class="">
        <div class="container">
            @if ($agents->count())
                <h3 class="text-center" style="margin:50px 0px">Our Featured Agents</h3>
                <div class="row">
                    @foreach ($agents as $agent)
                        <div class="col-md-3">
                            <div class="card"
                                style="background-color: white;border:1px solid green;border-radius:10px;padding:20px">
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
                                    <a href="{{ url('login') }}" style="color:green;width:100%;font-size:14px">Connect With
                                        Agent >></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center" style="margin-top: 50px">
                    {{ $agents->links() }}
                </div>
            @endif

        </div>
        <div class="container" style="padding: 30px 0px">
            <div class="row flex_row_col_center">

                <div class="col-md-6 wow fadeInUp animated">
                    <div class="busness_man ">
                        <img src="{{ asset('/img/Frustrated.png') }}" style="">
                    </div>
                </div>
                <div class="col-md-6 wow fadeInDown animated">
                    <div class="agent_content_box">
                        <h2 style="">“Here’s How 92agents Will Help You Find
                            More Quality Clients”</h2>
                        <h3 style="font-size: 26px">It’s Really Easy!</h3>
                        <p>All you have to do is make an account. After that, you will have instant
                            access to millions of buyers and sellers. Here’s how it works:</p>
                        <ul class="bullet-points list-unstyled">
                            <li>Buyers or sellers request an agent and post their requirements.</li>
                            <li>You find which job you think suits you the best.</li>
                            <li>You make a proposal to said buyer or seller.</li>
                            <li>If he accepts… Great! Now you have a new deal.</li>
                            <li>If he doesn’t… No problem! There are still a ton of other sellers
                                and buyers waiting to use your services. </li>
                        </ul>
                        <p style="margin-bottom: 30px">Our system will allows you to get notifications whenever sellers or
                            buyers post their requirements. </p>
                        <a data-target="modalagent" class="sell_house nesusersignup cursor">Stressed ? 1000's of Sellers &
                            Buyers Waiting</a>

                    </div>
                </div>
            </div>
        </div>
        <section class="agent_sections">
            <div class="container" style="padding-top: 40px">
                <div class="row flex_row_col_center">

                    <div class="col-md-6 wow fadeInLeft animated dflex_center">
                        <div class="agent_content_box">
                            <h2 style="font-size: 36px">You Can Choose Who You Want <br> To Work With!</h2>
                            <p>Did you ever get a client that just did not click with? Maybe someone
                                who wouldn’t want to give you a higher commission rate even if the
                                house was really hard to sell. </p>
                            <p>Using our platform you won’t have to deal with annoying clients
                                anymore! How?
                            </p>
                            <p style="margin-bottom: 30px">YOU choose the clients YOU want to work with. If you feel that a
                                client
                                isn’t your cup of tea, then you have the option to just not work with
                                him!</p>

                            <a data-target="modalagent" class="sell_house nesusersignup cursor">How Many Listings You Want ?
                                Get It Fast</a>

                        </div>
                    </div>

                    <div class="col-md-6 wow fadeInRight animated">
                        <div class="busness_man ">
                            <img class="img-fluid" src="{{ asset('/img/mature.jpg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="agent_sections">

            <div class=" container">
                <div class="row flex_row_col_center">
                    <div class="col-md-6">
                        <div class="busness_man">
                            <img class="img-fluid" src="{{ asset('/img/cheering-business.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeInUp animated dflex_center">
                        <h2 class="">You Won’t Have To Go Out Of Your Way To Find Clients</h2>
                        <p class="">Our site brings sellers and buyers to you so that you won’t have to go
                            around trying to find new suitable clients. Just relax and look through
                            the thousands of offers available to you, choose the one you like,
                            complete it and get PAID.</p>
                        <p style="margin-bottom: 30px">Using our site is easy and straightforward without having any hidden
                            extra costs.</p>
                        <a data-target="modalagent" class="sell_house nesusersignup cursor">Be The Envy, Celebrate All You
                            Want</a>

                    </div>
                </div>
            </div>
        </section>

        <section class="agent_sections">
            <div class=" container">
                <div class="row flex_row_col_center">
                    <div class="col-md-6 wow fadeInUp animated dflex_center">
                        <h2 class="">The More You Use Our Site The Better!</h2>
                        <p class="">Build your profile and write about your qualifications, previous work
                            experience and other skills that can impress your clients.</p>
                        <p>Every deal you complete can earn you good reviews. Get as many good
                            reviews as possible to make yourself more trustworthy.</p>
                        <p>Our site is the thing every agent has been waiting for, and now it’s
                            finally here!
                        </p>
                        <p>Get a head start on your competition by signing up as fast as possible!</p>
                        <p style="margin-bottom: 30px">If you have any other questions make sure to contact our 24/7
                            customer support.</p>
                        <a data-target="modalagent" class="sell_house nesusersignup cursor">Be The One, Click Now</a>

                    </div>
                    <div class="col-md-6">
                        <div class="busness_man">
                            <img class="img-fluid" src="{{ asset('/img/successful-business.jpg') }}">
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>

@endsection
<style>
    body {
        font-family: 'Poppins' !important;
    }

    .Lower-banner h1 {
        margin-bottom: 0px;
        margin-top: 40px;
    }

    .bullet-points {
        position: relative;
        font-size: 18px;
        font-size: 20px;
        line-height: 22px;
        margin: 0 0 35px;
        font-weight: 500;
    }

    ul {
        display: block;
        list-style-type: disc;
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        padding-inline-start: 40px;
    }

    .bullet-points li::before {
        content: "";
        width: 10px;
        height: 10px;
        border: 2px solid #fff;
        border-radius: 100%;
        background: #59ab02;
        position: absolute;
        left: -4px;
    }

    li {
        margin-left: 20px;
    }

    .bullet-points:before {
        content: "";
        width: 2px;
        background: #59ab02;
        position: absolute;
        left: 0;
        top: 0;
        bottom: 13px;
    }

    p {
        line-height: 29px;
    }

    p {
        margin: 0 0 30px;
    }

    .Lower-banner p {
        font-size: 16px;
        color: #393939;
        font-weight: 300;
        width: 75%;
        margin: auto;
        padding: 10px 0px;
    }

    ul.bullet-points.list-unstyled li {
        /*font-size: 18px;*/
        line-height: 22px;
        margin: 0 30px 28px;
        font-weight: 600;
    }

    .btn-outline {
        color: #000;
    }

    .btn-outline {
        font-size: 20px;
        line-height: 24px;
        border: 1px solid #59ab02;
        background: none;
        padding: 13px 30px 7px;
        border-radius: 4px;
    }

    a {
        cursor: pointer;
    }

    .Lower-banner {

        background: url('./house-1867187_960_720.jpg');
        background-size: 100%;
        background-attachment: fixed;
    }

    a:hover {
        text-decoration: none;
        color: black;
    }
</style>
<!-- content end -->
