<?php

namespace App\Http\Controllers\Administrator\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index(){
        $plans = Plan::get();
        return view('admin.pages.plans.index',compact('plans'));
    }

    public function create(){
        return view('admin.pages.plans.create');
    }

    public function store(Request $req){
        if(!$req->designs){
            return redirect()->back()->with('error','Please select atleast one design!')->withInput();
        }
        $plan = Plan::create([
            'title' => $req->title,
            'description' => $req->description,
            'price' => $req->price,
            'duration' => $req->duration,
            'designs' => implode(',',$req->designs),
            'no_of_popins' => $req->no_of_popins,
            'status' => $req->status,
        ]);
        return redirect()->back()->with('success','Plan added successfully');
    }

    public function edit($id){
        $plan = Plan::where('id',$id)->first();
        return view('admin.pages.plans.update',compact('plan'));
    }

    public function update(Request $req){
        if(!$req->designs){
            return redirect()->back()->with('error','Please select atleast one design!')->withInput();
        }
        $plan = Plan::where('id',$req->plan_id)->update([
            'title' => $req->title,
            'description' => $req->description,
            'price' => $req->price,
            'duration' => $req->duration,
            'designs' => implode(',',$req->designs),
            'no_of_popins' => $req->no_of_popins,
            'status' => $req->status,
        ]);
        return redirect()->back()->with('success','Plan updated successfully');
    }

    public function delete($id){
        $plan = Plan::where('id',$id)->delete();
        return redirect()->back()->with('success','Plan deleted successfully');
    }

    public function payments(){
        $payments = DB::table('payments')->orderBy('id','DESC')->get();
        return view('admin.pages.plans.payments',compact('payments'));
    }

    public function delete_payment_record($id){
        $payment = DB::table('payments')->where('id',$id)->delete();
        return redirect()->back()->with('success','Payment record deleted successfully');
    }
}
