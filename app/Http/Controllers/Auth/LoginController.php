<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /* For login process */
    public function login(Request $request)
    {
        $validator = Validator::make([
            'password' => $request->password,
            'email' => $request->email,
            'agents_users_role_id' => $request->agents_users_role_id
        ], [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;
        $role_id = $request->agents_users_role_id;
        
        $fcm_token = $request->filled('fcm_token') ? $request->fcm_token : NULL;
        $device_type = $request->filled('device_type') ? $request->device_type : NULL;

        if (!Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            return redirect()->back()
            ->withErrors(["check" => "Email and password combination is incorrect!"])
            ->withInput($request->only('email', 'remember'));
        }

        $user = Auth::user();

        if ($user->status == 0) {
            return Redirect::back()->withErrors(["check" => "Your account is not active."])->withInput();
        }
        if ($user->agent_status == 3) {
            return response()->json(["check" => "Your account is permanantly suspended please contact admin."]);
        }
        
        if ($role_id != $user->agents_users_role_id) {
            $db_types = [
                '1' => 'Administrator',
                '2' => 'Buyer',
                '3' => 'Seller',
                '4' => 'Agent',
            ];

            return Redirect::back()->withErrors(["check" => "Email not found in the {$db_types[$role_id]} database!"])->withInput();
        }

        $user->agents_users_role_id = $role_id;
        $user->login_status = 'Online';
        $user->updated_at = Carbon::now()->toDateTimeString();
        $user->fcm_token = $fcm_token;
        $user->device_type = $device_type;
        $user->save();

        return redirect('dashboard');
    }

    /* login api check credentials */
    public function login_api(Request $request)
    {
        $validator = Validator::make([
            'password' => $request->password,
            'email' => $request->email,
            'agents_users_role_id' => $request->agents_users_role_id,
            //    'g-recaptcha-response' => $request->input('g-recaptcha-response')
        ], [
            'email' => 'required|email',
            'password' => 'required|min:6',
            //    'g-recaptcha-response' => 'required|captcha'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        
        
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;
        $role_id = $request->agents_users_role_id;
        
        $fcm_token = $request->filled('fcm_token') ? $request->fcm_token : NULL;
        $device_type = $request->filled('device_type') ? $request->device_type : NULL;

        $attempting_user = User::where('email', $email)->first();

        if(!$attempting_user) {
            return response()->json(["check" => "Either email or password is incorrect!"]);
        }

        if ($attempting_user->status == 0) {
            return response()->json(["check" => "Your account is not active."]);
        }

        if ($attempting_user->agent_status == 3) {
            return response()->json(["check" => "Your account is permanantly suspended please contact admin."]);
        }

        
        if ($role_id != $attempting_user->agents_users_role_id) {
            if($attempting_user->agents_users_role_id == 1) {
                // JkWorkz
                return response()->json(["check" => "System Admin cannot login to the web!"]);
            }

            $db_types = [
                '1' => 'Administrator',
                '2' => 'Buyer',
                '3' => 'Seller',
                '4' => 'Agent',
            ];

            return response()->json(["check" => "Email not found in the {$db_types[$role_id]} database!"]);
        }

        if (!Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            return response()->json(["check" => "Either email or password is incorrect!"]);
        }

        $user = Auth::user();

        $user->agents_users_role_id = $role_id;
        $user->login_status = 'Online';
        $user->updated_at = Carbon::now()->toDateTimeString();
        $user->fcm_token = $fcm_token;
        $user->device_type = $device_type;
        $user->save();

        return response()->json(["success" => true]);
    }


    /* For logout or session destroy */
    public function logout()
    {
        $user = AuthUser();
        $user->login_status = 'Offline';
        $user->updated_at = Carbon::now()->toDateTimeString();
        $user->save();

        Auth::logout();
        Session::flush();

        return Redirect::to('/');
    }
}