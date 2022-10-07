<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSrdHnsFingercollide extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srd_hns_fingercollide', function (Blueprint $table) {
            $table->bigIncrements('id_fingercollide');
            $table->unsignedBigInteger('id_finger1');
            $table->unsignedBigInteger('id_finger2');
            $table->unsignedBigInteger('id_fingercollide_not');

            $table->foreign('id_finger1')->references('id_finger')->on('srd_hns_fingers');
            $table->foreign('id_finger2')->references('id_finger')->on('srd_hns_fingers');
            $table->foreign('id_fingercollide_not')->references('id_fingercollide_not')->on('srd_hns_fingcollide_not');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('srd_hns_fingercollide');
    }
}
