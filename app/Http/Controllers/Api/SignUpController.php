<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Userdetails;
use App\Models\Post;
use App\Models\State;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Helper\StripHelper;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Twilio\Rest\Client;

class SignUpController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /* For send main for new user */
    public function NewUserMailSend($data)
    {
        $emaildata = [];
        $emaildata['email'] = $data['email'];
        $emaildata['rolename'] = $data['rolename'];
        $emaildata['url'] = $data['url'];
        $emaildata['name'] = $data['name'];

        Mail::send('email.activate', $emaildata, function ($message) use ($emaildata) {
            $message->to($emaildata['email'], $emaildata['name'])
                ->subject('Activate your 92Agents {$emaildata[\'rolename\']} Account.');
            $message->from('92agent@92agents.com', '92Agents');
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /*signup step 1*/
    public function signup(Request $request)
    {
        // $postStep = $request->step;
        $roleId = $request->agents_users_role_id;

        $validator = Validator::make($request->all(), [
            'agents_users_role_id' => ['required', Rule::in(['1', '2', '3', '4'])],
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:agents_users',
            'terms_and_conditions' => 'required',
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!#$%^&*@]).*$/',
            'confirm_password' => 'required|same:password|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!#$%^&*@]).*$/',
        ], [
            'terms_and_conditions.required' => 'Acceptance of Terms and Conditions is required',
            'fname.required' => 'The First Name is required',
            'lname.required' => 'The Last Name is required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors(), 'status' => false], 400);
        }
        
        $user = new User;
        $userExits = $user->getDetailsByEmailOrId(['email' => $request->email]);

        if (!empty($userExits)) {

            if ($userExits->agents_users_role_id == $roleId && $userExits->step == 3) {
                return response()->json(['msg' => ['error' => 'Email already registered. Please use login.'], 'status' => false], 400);
            }
            
            if ($userExits->agents_users_role_id != $roleId && $userExits->agents_users_role_id == 4) {
                return response()->json(['msg' => ['error' => 'Email already registered as an agent.'], 'sta tus' => false], 400);
            }

            if (($userExits->agents_users_role_id == 2 || $userExits->agents_users_role_id == 3) && $userExits->step == 3) {
                return response()->json(['msg' => ['error' => 'Email already registered. Please try with another email, as a seller or buyer.'], 'status' => false], 400);
            }

            return response()->json(['userDetails' => $userExits, 'step' => '1', 'status' => false], 400);
        }

        $activation_link = uniqid();
        $user = new User;
        $user->agents_users_role_id = $roleId;
        $user->step = 1;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->activation_link = $activation_link;
        $user->api_token = Hash::make((string) time());
        $user->save();

        $details = [];
        $details['details_id'] = $user->id;
        $details['name'] = "{$request->fname} {$request->lname}";
        $details['fname'] = $request->fname;
        $details['lname'] = $request->lname;

        DB::table('agents_users_details')->insertGetId($details);

        $emaildata = [];
        $emaildata['email'] = $request->email;
        $emaildata['rolename'] = env("user_role_{$roleId}");
        $emaildata['url'] = url('/').'/login?usertype='.$emaildata['rolename'].'&activation_link='.$activation_link;
        $emaildata['name'] = ucwords($details['name']);

        $userDetails = $user->getDetailsByEmailOrId(['id' => $user->id]);
        return response()->json(['userDetails' => $userDetails, 'step' => '1', 'emaildata' => $emaildata, 'status' => true], 200);
    }

    public function signup2(Request $request)
    {
        // $postStep = $request->step;
        $roleId = $request->agents_users_role_id;
        
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'phone' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'agents_users_role_id' => ['required', Rule::in(['1', '2', '3', '4'])],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => '101', 'error' => $validator->errors()], 400);
        }

        // $input_arr['address_line_2'] = $request->address_line_2;
        
        if(empty($request->id) || !User::find($request->id) || !Userdetails::find($request->id)){
            return response()->json(['status' => '101', 'error' => 'User not found. Please refresh the page and try again.'], 404);
        }

        $userdetails = Userdetails::find($request->id);
        $userdetails->phone = $request->phone;
        $userdetails->address = $request->address_line_1;
        $userdetails->address2 = $request->address_line_2 != '' ? $request->address_line_2 : '';
        $userdetails->state_id = $request->state;
        $userdetails->city_id = $request->city;
        $userdetails->zip_code = $request->zip_code;
        $userdetails->save();

        $user = User::find($request->id);
        $user->step = 2;
        $user->agents_users_role_id = $roleId;
        $user->save();

        $userDetailssend = $user->getDetailsByEmailOrId(['id' => $userdetails->details_id]);

        if (!in_array($roleId, [2, 3])) {
            return response()->json(['status' => '100', 'userDetails' => $userDetailssend, 'step' => '2']);
        }
        
        $post = new Post;
        $postdetails = $post->getDetailsByUserroleandId($request->id, $roleId);

        return response()->json(['status' => '100', 'userDetails' => $userDetailssend, 'postdetails' => $postdetails, 'step' => '2']);
    }

    /*signup step 3*/
    public function signup3(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'agents_users_role_id' => ['required', Rule::in(['2', '3', '4'])],
        ]);

        $roleId = $request->agents_users_role_id;
        $user_id = $request->id;

        if (empty($user_id) || !User::find($user_id) || !Userdetails::find($user_id)) {
			return response()->json(['msg' => ['error' => 'User not found. Please refresh the page and try again.']], 404);
		}

		/*for buyer and sellere */
		if (in_array($roleId, [2, 3])) {
			$validator = Validator::make($request->all(), [
				'post_title' => 'required'
			], [
				'post_title.required' => 'Post Title field is required.',
			]);

			if ($validator->fails()) {
				return response()->json(['error' => $validator->errors()], 400);
			}

			$post = new Post;
			$postdetails = $post->getDetailsByUserroleandId($user_id, $roleId);

			if (empty($postdetails)) {
				$postdetailsnew = [];
				$postdetailsnew['agents_user_id'] = $user_id;
				$postdetailsnew['agents_users_role_id'] = $roleId;
				$postdetailsnew['posttitle'] = $request->post_title;
				$postdetailsnew['updated_at'] = Carbon::now()->toDateTimeString();
				$postdetailsnew['created_at'] = Carbon::now()->toDateTimeString();
				DB::table('agents_posts')->insertGetId($postdetailsnew);
			} else {
				$postdetails = Post::find($postdetails->post_id);
				$postdetails->agents_user_id = $user_id;
				$postdetails->agents_users_role_id = $roleId;
				$postdetails->posttitle = $request->post_title;
				$postdetails->updated_at = Carbon::now()->toDateTimeString();
				$postdetails->created_at = Carbon::now()->toDateTimeString();
				$postdetails->save();
			}

			$user = User::find($user_id);
			$user->step = 3;
			$user->save();
			$userDetailssend = $user->getDetailsByEmailOrId(['id' => $user_id]);
		}
		/*for agents */
		else if ($roleId == 4) {

			$validator = Validator::make($request->all(), ['licence_number' => 'required'], ['licence_number.required' => 'Licence Number field is required.']);

			if ($validator->fails()) {
				return response()->json(['error' => $validator->errors()], 400);
			}
			
			$userdetails = Userdetails::find($user_id);
			$userdetails->licence_number = $request->licence_number;
			$userdetails->save();

			$user = User::find($user_id);
			$user->step = 3;
			$user->save();

			$userDetailssend = $user->getDetailsByEmailOrId(['id' => $userdetails->details_id]);
		}

		return response()->json(['userDetails' => $userDetailssend, 'step' => '3']);
    }

    /*signup step 3*/
    public function signup3_jk_bk(Request $request)
    {
        // $postStep = $request->step;
        $roleId = $request->agents_users_role_id;
        $user_id = $request->id;
        $verifications['verification_code'] = $request->verification_code;

        if (empty($user_id) || !User::find($user_id) || !Userdetails::find($user_id)) {
			return response()->json(['msg' => ['error' => 'User not found. Please refresh the page and try again.']], 404);
		}

        /*for buyer and seller */
        if (in_array($roleId, [1, 2, 3])) {

            $rules = [];
            $rules['verification_code'] = 'required|numeric';

            $validator = Validator::make($request->all(), ['verification_code' => 'required|numeric']);

            if ($validator->fails()) {
                return response()->json(['status' => '101', 'error' => $validator->errors()]);
            }
            
            $userForphone = Userdetails::find($user_id);
            $userphn['pphn'] = $userForphone->phone;

            // $token = getenv("TWILIO_AUTH_TOKEN");
            // $twilio_sid = getenv("TWILIO_SID");
            // $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");

            // $twilio = new Client($twilio_sid, $token);
            // $verification = $twilio->verify->v2->services($twilio_verify_sid)
            //     ->verificationChecks
            //     ['code' => $data['verification_code']
            //     ->create(['code' => $verifications['verification_code'], 'to' => $userphn['pphn']]);

            // if ($verification->valid) {
                // return response()->json(['status' => '101', 'error' => 'otp error.'], 400);
            // }
            
            $user = tap(User::where('id', $user_id))->update(['status' => '1']);
            return response()->json(['status' => '100', 'userDetails' => $userForphone, 'step' => '3']);

        }
        /*for agents */
        else {//if ($roleId == 4) {

            // $rules['licence_number'] = 'required';
            $rules['agents_users_role_id'] = 'required';
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            } else {

                $userdetails = Userdetails::find($user_id);
                // $userdetails->licence_number = $request->licence_number;
                $userdetails->save();

                $user = User::find($user_id);
                $user->step = 3;
                $user->save();

                $userDetailssend = $user->getDetailsByEmailOrId(['id' => $userdetails->details_id]);
                return response()->json(['status' => '100', 'userDetails' => $userDetailssend, 'step' => '3']);
            }
        }
    }
}