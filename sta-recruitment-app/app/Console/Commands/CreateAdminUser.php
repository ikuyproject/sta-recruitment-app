<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FacultyStaff; // <-- Import Model
use Illuminate\Support\Facades\Hash; // <-- Import Hash
use Illuminate\Support\Facades\Validator; // <-- Import Validator

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // 1. ตั้งชื่อคำสั่งของเรา
    protected $signature = 'make:admin'; 

    /**
     * The console command description.
     *
     * @var string
     */
    // 2. คำอธิบายคำสั่ง
    protected $description = 'Create a new admin user (Faculty Staff)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating a new Admin User...');

        // 3. ถามข้อมูลจาก User
        $name = $this->ask('Enter the name for the admin:');
        $username = $this->ask('Enter the username for the admin:');
        $password = $this->secret('Enter the password for the admin:'); // ใช้ secret() เพื่อซ่อนรหัส

        // 4. ตรวจสอบข้อมูล (Validation)
        $validator = Validator::make([
            'name' => $name,
            'username' => $username,
            'password' => $password,
        ], [
            'name' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50', 'unique:faculty_staff,username'], // เช็ค Unique
            'password' => ['required', 'string', 'min:4'], // กำหนดขั้นต่ำ (เปลี่ยนได้)
        ]);

        if ($validator->fails()) {
            $this->error('Admin creation failed!');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1; // Exit with error code
        }

        // 5. สร้าง User ใน Database
        try {
            FacultyStaff::create([
                'name' => $name,
                'username' => $username,
                'password' => Hash::make($password),
                'faculty_id' => 1, // กำหนดคณะ STA (faculty_id = 1)
            ]);

            $this->info("Admin user '{$username}' created successfully!");
            return 0; // Exit successfully
        } catch (\Exception $e) {
            $this->error('An error occurred while creating the admin user:');
            $this->error($e->getMessage());
            return 1; // Exit with error code
        }
    }
}