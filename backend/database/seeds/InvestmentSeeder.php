<?php

use Illuminate\Database\Seeder;
use App\Plan;
use App\Investment;
use Carbon\Carbon;
class InvestmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $users = array(
            array('id' => '1','role' => '1','last_logged_in' => '2021-06-09 21:12:04','image_path' => 'teacher/181808.jpg','email' => 'Topfinancelimited@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$y7fCxekgFVPInVL3BZeBU.I7sqR5fySab8JikprLjEYpRqOGFyTA2','remember_token' => NULL,'created_at' => '2021-06-06 11:59:08','updated_at' => '2021-06-09 21:12:04'),
            array('id' => '8','role' => '2','last_logged_in' => '2021-06-09 17:04:11','image_path' => NULL,'email' => 'somtobuchi@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$JLK/iUnb7s.CxjcpkrIRBudRYBTOuM8829hfC55gNflOmX45PE9bC','remember_token' => NULL,'created_at' => '2021-06-08 14:31:37','updated_at' => '2021-06-09 17:04:11'),
            array('id' => '9','role' => '2','last_logged_in' => '2021-06-08 15:04:19','image_path' => NULL,'email' => 'fedexcourier2010@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$XhK4YrBKd.crDEslY5hO0usqB/YAGA/UO9SUprrqKz28I0M4lF2dC','remember_token' => NULL,'created_at' => '2021-06-08 15:04:18','updated_at' => '2021-06-08 15:04:19'),
            array('id' => '10','role' => '2','last_logged_in' => '2021-06-08 15:33:21','image_path' => NULL,'email' => 'housercliff9@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$o5HPZh54eaBzXaABdZIm0el3ezwbUt5hlZLvmL2tDn9hU1k2dNt4y','remember_token' => NULL,'created_at' => '2021-06-08 15:33:20','updated_at' => '2021-06-08 15:33:21'),
            array('id' => '11','role' => '2','last_logged_in' => '2021-06-08 19:12:35','image_path' => NULL,'email' => 'nicoleoro88@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$xj572wIXg5woEZUSqdycf.EG60/LQI5.CCh17okW4MKy7ks7uiDp2','remember_token' => NULL,'created_at' => '2021-06-08 19:12:34','updated_at' => '2021-06-08 19:12:35'),
            array('id' => '12','role' => '2','last_logged_in' => '2021-06-09 21:13:43','image_path' => NULL,'email' => 'trojanowskimartina@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$gFW8H41cmr3NUSx/y.Q3L.1dgGACL3T4lgVGyNrtOT2k.rBdN5fia','remember_token' => NULL,'created_at' => '2021-06-08 22:16:04','updated_at' => '2021-06-09 21:13:43'),
            array('id' => '14','role' => '2','last_logged_in' => '2021-06-08 22:19:45','image_path' => NULL,'email' => 'ochibuchi@yahoo.com','email_verified_at' => NULL,'password' => '$2y$10$.FAVfNYeMHu2acJuGOIV1uLWGCwb.hfuML67XzCIC3rntABjV8AT2','remember_token' => NULL,'created_at' => '2021-06-08 22:19:44','updated_at' => '2021-06-08 22:19:45'),
            array('id' => '15','role' => '2','last_logged_in' => '2021-06-09 14:13:37','image_path' => NULL,'email' => 'amosdavid199@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$SLSPLibKbPSemfuxu6hKNu5hbFFrHvA9xvwaWhQejfYp8aQUxzPyO','remember_token' => NULL,'created_at' => '2021-06-09 11:22:07','updated_at' => '2021-06-09 14:13:37'),
            array('id' => '20','role' => '2','last_logged_in' => '2021-06-09 13:22:19','image_path' => NULL,'email' => 'ella@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$xEiQGUbe7cjXSfdBjdYRtuQR0oSPvzEacskabp.1pM9rlpXYSobgy','remember_token' => NULL,'created_at' => '2021-06-09 13:22:17','updated_at' => '2021-06-09 13:22:19'),
            array('id' => '22','role' => '2','last_logged_in' => '2021-06-09 13:26:28','image_path' => NULL,'email' => 'ericpetersohn@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$k7M5Q4o57xFBsToc312TXuQ/f9p8yRHGUadKBrIAXCbr.ZJF17ll2','remember_token' => NULL,'created_at' => '2021-06-09 13:26:27','updated_at' => '2021-06-09 13:26:28'),
            array('id' => '23','role' => '2','last_logged_in' => '2021-06-09 21:00:28','image_path' => NULL,'email' => 'melissagut76@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$yV12ixwmCztCZc80p/uvcu55nBmb5e.d9k7LyJ07Maua3UDMK.lLy','remember_token' => NULL,'created_at' => '2021-06-09 21:00:27','updated_at' => '2021-06-09 21:00:28'),
            array('id' => '24','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'ericvincin@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$D42y2SD4ecohvPtd3p5oAO7WJioOMnGbJPvJI5rkPxZh6jJOTF.ce','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '25','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'feliciavinic@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$piTU9pDk9/Nv7Y0XXUSvquoVJUItbnpsGbl5DMobUIur//0tqixcG','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '26','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'johnenriqk01@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$8IBbAfNZB/AkwV.J8Vh/ge/h7eqMruMU71Ge/NGCCDE.jgJUZK6vC','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '27','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'lekishvei42@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$vtshIoii73c3NIf/6A7vA.fwqADii2MzgI/djU7MacQYBVuXZIu2W','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '28','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'patieasink@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$cSwlMSD1g1SsOnQqhXbSHus3rzSB/uy3Xua0dLh7ZuuVcUU5AxInC','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '29','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'jimokson@icloud.com','email_verified_at' => NULL,'password' => '$2y$10$3GS85r7tGECE1bu/3bC41elZu0.IPwHzwdIAhz7khJME9kai9M9ay','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '30','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'emmanuellakisha8@amazon.com','email_verified_at' => NULL,'password' => '$2y$10$yTKH7EIrUUYPJFLWiDzShu0tdXFTvpoCzQxKTteq.oRlQtY.oy59G','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '31','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'ericpeter@yahoo.com','email_verified_at' => NULL,'password' => '$2y$10$UKVlisxbg0GzEEHEdFwjTO8PWJ5F7VvZ12zdNdtSnwme.wg3RLI5.','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '32','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'jeanshim@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$D42y2SD4ecohvPtd3p5oAO7WJioOMnGbJPvJI5rkPxZh6jJOTF.ce','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '33','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'alexvix@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$piTU9pDk9/Nv7Y0XXUSvquoVJUItbnpsGbl5DMobUIur//0tqixcG','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '34','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'trshzke@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$8IBbAfNZB/AkwV.J8Vh/ge/h7eqMruMU71Ge/NGCCDE.jgJUZK6vC','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '35','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'beyolbris@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$vtshIoii73c3NIf/6A7vA.fwqADii2MzgI/djU7MacQYBVuXZIu2W','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '36','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'joelabrex@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$cSwlMSD1g1SsOnQqhXbSHus3rzSB/uy3Xua0dLh7ZuuVcUU5AxInC','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '37','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'saxvel@icloud.com','email_verified_at' => NULL,'password' => '$2y$10$3GS85r7tGECE1bu/3bC41elZu0.IPwHzwdIAhz7khJME9kai9M9ay','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '38','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'emalnuels@amazon.com','email_verified_at' => NULL,'password' => '$2y$10$yTKH7EIrUUYPJFLWiDzShu0tdXFTvpoCzQxKTteq.oRlQtY.oy59G','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18'),
            array('id' => '39','role' => '2','last_logged_in' => NULL,'image_path' => 'teacher/181808.jpg','email' => 'jeansn@yahoo.com','email_verified_at' => NULL,'password' => '$2y$10$UKVlisxbg0GzEEHEdFwjTO8PWJ5F7VvZ12zdNdtSnwme.wg3RLI5.','remember_token' => NULL,'created_at' => '2021-06-09 21:04:18','updated_at' => '2021-06-09 21:04:18')
        );
        $plans = Plan::all();
        $btc_addresses = [
            '34xp4vRoCGJym3xR7yCVPFHoCNxv4Twseo',
            '35hK24tcLEWcgNA4JxpvbkNkoAcDGqQPsP',
            '1P5ZEDWTKTFGxQjZphgWPQUpe554WKDfHQ',
            '37XuVSEpWW4trkfmvWzegTHQt7BdktSKUs',
            '37XuVSEpWW4trkfmvWzegTHQt7BdktSKUs',
            '38UmuUqPCrFmQo4khkomQwZ4VbY2nZMJ67',
            '3LYJfcfHPXYJreMsASk2jkn69LWEYKzexb',
            '3Kzh9qAqVWQhEsfQz7zEQL1EuSx5tyNLNS',
            '3LQeSjqS5aXJVCDGSHPR88QvjheTwrhP8N',
            '1LdRcdxfbSnmCYYNdeYpUnztiYzVfBEQeC',
            '1AC4fMwgY8j9onSbXEWeH6Zan8QGMSdmtA',
            '1LruNZjwamWJXThX2Y8C2d47QqhAkkc5os',
            '3FGKwP7XQA9Gb27if7zQGJSSynbzWLrV3p',
            '385cR5DM96n1HvBDMzLHPYcw89fZAXULJP',
            '3Gpex6g5FPmYWm26myFq7dW12ntd8zMcCY',
            '36KAwNUR8VeLpUfGwdk7LEN6F4yvoRWMjn',
            '3D8qAoMkZ8F1b42btt2Mn5TyN7sWfa434A',
            '17hf5H8D6Yc4B7zHEg3orAtKn7Jhme7Adx'
        ];
        $eth_addresses = [
            '0x9bf4001d307dfd62b26a2f1307ee0c0307632d59',
            '0xdf9eb223bafbe5c5271415c75aecd68c21fe3d7f',
            '0x1b3cb81e51011b549d78bf720b0d924ac763a7c2',
            '0xe92d1a43df510f82c66382592a047d288f85226f',
            '0xa929022c9107643515f5c777ce9a910f0d1e490c	',
            '0xca8fa8f0b631ecdb18cda619c4fc9d197c8affca',
            '0x7712bdab7c9559ec64a1f7097f36bc805f51ff1a',
            '0x024861e9f89d44d00a7ada4aa89fe03cab9387cd',
            '0x19184ab45c40c2920b0e0e31413b9434abd243ed',
            '0xb8808f9e9b88497ec522304055cd537a0913f6a0',
            '0xbf3aeb96e164ae67e763d9e050ff124e7c3fdd28'
        ];
        $usdt_addresses = [
            '0xb37d741cbbc09b6450913d4e38fc6264c18ba18b9bd7779cbc475cb425546368',
            '0x1fc9db9aa23a86d1e81d1b117a246660f218987936fcba0ce2966d403677e032',
            '0x1fc9db9aa23a86d1e81d1d4e38fc6264c18ba17936fcba0ce2966d403677e032',
            '0x1d4e38fc6264c18ba1d1e81d1d4e38fc6264c18ba17936fcba0ce2966d403677e032',
            '0x1d4e38fc6264c18ba1d1e81d1d4e38fc6264c18ba17936fcba0ce2966d403677e032',
            '0xfc9db9aa23a86d1e8ba1d1e81d1d4e38fc6264c18ba17936fcba0ce2966d403677e032',
            '0x1d4e38fc6264c18ba1d1e81d1d4e38fc6264c18ba17936fcba0ce2966d403677e032',
            '0x1d4fc9db9aa23a86d1ee81d1d4e38fc6264c18ba17936fcba0ce2966d403677e032',
        ];
        foreach($users as $user){
            foreach($plans as $plan){
                $i = 0;
                while($i < 6){
                    if($i < 2){
                        array_push($data, array(
                            'plan_id' => $plan->id,
                            'address' => $btc_addresses[array_rand($btc_addresses, 2)[1]],
                            'type'=> 'BTC',
                            'amount' => $plan->min_amount * $i,
                            'paying_address' => $btc_addresses[array_rand($btc_addresses, 1)],
                            'user_id' => $user['id'],
                            'status'=>'Pending',
                            'created_at' => Carbon::today()->subDays(rand(150, 365)),
                            'updated_at' => Carbon::today()->subDays(rand(0, 149))
                        ));
                    }
                    if($i>1 && $i < 4){
                        array_push($data, array(
                            'plan_id' => $plan->id,
                            'address' => $eth_addresses[array_rand($eth_addresses, 2)[1]],
                            'type'=> 'ETH',
                            'amount' => $plan->min_amount * $i,
                            'paying_address' => $eth_addresses[array_rand($eth_addresses, 2)[1]],
                            'user_id' => $user['id'],
                            'status'=>'Pending',
                            'created_at' => Carbon::today()->subDays(rand(150, 365)),
                            'updated_at' => Carbon::today()->subDays(rand(0, 149))
                        ));
                    }
                    if($i > 3 && $i < 6 ){
                        array_push($data, array(
                            'plan_id' => $plan->id,
                            'address' => $usdt_addresses[array_rand($usdt_addresses , 2)[1]],
                            'type'=> 'USDT',
                            'amount' => $plan->min_amount * $i,
                            'paying_address' => $usdt_addresses[array_rand($usdt_addresses, 1)],
                            'user_id' => $user['id'],
                            'status'=>'Pending',
                            'created_at' => Carbon::today()->subDays(rand(150, 365)),
                            'updated_at' => Carbon::today()->subDays(rand(0, 149))
                        ));
                    }
                    $i++;
                }
            }
        }
        DB::table('investments')->insert($data);
    }
}
