@extends('front.master')

@section('title', 'Home')



<!-- content start -->

@section('content')

    <?php $topmenu = 'Seller'; ?>

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
        .connects{
            height: 412px;
            max-height: 100%
        }
        .connect_img{
            width: 100%;
            max-height: 100%;
            min-height: 474px;
            object-fit: cover
        }
@media (max-width: 1200px) {
    .connect_img,
    .content{
            min-height: 574px;
    }
    
}
@media (max-width: 992px) {
    .connect_img,
    .content,
    .connects {
            min-height: auto;
            height: auto;
    }
    #connect{
        padding: 30px
    }
}
    </style>
    {{-- href="https://dev.92agents.com/signup/sellers" --}}
    <div class="wrapper">
        <section id="home_made">
            <div class="container">
                <div class="row flex_row_col_center">
                    <div class="col-md-6">
                        <h2>Here’s How 92agents Makes House Selling
                            Easy and Profitable?</h2>
                        <ul class="home_selling">
                            <li>Selling a house is not an easy thing to do. You can easily lose money if
                                you are not careful.</li>
                            <li>There are a lot of details and secret insider tricks to house selling that
                                you might not be aware of. And since selling your house is such an
                                important endeavor, you need to make sure that everything goes
                                smoothly.
                            </li>
                            <li>Sounds pretty complicated doesn’t it? Well that’s because it is, but
                                don’t worry, keep reading to find out how to maximize your house’s
                                potential!
                            </li>
                            <li>
                                There might be problems that you overlook just because it’s your own
                                house. We understand that it’s hard to find negatives about your own
                                house… after all it’s yours!
                            </li>
                        </ul>
                        <div class="two_btn_column">
                            <a class="sell_house nesusersignup cursor" data-target="modalseller" >Sell In 3 Days Or Less
                                &gt;</a>
                                {{-- <a  data-toggle="modal" data-target="#registrationModal" class="sell_house">Sign Up</a> --}}
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="busness_man">
                            <img class="img-fluid" src="{{ asset('/img/Agents-running.png') }}" alt="business man">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="home_made">
            <div class="container">
                <div class="row flex_row_col_center">

                    <div class="col-md-6">
                        <div class="busness_man">
                            <img class="img-fluid" src="{{ asset('/img/Happy.png') }}" alt="business man">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2>Are you confident that your house is ready for selling?</h2>
                        <ul class="home_selling">
                            <li>Is your lawn in excellent shape or is it just decent?</li>
                            <li>Are there really no repairs that need to be done?</li>
                            <li>Are you sure that there is no faded paint or creaky floors in any
                                part of the house?</li>
                            <li> Does your house look appealing? (There are a lot of little things
                                you can do that makes it look extraordinary! Do you know about
                                them?)</li>
                            <li>
                                Do you know how to perfectly price your house? This is a tricky one!
                            </li>
                            <li>If you go too high no one will buy. If you go too low, well, you get
                                the idea.</li>
                        </ul>
                        <div class="two_btn_column">
                        <a  class="sell_house nesusersignup cursor" data-target="modalseller">Many Many Buyers, Fast 
                            &gt;</a>
                            {{-- <a  data-toggle="modal" data-target="#registrationModal" class="sell_house">Sign Up</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="home_made">
            <div class="container">
                <div class="row flex_row_col_center">
                    <div class="col-md-6">
                        <h2>Do you know what a professional agent knows?</h2>
                        <ul class="home_selling">
                            <li>What makes a home sell fast?
                            </li>
                            <li>How should a house be prepared before selling it?
                            </li>
                            <li>Who to call if you need something fixed fast?</li>
                            <li>Can you analyze your house and know exactly which kind of
                                buyers would like that type of house as well as where to find
                                them?</li>
                            <li>Do you know WHEN to sell your house?</li>
                            <li>Are you aware of the specific camera angles that make your house
                                more desirable?</li>
                        </ul>
                        <div class="two_btn_column">
                            <a class="sell_house nesusersignup cursor" data-target="modalseller">Sell Your House At 1% Commission
                                &gt;</a>
                                {{-- <a  data-toggle="modal" data-target="#registrationModal" class="sell_house">Sign Up</a> --}}
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="busness_man">
                            <img class="img-fluid" src="{{ asset('/img/sold-with.jpg') }}" alt="business man">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="comparison" style="display: none">
            <div class="container">
                <div class="row flex_row_col_center">
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
        <section id="among" style=" background:#D5D8DF;">
            <div style="background: #59AB02;padding: 30px 0;">
                <div class="container">
                    <div class="row flex_row_col_center">
                        <div class="col-md-12">
                            <p class="w-50" style="display: block ; text-transform: unset; font-weight: 400;">
                                Do not feel intimidated or afraid! That’s what we are here for. You
                                don’t need to waste countless hours learning everything about real
                                estate. <strong>92agents</strong> will take care of everything for you. </p>
                               
                             
                             <h3 style="color: #fff; font-size:30px">   Now let’s talk about our <strong>agents.</strong></h3>
                             <p class="w-50" style="display: block ; text-transform: unset; font-weight: 400; padding-top:0px">
                                Have you ever had problems dealing with agents face to face? Are they
                                just too much for you and you feel like they back you into a corner
                                every time?<br><br>
                                That’s because they are trained to do that. <br><br>

                                Here at <strong>92agents</strong> you will not meet your agents face to face so they will
                                not be able to use their techniques on you. How does that help?<br><br>
                                You will be able to make a better decision because you will have more
                                time to think about everything and you won’t get put under pressure by
                                their tactics.<br><br>
                                Our agents know the answers to all the questions you have. They have
                                years, decades of experience in real estate. 
                             </p>
                                <h3 style="color: #fff ;font-size:30px">  Our site will take care of everything for you. All you have to do is this:</h3>
                             <p class="w-50" style="display: block ; text-transform: unset; font-weight: 400; padding-top:0px">

                                1. Sign up on our site and register as a seller.<br>
                                2. Choose the agent you want to work with.<br>
                                3. Sit back and let the magic happen!<br><br>
                                If you have any questions ask our 24/7 customer support!<br>
                                We are professionals. Do you want to sell your house? <strong>92agents</strong> is the
                                best possible choice out there. <br>
                                <strong>Sign up ONLY</strong> if you want to sell your house fast, stress-free and for as
                                much money as possible.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="connect">
            <div class="container-fluid">
                <div class="row" style="margin-bottom: 20px">
                    <div class="col-md-6 p-0">
                        <div class="connects">
                            <img class="img-fluid
                            connect_img  " src="{{ asset('/img/Watch-the.jpg') }}" alt="Connect with us">

                        </div>
                    </div>
                    <div class="col-md-6" style="background: #59AB02;">
                        <div class="content">
                            <h3 style="text-align: left;">
                                <strong style="color: #fff; font-size:30px">Here’s what you’ll Miss if you choose to Not work with
                                    us:</strong>
                            </h3>
                            <ul>
                                <li>Top-Quality agents</li>
                                <li>A system that lets you see their qualifications, customer reviews
                                    and past work experience</li>
                                <li>It will take longer to sell your house</li>
                                <li>You will have to spend time learning about real estate when you
                                    could sit back and enjoy your favorite hobbies while we take care
                                    of everything</li>
                            </ul>
                            <p style="color: #fff">P.S. Don’t Wait! One of your potential buyers might be looking for a
                                house as we speak! Act fast and <strong>Sign up</strong> now to make sure that you
                                don’t miss out on anything!</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <section id="agent">
            <h3 class="text-center py-5 text-capitalize">Why 92 Agents?</h3>
            <div class="container">
                <div class="row custom_row" style="justify-content: center;">
                    <div class="col-6 col-lg-4 col-md-4 ">
                        <div class="my_agent">
                            <img class="img-fluid" src="{{ asset('/img/home/Layer 23.png') }}" alt="">
                        </div>
                        <p class="text-center py-3">Get to know about nearby professional agents in just 10 mins.</p>
                    </div>
                    <div class="col-6 col-lg-4 col-md-4 ">
                        <div class="my_agent">
                            <img class="img-fluid" src="{{ asset('/img/home/help.png') }}" alt="">
                        </div>
                        <p class="text-center py-3">Compare them as per their qualification and expertise</p>
                    </div>
                    <div class="col-6 col-lg-4 col-md-4 ">
                        <div class="my_agent">
                            <img class="img-fluid" src="{{ asset('/img/home/1380370.png') }}" alt="">
                        </div>
                        <p class="text-center py-3">Use one to one chat feature to know them better</p>
                    </div>
                    <div class="col-6 col-lg-4 col-md-4 ">
                        <div class="my_agent">
                            <img class="img-fluid" src="{{ asset('/img/home/ask-a-question-.png') }}" alt="">
                        </div>
                        <p class="text-center py-3">Raise your query to all agents simultaneously</p>
                    </div>
                    <div class="col-6 col-lg-4 col-md-4 ">
                        <div class="my_agent">
                            <img src="{{ asset('/img/home/faq.png') }}" alt="">
                        </div>
                        <p class="text-center py-3">Make the FAQs public on your dashboard to avoid repetitive ques</p>
                    </div>
                    <div class="col-6 col-lg-4 col-md-4 ">
                        <div class="my_agent">
                            <img src="{{ asset('/img/home/time.png') }}" alt="">
                        </div>
                        <p class="text-center py-3">Save time. Make a great deal</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="newsletter">
            <div class="container">
                <div class="row flex_row_col_center">
                    <div class="col-md-12">
                        <div class="sign_up position-relative" style="position: relative;">
                            <div class="position-absolute w-75 newss">
                                <p class="text-capitalize" style="color: #fff; font-weight:bold;">
                                <h3 class="text-capitalize" style="color: #fff; font-weight:bold;">You Save Upto $10,000 When you<br> Choose 92 Agents!</h3>
                                <a style="width: auto" class="read_more text-center d-block my-3 cursor nesusersignup cursor" data-target="modalseller" style="border: none;"
                                   >Join To Save Your $10,000</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<!-- content end -->
