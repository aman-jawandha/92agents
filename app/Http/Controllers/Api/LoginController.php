<?php

namespace App\Http\Controllers\Api;

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
use App\Models\Userdetails;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Helper\Resp;


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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'agents_users_role_id' => 'required|exists:agents_users_roles,role_id'
        ]);

		if ($validator->fails()) {
			return Resp::InvalidRequest(validator: $validator);
		}

        $credentials = $request->only('email', 'password');


        if (!Auth::attempt($credentials)) {
            return Resp::BadApi(message: 'Invalid credentials.', rc: 401);
        }

        $user = AuthUser();

        if ($user->status == 0) {
            return Resp::BadApi(message: 'Your account is not active.', rc: 401);
        }

        $user->agents_users_role_id = $request->agents_users_role_id;
        $user->login_status = 'Online';
        $user->updated_at = now(); // Simplified Carbon usage
        $user->save();

        $token = $user->createToken('access_token')->plainTextToken;
        $tokenExpiry = now()->addMinutes(config('sanctum.expiration'));

        $user = array_merge($user->toArray(), $user->details->toArray());
        unset($user['details']);


        // $user = (array) AuthUser();
        // $userDetails = Userdetails::find($user['id'])->toArray();  // Assuming Userdetails model exists

        // $user = array_merge($user, $userDetails);

		return Resp::Api(
			data: $user,
			misc: [
                'token_type' => 'Bearer',
                'auth_token' => $token,
                'expires_at' => $tokenExpiry,
            ],
			message: Resp::MESSAGE_FETCHED,
			code: Resp::OK,
		);
    }

    public function login_check(Request $request)
    {
        if (AuthCheck()) {
            $user = Auth::guard('api')->user(); // Get authenticated user details

            return response()->json([
                'message' => 'User is authenticated',
                'user' => AuthUser(),
            ], 200);
        } else {
            return response()->json([
                'message' => 'User is not authenticated',
            ], 401);
        }
    }

    /* For logout or session destroy */
    public function logout()
    {
        $userupdate = User::find(Auth::user()->id);
        $userupdate->login_status = 'Offline';
        $userupdate->updated_at = Carbon::now()->toDateTimeString();
        $userupdate->save();
        Auth::logout();
        Session::flush();
        return Redirect::to('/');
    }
}