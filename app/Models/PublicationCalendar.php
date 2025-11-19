<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationCalendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicio_id',
        'creador_id',
        'fecha_ini',
        'fecha_fin',
        'estado',
        'correcciones_count',
        'ultimo_autor_correccion',
        'document_path',
        'fecha_entrega_real',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'fecha_ini' => 'date',
        'fecha_fin' => 'date',
        'fecha_entrega_real' => 'date',
    ];

    public function servicio()
    {
        return $this->belongsTo(Service::class, 'servicio_id');
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'creador_id');
    }

    public function artworks()
    {
        return $this->hasMany(Artwork::class, 'calendar_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'calendar_id');
    }

    public function ultimoAutorCorreccion()
    {
        return $this->belongsTo(User::class, 'ultimo_autor_correccion');
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