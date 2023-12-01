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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            // $table->string('username')->unique()->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->string('barangay')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('zip')->nullable();
            $table->boolean('blacklisted')->nullable()->default(false);
            // $table->enum('role',['itstaff', 'project_coordinator', 'beneficiary'])->default('beneficiary');
            // $table->enum('program',['Binhi_ng_Pag_asa', 'Akbay', 'Lead', 'AgriPinay', 'Abaka_mo_Piso_mo'])->default('Binhi_ng_Pag_asa');
            // $table->enum('status', ['active', 'inactive'])->default('active');

            //foreign keys
            $table->foreignId('role_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('program_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('status_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
        

    }
};
