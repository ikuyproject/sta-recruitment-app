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
        Schema::create('interest_forms', function (Blueprint $table) {
            $table->id('interest_id');
            
            // FK อ้างอิงตาราง students 
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('student_id')->on('students');
            
            // FK อ้างอิงตาราง programs
            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('program_id')->on('programs');

            $table->text('reason')->nullable(); // 
            $table->datetime('created_at')->useCurrent(); // 
            // (เราจะไม่ใช้ timestamps() เพราะใน doc ระบุแค่ created_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interest_forms');
    }
};