@extends('front.master')
@section('title', 'Home')

<!-- content start -->
@section('content')
    <?php $topmenu = 'Popin'; ?>
    @include('front.include.sidebar')
    <!-- Main Section -->
    <section id="main">
        <div class="breadcrumb-wrapper">
            <div class="pattern-overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="title">{{$popin->heading}}</h2>
                        </div>
                        <div class="col-md-4">
                            @if(auth()->id() && (auth()->user()->agents_users_role_id == 2 || auth()->user()->agents_users_role_id == 3) && ($popin->get_user->details_id != 1))
                            <a href="{{url('/search/agents/details/' . $popin->get_user->details_id)}}"><h2 class="title">By : {{$popin->get_user->name ?? 'N\A'}}</h2></a>
                            @else
                            <h2 class="title">By : {{$popin->get_user->name ?? 'N\A'}}</h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content -->
            <div class="container">
                    @if ($popin->image)
                        <img src="{{ asset('uploads/popin_images/' . $popin->image) }}" style="width:200px;margin:10px" alt="Image">
                    @endif
                    {!! $popin->description !!}
            </div>
        <!-- /Main Content -->
    </section>
    <!-- /Main Section -->

@endsection
<!-- content end -->
