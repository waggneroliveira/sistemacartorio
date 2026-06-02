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
        Schema::table('registry_services', function (Blueprint $table) {
            $table->decimal('service_value', 10, 2)->nullable()->after('dynamic_fields')->comment('Valor do serviço em reais');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registry_services', function (Blueprint $table) {
            $table->dropColumn('service_value');
        });
    }
};
