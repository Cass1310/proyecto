<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assignment;
use App\Models\Service;
use App\Models\User;

class AssignmentSeeder extends Seeder
{
    public function run()
    {
        $developer = User::where('email', 'developer@empresa.com')->first();
        $ceo = User::where('email', 'ceo@empresa.com')->first();
        $cm1 = User::where('email', 'cm1@empresa.com')->first();
        $cm2 = User::where('email', 'cm2@empresa.com')->first();
        $designer1 = User::where('email', 'disenador1@empresa.com')->first();
        $designer2 = User::where('email', 'disenador2@empresa.com')->first();
        
        $services = Service::all();

        foreach ($services as $service) {
            if ($service->tipo == 'identidad_corporativa') {
                // Asignaciones para diseño de logo
                Assignment::create([
                    'servicio_id' => $service->id,
                    'tarea_tipo' => 'diseño_logo',
                    'assigned_to' => $designer1->id,
                    'assigned_by' => $ceo->id,
                    'fecha_inicio' => now()->subDays(10),
                    'fecha_fin' => now()->addDays(15),
                    'estado' => 'en_proceso',
                    'created_by' => $developer->id,
                    'updated_by' => $developer->id,
                ]);

                Assignment::create([
                    'servicio_id' => $service->id,
                    'tarea_tipo' => 'revision_logo',
                    'assigned_to' => $ceo->id,
                    'assigned_by' => $developer->id,
                    'fecha_inicio' => now()->addDays(16),
                    'fecha_fin' => now()->addDays(18),
                    'estado' => 'pendiente',
                    'created_by' => $developer->id,
                    'updated_by' => $developer->id,
                ]);
            } else {
                // Asignaciones para community manager
                Assignment::create([
                    'servicio_id' => $service->id,
                    'tarea_tipo' => 'calendario_publicaciones',
                    'assigned_to' => $cm1->id,
                    'assigned_by' => $ceo->id,
                    'fecha_inicio' => now()->subDays(5),
                    'fecha_fin' => now()->addDays(5),
                    'estado' => 'completado',
                    'created_by' => $developer->id,
                    'updated_by' => $developer->id,
                ]);

                Assignment::create([
                    'servicio_id' => $service->id,
                    'tarea_tipo' => 'creacion_contenido',
                    'assigned_to' => $cm2->id,
                    'assigned_by' => $ceo->id,
                    'fecha_inicio' => now(),
                    'fecha_fin' => now()->addDays(7),
                    'estado' => 'en_proceso',
                    'created_by' => $developer->id,
                    'updated_by' => $developer->id,
                ]);
            }
        }
    }
}