<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
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
            'email' => 'superadmin001@wj.com',
            'phone' => '087182829393',
            'role' => 'admin',
            'password' => bcrypt('aa123')
        ]);
    }
}
