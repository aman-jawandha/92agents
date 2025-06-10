<?php

namespace App\Http\Controllers\Administrator\Search;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\State;
use App\Models\User;
use App\Models\Userdetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class BuyerSearchController extends Controller
{

	/* For buyers and seller psot's */
	public function index()
	{
		if (!Auth::user() || Auth::user()->agents_users_role_id != 4) {
			return redirect('/login?usertype=' . env("user_role_" . Auth::user()->agents_users_role_id));
		}
		
		$response = $this->checkProfileCompletion(Auth::user()->id);

		if ($response == 0) {
			Session::flash('profileCompletion', 'Yes');
			return redirect('profile/agent/personal');
		}

		$state = new State;
		$view = [];
		$view['user'] = $user = Auth::user();
		$view['userdetails'] = Userdetails::find($user->id);
		$view['city'] = $state->getCityByAny(['is_deleted' => '0']);
		$view['state'] = $state->getStateByAny(['is_deleted' => '0', 'status' => '1']);
		$view['search_post'] = Session::has('search_post') ? Session::get('search_post') : [];

		return view('dashboard.user.search.postsearch', $view);
	}

	/* Post for agents */
	public function postForAgents(Request $request)
	{
		$user_id = $request->userId;
		$query = DB::table('agents_users_details')->where('details_id', $user_id)->get();

		$office_address = $query[0]->office_address;
		$state = $query[0]->state_id;
		$city = $query[0]->city_id;
		$licence = $query[0]->licence_number;
		$experience = $query[0]->years_of_expreience;
		$broker_name = $query[0]->brokers_name;
		$contractVerification = $query[0]->contract_verification;

		if (!empty($office_address) && !empty($state) && !empty($city) && !empty($licence) && !empty($experience) && !empty($broker_name)) {
			return $contractVerification == 2 ? 2 : 1;
		} else {
			return 0;
		}
	}

	public function checkProfileCompletion($userId)
	{
		$user_id = $userId;
		$query = DB::table('agents_users_details')->where('details_id', $user_id)->get();

		$office_address = $query[0]->office_address;
		$state = $query[0]->state_id;
		$city = $query[0]->city_id;
		$licence = $query[0]->licence_number;
		$experience = $query[0]->years_of_expreience;
		$broker_name = $query[0]->brokers_name;
		$contractVerification = $query[0]->contract_verification;

		if (!empty($office_address) && !empty($state) && !empty($city) && !empty($licence) && !empty($experience) && !empty($broker_name) && $contractVerification == 2) {
			return 1;
		} else {
			return 0;
		}
	}

	/* Post list info  */
	public function postlist(Request $request, $limit = null)
	{
		Session::put('search_post', $request->all());
		$post = new Post;
		$result = $post->getSearchAnyByAny($limit, $request->all());
		return response()->json($result);
	}

	/* For post details info show inside the post detail view */
	public function postdetails(Request $request, $id)
	{
		if (Auth::user() && Auth::user()->agents_users_role_id == 4) {
			if (empty($id)) {
				return redirect()->back();
			}

			$view = [];
			$view['user'] = $user = Auth::user();
			$view['userdetails'] = $userdetails = Userdetails::find($user->id);
			$post = new Post;
			$view['post'] = $post->getDetailsBypostid(['agents_posts.post_id' => $id]);


			if ($view['post']->agents_users_role_id == 2) {
				$view['types'] = 'Buy';
			} else {
				$view['types'] = 'Sell';
			}

			$review = DB::table('agents_rating')->where(['rating_item_parent_id' => $id, 'rating_item_id' => Auth::user()->id])->first();
			$view['review'] = $review;

			$getAppliedPostsBySelectedAgent = $post->getAppliedPostsBySelectedAgent($view['post']->applied_user_id);

			if ($view['post']->agent_payment != 'completed' && $view['post']->closing_date != '') {
				$view['agentPaymentStatus'] = true;
			} else {
				$view['agentPaymentStatus'] = false;
			}

			# notes history
			$notes_history = DB::table('agents_notes')
				->select('*')
				->where(['notes_type' => 5, 'notes_item_parent_id' => $id, 'sender_id' => $user->id])
				->get();
			$view['notes_history'] = $notes_history;


			$view['uri_segment'] = $request->segment(5) ? $request->segment(5) : '';

			return view('dashboard.user.search.postdetails', $view);
		} else {
			return redirect('/login?usertype=' . env("user_role_" . Auth::user()->agents_users_role_id));
		}
	}

	/*buyer seller details show and get post list*/
	public function buyerdetails($id, $roleid)
	{
		if (!Auth::user() || Auth::user()->agents_users_role_id != 4) {
			return redirect('/login?usertype=' . env("user_role_" . Auth::user()->agents_users_role_id));
		}
		
        // $validator = Validator::make($request->all(), [
        //     'agents_user_id' => 'required',
        //     'agents_users_role_id' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return Resp::InvalidRequest(validator: $validator);
        // }

		$view = [];
		$view['user'] = $user = Auth::user();
		$view['userdetails'] = Userdetails::find($user->id);

		$user = new User;

		$view['buyer'] = $user->getuserdetailsByAny(['agents_users.id' => $id]);


		if ($roleid == 2) {
			$view['types'] = 'Buy ';
		} else {
			$view['types'] = 'Sell ';
		}

		$view['roleid'] = $roleid;

		return view('dashboard.user.search.buyerdetails', $view);
	}

	public function switchuser(Request $request)
	{
		$data = [];
		$userid = $request->userId;
		$data['agents_users_role_id'] = $request->role;
		$query = DB::table('agents_users')->where('id', $userid)->update($data);
		return response()->json(["result" => $query]);
	}
}