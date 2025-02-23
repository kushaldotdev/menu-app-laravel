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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('category_name');
            $table->string('category_href')->unique();
            $table->string('category_description');
            $table->text('category_logo')->nullable();
            $table->enum('category_status', ['active', 'disabled'])->default('active');

            // Foreign key: Parent category reference (self-referencing)
            $table->unsignedBigInteger('parent_category_id')->nullable();
            $table->foreign('parent_category_id')->references('category_id')->on('categories')->onDelete('cascade');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
