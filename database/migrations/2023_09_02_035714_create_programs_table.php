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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('program_name')->nullable();
            $table->string('location')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->longText('description')->nullable();
            $table->longText('quiry')->nullable();
            $table->longText('requirements')->nullable();
            $table->string('image')->nullable();
            $table->string('background_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
