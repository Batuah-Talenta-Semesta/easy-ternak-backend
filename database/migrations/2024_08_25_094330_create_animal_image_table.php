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
        Schema::create('animal_image', function (Blueprint $table) {
            $table->id('id_animal_image'); // Primary key
            $table->unsignedBigInteger('id_animal'); // Foreign key to animal table
            $table->string('image'); // Path or URL to the image
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
        Schema::dropIfExists('animal_image');
    }
};
