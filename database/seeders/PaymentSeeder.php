<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Service;
use App\Models\User;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $developer = User::where('email', 'developer@empresa.com')->first();
        $services = Service::all();

        foreach ($services as $service) {
            if ($service->tipo == 'community_manager') {
                // Pagos mensuales
                for ($i = 1; $i <= 3; $i++) {
                    Payment::create([
                        'cliente_user_id' => $service->cliente_user_id,
                        'servicio_id' => $service->id,
                        'cantidad' => $service->costo / 12,
                        'fecha_pago' => now()->subMonths(3 - $i),
                        'tipo' => 'mensual',
                        'comprobante_path' => 'payments/comprobante_' . $service->id . '_' . $i . '.pdf',
                        'estado' => 'pagado',
                        'created_by' => $developer->id,
                        'updated_by' => $developer->id,
                    ]);
                }
            } else {
                // Pago único
                Payment::create([
                    'cliente_user_id' => $service->cliente_user_id,
                    'servicio_id' => $service->id,
                    'cantidad' => $service->costo,
                    'fecha_pago' => now()->subDays(rand(1, 30)),
                    'tipo' => 'unico',
                    'comprobante_path' => 'payments/comprobante_' . $service->id . '.pdf',
                    'estado' => rand(0, 1) ? 'pagado' : 'pendiente',
                    'created_by' => $developer->id,
                    'updated_by' => $developer->id,
                ]);
            }
        }
    }
}