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
        Schema::create('progress', function (Blueprint $table) {
            $table->id('id_progress'); // Primary key
            $table->unsignedBigInteger('id_animal'); // Foreign key to animal table
            $table->text('description'); // Description of the progress
            $table->date('date'); // Date of progress
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('id_animal')->references('id_animal')->on('animal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
