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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->integer('model');
            $table->integer('grade');
            $table->integer('phone');
            $table->string('email');
            $table->integer('city');
            $table->integer('dni');
            $table->string('ext');
            $table->string('color')->nullable();
            $table->boolean('test_drive');
            $table->integer('showroom');
//            $table->foreignId('agent_id')->constrained()->onDelete('cascade')->default(1)->nullable();
            $table->foreignId('agent_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('type_contact', ['whatsapp', 'phone', 'online'])->nullable();
            $table->enum('status', ['pendiente', 'crm'])->default('pendiente');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
