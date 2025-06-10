<?php

namespace App\Http\Controllers\Administrator;

use App\Events\eventTrigger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Userdetails;
use App\Models\Post;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    function __construct()
    {
    }

    /* For get users info for show dashboard view */
    public function index(Request $request)
    {
        if (!$user = AuthUser()) {
            return redirect('/login');
        }

        // return $user;
        
        $post = new Post();

        $view = [
            'user' => $user,
            'userdetails' => Userdetails::find($user->id),
            'user_type' => env('user_role_' . $user->agents_users_role_id),
            'securty_questio' => DB::table('agents_securty_question')->where('is_deleted', '0')->get(),
            'blogs' => DB::table('agents_blog')->select('*')->where('status', '0')->get(),
            'agentStatus' => DB::table('agents_users')->where('id', $user->id)->get(),
            'pending_post_count' => ($post->get_pending_closed_count($user->id)) ? $post->get_pending_closed_count($user->id) : 0
        ];
        
        return match ($user->agents_users_role_id) {
            '1' => redirect('/agentadmin/dashboard'),
            '2', '3' => view('dashboard.user.buyers.dashboard', $view),
            '4' => view('dashboard.user.agents.dashboard', $view),
            default => redirect('/'),
        };
    }

    /* For check agent status */
    public function agentStatus(Request $request)
    {

        if (Auth::user()) {
            $view = array();
            $view['user'] = $user = Auth::user();
            $view['userdetails'] = $userdetails = Userdetails::find($user->id);
            $view['user_type'] = env('user_role_' . $user->agents_users_role_id);

            $details_id = $view['userdetails']->details_id;
            $view['agentStatus'] = DB::table('agents_users')->where('id', $details_id)->get();
            // print_r($view['agentStatus'][0]->status); die;
            $status = $view['agentStatus'][0]->status;
            return $status;
        } else {
            return redirect('/login?usertype=agent');
        }
    }
}
