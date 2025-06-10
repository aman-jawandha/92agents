@extends('front.master')

@section('title', 'Home')



<!-- content start -->

@section('content')

    <?php $topmenu = 'Buyer'; ?>

    @include('front.include.sidebar')

    <style>
        input[type=number]::-webkit-inner-spin-button {

            -webkit-appearance: none;

        }

        input[type=number] {

            -moz-appearance: textfield;

        }

        .help-block {
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }

        #home_made p {
            padding: 0px 0px;
            margin: 0 0 10px;
        }
        .connects{
            height: 550px;
            max-height: 100%
        }
        .connects,
.content {
  min-height: 550px;
}
        .connect_img{
            width: 100%;
            max-height: 100%;
            height: auto;
            object-fit: cover
        }
    </style>
    <div class="wrapper">
        <section id="home_made">
            <div class="container">
                <div class="row flex_row_col_center">
                    <div class="col-md-6">
                        <h2>“Here’s How 92agents Will Help You Find Your Dream
                            House Fast And Stress-Free While You Do The Things
                            You Love”</h2>
                        <p>It’s very risky to buy a house when you don’t have a lot of real estate
                            experience. Imagine this…
                        </p>

                        <p class="bying_para">You find your “dream” house and then you buy it. Seller gives you the
                            keys and you’re excited about your perfect new home. But then the
                            nightmares start pouring in.
                        </p>

                        <p>The house isn’t exactly what you expected, you are not sure why but
                            you have this feeling that something is not right.
                        </p>
                        <p>After some time you even find out that the house was foreclosed which
                            is very bad news! The seller told you that his house has low upkeep
                            costs, he even showed you statistics!
                        </p>
                        <p style="margin-bottom: 30px">But when the maintenance bill arrives your mouth drops to the floor
                            and then you realize that everything he told you was a lie.
                        </p>
                        <a class="sell_house nesusersignup cursor" data-target="modalbuyer" >Dream Home 3 Days or Less</a>
                    </div>
                    <div class="col-md-6">
                        <div class="busness_man">
                            <img class="img-fluid" src="{{ asset('/img/Home-search.png') }}" alt="business man">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="comparison" style="display: none">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="comparisontable">
                            <table style="width:100%" class="comparison_table">
                                <tr>
                                    <th style="background-color: #fff;">
                                        <span class="d-flex">COMPARISON SHEET</span>
                                        <p>Commission</p>
                                    </th>
                                    <th>
                                        <span class="d-flex"
                                            style="background-image: linear-gradient(#8aaeef, #475d87);">SUB
                                            TOPIC</span>
                                        <p>Commission</p>
                                    </th>
                                    <th>
                                        <span class="d-flex"
                                            style="background-image: linear-gradient(#c5c5c5, #908BE3);">AGENT 1</span>
                                        <p>1%</p>
                                    </th>
                                    <th>
                                        <span class="d-flex"
                                            style="background-image: linear-gradient(#dc61af, #cf7ec1);">AGENT 2</span>
                                        <p>1.5%</p>
                                    </th>
                                    <th>
                                        <span class="d-flex"
                                            style="background-image: linear-gradient(#b45981, #5F213C);">AGENT 3</span>
                                        <p>3%</p>
                                    </th>
                                    <th>
                                        <span class="d-flex"
                                            style="background-image: linear-gradient(#f14822, #FE6948);">AGENT 4</span>
                                        <p>4%</p>
                                    </th>
                                    <th>
                                        <span class="d-flex"
                                            style="background-image: linear-gradient(#28da40, #6FD37C);">AGENT 5</span>
                                        <p>5%</p>
                                    </th>
                                </tr>
                                <tr class="odd">
                                    <td>Guarantee or NO Commission</td>
                                    <td>
                                        <p>15 day BUY Guarantee</p>
                                        <p>30 day BUY Guarantee</p>
                                    </td>
                                    <td>
                                        <p>yes</p>
                                        <p>yes</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td>Online Marketing</td>
                                    <td>No of ways to market</td>
                                    <td>MLS + 64ways</td>
                                    <td>MLS + 48ways</td>
                                    <td>MLS + 30ways</td>
                                    <td>MLS + 20ways</td>
                                    <td>MLS ONLY</td>
                                </tr>
                                <tr class="odd">
                                    <td>Guarantee or NO Commission</td>
                                    <td>
                                        <p>15 day BUY Guarantee</p>
                                        <p>30 day BUY Guarantee</p>
                                    </td>
                                    <td>
                                        <p>yes</p>
                                        <p>yes</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td>Online Marketing</td>
                                    <td>No of ways to market</td>
                                    <td>MLS + 64ways</td>
                                    <td>MLS + 48ways</td>
                                    <td>MLS + 30ways</td>
                                    <td>MLS + 20ways</td>
                                    <td>MLS ONLY</td>
                                </tr>
                                <tr class="odd">
                                    <td>Guarantee or NO Commission</td>
                                    <td>
                                        <p>15 day BUY Guarantee</p>
                                        <p>30 day BUY Guarantee</p>
                                    </td>
                                    <td>
                                        <p>yes</p>
                                        <p>yes</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td>Online Marketing</td>
                                    <td>No of ways to market</td>
                                    <td>MLS + 64ways</td>
                                    <td>MLS + 48ways</td>
                                    <td>MLS + 30ways</td>
                                    <td>MLS + 20ways</td>
                                    <td>MLS ONLY</td>
                                </tr>
                                <tr class="odd">
                                    <td>Guarantee or NO Commission</td>
                                    <td>
                                        <p>15 day BUY Guarantee</p>
                                        <p>30 day BUY Guarantee</p>
                                    </td>
                                    <td>
                                        <p>yes</p>
                                        <p>yes</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                </tr>
                                <tr class="even">
                                    <td>Online Marketing</td>
                                    <td>No of ways to market</td>
                                    <td>MLS + 64ways</td>
                                    <td>MLS + 48ways</td>
                                    <td>MLS + 30ways</td>
                                    <td>MLS + 20ways</td>
                                    <td>MLS ONLY</td>
                                </tr>
                                <tr class="odd">
                                    <td>Guarantee or NO Commission</td>
                                    <td>
                                        <p>15 day BUY Guarantee</p>
                                        <p>30 day BUY Guarantee</p>
                                    </td>
                                    <td>
                                        <p>yes</p>
                                        <p>yes</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                    <td>
                                        <p>no</p>
                                        <p>no</p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="among" style="background:#D5D8DF;">
            <div style="background: #59AB02;padding: 30px 0;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 style="text-align: center;padding-top: 10px;
                            margin: 0;">Don’t
                                get this the wrong way!</h2>
                            <p class="w-50" >
                                We are not trying to discourage you from buying a house.<br> Entering a
                                new, freshly bought house is one of the greatest feelings on this planet.<br>
                                But you need to know what you’re doing. For example…
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="home_made" style="padding: 100px 0px 100px 0px;">
            <div class="container">
                <div class="row flex_row_col_center">
                    <div class="col-md-6">
                        <div class="busness_man">
                            <img class="img-fluid" src="{{ asset('/img/a-house.jpg') }}" alt="business man">
                        </div>
                    </div>
                    <div class="col-md-6" >
                        <div class="dflex_center">
                        <h2>Do you know:</h2>
                        <p>How the structural build of a house is going to affect you in the
                            long run?
                        </p>

                        <p class="bying_para">How to analyze sellers to determine if they are trustworthy?
                        </p>

                        <p>How to determine if a house is foreclosed or vacant?
                        </p>
                        <p>How to choose the best location for your home in relation to your
                            work, schools, and other important places?
                        </p>
                        <p style="margin-bottom: 30px">What the state of the market is at certain times and how that
                            affects your situation?
                        </p>
                        <a class="sell_house nesusersignup cursor" data-target="modalbuyer" >Buy, Save $10,000 Now</a>

                    </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="among" style=" background:#D5D8DF;">
            <div style="background: #59AB02">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="w-50" style="display: block ; text-transform: unset; font-weight: 400;">
                                You might be overwhelmed by all of this and that’s okay. This is exactly
                                why we developed a platform to simplify everything for you.
                            </p>
                            <h3 style="color: #fff ;font-size:30px" >Let’s look at agents for example… </h3>
                            <p class="w-50" style="display: block ; text-transform: unset; font-weight: 400; padding-top:0px">
                                Have you ever had problems dealing with agents face to face? Are they
                                just too much for you and you feel like they back you into a corner
                                every time? <br><br>
                                That’s because they are <strong>trained </strong>to do that.<br><br> 
                                Here at <strong>92agents</strong> you will not meet your agents face to face. This
                                means that they will not be able to use their techniques on you.<br><br>
                                How does that help? 
                                You will be able to take better decisions because you won’t get put
                                under pressure by their tactics. <br><br>
                                You shouldn’t be spending time studying boring stuff about real estate
                                when you could be doing something you love instead. 
                            </p>
                            <h3 style="color: #fff ;font-size:30px" >Take these 3 simple steps and let us help you find your dream house!</h3> 
                            <p class="w-50" style="display: block ; text-transform: unset; font-weight: 400; padding-top:0px">
                                1. Sign up on our site and register as a Buyer.<br>
                                2. Choose the agent you want to work with.<br>
                                3. Sit back and let the magic happen!<br><br>
                                if you have any questions, feel free to contact our 24/7 customer
                                support.<br>
                                Do you want to buy a house? We will help you do just that!
                                Sign up now to find your dream house fast, stress-free and get the best
                                possible deal for it!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="connect" >
            <div class="container-fluid">
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-6 p-0">
                        <div class="connects">
                            <img class="img-fluid connect_img" src="{{ asset('/img/Groupoffagents.png') }}" alt="Connect with us">
                        </div>
                    </div>
                    <div class="col-md-6" style="background: #59AB02; min-height: 415px;">
                        <div class="content">
                            <h3 style="text-align: left;">
                                <strong style="color: #fff; font-size:30px">What about agents?
                                    Are you sure that the agent you chose will be able to:</strong>
                            </h3>
                            <ul>
                                <li>Find quality sellers in a short time span?</li>
                                <li>Put your interests above his?</li>
                                <li>Have clear, understandable communication skills and give you
                                    frequent updates instead of just ignoring you?
                                </li>
                                <li>Accurately analyze a house and find every single disadvantage
                                    that a house may have? </li>
                                <li>Understand exactly what you are looking for?</li>
                                <li>Engage them to buy home</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="agent">
            <h3 class="text-center py-5 text-capitalize">Why 92 Agents?</h3>
            <div class="container">
                <div class="row custom_row" style="justify-content: center;">
                    <div class="col-md-4">
                        <div class="my_agent">
                            <img class="img-fluid" src="{{ asset('/img/home/Layer 23.png') }}" alt="">
                        </div>
                        <p class="text-center py-3">Get to see 100+ agents near to you</p>
                    </div>
                    <div class="col-md-4">
                        <div class="my_agent">
                            <img class="img-fluid" src="{{ asset('/img/home/1056449-200.png') }}" alt="">
                        </div>
                        <p class="text-center py-3">Access their bio including qualification, experience and custom
                        </p>
                    </div>
                    <div class="col-md-4">
                        <div class="my_agent">
                            <img class="img-fluid" src="{{ asset('/img/home/1380370.png') }}" alt="">
                        </div>
                        <p class="text-center py-3">Do Live chat with them</p>
                    </div>
                    <div class="col-md-4">
                        <div class="my_agent">
                            <img class="img-fluid" src="{{ asset('/img/home/Layer 24.png') }}" alt="">
                        </div>
                        <p class="text-center py-3">Make your requirements public to all agents through a unique data
                        </p>
                    </div>
                    <div class="col-md-4">
                        <div class="my_agent">
                            <img class="img-fluid" src="{{ asset('/img/home/open-24-hrs-a-d.png') }}" alt="">
                        </div>
                        <p class="text-center py-3">Get 24/7 customer support from our side.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="home_made" style="padding: 100px 0px 0px 50px;">
            <div class="container">
                <div class="row flex_row_col_center">
                    
                    <div class="col-md-6" style="min-height: 500px;">
                        <div class="dflex_center">
                        <h2>Here’s what you will Miss if you choose to Not work with us.</h2>
                        <p>Top-Quality agents    
                        </p>

                        <p class="bying_para">A system that lets you see their qualifications, customer reviews 
                            and past work experience
                        </p>

                        <p>It will take longer for you find a perfect house
                        </p>
                        <p>You will have to spend time learning about real estate when you 
                            could sit back and enjoy your favorite hobbies while we take care 
                            of everything
                        </p>
                        <p style="margin-bottom: 30px">
                       <strong>P.S. Don’t Wait! </strong> Sign up as fast as possible to make sure you don’t miss 
                        out on any potential best case scenario deals! <p>
                        <a class="sell_house nesusersignup cursor" data-target="modalbuyer" >Many Agents, Find The Best Now </a>

                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="busness_man">
                            <img class="img-fluid" src="{{ asset('/img/beautiful.jpg') }}" alt="business man">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="newsletter">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="sign_up position-relative" style="position: relative;">
                            <div class="position-absolute w-75 newss">
                                <p class="text-capitalize" style="color: #fff; font-weight:bold;"></p>
                                <h3 class="text-capitalize" style="color: #fff; font-weight:bold;"> Register yourself as a
                                    buyer and<br>
                                    access thousand agents profile in next 10 minutes</h3>
                                <a style="width: auto" class="read_more text-center d-block my-3 nesusersignup cursor" style="border: none;"
                                      data-target="modalbuyer">Join now to get your dream
                                    house</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<!-- content end -->
