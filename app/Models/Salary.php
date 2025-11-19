<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'pagador_id',
        'empleado_id',
        'cantidad',
        'fecha_pago',
        'comprobante_path',
        'estado',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'fecha_pago' => 'date',
        'cantidad' => 'decimal:2',
    ];

    public function pagador()
    {
        return $this->belongsTo(User::class, 'pagador_id');
    }

    public function empleado()
    {
        return $this->belongsTo(User::class, 'empleado_id');
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