<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_name',
        'employee_email',
        'image',
        'designation',
        'department',
        'gender',
        'gender',
        'dob',
        'is_active',
        
    ];
}
