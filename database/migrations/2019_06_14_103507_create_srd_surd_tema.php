<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSrdSurdTema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //`id_tema`, `asset_id`, `state`, `parent_id`, `access_id`, `value`
        Schema::create('srd_surd_tema', function (Blueprint $table) {
            $table->bigIncrements('id_tema');
            $table->unsignedBigInteger('asset_id')->nullable();
            $table->unsignedBigInteger('access_id')->nullable();
            $table->boolean('state')->default(0);
            $table->string('value', 128);

            $table->unsignedBigInteger('parent_id');

            $table->foreign('parent_id')->references('id_tema')->on('srd_surd_tema');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('srd_surd_tema');
    }
}
