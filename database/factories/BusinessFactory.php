<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Business>
 */
class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'about' => $this->faker->paragraph(),
            'website' => $this->faker->url(),
            'service_form' => rand(0,12).' '.$this->faker->amPm(),
            'service_to' => rand(0,12).' '.$this->faker->amPm(),
            'category_id' => rand(1,25),
            'user_id' => rand(1,5)
        ];
    }
}
