<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomVerifyEmail;

class VerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        \Log::info('Verification request received for user: ' . $request->user()->id);
        $request->fulfill();
        $user = $request->user();
        $user->email_confirmed = 1;
        $user->save();
        \Log::info('User verified: ' . $request->user()->id);
        return redirect('/home');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification($request);
        return back()->with('success', 'Verification link sent!');
    }
}