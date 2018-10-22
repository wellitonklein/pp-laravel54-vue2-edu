<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(\SON\User::class)->create([
            'email' => 'admin@user.com'
        ]);
    }
}