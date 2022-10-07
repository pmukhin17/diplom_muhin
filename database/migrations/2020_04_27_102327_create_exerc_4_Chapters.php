<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerc4Chapters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        // Chapters
        Schema::create('exerc_chapters', function (Blueprint $table) {
            $table->bigIncrements('id_chapter')->comment('id темы');

            $table->unsignedBigInteger('id_pair')->comment('ссылка на id пары');
            $table->foreign('id_pair')->references('id_pair')->on('exerc_pairs')->onDelete('cascade');

            $table->string('chapter_name', 127)->comment('наименование темы');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE exerc_chapters comment 'таблица, хранящая в себе список тем, имеет связь с таблицей exerc_pairs по FK, имеет связь с таблицами exerc_chapters_connections, exerc_tasks_blocks, exerc_assignment_blocks по PK'");



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('exerc_chapters');

    }
}
