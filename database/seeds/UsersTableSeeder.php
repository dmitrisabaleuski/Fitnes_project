<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'SuperAdmin',
            'second_name' => 'SuperAdmin',
            'rule' => '1',
            'email' => 'dmitrisabaleuski@gmail.com',
            'password' => bcrypt('123'),
        ]);
    }
}
