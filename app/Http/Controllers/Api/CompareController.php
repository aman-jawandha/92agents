<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Compare;
use App\Models\User;
use App\Models\Post;
use App\Models\Shared;
use App\Models\Userdetails;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class CompareController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function getDetailsByAny($where = null)
    {

        $query = DB::table('agents_compare')
            ->select('agents_compare.*', 'agents_users.login_status', 'agents_users_details.details_id', 'agents_users_details.name', 'agents_users_details.photo', 'agents_users_details.description')
            ->join("agents_users_details", DB::raw("FIND_IN_SET(agents_users_details.details_id,agents_compare.compare_item_id)"), ">", DB::raw("'0'"))
            ->leftjoin("agents_users", 'agents_users.id', '=', 'agents_users_details.details_id');
        if ($where != null) {
            $query->where($where);
        }

        $query->orderBy('agents_compare.created_at', 'DESC');

        $result = $query->get();




        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function getcomparragenstlist($where = null)
    {

        $cpm = new Compare;
        $query = DB::table('agents_compare')->select('agents_compare.*', 'agents_posts.applied_post', 'agents_posts.applied_user_id', 'agents_posts.post_id', 'agents_posts.agents_user_id', 'agents_posts.agents_users_role_id', 'agents_posts.posttitle', 'agents_users_details.*')
            ->leftjoin("agents_users_details", DB::raw("FIND_IN_SET(agents_users_details.details_id,agents_compare.compare_item_id)"), ">", DB::raw("'0'"))
            ->Join('agents_posts', 'agents_posts.post_id', '=', 'agents_compare.post_id');
        if ($where != null) {
            $query->where(array('agents_compare.compare_id' => $where['compare_id']));
        }
        $count = $query->count();
        $result = $query->get();

        $obj = [];
        foreach ($result as $value) {
            $asked_question     = @$where['asked_question'] == 1 ? $cpm->asked_question($value, $where) : array('asked_question' => '');
            $bookmark_agents     = @$where['bookmark_agents'] == 1 ? $cpm->bookmark_agents($value, $where) : array('bookmark_agents' => '');
            $bookmark_answers     = @$where['bookmark_answers'] == 1 ? $cpm->bookmark_answers($value, $where) : array('bookmark_answers' => '');
            $bookmark_messages     = @$where['bookmark_messages'] == 1 ? $cpm->bookmark_messages($value, $where) : array('bookmark_messages' => '');
            $bookmark_proposal     = @$where['bookmark_proposal'] == 1 ? $cpm->bookmark_proposal($value, $where) : array('bookmark_proposal' => '');
            $rating_answers     = @$where['rating_answers'] == 1 ? $cpm->rating_answers($value, $where) : array('rating_answers' => '');
            $rating_messages     = @$where['rating_messages'] == 1 ? $cpm->rating_messages($value, $where) : array('rating_messages' => '');
            $proposals             = @$where['proposals'] == 1 ? $cpm->proposals($value, $where) : array('proposals' => '');
            $documents             = @$where['documents'] == 1 ? $cpm->documents($value, $where) : array('documents' => '');
            $notes_messages     = @$where['notes_messages'] == 1 ? $cpm->notes_messages($value, $where) : array('notes_messages' => '');
            $notes_asked_question = @$where['notes_asked_question'] == 1 ? $cpm->notes_asked_question($value, $where) : array('notes_asked_question' => '');
            $notes_answers         = @$where['notes_answers'] == 1 ? $cpm->notes_answers($value, $where) : array('notes_answers' => '');
            $notes_proposal     = @$where['notes_proposal'] == 1 ? $cpm->notes_proposal($value, $where) : array('notes_proposal' => '');
            $notes_agents         = @$where['notes_agents'] == 1 ? $cpm->notes_agents($value, $where) : array('notes_agents' => '');
            $obj = (object) array_merge(
                (array) $value,
                (array) $asked_question,
                (array) $bookmark_agents,
                (array) $bookmark_answers,
                (array) $bookmark_messages,
                (array) $bookmark_proposal,
                (array) $rating_answers,
                (array) $rating_messages,
                (array) $proposals,
                (array) $documents,
                (array) $notes_messages,
                (array) $notes_asked_question,
                (array) $notes_answers,
                (array) $notes_proposal,
                (array) $notes_agents
            );
        }
        return $obj;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $compare_id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()) {
            print_r("hemant");
            exit;
        
            $compare = new Compare;
            if (!empty($request->input('compare_id'))) {
                $sataging = array(
                    'asked_question' => $request->input('asked_question') != '' ? $request->input('asked_question') : '',
                    'bookmark_agents' => $request->input('bookmark_agents') != '' ? $request->input('bookmark_agents') : '',
                    'bookmark_answers' => $request->input('bookmark_answers') != '' ? $request->input('bookmark_answers') : '',
                    'bookmark_messages' => $request->input('bookmark_messages') != '' ? $request->input('bookmark_messages') : '',
                    'bookmark_proposal' => $request->input('bookmark_proposal') != '' ? $request->input('bookmark_proposal') : '',
                    'rating_answers' => $request->input('rating_answers') != '' ? $request->input('rating_answers') : '',
                    'rating_messages' => $request->input('rating_messages') != '' ? $request->input('rating_messages') : '',
                    'proposals' => $request->input('proposals') != '' ? $request->input('proposals') : '',
                    'documents' => $request->input('documents') != '' ? $request->input('documents') : '',
                    'notes_messages' => $request->input('notes_messages') != '' ? $request->input('notes_messages') : '',
                    'notes_asked_question' => $request->input('notes_asked_question') != '' ? $request->input('notes_asked_question') : '',
                    'notes_answers' => $request->input('notes_answers') != '' ? $request->input('notes_answers') : '',
                    'notes_proposal' => $request->input('notes_proposal') != '' ? $request->input('notes_proposal') : '',
                    'notes_agents' => $request->input('notes_agents') != '' ? $request->input('notes_agents') : '',
                    'asked_question_list' => $request->input('asked_question_list') != '' ? $request->input('asked_question_list') : '',
                    'asked_question_text' => $request->input('asked_question_text') != '' && $request->input('asked_question_list') != '' ? array_intersect_key($request->input('asked_question_text'), $request->input('asked_question_list')) : '',
                );
                $compare_json = json_encode($sataging);
                $compare->inserupdate(array('compare_json' => $compare_json), array('compare_id' => $request->input('compare_id')));
                $postdata = $request->all();
                Session::put('comparedata',  $postdata);
                Session::put('sataging',  $sataging);
            } else {
                $postdata = Session::has('comparedata') ? Session::get('comparedata') : '';
                $sataging = Session::has('sataging') ? Session::get('sataging') : '';
            }

            $view = array();
            $view['user'] = $user = Auth::user();
            $view['userdetails'] = $userdetails = Userdetails::find($user->id);
            $view['sataging'] = $sataging;
            $view['result'] = $compare->getcomparragenstlist($postdata);
            $userdetails = new Userdetails;
            $certifications = $userdetails->getCertificationsByAny();
            $certificationsarray = [];
            foreach ($certifications as $key => $value) {
                $certificationsarray[$value->certifications_id] = $value->certifications_name;
            }
            $view['certifications'] = $certificationsarray;

            $specialization = $userdetails->getSpecializationByAny();
            $specializationarray = [];
            foreach ($specialization as $key => $value) {
                $specializationarray[$value->skill_id] = $value->skill;
            }
            $view['specialization'] = $specializationarray;

            $franchise = $userdetails->getFranchiseByAny();
            $franchisearray = [];
            foreach ($franchise as $key => $value) {
                $franchisearray[$value->franchise_id] = $value->franchise_name;
            }
            $view['franchise'] = $franchisearray;
            $view['profilepicpath'] = url('/assets/img/profile/');

            return response()->json(['status' => '100', 'response' => $view]);
        } else {
            return redirect('/login?usertype=' . env('user_role_' . Auth::user()->agents_users_role_id));
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $post_id $userid $roleid
     * @return \Illuminate\Http\Response
     */
    public function AppliedAgentsListGetForBuyer($post_id, $userid, $roleid)
    {
        $query1 = DB::table('agents_users_conections as m')

            ->join('agents_users_details as u', function ($join) {

                $join->on('u.details_id', '=', 'm.to_id')

                    ->orOn('u.details_id', '=', 'm.from_id');
            })

            ->leftJoin('agents_state', 'agents_state.state_id', '=', 'u.state_id')

            ->leftJoin('agents_city', 'agents_city.city_id', '=', 'u.city_id')

            ->join('agents_users', 'agents_users.id', '=', 'u.details_id')

            ->where(function ($query) use ($post_id, $userid, $roleid) {

                $query->whereRaw(DB::raw(
                    'CASE WHEN m.to_id = ' . $userid . ' AND m.to_role = ' . $roleid . '

					            THEN m.from_id = u.details_id

					            WHEN m.from_id = ' . $userid . '  AND m.from_role = ' . $roleid . '

					            THEN m.to_id = u.details_id END'

                ));
            })

            ->Join('agents_users_roles', 'agents_users_roles.role_id', '=', 'agents_users.agents_users_role_id')

            ->where(array('m.post_id' => $post_id))

            ->select('agents_users.id', 'agents_users.agents_users_role_id', 'u.brokers_name', 'agents_state.state_name', 'agents_city.city_name', 'm.*', 'u.name', 'u.description', 'u.photo', 'u.years_of_expreience', 'u.details_id', DB::raw('(CASE WHEN m.to_id = ' . $userid . ' AND m.to_role = ' . $roleid . ' THEN m.from_role  WHEN m.from_id = ' . $userid . '  AND m.from_role = ' . $roleid . ' THEN m.to_role END) AS details_id_role_id'), DB::raw('(CASE WHEN m.to_id = ' . $userid . ' AND m.to_role = ' . $roleid . ' THEN "to"  WHEN m.from_id = ' . $userid . '  AND m.from_role = ' . $roleid . ' THEN "from" END) AS is_user'), 'agents_users.login_status', 'agents_users_roles.role_name')

            ->orderBy('m.created_at', 'DESC');
        $queryunion = $query1;
        $result = $queryunion->get();
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $update = array();
        $update['post_id']              =   $request->input('post_id');
        $update['sender_id']            =   Auth::user()->id;
        $update['sender_role']          =   Auth::user()->agents_users_role_id;

        $compare = new Compare;
        $acheck = $compare->getCompareSingalByAny($update);
        $update['compare_item_id']      =   $request->input('compare_item_id');
        if (!empty($acheck)) {
            if (empty($compare->checkcompareintableagents($update))) {

                if ($acheck->compare_item_id != '') {
                    $countcompareitem = explode(',', $acheck->compare_item_id);
                    if (count($countcompareitem) < 5) {

                        $compare_item_id = rtrim(($acheck->compare_item_id != '' ? $acheck->compare_item_id . ',' : '') . ($update['compare_item_id']), ',');
                    } else {
                        $countcompareitem = array_pop($countcompareitem);
                        $compare_item_id = rtrim($update['compare_item_id'] . ',' . implode(',', $countcompareitem), ',');
                    }
                } else {
                    $compare_item_id = $update['compare_item_id'];
                }

                $bookbarkupdate                         =  Compare::find($acheck->compare_id);
                $bookbarkupdate->post_id                =  $update['post_id'];
                $bookbarkupdate->compare_item_id        =  $compare_item_id;
                $bookbarkupdate->sender_id              =  $update['sender_id'];
                $bookbarkupdate->sender_role            =  $update['sender_role'];
                $bookbarkupdate->updated_at             =  Carbon::now()->toDateTimeString();
                $bookbarkupdate->save();
                $result                                 =   $bookbarkupdate->compare_id;
            } else {
                $result =  $acheck->compare_id;
            }
        } else {
            $compare->post_id                       =   $request->input('post_id');
            $compare->compare_item_id               =   $update['compare_item_id'];
            $compare->sender_id                     =   $update['sender_id'];
            $compare->sender_role                   =   $update['sender_role'];
            $compare->updated_at                    =   Carbon::now()->toDateTimeString();
            $compare->save();
            $result                                 =   $compare->compare_id;
        }
        $post = new Post;

        $list = $this->getDetailsByAny(array('agents_compare.post_id' => $request->input('post_id'), 'agents_compare.sender_id' => $update['sender_id'], 'agents_compare.sender_role' => $update['sender_role']));
        foreach ($list as $data) {
            $data->description = strip_tags($data->description);
            $data->compare_json = json_decode($data->compare_json);
        }
        return response()->json(['status' => '100', 'compare_id' => $result, 'list' => $list]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Compare  $compare
     * @return \Illuminate\Http\Response
     */
    public function show($limit, $userid = null, $role = null, $post_id = null)
    {
        $compare = new Compare;
        $result = $compare->getDetailsByAny($limit, array('agents_compare.post_id' => $post_id, 'agents_compare.sender_id' => $userid, 'agents_compare.sender_role' => $role));
        return response()->json($result);
    }
    /**
     * Show ComparedDataGetByPost
     */
    public function ComparedDataGetByPost()
    {
        $post_id = '112';
        $sender_id = '105';
        $sender_role = '3';
        $update = array();
        $update['post_id']              =  '112';
        $update['sender_id']            =   '105';
        $update['sender_role']          =   '3';

        $compare = new Compare;
        $comparedata = $compare->getCompareSingalByAny($update);
        $askedquestiondata = [];
        if (!empty($comparedata)) {
            $sharedquestion = $compare->GetAskedQuestion(
                array(
                    'agents_shared.shared_type' => '1',
                    'agents_shared.shared_item_type' => '2',
                    'agents_shared.shared_item_type_id' => $post_id,
                    'agents_shared.sender_id' => $sender_id,
                    'agents_shared.sender_role' => $sender_role,
                    'agents_shared.receiver_role' => '4',
                    'agents_question.is_deleted' => '0',
                ),
                array('colume' => 'agents_shared.receiver_id', 'value' => explode(',', $comparedata->compare_item_id))
            );
            foreach ($sharedquestion as $key => $value) {
                $askedquestion = array('asked' => '');
                if ($comparedata->compare_json != null) {
                    $jsondata = json_decode($comparedata->compare_json);
                    if ($jsondata->asked_question == 1 && !empty($jsondata->asked_question_list)) {
                        $jsak = (array) $jsondata->asked_question_list;
                        shuffle($jsak);
                        $asked = @in_array($value->question_id, $jsak) == 1 ? $value->question_id : '';
                        $askedquestion = array('asked' =>  $asked);
                    }
                }
                $askedquestiondata[] = (object) array_merge((array) $value, (array) $askedquestion);
            }
        }
        return response()->json(array('comparedata' => $comparedata, 'askedquestiondata' => $askedquestiondata));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compare  $compare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compare $compare)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $update = array();
        $update['compare_id']              =   $request->input('compare_id');
        // dd($request->input('compare_id'));
        $user_id = $request->input('agent_user_id');
        $compare = new Compare;
        

        $acheck = $compare->getCompareSingalByAny($update);
        // dd($acheck);
        if (!empty($acheck)) {
            $bookbarkupdate                         =  Compare::find($acheck->compare_id);
            $bookbarkupdate->compare_item_id        =  $this->removeItemString($acheck->compare_item_id, $user_id);
            // $bookbarkupdate->compare_item_role_id   =  $this->removeItemString($acheck->compare_item_role_id,$user_roleid);
            $bookbarkupdate->updated_at             =  Carbon::now()->toDateTimeString();
            $bookbarkupdate->save();
            $result['compare_id']                    =   $bookbarkupdate->compare_id;

            $list = $this->getDetailsByAny(array('agents_compare.post_id' => '112', 'agents_compare.sender_id' => '105', 'agents_compare.sender_role' => '3'));
            foreach ($list as $data) {
                $data->description = strip_tags($data->description);
                $data->compare_json = json_decode($data->compare_json);
            }
            $result['list']  = $list;
            return response()->json(['status' => '100', 'compare_id' => $result['compare_id']  ]);
        }
        return response()->json(['status' => '101', 'response' => 'error']);
    }

    public function removeItemString($str, $item)
    {
        $parts = explode(',', $str);
        while (($i = array_search($item, $parts)) !== false) {
            unset($parts[$i]);
        }
        return implode(',', $parts);
    }
}
