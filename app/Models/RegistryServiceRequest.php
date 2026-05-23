<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistryServiceRequest extends Model
{
    use SoftDeletes;

    protected $table = 'registry_service_requests';

    protected $fillable = [
        'protocol_number',
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
            // Gerar protocolo personalizado se não existir
            if (!$model->protocol_number) {
                $model->protocol_number = $model->generateProtocolNumber();
            }
            
            // Definir status padrão se não existir
            if (!$model->request_status_id) {
                $defaultStatus = RequestStatus::getDefault();
                if ($defaultStatus) {
                    $model->request_status_id = $defaultStatus->id;
                }
            }
        });
    }

    /**
     * Gerar número de protocolo personalizado
     */
    public function generateProtocolNumber()
    {
        $service = $this->service;
        $serviceCode = $service ? strtoupper(substr($service->name, 0, 3)) : 'REQ';
        $year = date('Y');
        $month = date('m');
        
        // Contar quantas solicitações do mesmo serviço foram criadas este mês
        $count = RegistryServiceRequest::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->where('registry_service_id', $this->registry_service_id)
            ->count() + 1;
        
        // Formato: SRV-YY-MM-NNNNN (Ex: CRT-26-05-00001)
        return sprintf('%s-%d-%d-%05d', $serviceCode, substr($year, -2), $month, $count);
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
