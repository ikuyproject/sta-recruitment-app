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
            
            // (FKs - ข้อมูลหลัก)
            // (เราใช้ foreignId() ซึ่งเป็นวิธีเขียนที่สั้นกว่า)
            $table->foreignId('student_id')->constrained('students', 'student_id');
            $table->foreignId('faculty_id')->constrained('faculties', 'faculty_id');
            $table->foreignId('program_id')->constrained('programs', 'program_id');
            
            // (Part 2: Education Info - ฟิลด์ใหม่)
            $table->string('education_status', 100)->nullable();
            $table->string('graduation_year', 4)->nullable();
            $table->string('school_name', 255)->nullable();
            $table->string('school_province', 100)->nullable();
            $table->string('school_major', 100)->nullable();
            $table->decimal('gpax', 4, 2)->nullable();
            $table->string('gpax_type', 100)->nullable();
            
            // (Part 4: Document Uploads - ฟิลด์ใหม่)
            $table->string('transcript_file', 255); // (จำเป็น)
            $table->string('id_card_file', 255); // (จำเป็น)
            $table->string('graduation_certificate_file', 255)->nullable(); // (ไม่บังคับ)
            $table->string('other_documents_file', 255)->nullable(); // (ไม่บังคับ)

            // (Admin Fields - ฟิลด์เดิม)
            $table->string('status', 50)->default('รอตรวจสอบ');
            $table->datetime('submitted_at')->useCurrent();
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