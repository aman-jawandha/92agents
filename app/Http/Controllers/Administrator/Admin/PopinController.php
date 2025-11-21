<?php

namespace App\Http\Controllers\Administrator\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Popin;
use Carbon\Carbon;

class PopinController extends Controller
{
    public function popins(){
        $popins = Popin::orderBy('id','DESC')->get();
        return view('admin.pages.popins.popinslist',compact('popins'));
    }

    public function add_popin(){
        return view('admin.pages.popins.add_popin');
    }

    public function store_popin(Request $request){
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('uploads/popin_images'), $filename);
            $image = $filename;
        }else{
            $image = null;
        }
        $popin = Popin::create([
            'for_whom' => $request->for_whom,
            'title' => $request->title,
            'heading' => $request->heading	,
            'description' => $request->description,
            'url' => $request->url,
            'bg_color' => $request->bg_color,
            'btn_color' => $request->btn_color,
            'design' => $request->design,
            'status' => $request->status,
            'image' => $image,
            'agent_id' => auth()->id(),
        ]);
        return redirect()->route('admin.popins')->with('success','Popin added successfully');
    }

    public function edit_popin($id){
        $popin = Popin::where('id',$id)->first();
        return view('admin.pages.popins.update_popin',compact('popin'));
    }

    public function update_popin(Request $request){
        $popin = Popin::where('id',$request->popin_id)->first();
        $popin->for_whom = $request->for_whom;
        $popin->title = $request->title;
        $popin->heading = $request->heading;
        $popin->description = $request->description;
        $popin->url = $request->url;
        $popin->bg_color = $request->bg_color;
        $popin->btn_color = $request->btn_color;
        $popin->design = $request->design;
        $popin->status = $request->status;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('uploads/popin_images'), $filename);
            $popin->image = $filename;
        }
        $popin->save();
        return redirect()->back()->with('success','Popin updated successfully');
    }

     public function delete_popin($id){
        $popin = Popin::where('id',$id)->delete();
        return redirect()->back()->with('success','Popin deleted successfully');
    }

    public function show_popin(Request $request)
{
    $userRoleId = auth()->user()->agents_users_role_id;
    $today = date('Y-m-d');

    $previousTime = session('previous_popin_time')
        ? Carbon::parse(session('previous_popin_time'))
        : null;

    // 1. Get agent IDs with active plans
    $activePlanAgentIds = DB::table('user_plans')
        ->where('start_date', '<=', $today)
        ->where('end_date', '>=', $today)
        ->pluck('user_id');

    // 2. Base popin query with rules applied
    $popinQuery = function () use ($userRoleId, $activePlanAgentIds) {
        return Popin::whereIn('for_whom', [$userRoleId, 'All'])
            ->where(function ($q) use ($activePlanAgentIds) {
                
                // Always show these
                $q->whereIn('status', ['Most Liked', 'Reward'])
                
                // Show Active popins only if their agent has active plan
                ->orWhere(function ($q2) use ($activePlanAgentIds) {
                    $q2->where('status', 'Active')
                       ->whereIn('agent_id', $activePlanAgentIds);
                });

            });
    };

    // 3. Apply 10-minute rule
    if (!$previousTime || now()->greaterThanOrEqualTo($previousTime->addMinutes(10))) {

        // If previous ID exists → show next older popin
        if (session('previous_popin_id')) {

            $popin = $popinQuery()
                ->where('id', '<', session('previous_popin_id'))
                ->orderBy('id', 'desc')
                ->first();

            // Loop back to latest if no older popin found
            if (!$popin) {
                $popin = $popinQuery()
                    ->orderBy('id', 'desc')
                    ->first();
            }

        } else {
            // First time: show newest popin
            $popin = $popinQuery()
                ->orderBy('id', 'desc')
                ->first();
        }

        // If popin found, store session and return HTML
        if ($popin) {
            session([
                'previous_popin_id' => $popin->id,
                'previous_popin_time' => now(),
            ]);

            return view('popins', compact('popin'))->render();
        }
    }

    return response()->json(['html' => '']);
}

public function view_popin(Request $req)
{
    $popin = Popin::where('id', $req->popin_id)->first();
    return view('popins', compact('popin'))->render();
}

public function popin_detail($id)
{
    $popin = Popin::where('id', $id)->first();
    return view('front.publicPage.popin_detail', compact('popin'));
}
}
