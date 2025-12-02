<?php

namespace App\Console\Commands;

use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Invoice as StripeInvoice;
use Stripe\Stripe;
use Stripe\Subscription as StripeSubscription;

class SyncRecurringPlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plans:sync-recurring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize recurring plan subscriptions with Stripe without webhooks.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $userPlans = DB::table('user_plans')
            ->where('is_recurring', true)
            ->whereNotNull('stripe_subscription_id')
            ->get();

        if ($userPlans->isEmpty()) {
            $this->info('No recurring plans to sync.');
            return Command::SUCCESS;
        }

        foreach ($userPlans as $userPlan) {
            try {
                $subscription = StripeSubscription::retrieve($userPlan->stripe_subscription_id);
            } catch (\Throwable $th) {
                Log::error('Unable to retrieve Stripe subscription.', [
                    'subscription_id' => $userPlan->stripe_subscription_id,
                    'error' => $th->getMessage(),
                ]);
                $this->error("Failed to retrieve subscription {$userPlan->stripe_subscription_id}");
                continue;
            }

            $status = $subscription->status;
            $currentPeriodStart = Carbon::createFromTimestamp($subscription->current_period_start)->toDateString();
            $currentPeriodEnd = Carbon::createFromTimestamp($subscription->current_period_end)->toDateString();
            $latestInvoiceId = $subscription->latest_invoice;

            $plan = Plan::find($userPlan->plan_id);
            $billingCycle = $userPlan->billing_cycle ?? $this->guessBillingCycle((int) $userPlan->duration);

            if ($latestInvoiceId && $latestInvoiceId !== $userPlan->last_invoice_id) {
                try {
                    $invoice = StripeInvoice::retrieve($latestInvoiceId);
                } catch (\Throwable $th) {
                    Log::error('Unable to retrieve Stripe invoice.', [
                        'invoice_id' => $latestInvoiceId,
                        'error' => $th->getMessage(),
                    ]);
                    $invoice = null;
                }

                if ($invoice && $invoice->status === 'paid') {
                    $amount = $invoice->amount_paid / 100;
                    $amount = round($amount, 2);
                    $userName = DB::table('agents_users_details')
                        ->where('details_id', $userPlan->user_id)
                        ->value('name') ?? 'System';
                    $cycleNumber = DB::table('payment_history')
                        ->where('stripe_subscription_id', $userPlan->stripe_subscription_id)
                        ->count() + 1;

                    DB::table('payments')->insert([
                        'payment_id' => $invoice->payment_intent ?? null,
                        'user_id' => $userPlan->user_id,
                        'payment_status' => 'success',
                        'amount' => $amount,
                        'payment_for' => $plan ? 'Plan - ' . $plan->title : 'Plan Renewal',
                        'plan_type' => $plan->type ?? 'Recurring',
                        'payment_by' => $userName,
                        'user_role' => null,
                        'is_recurring' => true,
                        'billing_cycle' => $billingCycle,
                        'stripe_subscription_id' => $userPlan->stripe_subscription_id,
                        'stripe_invoice_id' => $latestInvoiceId,
                        'cycle_start' => $currentPeriodStart,
                        'cycle_end' => $currentPeriodEnd,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    DB::table('payment_history')->insert([
                        'payment_id' => $invoice->payment_intent ?? null,
                        'user_id' => $userPlan->user_id,
                        'payment_status' => 'success',
                        'amount' => $amount,
                        'payment_for' => $plan->title ?? 'Plan Renewal',
                        'plan_type' => $plan->type ?? 'Recurring',
                        'start_date' => $currentPeriodStart,
                        'end_date' => $currentPeriodEnd,
                        'duration' => $userPlan->duration,
                        'designs' => $userPlan->designs,
                        'no_of_popins' => $userPlan->no_of_popins,
                        'is_recurring' => true,
                        'billing_cycle' => $billingCycle,
                        'stripe_subscription_id' => $userPlan->stripe_subscription_id,
                        'stripe_invoice_id' => $latestInvoiceId,
                        'cycle_number' => $cycleNumber,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    DB::table('user_plans')
                        ->where('id', $userPlan->id)
                        ->update([
                            'start_date' => $currentPeriodStart,
                            'end_date' => $currentPeriodEnd,
                            'next_billing_date' => $currentPeriodEnd,
                            'subscription_status' => $status,
                            'last_invoice_id' => $latestInvoiceId,
                            'updated_at' => now(),
                        ]);

                    $this->info("Synced recurring payment for subscription {$userPlan->stripe_subscription_id}");
                    continue;
                }
            }

            $updates = [
                'start_date' => $currentPeriodStart,
                'end_date' => $currentPeriodEnd,
                'next_billing_date' => $currentPeriodEnd,
                'subscription_status' => $status,
                'updated_at' => now(),
            ];

            if ($status === 'canceled' && !$userPlan->cancelled_at) {
                $updates['cancelled_at'] = now();
            }

            DB::table('user_plans')->where('id', $userPlan->id)->update($updates);
            $this->line("Updated cycle window for subscription {$userPlan->stripe_subscription_id}");
        }

        return Command::SUCCESS;
    }

    private function guessBillingCycle(int $duration): string
    {
        return match ($duration) {
            3 => 'quarterly',
            default => 'monthly',
        };
    }
}
