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
        Schema::create('animal', function (Blueprint $table) {
            $table->id('id_animal'); // Primary key
            $table->unsignedBigInteger('id_animal_type'); // Foreign key to animal_type table
            $table->string('name');
            $table->string('code_animal')->unique(); // Unique code for each animal
            $table->unsignedBigInteger('id_mitra'); // Foreign key to mitra table
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();
            $table->double('selling_price', 15, 2)->nullable();
            $table->double('purchase_price', 15, 2)->nullable();
            $table->double('spending_price', 15, 2)->nullable();
            $table->double('profit_price', 15, 2)->nullable();
            $table->double('profit_mitra', 15, 2)->nullable();
            $table->double('profit_investor', 15, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->date('selling_date')->nullable();
            $table->string('status')->default('available'); // e.g., available, sold, etc.
            $table->string('investment_type')->nullable(); // e.g., short-term, long-term
            $table->double('tax', 15, 2)->nullable();
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('id_animal_type')->references('id_animal_type')->on('animal_type')->onDelete('cascade');
            $table->foreign('id_mitra')->references('id_mitra')->on('mitra')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal');
    }
};
