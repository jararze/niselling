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
            $table->enum('way_to_pay', ['online_libelula', 'transferencia_bancaria'])->nullable()->after('type_contact');
            $table->string('way_to_pay_image')->nullable()->after('way_to_pay');
            $table->string('libelula_id')->nullable()->after('way_to_pay_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn('way_to_pay');
            $table->dropColumn('way_to_pay_image');
            $table->dropColumn('libelula_id');
        });
    }
};
