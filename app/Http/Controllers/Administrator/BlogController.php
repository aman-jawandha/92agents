<?php

namespace App\Http\Controllers\Administrator;

use App\Events\eventTrigger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Userdetails;
use App\Models\Post;
use App\Models\Popin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    function __construct()
    {
    }

    /* For get users info for show dashboard view */
    public function index(Request $request)
    {

        if (Auth::user()) {
            $view['user'] = $user = Auth::user();
            $view['userdetails'] = $userdetails = Userdetails::find($user->id);
            $view['user_type'] = env('user_role_' . $user->agents_users_role_id);
            $view['category'] = DB::table('agents_category')->select('*')->get();
            $view['blogs'] = DB::table('agents_blog')->join('agents_category', 'agents_blog.cat_id', '=', 'agents_category.id')->where('added_by', '=', $user->id)->select('agents_blog.*', 'agents_category.cat_name')->get();
            // dd($view);
            return view('dashboard.user.buyers.blog', $view);
        } else {
            return redirect('/login?usertype=agent');
        }
    }

    /* For check agent status */
    public function blogstore(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;
        $data = $request->except('_token', 'files');

        $data['added_by'] = $id;
        $data['status'] = 1;
        $blog_id = DB::table('agents_blog')->insertGetId($data);

        $url = url('/blogs') .'/'. $blog_id .'/'. $request->title;
        $bg_color = sprintf("#%06X", mt_rand(0, 0xFFFFFF));
        $btn_color = sprintf("#%06X", mt_rand(0, 0xFFFFFF));

        $user_plan = DB::table('user_plans')->where('user_id',auth()->id())->first();

        $status = 'Inactive';
        $designs = ['top','bottom','left','right','full_screen','top_right','bottom_right','top_left','bottom_left'];
        if($user_plan && $user_plan->start_date <= date('Y-m-d') && $user_plan->end_date >= date('Y-m-d')){
        $designs = explode(',',$user_plan->designs);
        $user_popins = Popin::where('agent_id',auth()->id())->where('status','Active')->count();
        if($user_plan->no_of_popins > $user_popins){
            $status = 'Active';
        }
        }
        if($blog_id && auth()->user()->agents_users_role_id == '4'){
            $popin = Popin::create([
            'for_whom' => 'All',
            'title' => 'Explore Blog',
            'heading' => $request->title,
            'description' => $request->description,
            'url' => $url,
            'bg_color' => $bg_color,
            'btn_color' => $btn_color,
            'design' => $designs[array_rand($designs)],
            'status' => $status,
            'agent_id' => auth()->id(),
            'blog_id' => $blog_id,
        ]);

        $points = DB::table('agents_users')->where('id', auth()->id())->increment('points', 5);
        $points_history = DB::table('agent_points_history')->insert([
            'agent_id' => auth()->id(),
            'plus_points' => 5,
            'points_for' => 'For posting a blog',
        ]);
        }
        $category = DB::table('agents_category')->select('*')->get();
        $view['user'] = $user = Auth::user();
        $view['userdetails'] = $userdetails = Userdetails::find($user->id);
        $view['user_type'] = env('user_role_' . $user->agents_users_role_id);
        $view['category'] = DB::table('agents_category')->select('*')->get();
        $view['blogs'] = DB::table('agents_blog')->join('agents_category', 'agents_blog.cat_id', '=', 'agents_category.id')->where('added_by', '=', $user->id)->get();
        return redirect('/buyer/blog');
    }

    public function advertisement()
    {
        if (Auth::user()) {
            $view['user'] = $user = Auth::user();
            $view['userdetails'] = $userdetails = Userdetails::find($user->id);
            $view['user_type'] = env('user_role_' . $user->agents_users_role_id);

            $view['package'] = DB::table('agents_package')->select('*')->where(['status' => 1, 'deleted' => 0])->get();
            return view('dashboard.user.buyers.advertise', $view);
        } else {
            return redirect('/login?usertype=agent');
        }
    }

    public function getSingleBlog($id)
    {
        $view['user'] = $user = Auth::user();
            $view['userdetails'] = $userdetails = Userdetails::find($user->id);
            $view['user_type'] = env('user_role_' . $user->agents_users_role_id);

            $view['res'] = DB::table('agents_blog')->where('id', '=', $id)->first();

            $res = DB::table('agents_blog')->where('id', '=', $id)->first();

            // return view('dashboard.user.buyers.blogidid',$view);

            echo json_encode($res);
    }

    public function getSingleBlogview($id)
    {
        $view['user'] = $user = Auth::user();
            $view['userdetails'] = $userdetails = Userdetails::find($user->id);
            $view['user_type'] = env('user_role_' . $user->agents_users_role_id);

            $view['res'] = DB::table('agents_blog')->where('id', '=', $id)->first();

            // $res = DB::table('agents_blog')->where('id', '=', $id)->first();

            return view('dashboard.user.buyers.blogidid',$view);

            // echo json_encode($res);
    }



    public function singleBlogUpdate(Request $request)
    {
        $data = $request->except('_token', 'files');
        $id = $data['id'];
        unset($data['id']);

        $result = DB::table('agents_blog')->where('id', '=', $id)->update($data);
        if ($result) {
            $url = url('/blogs') .'/'. $id .'/'. $request->title;
                $popin = Popin::where('blog_id',$id)->where('agent_id',auth()->id())->update([
                'heading' => $request->title,
                'description' => $request->description,
                'url' => $url,
            ]);
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delblog($id)
    {
        $res = DB::table('agents_blog')->where('id', '=', $id)->delete();
    }

    public function add_blog_comment(Request $req)
    {
        $maxComId = DB::table('agents_blog_comment')->max('com_id');
        $nextComId = $maxComId ? $maxComId + 1 : 1;

        DB::table('agents_blog_comment')->insert([
            'com_id' => $nextComId,
            'blog_id' => $req->blog_id,
            'comment_name' => $req->comment_name,
            'email' => $req->email,
            'comment' => $req->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
