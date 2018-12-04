<?php

use Illuminate\Database\Seeder;

class ClassInformationsTableSeeder extends Seeder
{
    public function run()
    {
        $students = \SON\Models\Student::all();
        factory(\SON\Models\ClassInformation::class,50)
            ->create()
            ->each(function (\SON\Models\ClassInformation $model) use($students){
                /** @var \Illuminate\Support\Collection $studentsColl**/
                $studentsColl = $students->random(10);
                $model->students()->attach($studentsColl->pluck('id'));
            });
    }
}