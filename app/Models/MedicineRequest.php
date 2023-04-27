<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineRequest extends Model
{
    use HasFactory;

    protected $table = 'medicine_requests';
    protected $primaryKey = 'medicine_request_id';
    protected $fillable = [
        'medicine_id',
        'constituent_id',
        'household_id',
        'quantity_of_request',
        'request_status',
        'processed_by',
    ];
}
