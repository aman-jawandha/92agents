<!-- Modal -->
@php
    use App\Models\State;
    $s = new State();
    $state = $s->getStateByAny(['is_deleted' => '0', 'status' => '1']);
    $city = $s->getCityByAny(['is_deleted' => '0']);
    $area = $s->getAreaByAny(['is_deleted' => '0']);

    switch ($topmenu) {
        case 'Buyer':
            $topmenu = 'modalbuyer';
            break;

        case 'Seller':
            $topmenu = 'modalseller';
            break;

        case 'Agents':
            $topmenu = 'modalagent';
            break;

        default:
            $topmenu = '';
            break;
    }
@endphp

<style type="text/css">
    body {
        position: relative;
    }

    .newlink {
        position: fixed;
        right: 0;
        transform: translateY(-50%);
        top: 50%;
    }

    @media only screen and (max-width: 720px) {
        .modal-body {
            max-height: 550px;
            overflow-y: scroll;
        }
    }
.feedback-float {
    position: fixed;
    right: 15px;
    top: 73%;
    transform: translateY(-50%);
    z-index: 1000;
    background-color: #74c52c;
    color: white;
    padding: 5px 8px;
    border-radius: 20px;
    text-decoration: none;
    font-weight: bold;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: sans-serif;
    animation: popBounce 1.9s ease-in-out infinite;
  }

  @keyframes popBounce {
    0%, 100% {
      transform: translateY(-50%) scale(1);
    }
    50% {
      transform: translateY(-50%) scale(1.2);
    }
  }

  .feedback-alert {
    position: fixed;
    right: 15px;
    top: 20%;
    transform: translateY(-50%);
    z-index: 1000;
    background-color: #74c52c;
    color: white;
    padding: 10px;
  }
</style>

@if (!empty($topmenu))
    <span class="newlink nesusersignup cursor" data-target="{{ $topmenu }}">
        <img src="{{ URL::asset('/img/signup.png') }}" style="height: 75px"></span>
@endif

