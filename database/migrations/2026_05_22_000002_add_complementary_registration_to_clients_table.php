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
        Schema::table('clients', function (Blueprint $table) {
            $table->string('cpf')->nullable()->unique()->after('whatsapp');
            $table->date('birth_date')->nullable()->after('cpf');
            $table->string('gender')->nullable()->after('birth_date');
            $table->string('street')->nullable()->after('gender');
            $table->string('number')->nullable()->after('street');
            $table->string('complement')->nullable()->after('number');
            $table->string('city')->nullable()->after('complement');
            $table->string('state')->nullable()->after('city');
            $table->string('zip_code')->nullable()->after('state');
            $table->boolean('profile_completed')->default(false)->after('lgpd_accept');
            $table->timestamp('profile_completed_at')->nullable()->after('profile_completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'cpf',
                'birth_date',
                'gender',
                'street',
                'number',
                'complement',
                'city',
                'state',
                'zip_code',
                'profile_completed',
                'profile_completed_at',
            ]);
        });
    }
};
