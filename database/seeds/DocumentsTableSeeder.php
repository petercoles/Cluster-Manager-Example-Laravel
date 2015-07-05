<?php

use Illuminate\Database\Seeder;
use App\Document;

class DocumentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('documents')->truncate();

        for ($i = 0; $i < 10; $i++) {
            factory('App\Document')->make()->save();
        }
    }
}
