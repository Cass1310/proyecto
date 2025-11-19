<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Manual;
use App\Models\Logo;
use App\Models\Service;
use App\Models\User;

class ManualSeeder extends Seeder
{
    public function run()
    {
        $developer = User::where('email', 'developer@empresa.com')->first();
        
        $services = Service::where('tipo', 'identidad_corporativa')->get();
        $logos = Logo::where('tipo', 'version1')->get();

        foreach ($services as $service) {
            Manual::create([
                'servicio_id' => $service->id,
                'logo_id' => $logos->where('servicio_id', $service->id)->first()->id ?? null,
                'manual_path' => 'manuals/manual_' . $service->id . '.pdf',
                'created_by' => $developer->id,
                'updated_by' => $developer->id,
            ]);
        }
    }
}