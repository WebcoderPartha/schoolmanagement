<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function year(){
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }

    public function class(){
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }


}
