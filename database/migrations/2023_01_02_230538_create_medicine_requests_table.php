<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_requests', function (Blueprint $table) {
            $table->id('medicine_request_id');
            $table->string('medicine_id');
            $table->string('constituent_id');
            $table->string('household_id');
            $table->string('quantity_of_request');
            $table->string('request_status');
            $table->string('processed_by')->nullable();
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
        Schema::dropIfExists('medicine_requests');
    }
}
