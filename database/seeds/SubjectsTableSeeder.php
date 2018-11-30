<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    public function run()
    {
        factory(\SON\Models\Subject::class,50)->create();
    }
}