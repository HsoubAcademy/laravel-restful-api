<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private $toTruncateTables = [
        'lessons'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach($this->toTruncateTables as $table){
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call(LessonsTableSeeder::class);
    }
}
