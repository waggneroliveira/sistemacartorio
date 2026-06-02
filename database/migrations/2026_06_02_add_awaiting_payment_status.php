<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Inserir o novo status awaiting_payment entre documents_approved e completed
        DB::table('request_statuses')->insert([
            'name' => 'awaiting_payment',
            'label' => 'Aguardando Pagamento',
            'description' => 'Aguardando confirmação do pagamento do serviço',
            'color' => '#FF9800',
            'order' => 5,
            'is_active' => true,
            'is_default' => false,
            'is_final' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Reordenar os status finais
        DB::table('request_statuses')
            ->where('name', 'completed')
            ->update(['order' => 6]);

        DB::table('request_statuses')
            ->where('name', 'rejected')
            ->update(['order' => 7]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('request_statuses')
            ->where('name', 'awaiting_payment')
            ->delete();

        // Restaurar ordem dos status finais
        DB::table('request_statuses')
            ->where('name', 'completed')
            ->update(['order' => 5]);

        DB::table('request_statuses')
            ->where('name', 'rejected')
            ->update(['order' => 6]);
    }
};
