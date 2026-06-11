<?php

namespace App\Models;

use App\Models\RegistryService;
use App\Models\RequestAuditTrail;
use App\Models\RequestStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class RegistryServiceRequest extends Model
{
    use SoftDeletes;

    protected $table = 'registry_service_requests';

    protected $fillable = [
        'protocol_number',
        'client_id',
        'registry_service_id',
        'request_status_id',
        'full_name',
        'email',
        'phone',
        'dynamic_fields_data',
        'uploaded_files',
        'status',
        'admin_notes',
        'internal_notes',
        'document_requests',
        'document_approval',
        'awaiting_payment',
        'payment_approved',
        'closing_data',
        'assigned_to',
    ];

    protected $casts = [
        'dynamic_fields_data' => 'array',
        'uploaded_files' => 'array',
        'document_requests' => 'array',
        'document_approval' => 'array',
        'closing_data' => 'array',
        'internal_notes' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->protocol_number) {
                $model->protocol_number = $model->generateSimpleProtocol();
            }
            
            if (!$model->request_status_id) {
                $defaultStatus = RequestStatus::getDefault();
                if ($defaultStatus) {
                    $model->request_status_id = $defaultStatus->id;
                }
            }
        });
    }

    public function generateSimpleProtocol()
    {
        $maxAttempts = 5;
        $attempt = 0;
        
        do {
            $service = $this->service;
            $serviceCode = $service ? strtoupper(substr($service->name, 0, 3)) : 'REQ';
            
            // Timestamp reduzido (ano-mes-dia-hora-minuto-segundo)
            $timestamp = now()->format('ymdHis'); // Ex: 2401151430 (12 chars)
            
            // Microtime com 4 dígitos
            $microtime = substr(str_replace('.', '', microtime(true)), -4);
            
            // Random com 4 dígitos (boa variedade)
            $random = rand(1000, 9999);
            
            $protocol = sprintf('%s-%s%s%d', $serviceCode, $timestamp, $microtime, $random);
            // Exemplo: REQ-240115143087421234
            
            $attempt++;
            
            // Verifica se já existe (ajuste conforme seu banco/modelo)
            $exists = RegistryServiceRequest::where('protocol_number', $protocol)->exists();
            
            if ($attempt >= $maxAttempts) {
                // Fallback: adiciona um sufixo único
                $protocol = $protocol . '-' . uniqid();
                break;
            }
            
        } while ($exists);
        
        return $protocol;
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relacionamento com RegistryService
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(RegistryService::class, 'registry_service_id');
    }

    /**
     * Relacionamento com RequestStatus
     */
    public function requestStatus(): BelongsTo
    {
        return $this->belongsTo(RequestStatus::class, 'request_status_id');
    }

    /**
     * Relacionamento com User (responsável)
     */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Relacionamento com auditoria
     */
    public function auditTrails(): HasMany
    {
        return $this->hasMany(RequestAuditTrail::class, 'registry_service_request_id');
    }

    /**
     * Obter observações internas formatadas
     */
    public function getInternalNotesFormatted()
    {
        $notes = $this->internal_notes ?? [];
        return collect($notes)->map(function ($note) {
            return [
                'timestamp' => $note['timestamp'] ?? null,
                'user_name' => $note['user_name'] ?? 'Usuário desconhecido',
                'text' => $note['text'] ?? '',
            ];
        })->reverse();
    }

    /**
     * Escopo para apenas solicitações pendentes
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending')->orWhereHas('requestStatus', fn($q) => $q->where('name', 'pending'));
    }

    /**
     * Escopo para apenas solicitações em progresso
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress')->orWhereHas('requestStatus', fn($q) => $q->where('name', 'in_progress'));
    }

    /**
     * Escopo para apenas solicitações completadas
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed')->orWhereHas('requestStatus', fn($q) => $q->where('name', 'completed'));
    }
}
