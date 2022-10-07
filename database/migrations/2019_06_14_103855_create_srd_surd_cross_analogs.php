<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSrdSurdCrossAnalogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srd_surd_cross_analogs', function (Blueprint $table) {
            // В исходной таблице написан полный бред, должно выглядеть как 2 FK, а не 2 PK
            $table->unsignedBigInteger('id_jest');
            $table->unsignedBigInteger('id_jest_analog');
            $table->primary(['id_jest', 'id_jest_analog']);
            $table->foreign('id_jest')->references('id_jest')->on('srd_surd_jest')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jest_analog')->references('id_jest')->on('srd_surd_jest')
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
        Schema::dropIfExists('srd_surd_cross_analogs');
    }
}
