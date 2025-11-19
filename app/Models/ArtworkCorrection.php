<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtworkCorrection extends Model
{
    use HasFactory;

    protected $fillable = [
        'artwork_id',
        'correccion_count',
        'comentarios',
        'img_anterior_path',
        'img_nueva_path',
        'created_by',
    ];

    public function artwork()
    {
        return $this->belongsTo(Artwork::class, 'artwork_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}