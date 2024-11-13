<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classname extends Model
{
    use HasFactory;
    protected $table="class_name";
    protected $primarykey="id";
    protected $fillable = ['class_name'];
}
