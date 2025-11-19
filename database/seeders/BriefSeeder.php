<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brief;
use App\Models\Service;
use App\Models\User;

class BriefSeeder extends Seeder
{
    public function run()
    {
        $developer = User::where('email', 'developer@empresa.com')->first();
        $services = Service::all();

        foreach ($services as $service) {
            $tipo = $service->tipo == 'identidad_corporativa' ? 'logo' : 'cm';
            
            Brief::create([
                'servicio_id' => $service->id,
                'tipo' => $tipo,
                'document_path' => 'briefs/documento_' . $service->id . '.pdf',
                'fecha_recibida' => now()->subDays(rand(5, 30)),
                'contenido_json' => json_encode([
                    'empresa' => 'Empresa ' . $service->id,
                    'objetivos' => 'Objetivos del proyecto...',
                    'publico_objetivo' => 'Descripción del público objetivo',
                    'competencia' => 'Análisis de competencia',
                    'estilo_preferido' => 'Estilo moderno y minimalista',
                    'colores' => ['#FF5733', '#3349FF', '#33FF57'],
                    'referencias' => ['referencia1.jpg', 'referencia2.jpg']
                ]),
                'created_by' => $developer->id,
                'updated_by' => $developer->id,
            ]);
        }
    }
}