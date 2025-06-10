@extends('dashboard.master')

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/pages/page_job_inner.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/pages/shortcode_timeline2.css') }}">
@stop

@section('title', 'Agents Search')

@section('content')
    <?php $topmenu = 'Agents'; ?>

    @include('dashboard.include.sidebar')

    <div class="block-description">
        <div class="container">
            <div class="row md-margin-bottom-10">
                <div class="col-md-12"
                    style="height:30vh;display:flex;align-items:center;flex-direction:column;justify-content:center">
                    <img src="{{ url('img/no_post.png') }}" style="max-width:25%">
                    <div>Please create a <a href="{{ url('/profile/buyer/posts') }}"><b>post</b></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
