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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_of_cars_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('engine');
            $table->string('cylindered');
            $table->string('transmission');
            $table->string('traction');
            $table->integer('commercial_date');
            $table->string('origin');
            $table->string('factory');
            $table->string('delivery');
            $table->float('price');
            $table->float('discount');
            $table->float('order');
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
