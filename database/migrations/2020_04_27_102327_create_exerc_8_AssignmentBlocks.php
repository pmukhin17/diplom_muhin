<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerc8AssignmentBlocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        // AssignmentBlocks
        Schema::create('exerc_assignment_blocks', function (Blueprint $table) {
            $table->bigIncrements('id_assignment_block')->comment('id блока упражнений для учебника');

            $table->unsignedBigInteger('id_chapter')->comment('ссылка на id темы');
            $table->foreign('id_chapter')->references('id_chapter')->on('exerc_chapters')->onDelete('cascade');

            $table->string('block_name', 127)->comment('текст, показывемый около блока упражнений для учебника');
        });
        DB::statement("ALTER TABLE exerc_assignment_blocks comment 'таблица, хранящая в себе список блоков упражнений для учебника, имеет связь с таблицей exerc_pairs по FK, имеет связь с таблицами exerc_assignments_training по PK'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('exerc_assignment_blocks');

    }
}
