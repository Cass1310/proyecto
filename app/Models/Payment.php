<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_user_id',
        'servicio_id',
        'cantidad',
        'fecha_pago',
        'tipo',
        'comprobante_path',
        'estado',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'fecha_pago' => 'datetime',
        'cantidad' => 'decimal:2',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_user_id');
    }

    public function servicio()
    {
        return $this->belongsTo(Service::class, 'servicio_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}