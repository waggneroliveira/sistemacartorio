<?php

namespace App\Services;

use App\Models\RequestStatus;

class StatusHelper
{
    /**
     * Obter cor de um status
     */
    public static function getStatusColor($status)
    {
        if ($status instanceof RequestStatus) {
            return $status->color;
        }

        $status = RequestStatus::where('name', $status)->first();
        return $status?->color ?? '#808080';
    }

    /**
     * Obter label de um status
     */
    public static function getStatusLabel($status)
    {
        if ($status instanceof RequestStatus) {
            return $status->label;
        }

        $status = RequestStatus::where('name', $status)->first();
        return $status?->label ?? ucfirst(str_replace('_', ' ', $status));
    }

    /**
     * Verificar se um status é final
     */
    public static function isStatusFinal($status)
    {
        if ($status instanceof RequestStatus) {
            return $status->is_final;
        }

        $status = RequestStatus::where('name', $status)->first();
        return $status?->is_final ?? false;
    }

    /**
     * Converter status antigos para novos
     */
    public static function migrateOldStatus($oldStatus)
    {
        $mapping = [
            'pending' => 'pending',
            'in_progress' => 'in_progress',
            'awaiting_documents' => 'awaiting_documents',
            'documents_approved' => 'documents_approved',
            'completed' => 'completed',
            'rejected' => 'rejected',
        ];

        return $mapping[$oldStatus] ?? $oldStatus;
    }
}
