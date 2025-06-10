<?php

namespace App\Http\Controllers\Administrator;

use App\Events\eventTrigger;
use App\Helper\StripHelper;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use App\Models\Userdetails;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Stripe\Error\Card;

use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Exception\ApiErrorException;


class PaymentController extends Controller
{

    public function __construct() {}

    /* For payment agents */
    public function paymentagents(Request $request)
    {
        $rules = [
            'payment' => 'required',
            'stripeToken' => 'required',
            'post_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $payment = $request->input('payment');
        $user = Auth::user();
        $userdetails = Userdetails::find($user->id);
        $post = Post::find($request->input('post_id'));

        try {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            if ($user->customer_id == null || $user->customer_id == '') {
                $customer = \Stripe\Customer::create([
                    'email' => $user->email,
                    'source' => $request->input('stripeToken')
                ]);
                $customerid = $customer->id;
            } else {
                $customerid = $user->customer_id;
            }

            $charge = \Stripe\Charge::create([
                'customer' => $customerid,
                'amount' => $payment,
                'currency' => 'usd'
            ]);

            if (!empty($charge) && $charge->id != '') {

                $user = User::find($user->id);
                $user->customer_id = $customerid;

                if ($request->input('saved')) {
                    $user->card_number = $request->input('card_number');
                    $user->name_on_card = $request->input('name_on_card');
                    $user->cvc = $request->input('cvc');
                    $user->card_expiry_year = $request->input('card_expiry_year');
                    $user->card_expiry_month = $request->input('card_expiry_month');
                } else {
                    $user->card_number = '';
                    $user->name_on_card = '';
                    $user->cvc = '';
                    $user->card_expiry_year = '';
                    $user->card_expiry_month = '';
                }
                $user->save();

                $post->mark_complete = 1;
                $post->closing_date = Carbon::now()->toDateTimeString();
                $post->agent_payment = $payment;
                $post->save();

                $userfun = new User;
                $datapayment = [
                    'payment' => $payment,
                    'post_id' => $request->input('post_id'),
                    'user_id' => $user->id,
                    'stripe_id' => $charge->id,
                    'transaction_id' => $charge->balance_transaction,
                    'stripeToken' => $request->input('stripeToken'),
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ];
                $userfun->paymentdetailsadd($datapayment);

                $noti = new Notification;
                $notifiy = [
                    'sender_id' => $request->input('sender_id'),
                    'sender_role' => $request->input('sender_role'),
                    'receiver_id' => $request->input('sender_id'),
                    'receiver_role' => $request->input('sender_role'),
                    'notification_type' => $request->input('notification_type'),
                    'notification_message' => $request->input('notification_message'),
                    'notification_item_id' => $user->id,
                    'notification_child_item_id' => $request->input('post_id'),
                    'notification_post_id' => $request->input('post_id'),
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ];
                $noti->inserupdate($notifiy);
                $noti->inserupdate(['show' => '1'], [
                    'notification_type' => '14',
                    'notification_child_item_id' => $request->input('sender_id'),
                    'notification_post_id' => $request->input('post_id'),
                    'sender_id' => $request->input('receiver_id'),
                    'sender_role' => $request->input('receiver_role'),
                    'receiver_id' => $request->input('sender_id'),
                    'receiver_role' => $request->input('sender_role')
                ]);

                event(new eventTrigger([$notifiy, $notifiy, 'NewNotification']));

                $emaildata['url'] = url('/search/post/details/') . '/' . $request->input('post_id');
                $emaildata['email'] = $user->email;
                $emaildata['name'] = ucwords($userdetails->name);
                $emaildata['posttitle'] = ucwords($post->posttitle);
                $emaildata['html'] = '<div>
				<h3>Hello ' . $emaildata['name'] . ',</h3>
				<br>
				<p>
				' . $request->input('notification_message') . '`
				</p>
				<br>

				<p>Visit post <a href="' . $emaildata['url'] . '">' . $emaildata['posttitle'] . '</a> </p>
				<br>
				<br>
				<center><a href="' . URL('/') . '"> www.92Agents.com </a></center>
				<div>';

                Mail::send([], [], function ($message) use ($emaildata) {
                    $message->to($emaildata['email'], $emaildata['name'])
                        ->subject('Your payment is done for post " ' . $emaildata['posttitle'] . ' "')
                        ->setBody($emaildata['html'], 'text/html');
                    $message->from('92agent@92agents.com', '92agent@92agents.com');
                });

                return response()->json(["msg" => "Your Payment successfully for post (" . $post->posttitle . ")!"]);
            } else {
                return response()->json(["normalerror" => 'some error try again']);
            }
        } catch (\Exception $ex) {
            return response()->json(["normalerror" => $ex->getMessage()]);
        }
    }

    /* For get payment by any */
    public function getPaymentByAny($limit, $userid)
    {
        $user = new User;
        $view = [];
        $view['paymentdata'] = $user->getPaymentByAny($limit, $userid);
        return view('dashboard.user.agents.payment', $view);
    }

    # advertise
    public function paymentpage($package_id)
    {
        # get the price of package
        $package_details = DB::table('agents_package')->select('*')->where(['package_id' => $package_id])->first();

        $view['package_details'] = $package_details;
        $view['user'] = $user = Auth::user();
        $view['userdetails'] = $userdetails = Userdetails::find($user->id);
        $view['user_type'] = env('user_role_' . $user->agents_users_role_id);
        return view('dashboard.user.agents.payment', $view);
    }


    public function postPayment(Request $request)
    {
        $response = [];
        $validator = Validator::make($request->all(), [
            'stripeToken' => 'required',
            'package_id' => 'required|integer'
        ]);
        $input = $request->all();

        if ($validator->passes()) {
            # get the price of package
            $package_details = DB::table('agents_package')->select('*')->where(['package_id' => $request->input('package_id')])->first();
            $user = Auth::user();
            $userdetails = Userdetails::find($user->id);

            if ($package_details) {
                try {
                    $token = $_POST['stripeToken'];

                    $payment_id = DB::table('agents_payment')->insertGetId([
                        'amount' => ($package_details->price),
                        'discount' => '0',
                        'taxes' => '',
                        'payment' => 'Stripe',
                        'user_id' => $user->id,
                        'stripeToken' => $token
                    ]);


                    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                    $payment_response = \Stripe\Charge::create([
                        'amount' => ($package_details->price * 100),
                        'currency' => 'inr',
                        'source' => $token,
                        'description' => 'Ad package ' . $package_details->package_type . ', purchased by ' . $userdetails->name
                    ]);


                    if ($payment_response->status == 'succeeded') {
                        $payment_update_arr = [
                            'transaction_id' => $payment_response->balance_transaction,
                            'stripe_order_no' => $payment_response->id,
                            'updated_at' => date('Y-m-d h:i:s')
                        ];

                        #update payment details
                        DB::table('agents_payment')->where('payment_id', $payment_id)
                            ->update($payment_update_arr);

                        # add to advertise panel
                        DB::table('agents_advertise')->insert([
                            'package_id' => $package_details->package_id,
                            'agent_id' => $user->id,
                            'ad_place' => 1,
                            'payment_id' => $payment_id,
                            'receipt_url' => $payment_response->receipt_url
                        ]);

                        $response['status'] = 1;
                        $response['message'] = 'Ad-space purchased successfully';
                        $response['receipt_url'] = $payment_response->receipt_url;


                        /* Send mail to agent for ad purchase */
                        $emaildata['email'] = $user->email;
                        $emaildata['name'] = ucwords($userdetails->name);
                        $emaildata['posttitle'] = ucwords('Congratulations! Your Ad package ' . $package_details->package_type . ', purchased successfully');
                        $emaildata['html'] = '<div>
							<h3>Hello ' . $emaildata['name'] . ',</h3>
							<br>
							<p>
							Thank you for purchasing the ad package <b>' . $package_details->title . '</b>.
							</p>

							<a href="' . $response['receipt_url'] . '">Click Here</a> to view the receipt.

							<br>


							<br>
							<br>
							<center><a href="' . URL('/') . '"> www.92Agents.com </a></center>
							<div>';

                        Mail::send([], [], function ($message) use ($emaildata) {
                            $message->to($emaildata['email'], $emaildata['name'])
                                ->subject($emaildata['posttitle'])
                                ->setBody($emaildata['html'], 'text/html');

                            $message->from('92agent@92agents.com', '92agent@92agents.com');
                        });
                    } else {
                        $response['status'] = 0;
                        $response['message'] = 'Payment Failed! Something went wrong';
                    }
                } catch (Exception $e) {
                    $response['status'] = 0;
                    $response['message'] = $e->getMessage();
                }
            } else {
                $response['status'] = 0;
                $response['message'] = 'Invalid Ad package selection. Please try again';
            }
        } else {
            $response['status'] = 0;
            $response['message'] = 'Invalid inputs provided. Please try again';
        }

        $view['user'] = $user = Auth::user();
        $view['userdetails'] = $userdetails = Userdetails::find($user->id);
        $view['user_type'] = env('user_role_' . $user->agents_users_role_id);
        $view['status'] = $response['status'];
        $view['message'] = $response['message'];
        $view['receipt_url'] = $response['receipt_url'];

        return view('dashboard.user.agents.payment-status', $view);
    }

    public function paymentStatus()
    {
        $view['user'] = $user = Auth::user();
        $view['userdetails'] = $userdetails = Userdetails::find($user->id);
        $view['user_type'] = env('user_role_' . $user->agents_users_role_id);
        return view('dashboard.user.agents.payment-status', $view);
    }

    public function pendinginvoices()
    {
        $view['user'] = $user = Auth::user();
        $view['userdetails'] = $userdetails = Userdetails::find($user->id);
        $view['user_type'] = env('user_role_' . $user->agents_users_role_id);

        # load purchased packages
        $invoice_details = DB::table('agents_selldetails as as')
            ->join('agents_posts as ap', 'as.post_id', '=', 'ap.post_id')
            ->select('as.sellers_name', 'as.id', 'as.address', 'as.payment_status', 'as.receipt_url', 'as.sale_date', 'as.sale_price')
            ->where(['ap.applied_user_id' => $user->id, 'as.status' => 1])
            ->paginate(10);

        $view['invoice_details'] = $invoice_details;
        return view('dashboard.user.agents.pending-invoices', $view);
    }

    public function invoice_payment_page(Request $request)
    {
        if (!$user = AuthUser()) {
            return redirect('/login');
        }

        $sales_csv = $request->sales_csv ?? null;

        // print_r($sales_csv); exit;

        $sale_details = DB::table('agents_selldetails')
            ->where('agent_id', $user->id)
            ->where('payment_status', 0)
            ->when($sales_csv, function ($query, $sales_csv) {
                $sales_csv = explode(",", $sales_csv);
                return $query->whereIn('id', $sales_csv);
            })
            ->get();

        $admin_commission = 0;
        $post_ids = [];
        $sale_summary = [];

        $sale_details = $sale_details->map(function ($sale) use (&$admin_commission, &$post_ids, &$sale_summary) {
            $commission = calc_commission($sale->sale_price)->admin_commission;

            $sale->admin_commission = $commission;
            $admin_commission += $commission;

            array_push($post_ids, $sale->post_id);

            $sale_summary[$sale->post_id] = $commission;

            return $sale;
        });

        if ($admin_commission) {
            $stripe = new StripeClient(env('STRIPE_SECRET'));

            // Create a PaymentIntent with amount and currency
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $admin_commission * 100,
                'currency' => 'usd',
                // 'description' => 'Platform commission for posts: ' . implode(", " , $post_ids),
                'description' => 'Platform commission',
                'metadata' => [
                    'sale_ids' => $sales_csv,
                    'admin_commission' => $admin_commission,
                ],
            ]);
        }

        $view = [
            'sale_ids' => $sales_csv,
            'sale_details' => $sale_details,
            'admin_commission' => (float) $admin_commission,
            'user' => $user,
            'user_type' => env('user_role_' . $user->agents_users_role_id),
            'stripe_data' => $admin_commission ? [
                'key' => env('STRIPE_KEY'),
                'client_secret' => $paymentIntent->client_secret,
            ] : null,
            'sale_summary' => $admin_commission ? $sale_summary : null,
        ];

        return view('dashboard.user.agents.invoice_page', $view);
    }

    public function payment_success(Request $request)
    {
        try {
            $paymentIntentId = $request->query('payment_intent');
            
            $stripe = new StripeClient(env('STRIPE_SECRET'));
            $paymentIntent = $stripe->paymentIntents->retrieve($paymentIntentId, [
                'expand' => ['latest_charge'],
            ]);
            
            $payment_exists = DB::table('agents_payment')->where('transaction_id', $paymentIntent->latest_charge->balance_transaction)
            ->exists(); 
            
            $admin_commission = (float) $paymentIntent->metadata->admin_commission;

            if($payment_exists) {
                $response = [
                    'status' => 1,
                    'message' => 'Payment already completed',
                    'receipt_url' => $paymentIntent->latest_charge->receipt_url,
                ];
            }
            // Important Security Check: Verify the amount from the query params against the PaymentIntent
            elseif ($admin_commission * 100 != $paymentIntent->amount_received) {
                $response['status'] = 0;
                $response['message'] = "Amount mismatch! Received: " . ($paymentIntent->amount_received / 100) . ", From Query: $admin_commission";
            }
            // Check the payment status
            elseif ($paymentIntent->status === 'succeeded') {
                $user = AuthUser();
                
                // Get sale_ids and total_amount from the query parameters
                $saleIds = explode(',', $paymentIntent->metadata->sale_ids);
    
                // Insert into agents_payment table
                $payment_id = DB::table('agents_payment')->insertGetId([
                    'amount' => $admin_commission, // Use the amount from the query params
                    'discount' => '0',
                    'taxes' => '0',
                    'payment' => 'Stripe',
                    'user_id' => $user->id,
                    'transaction_id' => $paymentIntent->latest_charge->balance_transaction,
                    'stripe_order_no' => $paymentIntent->latest_charge->id,
                    'stripeToken' => $paymentIntent->id, // Store PaymentIntent ID
                    'updated_at' => now(),
                    'created_at' => now()
                ]);
    
                // Update agents_selldetails table
                DB::table('agents_selldetails')->whereIn('id', $saleIds)
                    ->update([
                        'payment_id' => $payment_id,
                        'receipt_url' => $paymentIntent->latest_charge->receipt_url,
                        'payment_status' => 1,
                        'updated_ts' => now()
                    ]);

                $response = [
                    'status' => 1,
                    'message' => 'Payment has been completed successfully',
                    'receipt_url' => $paymentIntent->latest_charge->receipt_url,
                ];
            } else {
                $response = [
                    'status' => 0,
                    'message' => 'Payment Failed! Something went wrong',
                ];
            }
        } catch (ApiErrorException $e) {
            // Handle Stripe API errors`
            $response = [
                'status' => 0,
                'message' => $e->getMessage(),
            ];
        }

        return view('dashboard.user.agents.payment-status', $response);
    }

    // public function pay_pendinginvoices(Request $request) // Same Function, Same View
    // {
    //     $invoices = $request->input('pending_invoices');
    //     $invoices = explode(",", $invoices);
    //     $pending_invoices = $invoices;

    //     $selldetails = DB::table('agents_selldetails')->whereIn('id', $pending_invoices)->get();

    //     $view['sell_ids'] = $pending_invoices;
    //     $view['sell_details'] = $selldetails;
    //     $view['user'] = $user = Auth::user();
    //     $view['userdetails'] = $userdetails = Userdetails::find($user->id);
    //     $view['user_type'] = env('user_role_' . $user->agents_users_role_id);
    //     return view('dashboard.user.agents.agent-payment', $view);
    // }

    // public function payitnow($id) // Same Function, Same View
    // {
    //     $invoices = [$id];
    //     $pending_invoices = $invoices;
    //     $selldetails = DB::table('agents_selldetails')->whereIn('id', $pending_invoices)->get();

    //     $view['sell_ids'] = $pending_invoices;
    //     $view['sell_details'] = $selldetails;
    //     $view['user'] = $user = Auth::user();
    //     $view['userdetails'] = $userdetails = Userdetails::find($user->id);
    //     $view['user_type'] = env('user_role_' . $user->agents_users_role_id);
    //     return view('dashboard.user.agents.agent-payment', $view);
    // }

    // public function postAgentPayment(Request $request)
    // {
    //     $response = [];
    //     $validator = Validator::make($request->all(), [
    //         'stripeToken' => 'required',
    //         'sell_ids' => 'required'
    //     ]);

    //     $input = $request->all();

    //     if ($validator->passes()) {

    //         $sell_ids = explode(',', $request->input('sell_ids'));
    //         # get the price of package
    //         $sell_details = DB::table('agents_selldetails')->select('*')->whereIn('id', $sell_ids)->get();
    //         $user = Auth::user();
    //         $userdetails = Userdetails::find($user->id);


    //         if ($sell_details) {

    //             try {
    //                 $token = $request['stripeToken'];
    //                 $total_sell = 0;
    //                 foreach ($sell_details as $sell) {
    //                     $per_10 = $sell->sale_price * 10 / 100;
    //                     $per_10_03 = round($per_10 * 3 / 100, 2);
    //                     $total_sell += $per_10_03;
    //                 }

    //                 $payment_id = DB::table('agents_payment')->insertGetId([
    //                     'amount' => ($total_sell),
    //                     'discount' => '0',
    //                     'taxes' => '0',
    //                     'payment' => 'Stripe',
    //                     'user_id' => $user->id,
    //                     'stripeToken' => $token
    //                 ]);


    //                 \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


    //                 $payment_response = \Stripe\Charge::create([
    //                     'amount' => ($total_sell * 100),
    //                     'currency' => 'inr',
    //                     'source' => $token,
    //                     'description' => 'Agent paid for sell'
    //                 ]);


    //                 if ($payment_response->status == 'succeeded') {
    //                     $payment_update_arr = [
    //                         'transaction_id' => $payment_response->balance_transaction,
    //                         'stripe_order_no' => $payment_response->id,
    //                         'updated_at' => date('Y-m-d h:i:s')
    //                     ];

    //                     #update payment details
    //                     DB::table('agents_payment')->where('payment_id', $payment_id)
    //                         ->update($payment_update_arr);

    //                     DB::table('agents_selldetails')->whereIn('id', $sell_ids)
    //                         ->update([
    //                             'payment_id' => $payment_id,
    //                             'receipt_url' => $payment_response->receipt_url,
    //                             'payment_status' => 1,
    //                             'updated_ts' => date('Y-m-d h:i:s')
    //                         ]);


    //                     $response = [
    //                         'status' => 1,
    //                         'message' => 'Payment has been completed successfully',
    //                         'receipt_url' => $payment_response->receipt_url,
    //                     ];
    //                 } else {
    //                     $response = [
    //                         'status' => 0,
    //                         'message' => 'Payment Failed! Something went wrong',
    //                     ];
    //                 }
    //             } catch (Exception $e) {
    //                 $response = [
    //                     'status' => 0,
    //                     'message' => $e->getMessage(),
    //                 ];
    //             }
    //         } else {
    //             $response = [
    //                 'status' => 0,
    //                 'message' => 'Invalid input provided. Please try again',
    //             ];
    //         }
    //     } else {
    //         $response = [
    //             'status' => 0,
    //             'message' => 'Invalid inputs provided. Please try again',
    //         ];
    //     }

    //     $view['user'] = $user = Auth::user();
    //     $view['userdetails'] = $userdetails = Userdetails::find($user->id);
    //     $view['user_type'] = env('user_role_' . $user->agents_users_role_id);

    //     $view['status'] = $response['status'];
    //     $view['message'] = $response['message'];


    //     return view('dashboard.user.agents.payment-status', $view);
    // }

    // public function postAgentPayment_jk(Request $request)
    // {
    //     $response = [];
    //     $validator = Validator::make($request->all(), [
    //         'stripeToken' => 'required',
    //         'sell_ids' => 'required'
    //     ]);

    //     $input = $request->all();

    //     if ($validator->passes()) {

    //         $sell_ids = explode(',', $request->input('sell_ids'));
    //         # get the price of package
    //         $sell_details = DB::table('agents_selldetails')->select('*')->whereIn('id', $sell_ids)->get();
    //         $user = Auth::user();
    //         $userdetails = Userdetails::find($user->id);


    //         if ($sell_details) {

    //             try {
    //                 $token = $request['stripeToken'];
    //                 $total_sell = 0;
    //                 foreach ($sell_details as $sell) {
    //                     $per_10 = $sell->sale_price * 10 / 100;
    //                     $per_10_03 = round($per_10 * 3 / 100, 2);
    //                     $total_sell += $per_10_03;
    //                 }

    //                 $payment_id = DB::table('agents_payment')->insertGetId([
    //                     'amount' => ($total_sell),
    //                     'discount' => '0',
    //                     'taxes' => '0',
    //                     'payment' => 'Stripe',
    //                     'user_id' => $user->id,
    //                     'stripeToken' => $token
    //                 ]);


    //                 \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


    //                 $payment_response = \Stripe\Charge::create([
    //                     'amount' => ($total_sell * 100),
    //                     'currency' => 'inr',
    //                     'source' => $token,
    //                     'description' => 'Agent paid for sell'
    //                 ]);



    //                 if ($payment_response->status == 'succeeded') {
    //                     $payment_update_arr = [
    //                         'transaction_id' => $payment_response->balance_transaction,
    //                         'stripe_order_no' => $payment_response->id,
    //                         'updated_at' => date('Y-m-d h:i:s')
    //                     ];

    //                     #update payment details
    //                     DB::table('agents_payment')->where('payment_id', $payment_id)
    //                         ->update($payment_update_arr);
    //                     $sell_details_arr = [
    //                         'payment_id' => $payment_id,
    //                         'receipt_url' => $payment_response->receipt_url,
    //                         'payment_status' => 1,
    //                         'updated_ts' => date('Y-m-d h:i:s')
    //                     ];

    //                     DB::table('agents_selldetails')->whereIn('id', $sell_ids)
    //                         ->update($sell_details_arr);


    //                     $response['status'] = 1;
    //                     $response['message'] = 'Payment has been completed successfully';
    //                     $response['receipt_url'] = $payment_response->receipt_url;
    //                 } else {
    //                     $response['status'] = 0;
    //                     $response['message'] = 'Payment Failed! Something went wrong';
    //                 }
    //             } catch (Exception $e) {

    //                 $response['status'] = 0;
    //                 $response['message'] = $e->getMessage();
    //             }
    //         } else {
    //             $response['status'] = 0;
    //             $response['message'] = 'Invalid input provided. Please try again';
    //         }
    //     } else {
    //         $response['status'] = 0;
    //         $response['message'] = 'Invalid inputs provided. Please try again';
    //     }

    //     $view['user'] = $user = Auth::user();
    //     $view['userdetails'] = $userdetails = Userdetails::find($user->id);
    //     $view['user_type'] = env('user_role_' . $user->agents_users_role_id);

    //     $view['status'] = $response['status'];
    //     $view['message'] = $response['message'];


    //     return view('dashboard.user.agents.payment-status', $view);
    // }

    public function downloadinvoice(Request $request)
    {
        $sell_ids = explode(',', $request->input('sell_ids'));

        $selldetails = DB::table('agents_selldetails')->whereIn('id', $sell_ids)->get();
        $view['sell_ids'] = $sell_ids;
        $view['sell_details'] = $selldetails;

        $view['user'] = $user = Auth::user();
        $view['userdetails'] = $userdetails = Userdetails::find($user->id);
        $view['user_type'] = env('user_role_' . $user->agents_users_role_id);
        return view('admin.pages.agent.invoice', $view);
    }



    //api data


    public function pay_pendinginvoices_api(Request $request)
    {
        $invoices = $request->input('pending_invoices');
        $invoices = explode(",", $invoices);
        $pending_invoices = $invoices;

        $selldetails = DB::table('agents_selldetails')->whereIn('id', $pending_invoices)->get();
        $view['sell_ids'] = $pending_invoices;
        $view['sell_details'] = $selldetails;
        $view['user'] = $user = User::find($request->input('agents_user_id'));
        $view['userdetails'] = $userdetails = Userdetails::find($user->id);
        $view['user_type'] = env('user_role_' . $user->agents_users_role_id);

        return response()->json(['status' => '100', 'result' => $view]);
    }

    public function payitnow_api(Request $request)
    {
        $invoices = [$request->input('postId')];
        $pending_invoices = $invoices;
        $selldetails = DB::table('agents_selldetails')->whereIn('id', $pending_invoices)->get();

        $view['sell_ids'] = $pending_invoices;
        $view['sell_details'] = $selldetails;
        $view['user'] = $user = User::find($request->input('agents_user_id'));
        $view['userdetails'] = $userdetails = Userdetails::find($user->id);
        $view['user_type'] = env('user_role_' . $user->agents_users_role_id);

        return response()->json(['status' => '100', 'result' => $view]);
    }

    public function postAgentPayment_api(Request $request)
    {

        $response = [];
        $validator = Validator::make($request->all(), [
            'stripeToken' => 'required',
            'sell_ids' => 'required'
        ]);


        $input = $request->all();
        if ($validator->passes()) {
            $sell_ids = explode(',', $request->input('sell_ids'));

            $sell_details = DB::table('agents_selldetails')->select('*')->whereIn('id', $sell_ids)->get();
            $user = User::find($request->input('agents_user_id'));
            $userdetails = Userdetails::find($user->id);

            if ($sell_details) {

                try {
                    $token = $_POST['stripeToken'];
                    $total_sell = 0;
                    foreach ($sell_details as $sell) {
                        $per_10 = $sell->sale_price * 10 / 100;
                        $per_10_03 = round($per_10 * 3 / 100, 2);
                        $total_sell += $per_10_03;
                    }

                    $payment_id = DB::table('agents_payment')->insertGetId([
                        'amount' => ($total_sell),
                        'discount' => '0',
                        'taxes' => '0',
                        'payment' => 'Stripe',
                        'user_id' => $user->id,
                        'stripeToken' => $token
                    ]);


                    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


                    $payment_response = \Stripe\Charge::create([
                        'amount' => ($total_sell * 100),
                        'currency' => 'inr',
                        'source' => $token,
                        'description' => 'Agent paid for sell'
                    ]);

                    if ($payment_response->status == 'succeeded') {
                        $payment_update_arr = [
                            'transaction_id' => $payment_response->balance_transaction,
                            'stripe_order_no' => $payment_response->id,
                            'updated_at' => date('Y-m-d h:i:s')
                        ];

                        #update payment details
                        DB::table('agents_payment')->where('payment_id', $payment_id)
                            ->update($payment_update_arr);
                        $sell_details_arr = [
                            'payment_id' => $payment_id,
                            'receipt_url' => $payment_response->receipt_url,
                            'payment_status' => 1,
                            'updated_ts' => date('Y-m-d h:i:s')
                        ];

                        DB::table('agents_selldetails')->whereIn('id', $sell_ids)
                            ->update($sell_details_arr);


                        $response['status'] = 1;
                        $response['message'] = 'Payment has been completed successfully';
                        $response['receipt_url'] = $payment_response->receipt_url;
                    } else {
                        $response['status'] = 0;
                        $response['message'] = 'Payment Failed! Something went wrong';
                    }
                } catch (Exception $e) {
                    $response['status'] = 0;
                    $response['message'] = $e->getMessage();
                }
            } else {
                $response['status'] = 0;
                $response['message'] = 'Invalid input provided. Please try again';
            }
        } else {
            $response['status'] = 0;
            $response['message'] = 'Invalid inputs provided. Please try again';
        }

        $view['user'] = $user = User::find($request->input('agents_user_id'));
        $view['userdetails'] = $userdetails = Userdetails::find($user->id);
        $view['user_type'] = env('user_role_' . $user->agents_users_role_id);

        $view['status'] = $response['status'];
        $view['message'] = $response['message'];


        return response()->json(['status' => '100', 'result' => $view]);
    }

    public function downloadinvoice_api(Request $request)
    {
        $sell_ids = explode(',', $request->input('sell_ids'));

        $selldetails = DB::table('agents_selldetails')->whereIn('id', $sell_ids)->get();
        $view['sell_ids'] = $sell_ids;
        $view['sell_details'] = $selldetails;

        $view['user'] = $user = User::find($request->input('agents_user_id'));
        $view['userdetails'] = $userdetails = Userdetails::find($user->id);
        $view['user_type'] = env('user_role_' . $user->agents_users_role_id);
        return response()->json(['status' => '100', 'result' => $view]);
    }
}
