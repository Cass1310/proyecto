<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // MÉTODOS DE VERIFICACIÓN
    public function isDeveloper()
    {
        return $this->name === 'developer';
    }

    public function isCEO()
    {
        return $this->name === 'ceo';
    }

    public function isDirectorMarca()
    {
        return $this->name === 'director_marca';
    }

    public function isDirectorCreativo()
    {
        return $this->name === 'director_creativo';
    }

    public function isCM()
    {
        return $this->name === 'cm';
    }

    public function isDesigner()
    {
        return $this->name === 'designer';
    }

    public function isCliente()
    {
        return $this->name === 'cliente';
    }
}