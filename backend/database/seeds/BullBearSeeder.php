<?php

use Illuminate\Database\Seeder;
use App\Plan;
use App\Withdrawal;
use Carbon\Carbon;
use App\Investment;
class BullBearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $investments = Investment::where('status', 'Confirmed')->with('plans')->get();
        foreach($investments as $investment){
            array_push($data, array(
                'action' => 'Invested',
                'coin' => $investment->type,
                'address'=> $investment->address,
                'amount' => $investment->amount + ($investment->amount * ($investment->plans->interest/100)),
                'user_id' => $investment->user_id,
                // 'status'=>'Confirmed',
                // 'created_at' => $investment->updated_at,
                // 'updated_at' =>  $investment->updated_at
            ));
        }
        $withdraws = Withdrawal::where('status', 'Confirmed')->get();
        foreach($withdraws as $withdraw){
            array_push($data, array(
                'action' => 'Withdrew',
                'coin' => $withdraw->payment_method,
                'address'=> $withdraw->paying_address,
                'amount' => $withdraw->amount,
                'user_id' => $withdraw->user_id,
                // 'status'=>'Confirmed',
                // 'created_at' => $investment->updated_at,
                // 'updated_at' =>  $investment->updated_at
            ));
        }
        DB::table('bull_bears')->insert($data);
    }
}
