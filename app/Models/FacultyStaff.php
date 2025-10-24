<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// เราจะใช้ Model นี้เป็น Authenticatable ในภายหลัง
use Illuminate\Foundation\Auth\User as Authenticatable;

class FacultyStaff extends Authenticatable // เปลี่ยนจาก Model เป็น Authenticatable
{
    use HasFactory;

    protected $table = 'faculty_staff'; // ระบุชื่อตาราง
    protected $primaryKey = 'staff_id'; // 

    protected $fillable = [
        'name', 'username', 'password', 'faculty_id'
    ];
    
    protected $hidden = [
        'password',
    ];
    
    public $rememberTokenName = null;
    const UPDATED_AT = null;

    /**
     * ความสัมพันธ์: เจ้าหน้าที่ 1 คน สังกัด 1 คณะ
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
}