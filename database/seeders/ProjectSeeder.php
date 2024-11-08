<?php

namespace Database\Seeders;

use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i <21 ; $i++) { 
            Project::create([
                'created_by'=>User::inRandomOrder()->first()->id,
                'updated_by'=>fake()->randomElement([null, User::inRandomOrder()->first()->id]),
                'status_id'=>Status::inRandomOrder()->first()->id,
                'priority_id'=>Priority::inRandomOrder()->first()->id,
                'name'=>'Project 000'.($i+1),
                'description' => 'Description of: Project 000' . ($i + 1) . ' - ' . implode("\n\n", fake()->paragraphs(5)),
                'start_date'=>fake()->dateTimeBetween('-1 year', 'now'),
                'due_date'=>fake()->randomElement([null, fake()->dateTimeBetween('now', '+1 year')]),
                'image_path'=>null,
            ]);
        }
    }
}
