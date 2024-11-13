<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectCombination extends Model
{
    use HasFactory;

    protected $table="subject_combinations";
    protected $primarykey="id";
    // protected $fillable = ['nature_of_work_name', 'nature_of_work_remarks'];


    protected $fillable = [
        'combination_name',
        'alise_name',
        'streams',
        'is_academic_comb',
        'combination_type',
        'selected_subjects_data',
        'selected_classes_data',
        
        
        
    ];
    

}
