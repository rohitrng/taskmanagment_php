<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    use HasFactory;

    protected $table="teacher_subjects";
    protected $primarykey="id";

    protected $fillable = [
        'class_name',
        'section_name',
        'subject_name',
        'teacher_name',
        'session_name',
        'current_date',
        'role',

        
    ];

}
