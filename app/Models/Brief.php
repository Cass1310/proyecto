<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brief extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicio_id',
        'tipo',
        'document_path',
        'fecha_recibida',
        'contenido_json',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'fecha_recibida' => 'datetime',
        'contenido_json' => 'array',
    ];

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