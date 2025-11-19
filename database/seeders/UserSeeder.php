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
        $cmRole = Role::where('name', 'cm')->first();
        $designerRole = Role::where('name', 'designer')->first();
        $clienteRole = Role::where('name', 'cliente')->first();

        // Crear usuario developer
        $developer = User::create([
            'nombre' => 'Desarrollador Principal',
            'email' => 'developer@empresa.com',
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
            'email' => 'ceo@empresa.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567891',
            'role_id' => $ceoRole->id,
            'manager_id' => null,
            'razon_social' => null,
            'is_active' => true,
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);

        // Crear Director de Marca
        $directorMarca = User::create([
            'nombre' => 'Director Marca',
            'email' => 'directormarca@empresa.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567892',
            'role_id' => $directorMarcaRole->id,
            'manager_id' => $ceo->id,
            'razon_social' => null,
            'is_active' => true,
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);

        // Crear Director Creativo
        $directorCreativo = User::create([
            'nombre' => 'Director Creativo',
            'email' => 'directorcreativo@empresa.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567893',
            'role_id' => $directorCreativoRole->id,
            'manager_id' => $ceo->id,
            'razon_social' => null,
            'is_active' => true,
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);

        // Crear Community Managers
        $cm1 = User::create([
            'nombre' => 'Community Manager 1',
            'email' => 'cm1@empresa.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567894',
            'role_id' => $cmRole->id,
            'manager_id' => $directorMarca->id,
            'razon_social' => null,
            'is_active' => true,
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);

        $cm2 = User::create([
            'nombre' => 'Community Manager 2',
            'email' => 'cm2@empresa.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567896',
            'role_id' => $cmRole->id,
            'manager_id' => $directorMarca->id,
            'razon_social' => null,
            'is_active' => true,
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);

        // Crear Diseñadores
        $designer1 = User::create([
            'nombre' => 'Diseñador Gráfico 1',
            'email' => 'disenador1@empresa.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567895',
            'role_id' => $designerRole->id,
            'manager_id' => $directorCreativo->id,
            'razon_social' => null,
            'is_active' => true,
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);

        $designer2 = User::create([
            'nombre' => 'Diseñador Gráfico 2',
            'email' => 'disenador2@empresa.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567897',
            'role_id' => $designerRole->id,
            'manager_id' => $directorCreativo->id,
            'razon_social' => null,
            'is_active' => true,
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);

        // Crear Clientes
        $cliente1 = User::create([
            'nombre' => 'Cliente Empresa A',
            'email' => 'cliente@empresaa.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567898',
            'role_id' => $clienteRole->id,
            'manager_id' => null,
            'razon_social' => 'Empresa A S.A.',
            'is_active' => true,
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);

        $cliente2 = User::create([
            'nombre' => 'Cliente Empresa B',
            'email' => 'cliente@empresab.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567899',
            'role_id' => $clienteRole->id,
            'manager_id' => null,
            'razon_social' => 'Empresa B S.R.L.',
            'is_active' => true,
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);

        $cliente3 = User::create([
            'nombre' => 'Cliente Individual',
            'email' => 'cliente@individual.com',
            'password' => Hash::make('password123'),
            'telefono' => '+1234567800',
            'role_id' => $clienteRole->id,
            'manager_id' => null,
            'razon_social' => null,
            'is_active' => true,
            'created_by' => $developer->id,
            'updated_by' => $developer->id,
        ]);
    }
}