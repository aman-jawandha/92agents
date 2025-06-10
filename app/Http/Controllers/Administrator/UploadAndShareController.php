<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shared;
use App\Models\UploadAndShare;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Exception;

class UploadAndShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        if (empty($request->input('id'))) {
            $rules = array(
                'name' => 'required|max:100',
                'uploadshare' => 'required|mimes:jpeg,jpg,png,doc,pdf,docx|max:15360',
            );

            $messages = [
                'name.required' => 'File Name field is required',
                'name.max' => 'File Name cannot be greater than 100 characters',
                'uploadshare.max' => 'File Upload should be less then 15MB.',
                'uploadshare.mimes' => 'The uploaded file must be a file of type: jpeg, jpg, png, doc, pdf, docx.',
                'uploadshare.required' => 'Upload File is required'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            }

            if (empty($request->input('name'))) {
                return response()->json(['error' => "Please enter a name"]);
            }


            $image = $request->file('uploadshare');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/img/upload_and_share/');
            $image->move($destinationPath, $filename);
            $filepath = url("assets/img/upload_and_share/" . $filename);
            $postdetailsnew = array();
            $postdetailsnew['agents_user_id'] = $request->input('agents_user_id');
            $postdetailsnew['agents_users_role_id'] = $request->input('agents_users_role_id');
            $postdetailsnew['attachments'] = $filepath;
            $postdetailsnew['name'] = $request->input('name');

            $uploadandshare = new UploadAndShare;
            $re = $uploadandshare->inserupdate($postdetailsnew);
        } else {
            $rules = array(
                'name' => 'required|max:100',
                'uploadshare' => 'required|mimes:jpeg,jpg,png,doc,pdf,docx|max:15360',
            );

            $messages = [
                'name.required' => 'File Name field is required',
                'name.max' => 'File Name cannot be greater than 100 characters',
                'uploadshare.max' => 'File Upload should be less then 15MB.',
                'uploadshare.required' => 'File upload is required'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            }

            if (empty($request->input('name'))) {
                return response()->json(['error' => "Please enter a name"]);
            }

            $uploadandshare = UploadAndShare::find($request->input('id'));
            $re = 1;
            if ($request->file('uploadshare') && !empty($request->file('uploadshare'))) {
                try {
                    $atachpath = str_replace(url('/') . '/', '', $uploadandshare->attachments);
                    File::delete($atachpath);
                } catch (Exception $e) {

                }
                $image = $request->file('uploadshare');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('assets/img/upload_and_share/');
                $image->move($destinationPath, $filename);
                $filepath = url("assets/img/upload_and_share/" . $filename);
                $uploadandshare->attachments = $filepath;
                $uploadandshare->updated_at = Carbon::now()->toDateTimeString();
                $uploadandshare->name = $request->input('name');
                $re = $uploadandshare->save();
            }
        }

        if ($re) {
            return response()->json(["msg" => "Your file has been uploaded successfully"]);
        } else {
            return response()->json(["msg" => array('error' => 'Please try again in a few minutes.')]);
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
        $uploadandshare = new UploadAndShare;
        $result = $uploadandshare->getDetailsByAny($limit, array('is_deleted' => '0', 'agents_user_id' => $userid, 'agents_users_role_id' => $role));
        return response()->json($result);
    }

    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function showten($limit, $userid, $role)

    {

        $uploadandshare = new UploadAndShare;

        $result = $uploadandshare->gettenDetailsByAny($limit, array('is_deleted' => '0', 'agents_user_id' => $userid, 'agents_users_role_id' => $role));

        return response()->json($result);
    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function getfileswithshared(Request $request, $limit)

    {

        $sproposal = array();

        $proposals = new UploadAndShare;

        $shared = new Shared;

        $result = $proposals->getDetailsByAny($limit, array('is_deleted' => '0', 'agents_user_id' => $request->input('sender_id'), 'agents_users_role_id' => $request->input('sender_role')));

        foreach ($result['result'] as $value) {



            $aa['shared_type']          = 2;

            $aa['shared_item_id']       = $value->upload_share_id;

            $aa['shared_item_type']     = $request->input('shared_item_type');

            $aa['shared_item_type_id']  = $request->input('post_id');

            $aa['sender_id']            = $request->input('sender_id');

            $aa['sender_role']          = $request->input('sender_role');

            $aa['receiver_id']          = $request->input('receiver_id');

            $aa['receiver_role']        = $request->input('receiver_role');

            $ss = $shared->getsinglerowByAny($aa);

            if (empty($ss)) {

                $sproposal[$value->upload_share_id] = '';
            } else {

                $sproposal[$value->upload_share_id] = $ss;
            }
        }

        return response()->json(array($result, $sproposal));
    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        //

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        //

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function delete($id)

    {

        $uploadandshare = UploadAndShare::find($id);

        $uploadandshare->is_deleted = '1';

        if ($uploadandshare->save()) {

            return response()->json(["status" => 'success', "msg" => "You file has been deleted successfully"]);
        } else {

            return response()->json(["status" => 'error', "msg" => 'Please try again in a few minutes.']);
        }
    }
}
