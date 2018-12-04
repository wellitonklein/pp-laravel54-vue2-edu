<?php

use Illuminate\Database\Seeder;
use \SON\Models\User;
use \SON\Models\UserProfile;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(\SON\Models\User::class)->create([
            'email' => 'admin@user.com',
            'enrolment' => 100000
        ])->each(function (User $user){
            $profile = factory(UserProfile::class)->make();
            $user->profile()->create($profile->toArray());
            User::assingRole($user, User::ROLE_ADMIN);
            $user->save();
        });

        factory(User::class,100)->create()->each(function (User $user){
            if (!$user->userable){
                $profile = factory(UserProfile::class)->make();
                $user->profile()->create($profile->toArray());
                User::assingRole($user, User::ROLE_TEACHER);
                User::assignEnrolment(new User(), User::ROLE_TEACHER);
                $user->save();
            }
        });

        factory(User::class,100)->create()->each(function (User $user){
            if (!$user->userable){
                $profile = factory(UserProfile::class)->make();
                $user->profile()->create($profile->toArray());
                User::assingRole($user, User::ROLE_STUDENT);
                User::assignEnrolment(new User(), User::ROLE_STUDENT);
                $user->save();
            }
        });
    }
}