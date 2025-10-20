<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->sentence(6),
            'author_id'=> User::factory(),
            'slug'=>Str::slug(fake()->sentence()),
            'body'=> fake()->text(),
            'hosting'=>fake()->safeEmailDomain(),
            'image'=>fake()->imageUrl(50,50,'animals', true)
        ];
    }
}
