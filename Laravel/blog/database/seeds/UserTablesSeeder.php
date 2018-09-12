<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'    => 'Duyen',
            'email'    => 'duyen123@gmail.com',
            'password'   =>  Hash::make('123456789'),
            'remember_token' =>  str_random(10),
        ]);
    }
}
