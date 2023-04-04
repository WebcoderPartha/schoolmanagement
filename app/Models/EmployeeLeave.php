<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;
    protected $fillable = [];

    public function leave(){
        return $this->belongsTo(LeavePurpose::class, 'leave_purpose_id', 'id');
    }
}
