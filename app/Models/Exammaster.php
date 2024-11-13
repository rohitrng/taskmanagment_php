<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Exammaster extends Model
{
    use HasFactory;


    // use HasFactory;
    protected $table="exammasters";
    protected $primarykey="id";
    // protected $fillable = ['nature_of_work_name', 'nature_of_work_remarks'];


    protected $fillable = [
        'exam_name',
        'max_marks_theory',
        'max_marks_practical',
        'fail_if',
        'exam_type',
        'remarks',
        'is_ser',
        'class_name',
        
    ];

}
