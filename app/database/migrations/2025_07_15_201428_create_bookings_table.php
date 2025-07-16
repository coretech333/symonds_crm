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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->unsignedBigInteger('turf_id')->nullable();
            $table->unsignedBigInteger('turf_slot_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedBigInteger('sport_id')->nullable();

            //Booking Detail
            $table->unsignedInteger('no_of_persons')->nullable()->default(1);
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->decimal('slot_price')->nullable()->default(0);

            //Payment Pricing
            $table->decimal('grand_total')->nullable()->default(0)->comment('Basic Total'); // Slots x No. of persons
            $table->decimal('final_total')->nullable()->default(0)->comment('Amount After Charges / GST'); // + add charges / services
            $table->decimal('discount')->nullable()->default(0)->comment('Offer Price'); // - sub Offers / coupon
            $table->decimal('payee_amount')->nullable()->default(0)->comment('Paid by Customer'); // Paid by customer
            
            //Status
            $table->longText('pg_transaction_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->boolean('is_paid')->default(false)->nullable();
            $table->string('booking_status')->nullable()->default(false);
            
            $table->string('booking_ip')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
