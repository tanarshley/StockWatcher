<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Http\Request;
use DB;
use App\Models\Employee;
use App\Models\Constituent;
use Mail;
use Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    //employee
    public function ForgetPassword() {
        return view('auth.forget-password');
    }

    public function ForgetPasswordStore(Request $request) {
        $request->validate([
            'employee_email' => 'required|email|exists:employees',
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->employee_email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('auth.forget-password-email', ['token' => $token], function($message) use($request){
            $message->to($request->employee_email);
            $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have emailed your password reset link. Please check your email.');
    }

    public function ResetPassword($token) {
        return view('auth.forget-password-link', ['token' => $token]);
    }
    
    public function ResetPasswordStore(Request $request) {
        $request->validate([
            'employee_email' => 'required|email|exists:employees',
            'employee_password' => 'required|string|min:8|same:password_confirmation',
            'password_confirmation' => 'required'
        ]);

        $update = DB::table('password_resets')->where(['email' => $request->employee_email, 'token' => $request->token])->first();

        if(!$update){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $employee = Employee::where('employee_email', $request->employee_email)->update(['employee_password' => Hash::make($request->employee_password)]);

        // Delete password_resets record
        DB::table('password_resets')->where(['email'=> $request->employee_email])->delete();

        return redirect()->route('employee.login')->with('message', 'Your password has been successfully changed!');
    }

    //constituent
    public function ForgetPasswordConstituent() {
        return view('auth.forget-password-constituent');
    }

    public function ForgetPasswordStoreConstituent(Request $request) {
        $request->validate([
            'constituent_email' => 'required|email|exists:constituents',
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->constituent_email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('auth.forget-password-email-constituent', ['token' => $token], function($message) use($request){
            $message->to($request->constituent_email);
            $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have emailed your password reset link. Please check your email.');
    }

    public function ResetPasswordConstituent($token) {
        return view('auth.forget-password-link-constituent', ['token' => $token]);
    }

    public function ResetPasswordStoreConstituent(Request $request) {
        $request->validate([
            'constituent_email' => 'required|email|exists:constituents',
            'constituent_password' => 'required|string|min:8|same:password_confirmation',
            'password_confirmation' => 'required'
        ]);

        $update = DB::table('password_resets')->where(['email' => $request->constituent_email, 'token' => $request->token])->first();

        if(!$update){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $constituent = Constituent::where('constituent_email', $request->constituent_email)->update(['constituent_password' => Hash::make($request->constituent_password)]);

        // Delete password_resets record
        DB::table('password_resets')->where(['email'=> $request->constituent_email])->delete();

        return redirect()->route('constituent.login')->with('message', 'Your password has been successfully changed!');
    }
}
