<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Priority;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities = [
            [
                'name' => 'Baja',
                'color' => '#28A745', // Verde para "Baja"
                'description' => 'Prioridad baja, puede esperar.',
            ],
            [
                'name' => 'Media',
                'color' => '#FFC107', // Amarillo para "Media"
                'description' => 'Prioridad media, atención moderada requerida.',
            ],
            [
                'name' => 'Alta',
                'color' => '#DC3545', // Rojo para "Alta"
                'description' => 'Prioridad alta, requiere atención urgente.',
            ],
            [
                'name' => 'Crítica',
                'color' => '#6C757D', // Gris oscuro para "Crítica"
                'description' => 'Prioridad crítica, de máxima urgencia.',
            ],
        ];

        try {
            foreach ($priorities as $priority) {
                Priority::create($priority);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
