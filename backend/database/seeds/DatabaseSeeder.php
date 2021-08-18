<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        // $this->call(AdminTableSeeder::class);
        // $this->call(AddressSeeder::class);
        // $this->call(PlanSeeder::class);
        // $this->call(UserSeeder::class);
        $this->call(InvestmentSeeder::class);
        // $this->call(WithdrawalSeeder::class);
        // $this->call(BullBearSeeder::class);
    }
}
