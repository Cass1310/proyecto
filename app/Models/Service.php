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
    
}