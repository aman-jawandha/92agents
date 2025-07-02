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
                    <h1 class=" margin-bottom-40 pull-left">Create Advertisement</h1>
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
                    <p style="margin:15px"><b>Enter this url to promote your profile - {{url('/search/agents/details/'.auth()->id())}}</b></p>
                        <form method="POST" id="popin_form" action="{{ route('store-advrtismnt') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-4">
                                <label>Button Text</label>
                                <input type="text" name="title" class="form-control" maxlength="50"
                                    placeholder="Eg. Explore Blog, Agent Post etc." required>
                            </div>
                            <div class="col-md-8">
                                <label>Heading</label>
                                <input type="text" name="heading" class="form-control" maxlength="250"
                                    placeholder="Heading">
                            </div>
                            <div class="col-md-12">
                                <label>Description</label>
                                <textarea id="summernote" class="form-control" maxlength="5000" name="description"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label>Image</label>
                                <input type="file" name="image" id="fileInput" class="form-control" placeholder="Image">
                                <span id="error-msg" style="color: red;"></span>
                            </div>
                            <div class="col-md-6">
                                <label>Url</label>
                                <input type="url" name="url" class="form-control" maxlength="250"
                                    placeholder="Add url to show button">
                            </div>
                            <div class="col-md-12">&nbsp;</div>
                            <div class="col-md-3">
                                <label>Whom To Show?</label>
                                <select class="form-control" name="for_whom" required>
                                    <option value="" disabled selected>Select User</option>
                                    <option value="3">Seller</option>
                                    <option value="2">Buyer</option>
                                    <option value="All">All</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Status</label>
                                <select class="form-control" name="status" required>
                                    <option selected value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Backgroud Color</label>
                                <input type="color" name="bg_color" value="#37A000" class="form-control"
                                    placeholder="Background Color" required>
                            </div>
                            <div class="col-md-3">
                                <label>Button Color</label>
                                <input type="color" name="btn_color" value="#121211" class="form-control"
                                    placeholder="Button Color" required>
                            </div>
                            <div class="col-md-12">&nbsp;</div>
                            <div class="col-md-12">
                                 @php
                                    $plan_designs = explode(',', $user_plan->designs);
                                @endphp
                                <label>Choose Pop-in Design</label>
                                @if(in_array('top_right', $plan_designs))
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="top_right" name="design"
                                        id="top_right">
                                    <label class="form-check-label" for="top_right">Top-Right</label>
                                </div>
                                @endif
                                @if(in_array('right', $plan_designs))
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="right" name="design"
                                        id="right" checked>
                                    <label class="form-check-label" for="right">Right</label>
                                </div>
                                @endif
                                @if(in_array('bottom_right', $plan_designs))
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="bottom_right" name="design"
                                        id="bottom_right">
                                    <label class="form-check-label" for="bottom_right">Bottom-Right</label>
                                </div>
                                @endif
                                @if(in_array('bottom', $plan_designs))
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="bottom" name="design"
                                        id="bottom">
                                    <label class="form-check-label" for="bottom">Bottom</label>
                                </div>
                                @endif
                                @if(in_array('top_left', $plan_designs))
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="top_left" name="design"
                                        id="top_left">
                                    <label class="form-check-label" for="top_left">Top-Left</label>
                                </div>
                                @endif
                                @if(in_array('bottom_left', $plan_designs))
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="bottom_left" name="design"
                                        id="bottom_left">
                                    <label class="form-check-label" for="bottom_left">Bottom-Left</label>
                                </div>
                                @endif
                                @if(in_array('left', $plan_designs))
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="left" name="design"
                                        id="left">
                                    <label class="form-check-label" for="left">Left</label>
                                </div>
                                @endif
                                @if(in_array('top', $plan_designs))
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="top" name="design"
                                        id="top">
                                    <label class="form-check-label" for="top">Top</label>
                                </div>
                                @endif
                                @if(in_array('full_screen', $plan_designs))
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="full_screen" name="design"
                                        id="full_screen">
                                    <label class="form-check-label" for="full_screen">Full-Screen</label>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn-u btn-u-success">Submit</button>
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
