<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSrdSurdCrossWords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srd_surd_cross_words', function (Blueprint $table) {
            $table->unsignedBigInteger('id_word');
            $table->unsignedBigInteger('id_jest');
            $table->primary(['id_word', 'id_jest']);

            $table->foreign('id_word')->references('id_word')->on('srd_surd_words')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jest')->references('id_jest')->on('srd_surd_jest')
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
        Schema::dropIfExists('srd_surd_cross_words');
    }
}
