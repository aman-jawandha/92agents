@extends('dashboard.master')
@section('title', 'Blog Details')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/summernote/css/summernote.css') }}">

<style>

</style>
@stop
@section('content')
<?php  $topmenu='Advertise'; ?>
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
				<h1 class="margin-bottom-40">Blog</h1>
				<div class="box-shadow-profile homedata homedataposts ">
					<!-- Default Proposals -->
					<div class="panel-profile">
						<div class="panel-heading overflow-h air-card">
							<h2 class="panel-title heading-sm pull-left"><i class="fa fa-newspaper-o"></i>Blog. 
						</div>
						
							<div class="panel-body">
								<div class="row">
									<div class="col-md-4">
										<h2>{{ $res->title }}</h2>
										<h3> Description: $ {{ $res->description }}</h3>
										
									</div>								
								</div>
								
							</div>
						
					</div>
					<!-- Default Proposals -->
				</div>
				
				

				
			</div>
			<!-- End Profile Content -->
		</div>
	</div>	
@endsection

@section('scripts')

@stop