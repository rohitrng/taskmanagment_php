<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    use HasFactory;
    protected $table="previosly_saved_marks_entry";
    protected $primarykey="id";

    protected $fillable = [
    'teacher_name',
        'exam_name',
        'class_name',
        'section_name',
        'subject_name',
    
    ];



}
