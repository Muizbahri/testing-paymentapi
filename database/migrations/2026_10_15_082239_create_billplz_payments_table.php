<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('BillplzPayment', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number', 15);
            $table->decimal('amount_donation', 12, 2);

            $table->string("bill_id")->nullable();
            $table->string('collection_id')->nullable();
            $table->string('state')->nullable();
            $table->boolean('paid')->nullable();
            $table->integer('paid_amount', 12, 2)->nullable();
            $table->string('bill_url')->nullable();
            $table->text('raw_response')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('BillplzPayment');
    }
};
