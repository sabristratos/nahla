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
            $table->string('name_ar');
            $table->text('description_ar');
            $table->text('ingredients_ar')->nullable();
            $table->text('usage_ar')->nullable();
            $table->text('benefits_ar')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('size')->nullable();
            $table->string('image_path');
            $table->boolean('is_featured')->default(false);
            $table->json('additional_images')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
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
