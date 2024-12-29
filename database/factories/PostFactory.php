<?php

namespace Database\Factories;


use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(3),
            'status' =>rand(0,1),
            'comment_able' => rand(0,1),
            'num_of_views'=> rand(1,100),
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'created_at' => fake()->date("Y-m-d h:m:s"),
            'updated_at' => fake()->date("Y-m-d h:m:s"),
        ];
    }
}
