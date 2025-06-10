<?php

namespace App\Http\Controllers\Api;

use App\Events\eventTrigger;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Userdetails;
use App\Models\Survey;
use App\Models\QuestionAnswers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buyersindex(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'agents_user_id' => 'required|numeric',
            'agents_users_role_id' => 'required|numeric',
            'type' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => '101', 'error' => $validator->errors()], 422);
        }

        $user = DB::table('agents_users')
            ->where('id', $request->agents_user_id)
            ->where('agents_users_role_id', $request->agents_users_role_id)
            ->first();

        if (!$user) {
            return response()->json(['msg' => 'User not found'], 400);
        }

        $question = QuestionAnswers::where('add_by', $request->agents_user_id)
            ->where('add_by_role', $request->agents_users_role_id)
            ->where('survey', $request->type)
            ->get();

        if ($request->type == 1) {
            $question_id = [];

            foreach ($question as $questions) {
                $question_id[] = $questions->question_id;
            }

            $quiz_id = $question_id;

            $survey_quiz = Survey::whereIn('question_id', $quiz_id)
                ->where('is_deleted', "0")->with('detail')
                ->get();

            return response()->json(['msg' => 'Survey Questions fetched successfully', 'data' => $survey_quiz], 200);
        }

        return response()->json(['msg' => 'Questions fetched successfully', 'data' => $question], 200);
    }

    /* For get agents index */
    public function agentsindex(Request $request)
    {
        $view['user'] = $user = DB::table('agents_users')->where('id', $request->user_id)->where('agents_users_role_id', 4)->first();
        if (!$user) {
            return response()->json(['msg' => 'user not found'], 400);
        }
        $view['userdetails'] = $userdetails = Userdetails::find($user->id);
        return response()->json(['msg' => 'user details are fetched successfully', 'data' => $view], 200);
    }

    /* For get limited date by any */
    public function getLimitedDataByAny($limit = null, $agents_user_id = null, $agents_users_role_id = null)
    {
        $import = new Survey;
        $result = $import->getDetailsByAny($limit, ['agents_question.survey' => '1', 'agents_survey.is_deleted' => '0', 'agents_survey.agents_user_id' => $agents_user_id, 'agents_survey.agents_users_role_id' => $agents_users_role_id]);
        $resultnew = json_decode(json_encode($result));
        return response()->json($resultnew->result);
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
        if ($request->all() != '') {
            $QuestionAnswers = QuestionAnswers::find($request->question_id);
            $QuestionAnswers->survey = '1';
            $QuestionAnswers->updated_at = Carbon::now()->toDateTimeString();
            $QuestionAnswers->save();
            $import = new Survey;
            if ($import->inserupdate(['question_id' => $request->question_id, 'agents_user_id' => $request->agents_user_id, 'agents_users_role_id' => $request->agents_users_role_id])) {
                return response()->json(["status" => 'success', "msg" => "Survey Question has been added successfully"]);
            } else {
                return response()->json(["status" => 'error', "msg" => 'Please try again in a few minutes.']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeservaylistquestion(Request $request)
    {
        DB::table('agents_survey')->where(['question_id' => $request->question_id, 'agents_user_id' => $request->add_by, 'agents_users_role_id' => $request->add_by_role])->delete();
        $QuestionAnswers = QuestionAnswers::find($request->question_id);
        $QuestionAnswers->survey = '0';
        $QuestionAnswers->updated_at = Carbon::now()->toDateTimeString();
        $QuestionAnswers->save();
        return response()->json(["status" => 'success', "msg" => "Your Survey Question is deleted successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $survey = Survey::find($id);
        $QuestionAnswers = QuestionAnswers::find($survey->question_id);
        $QuestionAnswers->survey = '0';
        $QuestionAnswers->updated_at = Carbon::now()->toDateTimeString();
        $QuestionAnswers->save();
        DB::table('agents_survey')->where('survey_id', $id)->delete();
        return response()->json(["status" => 'success', "msg" => "Your Survey Question is deleted successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function SurvayLoopQuestion(Request $request)
    {
        $Survey = new Survey;
        $where = [
            'agents_users_conections.to_id' => Auth::user()->id,
            'agents_users_conections.to_role' => Auth::user()->agents_users_role_id,
        ];
        $orwhere = [
            'agents_users_conections.from_id' => Auth::user()->id,
            'agents_users_conections.from_role' => Auth::user()->agents_users_role_id,
        ];
        $result = $Survey->getSurvayLoopQuestionByAny($where, $orwhere);
        return response()->json($result);
    }
}