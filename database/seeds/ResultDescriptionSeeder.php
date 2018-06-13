<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResultDescriptionSeeder extends Seeder
{
    public function run()
    {
        $old = DB::connection('old')->table('resulttext')->get();

        foreach ($old as $entry) {
            DB::table('result_descriptions')->insert([
                'key' => $entry->key,
                'content' => $entry->content,
            ]);
        }
    }
}
