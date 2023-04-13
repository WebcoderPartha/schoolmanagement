<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function year(){
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }

    public function class(){
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
    public function subject(){
        return $this->belongsTo(SchoolSubject::class, 'subject_id', 'id');
    }

    public function exam(){
        return $this->belongsTo(ExamType::class, 'exam_type_id', 'id');
    }

    public function assign_student(){
        return $this->belongsTo(AssignStudent::class, 'student_id', 'student_id');
    }





}
