<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSrdSurdCrossSostav extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srd_surd_cross_sostav', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jest_master');
            $table->unsignedBigInteger('id_jest_child');
            $table->smallInteger('order_id');
            $table->primary(['id_jest_master', 'id_jest_child']);
            $table->foreign('id_jest_master')->references('id_jest')->on('srd_surd_jest')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jest_child')->references('id_jest')->on('srd_surd_jest')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('srd_surd_cross_sostav');
    }
}
