<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\User;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function deleteBTCAdress(Request $request){
        $data = $request->all();
        $rules = [
            'address'=>'required',
            'user_id'=>'required'
        ];
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status'=>'500',
                'errors'=>'Invalid form, Kindly fill all required fields'
            ], 200);
        }
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'response'=>'Forbidden',
            ],500);
        }
        Address::where('coin', 'BTC')->update([
            'address'=>null
        ]);
        return response()->json([
            'status'=>'200',
            'response'=>'Address updated',
            'data'=> Address::where('coin', 'BTC')->get()
        ], 200);
    }
    public function deleteUSDTAdress(Request $request){
        $data = $request->all();
        $rules = [
            'address'=>'required',
            'user_id'=>'required'
        ];
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status'=>'500',
                'errors'=>'Invalid form, Kindly fill all required fields'
            ], 200);
        }
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'response'=>'Forbidden',
            ],500);
        }
        Address::where('coin', 'USDT')->update([
            'address'=>null
        ]);
        return response()->json([
            'status'=>'200',
            'response'=>'Address updated',
            'data'=> Address::where('coin', 'USDT')->get()
        ], 200);
    }
    public function deleteETHAddress(Request $request){
        $data = $request->all();
        $rules = [
            'address'=>'required',
            'user_id'=>'required'
        ];
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status'=>'500',
                'errors'=>'Invalid form, Kindly fill all required fields'
            ], 200);
        }
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'response'=>'Forbidden',
            ],500);
        }
        Address::where('coin', 'ETH')->update([
            'address'=>null
        ]);
        return response()->json([
            'status'=>'200',
            'response'=>'Address updated',
            'data'=> Address::where('coin', 'ETH')->get()
        ], 200);
    }
    public function updateBTCAdress(Request $request){
        $data = $request->all();
        $rules = [
            'address'=>'required',
            'user_id'=>'required'
        ];
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status'=>'500',
                'errors'=>'Invalid form, Kindly fill all required fields'
            ], 200);
        }
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'response'=>'Forbidden',
            ],500);
        }
        Address::where('coin', 'BTC')->update([
            'address'=>$data['address']
        ]);
        return response()->json([
            'status'=>'200',
            'response'=>'Address updated',
            'data'=> Address::where('coin', 'BTC')->get()
        ], 200);
    }
    public function updateUSDTAdress(Request $request){
        $data = $request->all();
        $rules = [
            'address'=>'required',
            'user_id'=>'required'
        ];
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status'=>'500',
                'errors'=>'Invalid form, Kindly fill all required fields'
            ], 200);
        }
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'response'=>'Forbidden',
            ],500);
        }
        Address::where('coin', 'USDT')->update([
            'address'=>$data['address']
        ]);
        return response()->json([
            'status'=>'200',
            'response'=>'Address updated',
            'data'=> Address::where('coin', 'USDT')->get()
        ], 200);
    }
    public function updateETHAdress(Request $request){
        $data = $request->all();
        $rules = [
            'address'=>'required',
            'user_id'=>'required'
        ];
        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json([
                'status'=>'500',
                'errors'=>'Invalid form, Kindly fill all required fields'
            ], 200);
        }
        $user = User::where('id', $data['user_id'])->first();
        if($user['role']  != 1){
            return response()->json([
                'status'=>'500',
                'response'=>'Forbidden',
            ],500);
        }
        Address::where('coin', 'ETH')->update([
            'address'=>$data['address']
        ]);
        return response()->json([
            'status'=>'200',
            'response'=>'Address updated',
            'data'=> Address::where('coin', 'ETH')->get()
        ], 200);
    }
    public function getInfo($type){
        return response()->json(Address::where('coin', $type)->get(), 200);
    }
    public function getBTCAddress(){
        return response()->json(Address::where('coin', 'BTC')->get(), 200);
    }
    public function getETHAddress(){
        return response()->json(Address::where('coin', 'ETH')->get(), 200);
    }
    public function paymentAddresses(){
        return response()->json(Address::whereNotNull('address')->get(), 200);
    }
}
