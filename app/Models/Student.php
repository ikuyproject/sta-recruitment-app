<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class Student extends Authenticatable // (ใช้ Authenticatable)
{
    use HasFactory;
    
    protected $primaryKey = 'student_id';

    /**
     * 1. อัปเดต $fillable (เพิ่มฟิลด์ส่วนที่ 1)
     */
    protected $fillable = [
        // (Auth)
        'username', 'password', 'fullname', 'email', 'phone',
        
        // (Part 1 - Personal Info)
        'prefix',
        'id_card_number',
        'dob',
        'age',
        'nationality',
        'ethnicity',
        'religion',
        'address_house_no',
        'address_soi',
        'address_street',
        'address_subdistrict',
        'address_district',
        'address_province',
        'address_postal_code',
        'parent_name',
        'parent_phone',
        'parent_relation',
    ];

    /**
     * (ซ่อนรหัสผ่าน - เหมือนเดิม)
     */
    protected $hidden = [
        'password',
    ];

    /**
     * (ปิด remember_token - เหมือนเดิม)
     */
    public $rememberTokenName = null;

    /**
     * 2. เปิดใช้งาน Timestamps (สำคัญมาก!)
     * (เปลี่ยนจาก null เป็น 'updated_at')
     */
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';

    /**
     * Relationships (เหมือนเดิม)
     */
    public function interestForms()
    {
        return $this->hasMany(InterestForm::class, 'student_id');
    }

    public function applicationForms()
    {
        return $this->hasMany(ApplicationForm::class, 'student_id');
    }
}