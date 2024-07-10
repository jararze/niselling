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
            $table->string('fb_trace_id')->nullable()->after('error_tecnom');
            $table->string('fb_code_id')->nullable()->after('fb_trace_id');
            $table->string('fb_message_id')->nullable()->after('fb_code_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn('fb_trace_id');
            $table->dropColumn('fb_code_id');
            $table->dropColumn('fb_message_id');
        });
    }
};
