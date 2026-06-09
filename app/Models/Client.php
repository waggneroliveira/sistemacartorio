<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Notifications\ClientResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable, HasFactory, LogsActivity;
    
    protected $fillable = [
        'name',
        'email',
        'email_verification_token',
        'whatsapp',
        'cpf',
        'birth_date',
        'gender',
        'street',
        'number',
        'complement',
        'city',
        'state',
        'zip_code',
        'password',
        'active',
        'lgpd_accept',
        'path_image',
        'profile_completed',
        'profile_completed_at',
        'rg_path',
        'cpf_path', 
        'proof_address_path', 
        'other_documents_paths',
    ];

    protected $casts = [
        'lgpd_accept' => 'boolean',
        'active' => 'boolean',
        'profile_completed' => 'boolean',
        'birth_date' => 'date',
        'email_verified_at' => 'datetime',
        'email_verification_requested_at' => 'datetime',
        'profile_completed_at' => 'datetime',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static $recordEvents = ['created', 'deleted']; //OBS: Com isso eu evito que, ao deslogar, o activity log registre o evento de update quando eu deslogar

    public function scopeActive($query){
        return $query->where('active', 1);
    }
    
    public function serviceRequests()
    {
        return $this->belongsToMany(RegistryServiceRequest::class, 'registry_service_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientResetPasswordNotification($token));
    }
}
