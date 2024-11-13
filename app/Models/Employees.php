<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $table="employees";
    protected $primarykey="id";

    protected $fillable = [
        'FirstName',
        'LastName',
        'Email',
        'Phone',
        'Address',
        'DateOfBirth',
        'JoiningDate',
        'DepartureDate',
        'DepartmentID',
        'PositionID'
        
    
    ];



}
