<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerc6TasksBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {



        // TasksBlocks
        Schema::create('exerc_tasks_blocks', function (Blueprint $table) {
            $table->bigIncrements('id_task_block')->comment('id блока упражнений для рабочей тетради');

            $table->unsignedBigInteger('id_chapter')->comment('ссылка на id темы');
            $table->foreign('id_chapter')->references('id_chapter')->on('exerc_chapters')->onDelete('cascade');

            $table->string('block_name', 63)->comment('текст, показывемый около блока упражнений для рабочей тетради');
        });
        DB::statement("ALTER TABLE exerc_tasks_blocks comment 'таблица, хранящая в себе список блоков упражнений для рабочей тетради, имеет связь с таблицей exerc_pairs по FK, имеет связь с таблицами exerc_tasks_check по PK'");



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('exerc_tasks_blocks');

    }
}
