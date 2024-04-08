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
        Schema::table('contact_forms', function (Blueprint $table) {
            $table->string('tecnom_id')->nullable()->after('pageUrl');
            $table->string('error_tecnom')->nullable()->after('tecnom_id');
            $table->string('status')->nullable()->after('error_tecnom');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_forms', function (Blueprint $table) {
            $table->dropColumn('tecnom_id');
            $table->dropColumn('error_tecnom');
            $table->dropColumn('status');
        });
    }
};
