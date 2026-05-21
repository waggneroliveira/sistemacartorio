<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistryServiceRequest extends Model
{
    use SoftDeletes;

    protected $table = 'registry_service_requests';

    protected $fillable = [
        'registry_service_id',
        'full_name',
        'email',
        'phone',
        'dynamic_fields_data',
        'uploaded_files',
        'status',
        'admin_notes',
        'document_requests',
        'document_approval',
        'closing_data',
    ];

    protected $casts = [
        'dynamic_fields_data' => 'array',
        'uploaded_files' => 'array',
        'document_requests' => 'array',
        'document_approval' => 'array',
        'closing_data' => 'array',
    ];

    /**
     * Relacionamento com RegistryService
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(RegistryService::class, 'registry_service_id');
    }

    /**
     * Escopo para apenas solicitações pendentes
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Escopo para apenas solicitações em progresso
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    /**
     * Escopo para apenas solicitações completadas
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
