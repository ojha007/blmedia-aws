<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        User::firstOrCreate(
            ['email' => 'blmedia@gmail.com'],
            [
                'user_name' => 'blmedia',
                'email' => 'blmedia@gmail.com',
                'password' => Hash::make('blmedia@321'),
                'status' => true,
                'full_name' => 'Bl Media'
            ]);
        User::firstOrCreate(
            [
                'email' => 'blmedia_super1@gmail.com',
            ],
            [
                'user_name' => 'blmedia_super',
                'email' => 'blmedia_super1@gmail.com',
                'password' => Hash::make('blmedia@123'),
                'status' => true,
                'full_name' => 'Bl Media ',
                'is_super' => true
            ]);
    }
}
