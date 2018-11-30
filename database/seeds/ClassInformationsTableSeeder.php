<?php

use Illuminate\Database\Seeder;

class ClassInformationsTableSeeder extends Seeder
{
    public function run()
    {
        factory(\SON\Models\ClassInformation::class,50)->create();
    }
}