<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\State;
use App\Models\User;
use App\Models\Userdetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class BuyerSearchController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'agents_user_id' => 'required|numeric',
            'agents_users_role_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => '101', 'error' => $validator->errors()], 422);
        }

        if (!$request->agents_user_id || !$request->agents_users_role_id == 4) {
            return response()->json(['status' => '101', 'response' => 'User is not Authenticated!'], 401);
        }

        $state = new State;
        $view = [];
        $view['userdetails'] = Userdetails::find($request->agents_user_id);
        $view['city'] = $state->getCityByAny(['is_deleted' => '0']);
        $view['state'] = $state->getStateByAny(['is_deleted' => '0', 'status' => '1']);
        $view['search_post'] = Session::has('search_post') ? Session::get('search_post') : [];
        return response()->json(['status' => '200', 'response' => $view]);
    }

    public function postlist(Request $request, $limit = null)
    {
        $searchTypes = [
            'post_contains' => [
                'rules' => [
                    'cityName' => 'required_without:state',
                    'state' => 'required_without:cityName',
                ],
                'messages' => [
                    'cityName.required_without' => 'Either "cityName" or "state"  is required.',
                    'state.required_without' => 'Either "cityName" or "state"  is required.',
                ],
            ],
            'name' => [
                'rules' => [
                    'usertype' => 'required',
                    'cityName' => 'required_without:state',
                    'state' => 'required_without:cityName',
                ],
                'messages' => [
                    'usertype.required' => 'The usertype parameter is required when the searchinputtype parameter is "name".',
                    'cityName.required_without' => 'Either "cityName" or "state" is required.',
                    'state.required_without' => 'Either "cityName" or "state" is required.',
                ],
            ],
        ];

        $messages = [
            'keyword.required' => 'The keyword field is required.',
            'searchinputtype.required' => 'The search input type field is required.',
            'searchinputtype.in' => 'Invalid search input type provided.',
        ];

        $rules = [
            'keyword' => 'required',
            'searchinputtype' => 'required|in:' . implode(',', array_keys($searchTypes)),
            'date' => 'nullable',
            'state' => 'nullable',
            'cityName' => 'nullable',
            'zipcodes' => 'nullable',
            'pricerange' => 'nullable',
            'address' => 'nullable',
        ];

        $searchType = $request->searchinputtype;
        if (isset($searchTypes[$searchType])) {
            $rules = array_merge($rules, $searchTypes[$searchType]['rules']);
            $messages = array_merge($messages, $searchTypes[$searchType]['messages']);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        Session::put('search_post', $request->all());
        $post = new Post;
        $result = $post->getSearchAnyByAny($limit, $request->all());
        if ($result) {
            return response()->json(['status' => '100', 'response' => $result['result']]);
        } else {
            return response()->json(['status' => '101', 'response' => 'posts not found!']);
        }
    }

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

            $view['uri_segment'] = $request->segment(5) ? $request->segment(5) : '';

            return view('dashboard.user.search.postdetails', $view);
        } else {
            return redirect("/login?usertype=" . env('user_role_' . Auth::user()->agents_users_role_id));
        }
    }

    public function buyerdetails($id, $roleid)
    {
        if (Auth::user() && Auth::user()->agents_users_role_id == 4) {
            if (empty($id)) {
                return redirect()->back();
            }
            $state = new State;
            $view = [];
            $view['user'] = $user = Auth::user();
            $view['userdetails'] = $userdetails = Userdetails::find($user->id);

            $user = new User;

            $view['buyer'] = $user->getuserdetailsByAny(['agents_users.id' => $id]);

            if ($roleid == 2) {
                $view['types'] = 'Buy ';
            } else {
                $view['types'] = 'Sell ';
            }
            $view['roleid'] = $roleid;

            return view('dashboard.user.search.buyerdetails', $view);
        } else {
            return redirect("/login?usertype=" . env('user_role_' . Auth::user()->agents_users_role_id));
        }
    }

    public function switchuser(Request $request)
    {
        $data = [];
        $userid = $request->userId;
        $data['agents_users_role_id'] = $request->role;

        $query = DB::table('agents_users')->where(['id' => $userid])->update($data);
        $response = [];
        if ($query) {
            $response['status'] = '200';
            $response['message'] = 'User switched successfully';
        } else {
            $response['status'] = '400';
            $response['message'] = 'Failed to switch user';
        }
        return response()->json(["result" => $response]);
    }
}