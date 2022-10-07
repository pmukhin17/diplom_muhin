<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSrdHnsLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srd_hns_location', function (Blueprint $table) {
            $table->bigIncrements('id_location');
            $table->unsignedBigInteger('id_location_notation');
            $table->unsignedBigInteger('id_loc_diacritics');
            $table->string('pic', 128)->nullable();

            $table->foreign('id_location_notation')->references('id_location_notation')->on('srd_hns_location_not');
            $table->foreign('id_loc_diacritics')->references('id_loc_diacritics')->on('srd_hns_loc_diacritics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('srd_hns_location');
    }
}
