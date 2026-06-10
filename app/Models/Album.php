<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User; // <-- Añadimos esto explícitamente para quitar la alerta de VS Code

class Album extends Model
{
    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = ['user_id', 'title', 'description'];

    /**
     * Relación: Un álbum pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación: Un álbum tiene muchas fotos.
     */
    public function photos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
    return $this->hasMany(Photo::class);
    }
}