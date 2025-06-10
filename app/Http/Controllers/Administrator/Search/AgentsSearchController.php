<?php

namespace App\Http\Controllers\Administrator\Search;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Userdetails;
use App\Models\State;
use App\Models\Post;
use App\Models\ClosingDateQuery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Helper\Resp;
use Illuminate\Validation\Rule;


class AgentsSearchController extends Controller
{
	function __construct()
	{
	}

	/* For agents search job view */
	public function index()
	{
		$user = Auth::user();

		if (!$user || $user->agents_users_role_id == 4) {
			return redirect('/login?usertype=' . env('user_role_' . Auth::user()->agents_users_role_id));
		}

		$active_post_exists = Post::where('agents_user_id', $user->id)
			->where('agents_users_role_id', $user->agents_users_role_id)
			->where('applied_post', 2)
			->where('final_status', 0)
			->where('agents_posts.is_deleted', '0')
			->exists();

		if (!$active_post_exists) {
			return view('dashboard.user.buyers.no_post');
		}
		
		$state = new State;
		$view = [];

		$view['user'] = $user;
		$view['userdetails'] = Userdetails::find($user->id);
		$view['city'] = $state->getCityByAny(['is_deleted' => '0']);
		$view['state'] = $state->getStateByAny(['is_deleted' => '0', 'status' => '1']);
		$view['search_post'] = Session::has('search_post') ? Session::get('search_post') : ['searchinputtype' => ''];

		$active_post_exists = Post::where('agents_user_id', $user->id)
			->where('agents_users_role_id', $user->agents_users_role_id)
			->where('applied_post', 2)
			->where('final_status', 0)
			->where('agents_posts.is_deleted', '0')
			->exists();


		return view('dashboard.user.search.agentsearch', $view);
	}

	public function inputclosingdate()
	{
		if (Auth::user() && Auth::user()->agent_status != 2) {
			return redirect('/dashboard');
		}

		$user = Auth::user();
		$closingDateQueryObj = new ClosingDateQuery;

		$forPost = $closingDateQueryObj
			->with('post', 'agent', 'agentdetails', 'buyerorseller', 'buyerorsellerdetails')
			->where([
				['agent_id', '=', $user->id],
				['status', '=', '1']
			])
			->first();

		if ($forPost != null) {
			$forPost = $forPost->toArray();
		}


		$view['forPost'] = $forPost;
		$view['user'] = $user = Auth::user();
		$view['userdetails'] = $userdetails = Userdetails::find($user->id);
		return view('dashboard.user.search.inputclosingdate', $view);
	}

	public function closingdatecronjob()
	{
		$allPosts = DB::table('agents_posts')
			->where([
				['closing_date', '!=', ''],
				['applied_user_id', '!=', '']
			])
			->get();

		foreach ($allPosts as $post) {
			$duration = 30;
			$selectedAgent = $post->applied_user_id;
			$lastSentMail = DB::table('closingdate_queries')
				->where([
					['post_id', '=', $post->post_id]

				])
				->orderBy('created_at', 'desc')
				->first();

			if (!empty($lastSentMail)) {
				$countingStartDate = $lastSentMail->created_at;
			} else {
				$countingStartDate = $post->agent_select_date;
			}

			$countingEndDate = date("d-m-Y", strtotime('+30 days', strtotime($countingStartDate)));
			$todayDate = strtotime(date("d-m-Y"));
			$diff = strtotime($countingEndDate) - $todayDate;


			if ($diff == 0) {
				$userDetails = DB::table('agents_users')
					->join('agents_users_details', 'agents_users.id', '=', 'agents_users_details.details_id')
					->where([['id', '=', $post->applied_user_id]])
					->first();

				/* Send email to agent. */
				$msg = "Dear ,{$userDetails->name}<br/>Your account has been temporary suspended please login to activate it.<br /><br /><br />Regards<br />92Agents.com";
				$acknowledgeMsgData = [
					'name' => 'Admin',
					'email' => 'Support@92agents.com',
					'message' => $msg,
					'receiver' => $userDetails->email
				];
				$acknowledgeMsgData['msg'] = $acknowledgeMsgData['message'];
				Mail::send('email.acknowledge', $acknowledgeMsgData, function ($message) use ($acknowledgeMsgData) {
					$message->to($acknowledgeMsgData['receiver'], '92Agents')
						->subject('Thanks to contact 92Agents');

					$message->from($acknowledgeMsgData['email'], $acknowledgeMsgData['name']);
				});

				/* Send email to agent. */

				/* Update agent's data. */
				$data = [
					'post_id' => $post->post_id,
					'agent_id' => $post->applied_user_id,
					'sellerorbuyer_id' => $post->agents_user_id,
					'sellerorbuyer_role' => $post->agents_users_role_id,
					'agent_role' => $post->agents_users_role_id,
					'select_date' => $post->agent_select_date,

				];
				$result = DB::table('closingdate_queries')->insert([
					$data
				]);

				if ($result) {
					DB::table('agents_users')
						->where('id', $post->applied_user_id)
						->update(['agent_status' => '2']);
				}


				/* Update agent's data. */
			}
		}
		exit;
	}

