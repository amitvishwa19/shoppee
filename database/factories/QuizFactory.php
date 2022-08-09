<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quiz::class;

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
            'feature_image' => $this->faker->imageUrl($width = 640, $height = 480),
            'notice_published' => $this->faker->numberBetween($min = 0, $max = 1),
            'result_published' => $this->faker->numberBetween($min = 0, $max = 1),
            'start_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'end_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'status' => $this->faker->numberBetween($min = 0, $max = 1),
        ];
    }
}
