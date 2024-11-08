<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Priority extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'color',
        'description',
    ];

    /**
     * Relationships
     */

    // Relación con los proyectos
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    // Relación con las tareas que tienen esta prioridad
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'priority_id');
    }
}
