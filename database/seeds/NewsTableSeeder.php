<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i=0; $i<=29; $i++){
            DB::table('news')
                ->insert([
                    'title' => $faker->sentence,
                    'short_description' => $faker->text(50),
                    'img' => $faker->imageUrl( 640, 480, $faker->numberBetween($min = 10, $max = 200) ),
                    'date' => $faker->date()
                ]);
        };
    }
}
