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
        Schema::create('request_audit_trails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registry_service_request_id')->constrained('registry_service_requests')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('action'); // Ex: 'status_changed', 'observation_added', 'documents_requested'
            $table->json('old_data')->nullable(); // Dados antigos
            $table->json('new_data')->nullable(); // Dados novos
            $table->json('changes')->nullable(); // Mudanças realizadas
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        Schema::table('request_audit_trails', function (Blueprint $table) {
            $table->index('registry_service_request_id');
            $table->index('action');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_audit_trails');
    }
};
