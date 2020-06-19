<?php

use Illuminate\Database\Seeder;

class RulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rules')->insert([
            'type' => 'superadmin',
        ]);
        DB::table('rules')->insert([
            'type' => 'admin',
        ]);
        DB::table('rules')->insert([
            'type' => 'trainer',
        ]);
        DB::table('rules')->insert([
            'type' => 'customer',
        ]);
    }
}
