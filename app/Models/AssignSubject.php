<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id',
        'subject_id',
        'full_mark',
        'pass_mark',
        'subjective_mark'
    ];

    public function class(){
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function subject(){
        return $this->belongsTo(SchoolSubject::class, 'subject_id', 'id');
    }
}
