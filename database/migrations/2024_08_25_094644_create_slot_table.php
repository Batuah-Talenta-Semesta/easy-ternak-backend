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
        Schema::create('slot', function (Blueprint $table) {
            $table->id('id_slot'); // Primary key
            $table->string('code_slot')->unique(); // Unique code for each slot
            $table->unsignedBigInteger('id_investor'); // Foreign key to investor table
            $table->unsignedBigInteger('id_animal'); // Foreign key to animal table
            $table->double('modal', 15, 2); // Modal amount
            $table->double('profit', 15, 2); // Profit amount
            $table->string('status'); // Status of the slot (e.g., active, inactive)
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('id_investor')->references('id_investor')->on('investor')->onDelete('cascade');
            $table->foreign('id_animal')->references('id_animal')->on('animal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot');
    }
};
