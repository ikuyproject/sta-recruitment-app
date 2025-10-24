<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $primaryKey = 'faculty_id';

    /**
     * ความสัมพันธ์: คณะ 1 แห่ง มีได้หลายสาขา
     */
    public function programs()
    {
        return $this->hasMany(Program::class, 'faculty_id');
    }

    /**
     * ความสัมพันธ์: คณะ 1 แห่ง มีเจ้าหน้าที่ได้หลายคน
     */
    public function staff()
    {
        return $this->hasMany(FacultyStaff::class, 'faculty_id');
    }
}