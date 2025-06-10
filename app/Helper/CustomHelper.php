<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Userdetails;

function AuthCheck()
{
    $guard = getActiveGuard();

    return (!$guard || !(Auth::guard($guard)->check())) ? false : true;
}

function AuthUser()
{
    if (!AuthCheck()) {
        return false;
    }

    $guard = getActiveGuard();
    
    $user = Auth::guard($guard)->user(); // Get the authenticated user

    $user->load('details'); 

    // $user_id = $user->id;

    // $user = new User;
    // $user = $user->getDetailsByEmailOrId(['id' => $user_id]);

    // $details = Userdetails::where('details_id', $user->id)->first();

    // // Merge attributes (be mindful of overriding attributes with the same name)
    // if ($details) {
    //     $user->setRawAttributes(array_merge($user->attributesToArray(), $details->attributesToArray()));
    // }

    return $user;
}

function AuthLogout(): bool
{
    if (!AuthCheck()) {
        return false;
    }

    $guard = getActiveGuard();
    
    Auth::guard($guard)->logout();

    return true;
}

function getActiveGuard() {
    
    $guards = array_keys(config('auth.guards')); 
    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            return $guard;
        }
    }
    return null; // No guard found with an authenticated user

    // // Use caching to store the active guard for efficiency
    // return Cache::remember('active_auth_guard', 60 * 60, function () {
    //     $guards = array_keys(config('auth.guards')); 
    //     foreach ($guards as $guard) {
    //         if (Auth::guard($guard)->check()) {
    //             return $guard;
    //         }
    //     }
    //     return null; // No guard found with an authenticated user
    // });
}

function send_mail(String $name, String $email, String $subject, String $mail_body, String $title): void {
    
    Mail::send('email.simple_mail', [
        'title' => $title, 'body' => $mail_body
    ], function ($message) use ($name, $email, $subject): void {
        $message->to($email, ucwords(string: $name))
            ->subject($subject)
            ->from(env('MAIL_FROM_ADDRESS'), '92 Agents Support');
    });
}

function calc_commission($price) {
    $agent_commission = env('AGENT_COMMISSION_PERCENT');
    $admin_commission = env('ADMIN_COMMISSION_PERCENT');

    $agent_commission_amt = ($price * $agent_commission) / 100;
    $admin_commission_amt = ($agent_commission_amt * $admin_commission) / 100;

    return (object) [
        'agent_commission' => number_format((float) $agent_commission_amt, 2, '.', ''),
        'admin_commission' => number_format((float) $admin_commission_amt, 2, '.', ''),
    ];
}

function est_std_datetime($date){
	return date('d M Y h:i A', strtotime($date));
}

function est_std_date($date){
	return date('d M Y', strtotime($date));
}

function est_std_time($time){
	return date('h:i A', strtotime($time));
}
