<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Obtener roles
        $developerRole = Role::where('name', 'developer')->first();
        $ceoRole = Role::where('name', 'ceo')->first();
        $directorMarcaRole = Role::where('name', 'director_marca')->first();
        $directorCreativoRole = Role::where('name', 'director_creativo')->first();
        $clienteRole = Role::where('name', 'cliente')->first();

        // Crear usuario developer
        User::create([
            'nombre' => 'Desarrollador Principal',
            'email' => 'developer@gmail.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567890',
            'role_id' => $developerRole->id,
            'manager_id' => null,
            'razon_social' => null,
            'is_active' => true,
            'created_by' => null,
            'updated_by' => null,
        ]);

        // Crear usuario CEO
        $ceo = User::create([
            'nombre' => 'CEO Empresa',
            'email' => 'ceo@gmail.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567891',
            'role_id' => $ceoRole->id,
            'manager_id' => null,
            'razon_social' => null,
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        // Crear Director de Marca
        $directorMarca = User::create([
            'nombre' => 'Director Marca',
            'email' => 'directormarca@gmail.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567892',
            'role_id' => $directorMarcaRole->id,
            'manager_id' => $ceo->id,
            'razon_social' => null,
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        // Crear Director Creativo
        $directorCreativo = User::create([
            'nombre' => 'Director Creativo',
            'email' => 'directorcreativo@gmail.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567893',
            'role_id' => $directorCreativoRole->id,
            'manager_id' => $ceo->id,
            'razon_social' => null,
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        // Crear algunos CM y Diseñadores
        $cmRole = Role::where('name', 'cm')->first();
        $designerRole = Role::where('name', 'designer')->first();

        User::create([
            'nombre' => 'Community Manager 1',
            'email' => 'cm1@gmail.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567894',
            'role_id' => $cmRole->id,
            'manager_id' => $directorMarca->id,
            'razon_social' => null,
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        User::create([
            'nombre' => 'Diseñador Gráfico 1',
            'email' => 'disenador1@gmail.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567895',
            'role_id' => $designerRole->id,
            'manager_id' => $directorCreativo->id,
            'razon_social' => null,
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        // Cliente
        User::create([
            'nombre' => 'Cliente Base',
            'email' => 'cliente@gmail.com',
            'password' => Hash::make('password123'),
            'role_id' => $clienteRole->id,
            'manager_id' => null,
            'is_active' => 1,
        ]);
    }
}