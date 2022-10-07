<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerc10WordSignConnections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exerc_word_sign_connections', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('id связи жеста с его переводом');

            $table->unsignedBigInteger('id_word')->comment('ссылка на id слова (точка  контакта с остальной бд)');
            $table->unsignedBigInteger('id_jest')->comment('ссылка на id жеста (точка  контакта с остальной бд)');


            $table->foreign('id_word')->references('id_word')->on('srd_surd_words')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jest')->references('id_jest')->on('srd_surd_jest')
                ->onDelete('cascade')->onUpdate('cascade');

        });
        DB::statement("ALTER TABLE exerc_word_sign_connections comment 'таблица, хранящая в себе список связей жестов с их переводами, при этом имеющая id, имеет связь с таблицами srd_surd_words, srd_surd_jest  по FK, имеет связь с таблицей exerc_chapters_connections по PK'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exerc_word_sign_connections');
    }
}
