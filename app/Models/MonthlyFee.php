<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyFee extends Model
{
    use HasFactory;
    protected $fillable = [];

    public function year(){
        return $this->belongsTo(StudentYear::class,'student_year_id', 'id');
    }
    public function class(){
        return $this->belongsTo(StudentClass::class,'student_class_id', 'id');
    }

    public function month(){
        return $this->belongsTo(Month::class,'month_id', 'id');
    }

}
