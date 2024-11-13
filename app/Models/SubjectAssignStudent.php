<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectAssignStudent extends Model
{
    use HasFactory;

    protected $table="subject_assign_student";
    protected $primarykey="id";
    


    protected $fillable = [
        'class_name',
        'section_name',
        'assign_this_combtoall',
        'students_details',
              
        
        
    ];
    

}
