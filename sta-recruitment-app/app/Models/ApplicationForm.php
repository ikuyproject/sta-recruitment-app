<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationForm extends Model
{
    use HasFactory;

    protected $primaryKey = 'application_id';

    /**
     * 1. อัปเดต $fillable (เพิ่มฟิลด์ส่วนที่ 2 และ 4)
     */
    protected $fillable = [
        'student_id', 
        'faculty_id', 
        'program_id',
        
        // (Part 2 - Education)
        'education_status',
        'graduation_year',
        'school_name',
        'school_province',
        'school_major',
        'gpax',
        'gpax_type',
        
        // (Part 4 - Files)
        'transcript_file', 
        'id_card_file',
        'graduation_certificate_file',
        'other_documents_file',

        // (Admin)
        'status',
        'submitted_at',
    ];

    /**
     * (ปิด Timestamps - เหมือนเดิม)
     */
    public $timestamps = false;

    /**
     * Relationships (เหมือนเดิม)
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}