	public function inputclosingdatestore(Request $request)
	{

		if ($request->exists('donthaveclosingdate') && $request->donthaveclosingdate == 'on') {
			$rules = [
				'comments' => 'required',
			];
		} else {
			$rules = [
				'closing_date' => 'required',
			];
		}


		$user_id = Auth::user()->id;

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			if ($request->ajax()) {
				$res = [
					'status' => 2,
					'message' => 'Validation Failed',
					'errors' => $validator->errors()
				];
			} else {
				$res = [
					'status' => 2,
					'message' => 'Validation Failed',
					'errors' => $validator->errors()
				];
			}
			return response()->json($res);
		} //if validator fails
		$userObj = new User;
		$post = new Post;
		$user = $userObj->find(Auth::user()->id);
		$closingDateQueryObj = new ClosingDateQuery;

		if ($request->exists('donthaveclosingdate') && $request->donthaveclosingdate == 'on') {
			$data = [
				'comments' => $request->comments,
				'status' => 0,
			];


			$closingQueryObj = $closingDateQueryObj::find($request->closingqueryid);
			$result = $closingQueryObj->update($data);

			if ($result) {

				if ($user->update(['agent_status' => '1'])) {
					$res = [
						'status' => 1,
						'message' => 'Added Successfully',
						'alert_class' => 'alert-success',
						'alert_message' => 'Added Successfully',
					];
				} else {
					$res = [
						'status' => 2,
						'message' => 'Un-Successful Operation',
						'alert_class' => 'alert-danger',
						'alert_message' => 'Un-Successful Operation',
					];
				}
			} else {
				$res = [
					'status' => 2,
					'message' => 'Un-Successful Operation',
					'alert_class' => 'alert-danger',
					'alert_message' => 'Un-Successful Operation',
				];
			}
		} else {
			$data = [
				'closing_date' => $request->closing_date,
				'updated_at' => Carbon::now()->toDateTimeString()
			];

			$postDetails = $post->getAppliedPostsBySelectedAgent(Auth::user()->id);

			if ($postDetails == '' || $postDetails <= 5) {
				$data['agent_payment'] = 'completed';
				/* Save Payment Data */
				$transactionId = strtotime(date("d-m-y h:i:s")) . $request->postid . Auth::user()->id . rand(00000, 99999);
				$paymentDetails = [
					'amount' => 0.00,
					'discount' => 0.00,
					'taxes' => 0.00,
					'payment' => 'Stripe',
					'post_id' => $request->postid,
					'user_id' => Auth::user()->id,
					'transaction_id' => $transactionId,
					'stripe_order_no' => '',
					'created_at' => date("Y-m-d h:i:s"),
					'updated_at' => date("Y-m-d h:i:s")
				];
				DB::table('agents_payment')->insert($paymentDetails);
				/* Save Payment Data */
			}
			$postId = $post->find($request->postid);
			if ($postId->update($data)) {
				if ($user->update(['agent_status' => '1'])) {
					$res = [
						'status' => 1,
						'message' => 'Added Successfully',
						'alert_class' => 'alert-success',
						'alert_message' => 'Added Successfully',
					];
				} else {
					$res = [
						'status' => 2,
						'message' => 'Un-Successful Operation',
						'alert_class' => 'alert-danger',
						'alert_message' => 'Un-Successful Operation',
					];
				}
			} else {
				$res = [
					'status' => 2,
					'message' => 'Un-Successful Operation',
					'alert_class' => 'alert-danger',
					'alert_message' => 'Un-Successful Operation',
				];
			}
		}
		return response()->json($res);
	}

	/* For agent list info */
	public function agentslist(Request $request, $limit = null)
	{
		if (!AuthUser()) {
			return Resp::NoAuth();
		}

		$validator = Validator::make($request->all(), [
			'searchinputtype' => 'required|in:name,messages,questions_asked,questions_answered,answers',
			'date' => 'nullable|string|regex:/^\d{2}\/\d{2}\/\d{4}-\d{2}\/\d{2}\/\d{4}$/',
			'keyword' => 'nullable|string',
			'agents_users_role_id' => 'integer',
			'city' => 'nullable|integer',
			'state' => 'nullable|integer',  // Assuming state is an ID
			'zipcodes' => 'nullable|numeric|digits:5',
			'pricerange' => 'nullable|array',
			'address' => 'nullable|string',
		], [
			'searchinputtype.in' => 'Search Type values can only be: name, messages, questions_asked, questions_answered, or answers.',
			'date.regex' => 'Date Format must be: dd/mm/yyyy-dd/mm/yyyy',
		]);

		// print_r($validator->safe()); exit;

		if ($validator->fails()) {
			return Resp::InvalidRequest(validator: $validator);
		}

		Session::put('search_post', $validator->safe()->toArray());
		$user = new User;
		$result = $user->getSearchUsersByAny($limit, $request->all());
		
		return response()->json($result);
		
        // return Resp::Api(
        //     data: $result,
        //     misc: [],
        //     message: Resp::MESSAGE_FETCHED,
        //     code: Resp::OK,
		// 	need_count: true,
		// 	has_paginate: true
        // );
	}


	/* For agents detail show on the view page */
	public function agentsdetails(Request $request, $agent_id, $post_id=null)
	{
		$user = AuthUser();

        if (!$user || $user->agents_users_role_id == 4) {
			return redirect("/login?usertype=" . env("user_role_{$user->agents_users_role_id}"));
        }
		
		$post = Post::where('agents_user_id', $user->id)
			->where('agents_users_role_id', $user->agents_users_role_id)
			->where('applied_post', 2)
			->where('final_status', 0)
			->where('agents_posts.is_deleted', '0')
			->orderBy('agents_posts.created_at', 'DESC');

		if($post_id) {
			$post = $post->where('agents_posts.post_id', $post_id);
		}
		
		$post = $post->get();

		if (!count($post)) {
			return view('dashboard.user.buyers.no_post');
		}

		$view = [];
		$view['user'] = $user;
		$view['userdetails'] = Userdetails::find($user->id);
		$agent = new User;
		$view['agents'] = $agent->getuserdetailsByAny(['agents_users.id' => $agent_id]);

		if ($view['agents'] != null) {
			$state = new State;
	
			$view['state'] = $state->getStateByAny(['state_id' => $view['agents']->state_id, 'is_deleted' => '0', 'status' => '1'], 'first');
			$view['City'] = $state->getCityByAny(['city_id' => $view['agents']->city_id, 'is_deleted' => '0'], 'first');
		}

		$view['types'] = ($view['agents'] != null && $user->agents_users_role_id == 2) ? 'Buy' : 'Sell';

		$view['post'] = $post;

		$view['uri_segment'] = $request->segment(6) ?: '';
			
		$view['blog'] = DB::table('agents_review')->select('*')
			->join('agents_users_details', 'agents_review.sender_id', '=', 'agents_users_details.details_id')->where('agent_id', '=', $agent_id)->get();

		$view['avg'] = DB::table('agents_review')
			->where('agent_id', '=', $agent_id)
			->avg('star');

		$view['post_id'] = $post_id;
		$view['agent_id'] = $agent_id;
		return view('dashboard.user.search.agentsdetails', $view);
	}

	public function addcomment(Request $request)
	{
		$data = [];
		$id = Auth::user()->id;
		$agentid = $request->agent_id;
		$data = $request->all();
		$data['sender_id'] = $id;

		$query = DB::table('agents_review')->select('*')->where('agent_id', '=', $agentid)->where('sender_id', '=', $id)->count();

		if ($query == 0) {
			$qry = DB::table('agents_review')->insert($data);
			$data['success'] = 'ok';
		} else {
			$data['success'] = 'err';
		}

		return json_encode($data);
	}
}