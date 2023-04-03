<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamFee extends Model
{
    use HasFactory;
    protected $fillable = [];

    public function exam(){
        return $this->belongsTo(ExamType::class, 'exam_type_id', 'id');
    }
    public function year(){
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }
    public function class(){
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

}
