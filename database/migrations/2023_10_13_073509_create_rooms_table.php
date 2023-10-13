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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique()->default();
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('type_rooms')->onDelete('cascade');
            $table->tinyInteger('isBooked')->default(1);
            $table->float('price');
            $table->string('image', 255);
            $table->text('description')->nullable()->default();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
