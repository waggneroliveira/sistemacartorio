<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistryService extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'registry_services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'icon',
        'required_documents',
        'instructions',
        'dynamic_fields',
        'is_active',
        'display_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'required_documents' => 'array',
        'dynamic_fields' => 'array',
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    /**
     * Scope a query to only include active services.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by display order.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order', 'asc');
    }

    /**
     * Get formatted required documents list.
     *
     * @return array
     */
    public function getDocumentsListAttribute(): array
    {
        return $this->required_documents ?? [];
    }

    /**
     * Get formatted dynamic fields list.
     *
     * @return array
     */
    public function getFieldsListAttribute(): array
    {
        return $this->dynamic_fields ?? [];
    }

    /**
     * Check if service has dynamic fields.
     *
     * @return bool
     */
    public function hasDynamicFields(): bool
    {
        return !empty($this->dynamic_fields) && count($this->dynamic_fields) > 0;
    }

    /**
     * Get required documents as HTML list.
     *
     * @return string
     */
    public function getRequiredDocumentsHtmlAttribute(): string
    {
        if (empty($this->required_documents)) {
            return '<p>No documents listed</p>';
        }

        $html = '<ul class="list-unstyled">';
        foreach ($this->required_documents as $document) {
            $html .= '<li><i class="bi bi-check-circle-fill text-success me-2"></i> ' . htmlspecialchars($document) . '</li>';
        }
        $html .= '</ul>';

        return $html;
    }
}