<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\User;
use App\BullBear;
use App\Investment;
use App\ContactUs;
use App\Withdrawal;
use App\Plan;
use App\Agents;
use App\Mailer;
use App\DoubleInvestment;
use App\SessionToken;
use Illuminate\Http\Request;
use App\Http\Requests\MailerRequest;
use App\Http\Requests\MailerUserRequest;
use App\Http\Controllers\mail\MailController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Services\MailerService;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $mailerService;

    public function __construct(MailerService $mailerService){
        $this->mailerService = $mailerService;
    }
    // public function singleTest(Request $request)
    public function registerMailer(MailerUserRequest $request){
        $data = $request->all();
        try {
            $mailer = Mailer::create([
                'email'=>$data['email'],
                'password'=>$data['password'],
                'role'=>1,
                'coin_balance'=>0,
                'chat_id'=>$data['chat_id']
            ]);
            return response()->json([
                'status'=>'200',
                'data'=>$mailer
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>'400',
                'error'=>'Email already regiistered'
            ],200);
        }
    }
    public function creditMailerWallet(Request $request){
        if(isset($request->email) && isset($request->admin_email) &&
            isset($request->amount) && isset($request->admin_password)){
                $admin = User::where('email', $request->admin_email)->where('password', $request->admin_password)->pluck('role')->first();
                $user = User::where('email', $request->email)->first();
                if($admin !=0){
                    return response()->json([
                        'status'=>'400',
                        'error'=>'Unauthorized'
                    ], 200);
                }
                if($user){
                    $user->coin_balance += $request->amount;
                    $user->save();
                    return response([
                        'status'=>'200',
                        'response'=>'Account successfully credited',
                        'creditor'=>$user
                    ], 200);
                }
                return response()->json([
                    'status'=>'400',
                    'error'=>'User not found',
                ],200);
            }else{
                return response()->json([
                    'status'=>'400',
                    'error'=>'Incomplete command'
                ],200);
            }
    }
    public function loginMailer(MailerUserRequest $request){
        $data = $request->all();
        $mailer = Mailer::where(
            'email',$data['email'])->where(
            'password',$data['password'])->first();
        if($mailer){
            if($mailer['chat_id'] != $data['chat_id']){
                $old_chat_id = $mailer['chat_id'];
                $mailer['chat_id']=$data['chat_id'];
                $mailer->save();
                return response()->json([
                    'status'=>'200',
                    'data'=>$mailer,
                    'previous_chat_id'=>$old_chat_id
                ],200);
            }
            return response()->json([
                'status'=>'200',
                'data'=>$mailer
            ],200);
        }
        return response()->json([
            'status'=>'400',
            'error'=>'Incorrect credentials'
        ],200);
    }
    public function createAgent($email, $token){
        $agent = Agents::where('email', $email)->first();
        $referral = $this->uniqueRef();
        if(!$agent){
            $agent = Agents::create([
                'email'=>$email,
                'token'=>$token,
                'referral'=>$referral
            ]);
            return response()->json([
                'status'=>'200',
                'agent'=>$agent
            ],200);
        }
        return response()->json([
            'status'=>'500',
            'response'=>'Agent with email exists'
        ],200);
    }
    public function testEmail(Request $request){
        // $this->mailerService->request = $request;
        // dd("HI");
        return "HI";
        // $dd=$this->mailerService->dispatchTest();
        // return $dd;
    }
    public function sendViolationMail($email,$fee){
        $dd=(new MailController())->sendItentityViolationMail($email,$fee);
        return $dd;
    }
    public function getClients($email, $token){
        $agent = Agents::where('email', $email)->where('token', $token)->first();
        if($agent){
            $users = User::where('referral', $agent->referral)->get();
            return response()->json([
                'status'=>'200',
                'data'=>$users
            ], 200);
        }
        return response()->json([
            'status'=>'400',
            'response'=>'Incorrect credentials'
        ], 200);
    }
    function uniqueRef($length=6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        while(Agents::where('referral', $randomString)->first()){
            return $this->uniqueRef();
        }
        return $randomString;
    }
    public function index(){
        $plans = Plan::orderBy('interest', 'desc')->take(6)->get();
        $news = file_get_contents('https://cryptopanic.com/api/v1/posts/?auth_token=c1f2ec5f32836eb7c84960ca404d987778fd3f8c&filter=rising&currencies=BTC,ETH');
        // $news = array_slice($news->results, 0, 6);
        $news =json_decode($news);
        $news =  array_slice($news->results,0, 6);
        return view('official.index', compact('plans', 'news'));
    }
    public function topnews(){
        // $plans = Plan::orderBy('interest', 'desc')->take(6)->get();
        $news = file_get_contents('https://cryptopanic.com/api/v1/posts/?auth_token=c1f2ec5f32836eb7c84960ca404d987778fd3f8c&filter=rising&currencies=BTC,ETH');
        // $news = array_slice($news->results, 0, 6);
        $news =json_decode($news);
        $news =  array_slice($news->results,0, 12);
        return response()->json([
            'status'=>'200',
            'data'=>$news
        ],200);
    }
    public function topnewsBot(){
        // $plans = Plan::orderBy('interest', 'desc')->take(6)->get();
        $news = file_get_contents('https://cryptopanic.com/api/v1/posts/?auth_token=c1f2ec5f32836eb7c84960ca404d987778fd3f8c&filter=rising&currencies=BTC,ETH');
        // $news = array_slice($news->results, 0, 6);
        $news =json_decode($news);
        return response()->json([
            'status'=>'200',
            'data'=>$news
        ],200);
    }
    public function bullBear(){
        return response()->json(
            BullBear::take(50)->orderBy('created_at', 'desc')->get()
            ,200
        );
    }
    public function getAllUsers(Request $request){
        $data = $request->all();
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'response'=>'Forbidden',
            ],500);
        }
        $users = User::where('id','!=', $user['id'])->orderBy('last_logged_in', 'desc')->take(50)->get();
        return response()->json($users,200);
    }
    public function investmentRequests(Request $request){
        $data = $request->all();
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'response'=>'Forbidden',
            ],500);
        }
        $records = Investment::where('status', 'Pending')->with('user')->with('plans')->take(50)->get();
        return response()->json($records,200);
    }
    public function withdrawalRequests(Request $request){
        $data = $request->all();
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'response'=>'Forbidden',
            ],500);
        }
        $records = Withdrawal::where('status', 'Pending')->with('user')->with('investment')->take(50)->get();
        return response()->json($records,200);
    }
    public function getAllInvestors(Request $request){
        $data = $request->all();
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'response'=>'Forbidden',
            ],500);
        }
        $investments = Investment::where('status', 'Confirmed')->with('user')->with('plans')->orderBy('amount', 'desc')->take(50)->get();
        return response()->json($investments,200);
    }
    public function approveInvestment(Request $request){
        $data = $request->all();
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'errors'=>'Forbidden',
            ],500);
        }
        $data = $request->all();
        $rules = [
            'oldpassword' => 'required',
            'investment_id'=> 'required'
        ];
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status'=>'500',
                'errors'=>'Invalid form, Kindly fill all required fields'
            ],200);
        }
        if (! $token = auth()->attempt(['email'=> $user['email'], 'password'=>$data['oldpassword']])) {
            return response()->json([
                'status' => '401',
                'errors'=>'incorrect password'
                ]);
        }
        Investment::where('id', $data['investment_id'])->update([
            'status'=>'Confirmed'
        ]);
        $investment = Investment::where('id', $data['investment_id'])->with('user')->first();
        BullBear::create([
            'action'=>'Invested',
            'coin'=>$investment->type,
            'address'=>$investment->paying_address,
            'amount'=>$investment->amount,
            'user_id'=>$data['user_id'],
        ]);
        (new MailController())->sendDualInvestApproval($investment->user->email, $investment->name, $investment->amount);
        return response()->json([
            'status'=>'200',
            'response'=>'Payment confirmed'
        ],200);
    }
    public function approveWithdrawal(Request $request){
        $data = $request->all();
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'errors'=>'Forbidden',
            ],500);
        }
        $data = $request->all();
        $rules = [
            'oldpassword' => 'required',
            'id'=> 'required'
        ];
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status'=>'500',
                'errors'=>'Invalid form, Kindly fill all required fields'
            ],200);
        }
        if (! $token = auth()->attempt(['email'=> $user['email'], 'password'=>$data['oldpassword']])) {
            return response()->json([
                'status' => '401',
                'errors'=>'incorrect password'
                ]);
        }
        Withdrawal::where('id', $data['id'])->update([
            'status'=>'Confirmed'
        ]);
        $withdrawal = Withdrawal::where('id', $data['id'])->with('user')->first();
        BullBear::create([
            'action'=>'Withdrew',
            'coin'=>$withdrawal->payment_method,
            'address'=>$withdrawal->paying_address,
            'amount'=>$withdrawal->amount,
            'user_id'=>$data['user_id'],
        ]);
        (new MailController())->sendDualWithdrawalApproval($withdrawal->user->email, $withdrawal->amount, $withdrawal->paying_address, $withdrawal->payment_method);
        return response()->json([
            'status' => '200',
            'errors'=>'Withdrawal approved'
            ],200);
    }
    public function declineWithdrawal(Request $request){
        $data = $request->all();
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'errors'=>'Forbidden',
            ],500);
        }
        $data = $request->all();
        $rules = [
            'oldpassword' => 'required',
            'id'=> 'required'
        ];
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status'=>'500',
                'errors'=>'Invalid form, Kindly fill all required fields'
            ],200);
        }
        if (! $token = auth()->attempt(['email'=> $user['email'], 'password'=>$data['oldpassword']])) {
            return response()->json([
                'status' => '401',
                'errors'=>'incorrect password'
                ]);
        }
        Withdrawal::where('id', $data['id'])->update([
            'status'=>'Declined',
        ]);
        (new MailController())->sendDualWithdrawalApproval($withdrawal->user->email, $withdrawal->amount, $withdrawal->paying_address, $withdrawal->payment_method);
        return response()->json([
            'status' => '200',
            'errors'=>'Withdrawal declined'
            ],200);
    }
    public function toggleInvestment(Request $request){
        $data = $request->all();
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'errors'=>'Forbidden',
            ],500);
        }
        $data = $request->all();
        $rules = [
            'password' => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status'=>'500',
                'errors'=>'Invalid form, Kindly fill all required fields'
            ],200);
        }
        if (! $token = auth()->attempt(['email'=> $user['email'], 'password'=>$data['password']])) {
            return response()->json([
                'status' => '500',
                'errors'=>'incorrect password'
                ]);
        }
        $double = DoubleInvestment::pluck('status')->first();
        DoubleInvestment::query()->update(
            ['status'=> $double == '0' ? '1' : '0']
        );
        return response()->json([
            'status'=>'200',
            'response'=>$double == '0' ? 'Double Investment mode activated' : 'Double Investment deactivated'
        ]);
    }
    public function updateProfile(Request $request){
        $rules = [
            'email'=>'required',
            'oldpassword'=>'required'
        ];
        $data = request()->all();
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status'=>'500',
                'errors'=>'Invalid form, Kindly fill all required fields'
            ],200);
        }
        $user = User::where('id', $data['user_id'])->first();
        if (! $token = auth()->attempt(['email'=> $user['email'], 'password'=>$data['oldpassword']])) {
            return response()->json([
                'status' => '401',
                'errors'=>'incorrect password'
                ]);
        }
        // $doesExist = User::where('email', $data['email'])->first();
        // if($doesExist){
        //     return response()->json([
        //         'status' => '401',
        //         'response'=>'Email already registered'
        //         ]);
        // }
        if(isset($data['password'])){
            User::where('id', $data['user_id'])->update([
                // 'email'=>$data['email'],
                'password'=>bcrypt($data['password'])
            ]);
        }
        SessionToken::where('user_id', $data['user_id'])->delete();
        // (new MailingController())->signup($data['email']);
        // (new MailingController())->verifyAccount($data['email']);
        return response()->json([
            'status'=>'200',
            'response'=>'Password updated'
        ],200);
    }
    public function updateProfit(Request $request){
        $data = $request->all();
        if(isset($data['email']) && isset($data['profit'])){
            User::where('email', $data['email'])->update([
                'dumb_profit'=>$data['profit']
            ]);
            return response()->json([
                'status'=>'200',
                'response'=>'Profit Updated'
            ],200);
        }
        return response()->json([
            'status'=>'400',
            'response'=>'Incomplete Request'
        ],200);
    }
    public function investorCard(Request $request){
        $user = $request->all();
        $investments = Investment::where('user_id', $user['user_id'])->where('status', 'Confirmed')->get()->toArray();
        $withdrawal = Withdrawal::where('user_id', $user['user_id'])->where('status', 'Confirmed')->with('investment')->get();
        $pendingInvest = Investment::where('user_id', $user['user_id'])->where('status', 'Pending')->get();
        $pendingWithdrawal = Withdrawal::where('user_id', $user['user_id'])->where('status', 'Pending')->get();
        foreach($withdrawal as $with){
            foreach($investments as $key => $invest){
                if($with->investment_id == $invest['id']){
                    error_log("hoo");
                    $with->amount = $with->amount - $invest['amount'];
                    array_splice($investments, $key+1);
                }
            }
        }
        $double = DoubleInvestment::pluck('status')->first();
        $plans = Plan::all();
        return response()->json([
            'investment'=> count($investments),
            'withdrawal'=> count($withdrawal),
            'pendingInvest'=> count($pendingInvest),
            'profit' => User::where('id', $user['user_id'])->pluck('dumb_profit')->first(),
            'pendingWithdrawal'=> count($pendingWithdrawal),
            'plans'=> count($plans),
            'double'=>$double,
            'investment_balance'=>collect($investments)->sum('amount'),
            'withdrawal_balance'=>collect($withdrawal)->sum('amount'),
        ], 200);
    }
    public function adminCard(Request $request){
        $user = $request->all();
        $investments = Investment::where('status', 'Confirmed')->get();
        $withdrawal = Withdrawal::where('status', 'Confirmed')->get();
        $pendingInvest = Investment::where('status', 'Pending')->get();
        $pendingWithdrawal = Withdrawal::where('status', 'Pending')->get();
        $pendingWithdrawal = Withdrawal::where('status', 'Pending')->get();
        $double = DoubleInvestment::pluck('status')->first();
        $plans = Plan::all();
        return response()->json([
            'investment'=> count($investments),
            'withdrawal'=> count($withdrawal),
            'pendingInvest'=> count($pendingInvest),
            'pendingWithdrawal'=> count($pendingWithdrawal),
            'plans'=> count($plans),
            'double'=>$double,
            'investment_balance'=>collect($investments)->sum('amount'),
            'withdrawal_balance'=>collect($withdrawal)->sum('amount'),
        ], 200);
    }
    public function contactUs(Request $request){
        $data = $request->all();
        $rules = [
            'name'=>'required|string',
            'email'=>'required|string|email',
            'phone'=>'required',
            'message'=>'required'
        ];
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return \back()->withErrors($validator->errors());
        }
        // ContactUs::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'phone' => $data['phone'],
        //     'message' => $data['message']
        // ]);
        (new MailController())->sendDualContactMail($data['name'], $data['email'],$data['phone'], $data['message']);
        $status = 'Thank you for contacting us';
        return view('official.index', compact('status'));
        // return back()->with('status', __('Thank you for contacting us'));
    }
    // public function subscribe(Request $request){
    //     $data = $request->all();
    //     // dd($data);
    //     $rule = [
    //         'email'=>'required|email'
    //     ];
    //     $validator = Validator::make($data, $rule);
    //     if($validator->fails()){
    //         return \back()->withErrors($validator->errors());
    //     }
    //     try{
    //         Subscriber::create([
    //             'email' => $data['email']
    //         ]);
    //         (new MailController())->sendDualSubscrptionMail($data['email']);
    //     } catch (\Throwable $th) {
    //         $validator->getMessageBag()->add('email', 'Email exists');
    //         return \back()->withErrors($validator->errors());
    //     }
    //     return back()->with('status', __('Thank you for subscribing'));
    // }
}
