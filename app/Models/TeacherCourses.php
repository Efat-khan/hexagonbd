<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherCourses extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function Teacher(){
        return $this->belongsTo(Teacher::class,'teacher_id','id'); 
    }
}
