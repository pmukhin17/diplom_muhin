<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrossBibliography extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srd_surd_cross_bibliography', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jest');
            $table->unsignedBigInteger('id_bibliography');
            $table->primary(['id_jest', 'id_bibliography']);
            $table->foreign('id_jest')->references('id_jest')->on('srd_surd_jest');
            $table->foreign('id_bibliography')->references('id_bibliography')->on('srd_surd_bibliography');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('srd_surd_cross_bibliography');
    }
}
