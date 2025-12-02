<?php

namespace App\Http\Controllers\Administrator\Agents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Stripe\Checkout\Session;
use Stripe\Invoice as StripeInvoice;
use Stripe\Subscription as StripeSubscription;
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
        $plan = Plan::where('id',$request->plan_id)->firstOrFail();
        $amount = round($plan->price * 100);
        $metadata = [
            'plan_id' => $plan->id,
            'agent_id' => auth()->id(),
            'plan_type' => $plan->type,
            'duration' => $plan->duration,
            'billing_cycle' => $this->getBillingCycleFromDuration((int) $plan->duration),
        ];

        if (strtolower($plan->type) === 'recurring') {
            $session = Session::create([
                'mode' => 'subscription',
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $plan->title,
                        ],
                        'unit_amount' => $amount,
                        'recurring' => $this->getStripeIntervalConfig((int) $plan->duration),
                    ],
                    'quantity' => 1,
                ]],
                'metadata' => $metadata,
                'success_url' => route('agent-stripe-payment') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('agent-adds-plans') . '?canceled=true',
            ]);
        } else {
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
                'metadata' => $metadata,
                'mode' => 'payment',
                'success_url' => route('agent-stripe-payment') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('agent-adds-plans') . '?canceled=true',
            ]);
        }

        return redirect($session->url);
    }

    public function stripe_payment(Request $request){
        Stripe::setApiKey(config('services.stripe.secret'));

        $sessionId = $request->get('session_id');
        if (!$sessionId) {
            return redirect()->route('agent-adds-plans')->with('error', 'Missing payment session.');
        }

        $session = Session::retrieve($sessionId);

        $agentId = (int) ($session->metadata->agent_id ?? auth()->id());
        $planId = (int) ($session->metadata->plan_id ?? 0);

        $plan = Plan::find($planId);

        if (!$plan) {
            return redirect()->route('agent-adds-plans')->with('error', 'Selected plan could not be found.');
        }

        $isRecurring = $session->mode === 'subscription' || strtolower($plan->type) === 'recurring';

        if ($isRecurring) {
            return $this->completeRecurringCheckout($session, $plan, $agentId);
        }

        return $this->completeOnetimeCheckout($session, $plan, $agentId);
    }

    public function cancel_subscription(Request $request)
    {
        $userId = auth()->id();

        $userPlan = DB::table('user_plans')
            ->where('user_id', $userId)
            ->first();

        if (!$userPlan || empty($userPlan->stripe_subscription_id)) {
            return redirect()->route('agent-adds-plans')->with('error', 'No active recurring subscription found.');
        }

        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $subscription = StripeSubscription::retrieve($userPlan->stripe_subscription_id);

            // Cancel at period end so current paid period remains active
            StripeSubscription::update($subscription->id, [
                'cancel_at_period_end' => true,
            ]);
        } catch (\Throwable $e) {
            return redirect()->route('agent-adds-plans')->with('error', 'Unable to cancel subscription, please try again.');
        }

        DB::table('user_plans')
            ->where('id', $userPlan->id)
            ->update([
                'subscription_status' => 'cancel_at_period_end',
                'cancelled_at' => now(),
                'updated_at' => now(),
            ]);

        return redirect()->route('agent-adds-plans')->with('success', 'Your recurring subscription will be cancelled at the end of the current period.');
    }

     public function create_advrtismnt() {
        $user_plan = DB::table('user_plans')->where('user_id', auth()->id())->first();
        $user_popins = Popin::where('agent_id', auth()->id())->where('status', 'Active')->count();
        $user_points = auth()->user()->points ?? 0;
        $today = date('Y-m-d');
        $has_valid_plan = $user_plan && $user_plan->start_date <= $today && $user_plan->end_date >= $today;
        if ($has_valid_plan) {
            if ($user_plan->no_of_popins > $user_popins) {
                return view('dashboard.user.agents.advertisements.create', compact('user_plan'));
            } elseif ($user_points >= 20) {
                return view('dashboard.user.agents.advertisements.create', compact('user_plan'));
            } else {
                return redirect()->back()->with('error', 'Your plan limit for active advertisements has been reached. Please upgrade your plan, set an advertisement to Inactive, or earn at least 20 points to proceed.');
            }
        } elseif ($user_points >= 20) {
            return view('dashboard.user.agents.advertisements.create', compact('user_plan'));
        } else {
            return redirect()->back()->with('error', 'Please subscribe to a plan or earn at least 20 points to add an advertisement.');
        }
    }

    public function store_advrtismnt(Request $request)
{
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->move(public_path('uploads/popin_images'), $filename);
        $image = $filename;
    } else {
        $image = null;
    }

    $user = auth()->user();

    $user_plan = DB::table('user_plans')
        ->where('user_id', $user->id)
        ->first();

    $user_popins = Popin::where('agent_id', $user->id)
        ->where('status', 'Active')
        ->count();

    $today = date('Y-m-d');

    $has_valid_plan = $user_plan && $user_plan->start_date <= $today && $user_plan->end_date >= $today;

    $under_limit = $has_valid_plan && $user_plan->no_of_popins > $user_popins;

    // Determine type
    $status = $under_limit ? 'Active' : 'Reward';

    // Create popin
    Popin::create([
        'for_whom' => $request->for_whom,
        'title' => $request->title,
        'heading' => $request->heading,
        'description' => $request->description,
        'url' => $request->url,
        'bg_color' => $request->bg_color,
        'btn_color' => $request->btn_color,
        'design' => $request->design,
        'status' => $status,
        'image' => $image,
        'agent_id' => $user->id,
    ]);

    // Deduct points only if NOT under plan
    if (!$under_limit) {
        DB::table('agents_users')->where('id', $user->id)->decrement('points', 20);

        DB::table('agent_points_history')->insert([
            'agent_id' => $user->id,
            'minus_points' => 20,
            'points_for' => 'Created advertisement using points',
        ]);
    }

    return redirect()->route('agent-advertisement')
        ->with('success', 'Advertisement added successfully');
}

    public function edit_advrtismnt($id){
        $popin = Popin::where('id',$id)->first();
        $user_plan = DB::table('user_plans')->where('user_id',auth()->id())->first();
        return view('dashboard.user.agents.advertisements.update',compact('popin','user_plan'));
    }

    public function update_advrtismnt(Request $request){
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
        }

    public function update_popin_status($popin_id)
    {
        $popin = Popin::where('id', $popin_id)->where('agent_id', auth()->id())->firstOrFail();
        $user_plan = DB::table('user_plans')
            ->where('user_id', auth()->id())
            ->first();
        $user_popins = Popin::where('agent_id', auth()->id())
            ->where('status', 'Active')
            ->count();
        $user = auth()->user();
        $user_points = $user->points ?? 0;
        $today = date('Y-m-d');
        $has_valid_plan = $user_plan && $user_plan->start_date <= $today && $user_plan->end_date >= $today;
        $can_activate_by_plan = $has_valid_plan && $user_plan->no_of_popins > $user_popins;
        $can_activate_by_points = $user_points >= 20;
        if ($popin->status === 'Active') {
            $popin->status = 'Inactive';
            $popin->save();
            return redirect()->back()->with('success', 'Advertisement deactivated successfully.');
        } else {
            if ($can_activate_by_plan || $can_activate_by_points) {
                if (!$can_activate_by_plan && $can_activate_by_points) {
                    DB::table('agents_users')->where('id', $user->id)->decrement('points', 20);
                    DB::table('agent_points_history')->insert([
                        'agent_id' => $user->id,
                        'minus_points' => 20,
                        'points_for' => 'Activated advertisement using points',
                    ]);
                }
                $popin->status = 'Active';
                $popin->save();
                return redirect()->back()->with('success', 'Advertisement activated successfully.');
            } else {
                return redirect()->back()->with('error', 'Cannot activate: your plan limit is reached and you don’t have enough points. Upgrade your plan or reach at least 20 points to activate this advertisement.');
            }
        }
    }

     public function delete_advrtismnt($id){
        $popin = Popin::where('id',$id)->delete();
        return redirect()->back()->with('success','Advertisement deleted successfully');
    }

    public function agent_points($id){
        $points = DB::table('agent_points_history')->where('agent_id',$id)->paginate(10);
        return view('dashboard.user.agents.advertisements.points',compact('points'));
    }

    public function delete_points_history($id){
        $popin = DB::table('agent_points_history')->where('agent_id',$id)->delete();
        return redirect()->back()->with('success','History deleted successfully.');
    }

    public function agent_payment_history($id){
        $payments = DB::table('payment_history')->where('user_id',auth()->user()->id)->paginate(10);
        return view('dashboard.user.agents.advertisements.payments',compact('payments'));
    }

     public function delete_payment_history($id){
        $popin = DB::table('payment_history')->where('user_id',$id)->delete();
        return redirect()->back()->with('success','History deleted successfully.');
    }

    private function completeOnetimeCheckout($session, Plan $plan, int $agentId){
        $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);
        $status = $session->payment_status === 'paid' ? 'success' : 'failed';
        $paymentId = $paymentIntent->id;
        $amount = $paymentIntent->amount_received / 100;
        $amount = round($amount, 2);

        $userName = $this->resolveAgentName($agentId);

        DB::table('payments')->insert([
            'payment_id' => $paymentId,
            'user_id' => $agentId,
            'payment_status' => $status,
            'amount' => $amount,
            'payment_for' => 'Plan - '.$plan->title,
            'plan_type' => $plan->type,
            'payment_by' => $userName,
            'user_role' => auth()->user()->agents_users_role_id,
            'is_recurring' => false,
            'billing_cycle' => null,
            'stripe_subscription_id' => null,
            'stripe_invoice_id' => null,
            'cycle_start' => null,
            'cycle_end' => null,
        ]);

        $start_date = Carbon::today()->toDateString();
        $end_date = Carbon::today()->addMonths($plan->duration)->toDateString();

        DB::table('payment_history')->insert([
            'payment_id' => $paymentId,
            'user_id' => $agentId,
            'payment_status' => $status,
            'amount' => $amount,
            'payment_for' => $plan->title,
            'plan_type' => $plan->type,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'duration' => $plan->duration,
            'designs' => $plan->designs,
            'no_of_popins' => $plan->no_of_popins,
            'is_recurring' => false,
            'billing_cycle' => null,
            'stripe_subscription_id' => null,
            'stripe_invoice_id' => null,
            'cycle_number' => null,
        ]);

        if ($status === 'success') {
            $this->finalizePlanAssignment($agentId, $plan, $start_date, $end_date, $amount, [
                'is_recurring' => false,
                'billing_cycle' => null,
                'stripe_subscription_id' => null,
                'stripe_customer_id' => null,
                'next_billing_date' => null,
                'subscription_status' => 'one_time',
                'cancelled_at' => null,
                'last_invoice_id' => null,
            ]);
            return redirect()->route('agent-adds-plans')->with('success', 'Plan subscribed successfully!');
        }

        return redirect()->route('agent-adds-plans')->with('error', 'Payment failed or was cancelled.');
    }

    private function completeRecurringCheckout($session, Plan $plan, int $agentId){
        $subscriptionId = $session->subscription;
        if (!$subscriptionId) {
            return redirect()->route('agent-adds-plans')->with('error', 'Subscription could not be located.');
        }

        try {
            $subscription = StripeSubscription::retrieve($subscriptionId);
        } catch (\Throwable $th) {
            return redirect()->route('agent-adds-plans')->with('error', 'Unable to verify subscription.');
        }

        $invoiceId = $subscription->latest_invoice;
        if (!$invoiceId) {
            return redirect()->route('agent-adds-plans')->with('error', 'Subscription invoice not generated yet.');
        }

        try {
            $invoice = StripeInvoice::retrieve($invoiceId);
        } catch (\Throwable $th) {
            return redirect()->route('agent-adds-plans')->with('error', 'Unable to verify invoice.');
        }

        if ($invoice->status !== 'paid') {
            return redirect()->route('agent-adds-plans')->with('error', 'Subscription payment has not completed.');
        }

        $amount = round(($invoice->amount_paid / 100), 2);
        $periodStart = Carbon::createFromTimestamp($subscription->current_period_start)->toDateString();
        $periodEnd = Carbon::createFromTimestamp($subscription->current_period_end)->toDateString();
        $billingCycle = $this->getBillingCycleFromDuration((int) $plan->duration);
        $userName = $this->resolveAgentName($agentId);
        $cycleNumber = DB::table('payment_history')
            ->where('stripe_subscription_id', $subscriptionId)
            ->count() + 1;

        DB::table('payments')->insert([
            'payment_id' => $invoice->payment_intent ?? null,
            'user_id' => $agentId,
            'payment_status' => 'success',
            'amount' => $amount,
            'payment_for' => 'Plan - '.$plan->title,
            'plan_type' => $plan->type,
            'payment_by' => $userName,
            'user_role' => auth()->user()->agents_users_role_id,
            'is_recurring' => true,
            'billing_cycle' => $billingCycle,
            'stripe_subscription_id' => $subscriptionId,
            'stripe_invoice_id' => $invoiceId,
            'cycle_start' => $periodStart,
            'cycle_end' => $periodEnd,
        ]);

        DB::table('payment_history')->insert([
            'payment_id' => $invoice->payment_intent ?? null,
            'user_id' => $agentId,
            'payment_status' => 'success',
            'amount' => $amount,
            'payment_for' => $plan->title,
            'plan_type' => $plan->type,
            'start_date' => $periodStart,
            'end_date' => $periodEnd,
            'duration' => $plan->duration,
            'designs' => $plan->designs,
            'no_of_popins' => $plan->no_of_popins,
            'is_recurring' => true,
            'billing_cycle' => $billingCycle,
            'stripe_subscription_id' => $subscriptionId,
            'stripe_invoice_id' => $invoiceId,
            'cycle_number' => $cycleNumber,
        ]);

        $this->finalizePlanAssignment($agentId, $plan, $periodStart, $periodEnd, $amount, [
            'is_recurring' => true,
            'billing_cycle' => $billingCycle,
            'stripe_subscription_id' => $subscriptionId,
            'stripe_customer_id' => $session->customer,
            'next_billing_date' => $periodEnd,
            'subscription_status' => $subscription->status,
            'cancelled_at' => null,
            'last_invoice_id' => $invoiceId,
        ]);

        return redirect()->route('agent-adds-plans')->with('success', 'Recurring plan subscribed successfully!');
    }

    private function finalizePlanAssignment(int $agentId, Plan $plan, string $startDate, string $endDate, float $amount, array $extra = []): void
    {
        DB::table('user_plans')->updateOrInsert(
            ['user_id' => $agentId],
            array_merge([
                'plan_id' => $plan->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'duration' => $plan->duration,
                'designs' => $plan->designs,
                'no_of_popins' => $plan->no_of_popins,
                'price' => $amount,
                'updated_at' => now(),
            ], $extra)
        );

        $idsToPreserve = Popin::where('agent_id', $agentId)
            ->where('status', 'Active')
            ->orderBy('id','DESC')
            ->limit($plan->no_of_popins)
            ->pluck('id');

        Popin::where('agent_id', $agentId)
            ->where('status', 'Active')
            ->whereNotIn('id', $idsToPreserve)
            ->update(['status' => 'Inactive']);
    }

    private function resolveAgentName(int $agentId): string
    {
        return DB::table('agents_users_details')
            ->where('details_id', $agentId)
            ->value('name') ?? 'Agent';
    }

    private function getStripeIntervalConfig(int $duration): array
    {
        $intervalCount = max(1, $duration);
        return [
            'interval' => 'month',
            'interval_count' => $intervalCount,
        ];
    }

    private function getBillingCycleFromDuration(int $duration): string
    {
        return match ($duration) {
            3 => 'quarterly',
            default => 'monthly',
        };
    }
}
