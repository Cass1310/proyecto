<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artwork;
use App\Models\PublicationCalendar;
use App\Models\User;

class ArtworkSeeder extends Seeder
{
    public function run()
    {
        $developer = User::where('email', 'developer@empresa.com')->first();
        $designer1 = User::where('email', 'disenador1@empresa.com')->first();
        $designer2 = User::where('email', 'disenador2@empresa.com')->first();
        
        $calendars = PublicationCalendar::all();

        foreach ($calendars as $calendar) {
            Artwork::create([
                'calendar_id' => $calendar->id,
                'autor_id' => $designer1->id,
                'fecha_pub' => now()->addDays(rand(1, 30)),
                'titulo' => 'Arte para publicación ' . $calendar->id,
                'cuerpo' => 'Contenido del cuerpo de la publicación...',
                'copy' => 'Texto copy para redes sociales...',
                'descripcion' => 'Descripción detallada del arte',
                'img_path' => 'artworks/arte_' . $calendar->id . '_1.jpg',
                'tipo' => 'color',
                'estado' => 'pendiente',
                'correcciones_count' => 0,
                'created_by' => $designer1->id,
                'updated_by' => $designer1->id,
            ]);

            Artwork::create([
                'calendar_id' => $calendar->id,
                'autor_id' => $designer2->id,
                'fecha_pub' => now()->addDays(rand(1, 30)),
                'titulo' => 'Arte promocional ' . $calendar->id,
                'cuerpo' => 'Contenido promocional...',
                'copy' => 'Texto promocional atractivo...',
                'descripcion' => 'Arte para promoción especial',
                'img_path' => 'artworks/arte_' . $calendar->id . '_2.jpg',
                'tipo' => 'venta',
                'estado' => 'aprobado',
                'correcciones_count' => 2,
                'created_by' => $designer2->id,
                'updated_by' => $designer2->id,
            ]);
        }
    }
}