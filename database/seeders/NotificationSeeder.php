<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $developer = User::where('email', 'developer@empresa.com')->first();
        $users = User::all();

        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'entidad_tipo' => 'System',
                'entidad_id' => null,
                'tipo' => 'info',
                'mensaje' => 'Bienvenido al sistema ' . $user->nombre,
                'is_read' => rand(0, 1),
                'delivery_push' => true,
                'created_by' => $developer->id,
            ]);

            if ($user->role->name == 'cliente') {
                Notification::create([
                    'user_id' => $user->id,
                    'entidad_tipo' => 'Service',
                    'entidad_id' => 1,
                    'tipo' => 'update',
                    'mensaje' => 'Tu servicio ha sido actualizado',
                    'is_read' => false,
                    'delivery_push' => true,
                    'created_by' => $developer->id,
                ]);
            }
        }
    }
}