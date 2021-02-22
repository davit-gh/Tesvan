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
    	DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => "Super Admin",
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
