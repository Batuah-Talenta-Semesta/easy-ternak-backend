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
        Schema::create('investor', function (Blueprint $table) {
            $table->id('id_investor'); // Primary key
            $table->unsignedBigInteger('id_user'); // Foreign key to users table
            $table->string('name');
            $table->text('address');
            $table->string('ktp')->nullable(); // KTP can be nullable
            $table->string('payment_name');
            $table->string('payment_account');
            $table->string('payment_number');
            $table->string('telephone');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor');
    }
};
