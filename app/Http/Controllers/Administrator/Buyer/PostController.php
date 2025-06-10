<?php

namespace App\Http\Controllers\Administrator\Buyer;

use Carbon\Carbon;
use App\Helper\Resp;
use App\Models\City;
use App\Models\Post;
use App\Models\User;
use App\Models\State;
use App\Mail\CommonMail;
use App\Models\Userdetails;
use App\Events\eventTrigger;
use App\Models\Notification;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\AgentUserConnection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Symfony\Component\Mime\HtmlPart;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;
use Illuminate\Broadcasting\BroadcastException;

class PostController extends Controller
{
	public function addfeature(Request $request)
	{
		$id = $request->row_id;
		$ids = $id + 1;

		$html =
			'<label class="input" id="feature_$ids">
				<input type="text" class="best_features_$ids" id="best_features_$ids" name="best_features[]" value="" placeholder="">
				<i class="fa fa-trash-o trash_lab" id="$ids"></i>
			</label>';

		return $html;
	}

	public function index()
	{
		$user = Auth::user();
		$userdetails = Userdetails::find($user->id);

		$view = [
			'user' => $user,
			'userdetails' => $userdetails,
			'whendoyouwanttosell' => $this->whenDoYouWantToSell(),
			'homeType' => $this->homeType(),
		];

		return view('dashboard.user.buyers.post', $view);
	}

