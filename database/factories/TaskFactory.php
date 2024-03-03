<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Task::class;
    public function definition()
    {
        return [
            'desсription' => 'Desс '.$this->faker->name(),
            'created_at' => $this->faker->dateTime($max = 'now', $timezone = null),
            'updated_at' => $this->faker->dateTime($max = 'now', $timezone = null),
            'status' => $this->faker->randomElement($array=['active','completed','canceled']),
        ];
    }
}
