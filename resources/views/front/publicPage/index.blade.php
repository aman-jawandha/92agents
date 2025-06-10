@extends('front.master')

@section('title', 'Home')

@section('content')

<?php $topmenu = 'Home'; ?>

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
</style>

<div class="wrapper">

	<section id="banner-slider">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<h3 id="slidetext" style="display: none;"></h3>

						<div class="carousel-inner" role="listbox">
							<div class="item active">
								<img src="{{ asset('img/slider1.png') }}" alt="">
								<div class="carousel-caption">
									<h2 style="color: #fff">Very Happy family. Very happy buyers</h2>
									<p>how to buy the best home in the market?</p>
								</div>
							</div>

							<div class="item">
								<img src="{{ asset('img/slider2.png') }}" alt="">
								<div class="carousel-caption">
									<h2 style="color: #fff">They just bought a nice home, very good deal
										How did they do it?</h2>
								</div>
							</div>

							<div class="item">
								<img src="{{ asset('img/slider3.png') }}" alt="">
								<div class="carousel-caption">
									<h2 style="color: #fff">sold in three days? How?</h2>
									<p>Who made it happen?</p>
								</div>
							</div>

							<div class="item">
								<img src="{{ asset('img/slider5.png') }}" alt="">
								<div class="carousel-caption">
									<h2 style="color: #fff">Just sold. Happy family.</h2>
									<p>selling is a complex process
										What's a Homes worth?</p>
								</div>
							</div>

							<div class="item">
								<img src="{{ asset('img/slider333.png') }}" alt="">
								<div class="carousel-caption">
									<h2 style="color: #fff">so many agents, who is the best?</h2>
									<p>I need to move now?</p>
								</div>
							</div>

							<div class="item">
								<img src="{{ asset('img/hr-manager.jpg') }}" alt="">
								<div class="carousel-caption">
									<h2 style="color: #fff">Get to know the agent before signing the contract</h2>
									<p>Post your requirements anonymously</p>
								</div>
							</div>
						</div>

						<div class="rt">
							<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
								<span><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
								<span><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="offer">
		<hr style="text-align:left;margin-left:0">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="azoffer">
						<div class="img_icon">
							<span><img src="{{ asset('img/home/hand.png') }}" alt="" width="40px"></span>
						</div>
						<div class="text mb-4">
							<h1>what we can offer you</h1>
							<p>Finding the right agent for fastest sale, one who can guarantee a quick sale or
								help you buy a good home and the right price.</p>
						</div>
					</div>

					<div class="agent_sba">
						<div class="overlay">
							<div class="agent1">
								<strong><h2 style="color: #fff">Agent</h2></strong>
								<p class="text">Sell your home in 3 days or less</p>
							</div>
						</div>

						<div class="overlay2">
							<div class="agent2">
								<strong><h2 style="color: #fff">Buyer</h2></strong>
								<div>
									<p class="text">- Expert agent who helped 50+ buyers this year
										vs ag agent whose sign you just saw.</p>
									<p class="text">- An agent who can locate a home to the envy
										of your friends who can put your interest first.</p>
									<p class="text">- Can you make money while buying your home?</p>
									<p class="text">- All our services are absolutely free for ever.</p>
								</div>

								@if (!Auth::user())
									<a class="cursor btn" data-toggle="modal" data-target="#registrationModal">
										Sign Up
									</a>
								@endif

								@if (Auth::user())
									<a href="/dashboard">Dashboard</a>
								@endif
							</div>
						</div>

						<div class="overlay">
							<div class="agent3">
								<strong><h2 style="color: #fff">seller</h2></strong>
								<p class="text"> Sell your home in 3 days or less</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="about-us">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="about-us">
						<div class="vertical"></div>
						<span><i class="fa fa-user" aria-hidden="true"></i></span>
					</div>
					<div class="about_text">
						<strong style="color:#fff"><h1 class="text-capitalize">about us</h1></strong>
						<p>92 agents is an online platform providing people who want to buy or sell properties
							an opportunity to interact with professional real estate agents
							who will help get them the best deals possible</p>
					</div>
					<h2 style="color:#fff;text-align:center">we provide all kinds of property solutions to</h2>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="provider">
						<span class="img-span"><img src="{{ asset('img/home/144729-200.png') }}" alt=""></span>
						<a class="text" href="{{ URL('/sellers') }}">sellers</a>
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="provider">
						<span class="img-span"><img src="{{ asset('img/home/download.png') }}" alt=""></span>
						<a class="text" href="{{ URL('/buyers') }}">buyers</a>
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-4">
					<div class="provider">
						<span class="img-span"><img src="{{ asset('img/home/realty-buyer-fl.png') }}" alt=""></span>
						<a class="text" href="{{ URL('/agent') }}">agents</a>
					</div>
				</div>

				<a data-toggle="modal" data-target="#registrationModal" class="read_more" style="cursor: pointer">Sign Up</a>
			</div>
		</div>
	</section>

	<section id="services">
		<hr style="text-align:left;margin-left:0">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="azservice">
						<div class="img_icon">
							<span class="icon-img">
								<img src="{{ asset('/img/star.png') }}" alt="">
							</span>
						</div>
						<div>
							<h1>services we provide</h1>
							<p>At 92 Agents we understand the difficulties faced by buyers, sellers and agents in the real estate
								industry, and it is our mission to provide solutions to those problems. We provide services to 3
								types of clients buyers, sellers and agents.</p>
						</div>
					</div>


					<div class="circle_agent">
						<h2>Seller</h2>
						<div class="serv_agent_img">
							<img src="{{ asset('/img/agents.jpg') }}" alt="">
						</div>
						<div class="serv_agent_content">
							<h3 style="font-weight: 600;">Hire the top-rated Agents without overpaying</h3>
							<span class="solid"></span>
							<p>Getting in touch to lots of skilled agents for the kind of home you want
								is just the start. In addition to this, you'll be able to compare commission
								rates, services, stats and a whole lot from some of the best agents in your
								locality. At the end of the day, you'll not only get the best prices but also
								exactly the kind of home you want in its best condition.</p>
						</div>
					</div>

					<div class="circle_agent">
						<h2>Buyer</h2>
						<div class="serv_agent_img">
							<img class="img-fluid" src="{{ asset('/img/sellers.jpg') }}" alt="">
						</div>

						<div class="serv_agent_content">
							<h3 style="font-weight: 600;">Stress-free and smarter way for you to buy your dream home</h3>
							<span class="solid"></span>
							<p>Work with your 92 Real Estate Agents to learn about the home buying process
								and your chosen market. 92 Real Estate Agents live in your community and
								know it well. They're experts on everything from home valuations to school
								districts and will work with you each step of the way to secure your
								homeownership dreams.</p>
						</div>
					</div>

					<div class="circle_agent">
						<h2>Agent</h2>
						<div class="serv_agent_img">
							<img class="img-fluid" src="{{ asset('/img/buyers.jpg') }}" alt="">
						</div>
						<div class="serv_agent_content">
							<h3 style="font-weight: 600;">Sign Up as an Agent and get more deals in your city</h3>
							<span class="solid"></span>
							<p>Our agents enjoy some of the highest commission rates in the market and control their books of business. Our streamlined operations allow us to` reward you well without sacrificing customer value. </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="choose">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="about-us">
						<div class="vertical"></div>
						<span style="padding: 0.7rem;"><img class="img-fluid" src="{{ asset('/img/home/why-us-vector-i.png') }}" alt=""></span>
					</div>
					<h1><span class="choose_agent text-capitalize text-center py-3" style="color: #fff">why choose 92
							Agents</span></h1>
				</div>
			</div>
		</div>
	</section>

	<section id="textaz">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div style="background-color: #676767;">
						<h2><span class="azagent">Seller</span></h2>
						<ol class="detail_point">
							<li>Which agent can market a in 100 different ways or one who just posts just in MLS
								and forgets you.More exposure, more chances of finding a buyer do you agree ?</li>
							<li>Can any agent give a guaranteed sale?</li>
							<li>Tried FSBO, Other agents</li>
							<li>Agent who can give such a good proposal that you can’t refuse</li>
							<li>A sweet talking agent vs one who sold more homes that any other</li>
							<li>What it takes to make the fastest sale?.. A home sitting in the market for 90days
								looses $$$ every month. Mortgage, Insurance, Utilities, Upkeep</li>
							<li>All agents are not made the same. Some know about foreclosure, some will do free
								staging, some will market your blessed home 150+ ways, some will sell real quick
								only a few can do all. where is that Agent</li>
							<li>Foreclosure, short sale, scale-up, scale down what ever you need there are good
								agents out there</li>
						</ol>
					</div>
				</div>

				<div class="col-md-6">
					<div style="background-color: #919191;">
						<h2><span class="azagent">Buyer</span></h2>
						<ol class="detail_point">
							<li>Are you sure that the agent you chose will be able to: Find quality sellers in a short time span?
							</li>
							<li> Put your interests above his? Have clear, understandable communication skills
								and give you frequent updates instead of just ignoring you?</li>
							<li> analyze a house and find every single disadvantage that a house may
								have? Understand exactly what you are looking for?</li>
							<li>Do you know: How the structural build of a house is going to affect you in the long
								run? How to analyze sellers to determine if they are trustworthy?</li>
							<li>How to determine if a house is foreclosed or vacant? How to choose the best
								location for your home in relation to your work, schools, and other important places?</li>
							<li>What the state of the market is at certain times and how that affects your situation?</li>
						</ol>
					</div>
				</div>
			</div>

			<a class="read_more text-center d-block my-3 read_more" data-toggle="modal" data-target="#registrationModal" style="cursor: pointer">Sign Up</a>
		</div>
	</section>

	<section id="agents">
		<hr style="text-align:left;margin-left:0">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="azservice">
						<div class="img_icon">
							<span class="icon-img">
								<img src="{{ asset('/img/user.png') }}" alt="">
							</span>
						</div>
						<div>
							<h2>Our Agents</h2>
							<p>We regularly updates on our Agents. Feel free to join with our Agents!</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-4 col-lg-4 col-md-4 col-sm-4">
						<div class="team">
							<img src="{{ asset('img/agent1.jpg') }}" alt="">
							<span class="team_role">Buyer/FSBO expert</span>
						</div>
					</div>
					<div class="col-4 col-lg-4 col-md-4 col-sm-4">
						<div class="team">
							<img src="{{ asset('img/agent2.png') }}" alt="">
							<span class="team_role">Seller/Expired listing expert</span>
						</div>
					</div>
					<div class="col-4 col-lg-4 col-md-4 col-sm-4">
						<div class="team">
							<img src="{{ asset('img/agent3.jpg') }}" alt="">
							<span class="team_role">Foreclosure/Short Sale expert</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="testimonial" style="display:none">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="about-us">
						<div class="vertical"></div>
						<span class="quote"><i class="fa fa-quote-right" aria-hidden="true"></i></span>
						<p style="margin-left: 50px; color:#fff">People Talking About Us</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="testimonial d-flex">
						<div class="testimonail_img">
							<img src="{{ asset('/img/client2.jpg') }}" alt="">
						</div>
						<div class="test_content">
							<span>Testimonial client 1</span>
							<span>-ABC</span>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="testimonial d-flex">
						<div class="testimonail_img">
							<img src="{{ asset('/img/client3.png') }}" alt="">
						</div>
						<div class="test_content">
							<span>Testimonial client 2</span>
							<span>-XYZ</span>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="testimonial d-flex">
						<div class="testimonail_img">
							<img src="{{ asset('/img/client1.jpg') }}" alt="">
						</div>
						<div class="test_content">
							<span>Testimonial client 3</span>
							<span>-DFG</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="newsletter">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="sign_up position-relative">
						<div class="position-absolute w-75 newss">
							<h3 class="text-capitalize" style="color: #fff;">Found a reason to work with us?
								<span class="d-block">Let's start!</span></h3>
							<a class="read_more text-center d-block my-3 cursor" style="border: none;" data-toggle="modal" data-target="#registrationModal">Sign Up</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>

<script>
	setTimeout(function() {
		var total = $('.item').length;
		var currentIndex = $('div.active').index() + 1;
		$('#slidetext').html(currentIndex + '/' + total);

		$('.carousel').on('slid.bs.carousel', function() {
			currentIndex = $('div.active').index() + 1;
			var text = currentIndex + '/' + total;
			$('#slidetext').html(text);
		});

		$('#slidetext').show();
	}, 2000);
</script>

<script>
	$(document).ready(function(e) {
		if (typeof owlCarousel === 'function') {
			$('#testimonail').owlCarousel({
				loop: true,
				margin: 30,
				dots: true,
				nav: true,
				items: 2,
			});
		}
	});
</script>

@endsection