<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistryService extends Model
{
    use SoftDeletes;
    
    protected $table = 'registry_services';
    
    protected $fillable = [
        'name',
        'icon',
        'required_documents',
        'instructions',
        'dynamic_fields',
        'is_active',
        'display_order'
    ];
    
    protected $casts = [
        'required_documents' => 'array', 
        'dynamic_fields' => 'array',     
        'is_active' => 'boolean'
    ];
    
    // Escopo para serviços ativos
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    // Relacionamento com as solicitações
    public function requests()
    {
        return $this->hasMany(RegistryServiceRequest::class, 'registry_service_id');
    }
}