<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = Carbon::now()->subSeconds(rand(0, 30 * 24 * 60 * 60));
        $end = (clone $start)->addDays(5);
        $statusArray = [Task::ACTIVE, Task::SUCCESS, Task::AT_WORK, Task::OVERDUE];
        return [
            //
            'title' => fake()->title(),
            'body' => fake()->text(),
            'user_id_creator' => User::factory(),
            'user_id_getter' => User::factory(),
            'period_start' => $start,
            'period_end' => $end,
            'status' => $statusArray[array_rand($statusArray)], 
        ];
    }
}
