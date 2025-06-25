<?php

namespace App\Http\Controllers\Administrator;

use Carbon\Carbon;
use App\Helper\Resp;
use App\Models\Post;
use App\Models\User;
use App\Models\Rating;
use App\Models\AgentRating;
use App\Models\Userdetails;
use App\Events\eventTrigger;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RatingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $update = [
            'rating_type' => $request->rating_type,
            'rating_item_id' => $request->rating_item_id,
            'rating_item_parent_id' => $request->rating_item_parent_id,
            'sender_id' => $request->sender_id,
            'sender_role' => $request->sender_role,
            'receiver_id' => $request->receiver_id,
            'receiver_role' => $request->receiver_role,
        ];
        
        $notify = [
            'sender_id' => $request->sender_id,
            'sender_role' => $request->sender_role,
            'receiver_id' => $request->receiver_id,
            'receiver_role' => $request->receiver_role,
        ];

        $Rating = new Rating();
        $acheck = $Rating->getRatingSingalByAny($update);

        if (!empty($acheck)) {
            $bookbarkupdate = Rating::find($acheck->rating_id);
            $bookbarkupdate->rating_type = $request->rating_type;
            $bookbarkupdate->rating = $request->rating;
            $bookbarkupdate->rating_item_id = $request->rating_item_id;
            $bookbarkupdate->rating_item_parent_id = $request->rating_item_parent_id;
            $bookbarkupdate->sender_id = $request->sender_id;
            $bookbarkupdate->sender_role = $request->sender_role;
            $bookbarkupdate->receiver_id = $request->receiver_id;
            $bookbarkupdate->receiver_role = $request->receiver_role;
            $bookbarkupdate->updated_at = Carbon::now();
            $bookbarkupdate->save();
            $result = $bookbarkupdate;
        } else {
            $Rating->rating_type = $request->rating_type;
            $Rating->rating = $request->rating;
            $Rating->rating_item_id = $request->rating_item_id;
            $Rating->rating_item_parent_id = $request->rating_item_parent_id;
            $Rating->sender_id = $request->sender_id;
            $Rating->sender_role = $request->sender_role;
            $Rating->receiver_id = $request->receiver_id;
            $Rating->receiver_role = $request->receiver_role;
            $Rating->updated_at = Carbon::now();
            $Rating->save();
            $result = $Rating;
        }

        if ($result) {
            $notify = [
                'notification_type' => $request->notification_type,
                'notification_message' => $request->notification_message,
                'notification_item_id' => $result->rating_id,
                'notification_child_item_id' => $request->rating_item_id,
                'notification_post_id' => $request->post_id,
                'updated_at' => Carbon::now(),
            ];

            $Notification = new Notification;
            $Notification->inserupdate($notify);
            event(new eventTrigger([$request->all(), $result, 'NewNotification']));
        }

        return response()->json(['data' => $result]);
    }

    /* For review send */
    public function agent_rating(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric|between:1,5',
            'review' => 'required|string|max:500',
            'rating_type' => 'required|in:1,2,3,4', // 1=Answers, 2=Messaging, 3=Agent, 4=Post	
            'rating_item_id' => 'required|integer',
            'rating_item_parent_id' => 'nullable|integer',
            'sender_id' => 'required|integer|exists:agents_users,id',
            'sender_role' => 'required|integer|exists:agents_users_roles,role_id',
            'receiver_id' => 'required|integer|exists:agents_users,id',
            'receiver_role' => 'required|integer|exists:agents_users_roles,role_id',
            'notification_type' => 'required|integer|min:1|max:16',
            'notification_message' => 'required|string|max:255', 
            'post_id' => 'required|integer|exists:agents_posts,post_id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $ratingData = $request->only([
            'rating_type',
            'rating',
            'review',
            'rating_item_id',
            'rating_item_parent_id',
            'sender_id',
            'sender_role',
            'receiver_id',
            'receiver_role'
        ]);

        $rating = Rating::where([
            'rating_type' => $request->rating_type,
            'rating_item_id' => $request->rating_item_id,
            'rating_item_parent_id' => $request->rating_item_parent_id,
            'sender_id' => $request->sender_id,
            'sender_role' => $request->sender_role,
            'receiver_id' => $request->receiver_id,
            'receiver_role' => $request->receiver_role,
        ])->orderBy('created_at', 'DESC')->firstOrNew();

        $rating->fill($ratingData);
        $rating->save();

        $notificationData = [
            'sender_id' => $request->sender_id,
            'sender_role' => $request->sender_role,
            'receiver_id' => $request->receiver_id,
            'receiver_role' => $request->receiver_role,
            'notification_type' => $request->notification_type,
            'notification_message' => $request->notification_message,
            'notification_item_id' => $rating->rating_id, // Use the newly created/updated rating_id
            'notification_child_item_id' => $request->rating_item_id,
            'notification_post_id' => $request->post_id,
            'show' => ($request->notification_type == 14 && Post::find($request->post_id)->mark_complete == 2) ? 2 : 1, // Directly access the post
        ];

        Notification::updateOrCreate([
            'notification_type' => $notificationData['notification_type'],
            'notification_item_id' => $notificationData['notification_item_id']
        ], $notificationData);

        event(new eventTrigger([$request->all(), $rating, 'NewNotification']));

        $post = Post::find($request->post_id);
        $post->buyer_seller_send_review = ($request->rating_type != 4) ? '1' : $post->buyer_seller_send_review;
        $post->agent_send_review = ($request->rating_type == 4) ? '1' : $post->agent_send_review;  // Conditional update for agent review
        $post->final_status = '2';
        $post->save();

        $ratings = Rating::where([
            'rating_type' => $request->rating_type,
            'receiver_id' => $request->receiver_id,
            'receiver_role' => $request->receiver_role
        ])->get();


        if ($ratings->isNotEmpty()) {
            $totalRating = $ratings->sum(function ($rating) {
                return str_replace('_', '.', $rating->rating);
            });

            $averageRating = $totalRating / $ratings->count();

            $userDetails = Userdetails::find($request->receiver_id);

            switch ($request->receiver_role) {
                case 2: // Buyer Rating
                    $userDetails->buyer_rating = $averageRating;
                    break;
                case 3: // Seller Rating
                    $userDetails->seller_rating = $averageRating;
                    break;
                case 4: // Agent Rating
                    $userDetails->agent_rating = $averageRating;
                    break;
            }

            $userDetails->save();
        }

        return response()->json(['data' => $rating]);
    }

    public function agent_rating_jk(Request $request)
    {
        $userdata = new User;
        $postdata = Post::find($request->post_id);

        $rules = [
            'rating' => 'required',
            'review' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        
        $update = [
            'rating_type' => $request->rating_type,
            'rating_item_id' => $request->rating_item_id,
            'rating_item_parent_id' => $request->rating_item_parent_id,
            'sender_id' => $request->sender_id,
            'sender_role' => $request->sender_role,
            'receiver_id' => $request->receiver_id,
            'receiver_role' => $request->receiver_role,
        ];

        $Rating = new Rating();
        $acheck = $Rating->getRatingSingalByAny($update);
        
		$Rating = Rating::where($update)
            ->orderBy('created_at','DESC')
            ->first();

        if (!empty($existing_rating)) {
            $bookbarkupdate = Rating::find($acheck->rating_id);
            $bookbarkupdate->rating_type = $request->rating_type;
            $bookbarkupdate->rating = $request->rating;
            $bookbarkupdate->review = $request->review;
            $bookbarkupdate->rating_item_id = $request->rating_item_id;
            $bookbarkupdate->rating_item_parent_id = $request->rating_item_parent_id;
            $bookbarkupdate->sender_id = $request->sender_id;
            $bookbarkupdate->sender_role = $request->sender_role;
            $bookbarkupdate->receiver_id = $request->receiver_id;
            $bookbarkupdate->receiver_role = $request->receiver_role;
            $bookbarkupdate->updated_at = Carbon::now();
            $bookbarkupdate->save();
            $result = $bookbarkupdate;
        } else {
            $Rating->rating_type = $request->rating_type;
            $Rating->rating = $request->rating;
            $Rating->review = $request->review;
            $Rating->rating_item_id = $request->rating_item_id;
            $Rating->rating_item_parent_id = $request->rating_item_parent_id;
            $Rating->sender_id = $request->sender_id;
            $Rating->sender_role = $request->sender_role;
            $Rating->receiver_id = $request->receiver_id;
            $Rating->receiver_role = $request->receiver_role;
            $Rating->updated_at = Carbon::now();
            $Rating->save();
            $result = $Rating;
        }

        $notifiy = [];
        $Notification = new Notification;

        if ($result) {
            $notifiy = [
                'sender_id' => $request->sender_id,
                'sender_role' => $request->sender_role,
                'receiver_id' => $request->receiver_id,
                'receiver_role' => $request->receiver_role,
                'notification_type' => $request->notification_type,
                'notification_message' => $request->notification_message,
                'notification_item_id' => $result->rating_id,
                'notification_child_item_id' => $request->rating_item_id,
                'notification_post_id' => $request->post_id,
                'show' => ($request->notification_type == 14 && $postdata->mark_complete == 2) ? 2 : 1,
                'updated_at' => Carbon::now(),
            ];

            $Notification->inserupdate($notifiy);
            event(new eventTrigger([$request->all(), $result, 'NewNotification']));
        }

        if ($request->rating_type != 4) {
            $post = Post::find($request->post_id);
            $post->buyer_seller_send_review = '1';
            $post->updated_at = Carbon::now();
        }

        if ($request->rating_type == 4) {
            $Notification->inserupdate(['status' => '2'], [
                'notification_type' => '16',
                'notification_item_id' => $request->sender_id,
                'notification_child_item_id' => $request->post_id,
                'notification_post_id' => $request->post_id,
                'sender_id' => $request->sender_id,
                'sender_role' => $request->sender_role,
                'receiver_id' => $request->receiver_id,
                'receiver_role' => $request->receiver_role
            ]);

            $post = Post::find($request->post_id);
            $post->agent_send_review = '1';
            $post->updated_at = Carbon::now();
        }

        $post->final_status = '2';

        if ($post->save()) {
            $userdata->updateusersrating($request->all());
            return response()->json(['data' => $result]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($limit, $userid, $role)
    {
        $Rating = new Rating;
        $result = $Rating->getDetailsByAny($limit, ['agents_user_id' => $userid, 'sender_role' => $role]);
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function GetRatingedList($id, $role, $rating_type, $rating_item_id, $rating_item_parent_id, $receiver_id, $receiver_role)
    {
        $Rating = new Rating;
        $result = $Rating->getRatingSingalByAny([
            'sender_id' => $id,
            'sender_role' => $role,
            'receiver_id' => $receiver_id,
            'receiver_role' => $receiver_role,
            'rating_type' => $rating_type,
            'rating_item_id' => $rating_item_id,
            'rating_item_parent_id' => $rating_item_parent_id
        ]);
        return response()->json($result);
    }

    /* Get rating list by post */
    public function GetRatingListbypost($rating_type, $post_id, $receiver_id, $receiver_role)
    {
        $Rating = new Rating;
        $result = $Rating->GetRatingListbypost([
            'agents_rating.rating_type' => $rating_type,
            'agents_rating.rating_item_parent_id' => $post_id,
            'agents_rating.receiver_id' => $receiver_id,
            'agents_rating.receiver_role' => $receiver_role
        ]);
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $result = DB::table('agents_rating')->where('rating_id', $id)->delete();
    }

    public function reviewofpost(Request $request, $post_id)
    {
        $review = DB::table('agents_rating')->where(['rating_item_parent_id' => $post_id, 'rating_item_id' => Auth::user()->id])->first();
        return response()->json($review);
    }

    public function store_agent_rating(Request $request)
    {
        $user = auth()->user();
        $rating = AgentRating::updateOrCreate(
            ['rating_by' => $user->id, 'rating_for' => $request->agent_id],
            [
                'rating_by_role' => $user->agents_users_role_id, 
                'rating' => $request->rating, 
                'review' => $request->review
            ]
        );
        if ($request->rating == 5) {
            $fiveStarCount = AgentRating::where('rating_for', $request->agent_id)->where('rating', 5)->distinct('rating_by')->count('rating_by');
            if ($fiveStarCount >= 20) {
                $existingPopin = DB::table('popins')->where('agent_id', $request->agent_id)->where('blog_id', null)->where('status', 'Most Liked')->first();
                if (!$existingPopin) {
                        $url = url('/search/agents/details/'.$request->agent_id);
                        $bg_color = sprintf("#%06X", mt_rand(0, 0xFFFFFF));
                        $btn_color = sprintf("#%06X", mt_rand(0, 0xFFFFFF));
                        $designs = ['top','bottom','left','right','full_screen','top_right','bottom_right','top_left','bottom_left'];
                        $agentDetails = DB::table('agents_users_details')->where('details_id', $request->agent_id)->first();
                        $profileImage = $agentDetails->photo ?? null;
                        $image = null;
                        $description = 'Clients describe this agent as friendly, responsive, and truly dedicated. Your next home journey starts with someone you can trust.';
                        if ($profileImage && file_exists(public_path("assets/img/profile/$profileImage"))) {
                                $filename = $profileImage;
                                $sourcePath = public_path("assets/img/profile/$filename");
                                $destinationPath = public_path("uploads/popin_images/$filename");
                                if (copy($sourcePath, $destinationPath)) {
                                    $image = $filename;
                                }
                        }
                        DB::table('popins')->insert([
                            'title' => 'Explore Profile',
                            'agent_id' => $request->agent_id,
                            'heading' => $agentDetails->name.' (Agent)',
                            'description' => $description,
                            'image' => $image,
                            'url' => $url,
                            'bg_color' => $bg_color,
                            'btn_color' => $btn_color,
                            'design' => $designs[array_rand($designs)],
                            'status' => 'Most Liked',
                            'for_whom' => 'All',
                        ]);
                }
            }
        }
        return redirect()->back()->with('success','Rating added successfully.');
    }

    public function get_agent_rating($id){
        $rating = AgentRating::where('rating_by',auth()->user()->id)->where('rating_for',$id)->first();
        $ratings = AgentRating::where('rating_for',$id)->orderBy('id', 'desc')->paginate(12);
        $agent = DB::table('agents_users_details')->where('details_id',$id)->first();
        $ratingStats = AgentRating::where('rating_for', $id)
        ->selectRaw('COUNT(*) as total, AVG(rating) as average')
        ->first();
        return view('dashboard.user.search.agent_rating',compact('ratings','agent','rating','ratingStats'));
    }

    public function delete_agent_rating($agent_id){
        $rating = AgentRating::where('rating_by',auth()->user()->id)->where('rating_for',$agent_id)->delete();
        return redirect()->back()->with('success','Rating deleted successfully.');
    }

    public function like_blog($blog_id)
    {
        $userId = auth()->id();
        $like = DB::table('blog_likes')->where('blog_id', $blog_id)->first();
        $message = '';
        if ($like) {
            $likesArray = $like->likes_by ? explode(',', $like->likes_by) : [];

            if (in_array($userId, $likesArray)) {
                $likesArray = array_diff($likesArray, [$userId]);
                $message = 'Blog like removed successfully.';
            } else {
                $likesArray[] = $userId;
                $message = 'Blog liked successfully.';
            }
            DB::table('blog_likes')->where('blog_id', $blog_id)->update([
                'likes_by' => implode(',', $likesArray),
            ]);
        } else {
            $likesArray = [$userId];
            DB::table('blog_likes')->insert([
                'blog_id' => $blog_id,
                'likes_by' => $userId,
            ]);
            $message = 'Blog liked successfully.';
        }
        $totalLikes = count($likesArray);   

        if ($totalLikes >= 50) {
            $existingPopin = DB::table('popins')->where('blog_id', $blog_id)->where('agent_id',auth()->id())->where('status','Most Liked')->first();

            if (!$existingPopin) {
                $blog = DB::table('agents_blog')->where('id', $blog_id)->first();
                $url = url('/blogs') .'/'. $blog_id .'/'. $blog->title;
                $bg_color = sprintf("#%06X", mt_rand(0, 0xFFFFFF));
                $btn_color = sprintf("#%06X", mt_rand(0, 0xFFFFFF));
                $designs = ['top','bottom','left','right','full_screen','top_right','bottom_right','top_left','bottom_left'];
                if ($blog) {
                    DB::table('popins')->insert([
                        'title' => 'Explore Blog',
                        'agent_id' => $blog->added_by,
                        'blog_id' => $blog_id,
                        'heading' => $blog->title,
                        'description' => $blog->description,
                        'url' => $url,
                        'bg_color' => $bg_color,
                        'btn_color' => $btn_color,
                        'design' => $designs[array_rand($designs)],
                        'status' => 'Most Liked',
                        'for_whom' => 'All',
                    ]);
                }
            }
        }
        return redirect()->back();
    }

    public function dislike_blog($blog_id)
    {
        $userId = auth()->id();
        $dislike = DB::table('blog_likes')->where('blog_id', $blog_id)->first();
        $message = '';
        if ($dislike) {
            $dislikesArray = $dislike->dislikes_by ? explode(',', $dislike->dislikes_by) : [];
            if (in_array($userId, $dislikesArray)) {
                $dislikesArray = array_diff($dislikesArray, [$userId]);
                $message = 'Blog dislike removed successfully.';
            } else {
                $dislikesArray[] = $userId;
                $message = 'Blog disliked successfully.';
            }
            DB::table('blog_likes')->where('blog_id', $blog_id)->update([
                'dislikes_by' => implode(',', $dislikesArray),
            ]);
        } else {
            DB::table('blog_likes')->insert([
                'blog_id' => $blog_id,
                'dislikes_by' => $userId,
            ]);
            $message = 'Blog disliked successfully.';
        }
        return redirect()->back();
    }
}