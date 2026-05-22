<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('rg_path')->nullable()->after('profile_completed_at');
            $table->string('cpf_path')->nullable()->after('rg_path');
            $table->string('proof_address_path')->nullable()->after('cpf_path');
            $table->json('other_documents_paths')->nullable()->after('proof_address_path');
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn(['rg_path', 'cpf_path', 'proof_address_path', 'other_documents_paths']);
        });
    }
};