<?php

use Illuminate\Database\Seeder;
use App\Plan;
use App\Withdrawal;
use Carbon\Carbon;
use App\Investment;
class WithdrawalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Investment::where('amount', 0)->update([
        //     'amount'=>1000
        // ]);
        // Withdrawal::where('amount', 0)->update([
        //     'amount'=>1000
        // ]);
        // Investment::where('created_at', NULL)->update([
        //     'created_at'=>now(),
        //     'updated_at'=>now()
        // ]);
        $data = [];
        $investments = Investment::where('status', 'Confirmed')->with('plans')->get();
        foreach($investments as $investment){
            try {
                $to = Carbon::createFromFormat('Y-m-d H:s:i', $investment['created_at']);
                $from = Carbon::createFromFormat('Y-m-d H:s:i', $investment['updated_at']);
                // dd("jii");
            } catch (\Throwable $th) {
                if(is_null($investment->created_at)){
                    Investment::where('id', $investment->id)->update([
                        'created_at'=> '2020-08-29 00:00:00',
                        'updated_at'=>'2020-11-29 00:00:00'
                    ]);
                    $to = Carbon::createFromFormat('Y-m-d H:s:i', '2020-08-29 00:00:00');
                    $from = Carbon::createFromFormat('Y-m-d H:s:i', '2020-12-29 00:00:00');
                    $diff_in_hours = $from->diffInDays($to);
                }else{
                    $to = Carbon::createFromFormat('Y-m-d H:s:i', $investment['created_at']);
                    $from = Carbon::createFromFormat('Y-m-d H:s:i', $investment['updated_at']);
                }
            }
            $diff_in_hours = $from->diffInHours($to);
            if($diff_in_hours > 48){
                array_push($data, array(
                    'investment_id' => $investment->id,
                    'payment_method' => $investment->type,
                    'paying_address'=> $investment->address,
                    'amount' => $investment->amount + ($investment->amount * ($investment->plans->interest/100)),
                    'user_id' => $investment->user_id,
                    'status'=>'Confirmed',
                    'created_at' => $to->addDays(1),
                    'updated_at' => $to->addDays(2)
                ));
            }
        }
        DB::table('withdrawals')->insert($data);
    }
}
