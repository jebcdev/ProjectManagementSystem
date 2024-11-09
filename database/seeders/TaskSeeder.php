<?php

namespace Database\Seeders;

use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Project::all() as $project) {
            // for ($i = 1; $i <= 50; $i++) {
            for ($i = 1; $i <= 5; $i++) {
                Task::create([
                    'project_id' => $project->id,
                    'assigned_user_id' => fake()->randomElement([User::inRandomOrder()->first()->id, null]),
                    'created_by' => User::inRandomOrder()->first()->id,
                    'updated_by' => fake()->randomElement([User::inRandomOrder()->first()->id, null]),
                    'status_id' => Status::inRandomOrder()->first()->id,
                    'priority_id' => Priority::inRandomOrder()->first()->id,
                    'name' => $project->name . ' Task 000' . $i,
                    'description' => implode("\n\n", fake()->paragraphs(5)),
                    // 'start_date'=>fake()->dateTimeBetween('-1 year', 'now'),
                    // 'due_date'=>fake()->randomElement([null, fake()->dateTimeBetween('now', '+1 year')]),

                    'start_date' => fake()->dateTimeBetween('-2 year', 'now'),
                    'due_date'=>fake()->randomElement([null, fake()->dateTimeBetween('-1 year', '+1 year')]),
                    'image_path' => null,
                ]);
            }
        }
    }
}
