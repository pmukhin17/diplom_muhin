<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSrdHnsOrientation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srd_hns_orientation', function (Blueprint $table) {
            $table->bigIncrements('id_orientation');
            $table->unsignedBigInteger('id_orientation_not');
            $table->unsignedBigInteger('id_orient_diacritics');
            $table->string('pic', 128)->nullable();

            $table->foreign('id_orientation_not')->references('id_orientation_not')->on('srd_hns_orientation_not');
            $table->foreign('id_orient_diacritics')->references('id_orient_diacritics')->on('srd_hns_orient_diacritics');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('srd_hns_orientation');
    }
}
