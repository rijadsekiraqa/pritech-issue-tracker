<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'start_date'  => $this->faker->dateTimeBetween('-3 months', 'now'),
            'deadline'    => $this->faker->dateTimeBetween('now', '+3 months'),
            'user_id'     => User::factory(),
        ];
    }
}
