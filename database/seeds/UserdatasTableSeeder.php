<?php

use Illuminate\Database\Seeder;

class UserdatasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usersdatas')->insert([
            'user_id' => '1',
            'role_taxonomy' => '1',
            'profile_image' => 'https://image.freepik.com/free-vector/abstract-dynamic-pattern-wallpaper-vector_53876-59131.jpg',
            'contacts' => 'a:5:{s:3:"tel";s:7:"1234567";s:4:"city";s:5:"Minsk";s:6:"street";s:9:"Zvezdnaya";s:5:"build";s:4:"21/2";s:9:"apartment";s:2:"29";}',
            'series_access' => 'Not Access Yet',
        ]);
    }
}
