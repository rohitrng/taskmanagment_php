<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table="subjectmaster";
    protected $primarykey="id";
    protected $fillable = ['subject_name', 'subject_type', 'evaluation', 'practical', 'is_delete'];
}
