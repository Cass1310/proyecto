<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Audit;
use App\Models\User;

class AuditSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            Audit::create([
                'user_id' => $user->id,
                'entity_type' => 'User',
                'entity_id' => $user->id,
                'action' => 'created',
                'changes' => json_encode([
                    'before' => null,
                    'after' => $user->toArray()
                ]),
            ]);

            // Simular algunas actualizaciones
            if (rand(0, 1)) {
                Audit::create([
                    'user_id' => $user->id,
                    'entity_type' => 'User',
                    'entity_id' => $user->id,
                    'action' => 'updated',
                    'changes' => json_encode([
                        'before' => ['nombre' => 'Nombre anterior'],
                        'after' => ['nombre' => $user->nombre]
                    ]),
                ]);
            }
        }
    }
}