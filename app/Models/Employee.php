<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'employee_id';
    protected $fillable = [
        'employee_name',
        'employee_email',
        'employee_phone',
        'employee_username',
        'employee_password',
        'employee_role',
        'employee_picture',
    ];
}
