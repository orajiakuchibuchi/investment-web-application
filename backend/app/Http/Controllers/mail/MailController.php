<?php

namespace App\Http\Controllers\mail;

use App\Http\Controllers\Controller;
use App\Mail\ContactUsMailable;
use App\Mail\ReportContactUs;
use App\Mail\Subscription;
use App\Mail\ReportSubscription;
use App\Mail\VerifyAccountMailable;
use App\Mail\InvestmentApprovalMailable;
use App\Mail\WithdrawalApprovalMailable;
use App\Mail\WithdrawalRequestMailable;
use App\Mail\ResetPasswordAccountMailable;
use App\Mail\IdentityViolationMail;
use App\Mail\PublishPlanMailable;
use App\Mail\InvestmentRequestMailable;
use App\Mail\InvestmentNotificationMailable;
use App\Mail\WithdrawalNotificationMailable;
use App\Mail\LoginMailable;
use App\Mail\SignupMailable;
use Illuminate\Http\Request;
use App\User;
use App\Mail\LoginDeviceNoticeMailable;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function paswordReset($email, $newpassword){
        $user = User::where('email', $email)->first();
        if($user){
            User::where('email', $email)->update([
                'password'=> $newpassword
            ]);
            Mail::to($email)
            ->send(new ResetPasswordAccountMailable($newpassword));
            return response()->json('Password reset mail sent');
        }
        return response()->json('Email not registered');
    }
    public function testMailer($email, $name, $subject, $from, $body){
        Mail::to($email)
        ->send(new SwingMailable($name, $subject, $from, $body));
        return response()->json('Password reset mail sent');

    }

    public function publishPlan($name, $min_amount, $max_amount, $interst, $maturity){
        $users = User::all()->pluck('email')->toArray();
        $first = $users[0];
        array_shift($users);
        Mail::to($first)->bcc($users)
        ->send(new PublishPlanMailable($name, $min_amount, $max_amount, $interst, $maturity));
        return response()->json('Plan published');
    }
    public function sendItentityViolationMail($email, $fee){
        Mail::to($email)->send(new IdentityViolationMail($fee));
        return response()->json('Email sent', 200);
    }
    public function sendDualContactMail($name, $email, $phone, $comments){
        Mail::to($email)
            ->send(new ContactUsMailable($name));
        Mail::to('Topfinancelimited@gmail.com')
            ->send(new ReportContactUs($name, $email, $phone, $comments));
        return response()->json('contact us mail sent');
    }
    public function sendDualSubscrptionMail($email){
        Mail::to('Topfinancelimited@gmail.com')
            ->send(new ReportSubscription($email));
        Mail::to($email)
            ->send(new Subscription());
        return response()->json('subscription mail sent');
    }
    public function sendDualSignupMail($email){
        Mail::to($email)
            ->send(new SignupMailable());
        return response()->json('subscription mail sent');
    }
    public function verifyAccount($email){
        Mail::to('Topfinancelimited@gmail.com')
        ->send(new ReportSubscription($email));
        Mail::to($email)
            ->send(new Subscription());
        return response()->json('subscription mail sent');
    }
    public function sendLoginNotice($email, $browser, $os, $userAgent){
        $user = User::where('email', $email)->first();
        Mail::to($email)
        ->send(new LoginDeviceNoticeMailable($browser, $os, $userAgent));
        return response()->json('Login notice sent');
    }
    public function sendDualWithdrawalRequest($email, $amount, $address, $coin){
        Mail::to($email)
        ->send(new WithdrawalRequestMailable($amount, $address, $coin));
        Mail::to('Topfinancelimited@gmail.com')
            ->send(new WithdrawalNotificationMailable($name, $amount, $coin));
        return response()->json('Withdrawal request mail sent');
    }
    public function sendDualInvestRequest($email, $name, $address, $amount, $coin){
        Mail::to('Topfinancelimited@gmail.com')
        ->send(new InvestmentNotificationMailable($name, $address, $amount, $coin));
        Mail::to($email)
            ->send(new InvestmentRequestMailable($name, $amount, $coin));
        return response()->json('Investment request mail sent');
    }
    public function sendDualInvestApproval($email, $name, $amount){
        Mail::to($email)
            ->send(new InvestmentApprovalMailable($name, $amount));
        return response()->json('subscription mail sent');
    }
    public function sendDualWithdrawalApproval($email, $amount, $address, $method){
        Mail::to($email)
        ->send(new WithdrawalApprovalMailable($amount, $address, $method));
        return response()->json('Withdrawal approved');
    }
}
