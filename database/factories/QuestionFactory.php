<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween($min = 1, $max = 8),
            'question' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'type' => $this->faker->randomElement(['objective','descriptive']),
            'score' => $this->faker->numberBetween($min = 1, $max = 10),
            'status' => $this->faker->numberBetween($min = 0, $max = 1),
        ];
    }
}
