<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
//use Illuminate\Database\Seeders\Faker\Factory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Classroom::factory(10)->create();
        $faker = \Faker\Factory::create();

	    	Classroom::create([
	            'user_id' => 1,
                'name' => $title = 'Pre School',
                'description' => 'For kids aged beetween 2yrs to 3yrs',
                'overview' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
                'classroom_code' => Str::upper(Str::random(10)),
                'order' => 1,
                'status' => 1,
            ]);
            Classroom::create([
	            'user_id' => 1,
                'name' => $title = 'Kinder garden',
                'description' => 'For kids aged beetween 3yrs to 4yrs',
                'overview' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
                'classroom_code' => Str::upper(Str::random(10)),
                'order' => 2,
                'status' => 1,
	        ]);
            Classroom::create([
	            'user_id' => 1,
                'name' => $title = 'Nursery',
                'description' => 'For kids aged beetween 4yrs to 5yrs',
                'overview' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
                'classroom_code' => Str::upper(Str::random(10)),
                'order' => 3,
                'status' => 1,
	        ]);
            Classroom::create([
	            'user_id' => 1,
                'name' => $title = 'Lower-Kg',
                'description' => 'For kids aged beetween 5yrs to 6yrs',
                'overview' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
                'classroom_code' => Str::upper(Str::random(10)),
                'order' => 4,
                'status' => 1,
	        ]);
            Classroom::create([
	            'user_id' => 1,
                'name' => $title = 'Upper-Kg',
                'description' => 'For kids aged beetween 6yrs to 7yrs',
                'overview' => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
                'classroom_code' => Str::upper(Str::random(10)),
                'order' => 5,
                'status' => 1,
	        ]);

    }
}
