<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function CourseTimeline(){
        return $this->hasMany(CourseTimeline::class,'course_id','id'); 
    }
    public function CourseCategory(){
        return $this->belongsTo(Category::class,'category_id','id'); 
    }
    public function CourseFaq(){
        return $this->hasMany(CourseFaq::class,'course_id','id'); 
    }
    public function CourseResource(){
        return $this->hasMany(CourseResource::class,'course_id','id'); 
    }
    
    public function TeacherCourse(){
        return $this->hasMany(TeacherCourses::class,'course_id','id'); 
    }
    
}
