<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Agentskills;
use App\Models\Post;
use App\Models\State;
use App\Models\User;
use App\Models\Userdetails;
use App\Models\AgentPost;
use App\Models\Notification;
use App\Models\AgentUserConnection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Events\eventTrigger;

class ProfileController extends Controller
{
	public function __construct()
	{
	}

	/* For get agents info */
	public function agent(Request $request)
	{
		if (Auth::user()) {
			$view['user'] = $user = Auth::user();
			$view['userdetails'] = $userdetails = Userdetails::find($user->id);
			$skillsarray = explode(',', $view['userdetails']->skills);

			$view['userdetails']->skills = DB::table('agents_users_agent_skills')
				->whereIn('skill_id', $skillsarray)
				->get();
			$view['agentskills'] = DB::table('agents_users_agent_skills')
				->where('status', '1')
				->get();

			$view['editfield'] = '<a class="profile-edit-button field-edit"><i class="fa fa-pencil"></i></a>';

			return view('dashboard.user.agents.profile', $view);
		} else {
			return redirect("/login?usertype=" . env('user_role_' . Auth::user()->agents_users_role_id));
		}
	}

	/* For buyer profile */
	public function buyer(Request $request)
	{
		if (Auth::user()) {
			$view['user'] = $user = Auth::user();
			$view['userdetails'] = $userdetails = Userdetails::find($user->id);

			$view['editfield'] = '<a class="profile-edit-button field-edit"><i class="fa fa-pencil"></i></a>';

			return view('dashboard.user.buyers.profile', $view);
		} else {
			return redirect("/login?usertype=" . env('user_role_' . Auth::user()->agents_users_role_id));
		}
	}

	/* Edit profile  */
	public function editfields(Request $request)
	{
		if (Auth::user()) {
			$input_arr = $input_error_arr = $where = $update = [];

			if ($request->exists('phone')) {
				if (strlen(preg_replace('/[^0-9]/', '', $request->phone)) < 10) {
					return response()->json(['status' => 'phoneerror', 'message' => 'Enter 10 digit Number']);
				}
			}

			if ($request->exists('phone_home')) {
				if (strlen(preg_replace('/[^0-9]/', '', $request->phone_home)) < 10) {
					return response()->json(['status' => 'phone_home', 'message' => 'Enter 10 digit Number']);
				}
			}

			if ($request->exists('phone_work')) {
				if (strlen(preg_replace('/[^0-9]/', '', $request->phone_work)) < 10) {
					return response()->json(['status' => 'phone_work', 'message' => 'Enter 10 digit Number']);
				}
			}

			/* For fax number is not blank */
			if ($request->exists('fax_no') && is_null($request->fax_no)) {
				$input_arr['fax_no'] = $request->fax_no;
				$input_error_arr['fax_no'] = 'required';
				$validator = Validator::make($input_arr, $input_error_arr);

				if ($validator->fails()) {
					return response()->json(['status' => 'faxerror', 'message' => $validator->errors()->all()]);
				}
			}
			if ($request->exists('fax_no') && !is_numeric($request->fax_no)) {
				return response()->json(['status' => 'faxErr', 'message' => "Please fill numeric values."]);
			}

			/* For zip code is not blank */
			if ($request->exists('zip_code') && is_null($request->zip_code)) {
				$input_arr['zip_code'] = $request->zip_code;
				$input_error_arr['zip_code'] = 'required';
				$validator = Validator::make($input_arr, $input_error_arr);

				if ($validator->fails()) {
					return response()->json(['status' => 'ziperror', 'message' => $validator->errors()->all()]);
				}
			}
			if ($request->exists('zip_code') && !is_numeric($request->zip_code)) {
				return response()->json(['status' => 'zipErr', 'message' => "Please fill numeric values."]);
			}

			if ($request->exists('address') && is_null($request->address)) {
				$input_arr['address'] = $request->address;
				$input_error_arr['address'] = 'required';
				$validator = Validator::make($input_arr, $input_error_arr);

				if ($validator->fails()) {
					return response()->json(['status' => 'addresserror', 'message' => $validator->errors()->all()]);
				}
			}

			if ($request->exists('address2') && is_null($request->address2)) {
				$input_arr['address2'] = $request->address2;
				$input_error_arr['address2'] = 'required';

				$validator = Validator::make($input_arr, $input_error_arr);
				if ($validator->fails()) {
					return response()->json(['status' => 'addresserror2', 'message' => $validator->errors()->all()]);
				}
			}

			if ($request->exists('name') && is_null($request->name)) {

				$input_arr['Full Name'] = $request->name;
				$input_error_arr['Full Name'] = 'required';
				$validator = Validator::make($input_arr, $input_error_arr);

				if ($validator->fails()) {
					return response()->json(['status' => 'nameerror', 'message' => $validator->errors()->all()]);
				}
			}

			if ($request->type == 'employment' && $request->post && !empty($request->post)) {
				$emplo = [];
				for ($i = 0; $i < count($request->post); $i++) {
					$emplo[] = ['post' => $request->post[$i], 'organization' => $request->organization[$i], 'from' => $request->from[$i], 'to' => $request->to[$i], 'description' => $request->description[$i]];
				}

				$update[$request->type] = json_encode($emplo);
			} else if ($request->type == 'education' && $request->post && !empty($request->post)) {
				$emplo = [];
				for ($i = 0; $i < count($request->post); $i++) {
					$emplo[] = ['degree' => $request->post[$i], 'school' => $request->organization[$i], 'from' => $request->from[$i], 'to' => $request->to[$i], 'description' => $request->description[$i]];
				}
				$update[$request->type] = json_encode($emplo);
			} else {
				foreach ($request->all() as $key => $value) {
					if ($key != 'id' && $key != '_token') {
						$update[$key] = $value;
						if ($key == 'skills' && !empty($value)) {
							$update[$key] = implode(',', $value);
						}
					}
				}
			}

			$update['updated_at'] = Carbon::now()->toDateTimeString();
			$where['details_id'] = $request->id;
			$userdetails = new Userdetails;
			$resutl = $userdetails->EditFieldsUserdetailsModel($where, $update);
			return response()->json(['status' => $resutl, 'message' => '']);
		} else {
			return response()->json(['status' => 'loginerorr', 'message' => '', 'url' => '/login?usertype=agent']);
		}
	}

