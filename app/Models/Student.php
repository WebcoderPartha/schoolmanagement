<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function year(){
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }

    public function class(){
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function group(){
        return $this->belongsTo(StudentClass::class, 'group_id', 'id');
    }

    public function shift(){
        return $this->belongsTo(StudentClass::class, 'shift_id', 'id');
    }

}
