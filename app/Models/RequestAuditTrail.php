<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestAuditTrail extends Model
{
    protected $table = 'request_audit_trails';

    public $timestamps = false;

    protected $fillable = [
        'registry_service_request_id',
        'user_id',
        'action',
        'old_data',
        'new_data',
        'changes',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
        'changes' => 'array',
        'created_at' => 'datetime',
    ];

    /**
     * Relacionamento com RegistryServiceRequest
     */
    public function request(): BelongsTo
    {
        return $this->belongsTo(RegistryServiceRequest::class, 'registry_service_request_id');
    }

    /**
     * Relacionamento com User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Registrar uma ação
     */
    public static function logAction($requestId, $action, $oldData = null, $newData = null, $changes = null)
    {
        return self::create([
            'registry_service_request_id' => $requestId,
            'user_id' => auth()->id(),
            'action' => $action,
            'old_data' => $oldData,
            'new_data' => $newData,
            'changes' => $changes,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
        ]);
    }

    /**
     * Obter ações de um tipo específico
     */
    public function scopeByAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Obter histórico ordenado por data descendente
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
