<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestForm extends Model
{
    use HasFactory;

    protected $primaryKey = 'interest_id';

    /**
     * 1. อัปเดต $fillable (เพิ่มฟิลด์ใหม่)
     */
    protected $fillable = [
        'student_id', 
        'program_id', 
        'reason_choice', // <-- เพิ่มตัวนี้
        'reason_other',  // <-- เพิ่มตัวนี้
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

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}