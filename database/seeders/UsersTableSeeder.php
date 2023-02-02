<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

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

            //admin
            [
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' =>Hash::make('111'),
                'role' => 'admin',
                'status' => 'active',
            ],
            //vendor
            [
                'name' => 'vendor',
                'username' => 'vendor',
                'email' => 'vendor@gmail.com',
                'password' =>Hash::make('111'),
                'role' => 'vendor',
                'status' => 'active', 
            ],
            //user
            [
                'name' => 'user',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' =>Hash::make('111'),
                'role' => 'user',
                'status' => 'active', 
            ],

        ]);
    }
}
