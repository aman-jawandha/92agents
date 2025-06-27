<?php

namespace App\Http\Controllers\Administrator\Agents\QuestionAnswers;

use App\Events\eventTrigger;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestionAnswers;
use App\Models\Survey;
use App\Models\Shared;
use App\Models\Notification;
use App\Models\Bookmark;
use App\Models\Rating;
use App\Models\Importance;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;


class QuestionAnswersController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'question_type' => ['required', 'numeric', Rule::in([1, 2, 3, 4, 5]),],
            'add_by' => 'required',
            'add_by_role' => 'required',
            'survey' => 'nullable',
            'importance' => 'nullable',
        ], [
            'question.required' => 'The Question Field is Required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $QuestionAnswers = new QuestionAnswers;
        $QuestionAnswers->question = $request->question;
        $QuestionAnswers->question_type =  $request->question_type;
        $QuestionAnswers->add_by =  $request->add_by;
        $QuestionAnswers->add_by_role =  $request->add_by_role;

        if ($request->survey) {
            $QuestionAnswers->survey =  $request->survey;
        } else {
            $QuestionAnswers->survey =  '0';
        }

        if ($request->importance) {
            $QuestionAnswers->importance =  $request->importance;
        } else {
            $QuestionAnswers->importance =  '0';
        }

        $QuestionAnswers->save();

        $qid = $QuestionAnswers;

        if ($request->survey == 1) {
            $client = new Survey();
            $client->question_id = $qid->question_id;
            $client->agents_user_id = $request->add_by;
            $client->agents_users_role_id = $request->add_by_role;
            $client->save();
        }

        if ($request->importance == 1) {
            $client = new Importance();
            $client->importance_item_id = $qid->question_id;
            $client->importance_type = '1';
            $client->agents_user_id = $request->add_by;
            $client->agents_users_role_id = $request->add_by_role;
            $client->save();
        }

        if ($request->importance == 1 && $request->survey == 1) {
            $msg = "Question has been added To Important and Survey Questons";
        } elseif ($request->importance == 1) {
            $msg = "Importatnt Question has been added";
        } elseif ($request->survey == 1) {
            $msg = "Survey Question has been added";
        } else {
            $msg = "Survey Question has been added";
        }
        $points = DB::table('agents_users')->where('id', auth()->id())->increment('points', 5);
        $points_history = DB::table('agent_points_history')->insert([
            'agent_id' => auth()->id(),
            'plus_points' => 5,
            'points_for' => 'For posting a question',
        ]);
        return response()->json(["status" => "100", "msg" => $msg, 'data' => $qid]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function questiontoanswer(Request $request)
    {
        $user   = User::where('id', $request->from_id)->first();
        $where = $update = [];
        $rules = [
            'answers'              => 'required',
        ];
        $messages = [
            'answers.required' => 'The Answer Field is Required'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $update['answers'] =  $request->answers;
        if (!empty($request->post_id)) {
            $update['post_id'] =  $request->post_id;
        }
        $update['question_id'] =  $request->question_id;
        $update['from_id'] =  $request->from_id;
        $update['from_role'] =  $request->from_role;
        $QuestionAnswers = new QuestionAnswers;
        $alrdans = $QuestionAnswers->getAnswersByAny(['is_deleted' => '0', 'question_id' => $update['question_id'], 'from_id' =>  $update['from_id'], 'from_role' => $update['from_role']]);
        if (!empty($alrdans)) {
            $update['updated_at'] = Carbon::now()->toDateTimeString();
            $resutl = $QuestionAnswers->inserupdateAnswers($update, ['answers_id' => $alrdans->answers_id]);
        } else {
            $update['created_at'] = Carbon::now()->toDateTimeString();
            $resutl = $QuestionAnswers->inserupdateAnswers($update);
        }
        $noti = new Notification;
        $noti->sender_id                   = $user->id;
        $noti->sender_role                 = $user->agents_users_role_id;
        $noti->receiver_id                 = $request->receiver_id;
        $noti->receiver_role               = $request->receiver_role;
        $noti->notification_type           = 10;
        $noti->notification_item_id        = $resutl;
        $noti->notification_child_item_id  = $update['question_id'];
        $noti->status                      = 1;
        $noti->notification_message        = $request->notification_message;
        $noti->updated_at                  = Carbon::now()->toDateTimeString();
        $noti->save();
        $points = DB::table('agents_users')->where('id', auth()->id())->increment('points', 5);
        $points_history = DB::table('agent_points_history')->insert([
            'agent_id' => auth()->id(),
            'plus_points' => 5,
            'points_for' => 'For posting an answer',
        ]);
        event(new eventTrigger([$request->all(), $resutl, 'NewNotification']));
        return response()->json(["msg" => "This question answers successfully send."]);
    }

    public function allsubmitquestiontoanswer(Request $request)
    {

        $QuestionAnswers = new QuestionAnswers;
        $noti = new Notification;
        $user   = Auth::user();
        $where = $update = [];

        if (!empty($request->post_id)) {
            $update['post_id'] =  $request->post_id;
        }
        $update['from_id'] =  $request->from_id;
        $update['from_role'] =  $request->from_role;

        foreach ($request->question_id as $key => $value) {
            $question_id = $value;
            $answers = $request->question_default[$value];

            if (!empty($answers)) {
                $update['question_id'] =  $question_id;
                $update['answers'] =  $answers;
                $alrdans = $QuestionAnswers->getAnswersByAny(['is_deleted' => '0', 'question_id' => $question_id, 'from_id' =>  $update['from_id'], 'from_role' => $update['from_role']]);
                if (!empty($alrdans)) {

                    $update['updated_at'] = Carbon::now()->toDateTimeString();

                    $resutl = $QuestionAnswers->inserupdateAnswersall($update, ['answers_id' => $alrdans->answers_id]);

                    if ($resutl != 'noupdate') {

                        $noti->sender_id                   = $user->id;
                        $noti->sender_role                 = $user->agents_users_role_id;
                        $noti->receiver_id                 = $request->receiver_id;
                        $noti->receiver_role               = $request->receiver_role;
                        $noti->notification_type           = 10;
                        $noti->notification_item_id        = $resutl;
                        $noti->notification_child_item_id  = $update['question_id'];
                        $noti->status                      = 1;
                        $noti->notification_message        = $request->notification_message;
                        $noti->updated_at                  = Carbon::now()->toDateTimeString();
                        $noti->save();
                    }
                } else {
                    $update['created_at'] = Carbon::now()->toDateTimeString();
                    $resutl = $QuestionAnswers->inserupdateAnswersall($update);
                    $noti->sender_id                   = $user->id;
                    $noti->sender_role                 = $user->agents_users_role_id;
                    $noti->receiver_id                 = $request->receiver_id;
                    $noti->receiver_role               = $request->receiver_role;
                    $noti->notification_type           = 10;
                    $noti->notification_item_id        = $resutl;
                    $noti->notification_child_item_id  = $update['question_id'];
                    $noti->status                      = 1;
                    $noti->notification_message        = $request->notification_message;
                    $noti->updated_at                  = Carbon::now()->toDateTimeString();
                    $noti->save();
                }
            }
        }
        $points = DB::table('agents_users')->where('id', auth()->id())->increment('points', 5);
        $points_history = DB::table('agent_points_history')->insert([
            'agent_id' => auth()->id(),
            'plus_points' => 5,
            'points_for' => 'For posting an answer',
        ]);
        event(new eventTrigger([$request->all(), $resutl, 'NewNotification']));
        return response()->json(["msg" => "This question answers successfully send."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request)
    {

        $answers = [];

        $question = new QuestionAnswers;

        $result = $question->getQuestionByAny(['is_deleted' => '0', 'status' => '1', 'add_by' => @$request->add_by, 'add_by_role' => $request->add_by_role, 'question_type' => $request->question_type]);

        foreach ($result as $value) {

            $ans = $question->getAnswersByAny(['is_deleted' => '0', 'question_id' => $value->question_id, 'from_id' => $request->from_id, 'from_role' => $request->from_role]);

            if (empty($ans)) {

                $answers[$value->question_id] = '';
            } else {

                $answers[$value->question_id] = $ans->answers;
            }
        }

        return response()->json([$result, $answers]);
    }

    public function showSkill(Request $request)
    {

        $answers = [];

        $question = new QuestionAnswers;

        $result = $question->getQuestionByAny(['is_deleted' => '0', 'status' => '1', 'add_by' => @$request->add_by, 'add_by_role' => $request->add_by_role, 'question_type' => $request->question_type]);

        foreach ($result as $value) {

            $ans = $question->getAnswersByAny(['is_deleted' => '0', 'question_id' => $value->question_id, 'from_id' => $request->from_id, 'from_role' => $request->from_role]);

            if (empty($ans)) {

                $answers[$value->question_id] = '';
            } else {

                $answers[$value->question_id] = $ans->answers;
            }
        }

        return response()->json(['Question' => $result, 'answers' => $answers]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getonlyusersquestion(Request $request)
    {

        $question   = new QuestionAnswers;

        $bookmark = new Bookmark;

        $bookmarkdata = [];

        $rating = new Rating;

        $ratingdata = [];

        $where = $answers = $share = [];

        if ($request->add_by) {

            $where['add_by'] = $request->add_by;
        }

        if ($request->add_by_role) {

            $where['add_by_role'] = $request->add_by_role;
        }

        if ($request->question_type) {

            $where['question_type'] = $request->question_type;
        }

        if ($request->importance) {

            $where['importance'] = $request->importance;
        }

        if ($request->survey) {

            $where['survey'] = $request->survey;
        }

        $where['is_deleted'] = '0';

        $result     = $question->getQuestionByAny($where);

        if ($request->share && $request->share == 'ask_question') {

            $shared = new Shared;

            foreach ($result as $value) {

                $aa = [
                    'shared_type' => 1,
                    'shared_item_id' => $value->question_id,
                    'shared_item_type' => $request->shared_item_type,
                    'shared_item_type_id' => $request->post_id,
                ];

                $aa['sender_id'] = $request->add_by;
                $aa['sender_role'] = $request->add_by_role;
                $aa['receiver_id'] = $request->receiver_id;
                $aa['receiver_role'] = $request->question_type;

                $ss = $shared->getsinglerowByAny($aa);
                if (empty($ss)) {
                    $share[$value->question_id] = '';
                } else {
                    $share[$value->question_id] = $ss->shared_id;
                }

                $ans = $question->getAnswersByAny(['post_id' => $request->post_id, 'is_deleted' => '0', 'question_id' => $value->question_id, 'from_id' => $request->receiver_id, 'from_role' => $request->question_type]);
                if (empty($ans)) {
                    $answers[$value->question_id] = '';
                } else {
                    $answers[$value->question_id] = $ans;

                    if ($request->bookmark && !empty($request->bookmark)) {

                        $bok = $bookmark->getBookmarkSingalByAny(['bookmark_type' => 4, 'bookmark_item_id' => $ans->answers_id, 'bookmark_item_parent_id' => $ans->question_id, 'sender_id' => $request->add_by, 'sender_role' => $request->add_by_role, 'receiver_id' => $request->receiver_id, 'receiver_role' => $request->question_type]);

                        if (empty($bok)) {
                            $bookmarkdata[$ans->answers_id] = '';
                        } else {
                            $bookmarkdata[$ans->answers_id] = $bok;
                        }
                    }

                    if ($request->rating && !empty($request->rating)) {

                        $rat = $rating->getRatingSingalByAny(['rating_type' => 1, 'rating_item_id' => $ans->answers_id, 'rating_item_parent_id' => $ans->question_id, 'sender_id' => $request->add_by, 'sender_role' => $request->add_by_role, 'receiver_id' => $request->receiver_id, 'receiver_role' => $request->question_type]);

                        if (empty($rat)) {
                            $ratingdata[$ans->answers_id] = '';
                        } else {
                            $ratingdata[$ans->answers_id] = $rat;
                        }
                    }
                }
            }

            return response()->json([$result, $share, $answers, $bookmarkdata, $ratingdata]);
        }

        return response()->json($result);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required',
            'question' => 'required',
            'add_by' => 'required',
            'add_by_role' => 'required',
        ], [
            'question.required' => 'The Question Field is Required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $update['question'] =  $request->question;
        $update['add_by'] =  $request->add_by;
        $update['add_by_role'] =  $request->add_by_role;
        $update['updated_at'] = Carbon::now()->toDateTimeString();

        $QuestionAnswers = new QuestionAnswers;

        $QuestionAnswers->inserupdate($update, ['question_id' => $request->question_id]);

        return response()->json(["msg" => "Question has been updated successfully."]);
    }
}