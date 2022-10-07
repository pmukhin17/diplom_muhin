<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSrdHnsThumbmode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srd_hns_thumbmode', function (Blueprint $table) {
            $table->bigIncrements('id_thumbmode');
            $table->string('thumbmode_notation', 128);
            $table->string('pic', 128)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('srd_hns_thumbmode');
    }
}