	/*edit profiles*/
	public function editagentprofile(Request $request)
	{
		$agentDetails = DB::table('agents_users_details')
			->where('details_id', Auth::user()->id)
			->get();

		$user = new User;
		$where = $update = [];
		$rules = [
			'state_id' => 'required',
			'city_id' => 'required',
			'licence_number' => 'required',
			'years_of_expreience' => 'required',
			'office_address' => 'required',
			'brokers_name' => 'required',
			'terms_and_conditions' => 'required',
		];

		if ($agentDetails[0]->contract_verification == 0) {
			if (empty($request->file('statement_document')) && empty($request->statement_document_c)) {
				$rules['statement_document'] = 'required|mimes:pdf|max:10000';
			} else if (!empty($request->file('statement_document'))) {
				$rules['statement_document'] = 'required|mimes:pdf|max:10000';
			}
		}

		$validator = Validator::make($request->all(), $rules, [
			'required' => 'The :attribute field is required',
			'years_of_expreience.required' => "The years of experience field is required"
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()]);
		}

		foreach ($request->all() as $key => $value) {
			if ($key != 'id' && $key != '_token' && $key != 'statement_document' && $key != 'statement_document_c') {
				if (($key == 'area' || $key == 'zip_code') && !empty($value)) {
					$update[$key] = rtrim(implode(',', $value), ',');
				} else {
					$update[$key] = $value;
				}
			}
		}

		if (!empty($request->file('statement_document'))) {
			$statement = $request->file('statement_document');
			$pdffile = time() . '.' . $statement->getClientOriginalExtension();
			$destinationPath = public_path('/assets/img/agents_pdf/');
			$statement->move($destinationPath, $pdffile);
			$update['contract_verification'] = 1;
			$update['statement_document'] = url('/assets/img/agents_pdf/') . '/' . $pdffile;
			$userExits = $user->getDetailsByEmailOrId(['id' => $request->id]);
			$emaildata['url'] = url('/agentadmin/agents/view/') . '/' . $userExits->id;
			$emaildata['name'] = ucwords($userExits->name);
			$emaildata['html'] = "<div><h3>Hello Admin,</h3><br><p>{$emaildata['name']} upload a statement document physically <a href='{$update['statement_document']}'>sign.pdf</a> .</p><br><p>Clcik <a href='{$emaildata['url']}'>here</a> and update this user status.</p><div>";

			send_mail(
				name: $emaildata['name'],
				email: env('MAIL_FROM_ADDRESS'),
				subject: "{$emaildata['name']} Agents Statement document",
				title: "Reset Password",
				mail_body: $emaildata['html']
			);
		} else {
			$update['statement_document'] = $request->statement_document_c;
		}

