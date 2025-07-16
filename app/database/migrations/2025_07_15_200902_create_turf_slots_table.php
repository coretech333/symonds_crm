<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('turf_slots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('turf_id')->nullable()->default(0);
            $table->time('start_at')->nullable();
            $table->time('end_at')->nullable();
            $table->integer('slot_duration')->nullable();
            $table->boolean('status')->default(true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('turf_slots');
    }
};
