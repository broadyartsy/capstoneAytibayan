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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('to');
            $table->string('programEmail');
            $table->string('from');
            $table->string('fullname');
            $table->string('email');
            $table->text('message');
            $table->string('contacts')->nullable();
            $table->boolean('is_unread')->default(true); // New column for marking as read
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
