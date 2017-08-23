<?php

use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 30; $i++){
            \App\Lesson::create([
                'title' => $faker->sentence(5),
                'body'  => $faker->paragraph(4),
                'is_ready'  => $faker->boolean()
            ]);
        }
    }
}
