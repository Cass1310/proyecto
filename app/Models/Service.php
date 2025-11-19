<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'fecha_ini',
        'fecha_fin',
        'costo',
        'cliente_user_id',
        'estado',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'fecha_ini' => 'date',
        'fecha_fin' => 'date',
        'costo' => 'decimal:2',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_user_id');
    }

    public function brief()
    {
        return $this->hasOne(Brief::class, 'servicio_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'servicio_id');
    }

    public function logos()
    {
        return $this->hasMany(Logo::class, 'servicio_id');
    }

    public function manuals()
    {
        return $this->hasMany(Manual::class, 'servicio_id');
    }

    public function publicationCalendars()
    {
        return $this->hasMany(PublicationCalendar::class, 'servicio_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'servicio_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // MÉTODOS DE AYUDA
    public function getProgresoAttribute()
    {
        if ($this->tipo === 'identidad_corporativa') {
            return $this->calcularProgresoIC();
        } else {
            return $this->calcularProgresoCM();
        }
    }

    private function calcularProgresoIC()
    {
        $pasos = 0;
        $totalPasos = 4;

        // Paso 1: Brief completado
        if ($this->brief) $pasos++;

        // Paso 2: Logo en proceso
        if ($this->logos()->whereIn('estado', ['enviado', 'en_revision', 'corregido'])->exists()) $pasos++;

        // Paso 3: Logo entregado
        if ($this->logos()->where('estado', 'entregado')->exists()) $pasos++;

        // Paso 4: Manual entregado
        if ($this->manuals()->exists()) $pasos++;

        return ($pasos / $totalPasos) * 100;
    }

    private function calcularProgresoCM()
    {
        $pasos = 0;
        $totalPasos = 5;

        // Paso 1: Brief completado
        if ($this->brief) $pasos++;

        // Paso 2: Calendario creado
        if ($this->publicationCalendars()->exists()) $pasos++;

        // Paso 3: Calendario aprobado
        if ($this->publicationCalendars()->where('estado', 'entregado')->exists()) $pasos++;

        // Paso 4: Artes creados
        if ($this->publicationCalendars()->has('artworks')->exists()) $pasos++;

        // Paso 5: Reporte generado
        if ($this->publicationCalendars()->has('reports')->exists()) $pasos++;

        return ($pasos / $totalPasos) * 100;
    }
}