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
                // Usar lock para evitar concorrência
                DB::transaction(function () use ($model) {
                    $model->protocol_number = $model->generateProtocolNumber();
                });
            }
            
            if (!$model->request_status_id) {
                $defaultStatus = RequestStatus::getDefault();
                if ($defaultStatus) {
                    $model->request_status_id = $defaultStatus->id;
                }
            }
        });
    }

    public function generateProtocolNumber()
    {
        $service = $this->service;
        $serviceCode = $service ? strtoupper(substr($service->name, 0, 3)) : 'REQ';
        $year = date('y');
        $month = date('m');
        
        // Lock na tabela para evitar dois inserts simultâneos
        $lastProtocol = RegistryServiceRequest::where('registry_service_id', $this->registry_service_id)
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->lockForUpdate()
            ->orderBy('id', 'desc')
            ->first();
        
        if ($lastProtocol && preg_match('/\d{5}$/', $lastProtocol->protocol_number, $matches)) {
            $lastNumber = intval($matches[0]);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return sprintf('%s-%s-%s-%05d', $serviceCode, $year, $month, $newNumber);
    }

    // public function clients()
    // {
    //     return $this->belongsToMany(Client::class, 'client_id');
    // }

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
