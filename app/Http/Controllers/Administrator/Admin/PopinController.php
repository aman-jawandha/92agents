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

    $previousTime = session('previous_popin_time') 
        ? Carbon::parse(session('previous_popin_time')) 
        : null;

    if (!$previousTime || now()->greaterThanOrEqualTo($previousTime->addMinutes(10))) {

        if (session('previous_popin_id')) {
            // Get the next popin with id < previous one (DESC order)
            $popin = Popin::where('status', 'Active')
                ->where('for_whom', $userRoleId)
                ->where('id', '<', session('previous_popin_id'))
                ->orderBy('id', 'desc')
                ->first();

            // If none found (we're at the oldest), loop back to latest
            if (!$popin) {
                $popin = Popin::where('status', 'Active')
                    ->where('for_whom', $userRoleId)
                    ->orderBy('id', 'desc')
                    ->first();
            }
        } else {
            // First time: show latest
            $popin = Popin::where('status', 'Active')
                ->where('for_whom', $userRoleId)
                ->orderBy('id', 'desc')
                ->first();
        }

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

}
