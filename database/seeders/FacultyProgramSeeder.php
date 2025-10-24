<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faculty;
use App\Models\Program;
use Illuminate\Support\Facades\DB;

class FacultyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ปิด FK check ก่อน
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // ล้างข้อมูลเก่า (ถ้ามี)
        Faculty::truncate();
        Program::truncate();
        
        // 1. สร้างคณะ
        $sta = Faculty::create([
            'faculty_id' => 1,
            'faculty_name' => 'คณะวิทยาศาสตร์เทคโนโลยีและการเกษตร',
            'faculty_shortname' => 'STA'
        ]);

        // 2. สร้างสาขา (ตาม List "ส่วนที่ 3" ใหม่ทั้งหมด)
        Program::create(['program_name' => 'คณิตศาสตร์ (ค.บ.)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'คอมพิวเตอร์ศึกษา (ค.บ.)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'วิทยาศาสตร์ทั่วไป (ค.บ.)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'ฟิสิกส์ประยุกต์ (วท.บ.)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'เคมีประยุกต์ (วท.บ.)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'ชีววิทยาประยุกต์ (วท.บ.)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'จุลชีววิทยาทางการแพทย์และอุตสาหกรรม (วท.บ.)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'พลังงานทดแทน (วท.บ.)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'สัตวศาสตร์และธุรกิจปศุสัตว์ (วท.บ.)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'เทคโนโลยีการผลิตพืชและธุรกิจการเกษตร (วท.บ.)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'เทคโนโลยีการผลิตพืชและธุรกิจการเกษตร (วท.บ.) (เทียบโอน)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'นวัตกรรมและธุรกิจอาหาร (วท.บ.)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'การประกอบการอาหารฮาลาลและโภชนาการ (วท.บ.)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'การประกอบการอาหารฮาลาลและโภชนาการ (วท.บ.)(เทียบโอน)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'เทคโนโลยีสารสนเทศ (วท.บ.)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'เทคโนโลยีสารสนเทศ (วท.บ.) (เทียบโอน)', 'faculty_id' => $sta->faculty_id]);
        Program::create(['program_name' => 'วิทยาการคอมพิวเตอร์และเทคโนโลยีดิจิทัล (วท.บ.)', 'faculty_id' => $sta->faculty_id]);
        
        // เปิด FK check กลับ
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}