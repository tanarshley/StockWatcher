<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpiredMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expired_medicines', function (Blueprint $table) {
            $table->id('expired_medicine_id');
            $table->string('medicine_id');
            $table->string('medicine_name');
            $table->string('medicine_brand');
            $table->string('medicine_category');
            $table->string('medicine_quantity');
            $table->string('medicine_no_of_milligrams');
            $table->string('medicine_measurement');
            $table->string('medicine_lot_number');
            $table->date('medicine_date_of_manufacture');
            $table->date('medicine_date_of_expiry');
            $table->string('medicine_description');
            $table->string('medicine_picture');
            $table->string('request_availability');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expired_medicines');
    }
}
