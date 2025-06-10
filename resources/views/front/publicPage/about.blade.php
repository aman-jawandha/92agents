
@extends('front.master')
@section('title', 'Home')

<!-- content start -->
@section('content')
<?php $topmenu = 'About'; ?>
@include('front.include.sidebar')
<section id="mainabout" style="background-image: url('{{ asset('front/img/about/aboutheader.jpg')}}'">
	<div class="container">
		<div class="row">
			<div class="col-md-12 wow fadeInUp animated">
				<div class="aboutcontent">
					<h2 class="heading">Who are we? 
                        </h2>
					<p class="paragaraph">
						A platform where a buyer or seller can meet up with any number of agents and find a <br> suitable agent for his/her needs.
                    </p>
					<p class="paragaraph">	A platform to connect buyers to agents or sellers to agents.</p>
						<p class="paragaraph">
						Each buyer or seller are unique. Their needs are unique. </p><p>They need a best matching agent.
					</p>
					<!-- <button class="btn btn-warn">Learn More</button> -->
				</div>
			</div>
		</div>
	</div>
</section>
<section id="lower">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 wow fadeInUp animated">
				<h2 class="text-center heading" style="padding-top: 50px ">Free services for all:</h2>
				
                    <ul><li class="paragaraph">Free to Chat/message</li>
                        <li class="paragaraph">Free to ask all sorts of questions and share answers</li>
                        <li class="paragaraph">Free to Share documents, take notes, bookmark</li>
                    </ul>
			</div>
		</div>
	</div>
	<div class="container custom-container">
		<div class="row flex_row_col_center">
			<div class="col-md-6 wow fadeInLeft animated">
				<h2 class="">For the potential buyer</h2>
               <h3> Without leaving your home find the very best agent for your need</h3>
				<p class="paragaraph" style="font-weight:bold;">
					You are a <br>
					</p>
					<ul><li class="paragaraph">Millennial looking for the 1st home</li>
                        <li class="paragaraph">New Parent looking to up the home</li>
                        <li class="paragaraph">A growing parent looking to add more to your existing</li>
                        <li class="paragaraph">Fabulous retired trying to scale down</li>
                        <li class="paragaraph">Looking for a different experience like Farm Land, Country side, No maintenance Condo etc.</li>
                        <li class="paragaraph">Need to buy now situation</li>
                    </ul>
			
					
					<h3 class="" style="margin-top: 20px;">What ever your need may be </h3>
					<ul>
						
					<li class="paragaraph">	Free to Post your need any no of times</li>
					<li class="paragaraph">	Free to Interview Agents without yielding to Sales Pitch</li>
					<li class="paragaraph">	Free to do Side-By-Side Compare of Agents (based on Education, Experience, your own questions…)</li>
					<li class="paragaraph">	Free to Select an agent for hire</li>
					<li class="paragaraph">	Absolutely free forever</li>
					</ul>

				
					<br>
				<button class="btn btn-warn"><a class="" style="color:#fff;margin-top: 20px;" href="{{ url('/buyers') }}">Become A Buyer</a></button>
			</div>

			<div class="col-md-6 wow fadeInRight animated">
				
				<div class="busness_man dflex_center" >
					<img  src="{{ asset('/img/wooden-background.jpg') }}"
					style="">
				</div>
			</div>
		</div>
	</div>
	<div class="container custom-container">
		<div class="row flex_row_col_center" style="margin-bottom: 60px">
			<div class="col-md-6 wow fadeInLeft animated">
				<div class="busness_man dflex_center" >
					<img  src="{{ asset('/img/sold-home.jpg') }}"
					style="">
				</div>
			</div>
			<div class="col-md-6 wow fadeInRight animated">
				<h2 class="">For the potential seller</h2>
				<p class="paragaraph" style="font-weight:bold;">You are a <br></p>
				<ul>
					<li class="paragaraph">Millennial looking to sell the 1st and get  the 2nd home.</li>
					<li class="paragaraph">New Parent looking to move up</li>
					<li class="paragaraph">A growing parent looking to add more to your existing</li>
					<li class="paragaraph">Fabulous retired trying to scale down</li>
					<li class="paragaraph">Looking for a different experience like Farm Land, Country side, No maintenance Condo etc.</li>
					<li class="paragaraph">Foreclosure/Financial hardship/health Issues or other issues</li>
					<li class="paragaraph">Need to sell now situation</li>
					</ul>
					<h5 style="margin-top: 20px;">What ever your need may be </h5>
					


						<ul>
					<li class="paragaraph">	Free to Post your need any no of times</li>
					<li class="paragaraph">	Free to Interview Agents without yielding to Sales Pitch</li>
					<li class="paragaraph">	Free to do Side-By-Side Compare of Agents (based on Education, Experience, your own questions…)</li>
					<li class="paragaraph">	Free to Select an agent for hire</li>
					<li class="paragaraph">	Absolutely free forever</li>
					</ul>
					
<br/>
					<button class=" btn btn-warn "><a class="" style="color:#fff; margin-top: 20px;" href="{{ url('/sellers') }}">Become A Seller</a></button>
				</div>
			</div>
		</div>
		<div class="container custom-container">
			<div class="row flex_row_col_center" style="margin-bottom: 60px">
				<div class="col-md-6 wow fadeInLeft animated">
                    <div class="dflex_center">
					<h2 class="">For the Agent<br></h2>
					<p class="paragaraph">
						


						1.	Free to connect to any number of buyers or sellers sitting in your couch, in your car<br>
						2.	Free to Share documents, take notes, bookmark<br>
						3.	Free to 1 click answer all buyers/sellers questions<br>
						4.	Free to get selected by a buyer or seller to represent them<br>

					</p>

					<button class=" btn btn-warn "><a class="" style="color:#fff;" href="{{ url('/agent') }}">Become An Agent</a></button>
				</div>
            </div>

				<div class="col-md-6 wow fadeInRight animated">
					<div class="busness_man " >
                        <img  src="{{ asset('/img/happy-businessmana.jpg') }}"
                        style="">
                    </div>
				</div>
			</div>
		</div>
	</section>



	@endsection
	<style>
		#mainabout{
			background-position: center;
			background-size: cover;
			background-repeat: no-repeat;
			min-height: 900px;
		}
		.aboutcontent{
			min-height: 900px;

			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: flex-start;
		}
		.custom-container{
			padding: 60px 0px;
		}
		.btn-warn {
			color: #fff;
			background-color: #59ab02 !important;
			border-color: #fcf8e3 !important;
		}
		.btn:hover {
			background-color: white;
			color: black;
		}

		.btn {
			background-color: #f09929;
			font-size: 19px;
			padding: 10px 20 10px;
		}


		.heading {
			font-size: 32px;
			line-height: 39px;
			font-weight: 600
		}

		.paragaraph {
			font-size: 22px;
			/* line-height: 22px; */
			font-weight: 400
		}
		h5 {
			    font-size: 18px;
		}

		@media screen and (max-width: 1650px) {
			#mainabout{
			min-height: 700px;
		}
		.aboutcontent{
			min-height: 700px;

		}
  body {
    background-color: lightgreen;
  }
}
	</style>
	<!-- content end -->
