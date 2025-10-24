<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\InterestForm;
use App\Models\ApplicationForm; // <-- Import ApplicationForm Model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ปิดการตรวจสอบ Foreign Key ชั่วคราว
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 1. ลบข้อมูลจากตารางลูก (child tables) ก่อน
        ApplicationForm::truncate(); // <-- เพิ่มบรรทัดนี้
        InterestForm::truncate();

        // 2. ค่อยลบข้อมูลจากตารางแม่ (parent table)
        Student::truncate();

        // เปิดการตรวจสอบ Foreign Key กลับมาเหมือนเดิม
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // --- ส่วนสร้างข้อมูลจำลอง (ถูกคอมเมนต์ออกไปแล้ว) ---
        /*
        $hashedPassword = Hash::make('user_pass123');
        $s1 = Student::create([...]);
        ...
        InterestForm::create([...]);
        */
        // ------------------------------------

        $this->command->info('StudentSeeder executed (cleared data, no dummy students created).'); // อัปเดตข้อความ
    }
}