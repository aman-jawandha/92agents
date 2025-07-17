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
use Illuminate\Support\Facades\File;

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

   public function blogstore(Request $request)
{
    $user = Auth::user();
    $id = $user->id;
    $data = $request->except('_token', 'files');

    $filename = null;

    // Handle image upload once and copy it
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();

        $blogPath = public_path('uploads/blog_images');
        $popinPath = public_path('uploads/popin_images');

        if (!File::exists($blogPath)) File::makeDirectory($blogPath, 0755, true);
        if (!File::exists($popinPath)) File::makeDirectory($popinPath, 0755, true);

        $file->move($blogPath, $filename);
        File::copy($blogPath . '/' . $filename, $popinPath . '/' . $filename);

        $data['image'] = $filename;
    }

    $data['added_by'] = $id;
    $data['status'] = 1;

    $blog_id = DB::table('agents_blog')->insertGetId($data);

    // Prepare popin data
    $url = url('/blogs') . '/' . $blog_id . '/' . $request->title;
    $bg_color = sprintf("#%06X", mt_rand(0, 0xFFFFFF));
    $btn_color = sprintf("#%06X", mt_rand(0, 0xFFFFFF));
    $status = 'Inactive';

    $user_plan = DB::table('user_plans')
        ->where('user_id', $id)
        ->whereDate('start_date', '<=', now())
        ->whereDate('end_date', '>=', now())
        ->first();

    $designs = ['top', 'bottom', 'left', 'right', 'full_screen', 'top_right', 'bottom_right', 'top_left', 'bottom_left'];
    if ($user_plan) {
        $designs = explode(',', $user_plan->designs);
        $activePopins = Popin::where('agent_id', $id)->where('status', 'Active')->count();
        if ($user_plan->no_of_popins > $activePopins) {
            $status = 'Active';
        }
    }

    if ($blog_id && $user->agents_users_role_id == '4') {
        Popin::create([
            'for_whom' => 'All',
            'title' => 'Explore Blog',
            'heading' => $request->title,
            'description' => $request->description,
            'image' => $filename,
            'url' => $url,
            'bg_color' => $bg_color,
            'btn_color' => $btn_color,
            'design' => $designs[array_rand($designs)],
            'status' => $status,
            'agent_id' => $id,
            'blog_id' => $blog_id,
        ]);

        DB::table('agents_users')->where('id', $id)->increment('points', 5);
        DB::table('agent_points_history')->insert([
            'agent_id' => $id,
            'plus_points' => 5,
            'points_for' => 'For posting a blog',
        ]);
    }

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

    $filename = null;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();

        $blogPath = public_path('uploads/blog_images');
        $popinPath = public_path('uploads/popin_images');

        if (!File::exists($blogPath)) File::makeDirectory($blogPath, 0755, true);
        if (!File::exists($popinPath)) File::makeDirectory($popinPath, 0755, true);

        $file->move($blogPath, $filename);

        File::copy($blogPath . '/' . $filename, $popinPath . '/' . $filename);

        $data['image'] = $filename;
    }
    $result = DB::table('agents_blog')->where('id', $id)->update($data);

    if ($result) {
        $url = url('/blogs') . '/' . $id . '/' . $request->title;

        $popinData = [
            'heading' => $request->title,
            'description' => $request->description,
            'url' => $url,
        ];

        if ($filename) {
            $popinData['image'] = $filename;
        }

        Popin::where('blog_id', $id)
            ->where('agent_id', auth()->id())
            ->update($popinData);

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
