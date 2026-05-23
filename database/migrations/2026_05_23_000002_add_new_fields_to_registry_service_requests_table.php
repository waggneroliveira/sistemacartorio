<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('registry_service_requests', function (Blueprint $table) {
            // Adicionar request_status_id se não existir
            if (!Schema::hasColumn('registry_service_requests', 'request_status_id')) {
                $table->foreignId('request_status_id')->nullable()->after('status')->constrained('request_statuses')->onDelete('set null');
            }

            // Adicionar protocol_number se não existir
            if (!Schema::hasColumn('registry_service_requests', 'protocol_number')) {
                $table->string('protocol_number')->unique()->nullable()->after('id')->comment('Protocolo personalizado da solicitação');
            }

            // Adicionar internal_notes se não existir
            if (!Schema::hasColumn('registry_service_requests', 'internal_notes')) {
                $table->json('internal_notes')->nullable()->after('admin_notes')->comment('Observações internas do admin');
            }

            // Adicionar assigned_to se não existir
            if (!Schema::hasColumn('registry_service_requests', 'assigned_to')) {
                $table->foreignId('assigned_to')->nullable()->after('internal_notes')->constrained('users')->onDelete('set null')->comment('Usuário responsável');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registry_service_requests', function (Blueprint $table) {
            if (Schema::hasColumn('registry_service_requests', 'assigned_to')) {
                $table->dropForeign(['assigned_to']);
                $table->dropColumn('assigned_to');
            }

            if (Schema::hasColumn('registry_service_requests', 'internal_notes')) {
                $table->dropColumn('internal_notes');
            }

            if (Schema::hasColumn('registry_service_requests', 'protocol_number')) {
                $table->dropColumn('protocol_number');
            }

            if (Schema::hasColumn('registry_service_requests', 'request_status_id')) {
                $table->dropForeign(['request_status_id']);
                $table->dropColumn('request_status_id');
            }
        });
    }
};
