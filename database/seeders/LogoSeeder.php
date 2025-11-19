<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Logo;
use App\Models\Service;
use App\Models\User;

class LogoSeeder extends Seeder
{
    public function run()
    {
        $developer = User::where('email', 'developer@empresa.com')->first();
        $designer1 = User::where('email', 'disenador1@empresa.com')->first();
        $designer2 = User::where('email', 'disenador2@empresa.com')->first();
        
        $services = Service::where('tipo', 'identidad_corporativa')->get();

        foreach ($services as $service) {
            // Propuestas iniciales
            Logo::create([
                'servicio_id' => $service->id,
                'autor_id' => $designer1->id,
                'tipo' => 'propuestas',
                'img_path' => 'logos/propuesta_' . $service->id . '_1.jpg',
                'estado' => 'entregado',
                'version' => 'vertical',
                'descripcion' => 'Propuesta inicial de logo vertical',
                'manual_id' => null,
                'correcciones_count' => 0,
                'created_by' => $designer1->id,
                'updated_by' => $designer1->id,
            ]);

            Logo::create([
                'servicio_id' => $service->id,
                'autor_id' => $designer2->id,
                'tipo' => 'propuestas',
                'img_path' => 'logos/propuesta_' . $service->id . '_2.jpg',
                'estado' => 'entregado',
                'version' => 'horizontal',
                'descripcion' => 'Propuesta inicial de logo horizontal',
                'manual_id' => null,
                'correcciones_count' => 0,
                'created_by' => $designer2->id,
                'updated_by' => $designer2->id,
            ]);

            // Versión 1 con correcciones
            Logo::create([
                'servicio_id' => $service->id,
                'autor_id' => $designer1->id,
                'tipo' => 'version1',
                'img_path' => 'logos/version1_' . $service->id . '.jpg',
                'estado' => 'corregido',
                'version' => 'vertical',
                'descripcion' => 'Primera versión corregida del logo',
                'manual_id' => null,
                'correcciones_count' => 2,
                'created_by' => $designer1->id,
                'updated_by' => $designer1->id,
            ]);
        }
    }
}