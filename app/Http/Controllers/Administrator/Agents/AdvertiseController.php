<?php

namespace App\Http\Controllers\Administrator\Agents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Stripe\Checkout\Session;
use Carbon\Carbon;
use App\Models\Plan;
use App\Models\Popin;

class AdvertiseController extends Controller
{
    public function agent_advertisement(){
        $user_plan = DB::table('user_plans')->where('user_id',auth()->id())->first();
        $popins = Popin::where('agent_id',auth()->id())->orderBy('id','DESC')->paginate(3);
        return view('dashboard.user.agents.advertisements.advertise',compact('popins','user_plan'));
    }

    public function agent_adds_plans(){
        $plans = Plan::where('status','Active')->paginate(3);
        $user_plan = DB::table('user_plans')->where('user_id',auth()->id())->first();
        return view('dashboard.user.agents.advertisements.plans',compact('plans','user_plan'));
    }

    public function payment_form(Request $request){
        Stripe::setApiKey(config('services.stripe.secret'));
        $plan = Plan::where('id',$request->plan_id)->first();
        $amount = round($plan->price * 100);
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $plan->title,
                    ],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'metadata' => [
                'plan_id' => $plan->id,
                'agent_id' => auth()->id(),
            ],
            'mode' => 'payment',
            'success_url' => route('agent-stripe-payment') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('agent-adds-plans') . '?canceled=true',
        ]);

        return redirect($session->url);
    }

    public function stripe_payment(Request $request){
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $sessionId = $request->get('session_id');
        $session = \Stripe\Checkout\Session::retrieve($sessionId);
        $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

        $agentId = $session->metadata->agent_id;
        $planId = $session->metadata->plan_id;

        $plan = Plan::where('id',$planId)->first();
        $status = $session->payment_status === 'paid' ? 'success' : 'failed';
        $paymentId = $paymentIntent->id;
        $amount = $paymentIntent->amount_received / 100;
        $currency = strtoupper($paymentIntent->currency);

        // Save payment record
        $user_name = DB::table('agents_users_details')->where('details_id',auth()->id())->first()->name;
        $payment = DB::table('payments')->insert([
                'payment_id' => $paymentId,
                'user_id' => $agentId,
                'payment_status' => $status,
                'amount' => $amount,
                'payment_for' => 'Plan - '.$plan->title,
                'payment_by' => $user_name,
                'user_role' => auth()->user()->agents_users_role_id,
            ]);

    if ($status === 'success') {
        $start_date = Carbon::today()->toDateString();
        $end_date = Carbon::today()->addMonths($plan->duration)->toDateString();
        
            $user_plan = DB::table('user_plans')->updateOrInsert(
            ['user_id' => $agentId],
            [
                'plan_id' => $planId,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'duration' => $plan->duration,
                'designs' => $plan->designs,
                'no_of_popins' => $plan->no_of_popins,
                'price' => $amount,
            ]);
            $idsToPreserve = Popin::where('agent_id', $agentId)->where('status', 'Active')->orderBy('id','DESC')->limit($plan->no_of_popins)->pluck('id');
            $deactivate_popins = Popin::where('agent_id', $agentId)->where('status', 'Active')->whereNotIn('id', $idsToPreserve)->update(['status' => 'Inactive']);
        return redirect()->route('agent-adds-plans')->with('success', 'Plan subscribed successfully!');
    }

    return redirect()->route('agent-adds-plans')->with('error', 'Payment failed or was cancelled.');
    }

     public function create_advrtismnt(){
        $user_plan = DB::table('user_plans')->where('user_id',auth()->id())->first();
        $user_popins = Popin::where('agent_id',auth()->id())->where('status','Active')->count();
        if($user_plan && $user_plan->start_date <= date('Y-m-d') && $user_plan->end_date >= date('Y-m-d')){
             if($user_plan->no_of_popins > $user_popins){
            return view('dashboard.user.agents.advertisements.create',compact('user_plan'));
        }else{
            return redirect()->back()->with('error', 'Your plan limit for active advertisements has been reached. Please upgrade your plan or set an existing advertisement to Inactive to proceed.');
        }
        }else{
            return redirect()->back()->with('error', 'Please subscribe any plan to add advertisement');
        } 
     }

     public function store_advrtismnt(Request $request){
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
        return redirect()->route('agent-advertisement')->with('success','Advertisement added successfully');
    }

    public function edit_advrtismnt($id){
        $popin = Popin::where('id',$id)->first();
        $user_plan = DB::table('user_plans')->where('user_id',auth()->id())->first();
        return view('dashboard.user.agents.advertisements.update',compact('popin','user_plan'));
    }

    public function update_advrtismnt(Request $request){
        $user_plan = DB::table('user_plans')->where('user_id',auth()->id())->first();
        $user_popins = Popin::where('agent_id',auth()->id())->where('status','Active')->count();
        if(($user_plan && $user_plan->no_of_popins > $user_popins) || ($request->status != 'Active')){
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
            return redirect()->back()->with('success','Advertisement updated successfully');
        }else{
            return redirect()->back()->with('error', 'You already have the maximum number of active advertisements, allowed by your current plan. Please change status of this or any other advertisement to inactive or upgrade your plan.');
        }
    }

     public function delete_advrtismnt($id){
        $popin = Popin::where('id',$id)->delete();
        return redirect()->back()->with('success','Advertisement deleted successfully');
    }
}
