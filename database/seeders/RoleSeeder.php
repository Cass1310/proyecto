<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'developer', 'description' => 'Acceso total al sistema'],
            ['name' => 'ceo', 'description' => 'Director general - funciones administrativas'],
            ['name' => 'director_marca', 'description' => 'Director de marca - supervisa CM'],
            ['name' => 'director_creativo', 'description' => 'Director creativo - supervisa diseñadores'],
            ['name' => 'cm', 'description' => 'Community Manager - gestiona calendarios y publicaciones'],
            ['name' => 'designer', 'description' => 'Diseñador gráfico - crea logos y artes'],
            ['name' => 'cliente', 'description' => 'Cliente de la empresa'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}