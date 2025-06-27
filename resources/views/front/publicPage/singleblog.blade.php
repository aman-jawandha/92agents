@extends('front.master')
@section('title', 'Blog')

<!-- content start -->
@section('content')
<?php  $topmenu='Blog'; ?>
@include('front.include.sidebar')
    <!-- Main Section -->
    <section id="main">
        <!-- Title, Breadcrumb -->
        <div class="breadcrumb-wrapper">
            <div class="pattern-overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                            <h2 class="title">{{ strtoupper($title) }} <span><a href="{{route('like-blog',$id)}}" style="font-size:20px" class="badge"><i class="fa fa-thumbs-up"></i>{{$likeCount}}</a></span> | <span><a href="{{route('dislike-blog',$id)}}" style="font-size:20px" class="badge"><i class="fa fa-thumbs-down"></i>{{$dislikeCount}}</a></span></h2>
                            <p>{{ $detail->cat_name }}</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                            <div class="breadcrumbs pull-right">
                                <ul>
                                    <li>You are Now on:</li>
                                    <li><a href="{{url('/')}}">Home</a></li>

                                    <li><a href="{{url('/blogs')}}">Blogs</a></li>
                                    <li>Blog Info</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Title, Breadcrumb -->
        <!-- /Main Content -->
        <div class="content-about margin-top60">
            <div class="container">
                
                <div class="row">
                    <div class="posts-block col-lg-8 col-md-8 col-sm-8 col-xs-12 margin-bottom60">
                        <h4><i class="fa fa-user"></i> {{ $detail->name }} ({{ $detail->role_name }})
                            &nbsp; &nbsp; <i class="fa fa-calendar"></i> {{ date('d-m-Y', strtotime($detail->created_date)) }} &nbsp; &nbsp;
                            @if($detail->role_name == 'agent')<span><a href="{{route('get-agent-rating',$detail->details_id)}}" style="font-size:20px" class="badge">Rate Agent</a></span>@endif
                        </h4>
                        <?php echo $detail->description ?>
                        <hr>
                        <button type="button" class="btn btn-success" onclick="$('#comment_modal').modal('show')">Add Comment</button>
                        <hr>
                        <h3>User Comments:</h3>
                        <div class="showcomment">
                            <ul style="list-style: none;">
                                @foreach($comment as $comm)
                                <li><i class="fa fa-user"></i> <b>{{ $comm->email }}</b>&nbsp; &nbsp; &nbsp; &nbsp; <i class="fa fa-calendar"></i> <b>{{ $comm->com_date }}</b><br>
                                    {!! nl2br(e($comm->comment)) !!}
                                </li><br>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="posts-block col-lg-4 col-md-4 col-sm-4 col-xs-12">
                         <div class="">
                            <h3>Category List</h3>
                            <ul class="list-group sidebar-nav-v1" id="sidebar-nav-1" style="list-style: none;">       
                                @foreach($category as $cat)
                                <li class="list-group-item1 border1-bottom text-left" style="background: #74c52c;padding: 5px 15px;border-bottom: 1px solid #ddd;">
                                    <a href="{{ url('/blogs/category')}}/{{$cat->id}}/{{$cat->cat_name}}" style="padding: 5px 10px;color: #fff;display: block;/* font-size: 16px; */font-weight: 600;"><i class="fa fa-angle-right"></i> {{ $cat->cat_name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- /Promo -->
            </div>
        </div>
        <!-- /Main Content -->                                                              
     
    </section>
    <!-- /Main Section -->
    <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="comment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Comment</h5>
        <button type="button" class="close" onclick="$('#comment_modal').modal('hide')" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <form action="{{route('add-blog-comment')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="hidden" name="blog_id" value="{{ $id }}">
                                    <input type="text" name="comment_name" placeholder="Full Name" maxlength="50" required class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control" maxlength="250" rows="5" placeholder="Your Comment here..." name="comment" required></textarea>
                                </div>
                            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-lg btn-success">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
<!-- content end -->

@section('script')
<script type="text/javascript">
    $("#comment").submit(function(event) {

        $.ajax({
            url: "{{ url('/blog/comment') }}",
            type: 'post',
            dataType: 'json',
            data: $("#comment").serialize(),
            beforeSend:function(){
                $("#sbm").prop('disabled', true);
            },
            success:function(data){

                if (data.success=='ok') {
                    var txt = '<li><i class="fa fa-user"></i> <b>'+data.comment_name+'</b>&nbsp; &nbsp; &nbsp; &nbsp; <i class="fa fa-calendar"></i> <b>'+data.ctime+'</b><br><p>'+data.comment+'</p></li>';
                    $(".showcomment ul").append(txt);
                    $("#sbm").prop('disabled', false);
                    $("#comment").trigger('reset');
                    $('.comment-error').addClass('hide');
                } else if(typeof data.error !='undefined' && data.error !=null){
                    if(typeof data.error !='undefined' && data.error !=null){
                        $('.comment-error').removeClass('hide');
                    }
                }
            }
        })
        $("#sbm").prop('disabled', false);
        return false;
    });
</script>
@endsection