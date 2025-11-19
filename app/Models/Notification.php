<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'entidad_tipo',
        'entidad_id',
        'tipo',
        'mensaje',
        'is_read',
        'delivery_push',
        'created_by',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'delivery_push' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}