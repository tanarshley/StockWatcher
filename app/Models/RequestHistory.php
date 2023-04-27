<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestHistory extends Model
{
    use HasFactory;

    protected $table = 'requests_history';
    protected $primaryKey = 'request_history_id';
    protected $fillable = [
        'medicine_request_id',
        'medicine_id',
        'constituent_id',
        'household_id',
        'quantity_of_request',
        'request_status',
        'processed_by',
    ];
}
