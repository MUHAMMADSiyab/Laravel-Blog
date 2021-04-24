<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            [
                'name' => "Admin",
                'email' => "admin@admin.com",
                'password' => bcrypt("adminpassword"),
                'role' => 'admin'
            ],

            [
                'name' => "User",
                'email' => "user@user.com",
                'password' => bcrypt("userpassword"),
                'role' => 'user'
            ],

            [
                'name' => "User2",
                'email' => "user2@user.com",
                'password' => bcrypt("user2password"),
                'role' => 'user'
            ],
        ]);
    }
}
