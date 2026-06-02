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
        // Inserir o novo status payment_approved entre awaiting_payment e completed
        DB::table('request_statuses')->insert([
            'name' => 'payment_approved',
            'label' => 'Pagamento Aprovado',
            'description' => 'Pagamento recebido e confirmado, serviço em processamento',
            'color' => '#28A745',
            'order' => 6,
            'is_active' => true,
            'is_default' => false,
            'is_final' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Reordenar o status completed
        DB::table('request_statuses')
            ->where('name', 'completed')
            ->update(['order' => 7]);

        DB::table('request_statuses')
            ->where('name', 'rejected')
            ->update(['order' => 8]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('request_statuses')
            ->where('name', 'payment_approved')
            ->delete();

        // Restaurar ordem dos status finais
        DB::table('request_statuses')
            ->where('name', 'completed')
            ->update(['order' => 6]);

        DB::table('request_statuses')
            ->where('name', 'rejected')
            ->update(['order' => 7]);
    }
};
