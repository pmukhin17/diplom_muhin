<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSrdSurdCrossLexicon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('srd_surd_cross_lexicon', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jest');
            $table->unsignedBigInteger('id_lexicon');
            $table->primary(['id_jest', 'id_lexicon']);
            $table->foreign('id_jest')->references('id_jest')->on('srd_surd_jest')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_lexicon')->references('id_lexicon')->on('srd_surd_lexicon')
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
        Schema::dropIfExists('srd_surd_cross_lexicon');
    }
}
