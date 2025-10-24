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
            
            $table->foreignId('student_id')->constrained('students', 'student_id');
            $table->foreignId('program_id')->constrained('programs', 'program_id');

            // --- เปลี่ยนแปลงตรงนี้ ---
            // 1. เปลี่ยน reason เป็น Enum หรือ String สำหรับเก็บ Choice หลัก
            $table->string('reason_choice', 50)->nullable(); // เช่น 'ทดลอง', 'แนะนำ', 'โค้ด', 'อื่นๆ'
            
            // 2. เพิ่มคอลัมน์สำหรับเก็บข้อความ "อื่นๆ"
            $table->text('reason_other')->nullable(); 
            // -----------------------

            $table->datetime('created_at')->useCurrent();
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