		$update['years_of_expreience'] = $request->years_of_expreience;
		$update['updated_at'] = Carbon::now()->toDateTimeString();
		$where['details_id'] = $request->id;
		$userdetails = new Userdetails;
		$resutl = $userdetails->EditFieldsUserdetailsModel($where, $update);
		return response()->json(["msg" => "Your Personal data has been updated successfully"]);
	}

	/*edit profiles*/
	public function editagentprofessionalprofile(Request $request)
	{
		$where = $update = $messages = [];
		$rules = [
			'certifications' => 'required',
			'specialization' => 'required',
			'educationfrom' => 'required',
			'educationto' => 'required',
		];

		$arrayrile = ['degree', 'school', 'educationdescription', 'post', 'organization', 'experiencefrom', 'experienceto', 'experiencedescription', 'language', 'speak', 'read', 'write'];

		$arrayrile[] = 'year';
		$arrayrile[] = 'sellers_represented';
		$arrayrile[] = 'buyers_represented';
		$arrayrile[] = 'total_dollar_sales';

		foreach ($arrayrile as $value) {
			if (empty($request->{$value}[0])) {
				$valueed = str_replace('_', ' ', $value);
				$messages[$value][0] = ucwords($valueed) . ' Field Is Required.';
			}
		}

		$validator = Validator::make($request->all(), $rules, [
			'certifications.required' => 'Certifications field is required.',
			'educationfrom.required' => 'From Date field is required.',
			'educationto.required' => 'To Date field is required.',
			'educationto.date' => 'Put To Date field in date format.',
			'specialization.required' => 'Specialization field is required.'
		]);

		if ($validator->fails() || !empty($messages)) {
			return response()->json(['error' => array_merge($validator->errors()->messages(), $messages)]);
		}

		$notin = ['community_involvement', 'publications', 'associations_awards', 'id', '_token', 'degree', 'school', 'educationfrom', 'educationto', 'educationdescription', 'post', 'organization', 'experiencefrom', 'experienceto', 'experiencedescription', 'year', 'sellers_represented', 'buyers_represented', 'total_dollar_sales', 'language', 'speak', 'read', 'write'];

		if ($request->degree && !empty($request->degree)) {
			$emplo = [];
			for ($i = 0; $i < count($request->degree); $i++) {
				if (!empty($request->degree[$i]) && !empty($request->school[$i]) && !empty($request->educationfrom[$i]) && !empty($request->educationto[$i]) && !empty($request->educationdescription[$i])) {
					$emplo[] = ['degree' => $request->degree[$i], 'school' => $request->school[$i], 'from' => $request->educationfrom[$i], 'to' => $request->educationto[$i], 'description' => $request->educationdescription[$i]];
				}
			}
			$update['real_estate_education'] = json_encode($emplo);
		}

		if ($request->post && !empty($request->post)) {
			$emplo = [];
			for ($i = 0; $i < count($request->post); $i++) {
				if (!empty($request->post[$i]) && !empty($request->organization[$i]) && !empty($request->experiencefrom[$i]) && !empty($request->experienceto[$i]) && !empty($request->experiencedescription[$i])) {
					$emplo[] = ['post' => $request->post[$i], 'organization' => $request->organization[$i], 'from' => $request->experiencefrom[$i], 'to' => $request->experienceto[$i], 'description' => $request->experiencedescription[$i]];
				}
			}
			$update['industry_experience'] = json_encode($emplo);
		}

		if ($request->year && !empty($request->year)) {
			$emplo = [];
			$total_sales = 0;
			for ($i = 0; $i < count($request->year); $i++) {
				$total_sales = $total_sales + $request->total_dollar_sales[$i];
				if (!empty($request->year[$i]) && !empty($request->sellers_represented[$i]) && !empty($request->buyers_represented[$i]) && !empty($request->total_dollar_sales[$i])) {
					$emplo[] = ['year' => $request->year[$i], 'sellers_represented' => $request->sellers_represented[$i], 'buyers_represented' => $request->buyers_represented[$i], 'total_dollar_sales' => $request->total_dollar_sales[$i]];
				}
			}

			$update['total_sales'] = $total_sales;
			$update['sales_history'] = json_encode($emplo);
		}

		if ($request->language && !empty($request->language)) {
			$emplo = [];
			for ($i = 0; $i < count($request->language); $i++) {
				if (!empty($request->language[$i]) && !empty($request->speak[$i]) && !empty($request->read[$i]) && !empty($request->write[$i])) {
					$emplo[] = ['language' => $request->language[$i], 'speak' => $request->speak[$i], 'read' => $request->read[$i], 'write' => $request->write[$i]];
				}
			}
			$update['language_proficiency'] = json_encode($emplo);
		}

		if ($request->associations_awards && !empty($request->associations_awards)) {
			$update['associations_awards'] = implode(",==,", array_filter($request->associations_awards));
		}

		if ($request->publications && !empty($request->publications)) {
			$update['publications'] = implode(",==,", array_filter($request->publications));
		}

		if ($request->community_involvement && !empty($request->community_involvement)) {
			$update['community_involvement'] = implode(",==,", array_filter($request->community_involvement));
		}

		$update['show_individual_yearly_figures'] = '0';
		foreach ($request->all() as $key => $value) {
			if (!in_array($key, $notin)) {
				if ($key == 'certifications' && !empty($value)) {
					$update[$key] = rtrim(implode(',', $value), ',');
				} else if ($key == 'specialization' && !empty($value)) {
					$update[$key] = rtrim(implode(',', $value), ',');
				} else if ($key == 'show_individual_yearly_figures' && !empty($value)) {
					if ($value == 'on') {
						$update[$key] = '1';
					} else {
						$update[$key] = '0';
					}
				} else {
					$update[$key] = $value;
				}
			}
		}

		$update['updated_at'] = Carbon::now()->toDateTimeString();
		$where['details_id'] = $request->id;
		$userdetails = new Userdetails;
		$resutl = $userdetails->EditFieldsUserdetailsModel($where, $update);
		return response()->json(["msg" => "Your Personal data has been updated successfully"]);
	}

	/* Edit profile pic */
	public function editprofilepic(Request $request)
	{
		if (Auth::user()) {
			$input_arr = $input_error_arr = $where = $update = [];
			$this->validate($request, [
				'image' => 'required|mimes:jpeg,png,jpg,gif,svg|image|max:2000',
			], ['image.max' => 'Image should be less then 2MB.']);

			$image = $request->file('image');
			$update['photo'] = time() . '.' . $image->getClientOriginalExtension();
			$destinationPath = public_path('/assets/img/profile/');
			$image->move($destinationPath, $update['photo']);
			$where['details_id'] = $request->id;
			$userdetails = new Userdetails;
			$resutl = $userdetails->EditFieldsUserdetailsModel($where, $update);
			return response()->json(['status' => $resutl, 'message' => $destinationPath]);
		} else {
			return response()->json(['status' => 'loginerorr', 'message' => '', 'url' => '/login?usertype=agent']);
		}
	}

	/*agent settings*/
	public function agentsettings(Request $request)
	{
		if (Auth::user()) {
			$state = new State;
			$user1 = new User;
			$view = [];
			$view['user'] = $user = Auth::user();
			$userDetails = $user1->getuserdetailsByAny(['agents_users_details.details_id' => $user->id]);
			$view['userdetails'] = $userDetails;

			$user_city = $state->getCityByAny(['is_deleted' => '0', 'city_id' => $userDetails->city_id]);
			$view['oldCityId'] = $user_city[0]->city_id;
			$view['oldCityName'] = $user_city[0]->city_name;
			$view['oldCityStateId'] = $user_city[0]->state_id;

			$view['securty_questio'] = DB::table('agents_securty_question')
				->where('is_deleted', '0')
				->where('status', '1')
				->get();
			$view['securty_questio_count'] = $securty_questio_count = DB::table('agents_securty_question')
				->where('is_deleted', '0')
				->where('status', '1')
				->get()
				->count();

			if ($view['user']->agents_users_role_id == 2) {
				$view['types'] = 'Buy';
			} else {
				$view['types'] = 'Sell';
			}

			$view['editfield'] = '<a class="pull-right profile-edit-button field-edit"><i class="fa fa-pencil"></i></a>';
			$view['segment'] = $request->segments();
			return view('dashboard.user.agents.settings', $view);
		} else {
			return redirect("/login?usertype=" . env('user_role_' . Auth::user()->agents_users_role_id));
		}
	}

	/*buyer settings*/
	public function buyersettings(Request $request)
	{
		if (Auth::user()) {
			$state = new State;
			$user1 = new User;
			$view = [];
			$view['user'] = $user = Auth::user();
			$userDetails = $user1->getuserdetailsByAny(['agents_users_details.details_id' => $user->id]);

			$view['userdetails'] = $userDetails;

			$view['state'] = $state->getStateByAny(['is_deleted' => '0', 'status' => '1']);
			$view['city'] = $state->getCityByAny(['is_deleted' => '0']);
			$user_city = $state->getCityByAny(['is_deleted' => '0', 'city_id' => $userDetails->city_id]);

			if (!empty($user_city->toArray())) {
				$view['oldCityId'] = $user_city[0]->city_id;
				$view['oldCityName'] = $user_city[0]->city_name;
				$view['oldCityStateId'] = $user_city[0]->state_id;
			} else {
				$view['oldCityId'] = '';
				$view['oldCityName'] = '';
				$view['oldCityStateId'] = '';
			}

			$view['editfield'] = '<a class="pull-right field-edit"><i class="fa fa-pencil"></i></a>';

			$view['securty_questio'] = DB::table('agents_securty_question')
				->where('is_deleted', '0')
				->where('status', '1')
				->get();
			$view['securty_questio_count'] = $securty_questio_count = DB::table('agents_securty_question')
				->where('is_deleted', '0')
				->where('status', '1')
				->get()
				->count();

			if ($view['user']->agents_users_role_id == 2) {
				$view['types'] = 'Buy';
			} else {
				$view['types'] = 'Sell';
			}

			$view['segment'] = $request->segments();
			return view('dashboard.user.buyers.settings', $view);
		} else {
			return redirect("/login?usertype=" . env('user_role_' . Auth::user()->agents_users_role_id));
		}
	}

	public function getQuestions($id)
	{
		$securty_questio = DB::table('agents_securty_question')
			->where('is_deleted', '=', '0')
			->where('status', '=', '1')
			->where('securty_question_id', '!=', $id)
			->get();

		if (!empty($securty_questio)) {
			echo json_encode($securty_questio);
			exit;
		}
	}

	/*Edit buyer profile*/
	public function editbuyerprofile(Request $request)
	{
		$where = $update = [];
		$rules = [
			'address' => 'required',
			'address2' => 'required',
			'city_id' => 'required',
			'state_id' => 'required',

			'zip_code' => 'required',

			'description' => 'required',
		];

		$validator = Validator::make($request->all(), $rules, [
			'address.required' => 'The address line 1 field is required.',
			'address2.required' => 'The address line 2 field is required.'
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()]);
		}

		foreach ($request->all() as $key => $value) {
			if ($key != 'id' && $key != 'role_id' && $key != '_token') {
				$update[$key] = $value;
			}
		}

		$update['updated_at'] = Carbon::now()->toDateTimeString();
		$where['details_id'] = $request->id;
		$userdetails = new Userdetails;

		$resutl = $userdetails->EditFieldsUserdetailsModel($where, $update);
		return response()->json(["msg" => "Your Personal data has been updated successfully"]);
	}

	/* change password */
	public function changepassword(Request $request)
	{
		$user = Auth::user();

		$validator = Validator::make($request->all(), [
			'oldpassword' => 'required',
			'password' => 'required|min:6|confirmed',
			'password_confirmation' => 'required|required_with:password|min:6'
		], [
			"password.required_with" => "Password and Confirm Password Does Not Match",
			"oldpassword.required" => "Old password is required",
			"password.required" => "The New Password field is required.",
		]);

		$oldpassword = $request->oldpassword;
		$password = $request->password;

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()]);
		} else if (Hash::check($oldpassword, $user->password)) {
			$user->password = Hash::make($password);
			$user->save();

			$mail_data = [
				'name' => $user->email,
				'toemail' => $user->email,
			];

			$mail_data['name'] = $user->name;

			Mail::send('email.changepassword', $mail_data, function ($message) use ($mail_data) {
				$message->to($mail_data['toemail'], $mail_data['name'])
					->subject('Change password');
				$message->from("92agent@92agents.com", "92Agents");
			});

			return response()->json(["msg" => "Password updated successfully"]);
		} else {
			return response()->json(["error" => ['oldpassword' => ['0' => 'Old password is incorrect.']]]);
		}
	}

	/* post title for buyer and seller */
	public function updateposttitle(Request $request)
	{
		$rules = [
			'posttitle' => 'required'
		];

		$posttitle = $request->posttitle;

		$validator = Validator::make(['posttitle' => $posttitle], $rules);
		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()]);
		}

		$post = new Post;
		$postdetails = $post->getDetailsByUserroleandId($request->agents_user_id, $request->agents_users_role_id);

		if (empty($postdetails)) {
			$postdetailsnew = [];
			$postdetailsnew['agents_user_id'] = $request->agents_user_id;
			$postdetailsnew['agents_users_role_id'] = $request->agents_users_role_id;
			$postdetailsnew['posttitle'] = $posttitle;
			DB::table('agents_posts')->insertGetId($postdetailsnew);
		} else {
			$postdetails = Post::find($postdetails->post_id);
			$postdetails->posttitle = $posttitle;
			$postdetails->updated_at = Carbon::now()->toDateTimeString();
			$postdetails->save();
		}
		return response()->json(["msg" => "Your post details successfully insert!"]);
	}

	/*securtyquestion*/
	public function securtyquestion(Request $request)
	{
		$rules = [
			'question1' => 'required',
			'answer1' => 'required',
			'question2' => 'required',
			'answer2' => 'required',
		];

		$validator = Validator::make([
			'question1' => $request->question1,
			'answer1' => $request->answer1,
			'question2' => $request->question2,
			'answer2' => $request->answer2,
		], $rules, [
			'answer1.required' => 'The answer 1 field is required.',
			'answer2.required' => 'The answer 2 field is required.'
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()]);
		} else {
			$user = User::find($request->id);
			$user->first_login = 2;
			$user->save();
			$postdetails = Userdetails::find($request->id);
			$postdetails->question_1 = $request->question1;
			$postdetails->answer_1 = $request->answer1;
			$postdetails->question_2 = $request->question2;
			$postdetails->answer_2 = $request->answer2;
			$postdetails->updated_at = Carbon::now()->toDateTimeString();
			if ($postdetails->save()) {
				return response()->json(["msg" => "Security Questions updated successfully"]);
			} else {
				return response()->json(["msg" => ['error' => 'Please try again in a few minutes.']]);
			}
		}
	}

	/* For agent personal bio */
	public function resume(Request $request)
	{
		if (Auth::user()) {
			$view['user'] = $user = Auth::user();
			$view['userdetails'] = $userdetails = Userdetails::find($user->id);
			$view['segment'] = $request->segments();

			return view('dashboard.user.agents.resume', $view);
		} else {
			return redirect("/login?usertype=" . env('user_role_' . Auth::user()->agents_users_role_id));
		}
	}

	/* For agets questions */
	public function agentsquestions(Request $request)
	{
		if (Auth::user()) {
			$view['user'] = $user = Auth::user();
			$view['userdetails'] = $userdetails = Userdetails::find($user->id);
			$view['segment'] = $request->segments();
			return view('dashboard.user.agents.questions', $view);
		} else {
			return redirect("/login?usertype=" . env('user_role_' . Auth::user()->agents_users_role_id));
		}
	}

	/* For buyer questions */
	public function buyerquestions(Request $request)
	{
		if (Auth::user()) {
			$view['user'] = $user = Auth::user();
			$view['userdetails'] = $userdetails = Userdetails::find($user->id);
			$view['segment'] = $request->segments();
			return view('dashboard.user.buyers.questions', $view);
		} else {
			return redirect("/login?usertype=" . env('user_role_' . Auth::user()->agents_users_role_id));
		}
	}

	/* For state */
	public function state()
	{
		$state = new State;
		return response()->json($state->getStateByAny(['is_deleted' => '0', 'status' => '1']));
	}

	/* For get city */
	public function city($state_id = null)
	{
		$state = new State;
		if ($state_id != null) {
			return response()->json($state->getCityByState(['is_deleted' => '0', 'state_id' => $state_id]));
		} else {
			return response()->json($state->getCityByAny(['is_deleted' => '0']));
		}
	}

	/* For get area */
	public function area()
	{
		$state = new State;
		return response()->json($state->getAreaByAny(['is_deleted' => '0', 'status' => '1']));
	}

	/* For certifications */
	public function certifications(Request $request, $id = null)
	{
		$userdetails = new Userdetails;
		$wherein = [];
		if ($request->certifications_id) {
			$wherein['certifications_id'] = $request->certifications_id;
		}

		$where = [];
		if ($id != null) {
			$where['certifications_id'] = $id;
		}
		$where['is_deleted'] = '0';
		$where['status'] = '1';
		return response()->json($userdetails->getCertificationsByAny($where, $wherein));
	}

	/* specialization */
	public function specialization($id = null)
	{
		$userdetails = new Userdetails;
		$where = [];
		if ($id != null) {
			$where['skill_id'] = $id;
		}

		$where['is_deleted'] = '0';
		$where['status'] = '1';
		return response()->json($userdetails->getSpecializationByAny($where));
	}

	/* For franchisee */
	public function franchise($id = null)
	{
		$userdetails = new Userdetails;
		$where = [];
		if ($id != null) {
			$where['franchise_id'] = $id;
		}
		$where['is_deleted'] = '0';
		$where['status'] = '1';
		return response()->json($userdetails->getFranchiseByAny($where));
	}

	/* For get skills details  */
	public function skills(Request $request, $id = null)
	{
		$usk = new Agentskills;
		$where = [];
		if ($id != null) {
			$where['skill_id'] = $id;
		}
		$where['is_deleted'] = '0';
		$where['status'] = '1';
		$wherein = [];
		if ($request->skill_id) {
			$wherein['skill_id'] = $request->skill_id;
		}
		return response()->json($usk->getskillsByAny($where, $wherein));
	}

	/* For check public connections */

	public function publicConnection(Request $request)
	{ 
		$sellerDetails = Userdetails::find($request->to_id);

		$postDetails = AgentPost::where('is_deleted', 0)
			->where('agents_user_id', $request->post_id)
			->first();

		$address = $postDetails ? $postDetails->address1 : '';

		$now = Carbon::now();
		
		$where = [
			'post_id' => $request->post_id,
			'to_id' => $request->to_id,
			'to_role' => $request->to_role,
			'from_id' => $request->from_id,
			'from_role' => $request->from_role,
		];

		$updated = AgentUserConnection::where(function ($query) use ($where) {
			$query->where([
				'to_id' => $where['to_id'],
				'to_role' => $where['to_role'],
				'from_id' => $where['from_id'],
				'from_role' => $where['from_role'],
				'post_id' => $where['post_id']
			]);
		})->orWhere(function ($query) use ($where) {
			$query->where([
				'from_id' => $where['to_id'],
				'from_role' => $where['to_role'],
				'to_id' => $where['from_id'],
				'to_role' => $where['from_role'],
				'post_id' => $where['post_id']
			]);
		})->touch();

		$newConnectionId = null;
	
		if (!$updated) { // Insert only if no existing record was updated
			$newConnectionId = AgentUserConnection::insertGetId($where + ['updated_at' => $now, 'created_at' => $now]);
			$newConnectionCreated = true;
		} else {
			$newConnectionCreated = false;
		}

		if ($newConnectionCreated && $sellerDetails && $postDetails) {
			$notificationData = [
				'sender_id' => $request->to_id,
				'sender_role' => $request->to_role,
				'receiver_id' => $request->from_id,
				'receiver_role' => $request->from_role,
				'notification_type' => 11,
				'notification_message' => "{$sellerDetails->name} contact related to post({$postDetails->posttitle})",
				'notification_item_id' => $newConnectionId,
				'notification_child_item_id' => $request->post_id,
				'status' => 1,
				'updated_at' => $now,
			];

			Notification::create($notificationData);

			event(new EventTrigger([$notificationData, $newConnectionId, 'NewNotification'])); // Pass $notificationData directly
		}

		DB::table('agents_selldetails')->insertGetId([
			'sellers_name' => $sellerDetails->name,
			'address' => $address,
			'post_id' => $request->post_id,
			'agent_id' => $request->from_id,
			'agent_comission' => 3,
			'comission_92agent' => 1,
		]);
	}

	public function publicConnection_jk(Request $request)
	{
		$user = new User;
		$agent = new User;
		$seller = new User;
		$post = new Post;

		$sellerDetails = $seller->getuserdetailsByAny([
			'agents_users_details.details_id' => $request->to_id
		]);

		$postDetails = $post->getpostsingalByAny([
			'is_deleted' => '0',
			'agents_user_id' => $request->to_id
		]);

		$postDetails = $postDetails->address1 ?? '';

		$user->usersconection([
			'post_id' => $request->post_id,
			'to_id' => $request->to_id,
			'to_role' => $request->to_role,
			'from_id' => $request->from_id,
			'from_role' => $request->from_role
		]);

		$insert_arr = [
			'sellers_name' => $sellerDetails->name,
			'address' => $postDetails,
			'post_id' => $request->post_id,
			'agent_id' => $request->from_id,
			'agent_comission' => 3,
			'comission_92agent' => 1,
		];

		DB::table('agents_selldetails')->insertGetId($insert_arr);
	}

	//update sell details records...
	public function updateSellDetials(Request $request)
	{
		Validator::make($request->all(), [
			'sale_date' => 'nullable|date_format:d/m/Y',
			'sale_price' => 'numeric|max:10',
			'agent_comission' => 'numeric|required',
			'address' => 'nullable|string|max:250',
		]);
		// $validator = Validator::make($request->all(), []);

		// if ($validator->fails()) {
		// 	return Resp::InvalidRequest(validator: $validator);
		// }

		// print_r($request->all()); exit;

		$sale_date = $request->sale_date ? Carbon::createFromFormat('d/m/Y', $request->sale_date)->format('Y-m-d') : null;

		DB::table('agents_selldetails')->where('id', $request->id)->update([
			'sale_date' => $sale_date,
			'sale_price' => $request->sale_price,
			'agent_comission' => $request->agent_comission ?? 3,
			'address' => $request->address,
		]);

		return  redirect()->back();
	}

	/* For get public user */
	public function publicUserGet($id = null, $role = null)
	{
		$uss = new User;
		$result = $uss->getDetailsByEmailOrId(['role_id' => $role, 'id' => $id]);
		return response()->json($result);
	}

	/* For applied post for agents */
	public function AppliedPostForAgentsByDate(Request $request)
	{
		if (Auth::user()) {
			$view = [];
			$view['user'] = $user = Auth::user();
			$view['userdetails'] = $userdetails = Userdetails::find($user->id);
			$date = explode("-", $request->date);
			$date = str_replace(' ', '', $date);

			$datefrom = $date[0];
			$dateto = $date[1];

			$startdate = date("Y-m-d", strtotime($datefrom));
			$enddate = date("Y-m-d", strtotime($dateto));

			$invoice_details = DB::table('agents_selldetails as as')
				->whereBetween('created_ts', [$startdate, $enddate])

				->join('agents_posts as ap', 'as.post_id', '=', 'ap.post_id')
				->select(
					'as.sellers_name',
					'as.id',
					'as.address',
					'as.payment_status',
					'as.receipt_url',
					'as.sale_date',
					'as.sale_price',
					'ap.posttitle',
					'as.status',
					"as.agent_comission"
				)
				->where(['ap.applied_user_id' => $user->id, 'as.status' => 1])
				->where('ap.agents_users_role_id', '=', $request->usertype)
				->get();
			$view['invoice_details'] = $invoice_details;
			$view['post_status'] = $request->status;
			return view('dashboard.user.agents.appliedpost', $view);
		}
	}

	public function AppliedPostForAgents(Request $request)
	{
		$user = AuthUser();

		if (!$user || $user->agents_users_role_id != 4) {
			return redirect("/login?usertype=" . env("user_role_4"));
		}
		
		$state = new State;
		
		$data = [
			'user' => $user,
			'post_status' => $request->status ?? 'all',
			'city' => $state->getCityByAny(['is_deleted' => '0']),
			'state' => $state->getStateByAny(['is_deleted' => '0', 'status' => '1']),
		];

		$invoice_details = DB::table('agents_selldetails as as')
			->join('agents_posts as ap', 'as.post_id', '=', 'ap.post_id')
			->select(
				'as.sellers_name',
				'as.id',
				'as.post_id',
				'as.address',
				'as.payment_status',
				'as.receipt_url',
				'as.sale_date',
				'as.sale_price',
				'ap.closing_date',
				'ap.posttitle',
				'as.status',
				"as.agent_comission"
			)
			->where('ap.applied_user_id', $user->id)
			->where('as.status', 1);

		$status = match ($request->status) {
			"paid" => 1,
			"unpaid" => 0,
			default => 2,
		};

		if ($status != 2) {
			$invoice_details = $invoice_details->where('as.payment_status', $status);
		}

		if ($status == 1) {
			$invoice_details = $invoice_details->where('as.address', '!=', '')
				->where('as.agent_comission', '!=', '')
				->where('as.sale_date', '!=', '')
				->where('as.sale_price', '!=', '');
		}

		$invoice_details = $invoice_details->get();

		$data['invoice_details'] = $invoice_details;

		return view('dashboard.user.agents.appliedpost', $data);
	}

	/* For connected jobs for agents */
	public function ConnectedJobsForAgents()
	{
		if (Auth::user()) {
			$view = [];
			$view['user'] = $user = Auth::user();
			$view['userdetails'] = $userdetails = Userdetails::find($user->id);
			return view('dashboard.user.agents.connectedjobs', $view);
		} else {
			return redirect("/login?usertype=" . env('user_role_' . Auth::user()->agents_users_role_id));
		}
	}

	/* get applied post list for agents */
	public function AppliedPostListGetForAgents($limit, $userid, $roleid, $selected = null, $user_role_id = null)
	{
		$post = new Post;
		$result = $post->AppliedPostListGetForAgents($limit, ['agents_users_conections.to_id' => $userid, 'agents_users_conections.to_role' => $roleid, 'agents_posts.agents_users_role_id' => $user_role_id], ['agents_users_conections.from_id' => $userid, 'agents_users_conections.from_role' => $roleid, 'agents_posts.agents_users_role_id' => $user_role_id], $selected);
		return response()->json($result);
	}

	/* For proposal */
	public function proposal()
	{
		if (Auth::user()) {
			$view = [];
			$view['user'] = $user = Auth::user();
			$view['userdetails'] = $userdetails = Userdetails::find($user->id);
			return view('dashboard.user.agents.proposal', $view);
		} else {
			return redirect("/login?usertype=" . env('user_role_' . Auth::user()->agents_users_role_id));
		}
	}

	/* For get document info */
	public function documents()
	{
		if (Auth::user()) {
			$view = [];
			$view['user'] = $user = Auth::user();
			$view['userdetails'] = $userdetails = Userdetails::find($user->id);
			if ($user->agents_users_role_id == 4) {
				return view('dashboard.user.agents.document', $view);
			} else {
				return view('dashboard.user.buyers.document', $view);
			}
		} else {
			return redirect("/login?usertype=" . env('user_role_' . Auth::user()->agents_users_role_i));
		}
	}

	/* For contract details*/
	public function contract()
	{

		$file = public_path() . "/assets/img/agents_pdf/1536050674.pdf";
		$headers = [
			'Content-Type: application/pdf',
		];

		return $response = FacadeResponse::download($file, 'contract.pdf', $headers);
	}
}