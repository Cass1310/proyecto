<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicio_id',
        'autor_id',
        'tipo',
        'img_path',
        'estado',
        'version',
        'descripcion',
        'manual_id',
        'correcciones_count',
        'created_by',
        'updated_by',
    ];

    public function servicio()
    {
        return $this->belongsTo(Service::class, 'servicio_id');
    }

    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }

    public function manual()
    {
        return $this->belongsTo(Manual::class, 'manual_id');
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