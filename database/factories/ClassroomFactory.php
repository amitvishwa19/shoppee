<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassroomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Classroom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 8),
            'name' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'overview' => $this->faker->paragraph($nbSentences = 6, $variableNbSentences = true),
            'classroom_code' => Str::upper(Str::random(10)),
            'order' => $this->faker->numberBetween($min = 1, $max = 10),
            'status' => $this->faker->numberBetween($min = 0, $max = 1),
        ];
    }
}
