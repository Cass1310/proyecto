<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'telefono',
        'role_id',
        'manager_id',
        'razon_social',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'is_active' => 'boolean',
            'password' => 'hashed',
        ];
    }

    // RELACIONES
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function subordinates()
    {
        return $this->hasMany(User::class, 'manager_id');
    }

    // MÉTODOS DE VERIFICACIÓN DE ROLES
    public function isDeveloper()
    {
        return $this->role->name === 'developer';
    }

    public function isCEO()
    {
        return $this->role->name === 'ceo';
    }

    public function isDirectorMarca()
    {
        return $this->role->name === 'director_marca';
    }

    public function isDirectorCreativo()
    {
        return $this->role->name === 'director_creativo';
    }

    public function isCM()
    {
        return $this->role->name === 'cm';
    }

    public function isDesigner()
    {
        return $this->role->name === 'designer';
    }

    public function isCliente()
    {
        return $this->role->name === 'cliente';
    }

    // MÉTODOS DE ALCANCE (SCOPES)
    public function scopeActivos($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePorRol($query, $roleName)
    {
        return $query->whereHas('role', function($q) use ($roleName) {
            $q->where('name', $roleName);
        });
    }

    // MÉTODO PARA OBTENER JERARQUÍA
    public function getJerarquiaAttribute()
    {
        if ($this->isDeveloper()) {
            return 'Desarrollador - Acceso Total';
        } elseif ($this->isCEO()) {
            return 'CEO - Administración General';
        } elseif ($this->isDirectorMarca()) {
            return 'Director de Marca - Supervisa CM';
        } elseif ($this->isDirectorCreativo()) {
            return 'Director Creativo - Supervisa Diseñadores';
        } elseif ($this->isCM()) {
            return 'Community Manager';
        } elseif ($this->isDesigner()) {
            return 'Diseñador Gráfico';
        } elseif ($this->isCliente()) {
            return 'Cliente';
        }
        
        return 'Sin rol definido';
    }
}