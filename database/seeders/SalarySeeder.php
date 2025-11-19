<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Salary;
use App\Models\User;

class SalarySeeder extends Seeder
{
    public function run()
    {
        $developer = User::where('email', 'developer@empresa.com')->first();
        $ceo = User::where('email', 'ceo@empresa.com')->first();
        
        $empleados = User::whereIn('role_id', [3, 4, 5, 6])->get();

        foreach ($empleados as $empleado) {
            $salarioBase = match($empleado->role->name) {
                'director_marca', 'director_creativo' => 5000.00,
                'cm' => 2500.00,
                'designer' => 3000.00,
                default => 2000.00
            };

            for ($i = 1; $i <= 3; $i++) {
                Salary::create([
                    'pagador_id' => $ceo->id,
                    'empleado_id' => $empleado->id,
                    'cantidad' => $salarioBase,
                    'fecha_pago' => now()->subMonths(3 - $i)->startOfMonth(),
                    'comprobante_path' => 'salaries/salario_' . $empleado->id . '_' . $i . '.pdf',
                    'estado' => 'pagado',
                    'created_by' => $developer->id,
                    'updated_by' => $developer->id,
                ]);
            }
        }
    }
}