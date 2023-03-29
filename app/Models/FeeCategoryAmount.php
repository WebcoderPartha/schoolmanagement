<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeCategoryAmount extends Model
{
    use HasFactory;
    protected $fillable = [
        'fee_category_id',
        'student_class_id',
        'amount',
    ];

    public function fee_category(){
        return $this->belongsTo(FeeCategory::class, 'fee_category_id');
    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class, 'student_class_id');
    }

}
