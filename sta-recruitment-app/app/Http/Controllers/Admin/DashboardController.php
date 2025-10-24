<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Program;
use App\Models\InterestForm;
use App\Models\ApplicationForm; // <-- Import เพิ่ม

class DashboardController extends Controller
{
    public function index(): View
    {
        // --- 1. ดึงข้อมูล KPI Cards ---
        $totalApplications = ApplicationForm::count();
        $pendingApplications = ApplicationForm::where('status', 'รอตรวจสอบ')->count();
        $totalInterestForms = InterestForm::count();
        // (ส่วน Rate การเข้าชมเว็บ ต้องใช้ระบบ Analytics แยกต่างหาก หรือสร้าง Counter เอง)
        // $websiteVisits = ...; // ตัวอย่าง

        // --- 2. ดึงข้อมูลสำหรับ Interest Chart (เหมือนเดิม) ---
        $allPrograms = Program::where('faculty_id', 1)->orderBy('program_name')->get();
        $interestCounts = InterestForm::query()
            ->select('program_id', DB::raw('count(interest_id) as total'))
            ->groupBy('program_id')
            ->pluck('total', 'program_id');

        $colorMap = [ /* ... สีเหมือนเดิม ... */
            'คณิตศาสตร์ (ค.บ.)'=>'#FF6384', 'คอมพิวเตอร์ศึกษา (ค.บ.)'=>'#36A2EB', 'วิทยาศาสตร์ทั่วไป (ค.บ.)'=>'#FFCE56', 'ฟิสิกส์ประยุกต์ (วท.บ.)'=>'#4BC0C0', 'เคมีประยุกต์ (วท.บ.)'=>'#9966FF', 'ชีววิทยาประยุกต์ (วท.บ.)'=>'#FF9F40', 'จุลชีววิทยาทางการแพทย์และอุตสาหกรรม (วท.บ.)'=>'#C9CBCF', 'พลังงานทดแทน (วท.บ.)'=>'#8BC34A', 'สัตวศาสตร์และธุรกิจปศุสัตว์ (วท.บ.)'=>'#CDDC39', 'เทคโนโลยีการผลิตพืชและธุรกิจการเกษตร (วท.บ.)'=>'#009688', 'เทคโนโลยีการผลิตพืชและธุรกิจการเกษตร (วท.บ.) (เทียบโอน)'=>'#00BCD4', 'นวัตกรรมและธุรกิจอาหาร (วท.บ.)'=>'#FFEB3B', 'การประกอบการอาหารฮาลาลและโภชนาการ (วท.บ.)'=>'#FFC107', 'การประกอบการอาหารฮาลาลและโภชนาการ (วท.บ.)(เทียบโอน)'=>'#FF5722', 'เทคโนโลยีสารสนเทศ (วท.บ.)'=>'#795548', 'เทคโนโลยีสารสนเทศ (วท.บ.) (เทียบโอน)'=>'#9E9E9E', 'วิทยาการคอมพิวเตอร์และเทคโนโลยีดิจิทัล (วท.บ.)'=>'#607D8B'
        ];

        $chartLabels = [];
        $chartData = [];
        $chartColors = [];
        foreach ($allPrograms as $program) {
            $programName = $program->program_name;
            $programId = $program->program_id;
            $chartLabels[] = $programName;
            $count = $interestCounts->get($programId, 0);
            $chartData[] = $count;
            $color = $colorMap[$programName] ?? '#CCCCCC';
            $chartColors[] = $color;
        }
        // --- จบส่วน Interest Chart ---

        // 3. ส่งข้อมูลทั้งหมดไปยัง View
        return view('admin.dashboard', compact(
            'totalApplications',
            'pendingApplications',
            'totalInterestForms',
            'chartLabels',
            'chartData',
            'chartColors'
            // 'websiteVisits' // ถ้ามี
        ));
    }
}