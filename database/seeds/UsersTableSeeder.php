<?php

use Illuminate\Database\Seeder;
use \SON\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(\SON\Models\User::class)->create([
            'email' => 'admin@user.com',
            'enrolment' => 100000
        ])->each(function (User $user){
            User::assingRole($user, User::ROLE_ADMIN);
            $user->save();
        });

        factory(\SON\Models\User::class)->create()->each(function (User $user){
            if (!$user->userable){
                User::assingRole($user, User::ROLE_TEACHER);
                User::assignEnrolment(new User(), User::ROLE_TEACHER);
                $user->save();
            }
        });

        factory(\SON\Models\User::class)->create()->each(function (User $user){
            if (!$user->userable){
                User::assingRole($user, User::ROLE_STUDENT);
                User::assignEnrolment(new User(), User::ROLE_STUDENT);
                $user->save();
            }
        });
    }
}