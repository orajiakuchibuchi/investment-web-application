<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        array_push($data, array(
            'role' => \App\Role::$A,
            'email' => 'admin@gmail.com',
            'image_path'=> 'teacher/181808.jpg',
            'password' => bcrypt('password'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        DB::table('users')->insert($data);
    }
}
