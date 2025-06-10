<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    use SendsPasswordResetEmails;
    public function __construct()
    {
        $this->middleware('guest');
    }
    /*forgot password */
    public function resetcodesend(Request $request)
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email']);

        if ($validator->fails()) {
            return response()->json(['status' => '101', 'error' => $validator->errors()], 422);
        }

        $email = $request->email;

        $user = User::info(['email' => $email]);

        if (!$user) {
            return response()->json(['status' => '101', 'error' => "You'll receive a link to your mail, if it's on our records!"]);
        }

        // return $user;

        $name = $user->name;
        $email = $user->email;

        $reset_link = str_replace('/', '', Hash::make(Str::random(32)));

        $update = $user->update([
            'forgot_token' => $reset_link
        ]);

        if (!$update) {
            return response()->json(['status' => '100', 'error' => 'Something went wrong! Please try again.'], 500);
        }

        $reset_link = url("/password/code/{$reset_link}");
        $mail_body = "<div><h3>Hello $name,</h3><br><p>Forgot Your Password 92Agents.</p><br> <p>Click <a href='$reset_link'>$reset_link</a></p><div>";

        // send_mail(name: $name, email: $email, subject: "92Agents Password Reset OTP", title: "Reset Password", mail_body: $mail_body);

        Mail::send('email.simple_mail', [
            'title' => 'Password Reset', 'body' => $mail_body
        ], function ($message) use ($name, $email) {
            $message->to($email, ucwords(string: $name))
                ->subject('92Agents Password Reset OTP.')
                ->from(env('MAIL_FROM_ADDRESS'), '92 Agents Support');
        });

        return response()->json(['status' => '100', 'error' => "You'll receive a link to your mail, if it's on our records!"]);
    }
}