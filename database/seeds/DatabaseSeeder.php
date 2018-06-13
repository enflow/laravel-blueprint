<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(ResultDescriptionSeeder::class);
        $this->call(CopySeeder::class);
    }
}
