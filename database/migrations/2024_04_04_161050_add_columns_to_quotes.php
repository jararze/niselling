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
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('libelula_id_transaction')->nullable()->after('libelula_id');
            $table->string('codigo_recaudacion')->nullable()->after('libelula_id_transaction');
            $table->string('libelula_id_response')->nullable()->after('codigo_recaudacion');
            $table->string('error_libelula')->nullable()->after('libelula_id_response');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn('libelula_id_transaction');
            $table->dropColumn('codigo_recaudacion');
            $table->dropColumn('libelula_id_response');
            $table->dropColumn('error_libelula');
        });
    }
};
