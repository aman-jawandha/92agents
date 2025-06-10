<?php

namespace App\Http\Controllers\Administrator;

use Carbon\Carbon;
use App\Helper\Resp;
use App\Models\Post;
use App\Models\User;
use App\Models\Rating;
use App\Models\Userdetails;
use App\Events\eventTrigger;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
}