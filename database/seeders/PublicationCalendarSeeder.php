<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PublicationCalendar;
use App\Models\Service;
use App\Models\User;

class PublicationCalendarSeeder extends Seeder
{
    public function run()
    {
        $developer = User::where('email', 'developer@empresa.com')->first();
        $cm1 = User::where('email', 'cm1@empresa.com')->first();
        $cm2 = User::where('email', 'cm2@empresa.com')->first();
        
        $services = Service::where('tipo', 'community_manager')->get();

        foreach ($services as $service) {
            PublicationCalendar::create([
                'servicio_id' => $service->id,
                'creador_id' => $cm1->id,
                'fecha_ini' => now()->startOfMonth(),
                'fecha_fin' => now()->endOfMonth(),
                'estado' => 'en_revision',
                'correcciones_count' => 1,
                'ultimo_autor_correccion' => $developer->id,
                'document_path' => 'calendarios/calendario_' . $service->id . '.pdf',
                'fecha_entrega_real' => null,
                'created_by' => $cm1->id,
                'updated_by' => $cm1->id,
            ]);

            PublicationCalendar::create([
                'servicio_id' => $service->id,
                'creador_id' => $cm2->id,
                'fecha_ini' => now()->addMonth()->startOfMonth(),
                'fecha_fin' => now()->addMonth()->endOfMonth(),
                'estado' => 'pendiente',
                'correcciones_count' => 0,
                'ultimo_autor_correccion' => null,
                'document_path' => null,
                'fecha_entrega_real' => null,
                'created_by' => $cm2->id,
                'updated_by' => $cm2->id,
            ]);
        }
    }
}