<?php

namespace App\Http\Controllers\Api;

use App\Events\eventTrigger;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Userdetails;
use App\Models\Agentskills;
use App\Models\QuestionAnswers;
use App\Models\State;
use App\Models\MessagingChat;
use App\Models\Post;
use App\Models\Rating;
use App\Models\Bookmark;
use App\Models\Notification;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;
use App\Helper\Resp;
use Illuminate\Validation\Rule;

/**
 * Sender: Logged in user..
 * Receiver: Person on the other end
 */
class MessagingChatController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if (!AuthUser()) {
			return Resp::NoAuth();
		}

		$validator = Validator::make($request->all(), [
			'post_id' => 'required|numeric|exists:agents_posts,post_id',
			'receiver_id' => 'required|numeric|exists:agents_users,id',
			'receiver_role_id' => ['required', 'numeric', Rule::in([1, 2, 3, 4])],
		]);

		if ($validator->fails()) {
			return Resp::InvalidRequest(validator: $validator);
		}

		$AuthUser = AuthUser();

		$receiver_id = $request->receiver_id;
		$receiver_role_id = $request->receiver_role_id;
		$post_id = $request->post_id;

		$messagingchat = new MessagingChat;

		$data['post_id'] = $post_id != null ? $post_id : '';

		$insert_data = [
			'sender_id' => $AuthUser->id,
			'sender_role_id' => $AuthUser->agents_users_role_id,
			'receiver_id' => $receiver_id,
			'receiver_role_id' => $receiver_role_id,
		];

		$orwhere = [
			'receiver_id' => $AuthUser->id,
			'receiver_role_id' => $AuthUser->agents_users_role_id,
			'sender_id' => $receiver_id,
			'sender_role_id' => $receiver_role_id,
		];

		$norwhere = ['post_id' => $post_id];

		$checkmc = $messagingchat->getConversationByAny($insert_data, $orwhere, $norwhere);

		// return $checkmc;

		if (count($checkmc) == 0) {
			$insert_data = array_merge($insert_data, [
				'snippet' => 'You are now connected on Messenger.',
				'tags_read' => 1,
				'tags_user_id' => $receiver_id,
				'tags_user_role' => $receiver_role_id,
				'unread_count' => 1,
				'post_id' => $post_id,
				'updated_at' => Carbon::now()->toDateTimeString(),
				'created_at' => Carbon::now()->toDateTimeString(),
			]);

			$data['conversation_id'] = $messagingchat->ConversationInserUpdate(data: $insert_data);

			$notifiy = [
				'sender_id' => $AuthUser->id,
				'sender_role' => $AuthUser->agents_users_role_id,
				'receiver_id' => $receiver_id,
				'receiver_role' => $receiver_role_id,
				'notification_type' => 6,
				'notification_message' => "{$AuthUser->name} just joined you on Messag!",
				'notification_item_id' => $data['conversation_id'],
				'notification_child_item_id' => $post_id,
				'status' => 1,
				'updated_at' => Carbon::now()->toDateTimeString(),
				'created_at' => Carbon::now()->toDateTimeString(),
			];

			$Notification = new Notification;
			$Notification->inserupdate($notifiy);
		} else {
			$data['conversation_id'] = $checkmc[0]->conversation_id;
		}

		$user = new User;

		return Resp::Api(
			data: $data,
			misc: [
				'user' => $AuthUser,
				'receiver' => $user->getDetailsByEmailOrId(['id' => $receiver_id])
			],
			message: Resp::MESSAGE_FETCHED,
			code: Resp::OK,
		);
	}

	/* For create conversation */
	public function create_conversation(Request $request)
	{
		$post_id = $request->post_id;
		$receiver_id = $request->receiver_id;
		$receiver_role_id = $request->receiver_role_id;
		$sender_id = $request->sender_id;

		$dt = [];
		$user = User::find($sender_id);
		$userdetails = Userdetails::find($sender_id);

		if ($receiver_id != null && $receiver_role_id != null && $post_id != null) {
			$messagingchat = new MessagingChat;
			$where = [
				'sender_id' => $user->id,
				'sender_role_id' => $user->agents_users_role_id,
				'receiver_id' => $receiver_id,
				'receiver_role_id' => $receiver_role_id,
			];
			$orwhere = [
				'receiver_id' => $user->id,
				'receiver_role_id' => $user->agents_users_role_id,
				'sender_id' => $receiver_id,
				'sender_role_id' => $receiver_role_id,
			];
			$norwhere = ['post_id' => $post_id];
			$checkmc = $messagingchat->getConversationByAny($where, $orwhere, $norwhere);

			if (count($checkmc) == 0) {
				$dt['sender_id'] = $user->id;
				$dt['sender_role_id'] = $user->agents_users_role_id;
				$dt['receiver_id'] = $receiver_id;
				$dt['receiver_role_id'] = $receiver_role_id;
				$dt['snippet'] = 'You are now connected on Messenger.';
				$dt['tags_read'] = 1;
				$dt['tags_user_id'] = $receiver_id;
				$dt['tags_user_role'] = $receiver_role_id;
				$dt['unread_count'] = 1;
				$dt['post_id'] = $post_id;
				$dt['updated_at'] = Carbon::now()->toDateTimeString();
				$dt['created_at'] = Carbon::now()->toDateTimeString();
				$conversation_id = $messagingchat->ConversationInserUpdate($dt);

				$notifiy = [
					'sender_id' => $user->id,
					'sender_role' => $user->agents_users_role_id,
					'receiver_id' => $receiver_id,
					'receiver_role' => $receiver_role_id
				];
				$notifiy['notification_type'] = 6;
				$notifiy['notification_message'] = "{$userdetails->name} just joined you on Messag!";
				$notifiy['notification_item_id'] = $conversation_id;
				$notifiy['notification_child_item_id'] = $post_id;
				$notifiy['status'] = 1;
				$notifiy['updated_at'] = Carbon::now()->toDateTimeString();
				$notifiy['created_at'] = Carbon::now()->toDateTimeString();

				$noti = new Notification;
				$noti->inserupdate($notifiy);
			} else {
				$conversation_id = $checkmc[0]->conversation_id;
			}

			$where = [
				'm.sender_id' => $user->id,
				'm.sender_role_id' => $user->agents_users_role_id,
			];
			$orwhere = [
				'm.receiver_id' => $user->id,
				'm.receiver_role_id' => $user->agents_users_role_id,
			];
			$result = $messagingchat->getUserConversationsListByAny(0, $where, $orwhere, ['m.conversation_id' => $conversation_id]);

			return response()->json($result);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\MessagingChat  $messagingChat
	 * @return \Illuminate\Http\Response
	 */
    public function ConversationList(Request $request)
    {
        if (!$AuthUser = AuthUser()) { // Assuming AuthUser() is a custom function.
            return Resp::NoAuth();
        }

        $user_id = $AuthUser->id;
        $user_role = $AuthUser->agents_users_role_id;

        // IMPORTANT: Check if $user_role is null or not.  If it is, the query will fail.
        if ($user_role === null) {
             return Resp::BadApi(data: 'User role ID is null.'); // Or whatever error response you want.
        }

        $perPage = $request->input('per_page', 10);

        $conversations = DB::table('agents_conversation as m')
            ->join('agents_users_details as u', function ($join) {
                $join->on('u.details_id', '=', 'm.sender_id')
                     ->orOn('u.details_id', '=', 'm.receiver_id');
            })
            ->leftJoin('agents_users as uu', 'uu.id', '=', 'u.details_id')
            ->join('agents_posts as p', 'p.post_id', '=', 'm.post_id')
            ->where(function ($query) use ($user_id, $user_role) {
                $query->where('m.sender_id', $user_id)
                      ->where('m.sender_role_id', $user_role);
            })
            ->orWhere(function ($query) use ($user_id, $user_role) {
                $query->where('m.receiver_id', $user_id)
                      ->where('m.receiver_role_id', $user_role);
            })
            ->where(function ($query) use ($user_id) {
                $query->whereRaw('(
                    CASE
                        WHEN m.sender_id = ? THEN m.receiver_id = u.details_id
                        WHEN m.receiver_id = ? THEN m.sender_id = u.details_id
                    END
                )', [$user_id, $user_id]);
            })
            ->where('p.is_deleted', '0')
            ->select(
                'u.details_id as user_id',
                'uu.login_status',
                'uu.updated_at as last_login_time',
                'm.*',
                'u.name',
                'u.photo',
                'p.posttitle',
                'p.details',
                DB::raw("IF(m.sender_id = $user_id, m.receiver_role_id, m.sender_role_id) AS agents_users_role_id"),
                DB::raw("IF(m.sender_id = $user_id, 'sender', 'receiver') AS is_user")
            )
            ->orderBy('m.updated_at', 'DESC')
            ->paginate($perPage);

        return Resp::Api(
            data: $conversations,  // Corrected this line
            has_paginate: true,
        );
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\MessagingChat  $messagingChat
	 * @return \Illuminate\Http\Response
	 */
	public function ConversationMessagesList(Request $request)
	{
		if (!$AuthUser = AuthUser()) {
			return Resp::NoAuth();
		}

		$validator = Validator::make($request->all(), [
			'conversation_id' => 'required|numeric|exists:agents_conversation,conversation_id',
			'bookmark' => 'nullable|numeric',
			'limit' => 'nullable|numeric',
			'page' => 'nullable|numeric',
		]);

		if ($validator->fails()) {
			return Resp::InvalidRequest(validator: $validator);
		}

		$limit = $request->limit ?? 20;
		$bookmark = $request->bookmark ?? null;
		$conversation_id = $request->conversation_id;
		$page = $request->page ?? 1;

		$ratingdata = [];
		$bookmarkdata = [];
		$bookmark = new Bookmark;
		$rating = new Rating;
		$messagingchat = new MessagingChat;

		$where = [
			'm.sender_id' => $AuthUser->id,
			'm.sender_role' => $AuthUser->agents_users_role_id,
		];

		$orwhere = [
			'm.receiver_id' => $AuthUser->id,
			'm.receiver_role' => $AuthUser->agents_users_role_id,
		];

		$mainwhere = ['m.conversation_id' => $conversation_id];

		$result = $messagingchat->getUserConversationsMessageListByAny($limit, $where, $orwhere, $mainwhere, $page);

		if ($result['count'] != 0 && $bookmark && !empty($bookmark)) {
			foreach ($result['result'] as $value) {
				$bok = $bookmark->getBookmarkSingalByAny([
					'bookmark_type' => 3,
					'bookmark_item_id' => $value->messages_id,
					'bookmark_item_parent_id' => $request->conversation_id,
					'sender_id' => $request->sender_id,
					'sender_role' => $request->sender_role
				]);

				if (empty($bok)) {
					$bookmarkdata[$value->messages_id] = '';
				} else {
					$bookmarkdata[$value->messages_id] = $bok;
				}

				if ($request->sender_role == 4) {
					$rat = $rating->getRatingSingalByAny([
						'rating_type' => 2,
						'rating_item_id' => $value->messages_id,
						'rating_item_parent_id' => $request->conversation_id,
						'sender_id' => $value->user_id,
						'sender_role' => $value->agents_users_role_id,
						'receiver_id' => $request->sender_id,
						'receiver_role' => $request->sender_role
					]);

					$ratingdata[$value->messages_id] = empty($rat) ? '' : $rat;
				}
			}
		}

		return Resp::Api(
			data: $result,
			misc: [
				'bookmarks' => $bookmarkdata,
				'ratings' => $ratingdata,
			],
			message: Resp::MESSAGE_FETCHED,
			code: Resp::OK,
			need_count: true,
			has_paginate: true,
		);

		// JkWorkz
		// return response()->json([$result, $bookmarkdata, $ratingdata, 'status' => '100']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\MessagingChat  $messagingChat
	 * @return \Illuminate\Http\Response
	 */
	public function SentMessage(Request $request)
	{
		if (!$AuthUser = AuthUser()) {
			return Resp::NoAuth();
		}

		$validator = Validator::make($request->all(), [
			'limit' => 'nullable|numeric',
			'page' => 'nullable|numeric',
		]);

		if ($validator->fails()) {
			return Resp::InvalidRequest(validator: $validator);
		}

		$limit = $request->limit ?? 20;
		$page = $request->page ?? 1;

		$messagingchat = new MessagingChat;

		$where = [
			'm.sender_id' => $AuthUser->id,
			'm.sender_role_id' => $AuthUser->agents_users_role_id,
		];

		$orwhere = [
			'm.receiver_id' => $AuthUser->id,
			'm.receiver_role_id' => $AuthUser->agents_users_role_id,
		];

		$result = $messagingchat->getSentMessageListByAny($limit, $where, $orwhere, $page);

		return Resp::Api(
			data: $result,
			misc: [],
			message: Resp::MESSAGE_FETCHED,
			code: Resp::OK,
			need_count: true,
			has_paginate: true,
		);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\MessagingChat  $messagingChat
	 * @return \Illuminate\Http\Response
	 */
	public function UnreadMessage(Request $request)
	{
		if (!$AuthUser = AuthUser()) {
			return Resp::NoAuth();
		}

		$normwhere = [
			'tags_user_id' => $AuthUser->id,
			'tags_user_role' => $AuthUser->agents_users_role_id,
			'tags_read' => 1,
		];

		$messagingchat = new MessagingChat;

		$result = $messagingchat->getUnreadMessageListByAny($normwhere);

		return Resp::Api(
			data: $result,
			misc: [],
			message: "Data Fetched Succesfully!",
			code: Resp::OK,
		);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\MessagingChat  $messagingChat
	 * @return \Illuminate\Http\Response
	 */
	public function InsertNewMessage(Request $request)
	{
		if (!$AuthUser = AuthUser()) {
			return Resp::NoAuth();
		}

		$sender_id = $AuthUser->id;
		$sender_role = $AuthUser->agents_users_role_id;
		$sender_name = $AuthUser->name;

		$validator = Validator::make($request->all(), [
			'conversation_id' => 'required|integer|exists:agents_conversation,conversation_id', // Validate existence
			'post_id' => 'required|integer|exists:agents_posts,post_id',
			'receiver_id' => 'required|integer',
			'receiver_role' => 'required|integer',
			'message_text' => 'required|string',
			// 'name' => 'required|string', // You use $request->name, so validate it
			// 'is_user' => 'nullable|string|in:receiver,sender', // Limit to specific values
		]);

		if ($validator->fails()) {
			return Resp::InvalidRequest(validator: $validator);
		}

		$conversation_id = $request->conversation_id;
		$post_id = $request->post_id;
		$receiver_id = $request->receiver_id;
		$receiver_role = $request->receiver_role;
		$message_text = $request->message_text;

		// $is_user = $request->is_user;

		// 1. Buyers & Sellers can only message an agent.
		if (in_array($sender_role, [2, 3]) && $receiver_role != 4) {
			return Resp::BadApi(message: 'User can only message agents', rc: Resp::PERMISSION_DENIED);
		}

		if ($sender_role == 4) {
			// 2. Agent cannot message another agent.
			if ($receiver_role == 4) {
				return Resp::BadApi(message: 'Agents cannot message other agents directly.', rc: Resp::PERMISSION_DENIED);
			}

			// 3. Agent can message either Buyers or Sellers.
			if (!in_array($receiver_role, [2, 3])) {
				return Resp::BadApi(message: 'Agents can only message buyers or sellers.', rc: Resp::PERMISSION_DENIED);
			}
		}

		$conversation = MessagingChat::find($conversation_id);
		$mcount = $conversation->unread_count + 1;
		$conversation->tags_read = 1;

		// if ($is_user == 'receiver') {
		// 	$conversation->last_receiver_msg = $message_text;
		// 	$conversation->last_receiver_da = Carbon::now()->toDateTimeString();
		// } else {
		// 	$conversation->last_sender_msg = $message_text;
		// 	$conversation->last_sender_da = Carbon::now()->toDateTimeString();
		// }

		$conversation->tags_user_id = $receiver_id;
		$conversation->tags_user_role = $receiver_role;
		$conversation->unread_count = $mcount;
		$conversation->snippet = $message_text;
		$conversation->updated_at = Carbon::now()->toDateTimeString();
		$conversation->created_at = Carbon::now()->toDateTimeString();
		$conversation->post_id = $post_id;
		$conversation->sender_id = $sender_id;
		$conversation->save();

		$messagingchat = new MessagingChat;

		$chat_details = [
			'conversation_id' => $conversation_id,
			'post_id' => $post_id,
			'sender_id' => $sender_id,
			'sender_role' => $sender_role,
			'receiver_id' => $receiver_id,
			'receiver_role' => $receiver_role,
			'message_text' => $message_text,
			'tags_read' => 1,
			'updated_at' => Carbon::now()->toDateTimeString(),
			'created_at' => Carbon::now()->toDateTimeString(),
		];

		$messages_id = $messagingchat->ConversationMessageInserUpdate($chat_details);

		if (!$messages_id) {
			return Resp::BadApi(message: 'Message not sent! Please try again..');
		}

		$notifiy = [
			'sender_id' => $sender_id,
			'sender_role' => $sender_role,
			'receiver_id' => $receiver_id,
			'receiver_role' => $receiver_role,
		];
		$notifiy['notification_type'] = 7;
		$notifiy['notification_message'] = "{$sender_name} sent a message: {$message_text}";
		$notifiy['notification_item_id'] = $messages_id->messages_id;
		$notifiy['notification_child_item_id'] = $conversation_id;
		$notifiy['status'] = 1;
		$notifiy['updated_at'] = Carbon::now()->toDateTimeString();
		$notifiy['created_at'] = Carbon::now()->toDateTimeString();

		$noti = new Notification;
		$noti->inserupdate($notifiy);

		$where = [
			'm.sender_id' => $receiver_id,
			'm.sender_role_id' => $receiver_role,
		];
		$orwhere = [
			'm.receiver_id' => $receiver_id,
			'm.receiver_role_id' => $receiver_role,
		];
		$result = $messagingchat->getUserConversationsListByAny(0, $where, $orwhere, ['m.conversation_id' => $conversation_id]);

		event(new eventTrigger([$request->all(), $result, 'NewMessage']));

		return Resp::Api(
			data: $messages_id,
			misc: [],
			message: Resp::MESSAGE_ADDED_SINGLE,
			code: Resp::OK,
		);
	}

	/* For Read and update chat */
	public function readupdate(Request $request)
	{
		if (!$AuthUser = AuthUser()) {
			return Resp::NoAuth();
		}

		$validator = Validator::make($request->all(), [
			'conversation' => [
				'required',
				'exists:agents_conversation,conversation_id', // Check existence
				function ($attribute, $value, $fail) use ($AuthUser) { // Check ownership
					if (MessagingChat::where('conversation_id', $value)
						->where('sender_id', $AuthUser->id)
						->doesntExist()
					) {
						$fail('The selected conversation does not belong to you.');
					}
				},
			],
		]);

		if ($validator->fails()) {
			return Resp::InvalidRequest(validator: $validator);
		}

		$cmm = [
			'tags_read' => 2,
			'tags_user_id' => 0,
			'tags_user_role' => 0,
			'unread_count' => 0,
		];

		$messagingchat = new MessagingChat;

		$messagingchat->ConversationInserUpdate($cmm, ['conversation_id' => $request->cid, 'tags_user_id' => AuthUser()->id]);

		$messagingchat->ConversationMessageInserUpdate(['tags_read' => 2], ['conversation_id' => $request->cid, 'receiver_id' => AuthUser()->id, 'receiver_role' => AuthUser()->agents_users_role_id]);

		return Resp::Api(
			data: $messagingchat,
			misc: [],
			message: Resp::MESSAGE_UPDATED_SINGLE,
			code: Resp::OK,
		);
	}

	/* Added as API for notification creation */
	public function getnotifications($limit)
	{
		$user = AuthUser();
		$notification = new Notification;
		$result = $notification->getnotification($limit, $user->id, $user->agents_users_role_id);
		return response()->json($result);
	}

	// Update the notification to be read
	public function update($id = null)
	{
		$notification = new Notification;
		$result = $notification->inserupdate(
			['status' => 2, 'updated_at' => Carbon::now()->toDateTimeString()],
			[
				'notification_id' => $id
			]

		);
		$response_arr = [];

		if ($result) {
			$response_arr['status'] = 100;
			$response_arr['messages'] = 'Notification read successfully';
		} else {
			$response_arr['status'] = 101;
			$response_arr['messages'] = 'Something went wrong';
		}

		return response()->json($response_arr);
	}
}
