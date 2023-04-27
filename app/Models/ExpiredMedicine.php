<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpiredMedicine extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'expired_medicines';
    protected $primaryKey = 'expired_medicine_id';
    protected $fillable = [
        'medicine_id',
        'medicine_name',
        'medicine_brand',
        'medicine_category',
        'medicine_quantity',
        'medicine_no_of_milligrams',
        'medicine_measurement',
        'medicine_lot_number',
        'medicine_date_of_manufacture',
        'medicine_date_of_expiry',
        'medicine_description',
        'medicine_picture',
        'request_availability',
    ];
}
