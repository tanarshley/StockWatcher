<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constituent extends Model
{
    use HasFactory;

    protected $table = 'constituents';
    protected $primaryKey = 'constituent_id';
    protected $fillable = [
        'household_id',
        'constituent_name',
        'constituent_birthdate',
        'constituent_email',
        'constituent_address',
        'constituent_phone',
        'constituent_password',
        'request_limit',
    ];
}
