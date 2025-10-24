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
        Schema::create('faculty_staff', function (Blueprint $table) {
            $table->id('staff_id');
            $table->string('name', 100);
            $table->string('username', 50)->unique();
            $table->string('password', 100); // หมายเหตุ: ใน doc คือ 100, student คือ 255
            
            // FK อ้างอิงตาราง faculties
            $table->unsignedBigInteger('faculty_id'); 
            $table->foreign('faculty_id')->references('faculty_id')->on('faculties');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_staff');
    }
};