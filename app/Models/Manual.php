<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicio_id',
        'logo_id',
        'manual_path',
        'created_by',
        'updated_by',
    ];

    public function servicio()
    {
        return $this->belongsTo(Service::class, 'servicio_id');
    }

    public function logo()
    {
        return $this->belongsTo(Logo::class, 'logo_id');
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