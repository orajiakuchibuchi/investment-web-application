<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UserSeeder extends Seeder
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
            'role' => \App\Role::$I,
            'email' => 'ericvincin@gmail.com',
            'image_path'=> 'teacher/181808.jpg',
            'password' => bcrypt('password'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'role' => \App\Role::$I,
            'email' => 'feliciavinic@gmail.com',
            'image_path'=> 'teacher/181808.jpg',
            'password' => bcrypt('password'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'role' => \App\Role::$I,
            'email' => 'johnenriqk01@gmail.com',
            'image_path'=> 'teacher/181808.jpg',
            'password' => bcrypt('password'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'role' => \App\Role::$I,
            'email' => 'lekishvei42@gmail.com',
            'image_path'=> 'teacher/181808.jpg',
            'password' => bcrypt('password'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'role' => \App\Role::$I,
            'email' => 'patieasink@gmail.com',
            'image_path'=> 'teacher/181808.jpg',
            'password' => bcrypt('password'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'role' => \App\Role::$I,
            'email' => 'jimokson@icloud.com',
            'image_path'=> 'teacher/181808.jpg',
            'password' => bcrypt('password'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'role' => \App\Role::$I,
            'email' => 'emmanuellakisha8@amazon.com',
            'image_path'=> 'teacher/181808.jpg',
            'password' => bcrypt('password'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'role' => \App\Role::$I,
            'email' => 'ericpeter@yahoo.com',
            'image_path'=> 'teacher/181808.jpg',
            'password' => bcrypt('password'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        DB::table('users')->insert($data);
    }
}