<section id="modals">
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title text-center wow fadeIn visibility-inherit"><b>Choose Login Type </b></h2>
                </div>
                <div class="modal-body margin0 padding0">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 text-center wow visibility-inherit fadeInLeft">
                            <div class="service-box padding-top30 padding-bottom40">
                                <div class="service-box-icon">
                                    <a class="nesuserlogine cursor" data-target="modalseller"><img alt="Web Design"
                                            src="{{ URL::asset('front/img/svg/seller.svg') }}" width="150"></a>
                                </div>
                                <div class="service-box-info">
                                    <a class="nesuserlogine cursor" data-target="modalseller">
                                        <h3 class="padding-top25">Login as <br> Seller</h3>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 text-center wow visibility-inherit fadeInUp">
                            <div class="service-box padding-top30 padding-bottom40">
                                <div class="service-box-icon">
                                    <a class="nesuserlogine cursor" data-target="modalbuyer"><img alt="Email Marketing"
                                            src="{{ URL::asset('front/img/svg/buyer.svg') }}" width="150"></a>
                                </div>
                                <div class="service-box-info">
                                    <a class="nesuserlogine cursor" data-target="modalbuyer">
                                        <h3 class="padding-top25">Login as <br> Buyer</h3>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 text-center wow visibility-inherit fadeInRight">
                            <div class="service-box padding-top30 padding-bottom40">
                                <div class="service-box-icon">
                                    <a class="nesuserlogine cursor" data-target="modalagent"><img
                                            alt="Corportate Solutions" src="{{ URL::asset('front/img/svg/agent.svg') }}"
                                            width="150"></a>
                                </div>
                                <div class="service-box-info">
                                    <a class="nesuserlogine cursor" data-target="modalagent">
                                        <h3 class="padding-top25">Login as <br> Agent</h3>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /Login Modal -->
    <!-- Registration Modal -->
    <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="registrationModal"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body margin0 padding0">
                    <div id="" class="services">
                        <div class="pattern-overlay">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="padding-top40 text-center">
                                        <h2 class="light wow fadeIn visibility-inherit">Choose SignUp Type</h2>
                                        <h4 class="light wow fadeInRight visibility-inherit">
                                            Join as a Buyer, Seller or Agent to be a part of 92Agents
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 text-center wow visibility-inherit fadeInLeft">
                                    <div class="service-box padding-top30 padding-bottom40">
                                        <div class="service-box-icon">
                                            <a class="nesusersignup cursor" data-target="modalseller">
                                                <img alt="Seller"
                                                    src="{{ URL::asset('front/img/seller-services.jpg') }}"
                                                    style="object-fit: contain;border-radius:100%;padding:10px"
                                                    width="150" height="111">
                                            </a>
                                        </div>
                                        <div class="service-box-info">
                                            <a class="nesusersignup cursor" data-target="modalseller">
                                                <h3 class="padding-top25">Become a Seller</h3>
                                            </a>
                                            <p>
                                                Join as a seller to sell to sell your property at 1% commision
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 text-center wow visibility-inherit fadeInUp">
                                    <div class="service-box padding-top30 padding-bottom40">
                                        <div class="service-box-icon">
                                            <a class="nesusersignup cursor" data-target="modalbuyer"><img
                                                    alt="Email Marketing"
                                                    src="{{ URL::asset('front/img/151788_b44b2d05b935483693e0f6f9e1dc1160.jpg') }}"
                                                    width="150" height="111"
                                                    style="object-fit: contain;border-radius:100%;padding:10px"></a>
                                        </div>
                                        <div class="service-box-info">
                                            <a class="nesusersignup cursor" data-target="modalbuyer">
                                                <h3 class="padding-top25">Become a Buyer</h3>
                                            </a>
                                            <p>
                                                Join as a Buyer to get a house in less than a month
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 text-center wow visibility-inherit fadeInRight">
                                    <div class="service-box padding-top30 padding-bottom40">
                                        <div class="service-box-icon">
                                            <a class="nesusersignup cursor" data-target="modalagent"><img
                                                    alt="Corportate Solutions"
                                                    src="{{ URL::asset('front/img/house-keys-mortgage-loan-nki.jpg') }}"
                                                    width="150" height="111"
                                                    style="object-fit: contain;border-radius:100%;padding:10px"></a>
                                        </div>
                                        <div class="service-box-info">
                                            <a class="nesusersignup cursor" data-target="modalagent">
                                                <h3 class="padding-top25">Become a Agent</h3>
                                            </a>
                                            <p>
                                                Join as an agent to get more deals in your city
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Registration Modal -->
    <!-- model strat  -->
    <div class="modal fade" id="nesusersignup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center usertitle"><b>Buyer</b></h4>
                </div>
                <div class="modal-body margin0 padding0">
                    <!-- step 1 start -->
                    <div id="Step1">
                        <form method="POST" action="signup" class="" id="buyerForm">
                            @csrf

                            <div class="body-overlay hide">
                                <div><img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px"
                                        height="64px" />
                                </div>
                            </div>
                            <div class="margin0 row">
                                <div class="message"> </div>

                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <label class="" for="fname">First Name <span
                                            class="mandatory">*</span></label>
                                    <input type="text" maxlength="50" class="form-control fname emptyclass"
                                        id="fname" name="fname" placeholder="First Name" />
                                    <p class="error-text hide fname-error" id="fname-error"></p>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <label for="lname">Last Name <span class="mandatory">*</span></label>
                                    <input type="text" maxlength="50" maxlength="50"
                                        class="form-control lname emptyclass" id="lname" name="lname"
                                        placeholder="Last Name" />
                                    <p class="error-text hide lname-error" id="lname-error"></p>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label for="email">Email Address <span class="mandatory">*</span></label>
                                    <input type="text" maxlength="50" maxlength="50"
                                        class="form-control email emptyclass" id="email" name="email"
                                        placeholder="Email" />
                                    <p class="error-text hide email-error" id="email-error"></p>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <label for="password" maxlength="50">Password <span
                                            class="mandatory">*</span></label>
                                    <input type="password" class="form-control password emptyclass" id="password"
                                        name="password" placeholder="Password" />
                                    <span class="text-secondary" style="color: gray;font-size: 12px;">Must contain one
                                        uppercase, one lowercase , one digit and one special character ( allows !#$%^&*@
                                        )</span>
                                    <p class="error-text hide password-error" id="password-error"></p>

                                </div>
                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <label for="confirm_password" maxlength="50">Confirm Password <span
                                            class="mandatory">*</span></label>
                                    <input type="password" class="form-control confirm_password emptyclass"
                                        id="confirm_password" name="confirm_password"
                                        placeholder="Confirm Password" />
                                    <span class="text-secondary" style="color: gray;font-size: 12px;">Must contain one
                                        uppercase, one lowercase , one digit and one special character ( allows !#$%^&*@
                                        )</span>
                                    <p class="error-text hide confirm_password-error" id="confirm_password-error"></p>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <!-- Remember Field -->
                                    <div class="checkbox">
                                        <label class="checkbox">
                                            <input name="terms_and_conditions" class="" type="checkbox"
                                                value="1" />
                                            I Read and Accept the <a href="/terms" target="_blanck"
                                                class="color-green">Terms and Conditions</a>.
                                            <p>Already Signed Up? Click here <span
                                                    class="color-green cursor signinurl"></span> to login your account.
                                            </p>
                                        </label>
                                        <p class="error-text hide terms_and_conditions-error"
                                            id="terms_and_conditions-error"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="google-btn" id="google_signup_btn">
                                        <img src="https://img.icons8.com/color/48/000000/google-logo.png"
                                            alt="Google Logo">
                                        <span>Continue with Google</span>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="facebook-btn" id="facebook_signup_btn">
                                        <img src="https://img.icons8.com/color/48/000000/facebook-new.png"
                                            alt="Facebook Logo">
                                        <span>Continue with Facebook</span>
                                    </button>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" value="1" name="step">
                                <input type="hidden" class="users_role_id" name="agents_users_role_id"
                                    value="">
                                <button type="button" class="btn btn-default" data-dismiss="modal"
                                    aria-hidden="true">Cancel</button>
                                <button type="submit" class="btn btn-color submitbutton" name="signup"
                                    value="Sign_up">Next</button>
                            </div>

                        </form>
                    </div>
                    <!-- step 1 end -->

                    <!-- step 2 start -->
                    <div id="Step2">
                        <form method="POST" action="signup" class="" id="buyerFormStep2">
                            @csrf

                            <div class="body-overlay hide">
                                <div><img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px"
                                        height="64px" />
                                </div>
                            </div>
                            <div class="margin0 row">
                                <div class="message"> </div>

                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label class="" for="phone">Phone Number<span
                                            class="mandatory">*</span></label>
                                    <input type="text" maxlength="10" class="form-control phone emptyclass"
                                        name="phone" placeholder="Phone No." />
                                    <p class="error-text hide phone-error" id="phone-error"></p>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label for="address1">Address line 1 <span class="mandatory">*</span></label>
                                    <input type="text" maxlength="50" class="form-control address1 emptyclass"
                                        id="address1" name="address_line_1" placeholder="Address line 1" />
                                    <p class="error-text hide address_line_1-error" id="address_line_1-error"></p>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label for="address2">Address line 2 </label>
                                    <input type="text" maxlength="50" class="form-control address2 emptyclass"
                                        id="address2" name="address_line_2" placeholder="Address line 2" />
                                    <p class="error-text hide address_line_2-error" id="address_line_2-error"></p>
                                </div>

                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <label for="state">Select State <span class="mandatory">*</span></label>
                                    <select class="form-control state emptyclass" id="state" name="state"
                                        placeholder="Select State">
                                        <option value="">Select State</option>
                                        @if (!empty($state))
                                            @foreach ($state as $stated)
                                                <option value="{{ $stated->state_id }}">
                                                    {{ ucfirst($stated->state_name) }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="error-text hide state-error" id="state-error"></p>
                                </div>

                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <label for="city">Select City <span class="mandatory">*</span></label>



                                    <select class="form-control cityemptyclass" id="city" name="city"
                                        placeholder="Select City">
                                        <option value="">Select City</option>

                                    </select>

                                    <p class="error-text hide city-error" id="city-error"></p>
                                </div>


                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <label for="zip_code">Zip Code <span class="mandatory">*</span></label>
                                    <input type="number" class="form-control zip_code emptyclass" id="zip_code"
                                        name="zip_code" placeholder="ZIP Code" />
                                    <p class="error-text hide zip_code-error" id="zip_code-error"></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" value="2" name="step">
                                <input type="hidden" class="step2id" name="id" />
                                <input type="hidden" class="users_role_id" name="agents_users_role_id"
                                    value="">
                                <button type="button" class="btn btn-default" data-dismiss="modal"
                                    aria-hidden="true">Cancel</button>
                                <button type="submit" class="btn btn-color" name="signup"
                                    id="buyerFormStep2Submit" value="Sign_up">Next</button>
                            </div>

                        </form>
                    </div>
                    <!-- step 2 end -->

                    <!-- step 3 start -->
                    <div id="Step3">
                        <form method="POST" action="signup" class="" id="buyerFormStep3">
                            @csrf

                            <div class="body-overlay hide">
                                <div><img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px"
                                        height="64px" />
                                </div>
                            </div>
                            <div class="margin0 row">
                                <div class="message"> </div>
                                <div class="agentfield hide">
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label for="posttitle"> <span id="posttitlechange">Buy Post</span> <span
                                                class="mandatory">*</span></label>
                                        <input type="text" maxlength="50"
                                            class="form-control post posttitle emptyclass" id="posttitle"
                                            name="posttitle" placeholder="Post title" />
                                        <p class="error-text hide posttitle-error" id="posttitle-error"></p>
                                    </div>
                                </div>
                                <div class="bysellfield hide">
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="" for="licence_number"> License Number <span
                                                class="mandatory">*</span></label>
                                        <input type="text" maxlength="50"
                                            onkeypress="return IsAlphaNumeric(event);" ondrop="return false;"
                                            onpaste="return false;" class="form-control licence_number emptyclass"
                                            id="licence_number" name="licence_number" placeholder="Licence Number" />
                                        <p class="error-text hide licence_number-error" id="licence_number-error"></p>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="hidden" value="3" name="step">
                                <input type="hidden" class="step3id" name="id" />
                                <input type="hidden" class="users_role_id" name="agents_users_role_id"
                                    value="">
                                <button type="button" class="btn btn-default" data-dismiss="modal"
                                    aria-hidden="true">Cancel</button>
                                <button type="submit" class="btn btn-color" name="signup" value="Sign_up">Sign
                                    up</button>
                            </div>

                        </form>
                    </div>
                    <!-- step 3 end -->

                    <!-- step 4 start -->
                    <div id="Step4" class="hide">
                        <div class="modal-body margin0 row">
                            <div class="message"> </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"
                                aria-hidden="true">Close</button>
                        </div>
                    </div>
                    <!-- step 4 end -->
                </div>
            </div>
        </div>
    </div>
    <!-- End modal window -->

    <!-- model end -->
    <!-- model strat  -->
    <div class="modal fade" id="nesuserlogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center usertitle"><b>Buyer</b></h4>
                </div>

                <form method="POST" action="#" class="" id="logineuser">
                    @csrf

                    <div class="body-overlay hide">
                        <div><img src="{{ url('/assets/img/loder/loading.gif') }}" width="64px" height="64px" />
                        </div>
                    </div>
                    <div class="modal-body margin0 row">
                        <div class="message"> </div>

                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label for="useremail">Email Address <span class="mandatory">*</span></label>
                            <input type="useremail" class="form-control useremail emptyclass" id="useremail"
                                name="email" placeholder="Email Address" />
                            <p class="error-text hide user-email-error" id="user-email-error"></p>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label for="userpassword">Password <span class="mandatory">*</span></label>
                            <input type="password" class="form-control userpassword emptyclass" id="userpassword"
                                name="password" placeholder="Password" />
                            <p class="error-text hide user-password-error" id="user-password-error"></p>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                            <!-- mishrar -->
                            <p class="error-text hide user-g-recaptcha-response-error"
                                id="user-g-recaptcha-response-error">
                            </p>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <!-- Remember Field -->
                            <div class="checkbox">
                                <label class="checkbox">
                                    <input name="remember" class="" type="checkbox" />
                                    Remember Me.
                                </label>
                                <p class="error-text hide user-remember-error" id="user-remember-error"></p>
                            </div>
                            <div style="margin-bottom: 2px;">
                                <h4 style="margin-bottom: 1px;">Forgot password ?</h4>
                                No worries,
                                <a href="{{ url('/password/reset') }}"> click here </a>
                                to reset your password.
                            </div>
                            <div style="margin-bottom: 2px;">
                                Don't Have Account? Click here
                                <span class="loginsignupbutton color-green cursor"></span> to registration
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="google-btn" id="google_login_btn">
                                <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google Logo">
                                <span>Continue with Google</span>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="facebook-btn" id="facebook_login_btn">
                                <img src="https://img.icons8.com/color/48/000000/facebook-new.png"
                                    alt="Facebook Logo">
                                <span>Continue with Facebook</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="agents_users_role_id" id="agents_users_role_id"
                            name="agents_users_role_id" value="">
                        <button type="button" class="btn btn-default" data-dismiss="modal"
                            aria-hidden="true">Close</button>
                        <button type="submit" class="btn btn-color" name="signup" value="Sign_up"
                            id="gcap_login_btn">Login</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <!-- End modal window -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-slideout modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="display: flex;justify-content:space-between;align-items:center">
        <h5 style="width:90%" class="modal-title" id="feedbackModalLabel">Feedback</h5>
        <button type="button" onclick="$('#feedbackModal').modal('hide')" class="btn-close" data-bs-dismiss="modal"><b>X</b></button>
      </div>
      <form action="{{ route('feedback') }}" method="POST">
        @csrf
        <div class="modal-body">
            <input type="email" class="form-control" name="email" maxlength="50" placeholder="Your Email"><br>
          <textarea name="message" class="form-control" rows="4" required maxlength="1000" placeholder="Write your thoughts..."></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-sm">Send</button>
        </div>
      </form>
    </div>
  </div>
</div>
    <!-- model end -->

</section>
<!-- /Modal -->

<!-- Scroll To Top -->
<a href="#feedbackModal" onclick="$('#feedbackModal').modal('show')" data-bs-toggle="modal" class="feedback-float">
   <i class="fa fa-comment"></i> Feedback?
</a>
@if (session('success'))
    <div class="feedback-alert">
       {{ session('success') }} &nbsp;&nbsp;&nbsp;&nbsp;<span style="cursor:pointer" onclick="$('.feedback-alert').remove()"><b>X</b></span>
    </div>
@endif
<a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>
<footer id="footer">
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <section class="col-lg-4 col-md-4 col-xs-12 col-sm-4 footer-one wow fadeInUp">
                    <a href="{{ url('/') }}">
                        <img class="logo-color" src="{{ URL::asset('assets/img/logo2-default.png') }}"
                            alt="gallaxy" width="auto">
                    </a>
                    <p>
                        At 92 Agents, our team is committed to creating the number one online platform and rendering
                        impeccable services to both buyers, sellers, and agents. Making a difference in the real estate
                        industry.
                    </p>
                </section>

                <section class="col-lg-4 col-md-4 col-xs-12 col-sm-4 footer-two wow fadeInUp">
                    <h3 class="light">Links</h3>
                    <ul class="list-unstyled link-list">
                        <li><a href="{{ url('/') }}">Home</a></li>

                        <li><a href="{{ url('/aboutus') }}">About us</a></li>
                        <li><a href="{{ url('/contactus') }}">Contact us</a></li>
                        <li><a href="{{ url('/privacy') }}">Privacy</a></li>
                        <li><a href="{{ url('/terms') }}">Terms & Conditions</a></li>
                    </ul>

                </section>
                <section class="col-lg-4 col-md-4 col-xs-12 col-sm-4 footer-three wow fadeInUp">
                    <h3 class="light">Quick Contact</h3>
                    <ul class="contact-us">
                        <li>
                            <i class="fa fa-map-marker"></i>
                            <p>
                                Zippy Infotech inc30 N Gould st,<br />
                                Suite Rsheridn, WY, 82801 Sheridan
                            </p>
                        </li>
                        <li>
                            <i class="fa fa-phone"></i>
                            <p>(615) 538-8208</p>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <p><a href="mailto:Support@92agents.com">Support@92agents.com</a></p>
                        </li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
    <!-- /Footer Top -->
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
                    <p class="copyright">&copy; Copyright {{ date('Y') }} by <a
                            href="{{ url('/') }}">92agents.com</a>. All Rights
                        Reserved. </p>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 ">
                    <ul class="social social-icons-footer-bottom">
                        <li class="facebook"><a href="https://www.facebook.com/zippy.infotech.5" target="_blank"><i
                                    class="fa fa-facebook"></i></a></li>
                        <li class="twitter"><a href="https://twitter.com/InfotechZippy" target="_blank"><i
                                    class="fa fa-twitter"></i></a></li>
                        <li class="reddit"><a href="https://www.reddit.com/user/zippyits" target="_blank"><i
                                    class="fa fa-reddit"></i></a></li>
                        <li class="pinterest"><a href="https://in.pinterest.com/zippyits/" target="_blank"><i
                                    class="fa fa-pinterest"></i></a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /Footer Bottom -->
</footer>
<script>
    function changeURL(URL) {
        var win = window.open(URL, '_blank');
        win.focus();
    }
    var total = $('.carousel-item').length;
    var currentIndex = $('div.active').index() + 1;
    $('#slidetext').html(currentIndex + '/' + total);
    // This triggers after each slide change
    $('.carousel').on('slid.bs.carousel', function() {
        currentIndex = $('div.active').index() + 1;
        // Now display this wherever you want
        var text = currentIndex + '/' + total;
        $('#slidetext').html(text);
    });

    document.getElementById('google_signup_btn').addEventListener('click', function() {
        const roleId = document.querySelector('.users_role_id').value;
        const provider = 'google';
        window.location.href = `/auth/${provider}/${roleId}`;
    });
    document.getElementById('google_login_btn').addEventListener('click', function() {
        const roleId = document.querySelector('.agents_users_role_id').value;
        const provider = 'google';
        window.location.href = `/auth/${provider}/${roleId}`;
    });
    document.getElementById('facebook_signup_btn').addEventListener('click', function() {
        const roleId = document.querySelector('.users_role_id').value;
        const provider = 'facebook';
        window.location.href = `/auth/${provider}/${roleId}`;
    });
    document.getElementById('facebook_login_btn').addEventListener('click', function() {
        const roleId = document.querySelector('.agents_users_role_id').value;
        const provider = 'facebook';
        window.location.href = `/auth/${provider}/${roleId}`;
    });
</script>
