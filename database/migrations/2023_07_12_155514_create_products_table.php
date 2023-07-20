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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Product name');
            $table->string('description')->comment('Product description');
            $table->string('image')->comment('Product image');
            $table->integer('price')->comment('Product price');
            $table->integer('quantity')->comment('Product quantity');
            $table->foreignId('category_id')->constrained('categories')->comment('Category id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
