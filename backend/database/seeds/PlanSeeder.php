<?php

use Illuminate\Database\Seeder;
use App\Plan;
class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'id'=>17,
            'name'=>'Basic plan',
            'min_amount'=>100,
            'max_amount'=>1000,
            'interest'=>5,
            'maturity'=>12,
        ]);
        Plan::create([
            'id'=>18,
            'name'=>'Standard plan',
            'min_amount'=>1500,
            'max_amount'=>5000,
            'interest'=>10,
            'maturity'=>24,
        ]);
        Plan::create([
            'id'=>19,
            'name'=>'Premium plan',
            'min_amount'=>2500,
            'max_amount'=>7000,
            'interest'=>15,
            'maturity'=>24,
        ]);
        Plan::create([
            'id'=>20,
            'name'=>'Representative plan',
            'min_amount'=>5000,
            'max_amount'=>10000,
            'interest'=>25,
            'maturity'=>48,
        ]);
    }
}
