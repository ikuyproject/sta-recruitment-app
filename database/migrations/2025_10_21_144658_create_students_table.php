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
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            
            // (Auth Fields - ฟิลด์เดิม)
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('email', 100)->unique();
            $table->string('phone', 20)->nullable();
            
            // (Part 1: Personal Info Fields - ฟิลด์ใหม่)
            $table->string('fullname', 100);
            $table->string('prefix', 50)->nullable();
            $table->string('id_card_number', 20)->nullable();
            $table->date('dob')->nullable(); // Date of Birth
            $table->integer('age')->nullable();
            $table->string('nationality', 50)->nullable();
            $table->string('ethnicity', 50)->nullable();
            $table->string('religion', 50)->nullable();
            $table->string('address_house_no', 100)->nullable();
            $table->string('address_soi', 100)->nullable();
            $table->string('address_street', 100)->nullable();
            $table->string('address_subdistrict', 100)->nullable();
            $table->string('address_district', 100)->nullable();
            $table->string('address_province', 100)->nullable();
            $table->string('address_postal_code', 10)->nullable();
            $table->string('parent_name', 100)->nullable();
            $table->string('parent_phone', 20)->nullable();
            $table->string('parent_relation', 50)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};