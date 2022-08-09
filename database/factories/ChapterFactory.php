<?php

namespace Database\Factories;

use App\Models\Chapter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChapterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chapter::class;

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
            'content' => $this->faker->paragraph($nbSentences = 10, $variableNbSentences = true),
            'feature_image' => $this->faker->imageUrl($width = 640, $height = 480),
            'free' => $this->faker->numberBetween($min = 0, $max = 1),
            'price' => $this->faker->numberBetween($min = 200, $max = 999),
            'order' => $this->faker->numberBetween($min = 1, $max = 20),
            'status' => $this->faker->numberBetween($min = 0, $max = 1),
        ];
    }
}
