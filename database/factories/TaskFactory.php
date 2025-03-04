<?php

namespace Database\Factories;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Tasks::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'desc' => $this->faker->sentence(),
            'user_id' => User::factory(),
        ];
    }
}
