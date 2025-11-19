<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\User;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $developer = User::where('email', 'developer@empresa.com')->first();
        $cliente1 = User::where('email', 'cliente@empresaa.com')->first();
        $cliente2 = User::where('email', 'cliente@empresab.com')->first();
        $cliente3 = User::where('email', 'cliente@individual.com')->first();

        // Servicios de identidad corporativa
        Service::create([
            'tipo' => 'identidad_corporativa',
            'fecha_ini' => now()->subMonths(2),
            'fecha_fin' => now()->addMonths(4),
            'costo' => 2500.00,
            'cliente_user_id' => $cliente1->id,
            'estado' => 'activo',
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);

        Service::create([
            'tipo' => 'identidad_corporativa',
            'fecha_ini' => now()->subMonth(),
            'fecha_fin' => now()->addMonths(5),
            'costo' => 1800.00,
            'cliente_user_id' => $cliente2->id,
            'estado' => 'activo',
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);

        // Servicios de community manager
        Service::create([
            'tipo' => 'community_manager',
            'fecha_ini' => now()->subMonths(3),
            'fecha_fin' => now()->addMonths(9),
            'costo' => 1200.00,
            'cliente_user_id' => $cliente1->id,
            'estado' => 'activo',
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);

        Service::create([
            'tipo' => 'community_manager',
            'fecha_ini' => now()->subMonths(1),
            'fecha_fin' => now()->addMonths(11),
            'costo' => 1500.00,
            'cliente_user_id' => $cliente3->id,
            'estado' => 'activo',
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);

        // Servicio culminado
        Service::create([
            'tipo' => 'identidad_corporativa',
            'fecha_ini' => now()->subMonths(6),
            'fecha_fin' => now()->subMonth(),
            'costo' => 2000.00,
            'cliente_user_id' => $cliente3->id,
            'estado' => 'culminado',
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);
    }
}