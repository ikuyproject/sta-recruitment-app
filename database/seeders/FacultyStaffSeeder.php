<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FacultyStaff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FacultyStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        FacultyStaff::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // --- 1. กำหนด User และ Password ใหม่ตรงนี้ ---
        $admins = [
            ['name' => 'Admin User 1', 'username' => 'admin1', 'password' => 'pass1'],
            ['name' => 'Admin User 2', 'username' => 'admin2', 'password' => 'pass2'],
            // (เพิ่มได้ตามต้องการ)
        ];
        // ------------------------------------------

        $facultyId = 1; // คณะ STA

        foreach ($admins as $adminData) {
            FacultyStaff::create([
                'name' => $adminData['name'],
                'username' => $adminData['username'],
                'password' => Hash::make($adminData['password']), // <-- Hash รหัสผ่าน
                'faculty_id' => $facultyId
            ]);
        }

        $this->command->info('Faculty Staff seeded successfully!'); // แจ้งเตือนเมื่อเสร็จ
    }
}