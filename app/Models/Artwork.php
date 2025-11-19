<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'calendar_id',
        'autor_id',
        'fecha_pub',
        'titulo',
        'cuerpo',
        'copy',
        'descripcion',
        'img_path',
        'tipo',
        'estado',
        'correcciones_count',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'fecha_pub' => 'date',
    ];

    public function calendar()
    {
        return $this->belongsTo(PublicationCalendar::class, 'calendar_id');
    }

    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }

    public function corrections()
    {
        return $this->hasMany(ArtworkCorrection::class, 'artwork_id');
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