<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Userdetails;
use App\Models\Post;
use App\Models\State;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index($stype = null)
    {
        $user = new User;
        $view = [
            'stype' => $stype,
            'agents' => $user->getforeUsersByAnyonly(0, [
                    'agents_users.agents_users_role_id' => '4',
                    'agents_users.is_deleted' => '0',
                    'agents_users.status' => '1'
                ]
            )
        ];

        return view('front.publicPage.index', $view);
    }

    public function blogs()
    {
        $blogs = DB::table('agents_blog as blog')
            ->join('agents_category as cat', 'blog.cat_id', '=', 'cat.id')
            ->join('agents_users as role', 'blog.added_by', '=', 'role.id')
            ->join('agents_users_roles as userole', 'role.agents_users_role_id', '=', 'userole.role_id')
            ->join('agents_users_details as user', 'role.id', '=', 'user.details_id')
            ->select(
                'blog.id',
                'blog.title',
                'blog.description',
                'blog.created_date',
                'blog.view',
                'cat.cat_name',
                'user.name',
                'userole.role_name'
            )
            ->orderBy('blog.id', 'DESC')
            ->skip(0)
            ->take(5)
            ->get();

        $category = DB::table('agents_category')->get();
        return view('front.publicPage.blogs', ['blogs' => $blogs, 'category' => $category]);
    }
    /* For redirect terms & condition view */
    public function terms(Request $request)
    {
        return view('front.publicPage.terms');
    }

    /* For redirect newTerms view */
    public function newTerms(Request $request)
    {
        return view('front.publicPage.new-terms');
    }

    /* For redirect bestShoots view */
    public function bestShoots(Request $request)
    {
        return view('front.publicPage.bestShoots');
    }

    /* For redirect incredible content view */
    public function incredibleContent(Request $request)
    {
        return view('front.publicPage.incredibleContent');
    }

    /* For redirect privacy view */
    public function privacy(Request $request)
    {
        return view('front.publicPage.privacy');
    }

    /* For redirect about us view */
    public function aboutus(Request $request)
    {
        return view('front.publicPage.about');
    }

    /* For redirect buyers view */
    public function buyers(Request $request)
    {
        return view('front.publicPage.buyers');
    }

    /* For redirect sellers view */
    public function sellers(Request $request)
    {
        return view('front.publicPage.sellers');
    }

    /* For redirect agents  view */
    public function agent(Request $request)
    {
        return view('front.publicPage.agents');
    }

    /* For redirect contact view */
    public function contact(Request $request)
    {
        return view('front.publicPage.contact');
    }

    public function feedback(Request $request)
    {
        $feedback = DB::table('feedbacks')->insert([
            'email' => $request->email,
            'message' => $request->message,
        ]);
        return redirect()->back()->with('success','Feedback Submitted Successfully.');
    }

    /* For send contact */
    public function contactSend(Request $request)
    {
        $input_arr = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'contactNo' => $request->contactNo,
            'countrycode' => $request->countrycode,

        ];
        $msg = "Dear ,{$request->name}<br/>Your query has been successfully submitted. Our representative will contact you shortly.<br />Thanks for your interest.<br /><br /><br />Regards<br />92Agents.com";
        $acknowledgeMsgData = [
            'name' => 'Admin',
            'email' => 'Support@92agents.com',
            'message' => $msg,
            'receiver' => $request->email
        ];
        $input_error_arr = [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'contactNo' => 'required|min:10|numeric',
            'countrycode' => 'required',
        ];

        $validator = Validator::make($input_arr, $input_error_arr);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            // $input_arr['contactNo']=$request->contactNo;
            $input_arr['msg'] = $request->message;
            /*Mail::send('email.contact', $input_arr, function($message) use ($input_arr) {
                $message->to($input_arr['email'], $input_arr['name'])
                ->subject('Contact us your 92Agents ');
                $message->from('92agent@92agents.com','92Agents');
            });*/
            Mail::send('email.contact', $input_arr, function ($message) use ($input_arr) {
                $message->to('92agent@92agents.com', '92Agents')
                    ->subject('Contact us your 92Agents');
                $message->from($input_arr['email'], $input_arr['name']);
            });
            $acknowledgeMsgData['msg'] = $acknowledgeMsgData['message'];
            Mail::send('email.acknowledge', $acknowledgeMsgData, function ($message) use ($acknowledgeMsgData) {
                $message->to($acknowledgeMsgData['receiver'], '92Agents')
                    ->subject('Thanks to contact 92Agents');
                // dd($message);
                $message->from($acknowledgeMsgData['email'], $acknowledgeMsgData['name']);
            });
            return Redirect::back()->with('success', '<h4><span class="glyphicon glyphicon-ok"></span> Thank you!</h4>Your message has been sent successfully. We will contact you very soon!');
        }
    }

    /* For login process */
    public function login_email_verify(Request $request)
    {
        $view = [
            'usertype' => $request->usertype,
        ];

        if (!$request->has('activation_link')) {
            return view('front.publicPage.login', $view);
        }

        $user = User::where('activation_link', $request->activation_link)->first();

        if (!$user) {
            $view['activation_link'] = [
                'class' => 'danger',
                'msg' => 'Invalid activation link.',
            ];
        }

        $user->update([
            'activation_link' => null,
            'status' => '1',
            'updated_at' => Carbon::now(),
        ]);

        $view['activation_link'] = [
            'class' => 'success',
            'msg' => 'Your account has been activated successfully. You can now login',
        ];

        $view['type'] = env("user_role_{$user->agents_users_role_id}");

        return view('front.publicPage.login', $view);
    }

    /* For reset view redirect */
    public function reset(Request $request)
    {
        return view('front.publicPage.reset');
    }

    /* For check mail process */
    public function checkemail(Request $request)
    {
        $roleId = $request->agents_users_role_id;
        $email = $request->email;
        $rules = [
            'email' => 'required|email',
        ];
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {
            $user = new User;
            $userExits = $user->getDetailsByEmailOrId(['email' => $email]);
            if (!empty($userExits)) {

                if ($userExits->agents_users_role_id == $roleId && $userExits->step == 3) {

                    return response()->json(['error' => ['Email already exist in our records please use login button.']]);
                } else {
                    if ($userExits->agents_users_role_id != $roleId && $userExits->agents_users_role_id == 4) {

                        return response()->json(['error' => ['Email already exist in our records as an agent.']]);
                    }
                    if (($userExits->agents_users_role_id == 2 || $userExits->agents_users_role_id == 3) && $userExits->step == 3) {

                        return response()->json(['error' => ['Email already exist .please try with another email in our records as a seller or buyer.']]);
                    }

                    return response()->json(['userDetails' => $userExits, 'step' => '1']);
                }
            }
        }
    }

    /* For send mail new user */
    public function NewUserMailSend(Request $request)
    {
        $emaildata = [];
        $emaildata['email'] = $request->email;
        $emaildata['rolename'] = $request->rolename;
        $emaildata['url'] = $request->url;
        $emaildata['name'] = $request->name;
        Mail::send('email.activate', $emaildata, function ($message) use ($emaildata) {
            $message->to($emaildata['email'], $emaildata['name'])
                ->subject('Activate your 92Agents {$emaildata[\'rolename\']} Account.');
        });
        if (Mail::failures()) {
            // return response showing failed emails
            return response()->json(['success' => 'fail']);
        } else {
            return response()->json(['success' => 'send']);
        }
    }

    /*signup step 1*/
    public function signup(Request $request)
    {
        // $step = $request->step;
        $roleId = $request->agents_users_role_id;

        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|min:3|max:30',
            'lname' => 'required|string|min:3|max:30',
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
            return response()->json(['error' => $validator->errors()]);
        }

        $user = User::where('email', $request->email)->first();
        // $userExits = $user->getDetailsByEmailOrId(['email' => $request->email]);

        if ($user) {
            if ($user->agents_users_role_id == $roleId && $user->step == 3) {
                return response()->json(['msg' => ['error' => 'Email already exist in our records please use login button.']]);
            } elseif ($user->agents_users_role_id != $roleId && $user->agents_users_role_id == 4) {
                return response()->json(['msg' => ['error' => 'Email already exist in our records as an agent.']]);
            } elseif (($user->agents_users_role_id == 2 || $user->agents_users_role_id == 3) && $user->step == 3) {
                return response()->json(['msg' => ['error' => 'Email already exist. Please try with another email in our records as a seller or buyer.']]);
            }

            return response()->json(['userDetails' => $user, 'step' => '1']);
        } else {
            $activation_link = uniqid();
            $user = new User;
            $user->agents_users_role_id = $roleId;
            $user->step = 1;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->activation_link = $activation_link;
            $user->api_token = Hash::make((string) time());
            $user->save();

            $details = [
                'details_id' => $user->id,
                'name' => "{$request->fname}" . ($request->lname !== '' ? " {$request->lname}" : ''),
                'fname' => $request->fname,
                'lname' => $request->lname,
            ];

            DB::table('agents_users_details')->insertGetId($details);

            return response()->json([
                'userDetails' => $user->getDetailsByEmailOrId(['id' => $user->id]),
                'step' => '1',
                'emaildata' => [
                    'email' => $request->email,
                    'rolename' => env("user_role_{$roleId}"),
                    'url' => url('/') . "/login?usertype=" . env("user_role_{$roleId}") . "&activation_link={$activation_link}",
                    'name' => ucwords($details['name']),
                ]
            ]);
        }
    }

    /*signup step 2*/
    public function signup2(Request $request)
    {
        $postStep = $request->step;
        $roleId = $request->agents_users_role_id;

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'phone' => 'required',
            'address_line_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            // 'agents_users_role_id' => ['required', Rule::in(['1', '2', '3', '4'])],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        // $input_arr['address_line_2'] = $request->address_line_2;

        if (!empty($request->id) && User::find($request->id) && Userdetails::find($request->id)) {

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

            $user = User::find($request->id);
            $user->step = $postStep;
            $user->save();

            $userDetailssend = $user->getDetailsByEmailOrId(['id' => $userdetails->details_id]);

            if ($roleId == 3 || $roleId == 2) {
                $post = new Post;
                $postdetails = $post->getDetailsByUserroleandId($request->id, $roleId);

                return response()->json(['userDetails' => $userDetailssend, 'postdetails' => $postdetails, 'step' => '2']);
            } else {

                return response()->json(['userDetails' => $userDetailssend, 'step' => '2']);
            }
        } else {

            return response()->json(['msg' => ['error' => 'User not found. Please refresh the page and try again.']]);
        }
    }

    /*signup step 3*/
    public function signup3(Request $request)
    {
        $roleId = $request->agents_users_role_id;
        $user_id = $request->id;

        if (empty($user_id) || !User::find($user_id) || !Userdetails::find($user_id)) {
            return response()->json(['msg' => ['error' => 'User not found. Please refresh the page and try again.']], 404);
        }

        /*for buyer and sellere */
        if (in_array($roleId, [2, 3])) {
            $validator = Validator::make($request->all(), [
                'posttitle' => 'required'
            ], [
                'posttitle.required' => 'Post Title field is required.',
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
                $postdetailsnew['posttitle'] = $request->posttitle;
                $postdetailsnew['updated_at'] = Carbon::now()->toDateTimeString();
                $postdetailsnew['created_at'] = Carbon::now()->toDateTimeString();
                DB::table('agents_posts')->insertGetId($postdetailsnew);
            } else {
                $postdetails = Post::find($postdetails->post_id);
                $postdetails->agents_user_id = $user_id;
                $postdetails->agents_users_role_id = $roleId;
                $postdetails->posttitle = $request->posttitle;
                $postdetails->updated_at = Carbon::now()->toDateTimeString();
                $postdetails->created_at = Carbon::now()->toDateTimeString();
                $postdetails->save();
            }

            $user = User::find($user_id);
            $user->step = 3;
            $user->save();
            $userDetailssend = $user->getDetailsByEmailOrId(['id' => $user_id]);
        }
        /*for agents */ else if ($roleId == 4) {

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


    public function singleblogs($id, $title)
    {
        $view = DB::table('agents_blog')->whereRaw("id = {$id}")->increment('view', 1);
        $detail = DB::table('agents_blog as blog')
            ->join('agents_category as cat', 'blog.cat_id', '=', 'cat.id')
            ->join('agents_users as role', 'blog.added_by', '=', 'role.id')
            ->join('agents_users_roles as userole', 'role.agents_users_role_id', '=', 'userole.role_id')
            ->join('agents_users_details as user', 'role.id', '=', 'user.details_id')
            ->select(
                'blog.id',
                'blog.title',
                'blog.description',
                'blog.created_date',
                'blog.view',
                'cat.cat_name',
                'user.details_id',
                'user.name',
                'userole.role_name'
            )
            ->whereRaw("blog.id = {$id}")
            ->first();

        $category = DB::table('agents_category')->get();
        $comment = DB::table('agents_blog_comment')->whereRaw("blog_id='{$id}'")->get();

        $likeData = DB::table('blog_likes')->where('blog_id', $id)->first();
        $likeCount = 0;
        $dislikeCount = 0;
        if ($likeData) {
            if (!empty($likeData->likes_by)) {
                $likeCount = count(explode(',', $likeData->likes_by));
            }
            if (!empty($likeData->dislikes_by)) {
                $dislikeCount = count(explode(',', $likeData->dislikes_by));
            }
        }
        return view('front.publicPage.singleblog', ['title' => $title, 'id' => $id, 'detail' => $detail, 'category' => $category, 'comment' => $comment, 'likeCount' => $likeCount, 'dislikeCount' => $dislikeCount]);
    }
    public function categoryblogs($id, $title)
    {
        // $view = DB::table('agents_blog')->whereRaw('id = '.$id)->increment('view', 1);
        $detail = DB::table('agents_blog as blog')
            ->join('agents_category as cat', 'blog.cat_id', '=', 'cat.id')
            ->join('agents_users as role', 'blog.added_by', '=', 'role.id')
            ->join('agents_users_roles as userole', 'role.agents_users_role_id', '=', 'userole.role_id')
            ->join('agents_users_details as user', 'role.id', '=', 'user.details_id')
            ->select(
                'blog.id',
                'blog.title',
                'blog.description',
                'blog.created_date',
                'blog.view',
                'cat.cat_name',
                'user.name',
                'userole.role_name'
            )
            ->whereRaw("cat.id = {$id}")
            ->get();

        $category = DB::table('agents_category')->get();
        return view('front.publicPage.catergory_blogs', ['title' => $title, 'id' => $id, 'blogs' => $detail, 'category' => $category]);
    }
    public function savecomment(Request $request)
    {
        $data = $request->all();

        $rules = [
            'comment' => 'required'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $insert_arr = [
            'blog_id' => $data['blog_id'],
            'comment_name' => $data['comment_name'],
            'email' => $data['email'],
            'comment' => $data['comment']
        ];


        $res = DB::table('agents_blog_comment')->insert($insert_arr);
        if ($res == 1) {
            $data['ctime'] = date('d-m-y h:i a');
            $data['success'] = 'ok';
            return json_encode($data);
        } else {
            $data['success'] = 'err';
            return json_encode($data);
        }
    }

    public function showadvertise()
    {
        $packages = DB::table('agents_package')->get();
        return view('front.publicPage.advertise', ['packages' => $packages]);
    }

    public function redirectToProvider($provider,$roleId)
    {
        session(['social_role_id' => $roleId]);
        $callbackUrl = url("/auth/{$provider}/{$roleId}/callback");

        return Socialite::driver($provider)
            ->redirectUrl($callbackUrl)
            ->redirect();
    }

    public function signupWithProvider($provider, $roleId)
{
    $socialUser = Socialite::driver($provider)
        ->redirectUrl(url("/auth/{$provider}/{$roleId}/callback"))
        ->user();

    // Get social ID and email
    $socialId = $socialUser->getId();
    $email = $socialUser->getEmail();
    
    // Determine unique field
    if ($provider === 'facebook') {
        // Try to find user by facebook_id
        $existingUser = User::where('facebook_id', $socialId)->first();
    } else {
        // For Google or other providers, use email
        $existingUser = User::where('email', $email)->first();
    }

    // Check for existing user
    if ($existingUser) {
        if ($existingUser->agents_users_role_id != $roleId) {
            return response()->json([
                'msg' => ['error' => 'Account already registered under a different role.']
            ]);
        }

        Auth::login($existingUser);
        return redirect("/dashboard");
    }

    // No existing user: register new one
    $user = new User;
    $user->agents_users_role_id = $roleId;
    $user->step = '1';
    $user->status = '1';
    $user->email = $email ?? null;
    $user->facebook_id = $provider === 'facebook' ? $socialId : null;
    $user->password = null;
    $user->activation_link = uniqid();
    $user->api_token = Hash::make((string) time());
    $user->save();

    // Extract name parts
    $fullName = $socialUser->getName() ?? '';
    $fname = explode(' ', $fullName)[0] ?? '';
    $lname = explode(' ', $fullName)[1] ?? '';

    DB::table('agents_users_details')->insert([
        'details_id' => $user->id,
        'name' => $fullName,
        'fname' => $fname,
        'lname' => $lname,
    ]);

    Auth::login($user);
    return redirect("/dashboard");
}
    
}