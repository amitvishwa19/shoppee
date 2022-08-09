<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1,8),
            'title' => $title = $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'slug' => Str::slug($title, '-'),
            'description' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'body' => $this->faker->paragraph($nbSentences = 6, $variableNbSentences = true),
            'feature_image'=>$this->faker->imageUrl($width = 640, $height = 480)
        ];
    }
}
