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
        $this->call('UsersTableSeeder');
        $this->call('RulesTableSeeder');
        $this->call('UserdatasTableSeeder');

        $this->command->info('Таблица пользователей загружена данными!');
    }
}
