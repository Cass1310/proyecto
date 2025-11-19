<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ArtworkCorrection;
use App\Models\Artwork;
use App\Models\User;

class ArtworkCorrectionSeeder extends Seeder
{
    public function run()
    {
        $developer = User::where('email', 'developer@empresa.com')->first();
        $ceo = User::where('email', 'ceo@empresa.com')->first();
        
        $artworks = Artwork::where('correcciones_count', '>', 0)->get();

        foreach ($artworks as $artwork) {
            for ($i = 1; $i <= $artwork->correcciones_count; $i++) {
                ArtworkCorrection::create([
                    'artwork_id' => $artwork->id,
                    'correccion_count' => $i,
                    'comentarios' => 'Corrección #' . $i . ': ' . ($i == 1 ? 'Ajustar colores y tipografía' : 'Mejorar composición general'),
                    'img_anterior_path' => 'correcciones/antes_' . $artwork->id . '_' . $i . '.jpg',
                    'img_nueva_path' => 'correcciones/despues_' . $artwork->id . '_' . $i . '.jpg',
                    'created_by' => $ceo->id,
                ]);
            }
        }
    }
}