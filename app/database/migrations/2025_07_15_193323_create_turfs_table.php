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
        Schema::create('turfs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sport_id')->unsigned()->nullable();
            $table->string('turf_name')->nullable();
            $table->string('turf_image')->nullable();
            $table->integer('slot_duration')->unsigned()->default(0)->comment('Turf Slot Duration in minutes (Ex:- 30 / 60 / 90)');
            $table->string('location')->nullable();
            $table->integer('future_days')->unsigned()->default(0)->comment('Upcoming 20 days');
            $table->integer('max_players')->unsigned()->default(0);
            $table->decimal('slot_price', 8, 2)->default(0.00);
            $table->json('amenities')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('turfs');
    }
};
