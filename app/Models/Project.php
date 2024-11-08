<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'created_by',
        'updated_by',
        'status_id',
        'priority_id',
        'name',
        'description',
        'start_date',
        'due_date',
        'image_path',
    ];

    protected $casts = [
        
        'start_date' => 'date',
        'due_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relationships
     */

    // Relación con el usuario que creó el proyecto
    public function creator():BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relación con el usuario que actualizó el proyecto
    public function updater():BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Relación con el estado del proyecto
    public function status():BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    // Relación con la prioridad del proyecto
    public function priority():BelongsTo
    {
        return $this->belongsTo(Priority::class);
    }

    // Relación con las tareas del proyecto
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
