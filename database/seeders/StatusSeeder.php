<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Pendiente',
                'color' => '#FF5733', // Naranja para "Pendiente"
                'description' => 'El proyecto está pendiente de inicio.',
            ],
            [
                'name' => 'En Progreso',
                'color' => '#3498DB', // Azul para "En Progreso"
                'description' => 'El proyecto está en progreso.',
            ],
            [
                'name' => 'En Espera',
                'color' => '#F1C40F', // Amarillo para "En Espera"
                'description' => 'El proyecto está en espera de recursos o aprobación.',
            ],
            [
                'name' => 'Completado',
                'color' => '#2ECC71', // Verde para "Completado"
                'description' => 'El proyecto ha sido completado satisfactoriamente.',
            ],
            [
                'name' => 'Cancelado',
                'color' => '#E74C3C', // Rojo para "Cancelado"
                'description' => 'El proyecto ha sido cancelado.',
            ],
        ];

        try {
            foreach ($statuses as $status) {
                Status::create($status);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
