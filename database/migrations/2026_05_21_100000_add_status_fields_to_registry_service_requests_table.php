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
            // Adicionar novos campos se não existirem
            if (!Schema::hasColumn('registry_service_requests', 'document_requests')) {
                $table->json('document_requests')->nullable()->comment('Documentos solicitados ao cliente');
            }
            if (!Schema::hasColumn('registry_service_requests', 'document_approval')) {
                $table->json('document_approval')->nullable()->comment('Aprovação de documentos');
            }
            if (!Schema::hasColumn('registry_service_requests', 'closing_data')) {
                $table->json('closing_data')->nullable()->comment('Dados de encerramento da solicitação');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registry_service_requests', function (Blueprint $table) {
            $table->dropColumn(['document_requests', 'document_approval', 'closing_data']);
        });
    }
};
