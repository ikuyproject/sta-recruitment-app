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
        Schema::create('application_forms', function (Blueprint $table) {
            $table->id('application_id');
            
            // FK อ้างอิงตาราง students 
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('student_id')->on('students');
            
            // FK อ้างอิงตาราง faculties
            $table->unsignedBigInteger('faculty_id');
            $table->foreign('faculty_id')->references('faculty_id')->on('faculties');
            
            // FK อ้างอิงตาราง programs
            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('program_id')->on('programs');
            
            $table->string('transcript_file', 255)->nullable(); // 
            $table->string('id_card_file', 255)->nullable(); // 
            $table->string('status', 50)->default('รอตรวจสอบ'); // 
            $table->datetime('submitted_at')->useCurrent(); // 
            // (เราจะไม่ใช้ timestamps() เพราะใน doc ระบุแค่ submitted_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_forms');
    }
};