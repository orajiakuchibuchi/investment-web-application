<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Plan;
use App\Investment;
use Carbon\Carbon;
use App\User;
use App\Withdrawal;
use App\DoubleInvestment;
use App\BullBear;
use App\Http\Controllers\mail\MailController;
class PlanController extends Controller
{
    public function create(Request $request){
        $data = $request->all();
        $rules = [
            'name' => 'required|string',
            'min_amount'=> 'required|integer',
            'max_amount'=>'required|integer',
            'interest' => 'required| integer|min:0',
            'maturity' => 'required|integer|min:1'
        ];
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $name = Plan::where('name', $data['name'])->first();
        if($name){
            return response()->json([
                'status'=>'400',
                'response'=>'Plan with name already exists'
            ], 200);
        }else{
            $plan = Plan::create([
                'name' => $data['name'],
                'min_amount'=> $data['min_amount'],
                'max_amount'=>$data['max_amount'],
                'interest' => $data['interest'],
                'maturity' => $data['maturity']
            ]);
            (new MailController())->publishPlan($data['name'], $data['min_amount'], $data['max_amount'], $data['interest'], $data['maturity']);
            return response()->json([
                'status'=>'200',
                'response'=>'Plan created'
            ]);
        }
    }
    public function withdrawHistory(Request $request){
        $data = $request->all();
        return response()->json(
            Withdrawal::where('user_id', $data['user_id'])
            ->with('investment')->orderBy('updated_at', 'desc')->get()
            ,200);
    }
    public function allPlansAdmin(Request $request){
        $data = $request->all();
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'response'=>'Forbidden',
            ],500);
        }
        $plans = Plan::take(50)->orderBy('created_at', 'desc')->with('investments')->get();
        return response()->json([
            'status'=>'200',
            'response'=>$plans,
        ],200);
    }
    public function allPlans(){
        return response()->json(Plan::orderBy('max_amount', 'asc')->get(), 200);
    }
    public function withdrawableInvest(Request $request){
        $data = $request->all();
        $approvedInvestment = Investment::where('user_id', $data['user_id'])->where('status', 'Confirmed')->with('plans')->get();
        $withdrawable = [];
        foreach($approvedInvestment as $approved){
            $now = Carbon::now();
            $approved_at = Carbon::createFromFormat('Y-m-d H:s:i', $approved->updated_at);
            $differnce = $approved_at->diffInHours($now);
            if($differnce > $approved->maturity){
                array_push($withdrawable, $approved);
            }
        }
        if(count($withdrawable)>0){
            $last = [];
            foreach($withdrawable as $withdraw){
                $pending = Withdrawal::where('investment_id', $withdraw['id'])->first();
                if(!$pending){
                    array_push($last, $withdraw);
                }
            }
            return response()->json($last, 200);
        }
        return response()->json($withdrawable, 200);
    }
    public function withdrawRequest(Request $request){
        $data = $request->all();
        $rules = [
            'investment_id'=>'required',
            'payment_method'=>'required|in:BTC,ETH,USDT',
            'paying_address'=>'required',
            'amount'=>'required',
            'user_id'=>'required'
        ];

        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        try {
            Withdrawal::create([
                'investment_id'=>$data['investment_id'],
                'payment_method'=>$data['payment_method'],
                'paying_address'=>$data['paying_address'],
                'amount'=>$data['amount'],
                'user_id'=>$data['user_id'],
                'status'=>'Pending',
            ]);
            $us = User::where('id', $data['user_id'])->first();
            (new MailController())->sendDualWithdrawalRequest($us->email, $data['amount'], $data['paying_address'], $data['payment_method']);
        } catch(\Exception $ex) {
            return response()->json([
                'status'=>'400',
                'response'=>'Pending withdrawal'
            ], 200);
        }
        return response()->json([
            'status'=>'200',
            'response'=>'Withdraw received, awaiting confiramtion'
        ], 200);
    }
    public function investmentHistory(Request $request){
        $data = $request->all();
        return response()->json(
            Investment::where('user_id', $data['user_id'])
            ->with('Plans')->orderBy('updated_at', 'desc')->get()
            ,200);
    }
    public function approvedInvestment(Request $request){
        $data = $request->all();
        // return;
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'response'=>'Forbidden',
            ],500);
        }
        return response()->json(
            Investment::where('status', 'Confirmed')
            ->with('Plans')->orderBy('updated_at', 'desc')->get()
            ,200);
    }
    public function approvedWithdrawal(Request $request){
        $data = $request->all();
        // return;
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'response'=>'Forbidden',
            ],500);
        }
        return response()->json(
            Withdrawal::where('status', 'Confirmed')
            ->with('investment')->with('user')->orderBy('updated_at', 'desc')->get()
            ,200);
    }
    public function invest(Request $request){
        $data = $request->all();
        $rules = [
            'plan_id'=>'required',
            'address'=>'required',
            'type'=>'required',
            'amount'=>'required',
            'paying_address'=>'required',
            'user_id'=>'required'
        ];
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $inv = Investment::create([
            'plan_id'=>$data['plan_id'],
            'address'=>$data['address'],
            'type'=>$data['type'],
            'amount'=>$data['amount'],
            'paying_address'=>$data['paying_address'],
            'user_id'=>$data['user_id'],
            'status' => 'Pending'
        ]);

        $investment = Investment::where('id', $inv->id)->with('plans')->first();
        $user = User::where('id', $data['user_id'])->first();
        if(DoubleInvestment::query()->pluck('status')->first() == '1'){
            $duplicate = $inv->replicate();
            $duplicate->save();
            (new MailController())->sendDualInvestRequest($user->email, $investment->name, $data['address'],$data['amount'], $data['type']);
        }
        (new MailController())->sendDualInvestRequest($user->email, $investment->name, $data['address'],$data['amount'], $data['type']);
        return response()->json([
            'status'=>'200',
            'response'=>'Investment recieved, awaiting confirmation.'
        ], 200);
    }
}
