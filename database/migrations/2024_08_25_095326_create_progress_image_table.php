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
        Schema::create('progress_image', function (Blueprint $table) {
            $table->id('id_progress_image'); // Primary key
            $table->unsignedBigInteger('id_progress'); // Foreign key to progress table
            $table->string('image'); // Path or URL to the image
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('id_progress')->references('id_progress')->on('progress')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_image');
    }
};
