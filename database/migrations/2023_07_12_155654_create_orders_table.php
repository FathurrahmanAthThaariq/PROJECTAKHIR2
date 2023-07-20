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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->comment('User id');
            $table->string('code')->comment('Order code');
            $table->integer('total')->comment('Order total');
            $table->string('status')->comment('Order status');
            $table->string('payment_method')->comment('Order payment method');
            $table->string('payment_status')->comment('Order payment status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
