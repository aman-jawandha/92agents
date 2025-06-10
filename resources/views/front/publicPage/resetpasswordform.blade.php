@extends('front.master')
@section('title', 'Home')

<!-- content start -->
@section('content')
    <?php $topmenu = 'Home'; ?>
    @include('front.include.sidebar')
    <!-- Main Section -->
    <section id="main">
        <div class="breadcrumbs">
            <div class="container">
                <h1 class="text-center text-uppercase">Reset your password</h1>
            </div>
        </div>

        <div class="container content">
            <div class="row">
                <div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form method="POST" action="{{ Route('resetpassword') }}" class="form-horizontal" role="form">
                                @csrf

                                @if ((!empty($token) || $errors->has('check')) && !$errors->has('msg'))
                                    <div class="alert alert-danger text-center">
                                        {!! $token !!}
                                        <br> {!! $errors->first('check') !!}
                                    </div>
                                @endif

                                @if ($errors->has('msg'))
                                    <div class="alert alert-success text-center">{!! $errors->first('msg') !!}</div>
                                @endif

                                @if (empty($token))
                                    <div
                                        class="form-group {{ $errors->has('password') ? ' has-error' : '' }} col-md-12 col-sm-12 col-xs-12">
                                        <label for="forgotpassword">Password</label>
                                        <input id="forgotpassword" type="password" class="form-control"
                                            placeholder="Password" name="password" value="{{ old('password') }}" autofocus>
                                        @if ($errors->has('password'))
                                            <p class="error-text">
                                                {{ $errors->first('password') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div
                                        class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }} col-md-12 col-sm-12 col-xs-12">
                                        <label for="forgotpassword_confirmation">Confirm password</label>
                                        <input id="forgotpassword_confirmation" type="password" class="form-control"
                                            placeholder="Confirmation password" name="password_confirmation"
                                            value="{{ old('password_confirmation') }}" autofocus>
                                        @if ($errors->has('password_confirmation'))
                                            <p class="error-text">
                                                {{ $errors->first('password_confirmation') }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <input type="hidden" name="userid" value="{{ @$user->id }}">
                                        <button type="submit" class="btn btn-color" name="submit"
                                            value="Change Password">Reset Password</button>
                                        <a class="btn btn-link read_more text-center d-block my-3 cursor"
                                            href="{{ url('/login') }}"> Login </a>
                                    </div>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Main Section -->
@endsection
