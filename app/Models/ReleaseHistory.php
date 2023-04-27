<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleaseHistory extends Model
{
    use HasFactory;

    protected $table = 'release_history';
    protected $primaryKey = 'release_history_id';
    protected $fillable = [
        'medicine_id',
        'employee_id',
        'release_quantity',
    ];
}
