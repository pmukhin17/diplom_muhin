<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSrdHnsFingcollideNot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srd_hns_fingcollide_not', function (Blueprint $table) {
            $table->bigIncrements('id_fingercollide_not');
            $table->string('fingercollide_notation', 128);
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
        Schema::dropIfExists('srd_hns_fingcollide_not');
    }
}
