<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $table = 'medicines';
    protected $primaryKey = 'medicine_id';
    protected $fillable = [
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
