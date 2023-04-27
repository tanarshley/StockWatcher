<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstituentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constituents', function (Blueprint $table) {
            $table->id('constituent_id');
            $table->string('household_id');
            $table->string('constituent_name');
            $table->date('constituent_birthdate');
            $table->string('constituent_email');
            $table->string('constituent_address');
            $table->string('constituent_phone');
            $table->string('constituent_password');
            $table->string('request_limit')->default('2');
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
        Schema::dropIfExists('constituents');
    }
}
