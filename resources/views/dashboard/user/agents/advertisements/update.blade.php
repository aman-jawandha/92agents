@extends('dashboard.master')
@section('title', 'home page')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/summernote/css/summernote.css') }}">
@stop
@section('content')
    <?php $topmenu = 'Advertise'; ?>
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
                <div style="display:flex;align-items:center;justify-content:space-between">
                    <h1 class=" margin-bottom-40 pull-left">Update Advertisement</h1>
                    <a href="{{ route('agent-advertisement') }}" class="btn-u margin-bottom-25">View Advertisements</a>
                </div>
                @if (session('success'))
                    <p id="succes_alert"
                        style="background-color: green; color: white; padding: 8px 10px; display: flex; justify-content: space-between; align-items: center;">
                        <span>{{ session('success') }}</span>
                        <span style="cursor: pointer; font-weight: bold;"
                            onclick="document.getElementById('succes_alert').style.display='none'">X</span>
                    </p>
                @endif
                @if (session('error'))
                    <p id="error_alert"
                        style="background-color: #bb0505; color: white; padding: 8px 10px; display: flex; justify-content: space-between; align-items: center;">
                        <span>{{ session('error') }}</span>
                        <span style="cursor: pointer; font-weight: bold;"
                            onclick="document.getElementById('error_alert').style.display='none'">X</span>
                    </p>
                @endif
                <div class="row air-card box-shadow-profile" style="background-color: white !important">
                        <form method="POST" id="popin_form" action="{{ route('update-advrtismnt') }}" enctype="multipart/form-data">
                                <input type="hidden" name="popin_id" value="{{$popin->id}}">
                                @csrf
                                @if($popin->status != 'Most Liked')
                                <div class="col-md-4">
                                    <label>Button Text</label>
                                    <input type="text" name="title" value="{{$popin->title}}" class="form-control" maxlength="50"
                                        placeholder="Eg. Explore Blog, Agent Post etc." required>
                                </div>
                                <div class="col-md-8">
                                    <label>Heading</label>
                                    <input type="text" name="heading" value="{{$popin->heading}}" class="form-control" maxlength="250"
                                        placeholder="Heading">
                                </div>
                                <div class="col-md-12">
                                    <label>Description</label>
                                    <textarea id="summernote" class="form-control" maxlength="5000" name="description">{{$popin->description}}</textarea>
                                </div>
                                <div class="col-md-2">
                                    <label>Previous Image</label>
                                    <div>
                                        @if($popin->image)
                                        <a href="{{ asset('uploads/popin_images/'.$popin->image)}}" target="_blank"><img src="{{ asset('uploads/popin_images/'.$popin->image)}}" width="100px" height="100px" alt="Popin Image"></a>
                                        @else
                                        <p class="m-0">No Image Seleted</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Change Image</label>
                                    <input type="file" name="image" id="fileInput" class="form-control" placeholder="Image">
                                        <span id="error-msg" style="color: red;"></span>
                                </div>
                                <div class="col-md-6">
                                    <label>Url</label>
                                    <input type="url" name="url" class="form-control" maxlength="250"
                                        value="{{$popin->url}}" placeholder="Add url to show button">
                                </div>
                                <div class="col-md-12">&nbsp;</div>
                                <div class="col-md-4">
                                    <label>Whom To Show?</label>
                                    <select class="form-control" name="for_whom" required>
                                        <option {{($popin->for_whom == '3') ? 'selected' : ''}} value="3">Seller</option>
                                        <option {{($popin->for_whom == '2') ? 'selected' : ''}} value="2">Buyer</option>
                                        <option {{($popin->for_whom == 'All') ? 'selected' : ''}} value="All">All</option>
                                    </select>
                                </div>
                                <input type="hidden" name="status" value="{{$popin->status}}">
                                {{-- <div class="col-md-2">
                                    <label>Status</label>
                                    <select class="form-control" name="status" required>
                                        <option {{($popin->status == 'Active') ? 'selected' : ''}} value="Active">Active</option>
                                        <option {{($popin->status == 'Inactive') ? 'selected' : ''}} value="Inactive">Inactive</option>
                                    </select>
                                </div> --}}
                                @else
                                <input type="hidden" name="title" value="{{$popin->title}}" class="form-control" maxlength="50"
                                        placeholder="Eg. Explore Blog, Agent Post etc.">
                                <input type="hidden" name="heading" value="{{$popin->heading}}" class="form-control" maxlength="250"
                                        placeholder="Heading">
                                <textarea class="form-control hidden" maxlength="5000" name="description">{{$popin->description}}</textarea>
                                <input type="hidden" name="url" class="form-control" maxlength="250"
                                        value="{{$popin->url}}" placeholder="Add url to show button">
                                <input type="hidden" name="for_whom" value="{{$popin->for_whom}}">
                                <input type="hidden" name="status" value="{{$popin->status}}">
                                @endif
                                <div class="col-md-4">
                                    <label>Backgroud Color</label>
                                    <input type="color" name="bg_color" value="{{$popin->bg_color}}" class="form-control"
                                        placeholder="Background Color" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Button Color</label>
                                        <input type="color" name="btn_color" value="{{$popin->btn_color}}" class="form-control"
                                        placeholder="Button Color" required>
                                </div>
                                <div class="col-md-12">&nbsp;</div>
                                <div class="col-md-12">
                                    @php
                                    if($user_plan && $popin->status != 'Most Liked'){
                                        $plan_designs = explode(',', $user_plan->designs);
                                    }else{
                                        $plan_designs = ['top','bottom','left','right','full_screen','top_right','bottom_right','top_left','bottom_left'];
                                    }   
                                    @endphp
                                    <label>Choose Pop-in Design</label>
                                    @if(in_array('top_right', $plan_designs))
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="top_right" name="design"
                                            id="top_right" {{ ($popin->design == 'top_right') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="top_right">Top-Right</label>
                                    </div>
                                    @endif
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="right" name="design"
                                            id="right" {{ ($popin->design == 'right') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="right">Right</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="bottom_right" name="design"
                                            id="bottom_right" {{ ($popin->design == 'bottom_right') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bottom_right">Bottom-Right</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="bottom" name="design"
                                            id="bottom" {{ ($popin->design == 'bottom') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bottom">Bottom</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="top_left" name="design"
                                            id="top_left" {{ ($popin->design == 'top_left') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="top_left">Top-Left</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="bottom_left" name="design"
                                            id="bottom_left" {{ ($popin->design == 'bottom_left') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bottom_left">Bottom-Left</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="left" name="design"
                                            id="left" {{ ($popin->design == 'left') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="left">Left</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="top" name="design"
                                            id="top" {{ ($popin->design == 'top') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="top">Top (Full Width)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="full_screen" name="design"
                                            id="full_screen" {{ ($popin->design == 'full_screen') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="full_screen">Full-Screen</label>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn-u btn-u-success">Update</button>
                                </div>
                            </form>
                </div>
            </div>
            <!-- End Profile Content -->
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ URL::asset('assets/plugins/summernote/js/summernote.min.js') }}" type="text/javascript"></script>
<script>
    $('#summernote').summernote();
let isFileValid = true;

function validateFileInput() {
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];
    const errorMsg = document.getElementById('error-msg');
    errorMsg.textContent = '';
    isFileValid = true;

    if (!file) {
        return;
    }

    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    const maxSize = 1 * 1024 * 1024;

    if (!allowedTypes.includes(file.type)) {
        errorMsg.textContent = 'Allowed file types are jpg, jpeg, png and webp.';
        isFileValid = false;
        return;
    }

    if (file.size > maxSize) {
        errorMsg.textContent = 'Image must be less than 1MB.';
        isFileValid = false;
        return;
    }
}

document.getElementById('fileInput').addEventListener('change', function () {
    validateFileInput();
});

document.getElementById('popin_form').addEventListener('submit', function (e) {
    validateFileInput();
    if (!isFileValid) {
        e.preventDefault();
    }
});

</script>
@stop