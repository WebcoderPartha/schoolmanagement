<?php

namespace App\Models\Backend;

use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationFee extends Model
{
    use HasFactory;
    protected $fillable = [];

    public function year(){
        return $this->belongsTo(StudentYear::class, 'student_year_id', 'id');
    }
    public function class(){
        return $this->belongsTo(StudentClass::class, 'student_class_id', 'id');
    }
}
