<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerc5AssignmentsTraining extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {



        // AssignmentsTraining
        Schema::create('exerc_chapters_connections', function (Blueprint $table) {
            $table->bigIncrements('id_chapter_connection')->comment('id связи');

            $table->unsignedBigInteger('id_chapter')->comment('ссылка на id главы');
            $table->foreign('id_chapter')->references('id_chapter')->on('exerc_chapters')->onDelete('cascade');

        });
        DB::statement("ALTER TABLE exerc_chapters_connections comment 'таблица, хранящая в себе список привязок глав к парам жест - перевод жеста, имеет связь с таблицей exerc_pairs по FK, имеет связь с таблицами exerc_word_sign_connections, exerc_chapters, по FK'");




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exerc_chapters_connections');

    }
}
