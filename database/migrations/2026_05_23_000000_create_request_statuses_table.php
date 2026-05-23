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
        Schema::create('request_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Ex: 'pending', 'in_progress'
            $table->string('label'); // Ex: 'Pendente', 'Em Progresso'
            $table->text('description')->nullable();
            $table->string('color')->default('#808080'); // Cor hexadecimal
            $table->unsignedSmallInteger('order')->default(0); // Para ordenação
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false); // Status inicial padrão
            $table->boolean('is_final')->default(false); // Se é um status final
            $table->timestamps();
        });

        // Inserir status padrão
        DB::table('request_statuses')->insert([
            [
                'name' => 'pending',
                'label' => 'Pendente',
                'description' => 'Solicitação aguardando análise inicial',
                'color' => '#FFA500',
                'order' => 1,
                'is_active' => true,
                'is_default' => true,
                'is_final' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'in_progress',
                'label' => 'Em Progresso',
                'description' => 'Solicitação em análise',
                'color' => '#4169E1',
                'order' => 2,
                'is_active' => true,
                'is_default' => false,
                'is_final' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'awaiting_documents',
                'label' => 'Aguardando Documentos',
                'description' => 'Documentos solicitados ao cliente',
                'color' => '#FF6347',
                'order' => 3,
                'is_active' => true,
                'is_default' => false,
                'is_final' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'documents_approved',
                'label' => 'Documentos Aprovados',
                'description' => 'Documentos recebidos e aprovados',
                'color' => '#32CD32',
                'order' => 4,
                'is_active' => true,
                'is_default' => false,
                'is_final' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'completed',
                'label' => 'Concluído',
                'description' => 'Solicitação finalizada com sucesso',
                'color' => '#00AA00',
                'order' => 5,
                'is_active' => true,
                'is_default' => false,
                'is_final' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'rejected',
                'label' => 'Rejeitado',
                'description' => 'Solicitação rejeitada',
                'color' => '#FF0000',
                'order' => 6,
                'is_active' => true,
                'is_default' => false,
                'is_final' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_statuses');
    }
};