	public function validatepaymentamount(Request $request)
	{
		if ($request->exists('id')) {
			$paymentDataTemp = Session::get('paymentData');
			$paymentData = $paymentDataTemp[0];
			$stripe = new Stripe('sk_test_51Hso8eG631bdjDJFSCuMDFppsnwqfyX4JrYkoetLjz80L3XASjA7A8FieEBYZcETPOjaFTEgqOwfvL5ifSDXdtl600WOjgKSYz');
			$amount = $paymentData['amount'];

			try {
				$post_id = $paymentData['post_id'];

				if (!str_contains($post_id, ",")) {
					$post = new Post();
					$post_sell_details = $post->getSellDetails($post_id, Auth::user()->id);

					if (isset($post_sell_details[0])) {
						$sell_details = $post_sell_details[0];
						$agent_comission = $sell_details->agent_comission;
						$commission_rate = $sell_details->comission_92agent;
						$agent_commission_amount = (($agent_comission / 100) * $sell_details->sale_price);
						$our_commision = (($commission_rate / 100) * $agent_commission_amount);
						$our_commision = number_format((float) $our_commision, 2, '.', '');

						if ($amount != (string) $our_commision) {
							$data = ['status' => 0, 'msg' => 'Payment Failed because of wrong payment amount.'];
							Session::forget('paymentData');
							return response()->json($data);
						}
					} else {
						$data = ['status' => 0, 'msg' => 'Payment Failed because of wrong data.'];
						Session::forget('paymentData');
						return response()->json($data);
					}

					$charge = $stripe->charges()->create([
						'amount' => $amount,
						'currency' => 'usd',
						'description' => "{$commission_rate}% Agent Charges paying to agent",
						'source' => $request->id,
					]);

					if ($charge['status'] == 'succeeded') {
						$transactionId = strtotime(date("d-m-y h:i:s")) . $request->post_id . Auth::user()->id . rand(00000, 99999);
						$paymentDetails = [
							'amount' => $amount,
							'discount' => 0.00,
							'taxes' => 0.00,
							'payment' => 'Stripe',
							'post_id' => $paymentData['post_id'],
							'user_id' => Auth::user()->id,
							'transaction_id' => $transactionId,
							'stripe_order_no' => $charge['id'],
							'created_at' => date("Y-m-d h:i:s"),
							'updated_at' => date("Y-m-d h:i:s")
						];

						if (DB::table('agents_payment')->insert($paymentDetails)) {
							DB::table('agents_posts')->where('post_id', $paymentData['post_id'])->update(['agent_payment' => 'completed']);
							$data = ['status' => 1, 'msg' => "\${$paymentData['amount']} amount has been sent to agent successfully."];
							Session::forget('paymentData');
							return response()->json($data);
						} else {
							$data = [
								'status' => 1,
								'msg' => "{$paymentData['amount']}\$ amount has been sent."
							];
							Session::forget('paymentData');
							return response()->json($data);
						}
					} else {
						$data = ['status' => 0, 'msg' => 'Payment Failed because of some internal error.'];
						Session::forget('paymentData');
						return response()->json($data);
					}
				} else {
					$post_id_arr = explode(',', $post_id);
					$post = new Post();
					$total_amount = 0;

					foreach ($post_id_arr as $post_id) {
						$post_sell_details = $post->getSellDetails($post_id, Auth::user()->id);

						if (isset($post_sell_details[0])) {
							$sell_details = $post_sell_details[0];
							$agent_comission = $sell_details->agent_comission;
							$commission_rate = $sell_details->comission_92agent;
							$agent_commission_amount = (($agent_comission / 100) * $sell_details->sale_price);
							$our_commision = (($commission_rate / 100) * $agent_commission_amount);
							$total_amount += $our_commision;
						} else {
							// mail for wrong data
						}
					}

					$total_amount = number_format((float) $total_amount, 2, '.', '');

					if ($amount != (string) $total_amount) {
						$data = ['status' => 0, 'msg' => 'Payment Failed because of wrong payment amount.'];
						Session::forget('paymentData');
						return response()->json($data);
					}

					$charge = $stripe->charges()->create([
						'amount' => $amount,
						'currency' => 'usd',
						'description' => 'Agent Charges paying to 92agent',
						'source' => $request->id,
					]);

					if ($charge['status'] == 'succeeded') {
						$transactionId = strtotime(date("d-m-y h:i:s")) . Auth::user()->id . rand(00000, 99999);
						$paymentDetails = [
							'amount' => $amount,
							'discount' => 0.00,
							'taxes' => 0.00,
							'payment' => 'Stripe',
							'post_id' => $paymentData['post_id'],
							'user_id' => Auth::user()->id,
							'transaction_id' => $transactionId,
							'stripe_order_no' => $charge['id'],
							'created_at' => date("Y-m-d h:i:s"),
							'updated_at' => date("Y-m-d h:i:s")
						];

						if (DB::table('agents_payment')->insert($paymentDetails)) {
							foreach ($post_id_arr as $post_id) {
								$update = DB::table('agents_posts')->where('post_id', $post_id)->update(['agent_payment' => 'completed']);
							}

							$data = ['status' => 1, 'msg' => "\${$paymentData['amount']} amount has been sent to agent successfully."];
							Session::forget('paymentData');

							return response()->json($data);
						} else {
							$data = ['status' => 0, 'msg' => 'Payment Failed because of some internal error.'];
							Session::forget('paymentData');
							return response()->json($data);
						}
					} else {
						$data = ['status' => 0, 'msg' => 'Payment Failed because of some internal error.'];
						Session::forget('paymentData');
						return response()->json($data);
					}
				}
			} catch (\Exception $e) {
				$data = ['status' => 0, 'msg' => 'Payment Failed because of some internal error.'];
				Session::forget('paymentData');
				return response()->json($data);
			}
		}

		$rules = ['amount' => 'required|regex:/^[1-9]\d*(\.\d+)?$/'];
		$validator = Validator::make(['amount' => $request->amount], $rules);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()]);
		} else {
			$this->amount = $request->amount;
			Session::push('paymentData', $request->input());
			return response()->json(["status" => 2, "msg" => "You can make payment."]);
		}
	}

	public function ComparePost()
	{
		$user = Auth::user();
		$userdetails = Userdetails::find($user->id);
		$view = [
			'user' => $user,
			'userdetails' => $userdetails
		];

		return view('dashboard.user.buyers.compareposts', $view);
	}

	public function PostDetailsForBuyer(Request $request, $post_id = null, $compare = null)
	{
		if (!$user = AuthUser()) {
			return redirect('/login');
		}

		$city = City::where([
			'city_id' => $user->details->city_id,
			'is_deleted' => '0'
		])->first();

		$post = new Post;
		$postDetails = $post->getDetailsBypostid([
			'agents_posts.post_id' => $post_id,
			'agents_posts.status' => '1'
		]);

		$types = $postDetails->agents_users_role_id == 2 ? 'Buy' : 'Sell';
		$selected_agent = '';

		if ($postDetails->applied_post == 1) {
			$selected_agent = $post->getSelectedDetailsByAny(0, ['agents_posts.post_id' => $postDetails->post_id], 'first');
			$getAppliedPostsBySelectedAgent = $post->getAppliedPostsBySelectedAgent($selected_agent->applied_user_id);
		}

		$notes_history = DB::table('agents_notes')->select('*')
			->where(['notes_type' => 5, 'notes_item_parent_id' => $post_id, 'sender_id' => $user->id])
			->get();


		$page_data = [
			'user' => $user,
			'city' => $city,
			'post' => $postDetails,
			'types' => $types,
			'selected_agent' => $selected_agent,
			'compare' => $compare,
			'notes_history' => $notes_history
		];

		if (!$request->is('api/*')) {
			return view('dashboard.user.buyers.postdetails', $page_data);
		} else {
			return response()->json(["status" => true, "msg" => "Details Fetched successfully.", "data" => $page_data]);
		}
	}

	public function addClosingDate(Request $request)
	{
		$rules = [
			'closing_date' => 'required|date_format:d/m/Y|after:' . Carbon::now()->format('d/m/Y'),
		];

		$validator = Validator::make([
			'closing_date' => $request->closing_date,
		], $rules);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()]);
		}

		$post = Post::find($request->post_id);
		$post->closing_date = Carbon::createFromFormat('d/m/Y', $request->closing_date)->format('Y-m-d');
		$post->updated_at = Carbon::now()->toDateTimeString();
		$postObj = new Post;
		$postDetails = $postObj->getAppliedPostsBySelectedAgent($request->agent_id);


		if ($postDetails == '' || $postDetails <= 5) {
			$transactionId = strtotime(date("d-m-y h:i:s")) . $request->post_id . Auth::user()->id . rand(00000, 99999);
			$paymentDetails = [
				'amount' => 0.00,
				'discount' => 0.00,
				'taxes' => 0.00,
				'payment' => 'Stripe',
				'post_id' => $request->post_id,
				'user_id' => Auth::user()->id,
				'transaction_id' => $transactionId,
				'stripe_order_no' => '',
				'created_at' => date("Y-m-d h:i:s"),
				'updated_at' => date("Y-m-d h:i:s")
			];

			DB::table('agents_payment')->insert($paymentDetails);
		}

		if ($post->save()) {
			return response()->json(["statys" => 2, "msg" => "Closing date added successfully."]);
		}

		return response()->json(["statys" => 1, "msg" => ['error' => 'Please try again in a few minutes.']]);
	}

	public function PostDetailsAgentsGetForBuyer($limit, $post_id, $userid, $roleid)
	{
		$post = new Post;
		$result = $post->AppliedAgentsListGetForBuyer($limit, $post_id, $userid, $roleid);
		return response()->json($result);
	}

	public function PostDetailsAgentsGetForBuyerlimitfive($post_id, $userid, $roleid)
	{
		$post = new Post;
		$result = $post->AppliedAgentsListGetForBuyerlimitfive($post_id, $userid, $roleid);
		return response()->json($result);
	}

	public function unique_multidim_array($array, $key)
	{
		$temp_array = [];
		$i = 0;
		$key_array = [];

		foreach ($array as $sval) {
			$val = (array) $sval;
			if (!in_array($val[$key], $key_array)) {
				$key_array[$i] = $val[$key];
				$temp_array[$i] = (object) $val;
			}
			$i++;
		}

		return (object) $temp_array;
	}

	public function store(Request $request)
	{
		$commonRules = [
			'agents_user_id' => 'required',
			'agents_users_role_id' => 'required',
			'post_title' => 'required',
			'details' => 'required',
			'post_type' => ['required', 'digits:1', Rule::in([1, 2, 3, 4])],
			'state' => 'required',
			'city' => 'required',
			'need_cash_back' => 'required|digits:1',
			'buy_or_sell_by' => ['required', Rule::in(['Now', 'Within 30 Days', 'Within 90 Days', 'Undecided'])],
			'address_2' => 'nullable',
			'best_features' => 'nullable|array',
			'best_features.*' => 'nullable|string',
			'id' => 'nullable|integer'
		];

		$commonMessages = [
			'post_title.required' => 'The Post Title field is required',
			'state.required' => 'The State field is required',
			'city.required' => 'The City field is required',
		];

		if ($request->post_type == 3) {
			$rules = array_merge($commonRules, [
				'address_1' => 'required',
				'zip' => 'required|digits:5|numeric',
				'interested_short_sale' => 'nullable',
				'short_sale_lender_approval' => 'nullable'
			]);

			$messages = array_merge($commonMessages, [
				'address_1.required' => 'The Address Line 1 field is required',
				'details.required' => 'The Property Details field is required',
				'zip.required' => 'The zip code field is required',
			]);
		} else {
			$rules = array_merge($commonRules, [
				'area' => 'required',
				'price_range' => 'required',
				'home_type' => 'required',
				'zip' => 'required|array',
				'zip.*' => 'required|digits:5|numeric',
				'firsttime_home_buyer' => 'nullable',
				'do_u_have_a_home_to_sell' => 'nullable',
				'if_so_do_you_need_help_selling' => 'nullable',
				'interested_in_buying' => 'nullable',
				'bids_emailed' => 'nullable',
				'do_you_need_financing' => 'nullable'
			]);

			$messages = array_merge($commonMessages, [
				'details.required' => 'The specific requirements field is required',
				'area.required' => 'The suburb / neighborhood field is required',
				'home_type.required' => 'The Home Type Field is Required',
				'zip.required' => 'The zip code field is required',
			]);
		}

		$validator = Validator::make($request->all(), $rules, $messages);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 422);
		}

		$commonData = [
			'posttitle' => $request->post_title,
			'details' => $request->details,
			'city' => $request->city,
			'state' => $request->state,
			'when_do_you_want_to_sell' => $request->buy_or_sell_by,
			'home_type' => $request->home_type,
			'agents_users_role_id' => $request->agents_users_role_id,
			'agents_user_id' => $request->agents_user_id,
		];

		if ($request->post_type == 3) {
			$postdetailsnew = array_merge($commonData, [
				'address1' => $request->address_1,
				'address2' => $request->address_2,
				'zip' => $request->zip,
				'need_cash_back' => $request->need_cash_back,
				'interested_short_sale' => $request->interested_short_sale,
				'got_lender_approval_for_short_sale' => $request->short_sale_lender_approval,
				'best_features' => json_encode($request->best_features),
			]);

			$words = trim(DB::table('agents_bad_contents')->select('words')->pluck('words')->first());

			if ($words != "") {
				$str = explode(',', $words);
				foreach ($str as $value) {
					if (preg_match("/$value/", $postdetailsnew['details'])) {
						return response()->json(['bad' => 'please enter post']);
					}
				}
			}
		} else {
			$postdetailsnew = array_merge($commonData, [
				'area' => $request->area,
				'price_range' => $request->price_range,
				'firsttime_home_buyer' => $request->firsttime_home_buyer ?: '0',
				'do_u_have_a_home_to_sell' => $request->do_u_have_a_home_to_sell ?: '0',
				'if_so_do_you_need_help_selling' => $request->if_so_do_you_need_help_selling ?: '0',
				'interested_in_buying' => $request->interested_in_buying ?: '0',
				'bids_emailed' => $request->bids_emailed,
				'do_you_need_financing' => $request->do_you_need_financing,
				'need_cash_back' => $request->need_cash_back,
			]);

			if (!empty($request->zip) && $request->zip != '') {
				$value = [];
				$alfa = [];

				foreach ($request->zip as $element) {
					is_numeric($element) ? $value[] = $element : $alfa = $element;
				}


				if (empty($alfa)) {
					$count = array_count_values($value);

					if (count($count) == 5) {
						$postdetailsnew['zip'] = rtrim(implode(',', $value), ',');
					} else {
						return response()->json(['ziperr' => "Please add all 5 zip codes"], 422);
					}
				} else {
					return response()->json(['alfa_err' => "Please fill only numeric values."], 422);
				}
			} else {
				return response()->json(['ziperr' => "Please add zip code."], 422);
			}
		}

		$postdetailsnew['post_type'] = $request->post_type;
		$Post = new Post;

		if (empty($request->id)) {
			$postdetailsnew['created_at'] = Carbon::now()->toDateTimeString();
			$post_id = $Post->inserupdate($postdetailsnew);
			$this->CheckAlreadyConnectedUserSendNotification($postdetailsnew, $post_id);
			return response()->json(["msg" => "Your post has been added successfully"]);
		} else {
			$postdetailsnew['updated_at'] = Carbon::now()->toDateTimeString();
			$Post->inserupdate($postdetailsnew, ['post_id' => $request->id]);
			return response()->json(["msg" => "Your post has been updated successfully"]);
		}
	}

	public function getpostsingalByAny(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'agents_user_id' => 'required',
			'agents_users_role_id' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 422);
		}

		$Post = new Post;
		$records = $Post->getpostsingalByAny([
			'is_deleted' => '0',
			'agents_user_id' => $request->agents_user_id,
			'agents_users_role_id' => $request->agents_users_role_id,
			'status' => 1
		]);

		return Resp::Api(
			data: $records,
			message: Resp::MESSAGE_FETCHED,
			need_count: true,
			has_paginate: true,
		);
	}

	public function getpostmultipalByAny(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'agents_user_id' => 'required',
			'agents_users_role_id' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 422);
		}

		$Post = new Post;
		$result = $Post->getpostmultipalByAny(['is_deleted' => '0', 'agents_user_id' => $request->agents_user_id, 'agents_users_role_id' => $request->agents_users_role_id]);
		return response()->json($result);
	}

	public function getDetailsByAny(Request $request, $limit = 20)
	{
		$validator = Validator::make($request->all(), []);

		if ($validator->fails()) {
			return Resp::InvalidRequest(validator: $validator);
		}

		$user = AuthUser();

		$where = [
			'agents_posts.agents_user_id' => $user->id,
			'agents_posts.agents_users_role_id' => $user->agents_users_role_id,
			'agents_posts.status' => '1'
		];

		if ($request->selectedpost && !empty($request->selectedpost)) {
			$where['agents_posts.applied_post'] = $request->selectedpost;
		}

		$Post = new Post;
		$records = $Post->getDetailsByAny($limit, $where, $request->page ?? 1);

		return Resp::Api(
			data: $records,
			message: Resp::MESSAGE_FETCHED,
			need_count: true,
			has_paginate: true,
		);
	}


	public function getSelectedDetailsByAny(Request $request, $limit)
	{
		$Post = new Post;

		$result = $Post->getSelectedDetailsByAny($limit, [
			'agents_posts.status' => '1',
			'agents_posts.is_deleted' => '0',
			'agents_posts.agents_user_id' => $request->agents_user_id,
			'agents_posts.agents_users_role_id' => $request->agents_users_role_id
		]);

		return response()->json($result);
	}

	public function delete($id)
	{
		$Post = Post::find($id);
		$Post->is_deleted = '1';

		if ($Post->save()) {
			return response()->json(["status" => 'success', "msg" => "Your Post successfully Delete!"]);
		} else {
			return response()->json(["status" => 'error', "msg" => 'Please try again in a few minutes.']);
		}
	}

	public function CheckAlreadyConnectedUserSendNotification($postdetailsnew, $post_id)
	{
		$query1 = DB::table('agents_users_conections');

		if ($postdetailsnew != null) {
			$query1->where(function ($query) use ($postdetailsnew) {
				$query->where(['to_id' => $postdetailsnew['agents_user_id'], 'to_role' => $postdetailsnew['agents_users_role_id']]);
			})->orWhere(function ($query) use ($postdetailsnew) {
				$query->where(['from_id' => $postdetailsnew['agents_user_id'], 'from_role' => $postdetailsnew['agents_users_role_id']]);
			});
		}

		$query1->select(
			'post_id',
			DB::raw("(CASE WHEN to_id = {$postdetailsnew['agents_user_id']} AND to_role = {$postdetailsnew['agents_users_role_id']} THEN from_role  WHEN from_id = {$postdetailsnew['agents_user_id']}  AND from_role = {$postdetailsnew['agents_users_role_id']} THEN to_role END) AS role_id"),
			DB::raw("(CASE WHEN to_id = {$postdetailsnew['agents_user_id']} AND to_role = {$postdetailsnew['agents_users_role_id']} THEN from_id  WHEN from_id = {$postdetailsnew['agents_user_id']}  AND from_role = {$postdetailsnew['agents_users_role_id']} THEN to_id END) AS id")
		);

		$query1->orderBy('created_at', 'DESC');
		$result = $query1->get();
		$count = count($result);

		$userdd = DB::table('agents_users_details')
			->select('*')
			->where(['details_id' => $postdetailsnew['agents_user_id']])
			->first();

		if (!empty($count) && $count != 0) {
			$result_filtered = $this->unique_multidim_array($result, 'id');

			foreach ($result_filtered as $value) {
				$notifiy = [
					'sender_id' => $postdetailsnew['agents_user_id'],
					'sender_role' => $postdetailsnew['agents_users_role_id'],
					'receiver_id' => $value->id,
					'receiver_role' => $value->role_id
				];

				try {
					$notifiy['notification_type'] = 12;
					$notifiy['notification_message'] = "{$userdd->name} upload a new post({$postdetailsnew['posttitle']})";
					$notifiy['notification_item_id'] = $post_id;
					$notifiy['notification_child_item_id'] = $value->id;
					$notifiy['status'] = 1;
					$notifiy['updated_at'] = Carbon::now()->toDateTimeString();
					DB::table('agents_notification')->insertGetId($notifiy);
					event(new eventTrigger([$notifiy, $value, 'NewNotification']));
				} catch (\Exception $e) {
				} catch (\Throwable $th) {
				} catch (BroadcastException $brExe) {
				}
			}
		}
	}

	// function h() {
	// 	// AppliedAgents
	// 	$where = [
	// 		'sender_id' => "Post Owner",
	// 		'sender_role' => "Post Owner Role",
	// 		'receiver_id' => "Agent",
	// 		'receiver_role' => "Agent Role",
	// 		'notification_type' => 13,
	// 		'notification_message' => "{$userdetails->name} select you for post ({$post->posttitle})",
	// 		'notification_item_id' => $post_id,
	// 		'notification_post_id' => $post_id,
	// 		'notification_child_item_id' => $agentdata->id,
	// 		'created_at' => Carbon::now()->toDateTimeString(),
	// 		'updated_at' => Carbon::now()->toDateTimeString()
	// 	];

	// 	// publicConnection
	// 	$notificationData = [
	// 		'sender_id' => $request->to_id,
	// 		'sender_role' => $request->to_role,
	// 		'receiver_id' => $request->from_id,
	// 		'receiver_role' => $request->from_role,
	// 		'notification_type' => 11,
	// 		'notification_message' => "{$sellerDetails->name} contact related to post({$postDetails->posttitle})",
	// 		'notification_item_id' => $newConnectionId,
	// 		'notification_child_item_id' => $request->post_id,
	// 		'status' => 1,
	// 		'updated_at' => $now,
	// 	];

	// }

	public function SelectAgentForPost(Request $request)
	{
		$client = Auth::user();

		$validator = Validator::make($request->all(), [
			'post_id' => "required|exists:agents_posts,post_id",
			'agent_id' => "required|exists:agents_users,id",
		]);

		if ($validator->fails()) {
			return Resp::InvalidRequest(validator: $validator);
		}

		// Request Vars
		$post_id = $request->post_id;
		$agent_id = $request->agent_id;

		// Post Vars
		$post = Post::where('post_id', $post_id)
			->where('is_deleted', 0)
			->first();

		$post_id = ucwords($post->post_id);
		$post_title = ucwords($post->posttitle);
		$post_address = ucwords($post->address1);

		$now = Carbon::now();

		// Client Vars
		$client = User::with('details')->find($client->id);
		$client_id = $client->id;
		$client_name = ucwords($client->details->name);
		$client_role_id = $client->agents_users_role_id;

		// Agent Vars
		$agent = User::with('details')->find($agent_id);
		$agent_id = $agent->id;
		$agent_name = ucwords($agent->details->name);
		$agent_role_id = $agent->agents_users_role_id;
		$agent_mail = $agent->mail;

		$post->applied_post = '1'; // 1 for Yes
		$post->applied_user_id = $agent_id;
		$post->final_status = 1;
		$post->updated_at = $now; // Carbon::now()->toDateTimeString()
		$post->agent_select_date = $now; // Carbon::now()->toDateTimeString()
		$post->cron_time = $now; // Carbon::now()->toDateTimeString()
		$post->save();

		// ==================================================

		$updated = AgentUserConnection::where(function ($query) use ($post_id, $agent_id, $agent_role_id, $client_id, $client_role_id) {
			$query->where([
				'post_id' => $post_id,

				'from_id' => $agent_id,
				'from_role' => $agent_role_id,

				'to_id' => $client_id,
				'to_role' => $client_role_id,
			]);
		})->orWhere(function ($query) use ($post_id, $agent_id, $agent_role_id, $client_id, $client_role_id) {
			$query->where([
				'post_id' => $post_id,

				'from_id' => $client_id,
				'from_role' => $client_role_id,

				'to_id' => $agent_id,
				'to_role' => $agent_role_id,
			]);
		})->touch();

		$newConnectionId = null;

		if (!$updated) { // Insert only if no existing record was updated
			$newConnectionId = AgentUserConnection::insertGetId([
				'post_id' => $post_id,

				'from_id' => $agent_id,
				'from_role' => $agent_role_id,

				'to_id' => $client_id,
				'to_role' => $client_role_id,

				'updated_at' => $now,
				'created_at' => $now
			]);
			$newConnectionCreated = true;
		} else {
			$newConnectionCreated = false;
		}

		if ($newConnectionCreated && $client && $agent) {
			$notificationData = [
				'sender_id' => $client_id,
				'sender_role' => $client_role_id,

				'receiver_id' => $agent_id,
				'receiver_role' => $agent_role_id,

				'notification_type' => 11,
				'notification_message' => "{$client_name} contact related to post({$post_title})",
				'notification_item_id' => $newConnectionId,
				'notification_child_item_id' => $post_id,

				'status' => 1,
				'updated_at' => $now,
			];

			Notification::create($notificationData);

			event(new EventTrigger([$notificationData, $newConnectionId, 'NewNotification'])); // Pass $notificationData directly
		}

		DB::table('agents_selldetails')->insertGetId([
			'sellers_name' => $client_name,
			'address' => $post_address,
			'post_id' => $post_id,
			'agent_id' => $agent_id,
			'agent_comission' => 3,
			'comission_92agent' => 1,
		]);

		// ==================================================

		// Notify Condition Array
		$notify_condition = [
			'sender_id' => $client_id,
			'sender_role' => $client_role_id,

			'receiver_id' => $agent_id,
			'receiver_role' => $agent_role_id,

			'notification_type' => 13,
			'notification_message' => "{$client_name} selected you for: ({$post_title})",
			'notification_item_id' => $post_id,
			'notification_post_id' => $post_id,
			'notification_child_item_id' => $agent_id,

			'created_at' => $now, // Carbon::now()->toDateTimeString()
			'updated_at' => $now, // Carbon::now()->toDateTimeString()
		];

		$notification = new Notification;
		$result = $notification->inserupdate($notify_condition);

		event(new eventTrigger([$notify_condition, $result, 'NewNotification']));

		// ==================================================

		$post_link = url("/search/post/details/$post_id/13"); // 13 is Notification Type.. See web routes

		// JkWorkz
		// Send email
		Mail::to(users: $agent_mail)
			->send(new CommonMail(
				subject: "You are selected for a post: $post_title",
				title: "Hello $agent_name,",
				body: "$client_name selected you for a post: $post_title\n<a href='$post_link' target='_blank'>Click Here to open the post.<a/>",
			));

		// ==================================================

		return response()->json($result);
	}

	public function AppliedAgents($post_id = null, $agentid = null)
	{
		$user = Auth::user();
		$userdetails = Userdetails::find($user->id);

		$post = Post::find($post_id);
		$post->applied_post = '1';
		$post->applied_user_id = $agentid;
		$post->final_status = 1;
		$post->updated_at = Carbon::now()->toDateTimeString();
		$post->agent_select_date = Carbon::now()->toDateTimeString();
		$post->cron_time = Carbon::now()->toDateTimeString();
		$post->save();

		$user = new User;

		$agentdata = $user->getDetailsByEmailOrId(['id' => $agentid]);

		$where = [
			'sender_id' => $post->agents_user_id,
			'sender_role' => $post->agents_users_role_id,
			'receiver_id' => $agentdata->id,
			'receiver_role' => $agentdata->agents_users_role_id,
			'notification_type' => 13,
			'notification_message' => "{$userdetails->name} select you for post ({$post->posttitle})",
			'notification_item_id' => $post_id,
			'notification_post_id' => $post_id,
			'notification_child_item_id' => $agentdata->id,
			'created_at' => Carbon::now()->toDateTimeString(),
			'updated_at' => Carbon::now()->toDateTimeString()
		];

		$notification = new Notification;
		$result = $notification->inserupdate($where);

		event(new eventTrigger([$where, $result, 'NewNotification']));

		$agent_email = $agentdata->email;
		$agent_name = ucwords($agentdata->name);
		$client_name = ucwords($userdetails->name);
		$post_title = ucwords($post->posttitle);
		$post_link = url("/search/post/details/$post_id/13"); // 13 is Notification Type.. See web routes

		// JkWorkz
		// Send email
		Mail::to(users: $agent_email)
			->send(new CommonMail(
				subject: "You are selected for a post: $post_title",
				title: "Hello $agent_name,",
				body: "$client_name selected you for a post: $post_title\n<a href='$post_link' target='_blank'>Click Here to open the post.<a/>",
			));

		return response()->json($result);
	}

	public function whenDoYouWantToSell($type = null)
	{
		return [
			['id' => 'now', 'option' => 'now'],
			['id' => 'within 30 days', 'option' => 'within 30 days'],
			['id' => 'within 90 days', 'option' => 'within 90 days'],
			['id' => 'undecided', 'option' => 'undecided']
		];
	}

	public function homeType($type = null)
	{
		return [
			['id' => 'single_family', 'option' => 'Single Family'],
			['id' => 'condo_townhome', 'option' => 'Condo Townhome'],
			['id' => 'multi_family', 'option' => 'Multi Family'],
			['id' => 'manufactured', 'option' => 'Manufactured'],
			['id' => 'lots_land', 'option' => 'Lots/Land']
		];
	}

	public function showdoc(Request $request)
	{
		$data = [
			'shared_item_type_id' => $request->postid,
			'sender_id' => $request->userid,
			'receiver_id' => $request->agentid
		];

		$query = DB::table('agents_upload_share_all as a')
			->select('a.attachments')
			->join('agents_shared', 'shared_item_id', '=', 'a.upload_share_id')
			->where($data)
			->first();

		return json_encode($query);
	}

	public function selldetails(Request $request)
	{
		$agent_comission = $request->agent_comission ?: 3;
		$comission_92agent = $request->comission_92agent ?: 3;
		$insert_arr = [
			'sellers_name' => $request->sellers_name,
			'address' => $request->address,
			'sale_date' => date('Y-m-d h:i:s', strtotime($request->sale_date)),
			'sale_price' => $request->sale_price,
			'post_id' => $request->post_id,
			'agent_id' => $request->selected_agent,
			'agent_comission' => $agent_comission,
			'comission_92agent' => $comission_92agent,
		];

		$selldetail_id = DB::table('agents_selldetails')->insertGetId($insert_arr);

		if ($selldetail_id) {
			$view = ['c_status' => 'success', 'c_message' => 'Sell details updated successfully'];
		} else {
			$view = ['c_status' => 'failed', 'c_message' => 'Failed to update sell details'];
		}

		return redirect(url()->previous())->with($view);
	}
}