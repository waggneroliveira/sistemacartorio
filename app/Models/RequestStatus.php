<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RequestStatus extends Model
{
    protected $table = 'request_statuses';

    protected $fillable = [
        'name',
        'label',
        'description',
        'color',
        'order',
        'is_active',
        'is_default',
        'is_final',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'is_final' => 'boolean',
    ];

    /**
     * Relacionamento com solicitações
     */
    public function requests(): HasMany
    {
        return $this->hasMany(RegistryServiceRequest::class, 'request_status_id');
    }

    /**
     * Escopo para apenas status ativos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Escopo para status padrão (inicial)
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true)->first();
    }

    /**
     * Obter o status padrão
     */
    public static function getDefault()
    {
        return self::where('is_default', true)->first();
    }
}
